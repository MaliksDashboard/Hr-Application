@extends('layouts.master')
@section('title', 'Add Employee')


@section('main')
    <div class="main add-emp">
        <h1>Add Employee</h1>

        <div class="container">
            <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data" class="container">
                @csrf
                <div class="container-title">
                    <p>Basic Form</p>
                    <small>Make sure you know what you are doing 👌</small>
                </div>

                <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px;">
                    <div class="input-group">
                        <label for="name">Full Name <b style="color:red;">*</b></label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required>
                        @error('name')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="input-group">
                        <label for="branch_id">Branch/Department <b style="color:red;">*</b></label>
                        <select class="form-control" name="branch_id" id="branch_id" required>
                            <option value="" disabled selected>Please Select Branch</option>
                            @foreach ($branches as $branch)
                                <option value="{{ $branch->id }}" {{ old('branch_id') == $branch->id ? 'selected' : '' }}>
                                    {{ $branch->branch_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('branch_id')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px;">

                    <div class="input-group">
                        <label for="title">Title <b style="color:red;">*</b></label>
                        <select id="title" name="title" class="form-control" required>
                            @foreach ($titles as $title)
                                <option value="{{ $title }}">{{ $title }}</option>
                            @endforeach
                        </select>
                        @error('title')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="job">Job <b style="color:red;">*</b></label>
                        <select id="job" name="job" class="form-control" required>
                            <option value="" disabled selected>Select or type a job...</option> <!-- Placeholder -->
                            @foreach ($jobs as $job)
                                <option value="{{ $job }}" {{ old('job') == $job ? 'selected' : '' }}>
                                    {{ $job }}
                                </option>
                            @endforeach
                        </select>

                        @error('job')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <div class="toggle-group">
                            <label for="status">Working with US? <b style="color:red;">*</b></label>
                            <div
                                style="display: flex; justify-content: center; align-items: center; gap: 10px; font-size: 14px; color: var(--second-color);">
                                <input type="hidden" name="status" value="off">
                                <input type="checkbox" name="status" id="status" value="on">
                                <p id="status-text">Yes</p>
                            </div>
                        </div>
                    </div>

                </div>

                <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px;">

                    <div class="input-group">
                        <label for="date_hired">Date Hired<b style="color:red;">*</b></label>
                        <input type="date" name="date_hired" id="date_hired" value="{{ old('date_hired') }}" required>
                        @error('date_hired')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="pin_code">Pin Code<b style="color:red;">*</b></label>
                        <input type="text" name="pin_code" id="pin_code" value="{{ old('pin_code') }}" required>
                        @error('pin_code')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px;">

                    <div class="input-group">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}">
                        @error('phone')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}">
                        @error('email')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="images-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image" onchange="showFileName(this)">
                    <div style="display: flex; justify-content: center; align-items: center; gap: 10px;">
                        <div class="custom-upload">Choose File</div>
                        <div class="file-name" id="file-name">No file chosen</div>
                    </div>
                    @error('image')
                        <span class="error-message" style="color:red;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="btns">
                    <button type="submit" class="add">Add Record</button>
                    <button type="reset" class="clear">Clear</button>
                    <a href="{{ route('employees.index') }}" class="back">Go Back</a>
                </div>

            </form>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', () => {

        //check box status
        const statusText = document.getElementById('status-text');
        const checkBox = document.getElementById('status');

        if (!statusText || !checkBox) {
            console.error('Elements not found!');
            return;
        }

        checkBox.addEventListener('change', () => {
            if (checkBox.checked) {
                statusText.textContent = 'Yes';
            } else {
                statusText.textContent = 'No';
            }
        });

        if (checkBox.checked) {
            statusText.textContent = 'Yes';
        } else {
            statusText.textContent = 'No';
        }

        // Initialize Choices.js for the select element
        const branchInput = new Choices('#branch_id', {
            removeItemButton: false,
            addItems: true,
            duplicateItemsAllowed: false,
            searchEnabled: true,
            placeholderValue: 'Select a branch...',
            noResultsText: 'No results found',
            noChoicesText: 'No choices available',
            addItemFilter: function(value) {
                return value.trim() !== ''; // Prevent adding empty items
            },
        });



        // Attach event listener to Choices.js instance
        branchInput.passedElement.element.addEventListener('addItem', function(event) {
            console.log('Item added:', event.detail.value);
        });

        $(document).ready(function() {
            // Initialize Selectize for the #job field
            const selectize = $('#job').selectize({
                create: true, // Allow user to create new options
                sortField: 'text',
                placeholder: 'Select or type a job...', // Correct way to set placeholder
                maxItems: 1,
            });

            // Ensure the placeholder works correctly
            if (!selectize[0].selectize.getValue()) {
                selectize[0].selectize.$control_input.attr('placeholder', 'Select or type a job...');
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const titleDropdown = document.getElementById('title');
        if (titleDropdown) {
            console.log('Initializing Choices.js for title dropdown');
            new Choices(titleDropdown, {
                removeItemButton: false,
                addItems: true,
                duplicateItemsAllowed: false,
                searchEnabled: true,
                placeholderValue: 'Select a title...',
                noResultsText: 'No results found',
                noChoicesText: 'No titles available',
            });
        } else {
            console.error('Title dropdown (#title) not found in the DOM.');
        }
    });

    function showFileName(input) {
        const fileName = input.files[0]?.name || "No file chosen";
        document.getElementById('file-name').textContent = fileName;
    }
</script>
