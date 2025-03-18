@extends('layouts.master')
@section('title', 'Add Employee')
@section('custom_title', 'Add Employee')


@section('main')
    <div class="main add-emp">

        <div class="container">
            <div class="add-employee-controller">
                <p data-step="1" class="active">Personal Information</p>
                <p data-step="2">Job Details</p>
                <p data-step="3">Work Status</p>
                <p data-step="4">Exit Details</p>
            </div>

            <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data" class="container">
                @csrf

                {{-- Personal Information Form  --}}
                <div class="form-section" data-section="1">
                    <div class="container-title">
                        <p>Personal Information</p>
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
                            <label for="birthday">Birthday<b style="color:red;">*</b></label>
                            <input type="date" name="birthday" id="birthday" value="{{ old('birthday') }}">
                            @error('birthday')
                                <span class="error-message" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="input-group">
                            <label for="address">Address</label>
                            <input type="address" name="address" id="address" value="{{ old('address') }}">
                            @error('address')
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
                            <label for="blood_type">Blood Type</label>
                            <input type="text" name="blood_type" id="blood_type" value="{{ old('blood_type') }}">
                            @error('blood_type')
                                <span class="error-message" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="input-group">
                            <label for="marital_status">Marital Status</label>
                            <select name="marital_status" id="marital_status">
                                <option value="Single" selected>Single</option>
                                <option value="Married">Married</option>
                                <option value="Divorced">Divorced</option>
                            </select>
                            @error('marital_status')
                                <span class="error-message" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px;">
                        <div class="input-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}">
                            @error('email')
                                <span class="error-message" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="images-group">
                        <label for="image">Image <span style="color:red;">*</span></label>

                        <input type="file" name="image" id="image" onchange="showPreview(this)">

                        <div style="display: flex; justify-content: center; align-items: center; gap: 10px;">
                            <div class="custom-upload">Choose File</div>
                            <div class="file-name" id="file-name">No file chosen</div>
                        </div>

                        {{-- ✅ Default hidden image preview for newly uploaded images --}}
                        <img id="img-preview" src="#" alt="Preview" width="100"
                            style="display: none; margin-top: 10px;">

                        @error('image')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                {{-- Job Details Form  --}}
                <div class="form-section" data-section="2">
                    <div class="container-title">
                        <p>Job Details</p>
                        <small>Make sure you know what you are doing 👌</small>
                    </div>
                    <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px;">

                        <div class="input-group">
                            <label for="branch_id">Branch/Department <b style="color:red;">*</b></label>
                            <select class="form-control" name="branch_id" id="branch_id" required>
                                <option value="" disabled selected>Please Select Branch</option>
                                @foreach ($branches as $branch)
                                    <option value="{{ $branch->id }}"
                                        {{ old('branch_id') == $branch->id ? 'selected' : '' }}>
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
                                    <option value="{{ $title }}" {{ old('title') == $title ? 'selected' : '' }}>
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
                                    <option value="{{ $job->id }}" {{ old('job') == $job->id ? 'selected' : '' }}>
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
                                    style="display: flex; justify-content: center; align-items: center; gap: 10px; font-size: 14px; color: var(--second-color);">
                                    <input type="hidden" name="status" value="off">
                                    <input type="checkbox" name="status" id="status" value="on"
                                        {{ old('status', 'on') == 'on' ? 'checked' : '' }}>
                                    <p id="status-text">Yes</p>
                                </div>
                            </div>
                        </div>

                        <div class="input-group">
                            <label for="date_hired">Date Hired<b style="color:red;">*</b></label>
                            <input type="date" name="date_hired" id="date_hired" value="{{ old('date_hired') }}"
                                required>
                            @error('date_hired')
                                <span class="error-message" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="input-group">
                            <label for="pin_code">Pin Code<b style="color:red;">*</b></label>
                            <input type="text" name="pin_code" id="pin_code" value="{{ old('pin_code') }}"
                                required>
                            @error('pin_code')
                                <span class="error-message" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px;">
                        <div class="input-group">
                            <label for="shift">Shift</label>
                            <select name="shift" id="shift">
                                <option value="Full Time">Full Time</option>
                                <option value="Full Time">Part Time</option>
                            </select>
                            @error('shift')
                                <span class="error-message" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="input-group">
                            <label for="whish_number">Whish Number</label>
                            <input type="text" name="whish_number" id="whish_number"
                                value="{{ old('whish_number') }}">
                            @error('whish_number')
                                <span class="error-message" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Work Status Form  --}}
                <div class="form-section" data-section="3">
                    <div class="container-title">
                        <p>Work Status</p>
                        <small>Make sure you know what you are doing 👌</small>
                    </div>

                    <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px;">
                        <div class="input-group">
                            <label for="car">Car</label>
                            <select id="car" name="car" class="form-control">
                                <option value="" disabled {{ old('car') ? '' : 'selected' }}>Select or type a car...
                                </option>
                                <option value="No" {{ old('car') == 'No' ? 'selected' : '' }}>No</option>
                                <option value="Yes" {{ old('car') == 'Yes' ? 'selected' : '' }}>Yes</option>
                                <option value="Moto" {{ old('car') == 'Moto' ? 'selected' : '' }}>Moto</option>
                                <option value="Both" {{ old('car') == 'Both' ? 'selected' : '' }}>Both</option>
                            </select>
                            @error('car')
                                <span class="error-message" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="input-group">
                            <label for="where_can_work">Where Can Work?</label>
                            <input type="text" name="where_can_work" id="where_can_work"
                                value="{{ old('where_can_work') }}">
                            @error('where_can_work')
                                <span class="error-message" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                </div>

                {{-- Employment Exit Details Form  --}}
                <div class="form-section" data-section="4">

                    <div class="container-title">
                        <p>Exit Details</p>
                        <small>Make sure you know what you are doing 👌</small>
                    </div>

                    <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px;">
                        <div class="input-group">
                            <label for="left_date">Left Date<b style="color:red;">*</b></label>
                            <input type="date" name="left_date" id="left_date" value="{{ old('left_date') }}">
                            @error('left_date')
                                <span class="error-message" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="input-group">
                            <label for="give_notice">Give Notice?<b style="color:red;">*</b></label>
                            <select name="give_notice" id="give_notice">
                                <option value="" {{ old('give_notice') == '' ? 'selected' : '' }}>None</option>
                                <option value="1" {{ old('give_notice') == '1' ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ old('give_notice') == '0' ? 'selected' : '' }}>No</option>
                            </select>
                            @error('give_notice')
                                <span class="error-message" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="input-group">
                            <label for="is_good_performer">Good Performer?<b style="color:red;">*</b></label>
                            <select name="is_good_performer" id="is_good_performer">
                                <option value="" {{ old('is_good_performer') == '' ? 'selected' : '' }}>None
                                </option>
                                <option value="1" {{ old('is_good_performer') == '1' ? 'selected' : '' }}>Yes
                                </option>
                                <option value="0" {{ old('is_good_performer') == '0' ? 'selected' : '' }}>No
                                </option>

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
                                <option value="" {{ old('is_positive_person') == '' ? 'selected' : '' }}>None
                                </option>
                                <option value="1" {{ old('is_positive_person') == '1' ? 'selected' : '' }}>Yes
                                </option>
                                <option value="0" {{ old('is_positive_person') == '0' ? 'selected' : '' }}>No
                                </option>
                            </select>
                            @error('is_positive_person')
                                <span class="error-message" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="input-group">
                            <label for="is_recommended_to_back">Recommended to Back?<b style="color:red;">*</b></label>
                            <select name="is_recommended_to_back" id="is_recommended_to_back">
                                <option value="" {{ old('is_recommended_to_back') == '' ? 'selected' : '' }}>
                                    None
                                </option>
                                <option value="1" {{ old('is_recommended_to_back') == '1' ? 'selected' : '' }}>Yes
                                </option>
                                <option value="0" {{ old('is_recommended_to_back') == '0' ? 'selected' : '' }}>No
                                </option>
                            </select>
                            @error('is_recommended_to_back')
                                <span class="error-message" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px;">

                        <div class="input-group">
                            <label for="left_reason">Left Reason</label>
                            <input type="text" name="left_reason" id="left_reason" value="{{ old('left_reason') }}">
                            @error('left_reason')
                                <span class="error-message" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px;">

                        <div class="input-group">
                            <label for="exit_interview_remarks">Exit Interview</label>
                            <input type="text" name="exit_interview_remarks" id="exit_interview_remarks"
                                value="{{ old('exit_interview_remarks') }}">
                            @error('exit_interview_remarks')
                                <span class="error-message" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="btns form-navigation">
                    <button type="button" class="prev-btn">Previous</button>
                    <button type="button" class="next-btn">Next</button>

                    <button type="submit" class="add" style="display: none;">Add Record</button>
                    <button type="reset" class="clear" style="display: none;">Clear</button>
                    <a href="{{ route('employees.index') }}" class="back">Go Back</a>
                </div>

        </div>

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


        const jobInput = new Choices('#job', {
            removeItemButton: false,
            addItems: true,
            duplicateItemsAllowed: false,
            searchEnabled: true,
            placeholderValue: 'Select a job...',
            noResultsText: 'No results found',
            noChoicesText: 'No choices available',
            addItemFilter: function(value) {
                return value.trim() !== '';
            },
        });

        const titleInput = new Choices('#titles', {
            removeItemButton: false,
            addItems: true,
            duplicateItemsAllowed: false,
            searchEnabled: true,
            placeholderValue: 'Select a title...',
            noResultsText: 'No results found',
            noChoicesText: 'No choices available',
            addItemFilter: function(value) {
                return value.trim() !== '';
            },
        });


        // Attach event listener to Choices.js instance
        branchInput.passedElement.element.addEventListener('addItem', function(event) {
            console.log('Item added:', event.detail.value);
        });
    });

    function showFileName(input) {
        const fileName = input.files[0]?.name || "No file chosen";
        document.getElementById('file-name').textContent = fileName;
    }

    document.addEventListener("DOMContentLoaded", function() {
        const steps = document.querySelectorAll(".add-employee-controller p");

        steps.forEach(step => {
            step.addEventListener("click", function() {
                // Remove 'active' from all
                steps.forEach(s => s.classList.remove("active"));

                // Add 'active' to clicked step
                this.classList.add("active");

                // OPTIONAL: Scroll to corresponding section smoothly
                const targetSection = document.querySelector(
                    `[data-section="${this.dataset.step}"]`);
                if (targetSection) {
                    targetSection.scrollIntoView({
                        behavior: "smooth",
                        block: "start"
                    });
                }
            });
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        const steps = document.querySelectorAll(".add-employee-controller p");
        const sections = document.querySelectorAll(".form-section");
        const prevBtn = document.querySelector(".prev-btn");
        const nextBtn = document.querySelector(".next-btn");
        const submitBtn = document.querySelector(".add");
        const clearBtn = document.querySelector(".clear");
        const goBackBtn = document.querySelector(".back");
        const statusCheckbox = document.getElementById("status");
        const exitDetailsTab = document.querySelector("[data-step='4']");
        const exitSection = document.querySelector("[data-section='4']");
        let currentStep = 1;

        // 🔹 Get Last Step Based on Status
        function getLastStep() {
            return statusCheckbox.checked ? 3 : 4;
        }

        // 🔹 Show Active Section
        function showSection(step) {
            sections.forEach((section, index) => {
                section.style.display = index + 1 === step ? "flex" : "none";
                section.style.opacity = index + 1 === step ? "1" : "0";
            });

            const lastStep = getLastStep();
            prevBtn.style.display = step > 1 ? "inline-block" : "none";
            nextBtn.style.display = step < lastStep ? "inline-block" : "none";
            submitBtn.style.display = step === lastStep ? "inline-block" : "none";
            clearBtn.style.display = step === lastStep ? "inline-block" : "none";
            goBackBtn.style.display = step === lastStep ? "inline-block" : "block";

            updateStepIndicator();
        }

        // 🔹 Next Button Click
        nextBtn.addEventListener("click", () => {
            if (currentStep < getLastStep()) {
                currentStep++;
                showSection(currentStep);
            }
        });

        // 🔹 Previous Button Click
        prevBtn.addEventListener("click", () => {
            if (currentStep > 1) {
                currentStep--;
                showSection(currentStep);
            }
        });

        // 🔹 Step Click Navigation
        steps.forEach((step) => {
            step.addEventListener("click", function() {
                const stepNumber = parseInt(this.dataset.step);
                if (stepNumber === 4 && statusCheckbox.checked) return;
                currentStep = stepNumber;
                showSection(currentStep);
            });
        });

        // 🔹 Highlight Active Step in Navigation
        function updateStepIndicator() {
            steps.forEach((s) => s.classList.remove("active"));
            steps[currentStep - 1].classList.add("active");
        }

        showSection(1); // Show first section on page load

        // 🔥 Exit Details - Enable Only When "Working with Us?" is OFF
        const exitBadge = document.createElement("span");
        exitBadge.textContent = "🔺";
        exitBadge.classList.add("exit-badge");
        exitDetailsTab.appendChild(exitBadge);
        exitDetailsTab.style.pointerEvents = "none"; // Disable by default

        statusCheckbox.addEventListener("change", function() {
            showSection(currentStep);
            if (!this.checked) {
                exitDetailsTab.style.pointerEvents = "auto";
                exitBadge.style.display = "inline-block";
            } else {
                exitDetailsTab.style.pointerEvents = "none";
                exitBadge.style.display = "none";
            }
        });

        statusCheckbox.dispatchEvent(new Event("change")); // Run on page load
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

    /* 🔹 Alert Badge for Exit Details */
    .exit-badge {
        font-size: 14px;
        color: red;
        margin-left: 5px;
        display: none;
    }
</style>
