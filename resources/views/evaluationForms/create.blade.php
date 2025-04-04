@extends('layouts.master')
@section('title', 'Create Evaluation Form')
@section('custom_title', ' Create New Form')

@section('main')

    <div class="main add-emp">

        <div class="container">
            <form action="{{ route('evaluation-forms.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="container-title">
                    <p>Basic Form</p>
                    <small>Make sure you know what you are doing 👌</small>
                </div>
                <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px;">

                    <div class="input-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required>
                        @error('name')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="assigned_for">Made By</label>
                        <select name="assigned_for" id="assigned_for">
                            @foreach ($roles as $role)
                                <option value="{{ $role }}" {{ old('assigned_for') == $role ? 'selected' : '' }}>
                                    {{ $role }}
                                </option>
                            @endforeach
                        </select>
                        @error('assigned_for')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>


                </div>

                <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px;">

                    <div class="input-group">
                        <label for="dept_id">Department</label>
                        <select name="dept_id" id="dept_id">
                            <option value="" {{ old('dept_id') }} selected>None
                            </option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}"
                                    {{ old('dept_id') == $department->id ? 'selected' : '' }}>
                                    {{ $department->name }}</option>
                            @endforeach
                        </select>
                        @error('dept_id')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="job">Job</label>
                        <select name="job" id="job">

                            @foreach ($jobs as $job)
                                <option value="{{ $job->id }}" {{ old('job') == $job->id ? 'selected' : '' }}>
                                    {{ $job->name }}</option>
                            @endforeach
                        </select>
                        @error('job')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px;">
                    <div class="input-group">
                        <label for="questions">Question</label>
                        <div id="question-container">
                            <div class="question-form">
                                <input type="text" name="question[]" class="question">
                                <button type="button" class="add-question">
                                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M12 4a1 1 0 0 1 1 1v6h6a1 1 0 1 1 0 2h-6v6a1 1 0 1 1-2 0v-6H5a1 1 0 1 1 0-2h6V5a1 1 0 0 1 1-1" />
                                    </svg>
                                </button>
                                <button type="button" class="remove-question" style="display: none;">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" xml:space="preserve">
                                        <path
                                            d="M84.707 68.752 65.951 49.998l18.75-18.752a1.99 1.99 0 0 0 0-2.813L71.566 15.295a1.99 1.99 0 0 0-2.814 0L49.999 34.047l-18.75-18.752c-.746-.747-2.067-.747-2.814 0L15.297 28.431a1.99 1.99 0 0 0 0 2.814L34.05 49.998 15.294 68.753a1.993 1.993 0 0 0 0 2.814L28.43 84.704a1.99 1.99 0 0 0 2.814 0l18.755-18.755 18.756 18.754c.389.388.896.583 1.407.583s1.019-.195 1.408-.583l13.138-13.137a1.99 1.99 0 0 0-.001-2.814" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="btns">
                    <button type="submit" class="add">Add Record</button>
                    <button type="reset" class="clear">Clear</button>
                    <a href="{{ route('evaluation-forms.index') }}" class="back">Go Back</a>
                </div>
            </form>
        </div>

    </div>

@endsection

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const selectDepartment = new Choices('#dept_id', {
            removeItemButton: false,
            addItems: true,
            duplicateItemsAllowed: false,
            searchEnabled: true,
            placeholderValue: 'Select a department...',
            noResultsText: 'No results found',
            noChoicesText: 'No choices available',
            addItemFilter: function(value) {
                return value.trim() !== ''; // Prevent adding empty items
            },
        })

        const selectJob = new Choices('#job', {
            removeItemButton: false,
            addItems: true,
            duplicateItemsAllowed: false,
            searchEnabled: true,
            placeholderValue: 'Select a job...',
            noResultsText: 'No results found',
            noChoicesText: 'No choices available',
            addItemFilter: function(value) {
                return value.trim() !== ''; // Prevent adding empty items
            },
        })
    })

    document.addEventListener("DOMContentLoaded", function() {
        const container = document.querySelector("#question-container");

        // Function to toggle delete button visibility
        function updateDeleteButtons() {
            let questionForms = document.querySelectorAll(".question-form");
            let removeButtons = document.querySelectorAll(".remove-question");

            if (questionForms.length > 1) {
                removeButtons.forEach(button => button.style.display = "inline-block");
            } else {
                removeButtons.forEach(button => button.style.display = "none");
            }
        }

        // Add new question field
        container.addEventListener("click", function(e) {
            if (e.target.closest(".add-question")) {
                let newQuestion = document.querySelector(".question-form").cloneNode(true);

                // Clear input field in the cloned element
                newQuestion.querySelector("input").value = "";

                // Append the new cloned element
                container.appendChild(newQuestion);

                // Update delete button visibility
                updateDeleteButtons();
            }
        });

        // Remove question field
        container.addEventListener("click", function(e) {
            if (e.target.closest(".remove-question")) {
                let questionForm = e.target.closest(".question-form");

                // Remove only if there are more than one question
                if (document.querySelectorAll(".question-form").length > 1) {
                    questionForm.remove();
                }

                // Update delete button visibility
                updateDeleteButtons();
            }
        });

        // Initial check for delete button visibility
        updateDeleteButtons();
    });
</script>

<style>
    .add-emp .container form {
        gap: 25px;

    }
</style>
