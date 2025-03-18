@extends('layouts.master')
@section('title', 'Start Evaluation')

@section('main')

    <div class="main">
        <div class="evaluation-container">
            <h2>Evaluation for {{ date('F', mktime(0, 0, 0, $evaluation->month, 1)) }} - {{ $evaluation->form->name }}</h2>

            <form action="{{ route('evaluation.submit', $evaluation->id) }}" method="POST">
                @csrf

                @foreach ($questions as $question)
                    <div class="question">
                        <p>{{ $question->question }}</p>
                        <select name="answers[{{ $question->id }}]" required>
                            <option value="">Select a score</option>
                            <option value="1">1 - Poor</option>
                            <option value="2">2 - Average</option>
                            <option value="3">3 - Good</option>
                            <option value="4">4 - Excellent</option>
                        </select>
                    </div>
                @endforeach

                <button type="submit" class="submit-evaluation">Submit Evaluation</button>
            </form>
        </div>
    </div>

@endsection
