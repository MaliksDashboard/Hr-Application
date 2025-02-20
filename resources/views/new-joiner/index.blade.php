@extends('layouts.master')
@section('title', 'New Joiners System')


@section('main')

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const notyf = new Notyf({
                    duration: 4000, // Notification duration (ms)
                    position: {
                        x: 'right',
                        y: 'top'
                    }, // Position of notifications
                });

                notyf.success('{{ session('success') }}'); // Display success message
            });
        </script>
    @endif

    <div class="main new-joiners">

        <div class="controller">
            <h2>New Joiners Details</h2>
            <a class="add-btn" href="{{ route('new-joiners.create') }}">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M18 10h-4V6a2 2 0 0 0-4 0l.071 4H6a2 2 0 0 0 0 4l4.071-.071L10 18a2 2 0 0 0 4 0v-4.071L18 14a2 2 0 0 0 0-4" />
                </svg>
                Add New Record
            </a>
        </div>
        <div class="container">
            <div class="container-left">
                <div class="container-left-top">
                    <div class="top-controller">
                        <div class="left-title">
                            <div class="controller-left">
                                <p id="employee-name">#Select an Employee</p> <!-- Dynamically Updated -->
                                <span id="employee-status" class="status">-</span> <!-- Dynamically Updated -->
                                <b id="employee-progress">-</b> <!-- Dynamically Updated -->
                            </div>
                            <p id="employee-start-date" class="starting-date">Starting Process at -</p>
                            <!-- Dynamically Updated -->

                        </div>
                        <div class="controller-right">
                            <button class="complete">Complete</button>
                            <button class="hold">Hold</button>
                            <button class="edit">Edit Record</button>
                        </div>
                    </div>

                    <div class="top-body">
                        <p>Progress</p>
                        <div id="progress-bars" class="progress-bars">
                            <!-- Progress bars will be inserted dynamically -->
                        </div>
                    </div>

                    <div class="top-bottom">
                        <p>
                            <svg viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg">
                                <path class="clr-i-solid clr-i-solid-path-1"
                                    d="M5 31.9a2 2 0 0 1-2-2V5.44a2 2 0 0 1 3.12-1.63L23.18 16a2 2 0 0 1 0 3.25L6.12 31.52A2 2 0 0 1 5 31.9" />
                                <rect class="clr-i-solid clr-i-solid-path-2" x="25.95" y="3.67" width="7"
                                    height="28" rx="2" ry="2" />
                                <path fill="none" d="M0 0h36v36H0z" />
                            </svg>
                            Estimated finishing date: <small id="estimated-finish-date">-</small>
                        </p>

                        <button class="edit">Make As Team Member</button>
                    </div>
                </div>
                <div class="container-left-bottom">
                    <h3>New Records</h3>
                    <div id="new-joiners" class="table-new-joiners">
                        <!-- New Joiner Table will be fetched here using JS -->
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-overlay"></div>

        <div id="completePhaseModal" class="modal">
            <div class="modal-content">
                <h3>Complete Current Phase</h3>
                <form id="completePhaseForm">
                    <input type="hidden" id="employee_id">

                    <label for="completed_at">Completion Date:</label>
                    <input type="date" id="completed_at" required>

                    <label for="next_phase_start_at">Next Phase Start Date:</label>
                    <input type="date" id="next_phase_start_at" required>
                    <div style="display: flex; justify-content: center;align-items: center; gap: 10px;">
                        <button type="submit" class="save-btn">Save Changes</button>
                        <button type="button" class="close-btnn" onclick="closeModal()">x</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {
        console.log("Window fully loaded, initializing Grid.js...");

        const container = document.getElementById("new-joiners");
        if (!container) {
            console.error("Error: Table container #new-joiners not found.");
            return;
        }

        container.innerHTML = "";

        const grid = new gridjs.Grid({
            columns: [{
                    id: "id",
                    name: "ID"
                },
                {
                    id: "name",
                    name: "Name"
                },
                {
                    id: "mode",
                    name: "Mode"
                },
                {
                    id: "date_mode",
                    name: "Joining Date"
                },
                {
                    id: "job",
                    name: "Job Title"
                },
                {
                    id: "current_branch",
                    name: "Branch"
                },
                {
                    id: "remarks",
                    name: "Remarks"
                }
            ],
            server: {
                url: "{{ url('/new-joiners-data') }}",
                then: data => {
                    console.log("Data Fetched from API:", data);
                    return data.map(joiner => [
                        joiner.id,
                        joiner.name,
                        joiner.mode,
                        joiner.date_mode,
                        joiner.job,
                        joiner.current_branch ?? "-",
                        joiner.remarks ?? "-"
                    ]);
                }
            },
            pagination: {
                limit: 10
            },
            search: true,
            sort: true,
            resizable: true
        }).render(container);

        setTimeout(() => waitForTableToLoad(), 500);
    });

    function waitForTableToLoad(attempts = 10) {
        setTimeout(() => {
            const rows = document.querySelectorAll(".gridjs-tbody tr");

            if (rows.length > 0) {
                selectFirstRow();
                attachCompleteButtonListeners();
            } else if (attempts > 0) {
                waitForTableToLoad(attempts - 1);
            }
        }, 100);
    }

    function selectFirstRow() {
        const rows = document.querySelectorAll(".gridjs-tbody tr");
        if (rows.length > 0) {
            const firstRow = rows[0];
            firstRow.classList.add("selected-row");
            firstRow.click();
        }

        rows.forEach(row => {
            row.addEventListener("click", function() {
                document.querySelectorAll(".gridjs-tbody tr").forEach(r => r.classList.remove(
                    "selected-row"));
                this.classList.add("selected-row");

                const employeeId = this.cells[0].innerText;
                const employeeName = this.cells[1].innerText;
                const employeeStatus = this.cells[2].innerText;
                const employeeStartDate = this.cells[3].innerText;

                document.getElementById("employee-name").innerText = `#${employeeName}`;
                document.getElementById("employee-status").innerText = employeeStatus;
                document.getElementById("employee-progress").innerText = "In Progress";
                document.getElementById("employee-start-date").innerText =
                    `Starting Process at ${employeeStartDate}`;

                let startDate = new Date(employeeStartDate);
                startDate.setDate(startDate.getDate() + 40);
                let estimatedDate = startDate.toLocaleDateString("en-US", {
                    year: "numeric",
                    month: "short",
                    day: "2-digit"
                });

                document.getElementById("estimated-finish-date").innerText = estimatedDate;

                updateProgressBars(employeeId);
            });
        });
    }

    function updateProgressBars(employeeId) {
        fetch(`/employee-progress/${employeeId}`)
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    console.error("API Error:", data.error);
                    return;
                }

                const progressContainer = document.getElementById("progress-bars");
                progressContainer.innerHTML = "";

                const phases = data.phases;
                const completedIndex = data.completed;
                const latestMode = phases[completedIndex];

                const colors = ["#28a745", "#000000", "#6f42c1", "#dc3545", "#007bff"];

                phases.forEach((phase, index) => {
                    let progress = "0%";
                    let bgColor = "#ddd";
                    let spinner = "";

                    if (latestMode === "Already Team Member") {
                        progress = "100%";
                        bgColor = colors[index];
                    } else {
                        if (index < completedIndex) {
                            progress = "100%";
                            bgColor = colors[index];
                        } else if (index === completedIndex) {
                            progress = "50%";
                            bgColor = colors[index];
                            spinner = `
                            <div class="spinner-container">
                                <div class="spinner"></div>
                                <p class="spinner-text">Processing...</p>
                            </div>
                        `;
                        }
                    }

                    const progressBar = document.createElement("div");
                    progressBar.className = "progress-bar";
                    progressBar.innerHTML = `
                    <p>${phase}</p>
                    <div class="progress">
                        <div class="progress-fill" style="width: ${progress}; background: ${bgColor}; height: 100%;"></div>
                    </div>
                    ${spinner}
                `;

                    progressContainer.appendChild(progressBar);
                });
            })
            .catch(error => console.error("Error fetching progress data:", error));
    }

    document.addEventListener("DOMContentLoaded", function() {
        setTimeout(() => {
            document.querySelectorAll(".complete").forEach(button => {
                button.addEventListener("click", function() {
                    const selectedRow = document.querySelector(
                        ".gridjs-tbody tr.selected-row");

                    if (!selectedRow) {
                        alert("Please select an employee first.");
                        return;
                    }

                    const employeeId = selectedRow.cells[0].innerText;
                    document.getElementById("employee_id").value = employeeId;

                    const modal = document.getElementById("completePhaseModal");
                    const overlay = document.querySelector(".modal-overlay");

                    if (modal && overlay) {
                        modal.classList.add("active");
                        overlay.classList.add("active");
                    } else {
                        console.error("Error: Modal or overlay element not found.");
                    }
                });
            });
        }, 100);
    });

    // Close the modal
    function closeModal() {
        const modal = document.getElementById("completePhaseModal");
        const overlay = document.querySelector(".modal-overlay");

        if (modal && overlay) {
            modal.classList.remove("active");
            overlay.classList.remove("active");
        } else {
            console.error("Error: Modal or overlay element not found.");
        }
    }

    // Submit phase completion form
    document.addEventListener("DOMContentLoaded", function() {
        const completeForm = document.getElementById("completePhaseForm");

        if (completeForm) {
            completeForm.addEventListener("submit", function(event) {
                event.preventDefault();

                const employeeId = document.getElementById("employee_id").value;
                const completedAt = document.getElementById("completed_at").value;
                const nextPhaseStartAt = document.getElementById("next_phase_start_at").value;

                fetch("/save-phase-progress", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                                .content
                        },
                        body: JSON.stringify({
                            employee_id: employeeId,
                            completed_at: completedAt,
                            next_phase_start_at: nextPhaseStartAt
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        alert(data.message);
                        closeModal();
                        location.reload();
                    })
                    .catch(error => console.error("Error:", error));
            });
        } else {
            console.error("Error: #completePhaseForm not found in the DOM.");
        }
    });
</script>



<style>
    #completePhaseModal {
        display: none;
        position: fixed;
        top: 50%;
        justify-content: center;
        align-items: center;
        left: 50%;
        transform: translate(-50%, -50%);
        background: white;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
        padding: 20px;
        z-index: 9999999999999999999999;
        width: 400px;
        gap: 10px;
        border-radius: 8px;
        text-align: center;
    }

    #completePhaseForm {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 10px;
        width: 100%;
    }

    .modal-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 15px;
        width: 100%;
    }

    .modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.4);
        z-index: 999999999999999999999;
    }


    #completePhaseModal.active,
    .modal-overlay.active {
        display: flex !important;
    }

    /* Modal Buttons */
    .close-btnn {
        background: #dc3545;
        color: white;
        border: none;
        padding: 8px 15px;
        cursor: pointer;
        font-size: 14px;
        border-radius: 5px;
        transition: .2s ease-in-out;
    }

    .close-btnn:hover {
        background: #c82333;
    }

    .save-btn {
        background: var(--third-color);
        color: white;
        padding: 10px;
        border: none;
        cursor: pointer;
        font-size: 14px;
        border-radius: 5px;
        transition: .2s ease-in-out;
    }

    .save-btn:hover {
        background: #e6612a;
    }

    /* Inputs */
    .modal-content input {
        width: 90%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }


    .spinner-text {
        margin-bottom: 0 !important;
    }

    .spinner-container {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: 5px;
    }

    .spinner {
        width: 15px;
        height: 15px;
        border: 3px solid rgba(0, 183, 241, 0.3);
        border-top: 3px solid #00b7f1;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    .spinner-text {
        font-size: 12px;
        color: #00b7f1;
        font-weight: bold;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .selected-row {
        background-color: rgba(164, 178, 182, 0.1) !important;
        box-shadow: inset 0px 0px 10px rgba(0, 0, 0, 0.3) !important;
        font-weight: bold !important;
        transition: all 0.3s ease-in-out;
    }

    .gridjs-tbody tr.selected-row td {
        background-color: rgba(133, 141, 143, 0.1) !important;
    }

    .gridjs-tbody tr:hover {
        background-color: rgba(133, 141, 143, 0.1);
    }

    .progress-bar {
        margin-bottom: 10px;
        width: 100%;
    }

    .progress-bar p {
        font-size: 14px;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .progress {
        width: 100%;
        height: 10px;
        background: #e0e0e0;
        border-radius: 5px;
        overflow: hidden;
    }

    .progress-fill {
        height: 100%;
        transition: width 0.5s ease-in-out;
    }

    .gridjs-pagination .gridjs-pages {
        display: flex !important;
    }

    input.gridjs-input {
        width: 100%;
    }
</style>
