@extends('layouts.master')
@section('title', 'Edit Evaluation for ' . $employee->name)

@section('main')
    <div class="main">
        <div class="evaluation-wrapper">
            <div class="evaluation-container">
                <h2 class="evaluation-title">Editing Evaluation for {{ $employee->name }}</h2>

                <div class="employee-info">
                    <div class="avatar">
                        <img src="{{ asset('storage/' . $employee->image) }}" alt="">
                    </div>
                    <h3 class="employee-name">{{ $employee->name }}</h3>
                    <p class="employee-job">{{ $employee->jobRelation->name ?? 'Unknown Position' }}</p>
                    <div id="score-display" style="margin-top: 20px; font-weight: bold; font-size: 18px;">
                        Total Score: <span id="score">0</span>/100
                    </div>
                    <div id="grading-label" style="margin-top: 5px; font-size: 14px;"></div>
                </div>

                <form method="POST"
                    action="{{ route('evaluation.updateScore', ['evaluation_id' => $evaluation->id, 'employee_id' => $employee->id]) }}">
                    @csrf
                    @method('PUT')

                    <div class="question-list">
                        @foreach ($questions as $question)
                            @php
                                $storedAnswer = $answers[$question->id] ?? null;
                            @endphp

                            <div class="question-card">
                                <p class="question-text">{{ $question->question }}</p>
                                <div class="rating-options">
                                    @foreach (range(0, 4) as $value)
                                        <label class="rating-circle">
                                            <input type="radio" name="answers[{{ $question->id }}]"
                                                value="{{ $value }}" {{ $storedAnswer == $value ? 'checked' : '' }}
                                                required>
                                            <span>{{ $value }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="buttons">
                        @if ($prevEmployee && $prevEmployee->evaluation)
                            <a href="{{ route('evaluation.editScore', ['evaluation_id' => $prevEmployee->evaluation->id, 'employee_id' => $prevEmployee->id]) }}"
                                class="evaluation-btn prev-btn"><svg viewBox="-8.5 0 32 32"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15.281 7.188v17.594L0 16.001z" />
                                </svg></a>
                        @endif

                        <button type="submit" class="evaluation-btn submit-btn">Update</button>

                        @if ($nextEmployee && $nextEmployee->evaluation)
                            <a href="{{ route('evaluation.editScore', ['evaluation_id' => $nextEmployee->evaluation->id, 'employee_id' => $nextEmployee->id]) }}"
                                class=" next-btn"><svg viewBox="0 0 24 24" data-name="Flat Color"
                                    xmlns="http://www.w3.org/2000/svg" class="icon flat-color">
                                    <path
                                        d="m18.6 11.2-12-9A1 1 0 0 0 5 3v18a1 1 0 0 0 .55.89 1 1 0 0 0 1-.09l12-9a1 1 0 0 0 0-1.6Z"
                                        style="fill:#fff" />
                                </svg></a>
                        @endif

                        <a href="{{ route('evaluation.show', ['month' => $month]) }}" class=" prev-btn">Back</a>
                    </div>


                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const radios = document.querySelectorAll('input[type="radio"]');
            const scoreEl = document.getElementById('score');
            const gradeEl = document.getElementById('grading-label');
            const totalQuestions = {{ $questions->count() }};
            const maxPerQuestion = 4;

            function calculateScore() {
                let totalScore = 0;
                document.querySelectorAll('input[type="radio"]:checked').forEach(radio => {
                    totalScore += parseInt(radio.value);
                });

                const normalized = ((totalScore / (totalQuestions * maxPerQuestion)) * 100).toFixed(2);
                scoreEl.textContent = normalized;

                if (normalized >= 90) gradeEl.textContent = 'Excellent';
                else if (normalized >= 70) gradeEl.textContent = 'Good';
                else gradeEl.textContent = 'Needs Improvement';
            }

            radios.forEach(radio => {
                radio.addEventListener('change', calculateScore);
            });

            calculateScore(); // on load
        });
    </script>
@endsection

<style>
    /* Page Wrapper */
    .evaluation-wrapper {
        display: flex;
        justify-content: center;
        padding: 20px;
    }

    /* Evaluation Box */
    .evaluation-container {
        max-width: 900px;
        width: 100%;
        background: #fff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .evaluation-title {
        font-size: 22px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    /* Employee Info */
    .employee-info {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 25px;
    }

    .avatar {
        width: 80px;
        height: 80px;
        background: white;
        color: white;
        font-size: 32px;
        font-weight: bold;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        margin-bottom: 10px;
    }

    .employee-name {
        font-size: 18px;
        font-weight: bold;
        margin: 5px 0;
    }

    .employee-job {
        font-size: 14px;
        color: #666;
    }

    /* Questions */
    .question-list {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .question-card {
        background: #f8f9fa;
        padding: 15px;
        min-width: 400px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .question-text {
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    /* Rating Circles */
    .rating-options {
        display: flex;
        justify-content: center;
        gap: 15px;
    }

    .rating-circle {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #ddd;
        color: #333;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        transition: 0.3s ease;
        position: relative;
    }

    .rating-circle input {
        position: absolute;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
    }

    .rating-circle span {
        position: relative;
        z-index: 2;
    }

    .rating-circle:hover {
        background: var(--third-color);
        color: white;
    }

    .rating-circle input:checked+span {
        background: var(--third-color);
        color: white;
        border-radius: 50%;
        padding: 8px 12px;
    }

    /* Buttons */
    .buttons {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 20px;
        margin-top: 20px;
    }

    .evaluation-btn {
        padding: 10px 16px;
        border-radius: 6px;
        font-size: 14px;
        font-weight: bold;
        text-transform: uppercase;
        text-decoration: none;
        transition: 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .submit-btn {
        background: var(--third-color);
        color: white;
    }

    .submit-btn:hover {
        filter: brightness(.9)
    }

    .prev-btn {
        background: #0974e0;
        color: white;
        fill: white;
        padding: 5px;
        border-radius: 5px;
    }

    .next-btn {
        background: #28a745;
        color: white;
        fill: white;
        padding: 5px;
        border-radius: 5px;
    }

    .prev-btn:hover {
        filter: brightness(.9)
    }

    .next-btn:hover {
        filter: brightness(.9)
    }
</style>
