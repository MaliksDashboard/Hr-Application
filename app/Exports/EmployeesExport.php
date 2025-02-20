<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmployeesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Employee::with('branch')->get()->map(function ($employee) {
            return [
                'name' => $employee->name,
                'branch_name' => $employee->branch->branch_name ?? 'N/A',
                'title' => $employee->title,
                'status' => $employee->status ? 'Active' : 'Left',
                'date_hired' => $employee->date_hired,
                'email' => $employee->email,
                'phone' => $employee->phone,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Name',
            'Branch Name',
            'Title',
            'Status',
            'Date Hired',
            'Email',
            'Phone',
        ];
    }
}
