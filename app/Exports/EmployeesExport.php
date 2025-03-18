<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\Log;

class EmployeesExport implements FromCollection, WithHeadings
{
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
        Log::info('EmployeesExport initialized with filters:', $this->filters);
    }

    public function collection()
    {
        $query = Employee::with('branch');

        // 🔍 Apply Search Filter
        if (!empty($this->filters['search'])) {
            $searchTerms = explode(' ', $this->filters['search']);
            $query->where(function ($q) use ($searchTerms) {
                foreach ($searchTerms as $term) {
                    $q->where('name', 'LIKE', "%{$term}%");
                }
            });
        }

        // 🏢 Apply Branch Filter
        if (!empty($this->filters['branch'])) {
            $query->where('branch_id', $this->filters['branch']);
        }

        // 💼 Apply Job Filter
        if (!empty($this->filters['job'])) {
            $query->whereHas('jobRelation', function ($jQuery) {
                $jQuery->where('id', $this->filters['job']);
            });
        }

        // 📆 Apply Date Range Filter (if provided)
        if (!empty($this->filters['date_hired_from']) && !empty($this->filters['date_hired_to'])) {
            $query->whereBetween('date_hired', [$this->filters['date_hired_from'], $this->filters['date_hired_to']]);
        }

        // Get the filtered employees
        $employees = $query->get();

        // Log the final query results
        Log::info('Filtered Employees Count:', ['count' => $employees->count()]);
        Log::info('Filtered Employees Data:', $employees->toArray());

        return $employees->map(function ($employee) {
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
