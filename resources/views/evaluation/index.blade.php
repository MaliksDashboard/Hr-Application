@extends('layouts.master')
@section('title', 'Evaluation Management')
@section('custom_title', 'My Evaluations to do')

@section('main')

    <div class="main">

        <div class="evaluations-header">
            <input type="text" id="search" placeholder="Search Here">
        </div>

        <div class="evaluations-cards">
            @php
                use Carbon\Carbon;

                $currentMonth = Carbon::now()->month;
                $currentYear = Carbon::now()->year;
                $currentDay = Carbon::now()->day;
            @endphp

            @for ($month = 1; $month <= 12; $month++)
                @php
                    $evaluation = $evaluations->where('month', $month)->first();
                    $monthName = date('F', mktime(0, 0, 0, $month, 1));
                    $status = 'disabled';
                    $buttonText = '-';
                    $actionLink = '#';

                    $employeesToEvaluate = \App\Models\User::where('branch_id', Auth::user()->branch_id)->count();
                    $evaluatedEmployees = $evaluation
                        ? \App\Models\EvaluationAnswers::where('evaluation_id', $evaluation->id)
                            ->distinct('employee_id')
                            ->count()
                        : 0;

                    if ($evaluation) {
                        if (
                            $evaluation->year < $currentYear ||
                            ($evaluation->year == $currentYear && $evaluation->month < $currentMonth)
                        ) {
                            // Past month → View button, but may have no records
                            $status = 'view';
                            $buttonText = 'View';
                            $actionLink = $evaluation ? route('evaluation.show', ['month' => $month]) : '#';
                        } elseif ($evaluation->year == $currentYear && $evaluation->month == $currentMonth) {
                            if ($currentDay >= 15 && $currentDay <= 25) {
                                if ($evaluatedEmployees == 0) {
                                    $status = 'start';
                                    $buttonText = 'Start';
                                    $actionLink = route('evaluation.show', ['month' => $month]);
                                } elseif ($evaluatedEmployees > 0 && $evaluatedEmployees < $employeesToEvaluate) {
                                    $status = 'resume';
                                    $buttonText = 'Resume';
                                    $actionLink = route('evaluation.resume', $evaluation->id);
                                } else {
                                    $status = 'view';
                                    $buttonText = 'View';
                                    $actionLink =
                                        !empty($evaluation) && !empty(Auth::user()->id)
                                            ? route('evaluation.show', ['month' => $month])
                                            : '#';
                                }
                            }
                        }
                    } elseif ($month < $currentMonth) {
                        // Past month with no records → Show "No records available" instead of a broken View button
                        $status = 'view';
                        $buttonText = 'View';
                        $actionLink =
                            !empty($evaluation) && !empty($evaluation->id)
                                ? route('evaluation.show', ['month' => $month])
                                : '#';
                    } elseif ($month == $currentMonth) {
                        // Current month with no evaluation yet → Start
                        $status = 'start';
                        $buttonText = 'Start';
                        $actionLink =
                            !empty($evaluation) && !empty($evaluation->id)
                                ? route('evaluation.show', ['month' => $month])
                                : '#';
                    }
                @endphp

                <div class="evaluations-card">
                    <div class="evaluation-card-info">
                        <svg viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="m13.71 4.29-3-3L10 1H4L3 2v12l1 1h9l1-1V5zM13 14H4V2h5v4h4zm-3-9V2l3 3z" />
                        </svg>
                        <p>Evaluation of {{ $monthName }}</p>
                    </div>

                    <p class='progress'>
                        @if ($status == 'view' && !empty($evaluation) && !empty($evaluation->id))
                            <a class="view-evaluation" href="{{ route('evaluation.show', ['month' => $month]) }}">
                                {{ $buttonText }}
                            </a>
                        @else
                            <button class="disabled" disabled>No records available</button>
                        @endif

                    </p>

                    @php
                        Log::info('View Button Debug:', [
                            'evaluation_id' => $evaluation->id ?? 'NULL',
                            'employee_id' => Auth::user()->id ?? 'NULL',
                        ]);
                    @endphp

                    @if ($status == 'start' || $status == 'resume')
                        <form action="{{ route('evaluation.show', ['month' => $month]) }}" method="GET">
                            <button type="submit" class="start-evaluation">{{ $buttonText }}</button>
                        </form>
                    @elseif ($status == 'view')
                        <a class="view-evaluation" href="{{ $actionLink }}">{{ $buttonText }}</a>
                    @else
                        <button class="disabled" disabled>{{ $buttonText }}</button>
                    @endif

                </div>
            @endfor

        </div>

    </div>

@endsection

<style>
    .disabled {
        pointer-events: none;
        opacity: 0.5;
    }
</style>
