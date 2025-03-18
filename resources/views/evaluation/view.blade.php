@extends('layouts.master')

@section('title', 'View Evaluation')

@section('main')
    <div class="main">
        <div class="evaluation-container">
            <h2>Evaluation for <span class="highlight">{{ $employee->name }}</span></h2>

            <table class="evaluation-table">
                <thead>
                    <tr>
                        <th>Question</th>
                        <th>Answer</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($answers as $answer)
                        @if ($answer->question)
                            <tr>
                                <td>{{ $answer->question->question }}</td>
                                <td class="answer-value">{{ $answer->answer }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>

            <a href="{{ route('evaluation.show', ['evaluation_id' => $evaluation->id]) }}" class="btn back-btn">Back</a>
        </div>
    </div>

    <style>
        .evaluation-container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background: var(--bg-white);
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            text-align: center;
        }

        .evaluation-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .evaluation-table th,
        .evaluation-table td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid var(--light-color);
        }

        .evaluation-table th {
            background: var(--primary-color);
            color: white;
        }

        .evaluation-table tr:nth-child(even) {
            background: var(--bg-color);
        }

        .answer-value {
            font-weight: bold;
            color: var(--third-color);
        }

        .back-btn {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            color: white;
            background: var(--primary-color);
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .back-btn:hover {
            background: var(--second-color);
        }
    </style>
@endsection
