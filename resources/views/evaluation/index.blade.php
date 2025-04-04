@extends('layouts.master')
@section('title', 'Evaluation Management')

@section('main')

    <div class="main">
        <h2 class="evaluation-title">Evaluations for {{ $currentYear }}</h2>

        <div class="evaluation-table-wrapper">
            <table class="evaluation-table">
                <thead>
                    <tr>
                        <th>Month</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php use Carbon\Carbon; @endphp

                    @for ($month = 1; $month <= 12; $month++)
                        @php
                            $evaluation = $evaluations->get($month);
                            $monthName = date('F', mktime(0, 0, 0, $month, 1));
                            $status = 'Not Started';
                            $buttonText = null;
                            $actionLink = '#';
                            $buttonClass = 'evaluation-btn-disabled';

                            if ($month < $currentMonth) {
                                // ✅ Past month → Always View
                                $status =
                                    $evaluation && $evaluation->total_score !== null ? 'Completed' : 'In Progress';
                                $buttonText = 'View';
                                $buttonClass = 'evaluation-btn-view';
                                $actionLink = route('evaluation.show', ['month' => $month]);
                            } elseif ($month == $currentMonth && $currentDay >= 15 && $currentDay <= 30) {
                                // ✅ Current month (15-25)
                                if ($evaluation) {
                                    if ($evaluation->total_score !== null) {
                                        $status = 'Completed';
                                        $buttonText = 'View';
                                        $buttonClass = 'evaluation-btn-view';
                                        $actionLink = route('evaluation.show', ['month' => $month]);
                                    } else {
                                        $status = 'In Progress';
                                        $buttonText = 'Continue';
                                        $buttonClass = 'evaluation-btn-start';
                                        $actionLink = route('evaluation.show', ['month' => $month]);
                                    }
                                } else {
                                    $status = 'Not Started';
                                    $buttonText = 'Start';
                                    $buttonClass = 'evaluation-btn-start';
                                    $actionLink = route('evaluation.show', ['month' => $month]);
                                }
                            } else {
                                // ❌ Future or current month outside allowed range
                                $status = 'Locked';
                                $buttonText = 'Locked';
                                $buttonClass = 'evaluation-btn-disabled';
                            }
                        @endphp

                        <tr>
                            <td>{{ $monthName }}</td>
                            <td>
                                <span
                                    class="evaluation-status {{ strtolower(str_replace(' ', '-', $status)) }}">{{ $status }}</span>
                            </td>
                            <td>
                                <a href="{{ $actionLink }}"
                                    class="evaluation-btn {{ $buttonClass }}">{{ $buttonText }}</a>
                            </td>
                        </tr>
                    @endfor

                </tbody>
            </table>
        </div>
    </div>

@endsection

<style>
    /* Container Styles */
    .evaluation-container {
        max-width: 850px;
        margin: 40px auto;
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .evaluation-title {
        text-align: center;
        font-size: 22px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    /* Table Wrapper */
    .evaluation-table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    /* Table Styles */
    .evaluation-table {
        width: 100%;
        border-collapse: collapse;
        background: #f8f9fa;
        border-radius: 10px;
        overflow: hidden;
    }

    .evaluation-table th,
    .evaluation-table td {
        padding: 12px 15px;
        text-align: center;
        border-bottom: 1px solid #ddd;
    }

    .evaluation-table th {
        background: #007bff;
        text-transform: uppercase;
        font-size: 14px;
    }

    .evaluation-table tr:last-child td {
        border-bottom: none;
    }

    /* Status Column */
    .evaluation-status {
        padding: 6px 12px;
        border-radius: 5px;
        font-weight: bold;
        text-transform: capitalize;
    }

    .not-started {
        background: #f8d7da;
        color: #721c24;
    }

    .in-progress {
        background: #fff3cd;
        color: #856404;
    }

    .completed {
        background: #d4edda;
        color: #155724;
    }

    /* Buttons */
    .evaluation-btn {
        display: inline-block;
        padding: 8px 14px;
        border-radius: 6px;
        font-size: 14px;
        font-weight: bold;
        text-transform: uppercase;
        text-decoration: none;
        transition: 0.3s ease;
    }

    .evaluation-btn-start {
        background: #28a745;
        color: white;
    }

    .evaluation-btn-view {
        background: #007bff;
        color: white;
    }

    .evaluation-btn-disabled {
        background: #ccc;
        color: #666;
        cursor: not-allowed;
    }

    .evaluation-btn:hover:not(.evaluation-btn-disabled) {
        opacity: 0.85;
    }
</style>
