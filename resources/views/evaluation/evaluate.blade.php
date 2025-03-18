@extends('layouts.master')

@section('title', 'Evaluate Employee')

@section('main')
    <div class="main">
        <div class="evaluation-container">
            <h2>Evaluation for <span class="highlight">{{ $employee->name }}</span></h2>

            <form
                action="{{ route('evaluation.submit', ['evaluation_id' => $evaluation->id, 'employee_id' => $employee->id]) }}"
                method="POST" id="evaluationForm">
                @csrf

                <div class="questions-container">
                    @foreach ($questions->chunk(2) as $questionPair)
                        <div class="question-row">
                            @foreach ($questionPair as $question)
                                <div class="question-card">
                                    <p class="question-text">{{ $question->question }}</p>
                                    <div class="options">
                                        @for ($i = 1; $i <= 4; $i++)
                                            <label class="option-label">
                                                <input type="radio" name="answers[{{ $question->id }}]"
                                                    value="{{ $i }}" class="answer-input" required>
                                                <span class="option-circle">{{ $i }}</span>
                                            </label>
                                        @endfor
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>

                <div class="score-container">
                    <p>Total Score: <span id="totalScore">0</span> / 100</p>
                </div>

                <button type="submit" id="submitBtn" disabled>Submit Evaluation</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById("evaluationForm");
            const totalScoreDisplay = document.getElementById("totalScore");
            const submitBtn = document.getElementById("submitBtn");

            function calculateScore() {
                let total = 0;
                let answeredQuestions = 0;
                const allInputs = document.querySelectorAll(".answer-input:checked");

                allInputs.forEach(input => {
                    total += parseInt(input.value);
                    answeredQuestions++;
                });

                // Convert score to percentage over 100
                let maxScore = {{ count($questions) }} * 4;
                let normalizedScore = (total / maxScore) * 100;
                totalScoreDisplay.textContent = normalizedScore.toFixed(1);

                // Enable submit button only if all questions are answered
                submitBtn.disabled = allInputs.length < {{ count($questions) }};
            }

            document.querySelectorAll(".answer-input").forEach(input => {
                input.addEventListener("change", calculateScore);
            });
        });
    </script>

    <style>
        .main {
            align-items: center;
        }

        .evaluation-container {
            max-width: 800px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
            background: #fff;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            text-align: center;
            margin-top: 40px;
        }

        h2 {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .highlight {
            color: var(--third-color);
            font-weight: bold;
        }

        .questions-container {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .question-row {
            display: flex;
            gap: 20px;
            justify-content: space-between;
        }

        .question-card {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            text-align: left;
            width: 48%;
        }

        .question-text {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .options {
            display: flex;
            gap: 15px;
            justify-content: center;
        }

        .option-label {
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .option-circle {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #ddd;
            border-radius: 50%;
            font-size: 18px;
            font-weight: bold;
            transition: 0.3s;
        }

        .answer-input {
            display: none;
        }

        .answer-input:checked+.option-circle {
            background: var(--third-color);
            color: white;
            transform: scale(1.1);
        }

        .score-container {
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }

        #submitBtn {
            margin-top: 20px;
            padding: 12px 25px;
            font-size: 18px;
            font-weight: bold;
            color: white;
            background: var(--third-color);
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
            opacity: 0.5;
        }

        #submitBtn:not(:disabled) {
            opacity: 1;
            transform: scale(1.05);
        }

        #submitBtn:hover {
            filter: brightness(0.9)
        }
    </style>
@endsection
