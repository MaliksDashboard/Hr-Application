@php
    $nameParts = explode(' ', $employee->name);
    $initials = strtoupper(substr($nameParts[0], 0, 1) . (isset($nameParts[1]) ? substr($nameParts[1], 0, 1) : ''));
@endphp

@if ($employee->id != auth()->id())
    <div class="employee-card" data-name="{{ strtolower($employee->name) }}">
        <div class="employee-info">
            <div class="avatar-circle">
                {{ $initials }}
            </div>
            <h3>
                {{ $employee->name }}

                @if ($employee->evaluation && $employee->evaluation->total_score !== null)
                    <span class="tag tag-success">Completed
                    </span>
                @else
                    <span class="tag tag-pending">Pending</span>
                @endif
            </h3>

            @if ($employee->evaluation && $employee->evaluation->total_score !== null)
                <div class="progress-bar-container">
                    <div class="progress-bar-fill" style="width: {{ round($employee->evaluation->total_score) }}%">
                    </div>
                </div>
                <small>
                    {{ round($employee->evaluation->total_score) }}%
                </small>
            @endif



            <p style="margin-top: 5px" class="employee-job">{{ $employee->jobRelation->name }} -
                {{ $employee->employee->branch->branch_name }}
            </p>
        </div>

        @php
            $canEvaluate = $currentMonth == $month && $currentDay >= 15 && $currentDay <= 30;
        @endphp

        @if ($canEvaluate)
            @if ($employee->evaluation)
                <a href="{{ route('evaluation.editScore', [
                    'evaluation_id' => $employee->evaluation->id,
                    'employee_id' => $employee->id,
                ]) }}"
                    class="evaluation-btn evaluate-btn">Edit</a>
            @else
                <a href="{{ route('evaluation.evaluate', [
                    'month' => $month,
                    'employee_id' => $employee->id,
                    'assigned_for' => $employee->assigned_for ?? 'Branch Manager',
                ]) }}"
                    class="evaluation-btn evaluate-btn">
                    Evaluate
                </a>
            @endif
        @else
            <a href="{{ route('evaluation.view', [
                'month' => $month,
                'employee_id' => $employee->id,
                'assigned_for' => $employee->assigned_for ?? 'Branch Manager',
            ]) }}"
                class="evaluation-btn evaluate-btn">
                View
            </a>
        @endif

    </div>
@endif


<style>
    .tag {
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        margin-left: 8px;
    }

    .tag-success {
        background: #d4edda;
        color: #155724;
    }

    .tag-pending {
        background: #ffe0e0;
        color: #b10000;
    }

    .avatar-circle {
        width: 38px;
        height: 38px;
        background-color: #e2e6ea;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 16px;
        color: #333;
        margin-right: 12px;
    }

    .progress-bar-container {
        background: #e0e0e0;
        height: 6px;
        border-radius: 4px;
        width: 100px;
        overflow: hidden;
    }

    .progress-bar-fill {
        background: #28a745;
        /* Green color */
        height: 100%;
        border-radius: 4px;
        transition: width 0.3s ease;
    }
</style>
