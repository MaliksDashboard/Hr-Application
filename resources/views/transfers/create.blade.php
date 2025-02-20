@extends('layouts.master')
@section('title', 'Apply Transfer')

@section('main')
    <div class="main add-vacancy add-transfer">
        <h1>Apply Transfer</h1>

        <div class="container">
            <form id="transferForm" action="{{ route('transfers.apply') }}" method="POST" enctype="multipart/form-data"
                class="container">
                @csrf
                <div class="container-title">
                    <p>Transfer Form</p>
                    <small>Fill out the form carefully before submitting 👌</small>
                </div>

                <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px;">
                    <div class="input-group">
                        <label for="employee_id">Select Employee <b style="color:red;">*</b></label>
                        <select class="form-control" name="employee_id" id="employee_id" required>
                            @foreach ($employees as $employee)
                                <option style="font-size: 10px" value="{{ $employee->id }}"{!! old('employee_id') == $employee->id ? ' selected' : '' !!}>
                                    {{ $employee->name }} - {{ $employee->job }} - {{ $employee->branch->branch_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <input type="hidden" id="old_branch_id" name="old_branch_id" value="{{ old('old_branch_id', '') }}">
                    <input type="hidden" id="employee_name" name="employee_name" value="">
                    <input type="hidden" id="start_date" name="start_date"
                        value="{{ old('transfer_start_date', \Carbon\Carbon::now()->format('d-m-Y')) }}">


                    <div class="input-group">
                        <label for="branch_id">Target Branch <b style="color:red;">*</b></label>
                        <select class="form-control" name="branch_id" id="branch_id" required>
                            <option value="" disabled selected>Please Select Branch</option>
                            @foreach ($branches as $branch)
                                <option value="{{ $branch->id }}" {{ old('branch_id') == $branch->id ? 'selected' : '' }}>
                                    {{ $branch->branch_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px;">
                    <div class="input-group">
                        <label for="vacancy_id">Available Vacancies</label>
                        <select class="form-control" name="vacancy_id" id="vacancy_id">
                            <option value="none" selected>Select Vacancy (Optional)</option>
                        </select>
                    </div>

                    <div class="input-group">
                        <label for="create_new_vacancy">Create Vacancy for Old Branch?</label>
                        <select class="form-control" name="prompt_new_vacancy" id="create_new_vacancy">
                            <option value="no" {{ old('create_new_vacancy') == 'no' ? 'selected' : '' }}>No</option>
                            <option value="yes" {{ old('create_new_vacancy') == 'yes' ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>
                </div>

                <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px;">
                    <div class="input-group">
                        <label for="transfer_start_date">Transfer Start Date <b style="color:red;">*</b></label>
                        <input type="text" name="transfer_start_date" id="transfer_start_date" class="form-control"
                            value="{{ old('transfer_start_date', \Carbon\Carbon::now()->format('d-m-Y')) }}" required>
                        <script>
                            flatpickr("#transfer_start_date", {
                                dateFormat: "d-m-Y",
                            });
                        </script>
                    </div>

                    <div class="input-group">
                        <label for="type">Transfer Type</label>
                        <select name="type" id="type" class="form-control" required>
                            <option value="Transfer">Transfer</option>
                            <option value="Rotation">Rotation</option>
                        </select>
                    </div>
                </div>

                <div class="input-group" id="rotation_duration_group" style="display: none;">
                    <label for="rotation_duration">End of Rotation</label>
                    <input type="date" name="rotation_duration" id="rotation_duration" class="form-control">
                </div>

                <div class="btns">
                    <button type="submit" class="add">Apply Transfer</button>
                    <button type="reset" class="clear">Clear</button>
                    <a href="{{ route('transfers.index') }}" class="back">Go Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection

<script>
    //Apply the Trasnfer and open SweetAlert to ask if i need to send the email
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('transferForm'); // Select the form by ID

        form.addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent default form submission

            // Prepare form data
            const formData = new FormData(form);

            // Add employee_id explicitly to the form data before sending the request
            const employeeId = document.getElementById('employee_id').value;
            formData.append('employee_id', employeeId);

            // Send the request using fetch (AJAX)
            fetch("{{ route('transfers.apply') }}", {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // If the transfer was successful, show SweetAlert for email options
                        if (data.showEmailPrompt) {
                            Swal.fire({
                                title: 'Do you want to send an email for this transfer?',
                                text: 'You can select people to be notified.',
                                icon: 'question',
                                showCancelButton: true,
                                confirmButtonText: 'Yes',
                                cancelButtonText: 'No'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    showCCSelection(); // Show CC selection for email
                                } else {
                                    // ✅ If user presses "No", redirect to /transfers
                                    window.location.href = '/transfers';
                                }
                            });
                        } else {
                            // ✅ If email prompt is not shown, redirect immediately
                            window.location.href = '/transfers';
                        }
                    } else {
                        Swal.fire('Error!', data.message, 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire('Error!', 'An error occurred while processing your request.',
                        'error');
                });
        });
    });

    //Get the employee Name
    document.addEventListener('DOMContentLoaded', function() {
        const employeeDropdown = document.getElementById('employee_id');
        const employeeNameInput = document.getElementById('employee_name');

        // Update employee name when employee dropdown is changed
        employeeDropdown.addEventListener('change', function() {
            const selectedEmployeeId = employeeDropdown.value;

            // Find the selected employee's name
            const selectedEmployee = Array.from(employeeDropdown.options).find(option => option.value ==
                selectedEmployeeId);

            if (selectedEmployee) {
                employeeNameInput.value = selectedEmployee.textContent.split(" - ")[
                    0]; // Set employee name (split by the ' - ' part)
            }
        });

        // If the page reloads with a selected employee (e.g., after a form submission), set the employee name
        if (employeeDropdown.value) {
            const selectedEmployee = Array.from(employeeDropdown.options).find(option => option.value ==
                employeeDropdown.value);
            if (selectedEmployee) {
                employeeNameInput.value = selectedEmployee.textContent.split(" - ")[0]; // Set employee name
            }
        }
    });

    //Get The old branch Name
    document.addEventListener('DOMContentLoaded', function() {
        const employeeSelect = document.getElementById('employee_id'); // Employee select dropdown
        const oldBranchInput = document.getElementById('old_branch_id'); // Hidden input for old branch ID
        const form = document.getElementById('transferForm'); // Your form

        // Function to set old branch ID based on the selected employee
        employeeSelect.addEventListener('change', function() {
            const selectedEmployeeId = employeeSelect.value;
            if (selectedEmployeeId) {
                // Get the employee's branch from the employee data and update the hidden field
                const selectedEmployee = @json($employees->toArray()).find(emp => emp.id ==
                    selectedEmployeeId);
                if (selectedEmployee) {
                    // Set the old branch ID from the employee's current branch
                    oldBranchInput.value = selectedEmployee.branch_id;
                }
            }
        });

        // Trigger the change event to initialize the hidden field with the old branch ID
        const initialSelectedEmployeeId = employeeSelect.value;
        if (initialSelectedEmployeeId) {
            const selectedEmployee = @json($employees->toArray()).find(emp => emp.id ==
                initialSelectedEmployeeId);
            if (selectedEmployee) {
                oldBranchInput.value = selectedEmployee.branch_id;
            }
        }
    });

    //Function to show and select the CCs
    function showCCSelection() {
        Swal.fire({
            title: 'Select people to CC in this email',
            html: `
        <div class="cc-selector">
            <div class="cc-group"><div class="cc-select"><label><input type="checkbox" id="malik" checked> Malik Barakat</label></div>
            <div class="cc-select"><label><input type="checkbox" id="wael" checked> Wael Chamandi</label></div></div>

            <div class="cc-group"><div class="cc-select"><label><input type="checkbox" id="hassan" checked> Hassan Nasserdine</label></div>
            <div class="cc-select"><label><input type="checkbox" id="tania" checked> Tania Khaddaj</label></div></div>

            <div class="cc-group"><div class="cc-select"><label><input type="checkbox" id="naji"> Naji Deeb</label></div>
            <div class="cc-select"><label><input type="checkbox" id="dalia"> Dalia Mayasi</label></div></div>

            <div class="cc-group"><div class="cc-select"><label><input type="checkbox" id="nisrine"> Nisrine Israwi</label></div>
            <div class="cc-select"><label><input type="checkbox" id="lilian"> Lilian Zebian</label></div></div>

            <div class="cc-group"><div class="cc-select"><label><input type="checkbox" id="rima"> Rima Barakat</label></div>
            <div class="cc-select"><label><input type="checkbox" id="shadi"> Shadi Farhat</label></div></div>

            <div class="cc-group"><div class="cc-select"><label><input type="checkbox" id="loulwa" checked> Loulwa Khaddaj</label></div>
            <div class="cc-select"><label><input type="checkbox" id="silva" checked> Silva Trayji</label></div></div>
        </div>
        `,
            showCancelButton: true,
            confirmButtonText: 'Send Email',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                let selectedEmails = [];
                if (document.getElementById("malik").checked) selectedEmails.push("maliks@maliks.com");
                if (document.getElementById("wael").checked) selectedEmails.push("stationery@maliks.com");
                if (document.getElementById("hassan").checked) selectedEmails.push("operations@maliks.com");
                if (document.getElementById("tania").checked) selectedEmails.push("hr@maliks.com");
                if (document.getElementById("naji").checked) selectedEmails.push("services@maliks.com");
                if (document.getElementById("dalia").checked) selectedEmails.push("e-store@maliks.com");
                if (document.getElementById("nisrine").checked) selectedEmails.push("hr4@maliks.com");
                if (document.getElementById("lilian").checked) selectedEmails.push("headcashier1@maliks.com");
                if (document.getElementById("rima").checked) selectedEmails.push("rima@maliks.com");
                if (document.getElementById("shadi").checked) selectedEmails.push("shadifarhat98@gmail.com");
                if (document.getElementById("silva").checked) selectedEmails.push("hr2@maliks.com");
                if (document.getElementById("loulwa").checked) selectedEmails.push("hr3@maliks.com");

                sendEmailWithCCs(selectedEmails); // Send the email after selecting CCs
            } else {
                // ✅ If user presses "Cancel", redirect to /transfers
                window.location.href = '/transfers';
            }
        });
    }


    //Function to send the email
    function sendEmailWithCCs(selectedEmails) {
        const employeeId = document.getElementById('employee_id').value;
        const employeeName = document.getElementById('employee_name').value;
        const startDate = document.getElementById('start_date').value;
        const newBranchId = document.getElementById('branch_id').value;
        const transferType = document.getElementById('type').value;
        const rotationDurationInput = document.getElementById('rotation_duration');
        const rotationDuration = rotationDurationInput ? rotationDurationInput.value : null;


        if (!employeeId || !employeeName || !startDate || !newBranchId) {
            Swal.fire('Error!', 'Required form fields are missing.', 'error');
            return;
        }

        Swal.fire({
            title: 'Sending Email...',
            text: 'Please wait while the email is being sent.',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });


        fetch('/send-transfer-email', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    cc: selectedEmails,
                    employee_id: employeeId,
                    employee_name: employeeName,
                    start_date: startDate,
                    new_branch_id: newBranchId,
                    type: transferType,
                    rotation_duration: rotationDuration
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Email sent successfully!',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = '/transfers'; // Redirect to transfers page
                    });
                } else {
                    Swal.fire('Error!', 'There was an issue sending the email.', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Error!', 'An error occurred while sending the email.', 'error');
            });
    }

    //Function to call the choices.js
    document.addEventListener('DOMContentLoaded', () => {
        const employeeDropdown = document.getElementById('employee_id');
        const branchDropdown = document.getElementById('branch_id');
        const vacancyDropdown = document.getElementById('vacancy_id');

        const employeeSelect = new Choices(employeeDropdown, {
            removeItemButton: false,
            addItems: true,
            duplicateItemsAllowed: false,
            searchEnabled: true,
            placeholderValue: 'Select an employee...',
            noResultsText: 'No results found',
            noChoicesText: 'No options available',
        });

        const branchSelect = new Choices(branchDropdown, {
            removeItemButton: false,
            addItems: true,
            duplicateItemsAllowed: false,
            searchEnabled: true,
            placeholderValue: 'Select a branch...',
            noResultsText: 'No results found',
            noChoicesText: 'No options available',
        });

        const vacancySelect = new Choices(vacancyDropdown, {
            removeItemButton: false,
            addItems: true,
            duplicateItemsAllowed: false,
            searchEnabled: true,
            placeholderValue: 'Select a vacancy...',
            noResultsText: 'No results found',
            noChoicesText: 'No options available',
        });

        branchDropdown.addEventListener('change', function() {
            const branchId = branchDropdown.value;

            if (branchId) {
                fetch(`/vacancies/fetch?branch_id=${branchId}`)
                    .then(response => response.json())
                    .then(data => {
                        const vacancies = data.vacancies || [];
                        vacancyDropdown.innerHTML = `
                <option value="none" selected>Select Vacancy (Optional)</option>
                ${vacancies.map(v => `<option value="${v.id}">${v.job} (Added: ${v.asked_date})</option>`).join('')}
            `;
                        vacancySelect.setChoices(vacancies, 'id', 'job', true);
                    })
                    .catch(error => console.error('Error fetching vacancies:', error));
            } else {
                vacancyDropdown.innerHTML =
                    `<option value="none" selected>Select Vacancy (Optional)</option>`;
                vacancySelect.clearStore();
            }

        });
    });

    //Function to show the duration rotation
    document.addEventListener('DOMContentLoaded', function() {
        const typeSelect = document.getElementById('type');
        const rotationDurationGroup = document.getElementById('rotation_duration_group');

        function toggleRotationField() {
            if (typeSelect.value === 'Rotation') {
                rotationDurationGroup.style.display = 'flex';
            } else {
                rotationDurationGroup.style.display = 'none';
            }
        }

        // Run on page load in case "Rotation" is already selected
        toggleRotationField();

        // Listen for changes in the dropdown
        typeSelect.addEventListener('change', toggleRotationField);
    });
</script>
