@extends('layouts.master')
@section('title', 'Edit Employee')
@section('custom_title', 'Edit Employee')

<meta name="csrf-token" content="{{ csrf_token() }}">
@section('main')
    <div class="main add-emp">
        <div class="container">
            <div class="add-employee-controller">
                <p data-step="1" class="active">Personal Information</p>
                <p data-step="2">Job Details</p>
                <p data-step="3">Work Status</p>
                <p data-step="4">Exit Details</p>
            </div>

            <form id="updateForm" action="{{ route('employees.update', $employee->id) }}" method="POST"
                enctype="multipart/form-data" class="container">
                @csrf
                @method('PUT')

                {{-- Personal Information --}}
                <div class="form-section" data-section="1">
                    <div class="container-title">
                        <p>Personal Information</p>
                        <small>Update the personal details carefully 👌</small>
                    </div>
                    <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px;">
                        <div class="input-group">
                            <label for="name">Full Name <b style="color:red;">*</b></label>
                            <input type="text" name="name" id="name" value="{{ old('name', $employee->name) }}"
                                required>
                            @error('name')
                                <span class="error-message" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="input-group">
                            <label for="birthday">Birthday <b style="color:red;">*</b></label>
                            <input type="date" name="birthday" id="birthday"
                                value="{{ old('birthday', $employee->birthday) }}">
                            @error('birthday')
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
                            <label for="blood_type">Blood Type</label>
                            <input type="text" name="blood_type" id="blood_type"
                                value="{{ old('blood_type', $employee->blood_type) }}">
                            @error('blood_type')
                                <span class="error-message" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="input-group">
                            <label for="marital_status">Marital Status</label>
                            <select name="marital_status" id="marital_status">
                                <option value="Single"
                                    {{ old('marital_status', $employee->marital_status) == 'Single' ? 'selected' : '' }}>
                                    Single</option>
                                <option value="Married"
                                    {{ old('marital_status', $employee->marital_status) == 'Married' ? 'selected' : '' }}>
                                    Married</option>
                                <option value="Divorced"
                                    {{ old('marital_status', $employee->marital_status) == 'Divorced' ? 'selected' : '' }}>
                                    Divorced</option>
                            </select>
                            @error('marital_status')
                                <span class="error-message" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px;">
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
                        <label for="image">Image
                            @if (!$employee->image_path)
                                <span style="color:red;">*</span>
                            @endif
                        </label>
                        <input type="file" name="image" id="image" onchange="showPreview(this)">
                        <div style="display: flex; justify-content: center; align-items: center; gap: 10px;">
                            <div class="custom-upload">Choose File</div>
                            <div class="file-name" id="file-name">No file chosen</div>
                        </div>
                        @if ($employee->image_path)
                            <img id="img-preview" src="{{ asset('storage/' . $employee->image_path) }}"
                                alt="Employee Image" width="100" style="display: block; margin-top: 10px;">
                        @else
                            <img id="img-preview" src="#" alt="Preview" width="100"
                                style="display: none; margin-top: 10px;">
                        @endif
                        @error('image')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Job Details --}}
                <div class="form-section" data-section="2">
                    <div class="container-title">
                        <p>Job Details</p>
                        <small>Update the job details carefully 👌</small>
                    </div>
                    <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px;">
                        <div class="input-group">
                            <label for="branch_id">Branch/Department <b style="color:red;">*</b></label>
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

                        <div class="input-group">
                            <label for="title">Title <b style="color:red;">*</b></label>
                            <select id="titles" name="title" class="form-control" required>
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
                                    <option value="{{ $job->id }}"
                                        {{ old('job', $employee->job) == $job->id ? 'selected' : '' }}>
                                        {{ $job->name }}
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
                            <div class="toggle-group">
                                <label for="status">Working with US? <b style="color:red;">*</b></label>
                                <div
                                    style="display: flex; align-items: center; gap: 10px; font-size: 14px; color: var(--second-color);">
                                    <input type="hidden" name="status" value="off">
                                    <input type="checkbox" name="status" id="status" value="on"
                                        {{ old('status', $employee->status) ? 'checked' : '' }}>
                                    <p id="status-text">{{ old('status', $employee->status) ? 'Yes' : 'No' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="input-group">
                            <label for="date_hired">Date Hired <b style="color:red;">*</b></label>
                            <input type="date" name="date_hired" id="date_hired"
                                value="{{ old('date_hired', $employee->date_hired) }}" required>
                            @error('date_hired')
                                <span class="error-message" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="input-group">
                            <label for="pin_code">Pin Code <b style="color:red;">*</b></label>
                            <input type="text" name="pin_code" id="pin_code"
                                value="{{ old('pin_code', $employee->pin_code) }}" required>
                            @error('pin_code')
                                <span class="error-message" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px;">
                        <div class="input-group">
                            <label for="shift">Shift</label>
                            <select name="shift" id="shift">
                                <option value="Full Time"
                                    {{ old('shift', $employee->shift) == 'Full Time' ? 'selected' : '' }}>Full Time
                                </option>
                                <option value="Part Time"
                                    {{ old('shift', $employee->shift) == 'Part Time' ? 'selected' : '' }}>Part Time
                                </option>
                            </select>
                            @error('shift')
                                <span class="error-message" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="input-group">
                            <label for="whish_number">Whish Number</label>
                            <input type="text" name="whish_number" id="whish_number"
                                value="{{ old('whish_number', $employee->whish_number) }}">
                            @error('whish_number')
                                <span class="error-message" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="input-group" style="display: none">
                            <label for="belongs_to">Belongs to<b style="color:red;">*</b></label>
                            <select id="belongs_to" name="belongs_to" class="form-control" required>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}"
                                        {{ old('belongs_to', $employee->belongs_to) == $department->id ? 'selected' : '' }}>
                                        {{ $department->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('belongs_to')
                                <span class="error-message" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Work Status --}}
                <div class="form-section" data-section="3">
                    <div class="container-title">
                        <p>Work Status</p>
                        <small>Update the work status carefully 👌</small>
                    </div>
                    <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px;">
                        <div class="input-group">
                            <label for="car">Car</label>
                            <select id="car" name="car" class="form-control">
                                <option value="" disabled {{ old('car', $employee->car) ? '' : 'selected' }}>Select
                                    or type a car...</option>
                                <option value="No" {{ old('car', $employee->car) == 'No' ? 'selected' : '' }}>No
                                </option>
                                <option value="Yes" {{ old('car', $employee->car) == 'Yes' ? 'selected' : '' }}>Yes
                                </option>
                                <option value="Moto" {{ old('car', $employee->car) == 'Moto' ? 'selected' : '' }}>Moto
                                </option>
                                <option value="Both" {{ old('car', $employee->car) == 'Both' ? 'selected' : '' }}>Both
                                </option>
                            </select>
                            @error('car')
                                <span class="error-message" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="input-group">
                            <label for="where_can_work">Where Can Work?</label>
                            <select id="where-can-work" name="where_can_work[]" multiple>
                                @foreach ($branches as $branch)
                                    <option value="{{ $branch->id }}" @if (in_array($branch->id, old('where_can_work', $employee->where_can_work ?? []))) selected @endif>
                                        {{ $branch->branch_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('where_can_work')
                                <span class="error-message" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Employment Exit Details --}}
                <div class="form-section" data-section="4">
                    <div class="container-title">
                        <p>Exit Details</p>
                        <small>Update the exit details carefully 👌</small>
                    </div>
                    <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px;">
                        <div class="input-group">
                            <label for="left_date">Left Date</label>
                            <input type="date" name="left_date" id="left_date"
                                value="{{ old('left_date', $employee->left_date) }}">
                            @error('left_date')
                                <span class="error-message" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="input-group">
                            <label for="give_notice">Give Notice?</label>
                            <select name="give_notice" id="give_notice">
                                <option value=""
                                    {{ old('give_notice', $employee->give_notice) === null ? 'selected' : '' }}>None
                                </option>
                                <option value="1"
                                    {{ old('give_notice', $employee->give_notice) == '1' ? 'selected' : '' }}>Yes</option>
                                <option value="0"
                                    {{ old('give_notice', $employee->give_notice) == '0' ? 'selected' : '' }}>No</option>
                            </select>
                            @error('give_notice')
                                <span class="error-message" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="input-group">
                            <label for="is_good_performer">Good Performer?</label>
                            <select name="is_good_performer" id="is_good_performer">
                                <option value=""
                                    {{ old('is_good_performer', $employee->is_good_performer) === null ? 'selected' : '' }}>
                                    None</option>
                                <option value="1"
                                    {{ old('is_good_performer', $employee->is_good_performer) == '1' ? 'selected' : '' }}>
                                    Yes</option>
                                <option value="0"
                                    {{ old('is_good_performer', $employee->is_good_performer) == '0' ? 'selected' : '' }}>
                                    No</option>
                            </select>
                            @error('is_good_performer')
                                <span class="error-message" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px;">
                        <div class="input-group">
                            <label for="is_positive_person">Positive Person?</label>
                            <select name="is_positive_person" id="is_positive_person">
                                <option value=""
                                    {{ old('is_positive_person', $employee->is_positive_person) === null ? 'selected' : '' }}>
                                    None</option>
                                <option value="1"
                                    {{ old('is_positive_person', $employee->is_positive_person) == '1' ? 'selected' : '' }}>
                                    Yes</option>
                                <option value="0"
                                    {{ old('is_positive_person', $employee->is_positive_person) == '0' ? 'selected' : '' }}>
                                    No</option>
                            </select>
                            @error('is_positive_person')
                                <span class="error-message" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="input-group">
                            <label for="is_recommended_to_back">Recommended to Back?</label>
                            <select name="is_recommended_to_back" id="is_recommended_to_back">
                                <option value=""
                                    {{ old('is_recommended_to_back', $employee->is_recommended_to_back) === null ? 'selected' : '' }}>
                                    None</option>
                                <option value="1"
                                    {{ old('is_recommended_to_back', $employee->is_recommended_to_back) == '1' ? 'selected' : '' }}>
                                    Yes</option>
                                <option value="0"
                                    {{ old('is_recommended_to_back', $employee->is_recommended_to_back) == '0' ? 'selected' : '' }}>
                                    No</option>
                            </select>
                            @error('is_recommended_to_back')
                                <span class="error-message" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px;">
                        <div class="input-group">
                            <label for="left_reason">Left Reason</label>
                            <input type="text" name="left_reason" id="left_reason"
                                value="{{ old('left_reason', $employee->left_reason) }}">
                            @error('left_reason')
                                <span class="error-message" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-group">
                            <label for="exit_interview_remarks">Exit Interview</label>
                            <input type="text" name="exit_interview_remarks" id="exit_interview_remarks"
                                value="{{ old('exit_interview_remarks', $employee->exit_interview_remarks) }}">
                            @error('exit_interview_remarks')
                                <span class="error-message" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Navigation Buttons --}}
                <div class="btns form-navigation">
                    <button type="button" class="prev-btn">Previous</button>
                    <button type="button" class="next-btn">Next</button>
                    <button type="submit" class="add" style="display: none;">Update Record</button>
                    <button type="reset" class="clear" style="display: none;">Clear</button>
                    <a href="{{ route('employees.index') }}" class="back">Go Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection

{{-- Scripts --}}
<script>
    // Show file name on file selection
    function showFileName(input) {
        const fileName = input.files[0]?.name || "No file chosen";
        document.getElementById('file-name').textContent = fileName;
    }

    document.addEventListener('DOMContentLoaded', () => {
        // Toggle status text based on checkbox
        const statusText = document.getElementById('status-text');
        const checkBox = document.getElementById('status');
        if (!statusText || !checkBox) return;
        const updateStatusText = () => {
            statusText.textContent = checkBox.checked ? 'Yes' : 'No';
        };
        checkBox.addEventListener('change', updateStatusText);
        updateStatusText();

        // Multi-step navigation
        const steps = document.querySelectorAll(".add-employee-controller p");
        const sections = document.querySelectorAll(".form-section");
        const prevBtn = document.querySelector(".prev-btn");
        const nextBtn = document.querySelector(".next-btn");
        const submitBtn = document.querySelector(".add");
        const clearBtn = document.querySelector(".clear");
        let currentStep = 1;

        // For "Working with US?" toggle, exit details should show only if unchecked
        function getLastStep() {
            return checkBox.checked ? 3 : 4;
        }

        function showSection(step) {
            sections.forEach((section, index) => {
                section.style.display = index + 1 === step ? "flex" : "none";
                section.style.opacity = index + 1 === step ? "1" : "0";
            });

            const lastStep = getLastStep();
            prevBtn.style.display = step > 1 ? "inline-block" : "none";
            nextBtn.style.display = step < lastStep ? "inline-block" : "none";
            submitBtn.style.display = step === lastStep ? "inline-block" : "block";
            clearBtn.style.display = step === lastStep ? "inline-block" : "none";
            updateStepIndicator();
        }

        nextBtn.addEventListener("click", () => {
            if (currentStep < getLastStep()) {
                currentStep++;
                showSection(currentStep);
            }
        });

        prevBtn.addEventListener("click", () => {
            if (currentStep > 1) {
                currentStep--;
                showSection(currentStep);
            }
        });

        steps.forEach((step) => {
            step.addEventListener("click", function() {
                const stepNumber = parseInt(this.dataset.step);
                if (stepNumber === 4 && checkBox.checked) return;
                currentStep = stepNumber;
                showSection(currentStep);
            });
        });

        function updateStepIndicator() {
            steps.forEach((s) => s.classList.remove("active"));
            steps[currentStep - 1].classList.add("active");
        }
        showSection(1);

        // Exit Details Toggle
        const exitDetailsTab = document.querySelector("[data-step='4']");
        const exitBadge = document.createElement("span");
        exitBadge.textContent = "🔺";
        exitBadge.classList.add("exit-badge");
        exitDetailsTab.appendChild(exitBadge);
        exitDetailsTab.style.pointerEvents = "none"; // Disabled by default

        checkBox.addEventListener("change", function() {
            showSection(currentStep);
            if (!this.checked) {
                exitDetailsTab.style.pointerEvents = "auto";
                exitBadge.style.display = "inline-block";
            } else {
                exitDetailsTab.style.pointerEvents = "none";
                exitBadge.style.display = "none";
            }
        });
        checkBox.dispatchEvent(new Event("change"));

        // Initialize Choices.js Dropdowns
        const branchInput = new Choices('#branch_id', {
            removeItemButton: false,
            addItems: true,
            duplicateItemsAllowed: false,
            searchEnabled: true,
            placeholderValue: 'Select a branch...',
            noResultsText: 'No results found',
            noChoicesText: 'No choices available'
        });
        const jobInput = new Choices('#job', {
            removeItemButton: false,
            addItems: true,
            duplicateItemsAllowed: false,
            searchEnabled: true,
            placeholderValue: 'Select a job...',
            noResultsText: 'No results found',
            noChoicesText: 'No choices available'
        });

        const deptInput = new Choices('#belongs_to', {
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

        const titleInput = new Choices('#titles', {
            removeItemButton: false,
            addItems: true,
            duplicateItemsAllowed: false,
            searchEnabled: true,
            placeholderValue: 'Select a title...',
            noResultsText: 'No results found',
            noChoicesText: 'No choices available'
        });
    });

    function showPreview(input) {
        const file = input.files[0];
        const fileNameDisplay = document.getElementById('file-name');
        const imgPreview = document.getElementById('img-preview');

        if (file) {
            fileNameDisplay.textContent = file.name; // Show file name

            const reader = new FileReader();
            reader.onload = function(e) {
                imgPreview.src = e.target.result; // Set preview image
                imgPreview.style.display = "block"; // Show preview
            };
            reader.readAsDataURL(file);
        } else {
            fileNameDisplay.textContent = "No file chosen";
            imgPreview.style.display = "none"; // Hide preview if no file selected
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const branchChoices = new Choices('#where-can-work', {
            removeItemButton: true,
            searchEnabled: true,
            placeholderValue: 'Select branches...',
            noResultsText: 'No branches found',
            noChoicesText: 'No branches available',
            shouldSort: true,
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const branchSelect = document.getElementById('branch_id');
        const belongsToGroup = document.querySelector('[for="belongs_to"]').parentElement;
        const belongsToSelect = document.getElementById('belongs_to');

        function toggleBelongsTo() {
            const selectedOption = branchSelect.options[branchSelect.selectedIndex];
            const selectedText = selectedOption ? selectedOption.text : "";

            if (selectedText.trim() === "Head Office") {
                belongsToGroup.style.display = 'block';
                belongsToSelect.setAttribute('required', 'required');
            } else {
                belongsToGroup.style.display = 'none';
                belongsToSelect.removeAttribute('required');
                belongsToSelect.value = ""; // clear selection
            }
        }

        // Initial check (for when editing an old form with old value)
        toggleBelongsTo();

        // Trigger check on change
        branchSelect.addEventListener('change', toggleBelongsTo);
    });
</script>

<style>
    .form-navigation {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
        padding: 15px;
    }

    .prev-btn,
    .next-btn,
    .add,
    .clear {
        padding: 12px 18px;
        font-size: 16px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: 0.3s ease-in-out;
    }

    .prev-btn {
        background-color: var(--second-color) !important;
        color: var(--bg-white) !important;
    }

    .next-btn {
        background-color: var(--primary-color) !important;
        color: var(--bg-white) !important;
    }

    .add {
        background-color: var(--third-color);
        color: var(--bg-white);
    }

    .clear {
        background-color: var(--red-theme-color);
        color: var(--bg-white);
    }

    .prev-btn:hover,
    .next-btn:hover,
    .add:hover,
    .clear:hover {
        opacity: 0.8;
    }

    .exit-badge {
        font-size: 14px;
        color: red;
        margin-left: 5px;
        display: none;
    }


    .choices__inner input {
        width: 100% !important;
    }
</style>
