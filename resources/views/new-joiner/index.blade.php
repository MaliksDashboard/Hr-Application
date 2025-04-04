@extends('layouts.master')
@section('title', 'New Joiners System')
@section('custom_title', 'New Joiners Details')

@section('main')

    <div class="main new-joiners ">
        <h2 class="text-2xl font-semibold mb-4">New Joiner Progress Tracker</h2>
        <div class="flex w-full md:flex-row md:items-center md:justify-start gap-4">

            <a href="{{ route('new-joiners.create') }}"
                class="mb-4 inline-flex items-center gap-2 px-4 py-2 bg-orange-600 text-white rounded-full shadow hover:bg-orange-700 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Add New Joiner
            </a>

            <a href="{{ url('/steps') }}"
                class="mb-4 inline-flex items-center gap-2 px-4 py-2 bg-orange-600 text-white rounded-full shadow hover:bg-orange-700 transition">
                Steps Editor
            </a>

        </div>

        <div class="w-full flex flex-col md:flex-row md:items-center md:justify-start  gap-4">

            <div id="step-buttons" class="flex flex-wrap gap-2">
                <!-- Buttons will be injected dynamically by JS -->
            </div>

        </div>

        <!-- Search Box -->
        <input type="text" id="joinerSearch" placeholder="Search by name or job..."
            class="w-full md:w-72 px-3 py-2 text-sm  border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 w-full" id="new-joiner-cards">

        </div>
    </div>

    <!-- Completion Modal -->
    <div id="completionModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-md relative">
            <h2 class="text-lg font-bold mb-4">Mark Step as Completed</h2>

            <form id="completeForm">
                <input type="hidden" id="joinerIdInput">
                <input type="hidden" id="stepIdInput" name="step_id">

                <label class="block text-sm mb-1">Completion Date</label>
                <input type="date" id="completionDate" name="completion_date"
                    class="w-full border border-gray-300 rounded px-3 py-2 mb-3" value="{{ now()->format('Y-m-d') }}">

                <label class="block text-sm mb-1">Remarks (optional)</label>
                <textarea id="completionRemarks" name="remarks" rows="3"
                    class="w-full border border-gray-300 rounded px-3 py-2 mb-4"></textarea>

                <div class="flex justify-end gap-2">
                    <button type="button" id="cancelModal"
                        class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Cancel</button>
                    <button type="submit"
                        class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Confirm</button>
                </div>
            </form>
        </div>
    </div>

    <!-- History Modal -->
    <div id="historyModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl p-6 relative">
            <button id="closeHistoryModal"
                class="absolute top-2 right-2 text-gray-500 hover:text-black text-xl font-bold">&times;</button>

            <div class="flex items-center gap-4 mb-4">
                <div id="historyAvatar"
                    class="bg-orange-600 text-white font-bold rounded-full w-14 h-14 flex items-center justify-center text-xl">
                </div>
                <div>
                    <h2 id="historyName" class="text-xl font-bold"></h2>
                    <p class="text-sm text-gray-600" id="historyJobBranch"></p>
                    <p class="text-xs text-gray-500" id="historyStartDate"></p>
                </div>
            </div>

            <table class="w-full text-sm border border-gray-200 rounded overflow-hidden">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="text-left px-4 py-2 border">Step</th>
                        <th class="text-left px-4 py-2 border">Status</th>
                        <th class="text-left px-4 py-2 border">Completed At</th>
                        <th class="text-left px-4 py-2 border">Remarks</th>
                    </tr>
                </thead>
                <tbody id="historyTable" class="bg-white divide-y divide-gray-100">
                    <!-- Filled by JS -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Reference Modal -->
    <div id="referenceModal"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden modal">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-6 relative">
            <h2 class="text-xl font-bold mb-4">Reference Step Completion</h2>

            <form id="referenceForm">
                <input type="hidden" id="referenceJoinerId" name="joiner_id">

                <div class="col-span-2">
                    <label class="block text-sm font-medium">Completion Date</label>
                    <input type="date" id="referenceDate" name="completion_date" class="w-full border px-3 py-2 rounded"
                        required>
                </div>

                <div class="col-span-2">
                    <label class="block text-sm font-medium">Remarks (optional)</label>
                    <textarea id="referenceRemarks" name="remarks" rows="3" class="w-full border px-3 py-2 rounded"></textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium">Company Name</label>
                        <input type="text" name="company_name" id="companyName" class="w-full border px-3 py-2 rounded"
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Contact Name</label>
                        <input type="text" name="contact_name" id="contactName"
                            class="w-full border px-3 py-2 rounded" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Phone</label>
                        <input type="text" name="phone" id="contactPhone" class="w-full border px-3 py-2 rounded"
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Old Position</label>
                        <input type="text" name="position" id="contactPosition"
                            class="w-full border px-3 py-2 rounded" required>
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-medium">Feedback</label>
                        <textarea name="feedback" id="referenceFeedback" rows="3" class="w-full border px-3 py-2 rounded" required></textarea>
                    </div>

                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="have_recommendation_letter" id="recommendationLetter">
                        <label for="recommendationLetter" class="text-sm">Has Recommendation Letter</label>
                    </div>

                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="has_sejel" id="hasSejel" value="1">
                        <label for="hasSejel" class="text-sm">Has Sejel</label>
                    </div>
                </div>

                <div class="flex justify-end gap-4 mt-6">
                    <button type="button" id="cancelReferenceModal"
                        class="text-sm px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded">
                        Cancel
                    </button>
                    <button type="submit" class="text-sm px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>


    <script>
        // Store active step globally
        let activeStep = 'all';
        // 👉 1. Load Step Buttons + Badge Counts
        function loadStepFilters() {
            fetch('/new-joiners/steps-with-count')
                .then(res => res.json())
                .then(steps => {
                    const container = document.getElementById('step-buttons');
                    container.innerHTML = '';

                    steps.forEach(step => {
                        const btn = document.createElement('button');
                        btn.setAttribute('data-step', step.id);
                        btn.setAttribute('data-color', step.color);

                        const isAll = step.id === 'all';
                        const bgColor = isAll ? 'bg-orange-500' : ''; // default for "All"
                        const textColor = isAll ? 'text-white' : 'text-gray-800';

                        btn.className =
                            `step-filter-btn flex items-center gap-2 px-4 py-1.5 text-sm font-medium rounded-full ${bgColor} ${textColor} hover:opacity-90 transition`;

                        btn.style.backgroundColor = !isAll ? step.color : ''; // ✅ From DB
                        btn.setAttribute('data-color', isAll ? '#f97316' : step.color); // fallback if needed

                        btn.style.color = !isAll ? 'white' : '';

                        btn.innerHTML = `
                            <span>${step.name}</span>
                            <span id="badge-${step.id}" class="inline-flex items-center justify-center w-5 h-5 text-xs font-bold text-white rounded-full"
                                  style="background:${step.color}">
                                  ${step.count}
                            </span>
                                  `;
                        container.appendChild(btn);
                    });

                    bindStepButtonEvents(); // Rebind click events
                })
                .catch(err => console.error("❌ Failed to load step filters:", err));
        }

        // 👉 2. Bind filter button click events
        function bindStepButtonEvents() {
            document.querySelectorAll('.step-filter-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    // Clear all
                    document.querySelectorAll('.step-filter-btn').forEach(b => {
                        b.classList.remove('active-step');
                        b.style.backgroundColor = '';
                        b.style.color = '';
                    });

                    // Set active style
                    this.classList.add('active-step');
                    const stepColor = this.dataset.color || '#333333';
                    this.style.backgroundColor = stepColor;
                    this.style.color = '#fff';

                    activeStep = this.getAttribute('data-step');
                    loadJoiners(activeStep);
                });
            });
        }

        // 👉 3. Load Joiners for given step (or 'all')
        function loadJoiners(stepId = 'all') {
            console.log(`🔄 Loading joiners for step: ${stepId}`);

            fetch(`/new-joiners/filter/${stepId}`)
                .then(res => res.json())
                .then(joiners => {
                    const container = document.getElementById('new-joiner-cards');
                    container.innerHTML = '';

                    const isAll = stepId === 'all';

                    // 🔍 Get search query
                    const searchValue = document.getElementById('joinerSearch')?.value?.toLowerCase() || '';

                    // 🧠 Filter by search (inside the same step)
                    const filteredJoiners = joiners.filter(j =>
                        j.name.toLowerCase().includes(searchValue)
                    );

                    if (filteredJoiners.length === 0) {
                        container.innerHTML =
                            `<p class="text-center text-gray-500 col-span-3">No records found for this step.</p>`;
                        return;
                    }

                    filteredJoiners.forEach(j => {
                        const isCompleted = j.current_step_status === 'completed';

                        // ❌ Skip COMPLETED joiners in step views
                        if (isCompleted && !isAll) {
                            console.log(`⛔ Skipping ${j.name} because it's completed and not in 'all'`);
                            return;
                        }

                        const showComplete = j.current_step_status === 'pending' && !isAll;
                        const showRollback = j.current_step_status === 'pending' && j.is_rollbackable && !isAll;

                        const initials = j.name.split(' ').map(n => n[0]).join('').toUpperCase().substring(0,
                            2);
                        const started = new Date(j.start_date).toLocaleDateString('en-GB');

                        console.log(
                            `✅ Showing ${j.name} | rollback=${showRollback} | complete=${showComplete}`);

                        container.innerHTML += `
                    <div class="bg-white rounded-2xl shadow p-4 flex flex-col gap-3">
                        <div class="flex items-center gap-4">
                            <div class="bg-orange-600 text-white font-bold rounded-full w-12 h-12 flex items-center justify-center text-lg">
                                ${initials}
                            </div>
                            <div class="flex-1">
                               <div class="flex flex-row gap-4 justify-start items-center">
                                <h3 class="text-lg font-bold leading-tight">${j.name}</h3>
                                <button class="view-history-btn bg-gray-100 text-gray-800 text-sm px-3 py-1 rounded hover:bg-gray-200 transition"
                                    data-id="${j.id}">
                                        View
                                </button>
                                ${j.is_reference_exists ? `
                                                                                                                                                                                     <button class="view-ref-btn bg-purple-100 text-purple-700 text-sm px-3 py-1 rounded hover:bg-purple-200 transition"
                                                                                                                                                                                     data-id="${j.id}">
                                                                                                                                                                                     Ref
                                                                                                                                                                                    </button>` : ''}
                                </div>
                                <p class="text-sm text-gray-600">${j.job || 'No Job'} @ ${j.target_branch || '-'}</p>
                                <p class="text-xs text-gray-400">Started: ${started}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-3 py-1 rounded-full">
                                ${j.current_step}
                            </span>
                            <span class="text-yellow-600 text-sm font-semibold">
                                ${j.current_step_status}
                            </span>
                        </div>

                        <div class="flex items-center gap-2 mt-2">
                            <a href="/new-joiners/${j.id}/edit"
                                class="bg-blue-100 text-blue-700 text-sm px-3 py-1 rounded hover:bg-blue-200 transition">
                                Edit
                            </a>
                            <button data-id="${j.id}"
                                class="delete-joiner-btn bg-red-100 text-red-700 text-sm px-3 py-1 rounded hover:bg-red-200 transition">
                                Delete
                            </button>

                          ${showComplete ? `
                                                                                                                                                                                     <button class="complete-step-btn bg-green-600 text-white text-sm px-3 py-1 rounded hover:bg-green-700 transition"
                                                                                                                                                                                     data-id="${j.id}"
                                                                                                                                                                                     data-reference="${j.is_reference_step}">
                                                                                                                                                                                       Completed
                                                                                                                                                                                     </button>
                                                                                                                                                                                ` : ''}

                            ${showRollback ? `
                                                                                                                                                                                         <button class="rollback-btn bg-yellow-100 text-yellow-700 text-sm px-3 py-1 rounded hover:bg-yellow-200 transition"
                                                                                                                                                                                              data-id="${j.id}"
                                                                                                                                                                                              data-step="${j.current_step_id}">
                                                                                                                                                                                                 Rollback
                                                                                                                                                                                             </button>
                                                                                                                                                                                            ` : ''}
                        </div>
                    </div>
                `;
                    });
                })
                .catch(err => {
                    console.error("❌ Error loading joiners:", err);
                });
        }

        document.getElementById('joinerSearch').addEventListener('input', () => {
            loadJoiners(activeStep);
        });

        document.addEventListener('DOMContentLoaded', function() {
            loadStepFilters();
            loadJoiners();
        });

        function performRollback(joinerId, stepId) {
            fetch(`/new-joiners/rollback/${joinerId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        step_id: stepId // ✅ pass step_id to match Laravel controller
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire('Rolled Back!', data.success, 'success');
                        loadJoiners(activeStep);
                        loadStepFilters();
                    } else {
                        Swal.fire('Error', data.error || 'Could not rollback step.', 'error');
                    }
                })
                .catch(err => {
                    console.error(err);
                    Swal.fire('Error', 'Failed to rollback step.', 'error');
                });
        }

        // 🔥 Bind delete buttons
        document.addEventListener('click', function(e) {
            if (e.target.closest('a')) return; // ✅ Let links work as usual

            if (e.target.classList.contains('delete-joiner-btn')) {
                const id = e.target.getAttribute('data-id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e3342f',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        deleteJoiner(id);
                    }
                });
            }
        });

        function deleteJoiner(id) {
            fetch(`/new-joiners/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(res => res.json())
                .then(response => {
                    if (response.success) {
                        Swal.fire('Deleted!', response.success, 'success');
                        window.location.reload();
                        loadStepFilters(); // Update step counts
                    } else {
                        Swal.fire('Error', response.error || 'Something went wrong!', 'error');
                    }
                })
                .catch(err => {
                    console.error("❌ Delete Error:", err);
                    Swal.fire('Error', 'Failed to delete joiner.', 'error');
                });
        }

        document.getElementById('cancelModal').addEventListener('click', () => {
            if (e.target.closest('a')) return; // ✅ Let links work as usual

            document.getElementById('completionModal').classList.add('hidden');
        });

        // Submit completion form
        document.getElementById("completeForm").addEventListener("submit", function(e) {
            e.preventDefault();

            const joinerId = document.getElementById("joinerIdInput").value;
            const completionDate = document.getElementById("completionDate").value;
            const remarks = document.getElementById("completionRemarks").value;
            const stepId = document.getElementById("stepIdInput").value;

            fetch(`/new-joiners/mark-complete/${joinerId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        completion_date: completionDate,
                        remarks: remarks,
                        step_id: stepId // ✅ FIXED
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        // ✅ Show alert
                        Swal.fire({
                            icon: 'success',
                            title: 'Step marked as completed!',
                            showConfirmButton: false,
                            timer: 1500
                        });

                        // ✅ Close modal
                        document.getElementById("completionModal").classList.add("hidden");

                        // ✅ Reload cards
                        window.location.reload();
                    } else {
                        Swal.fire("Error", "Something went wrong", "error");
                    }
                })
                .catch(err => {
                    console.error(err);
                    Swal.fire("Error", "Could not complete step", "error");
                });
        });

        // Submit the ref form
        document.getElementById("referenceForm").addEventListener("submit", function(e) {
            e.preventDefault();

            const joinerId = document.getElementById("referenceJoinerId").value;

            const data = {
                completion_date: document.getElementById("referenceDate").value,
                remarks: document.getElementById("referenceRemarks").value,
                company_name: document.getElementById("companyName").value,
                contact_name: document.getElementById("contactName").value,
                phone: document.getElementById("contactPhone").value,
                position: document.getElementById("contactPosition").value,
                feedback: document.getElementById("referenceFeedback").value,
                have_recommendation_letter: document.getElementById("recommendationLetter").checked,
                has_sejel: document.getElementById("hasSejel").checked ? 1 : 0,
            };

            fetch(`/new-joiners/complete-reference/${joinerId}`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector("meta[name='csrf-token']").content,
                    },
                    body: JSON.stringify(data),
                })
                .then((res) => res.json())
                .then((res) => {
                    if (res.success) {
                        Swal.fire("Success", res.success, "success");
                        document.getElementById("referenceModal").classList.add("hidden");
                        loadJoiners(activeStep);
                        loadStepFilters();
                    } else {
                        Swal.fire("Error", res.error || "Something went wrong", "error");
                    }
                })
                .catch((err) => {
                    console.error("❌", err);
                    Swal.fire("Error", "Failed to submit reference data", "error");
                });
        });

        document.addEventListener('click', function(e) {
            if (e.target.closest('a')) return; // ✅ Let links work as usual

            if (e.target.id === 'cancelReferenceModal') {
                document.getElementById('referenceModal').classList.add('hidden');
            }
        });

        document.addEventListener('click', function(e) {
            if (e.target.closest('a')) return; // ✅ Let links work as usual

            if (e.target.classList.contains('modal')) {
                e.target.classList.add('hidden');
            }
        });

        // Roll Back
        document.addEventListener('click', function(e) {
            if (e.target.closest('a')) return; // ✅ Let links work as usual

            if (e.target.classList.contains('rollback-btn')) {
                const joinerId = e.target.dataset.id;
                const stepId = e.target.dataset.step; // this should exist in your button

                Swal.fire({
                    title: 'Rollback Step?',
                    text: "This will revert this joiner to the previous step.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#f59e0b',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Yes, Rollback'
                }).then((result) => {
                    if (result.isConfirmed) {
                        performRollback(joinerId, stepId); // ✅ fixed here
                    }
                });
            }
        });

        //View History
        document.addEventListener('click', function(e) {
            if (e.target.closest('a')) return; // ✅ Let links work as usual

            if (e.target.classList.contains('view-history-btn')) {
                const id = e.target.dataset.id;

                fetch(`/new-joiners/${id}/history`)
                    .then(res => res.json())
                    .then(history => {
                        // 💡 Fill in the employee info
                        const name = history[0]?.name || 'Unknown';
                        const initials = name.split(' ').map(n => n[0]).join('').toUpperCase().substring(0, 2);

                        document.getElementById('historyAvatar').textContent = initials;
                        document.getElementById('historyName').textContent = name;
                        document.getElementById('historyJobBranch').textContent =
                            `${history[0]?.job || 'No Job'} @ ${history[0]?.target_branch || '-'}`;
                        document.getElementById('historyStartDate').textContent =
                            `Started: ${new Date(history[0]?.start_date).toLocaleDateString('en-GB')}`;

                        // 💡 Fill in the steps
                        const tableBody = document.getElementById('historyTable');
                        tableBody.innerHTML = '';

                        history.forEach(step => {
                            const statusColor = step.status === 'completed' ? 'text-green-600' :
                                'text-yellow-600';
                            const formattedDate = step.completed_at ?
                                new Date(step.completed_at).toLocaleDateString('en-GB', {
                                    day: '2-digit',
                                    month: 'short',
                                    year: 'numeric',
                                }) :
                                '-';

                            tableBody.innerHTML += `
                        <tr>
                            <td class="px-4 py-2 border">${step.step}</td>
                            <td class="px-4 py-2 border ${statusColor}">${step.status}</td>
                            <td class="px-4 py-2 border">${formattedDate}</td>
                            <td class="px-4 py-2 border">${step.remarks || '-'}</td>
                        </tr>
                    `;
                        });

                        // 💡 Show the modal
                        document.getElementById('historyModal').classList.remove('hidden');
                    })
                    .catch(err => {
                        console.error("❌ Error loading history:", err);
                        Swal.fire('Error', 'Could not fetch history.', 'error');
                    });
            }

            const modal = document.getElementById('historyModal');

            // Close when clicking outside the modal content
            if (e.target === modal) {
                modal.classList.add('hidden');
            }

            // Close modal
            if (e.target.id === 'closeHistoryModal') {
                document.getElementById('historyModal').classList.add('hidden');
            }
        });

        //Submiting the Ref Check Data
        document.addEventListener('click', function(e) {
            if (e.target.closest('a')) return; // ✅ Let links work as usual

            if (e.target.classList.contains('complete-step-btn')) {
                const joinerId = e.target.dataset.id;
                const isReferenceStep = e.target.dataset.reference == "1" || e.target.dataset.reference === true ||
                    e.target.dataset.reference === "true";

                console.log("🔘 Clicked Complete Button for Joiner:", joinerId);
                console.log("📌 isReferenceStep:", isReferenceStep);

                // Hide both modals to ensure no overlap
                document.getElementById('completionModal').classList.add('hidden');
                document.getElementById('referenceModal').classList.add('hidden');

                if (isReferenceStep) {
                    console.log("🔁 This is a Reference Step - Fetching reference data...");

                    fetch(`/new-joiners/${joinerId}/reference`)
                        .then(res => {
                            console.log("📥 Reference Data Response Status:", res.status);
                            return res.json();
                        })
                        .then(data => {
                            console.log("📄 Reference Data Received:", data);

                            document.getElementById('referenceJoinerId').value = joinerId;
                            document.getElementById('referenceDate').value = new Date().toISOString().split(
                                'T')[0];
                            document.getElementById('referenceRemarks').value = '';

                            document.getElementById('companyName').value = data?.company_name || '';
                            document.getElementById('contactName').value = data?.contact_name || '';
                            document.getElementById('contactPhone').value = data?.phone || '';
                            document.getElementById('contactPosition').value = data?.position || '';
                            document.getElementById('referenceFeedback').value = data?.feedback || '';
                            document.getElementById('recommendationLetter').checked = data
                                ?.have_recommendation_letter == 1;
                            document.getElementById('hasSejel').checked = data?.has_sejel == 1;

                            console.log("✅ Showing Reference Modal");
                            document.getElementById('referenceModal').classList.remove('hidden');
                        })
                        .catch(err => {
                            console.error("❌ Error fetching reference data:", err);
                            Swal.fire("Error", "Could not load reference data.", "error");
                        });

                } else {
                    console.log("🟢 This is a Normal Step - Showing normal modal");
                    document.getElementById('joinerIdInput').value = joinerId;
                    document.getElementById('completionDate').value = new Date().toISOString().split('T')[0];
                    document.getElementById('completionModal').classList.remove('hidden');
                    document.getElementById('stepIdInput').value = e.target.dataset.step; // ✅

                }
            }
        });

        //view ref data
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('view-ref-btn')) {
                const joinerId = e.target.dataset.id;

                fetch(`/new-joiners/${joinerId}/reference`)
                    .then(res => res.json())
                    .then(data => {
                        Swal.fire({
                            title: `
                        <div class="border-b border-orange-500 pb-2 mb-3">
                            <h2 class="text-lg font-semibold text-gray-800 tracking-wide">
                                Reference Details
                            </h2>
                        </div>
                    `,
                            html: `
                        <div class="text-sm text-gray-800 max-h-[400px] overflow-y-auto px-1 space-y-3">
                            ${infoRow("Company", data.company_name)}
                            ${infoRow("Contact Person", data.contact_name)}
                            ${infoRow("Phone Number", data.phone)}
                            ${infoRow("Position", data.position)}
                            ${infoRow("Feedback", data.feedback)}
                            ${badgeRow("Recommendation Letter", data.have_recommendation_letter)}
                            ${badgeRow("Sejel", data.has_sejel)}
                        </div>
                    `,
                            background: '#fff',
                            showConfirmButton: true,
                            confirmButtonText: 'Close',
                            customClass: {
                                popup: 'p-6 rounded-xl shadow-xl max-w-xl',
                                confirmButton: 'mt-4 bg-orange-500 hover:bg-orange-600 text-white font-semibold px-6 py-2 rounded-md',
                            }
                        });
                    })
                    .catch(err => {
                        console.error("❌ Error loading reference data:", err);
                        Swal.fire('Error', 'Could not fetch reference data.', 'error');
                    });
            }

            function infoRow(label, value) {
                return `
            <div class="flex justify-between items-start border border-gray-200 rounded-md px-4 py-2 bg-gray-50">
                <span class="font-medium text-gray-600">${label}:</span>
                <span class="text-right max-w-[65%] break-words">${value || '<span class="text-gray-400 italic">N/A</span>'}</span>
            </div>
        `;
            }

            function badgeRow(label, status) {
                const color = status ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700';
                const badge = status ? 'Yes ✅' : 'No ❌';
                return `
            <div class="flex justify-between items-center border border-gray-200 rounded-md px-4 py-2 bg-gray-50">
                <span class="font-medium text-gray-600">${label}:</span>
                <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full ${color}">
                    ${badge}
                </span>
            </div>
        `;
            }
        });
    </script>

    <style>
        header {
            z-index: 50 !important;
        }

        div:where(.swal2-container) h2:where(.swal2-title) {
            font-size: 0 !important;
        }
    </style>
@endsection
