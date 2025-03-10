@extends('layouts.master')
@section('title', 'New Joiners System')
@section('custom_title', 'New Joiners Details')

@section('main')

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const notyf = new Notyf({
                    duration: 4000,
                    position: {
                        x: 'right',
                        y: 'top'
                    }
                });

                notyf.success('{{ session('success') }}');
            });
        </script>
    @endif

    <div class="main new-joiners">
        <div class="controller">
            <div class="new-joiner-btns">
                <a class="add-btn" href="{{ url('/new-joiners/create') }}">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M18 10h-4V6a2 2 0 0 0-4 0l.071 4H6a2 2 0 0 0 0 4l4.071-.071L10 18a2 2 0 0 0 4 0v-4.071L18 14a2 2 0 0 0 0-4" />
                    </svg>
                    Add New Record
                </a>

                <a class="add-btn" href="{{ url('steps') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 42 42" xml:space="preserve">
                        <path
                            d="M15.3 20.1c0 3.1 2.6 5.7 5.7 5.7s5.7-2.6 5.7-5.7-2.6-5.7-5.7-5.7-5.7 2.6-5.7 5.7m8.1 12.3C30.1 30.9 40.5 22 40.5 22s-7.7-12-18-13.3c-.6-.1-2.6-.1-3-.1-10 1-18 13.7-18 13.7s8.7 8.6 17 9.9c.9.4 3.9.4 4.9.2M11.1 20.7c0-5.2 4.4-9.4 9.9-9.4s9.9 4.2 9.9 9.4S26.5 30 21 30s-9.9-4.2-9.9-9.3" />
                    </svg>
                    Training Steps
                </a>
            </div>
        </div>

        <div class="container">
            <div class="new-joiner-list">
                <span>Select The Phase (<span id="progress-count">0</span> in progress)</span>
                <span class="border"></span>
                <div class="steps-btns">
                    <p class="steps-btn active" data-step="all">All Records</p>
                    @foreach ($steps as $step)
                        <p class="steps-btn" data-step="{{ $step->id }}"
                            style="border-bottom: 3px solid {{ $step->color }};">
                            {{ $step->name }}
                        </p>
                    @endforeach
                </div>
                <span id="selected-step">All Records</span>
                <span class="border"></span>
                <div class="new-joiners-list-name" id="new-joiner-list-name">
                    <!-- Data will load here via JavaScript -->
                </div>
            </div>

            <div class="new-joiner-list-status" id="new-joiner-list-status">
                <h1 style="color:var(--light-color)"> Select An employee </h1>
            </div>

            <div id="remarks-modal" class="modal">
                <div class="modal-content">
                    <span class="close-btn" onclick="closeRemarksModal()">&times;</span>
                    <h3>Complete Step</h3>
                    <div class="input-group">
                        <label for="completion-date">Completion Date <b style="color:red;">*</b></label>
                        <input type="date" id="completion-date" required>
                    </div>
                    <div class="input-group">
                        <label for="remarks">Remarks (optional)</label>
                        <textarea id="remarks" placeholder="Enter remarks"></textarea>
                    </div>
                    <button id="submit-completion">Submit</button>
                </div>
            </div>

            <div id="modal-overlay"></div>


        </div>

    </div>

@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const stepsBtns = document.querySelectorAll(".steps-btn");
        const joinerList = document.getElementById("new-joiner-list-name");
        const joinerStatus = document.getElementById("new-joiner-list-status");
        const selectedStep = document.getElementById("selected-step");
        const remarksModal = document.getElementById("remarks-modal");
        const modalOverlay = document.getElementById("modal-overlay");
        const completionDateInput = document.getElementById("completion-date");
        const remarksInput = document.getElementById("remarks");
        let selectedJoinerId, selectedStepId;

        function openRemarksModal(joinerId, stepId) {
            selectedJoinerId = joinerId;
            selectedStepId = stepId;
            remarksModal.style.display = "flex";
            modalOverlay.style.display = "block";
            completionDateInput.value = new Date().toISOString().split('T')[0];
        }

        function closeRemarksModal() {
            remarksModal.style.display = "none";
            modalOverlay.style.display = "none";
            remarksInput.value = "";
            completionDateInput.value = "";
        }

        function loadJoiners(stepId = "all") {
            fetch(`/new-joiners/filter/${stepId}`)
                .then(response => response.json())
                .then(data => {
                    joinerList.innerHTML = "";

                    // ✅ Update progress count
                    let employeesInProgress = data.length;
                    document.getElementById("progress-count").innerText = employeesInProgress;

                    if (data.length === 0) {
                        joinerList.innerHTML = `<p class="no-records">No records available.</p>`;
                        return;
                    }

                    data.forEach(joiner => {
                        let currentStepText = joiner.current_step ?
                            `<span class="current-step">Step: ${joiner.current_step}</span>` : "";

                        let actionButton = "";

                        // ✅ Check if the employee is in the "Ready" phase
                        if (joiner.current_step === "Ready") {
                            actionButton = `<span class="ready-label">✅</span>`;
                        } else if (stepId === "all") {
                            actionButton =
                                `<button class="view-progress delete-employee" data-joiner="${joiner.id}"><svg  viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2h4a1 1 0 1 1 0 2h-1.069l-.867 12.142A2 2 0 0 1 17.069 22H6.93a2 2 0 0 1-1.995-1.858L4.07 8H3a1 1 0 0 1 0-2h4zm2 2h6V4H9zM6.074 8l.857 12H17.07l.857-12zM10 10a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1m4 0a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1" fill="#fff"/></svg></button>`;
                        } else {
                            actionButton =
                                `<button class="complete-btn" data-joiner="${joiner.id}" data-step="${stepId}">Mark Completed</button>`;
                        }

                        let joinerHTML = `
                    <div class="joiner-card" data-id="${joiner.id}">
                        <div class="new-joiner-steps-name">
                        <p><b>${joiner.name}</b> - ${joiner.job} </p>
                        <span>${currentStepText}</span></div>
                        <div class="joiner-card-btns">
                            <button class="view-progress" data-id="${joiner.id}"><svg fill="#fff"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 42 42" xml:space="preserve"><path d="M15.3 20.1c0 3.1 2.6 5.7 5.7 5.7s5.7-2.6 5.7-5.7-2.6-5.7-5.7-5.7-5.7 2.6-5.7 5.7m8.1 12.3C30.1 30.9 40.5 22 40.5 22s-7.7-12-18-13.3c-.6-.1-2.6-.1-3-.1-10 1-18 13.7-18 13.7s8.7 8.6 17 9.9c.9.4 3.9.4 4.9.2M11.1 20.7c0-5.2 4.4-9.4 9.9-9.4s9.9 4.2 9.9 9.4S26.5 30 21 30s-9.9-4.2-9.9-9.3"/></svg></button>
                            ${actionButton}
                        </div>
                    </div>
                `;
                        joinerList.innerHTML += joinerHTML;
                    });

                    attachEventListeners();
                })
                .catch(error => console.error("Error fetching joiners:", error));
        }


        function attachEventListeners() {
            document.querySelectorAll(".view-progress").forEach(button => {
                button.removeEventListener("click", handleViewProgress);
                button.addEventListener("click", handleViewProgress);
            });

            document.querySelectorAll(".complete-btn").forEach(button => {
                button.removeEventListener("click", handleMarkComplete);
                button.addEventListener("click", handleMarkComplete);
            });

            document.querySelectorAll(".delete-employee").forEach(button => {
                button.removeEventListener("click", handleDeleteEmployee);
                button.addEventListener("click", handleDeleteEmployee);
            });

            document.getElementById("submit-completion").removeEventListener("click", handleCompletionSubmit);
            document.getElementById("submit-completion").addEventListener("click", handleCompletionSubmit);
        }

        function handleViewProgress() {
            let joinerId = this.getAttribute("data-id");
            loadProgress(joinerId);
        }

        function handleMarkComplete() {
            let joinerId = this.getAttribute("data-joiner");
            let stepId = this.getAttribute("data-step");
            openRemarksModal(joinerId, stepId);
        }

        function handleCompletionSubmit() {
            let remarks = remarksInput.value;
            let completionDate = completionDateInput.value;

            if (!completionDate) {
                Swal.fire("Error", "Completion date is required!", "error");
                return;
            }

            markStepComplete(selectedJoinerId, selectedStepId, completionDate, remarks)
                .then(() => {
                    closeRemarksModal(); // ✅ Close modal after successful submission
                    loadJoiners(); // ✅ Refresh the list to show updated progress
                });
        }


        function handleDeleteEmployee() {
            let joinerId = this.getAttribute("data-joiner");

            Swal.fire({
                title: "Are you sure?",
                text: "This action cannot be undone!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteEmployee(joinerId);
                }
            });
        }


        function deleteEmployee(joinerId) {
            fetch(`/new-joiners/${joinerId}`, {
                    method: 'DELETE', // ✅ Use DELETE method now
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content'),
                    }
                })

                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        Swal.fire("Error", data.error, "error");
                    } else {
                        Swal.fire("Deleted!", "The employee has been removed.", "success").then(() => {
                            loadJoiners();
                        });
                    }
                })
                .catch(error => {
                    console.error("Error deleting employee:", error);
                    Swal.fire("Error", "Something went wrong!", "error");
                });
        }

        function formatDate(dateString) {
            if (!dateString) return "N/A"; // If no date, return N/A
            let date = new Date(dateString);
            let day = String(date.getDate()).padStart(2, "0");
            let month = String(date.getMonth() + 1).padStart(2, "0");
            let year = date.getFullYear();
            return `${day}-${month}-${year}`;
        }

        function loadProgress(newJoinerId) {
            let joinerCard = document.querySelector(`.joiner-card[data-id="${newJoinerId}"]`);
            let selectedJoinerName = joinerCard ? joinerCard.querySelector("p b").innerText : "Unknown";

            fetch(`/progress/${newJoinerId}`)
                .then(response => response.json())
                .then(data => {
                    joinerStatus.innerHTML = `
                        <div class="progress-header-container">
                            <h3>Progress History for <span class="selected-employee">${selectedJoinerName}</span></h3>
                            <button id="print-progress" class="print-btn">Print Progress</button>
                        </div>
                    `;

                    if (data.length === 0) {
                        joinerStatus.innerHTML += `<p class="no-records">No progress recorded.</p>`;
                        return;
                    }

                    data.forEach(progress => {
                        // ✅ Only mark "Ready" as completed if ALL previous steps are completed
                        let isReadyStep = progress.step.name.toLowerCase() === "ready";
                        let isAllPreviousCompleted = data.every(p => p.status === "completed" || p
                            .step.name === "Ready");

                        let finalStatus = isReadyStep && isAllPreviousCompleted ? "completed" :
                            progress.status;

                        joinerStatus.innerHTML += `
                    <div style="${finalStatus === "completed" ? "border-left: 5px solid green;" : "border-left: 5px solid red;"}" 
                        class="progress-card">
                        <div class="progress-header">
                            <span class="step-name">${progress.step.name}</span>
                            <span class="status ${finalStatus === "completed" ? "status-completed" : "status-pending"}">
                                ${finalStatus}
                            </span>
                        </div>
                        <div class="progress-details">
                            <span class="completed-date">
                                <b>Completed:</b> ${formatDate(progress.completed_at)}
                            </span>
                            <span class="remarks">
                                <b>Remarks:</b> ${progress.remarks || "None"}
                            </span>
                        </div>
                    </div>
                `;
                    });
                })
                .catch(error => console.error("Error fetching progress:", error));

            setTimeout(() => {
                let printButton = document.getElementById("print-progress");
                if (printButton) {
                    printButton.addEventListener("click", function() {
                        let progressSection = document.getElementById("new-joiner-list-status")
                            .innerHTML;
                        let employeeName = document.querySelector(".selected-employee")
                            .innerText || "Employee";

                        let printWindow = window.open("", "", "width=800,height=600");
                        printWindow.document.write(`
                <html>
                <head>
                    <title>Progress Report - ${employeeName}</title>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            line-height: 1.6;
                            padding: 20px;
                            text-align: left;
                            color: #333;
                        }
                        .progress-header {
                            text-align: center;
                            border-bottom: 2px solid #333;
                            padding-bottom: 10px;
                            margin-bottom: 20px;
                        }
                        .progress-header h2 {
                            margin: 0;
                            font-size: 14px;
                            font-weight: bold;
                        }
                        .progress-header small {
                            font-size: 22px;
                            color: #777;
                        }
                        .progress-card {
                            border: 1px solid #ccc;
                            padding: 10px;
                            margin-bottom: 10px;
                            border-radius: 5px;
                            background: #f9f9f9;
                        }
                        .progress-card.completed {
                            border-left: 5px solid green;
                        }
                        .progress-card.pending {
                            border-left: 5px solid red;
                        }
                        .step-name {
                            font-weight: bold;
                            font-size: 16px;
                        }
                        .status {
                            float: right;
                            font-size: 14px;
                            font-weight: bold;
                        }
                        .remarks {
                            font-style: italic;
                            font-size: 14px;
                            color: #555;
                        }
                        .print-footer {
                            text-align: center;
                            margin-top: 30px;
                            font-size: 12px;
                            color: #777;
                        }
                        @media print {
                            body {
                                width: 210mm;
                                height: 297mm;
                                margin: 0;
                                padding: 20mm;
                            }
                        }
                    </style>
                </head>
                <body>
                    <div class="progress-header">
                        <h2>Employee Progress Report</h2>
                        <small>Employee: ${employeeName}</small>
                    </div>

                    ${progressSection}

                    <div class="print-footer">
                        <p>Generated on: ${new Date().toLocaleDateString()}</p>
                    </div>
                </body>
                </html>
             `);

                        printWindow.document.close();
                        printWindow.focus();
                        printWindow.print();
                        printWindow.close();
                    });
                }
            }, 100);

        }


        function markStepComplete(newJoinerId, stepId, completionDate, remarks) {
            if (stepId === "all") {
                Swal.fire("Error", "Please select a specific step before marking completion.", "error");
                return;
            }

            console.log("Sending data:", {
                newJoinerId,
                stepId,
                completionDate,
                remarks
            });

            return fetch('/progress/complete', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content'),
                    },
                    body: JSON.stringify({
                        new_joiner_id: newJoinerId,
                        step_id: stepId,
                        completion_date: completionDate,
                        remarks: remarks
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    console.log("Server response:", data);
                    if (data.error) {
                        Swal.fire("Error", data.error, "error");
                    } else {
                        Swal.fire("Success", "Step marked as completed!", "success").then(() => {
                            closeRemarksModal();
                            // ✅ Keep the system in the same filter after marking step completed
                            loadJoiners(stepId);
                        });
                    }
                })
                .catch(error => {
                    console.error("Fetch error:", error);
                    Swal.fire("Error", "Something went wrong!", "error");
                });
        }


        modalOverlay.addEventListener("click", closeRemarksModal);

        stepsBtns.forEach(button => {
            button.addEventListener("click", function() {
                let stepId = this.getAttribute("data-step");

                stepsBtns.forEach(btn => btn.classList.remove("active"));
                this.classList.add("active");
                selectedStep.innerText = this.innerText;

                loadJoiners(stepId);
            });
        });

        const allRecordsBtn = document.querySelector('.steps-btn[data-step="all"]');
        if (allRecordsBtn) {
            allRecordsBtn.classList.add("active");
            selectedStep.innerText = allRecordsBtn.innerText;
        }

        loadJoiners();
    });
</script>



<style>
    .no-records {
        text-align: center;
        font-size: 16px;
        color: #888;
    }

    .input-group {
        display: flex;
        flex-direction: column;
        width: 100%;
        justify-content: flex-start;
        gap: 5px;
    }

    .input-group label {
        color: var(--second-color);
        font-size: 14px;
    }

    .input-group input {
        border: 1px solid var(--light-color);
        height: 43px;
        border-radius: 10px;
        padding-inline: 10px;
        color: var(--second-color);
        font-size: 16px;
        width: 100%;
    }

    .input-group input:focus {
        outline: none;
    }

    .input-group select {
        border: 1px solid var(--light-color);
        min-height: 43px;
        border-radius: 10px;
        padding-inline: 10px;
        color: var(--second-color);
        font-size: 16px;
        background-color: white;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        cursor: pointer;
    }

    .input-group select:focus {
        outline: none;
        border-color: var(--second-color);
        box-shadow: 0 0 5px rgba(100, 112, 132, 0.5);
    }

    .add-btn {
        height: 45px !important;
        max-width: 250px !important;
    }

    .steps-btn {
        cursor: pointer;
        padding: 5px 10px;
        background: #f0f0f0;
        border-radius: 5px;
        margin: 5px;
        display: inline-block;
    }

    .steps-btn:hover {
        background: #ccc;
    }

    /* Background Overlay */
    #modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        z-index: 9999;
    }

    .modal {
        display: none;
        flex-direction: column;
        gap: 10px;
        position: fixed;
        width: 600px !important;
        z-index: 10000;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        width: 350px;
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
    }

    .modal-content {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .close-btn {
        cursor: pointer;
        font-size: 20px;
        float: right;
    }

    textarea {
        width: 100%;
        height: 80px;
        margin-bottom: 10px;
    }

    input[type="date"] {
        width: 100%;
        padding: 5px;
        margin-bottom: 10px;
    }

    button {
        background: var(--third-color);
        color: white;
        padding: 8px;
        border: none;
        cursor: pointer;
        border-radius: 5px;
    }

    button:hover {
        background: #0056b3;
    }

    .current-step {
        color: black;
        padding: 5px;
        margin: 5px 0;
        font-size: 14px !important;
        border-radius: 5px;
        font-weight: bold;
    }
</style>
