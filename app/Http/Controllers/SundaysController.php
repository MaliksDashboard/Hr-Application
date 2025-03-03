<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class SundaysController extends Controller
{
    public function index()
    {
        return view('sundays.index');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,xlsb|max:2048'
        ]);
    
        // Store the file
        $filePath = $request->file('file')->store('uploads', 'public');
        $fullPath = storage_path('app/public/' . $filePath);
    
        // Convert .xlsb to .xlsx if needed
        $extension = $request->file('file')->getClientOriginalExtension();
        if ($extension === 'xlsb') {
            $convertedPath = str_replace('.xlsb', '.xlsx', $fullPath);
            shell_exec("libreoffice --headless --convert-to xlsx $fullPath --outdir " . dirname($fullPath));
    
            if (!file_exists($convertedPath)) {
                return back()->with('error', 'Failed to convert XLSB file.');
            }
            $fullPath = $convertedPath;
        }
    
        // Load Excel file
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($fullPath);
        $sheetNames = $spreadsheet->getSheetNames();
    
        // Extract employee names
        $employees = [];
        foreach ($sheetNames as $sheetName) {
            $sheet = $spreadsheet->getSheetByName($sheetName);
            $highestRow = $sheet->getHighestRow();
    
            for ($row = 2; $row <= $highestRow; $row++) { // Assuming first row is header
                $name = trim($sheet->getCell("A{$row}")->getValue());
                if (!empty($name)) {
                    $employees[$name][$sheetName] = ($employees[$name][$sheetName] ?? 0) + 1;
                }
            }
        }
    
        // Store in session and redirect
        session(['employees' => $employees, 'sheetNames' => $sheetNames]);
    
        return redirect()->route('sundays.factors');
    }
    

    public function process(Request $request)
    {
        $employees = session('employees');
        $factors = $request->input('factors');

        // Apply multiplication factors to shift counts
        foreach ($employees as $name => &$shifts) {
            foreach ($shifts as $shift => &$count) {
                $count *= (int) ($factors[$shift] ?? 1); // Multiply by the factor, default to 1 if not set
            }
        }

        // Store processed data in session
        session(['processedEmployees' => $employees]);

        return redirect()->route('sundays.export');
    }

    public function export()
    {
        $employees = session('processedEmployees');
    
        if (!$employees) {
            return redirect()->route('sundays.index')->with('error', 'No data to export.');
        }
    
        // Create Excel
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
    
        // Set headers
        $sheet->setCellValue('A1', 'Employee Name');
        $col = 'B';
        foreach (session('sheetNames') as $shift) {
            $sheet->setCellValue($col . '1', $shift);
            $col++;
        }
        $sheet->setCellValue($col . '1', 'Total');
    
        // Fill data
        $row = 2;
        foreach ($employees as $name => $shifts) {
            $sheet->setCellValue("A$row", $name);
            $col = 'B';
            $total = 0;
            foreach (session('sheetNames') as $shift) {
                $count = $shifts[$shift] ?? 0;
                $sheet->setCellValue("$col$row", $count);
                $total += $count;
                $col++;
            }
            $sheet->setCellValue("$col$row", $total);
            $row++;
        }
    
        // Save Excel
        $fileName = 'Attendance_Report.xlsx';
        $filePath = storage_path('app/public/' . $fileName);
        $writer = new Xlsx($spreadsheet);
        $writer->save($filePath);
    
        // Return File for Download (NO JSON)
        return response()->download($filePath)->deleteFileAfterSend(true);
    }
    

    public function factors()
    {
        if (!session()->has('employees') || !session()->has('sheetNames')) {
            return redirect()->route('sundays.index')->with('error', 'No data available. Please upload an Excel file first.');
        }

        return view('sundays.factors');
    }
}
