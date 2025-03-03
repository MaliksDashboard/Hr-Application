@extends('layouts.master')
@section('title', 'Edit Employee')
@section('custom_title', 'Edit Employee')

<meta name="csrf-token" content="{{ csrf_token() }}">

@section('main')
    <div class="main add-emp">

        <div class="container">
            <form id="updateForm" action="{{ route('employees.update', $employee->id) }}" method="POST"
                enctype="multipart/form-data" class="container">
                @csrf
                @method('PUT')
                <div class="container-title">
                    <p>Edit Form</p>
                    <small>Update the employee's details carefully 👌</small>
                </div>

                <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px; align-items: center;">
                    <div class="input-group">
                        <label for="name">Full Name <b style="color:red;">*</b></label>
                        <input type="text" name="name" id="name" value="{{ old('name', $employee->name) }}"
                            required>
                        @error('name')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div
                        style="display: flex; justify-content: space-between; width: 100%; gap: 20px; align-items: center;">
                        <div class="input-group">
                            <label for="branch">Branch/Department <b style="color:red;">*</b></label>
                            <select name="branch_id" id="branch_id" required>
                                <option value="" disabled>Please Select Branch</option>
                                @foreach ($branches as $branch)
                                    <option value="{{ $branch->id }}"
                                        {{ old('branch_id', $employee->branch_id) == $branch->id ? 'selected' : '' }}>
                                        {{ $branch->branch_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('branch_id')
                                <span class="error-message" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>

                <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px; align-items: center;">

                    <div class="input-group">
                        <label for="title">Title <b style="color:red;">*</b></label>
                        <select id="title" name="title" class="form-control" required>
                            @foreach ($titles as $title)
                                <option value="{{ $title }}"
                                    {{ old('title', $employee->title) == $title ? 'selected' : '' }}>
                                    {{ $title }}
                                </option>
                            @endforeach
                        </select>
                        @error('title')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="job">Job <b style="color:red;">*</b></label>
                        <select id="job" name="job" class="form-control" required>
                            @foreach ($jobs as $job)
                                <option value="{{ $job }}"
                                    {{ old('job', $employee->job) == $job ? 'selected' : '' }}>
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
                                <input type="checkbox" name="status" id="status" value="on"
                                    {{ $employee->status ? 'checked' : '' }}>
                                <p id="status-text">{{ $employee->status ? 'Yes' : 'No' }}</p>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="input-group" id="left-date-group"
                    style="display: {{ !$employee->status ? 'block' : 'none' }};">
                    <label for="left_date">Left Date</label>
                    <input type="date" name="left_date" id="left_date"
                        value="{{ old('left_date', $employee->left_date) }}">
                    @error('left_date')
                        <span class="error-message" style="color:red;">{{ $message }}</span>
                    @enderror
                </div>

                <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px;">

                    <div class="input-group">
                        <label for="date_hired">Date Hired<b style="color:red;">*</b></label>
                        <input type="date" name="date_hired" id="date_hired"
                            value="{{ old('date_hired', $employee->date_hired) }}" required>
                        @error('date_hired')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="pin_code">Pin Code<b style="color:red;">*</b></label>
                        <input type="text" name="pin_code" id="pin_code"
                            value="{{ old('pin_code', $employee->pin_code) }}" required>
                        @error('pin_code')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px;">

                    <div class="input-group">
                        <label for="car">Car</label>
                        <select id="car" name="car" class="form-control" required>
                            <option value="" disabled>Select or type a car...</option>
                            <option value="No" {{ old('car', $employee->car) == 'No' ? 'selected' : '' }}> No</option>
                            <option value="Yes" {{ old('car', $employee->car) == 'Yes' ? 'selected' : '' }}> Yes
                            </option>
                            <option value="Moto" {{ old('car', $employee->car) == 'Moto' ? 'selected' : '' }}> Moto
                            </option>
                            <option value="Both" {{ old('car', $employee->car) == 'Both' ? 'selected' : '' }}> Both
                            </option>
                        </select>
                        @error('car')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="address">Address</label>
                        <input type="text" name="address" id="address"
                            value="{{ old('address', $employee->address) }}">
                        @error('address')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="birthday">Birthday<b style="color:red;">*</b></label>
                        <input type="date" name="birthday" id="birthday"
                            value="{{ old('birthday', $employee->birthday) }}">
                        @error('birthday')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px;">

                    <div class="input-group">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" id="phone"
                            value="{{ old('phone', $employee->phone) }}">
                        @error('phone')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email"
                            value="{{ old('email', $employee->email) }}">
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
                    @if ($employee->image_path)
                        <img src="{{ asset('storage/' . $employee->image_path) }}" alt="Employee Image" width="100">
                    @endif
                    @error('image')
                        <span class="error-message" style="color:red;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="btns">
                    <button type="submit" class="add">Update Record</button>
                    <a href="{{ route('employees.index') }}" class="back">Go Back</a>
                </div>

            </form>
        </div>
    </div>
@endsection

<script>
    function showFileName(input) {
        const fileName = input.files[0]?.name || "No file chosen";
        const fileNameElement = document.getElementById('file-name');
        if (fileNameElement) {
            fileNameElement.textContent = fileName;
        }
    }
    document.addEventListener('DOMContentLoaded', function() {
        // Handle Status Checkbox Toggle
        const statusText = document.getElementById('status-text');
        const checkBox = document.getElementById('status');
        if (statusText && checkBox) {
            const updateStatusText = () => {
                statusText.textContent = checkBox.checked ? 'Yes' : 'No';
            };
            checkBox.addEventListener('change', updateStatusText);
            updateStatusText(); // Initialize on load
        }

        // Initialize Choices.js Dropdowns
        function initializeChoices(selector, options = {}) {
            const element = document.querySelector(selector);
            if (element) {
                return new Choices(element, {
                    removeItemButton: false,
                    addItems: true,
                    duplicateItemsAllowed: false,
                    searchEnabled: true,
                    placeholderValue: 'Please select...',
                    noResultsText: 'No results found',
                    noChoicesText: 'No options available',
                    ...options,
                });
            }
            return null;
        }

        // Initialize Title, Job, and Branch Dropdowns
        initializeChoices('#title', {
            placeholderValue: 'Select a title...'
        });
        initializeChoices('#job', {
            placeholderValue: 'Select a job...'
        });
        initializeChoices('#branch_id', {
            placeholderValue: 'Select a branch...'
        });

        // Toggle Left Date Field
        const statusCheckbox = document.getElementById('status');
        const leftDateGroup = document.getElementById('left-date-group');

        if (statusCheckbox && leftDateGroup) {
            const toggleLeftDateField = () => {
                leftDateGroup.style.display = statusCheckbox.checked ? 'none' : 'block';
            };

            statusCheckbox.addEventListener('change', toggleLeftDateField);
            toggleLeftDateField(); // Initialize on load
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        const statusCheckbox = document.getElementById('status');
        const leftDateGroup = document.getElementById('left-date-group');

        if (statusCheckbox && leftDateGroup) {
            const toggleLeftDateField = () => {
                leftDateGroup.style.display = statusCheckbox.checked ? 'none' : 'block';
            };

            statusCheckbox.addEventListener('change', toggleLeftDateField);
            toggleLeftDateField(); // Initialize on load
        }
    });
</script>
