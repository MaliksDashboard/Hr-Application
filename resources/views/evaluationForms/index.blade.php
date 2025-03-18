@extends('layouts.master')
@section('title', 'Evaluation Forms')
@section('custom_title', 'Evaluation Forms')

@section('main')

    <div class="main">

        <input type="text" name="search" id="search" placeholder="Search forms..." autocomplete="off">

        <div class="evalulation-forms">
            <a href="{{ url('/evaluation-forms/create') }}" class="add-form">
                <div class="add-form-content">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12 4a1 1 0 0 1 1 1v6h6a1 1 0 1 1 0 2h-6v6a1 1 0 1 1-2 0v-6H5a1 1 0 1 1 0-2h6V5a1 1 0 0 1 1-1" />
                    </svg>
                    <p>New Form</p>
                </div>
            </a>
            @foreach ($evaluationForms as $form)
                <div class="evaluation-form" data-name="{{ strtolower($form->name) }}"
                    data-assigned="{{ strtolower($form->assigned_for) }}">
                    <div class="form-header">
                        {{-- Randomly select one of the available SVGs --}}
                        @php
                            $svgs = [
                                '<svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><path d="M28 8h-7V6a2 2 0 0 0-2-2h-6a2 2 0 0 0-2 2v2H4a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h24a2 2 0 0 0 2-2V10a2 2 0 0 0-2-2M13 6h6v2h-6Zm15 4v9H4v-9ZM4 26v-5h24v5Z"/><path d="M15 18h2a1 1 0 0 0 0-2h-2a1 1 0 0 0 0 2"/></svg>',
                                '<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M2 5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2h-7v2h3a1 1 0 1 1 0 2H8a1 1 0 1 1 0-2h3v-2H4a2 2 0 0 1-2-2zm18 11V5H4v11z"/></svg>',
                                '<svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M219.59 292.5a8 8 0 0 1 0 11.31l-90.05 90.06a8 8 0 1 1-11.31-11.32l90.05-90.05a8 8 0 0 1 11.31 0m208.74 96a8 8 0 0 1-13.33 3.28l-27.15-27.15-14.75 14.76 27.16 27.17a8 8 0 0 1-3.32 13.3 51.5 51.5 0 0 1-15.08 2.21c-15.64 0-31.77-6.7-43.91-18.84-11.61-11.61-18.35-26.77-18.82-42.06l-52.38-52.39a8 8 0 0 1-1.77-1.33l-5.57-5.57a43.9 43.9 0 0 1-11.05 18.41l-97.47 97.47a43.34 43.34 0 0 1-29.17 12.84h-1.5a38.5 38.5 0 0 1-27.56-11.22c-15.59-15.59-14.85-41.71 1.66-58.22l97.47-97.47a44 44 0 0 1 18.4-11.05l-5.55-5.55a8 8 0 0 1-1.33-1.77l-52.55-52.56c-15.28-.46-30.43-7.2-42-18.81-16.11-16.13-22.64-39.27-16.64-59a8 8 0 0 1 13.31-3.32l27.16 27.15 14.76-14.77-27.2-27.1a8 8 0 0 1 3.32-13.31c19.71-6 42.87.51 59 16.63 11.62 11.61 18.36 26.77 18.83 42.07l70 70 107.81-107.88A7.7 7.7 0 0 1 381 103l37.3-20a8 8 0 0 1 10.83 10.8l-20.08 37.3a8 8 0 0 1-1.39 1.87L299.81 240.82l69.85 69.85c15.28.46 30.42 7.2 42 18.81 16.15 16.13 22.67 39.28 16.67 58.98Z"/></svg>',
                                '<svg viewBox="0 0 15 15" xmlns="http://www.w3.org/2000/svg"><path d="M8.5 8.149v3.601a1 1 0 0 1-2 0V8.149a5.01 5.01 0 0 1-4-4.899 1 1 0 0 1 2 0 3 3 0 0 0 6 0 1 1 0 0 1 2 0 5.01 5.01 0 0 1-4 4.899"/></svg>',
                            ];
                            $randomSvg = $svgs[array_rand($svgs)];
                        @endphp

                        {{-- Render the SVG properly --}}
                        {!! $randomSvg !!}

                        <div class="form-action">
                            <a href="javascript:void(0);" class="delete-btn" data-id="{{ $form->id }}">Delete</a>
                            <a href="{{ route('evaluation-forms.edit', $form->id) }}">Edit</a>
                        </div>
                    </div>

                    <div class="form-info">
                        <b>{{ $form->name }}</b>
                        <small>Assigned By: {{ $form->assigned_for }}</small>
                    </div>

                    <div class="form-footer">
                        <div class="form-time">
                            <p>{{ $form->created_at->format('d-m-Y h:i A') }}</p>
                        </div>

                        <div class="form-questions-no">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28.621 28.621">
                                <path
                                    d="M14.311 0c-6.904 0-12.5 5.596-12.5 12.5 0 4.723 2.618 8.828 6.48 10.955l-.147 5.166 5.898-3.635c.089.002.178.014.269.014 6.904 0 12.5-5.596 12.5-12.5S21.215 0 14.311 0m-.561 20.018c-1.116 0-1.876-.822-1.876-1.918 0-1.119.779-1.92 1.876-1.92 1.14 0 1.878.801 1.898 1.92.001 1.093-.757 1.918-1.898 1.918m2.551-7.845c-.779.865-1.096 1.686-1.074 2.638v.377h-2.805l-.022-.547c-.063-1.074.295-2.173 1.246-3.31.673-.803 1.223-1.477 1.223-2.194 0-.737-.487-1.222-1.542-1.263-.693 0-1.539.251-2.084.632l-.718-2.301c.759-.442 2.022-.861 3.52-.861 2.785 0 4.048 1.538 4.048 3.289.001 1.6-.989 2.654-1.792 3.54" />
                            </svg>
                            <p>{{ $form->questions_count }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
            <form id="delete-form" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
        </div>

    </div>

@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".delete-btn").forEach(button => {
            button.addEventListener("click", function() {
                let formId = this.dataset.id;
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        let form = document.getElementById("delete-form");
                        form.action = `/evaluation-forms/${formId}`;
                        form.submit();
                    }
                });
            });
        });

        document.getElementById('search').addEventListener('keyup', function() {
            let query = this.value.toLowerCase().trim();
            let forms = document.querySelectorAll('.evaluation-form');

            forms.forEach(form => {
                let name = form.getAttribute('data-name');
                let assigned = form.getAttribute('data-assigned');

                if (name.includes(query) || assigned.includes(query)) {
                    form.style.display = "block"; // Show matching forms
                } else {
                    form.style.display = "none"; // Hide non-matching forms
                }
            });
        });
    });
</script>
