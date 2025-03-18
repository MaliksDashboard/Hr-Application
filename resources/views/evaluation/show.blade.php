@extends('layouts.master')

@section('title', 'Start Evaluation')

@section('main')
    <div class="main">
        <div class="evaluation-container">
            <h2>Evaluation for <span class="highlight">{{ \Carbon\Carbon::create()->month((int) $month)->format('F') }} -
                    {{ $currentYear }}</span></h2>


            <div class="table-wrapper">
                <table class="evaluation-table">
                    <thead>
                        <tr>
                            <th>Employee Name</th>
                            <th>Job</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                            @php
                                $hasEvaluation = false;
                            @endphp
                            <tr>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->job }}</td>
                                <td>
                                    @if ($hasEvaluation)
                                        <span class="status completed">✔ Completed</span>
                                    @else
                                        <span class="status pending">⏳ Pending</span>
                                    @endif
                                </td>
                                <td>
                                    @if (!$hasEvaluation)
                                        <a href="{{ route('evaluation.evaluate', ['month' => $month, 'employee_id' => $employee->id]) }}"
                                            class="btn evaluate-btn">Evaluate</a>
                                    @else
                                        @if ($hasEvaluation)
                                            <a href="{{ route('evaluation.view', ['month' => $month, 'employee_id' => $employee->id]) }}"
                                                class="btn view-btn">View</a>
                                        @else
                                            <button class="disabled" disabled>View</button>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <button class="floating-submit-btn">Submit All Evaluations</button>
        </div>
    </div>

    <style>
        :root {
            --primary-color: hsl(210, 20%, 14%);
            --second-color: hsl(220, 15%, 55%);
            --third-color: hsl(15, 90%, 50%);
            --light-color: hsl(220, 15%, 85%);
            --text-light-color: hsl(220, 10%, 65%);
            --red-theme-color: hsl(0, 85%, 45%);
            --bg-color: hsl(0, 14%, 97%);
            --bg-white: hsl(0, 0%, 100%);
            --glass-bg: rgba(255, 255, 255, 0.1);
        }

        .evaluation-container {
            max-width: 900px;
            margin: auto;
            padding: 20px;
            background: var(--primary-color);
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            text-align: center;
            color: var(--light-color);
        }

        h2 {
            color: var(--third-color);
            font-size: 24px;
            margin-bottom: 20px;
        }

        .highlight {
            color: var(--third-color);
            font-weight: bold;
        }

        .table-wrapper {
            overflow-x: auto;
            border-radius: 8px;
            padding: 10px;
            background: var(--glass-bg);
            backdrop-filter: blur(8px);
        }

        .evaluation-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            color: var(--light-color);
        }

        .evaluation-table th,
        .evaluation-table td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid var(--second-color);
        }

        .evaluation-table th {
            background: var(--primary-color);
            color: var(--light-color);
        }

        .evaluation-table tr:nth-child(even) {
            background: var(--glass-bg);
        }

        .status {
            padding: 6px 12px;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
            display: inline-block;
        }

        .status.completed {
            background: var(--third-color);
            color: white;
        }

        .status.pending {
            background: var(--red-theme-color);
            color: white;
        }

        .btn {
            text-decoration: none;
            padding: 8px 14px;
            font-size: 14px;
            font-weight: bold;
            border-radius: 5px;
            transition: 0.3s;
            display: inline-block;
        }

        .evaluate-btn {
            background: var(--third-color);
            color: white;
            box-shadow: 0px 4px 6px rgba(255, 89, 0, 0.3);
        }

        .evaluate-btn:hover {
            background: var(--primary-color);
            box-shadow: 0px 6px 10px rgba(255, 89, 0, 0.5);
        }

        .view-btn {
            background: var(--primary-color);
            color: white;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
        }

        .view-btn:hover {
            background: var(--second-color);
            box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.4);
        }

        .floating-submit-btn {
            bottom: 20px;
            right: 20px;
            background: var(--third-color);
            color: white;
            padding: 12px 25px;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: 0.3s;
            box-shadow: 0px 4px 6px rgba(255, 89, 0, 0.4);
        }

        .floating-submit-btn:hover {
            background: var(--primary-color);
            box-shadow: 0px 6px 12px rgba(255, 89, 0, 0.6);
        }
    </style>
@endsection
