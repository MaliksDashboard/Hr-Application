@extends('layouts.master')
@section('title', 'Edit Vacancy')
@section('custom_title', 'Edit Vacancy')

@section('main')
    <div class="main add-emp edit-vacancy add-vacancy">

        <div class="container">
            <form action="{{ route('vacancies.update', $vacancy->id) }}" method="POST" enctype="multipart/form-data"
                class="container">
                @csrf
                @method('PUT')

                <div class="container-title">
                    <p>Edit Vacancy Form</p>
                    <small>Make sure to fill out all fields carefully 👌</small>
                </div>

                <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px;">
                    <div class="input-group">
                        <label for="name">Branch Name <b style="color:red;">*</b></label>
                        <select class="form-control" name="name" id="name" required>
                            @foreach ($branches as $branch)
                                <option value="{{ $branch->id }}"
                                    {{ $vacancy->branch_id == $branch->id ? 'selected' : '' }}>
                                    {{ $branch->branch_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('name')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="job">Job <b style="color:red;">*</b></label>
                        <select id="job" name="job" class="form-control">
                            @foreach ($jobs as $jobOption)
                                <option value="{{ $jobOption }}" {{ $vacancy->job === $jobOption ? 'selected' : '' }}>
                                    {{ $jobOption }}
                                </option>
                            @endforeach
                        </select>

                        @error('job')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px;">
                    <div class="input-group">
                        <label for="asked_date">Asked Date<b style="color:red;">*</b></label>
                        <input type="date" name="asked_date" id="asked_date" value="{{ $vacancy->asked_date }}" required>
                        @error('asked_date')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="status">Priority <b style="color:red;">*</b></label>
                        <select id="status" name="status" class="form-control" required>
                            <option value="low" {{ $vacancy->status == 'low' ? 'selected' : '' }}>Low</option>
                            <option value="medium" {{ $vacancy->status == 'medium' ? 'selected' : '' }}>Medium</option>
                            <option value="high" {{ $vacancy->status == 'high' ? 'selected' : '' }}>High</option>
                        </select>
                        @error('status')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="shift">Shift<b style="color:red;">*</b></label>
                        <select id="shift" name="shift" class="form-control" required>
                            <option value="Full Time" {{ $vacancy->shift == 'Full Time' ? 'selected' : '' }}>Full Time
                            </option>
                            <option value="Part Time" {{ $vacancy->shift == 'Part Time' ? 'selected' : '' }}>Part Time
                            </option>
                        </select>
                        @error('shift')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px;">

                    <div class="input-group">
                        <label for="shift">Shift<b style="color:red;">*</b></label>
                        <select id="shift" name="shift" class="form-control" required>
                            <option value="Full Time" {{ $vacancy->shift == 'Full Time' ? 'selected' : '' }}>Full Time
                            </option>
                            <option value="Part Time" {{ $vacancy->shift == 'Part Time' ? 'selected' : '' }}>Part Time
                            </option>
                        </select>
                        @error('shift')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="input-group">
                        <label for="area">Area<b style="color:red;">*</b></label>
                        <select id="area" name="area" class="form-control" required>
                            <option value="" {{ $vacancy->area == '' ? 'selected' : '' }}>Select Area
                            <option value="Shar2iye" {{ $vacancy->area == 'Shar2iye' ? 'selected' : '' }}>Shar2iye
                            </option>
                            <option value="Gharbiye" {{ $vacancy->area == 'Gharbiye' ? 'selected' : '' }}>Gharbiye
                            </option>
                        </select>
                        @error('area')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px;">
                    <div class="input-group">
                        <label for="is_finished">Is Finished<b style="color:red;">*</b></label>
                        <select id="is_finished" name="is_finished" class="form-control" required>
                            <option value="0" {{ !$vacancy->is_finished ? 'selected' : '' }}>No</option>
                            <option value="1" {{ $vacancy->is_finished ? 'selected' : '' }}>Yes</option>
                        </select>
                        @error('is_finished')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="employee_id">Assigned Employee<b style="color:red;">*</b></label>
                        <select id="employee_id" name="employee_id" class="form-control" required>
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}"
                                    {{ $vacancy->employee_id == $employee->id ? 'selected' : '' }}>
                                    {{ $employee->name }} - {{ $employee->branch_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('employee_id')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="input-group">
                    <label for="remarks">Remarks</label>
                    <textarea name="remarks" id="remarks" class="form-control" rows="4">{{ $vacancy->remarks }}</textarea>
                    @error('remarks')
                        <span class="error-message" style="color:red;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="btns">
                    <button type="submit" class="add">Update Vacancy</button>
                    <a href="{{ route('vacancies.index') }}" class="back">Go Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const isFinishedField = document.getElementById('is_finished');
        const employeeFieldGroup = document.querySelector('.input-group select#employee_id').parentElement;

        // Function to toggle visibility
        const toggleEmployeeField = () => {
            if (isFinishedField.value === '1') { // If "Yes" is selected
                employeeFieldGroup.style.visibility = 'visible';
            } else { // If "No" is selected
                employeeFieldGroup.style.visibility = 'hidden';
            }
        };

        isFinishedField.addEventListener('change', toggleEmployeeField);

        toggleEmployeeField();

        // Initialize Choices.js for dropdowns
        const branchName = document.getElementById('name');
        const nameSelect = new Choices(branchName, {
            removeItemButton: false,
            addItems: true,
            duplicateItemsAllowed: false,
            searchEnabled: true,
            placeholderValue: 'Select a branch...',
            noResultsText: 'No results found',
            noChoicesText: 'No choices available',
        });

        const jobElement = document.getElementById('job');
        const jobChoices = new Choices(jobElement, {
            removeItemButton: true,
            addItems: true,
            duplicateItemsAllowed: false,
            searchEnabled: true,
            placeholderValue: 'Select or type a job...',
            noResultsText: 'No results found',
            noChoicesText: 'No choices available',
        });

        // Set the pre-selected value for the job field
        const selectedJob = '{{ $vacancy->job }}';
        if (selectedJob) {
            const optionExists = Array.from(jobElement.options).some(option => option.value === selectedJob);

            // Add the option if it doesn't exist
            if (!optionExists) {
                const newOption = new Option(selectedJob, selectedJob, true, true);
                jobElement.add(newOption);
            }

            // Set the value in Choices.js
            jobChoices.setChoiceByValue(selectedJob);
        }

        const employee_id = document.getElementById('employee_id');
        const employeeselect = new Choices(employee_id, {
            removeItemButton: false,
            addItems: true,
            duplicateItemsAllowed: false,
            searchEnabled: true,
            placeholderValue: 'Select an employee...',
            noResultsText: 'No results found',
            noChoicesText: 'No choices available',
        });
    });
</script>
