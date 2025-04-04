@extends('layouts.master')
@section('title', 'All Employees')
@section('custom_title', 'Employees')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<meta name="csrf-token" content="{{ csrf_token() }}">

@section('main')
    <div class="main">

        <div class="header">
            <div class="search">
                <form action="{{ route('employees.index') }}" method="GET" style="display: flex; width: 100%;">
                    <input style="margin-top: 0" type="text" name="search" id="search-box" class="search-input"
                        placeholder="Search Here" value="{{ request('search') }}"
                        onkeypress="return event.keyCode != 13 || this.form.submit();">

                    <select name="branch" id="branch-filter" class="search-input" onchange="this.form.submit()">
                        <option value="">All Branches</option>
                        @foreach ($branches as $branch)
                            <option value="{{ $branch->id }}" {{ request('branch') == $branch->id ? 'selected' : '' }}>
                                {{ $branch->branch_name }}
                            </option>
                        @endforeach
                    </select>

                    <select name="job" id="job-filter" class="search-input" onchange="this.form.submit()">
                        <option value="">All Jobs</option>
                        @foreach ($jobs as $job)
                            <option value="{{ $job->id }}" {{ request('job') == $job->id ? 'selected' : '' }}>
                                {{ $job->name }}
                            </option>
                        @endforeach
                    </select>

                </form>

            </div>

            <div class="count">
                @if (request()->has('search'))
                    <button id="clear-search" style="">
                        <svg width="800" height="800" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                            fill="none">
                            <path fill="#fff" stroke="red" stroke-width="2"
                                d="M18 4H6c-1.105 0-2.026.91-1.753 1.98a8.02 8.02 0 0 0 4.298 5.238c.823.394 1.455 1.168 1.455 2.08v6.084a1 1 0 0 0 1.447.894l2-1a1 1 0 0 0 .553-.894v-5.084c0-.912.632-1.686 1.454-2.08a8.02 8.02 0 0 0 4.3-5.238C20.025 4.91 19.103 4 18 4z" />
                        </svg>
                        <span style="color: red; font-size: 14px;">X Clear</span>
                    </button>
                @endif
                <p id="emp-count"></p>
                <div id="new-hire"></div>
            </div>

            <div class="actions">
                <div class="actions-first">

                    <div id="count-select">
                    </div>
                    <input type="hidden" name="selected_ids" id="selected_ids">

                    @can('Delete')
                        <form id="bulk-delete-form" action="{{ route('employees.bulkDelete') }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="button" class="bulk-delete-btn">
                                <svg class="dlt" viewBox="0 0 24 24" fill="" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2h4a1 1 0 1 1 0 2h-1.069l-.867 12.142A2 2 0 0 1 17.069 22H6.93a2 2 0 0 1-1.995-1.858L4.07 8H3a1 1 0 0 1 0-2h4zm2 2h6V4H9zM6.074 8l.857 12H17.07l.857-12zM10 10a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1m4 0a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1" />
                                </svg>
                            </button>
                        </form>
                    @endcan

                    <button style="display: none" id="moreActions">
                        <svg viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M8.625 2.5a1.125 1.125 0 1 1-2.25 0 1.125 1.125 0 0 1 2.25 0m0 5a1.125 1.125 0 1 1-2.25 0 1.125 1.125 0 0 1 2.25 0M7.5 13.625a1.125 1.125 0 1 0 0-2.25 1.125 1.125 0 0 0 0 2.25" />
                        </svg>
                    </button>

                    <div class="more-actions">
                        <div id="tag"><svg viewBox="0 0 24 24" data-name="Line Color"
                                xmlns="http://www.w3.org/2000/svg" class="icon line-color">
                                <path
                                    d="M16 12a4 4 0 1 1-4-4 4 4 0 0 1 4 4m0-3v5.5a2.5 2.5 0 0 0 2.5 2.5h0a2.5 2.5 0 0 0 2.5-2.5v-2.19A9.2 9.2 0 0 0 12.6 3a9 9 0 1 0-.6 18 8.8 8.8 0 0 0 3-.52"
                                    style="fill:none;stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:2" />
                            </svg> Add Tags
                        </div>

                        <div id="clone"><svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M464 0H144c-26.51 0-48 21.49-48 48v48H48c-26.51 0-48 21.49-48 48v320c0 26.51 21.49 48 48 48h320c26.51 0 48-21.49 48-48v-48h48c26.51 0 48-21.49 48-48V48c0-26.51-21.49-48-48-48M362 464H54a6 6 0 0 1-6-6V150a6 6 0 0 1 6-6h42v224c0 26.51 21.49 48 48 48h224v42a6 6 0 0 1-6 6m96-96H150a6 6 0 0 1-6-6V54a6 6 0 0 1 6-6h308a6 6 0 0 1 6 6v308a6 6 0 0 1-6 6" />
                            </svg> Clone
                        </div>

                        <div id="download">
                            <svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M232 64h48v150l-3 56 23-28 56-53 32 32-132 132-132-132 32-32 56 53 23 28-3-56zM64 400h384v48H64z" />
                            </svg> Download Zip
                        </div>
                    </div>

                    {{-- <div class="view-style">

                        <button id="card-view">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-grid">
                                <rect x="3" y="3" width="7" height="7"></rect>
                                <rect x="14" y="3" width="7" height="7"></rect>
                                <rect x="14" y="14" width="7" height="7"></rect>
                                <rect x="3" y="14" width="7" height="7"></rect>
                            </svg>
                        </button>

                        <button id="table-view">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                                <path d="M3 9h18M3 15h18M12 3v18" />
                            </svg>
                        </button>
                    </div> --}}
                </div>

                <div class="actions-second">
                    <form id="exportForm" action="{{ route('export.employees') }}" method="GET">
                        <!-- Hidden Inputs for Filters -->
                        <input type="hidden" name="search" id="exportSearch" value="{{ request('search') }}">
                        <input type="hidden" name="branch" id="exportBranch" value="{{ request('branch') }}">
                        <input type="hidden" name="job" id="exportJob" value="{{ request('job') }}">
                        <input type="hidden" name="date_hired_from" id="exportDateFrom"
                            value="{{ request('date_hired_from') }}">
                        <input type="hidden" name="date_hired_to" id="exportDateTo"
                            value="{{ request('date_hired_to') }}">

                        <button type="submit" class="pdf-down">
                            <svg viewBox="-5 -5 24 24" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMinYMin"
                                class="jam jam-download">
                                <path
                                    d="m8 6.641 1.121-1.12a1 1 0 0 1 1.415 1.413L7.707 9.763a.997.997 0 0 1-1.414 0L3.464 6.934A1 1 0 1 1 4.88 5.52L6 6.641V1a1 1 0 1 1 2 0zM1 12h12a1 1 0 0 1 0 2H1a1 1 0 0 1 0-2" />
                            </svg>
                        </button>
                    </form>

                    <form>
                        <button class="print" type="button" onclick="printEmployees()">
                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6 2h12v6h4v10h-4v4H6v-4H2V8h4zm2 6h8V4H8zm-2 8v-4h12v4h2v-6H4v6zm2-2v6h8v-6z" />
                            </svg>
                        </button>
                    </form>

                </div>

                @can('Create')
                    <a class="add-btn" href="{{ route('employees.create') }}"> <svg viewBox="0 0 24 24" version="1.2"
                            baseProfile="tiny" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M18 10h-4V6a2 2 0 0 0-4 0l.071 4H6a2 2 0 0 0 0 4l4.071-.071L10 18a2 2 0 0 0 4 0v-4.071L18 14a2 2 0 0 0 0-4" />
                        </svg>Add Candidate
                    </a>
                @endcan
            </div>
        </div>

        <div id="cards" class="cards">
            @include('partials.employee_cards') <!-- Load initial employees -->
        </div>

        {{ $employees->links('pagination::bootstrap-4') }}

        <div id="popupWrapper" class="popup-wrapper" style="display: none;">
            <div class="filesPopup" id="filesPopup">
                <div class="file-name">
                    <h1></h1>
                    <p></p>
                </div>
                <input type="text" name="search" id="search-file" placeholder="Search Here...">
                <div id="fileTreeView" class="file-tree-view"></div>
                <button class="close-popup">Close</button>
            </div>
        </div>

        <div id="subfolderPopup" class="popup-wrapper" style="display:none;">
            <div class="filesPopup">
                <h3>Select or Create Subfolder</h3>
                <select id="existingSubfolder">
                    <option value="">-- Select Existing Subfolder --</option>
                    <!-- options will be added dynamically -->
                </select>
                <input type="text" id="newSubfolder" placeholder="Or type new folder name"
                    title="Leave this empty if selecting from list">
                <button id="confirmSubfolder">Browse</button>
                <button onclick="document.getElementById('subfolderPopup').style.display='none';">Cancel</button>
            </div>
        </div>
    </div>

    <div id="sidebarOverlay" class="sidebar-overlay">

        <div id="employeeSidebar">
            <div class="sidebar-header">
                <button class="close-sidebar">&times;</button>
                <img id="employeeImage" src="/default.jpg" alt="Employee">
                <h2 id="sidebarName">Employee Name</h2>
                <p id="sidebarCodeJob">1234 - Developer</p>
                <p id="workingSince">2 years and 3 months</p>
            </div>

            <div id="sidebarTabs">
                <button data-tab="personal" class="active">Personal Info</button>
                <button data-tab="job">Job Details</button>
                <button data-tab="left" id="leftTabBtn" style="display: none;">Left Reason</button>
            </div>


            <div class="sidebar-content">

                <div id="section-personal" class="sidebar-section active">
                    <p><strong>Email:</strong> <span id="empEmail"></span></p>
                    <p><strong>Phone:</strong> <span id="empPhone"></span></p>
                    <p><strong>Birthday:</strong> <span id="empBirthday"></span></p>
                    <p><strong>Blood Type:</strong> <span id="empBlood"></span></p>
                    <p><strong>Address:</strong> <span id="empAddress"></span></p>
                    <p><strong>Car:</strong> <span id="empCar"></span></p>
                </div>

                <div id="section-job" class="sidebar-section">
                    <p><strong>Branch:</strong> <span id="empBranch"></span></p>
                    <p><strong>Status:</strong> <span id="empStatus"></span></p>
                    <p><strong>Title:</strong> <span id="empTitle"></span></p>
                    <p><strong>Start Date:</strong> <span id="startDate"></span></p>
                    <p><strong>Shift:</strong> <span id="empShift"></span></p>
                    <p><strong>Job:</strong> <span id="empJob"></span></p>
                    <p><strong>Where Can Work:</strong> <span id="empWhere"></span></p>
                </div>

                <div id="section-left" class="sidebar-section">
                    <p><strong>Left Date:</strong> <span id="empLeftDate"></span></p>
                    <p><strong>Reason:</strong> <span id="empLeftReason"></span></p>
                    <p><strong>Notice Given:</strong> <span id="empNotice"></span></p>
                    <p><strong>Good Performer:</strong> <span id="empPerformer"></span></p>
                    <p><strong>Positive Person:</strong> <span id="empPositive"></span></p>
                    <p><strong>Recommended to Return:</strong> <span id="empReturn"></span></p>
                    <p><strong>Exit Remarks:</strong> <span id="empRemarks"></span></p>
                </div>
            </div>
        </div>
    </div>

    <div id="imagePopup" class="popup-overlay" style="display: none;">
        <div class="popup-content">
            <div style="display: flex; justify-content: space-between;align-items: center; margin-bottom: 5px;">
                <p style="text-align: start; font-size: 15px; margin-bottom:0;" id="popupImageText">
                </p>
                <small id="popupClose" style="cursor: pointer; color: var(--second-color); font-size:15px; ">x</small>
            </div>
            <img id="popupImage" src="" alt="Popup Image">
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            //Count the checked boxes    
            const count = document.getElementById('count-select');
            const boxes = document.querySelectorAll('.box');

            function updateCount() {
                let selectedIds = [];
                boxes.forEach(function(box) {
                    if (box.checked) {
                        const card = box.closest('.card'); // Find the closest parent card
                        if (card) {
                            const id = card.getAttribute('data-id'); // Get the data-id of the card
                            if (id) {
                                selectedIds.push(id); // Add it to the list of selected IDs
                            }
                        }
                    }
                });


                if (selectedIds.length === 0) {
                    count.innerHTML = ``;
                } else {
                    count.innerHTML =
                        `<div style="display:flex; gap:5px; justify-content:center; align-items:center;">
                <p style="color:var(--second-color); font-weight:bold; font-size:24px;">` +
                        selectedIds.length + ` </p> 
            <p style="color: var(--second-color);"> Selected</p> </div>`;
                }

                // Update the hidden input field for form submission
                document.getElementById('selected_ids').value = selectedIds.join(',');
            }

            boxes.forEach((box) => {
                box.addEventListener('change', updateCount);
            });

            updateCount();



            // Open the More Actions box
            const moreActions = document.getElementById('moreActions');
            const boxActions = document.querySelector('.more-actions');

            moreActions.addEventListener('click', (e) => {
                e.stopPropagation();
                if (boxActions.classList.contains('box-visible')) {
                    boxActions.classList.remove('box-visible');
                    boxActions.classList.add('box-hidden');
                } else {
                    boxActions.classList.remove('box-hidden');
                    boxActions.classList.add('box-visible');
                }
            });

            document.addEventListener('click', () => {
                if (boxActions.classList.contains('box-visible')) {
                    boxActions.classList.remove('box-visible');
                    boxActions.classList.add('box-hidden');
                }
            });

            // Fetch employee count from API
            fetch('/countEmp')
                .then(response => response.json())
                .then(data => {
                    // Count Employees (Total)
                    const countEmp = document.getElementById('emp-count');
                    if (countEmp) {
                        countEmp.textContent = `${data.total_employees} `;
                    }

                    // Counting the New Joiners (Less than 6 months)
                    const newHire = document.getElementById('new-hire');
                    if (newHire) {
                        const countDate = data.new_joiners;
                        const plural = countDate === 1 ? '' : 's';
                        newHire.innerHTML =
                            `<small class="hire-alert">+ ${countDate} New Hire${plural}</small>`;
                    }
                })
                .catch(error => console.error('Error fetching employee count:', error));


            // Card More Actions
            const dots = document.querySelectorAll('.three-points');
            const cardActions = document.querySelectorAll('.card-more');

            dots.forEach((dot, index) => {
                dot.addEventListener('click', (e) => {
                    e.stopPropagation();
                    const isVisible = cardActions[index].classList.contains('show');

                    cardActions.forEach((card) => {
                        card.classList.remove('show');
                    });

                    if (!isVisible) {
                        cardActions[index].classList.add('show');
                    }
                });
            });

            document.addEventListener('click', () => {
                cardActions.forEach((card) => {
                    card.classList.remove('show');
                });
            });


            // Show confirmation popup and submit form
            function confirmBulkDelete() {
                const selectedIds = document.getElementById('selected_ids').value;

                if (!selectedIds) {
                    alert('No cards selected for deletion.');
                    return;
                }

                const popup = document.getElementById('deletePopup');
                popup.style.display = 'flex';

                document.getElementById('confirmDelete').addEventListener('click', () => {
                    document.getElementById('bulk-delete-form').submit();
                    popup.style.display = 'none';
                });

                document.getElementById('cancelDelete').addEventListener('click', () => {
                    popup.style.display = 'none';
                });
            }

            //show employee info
            const images = document.querySelectorAll('.image-trigger');

            images.forEach(image => {
                const imageId = image.getAttribute('data-id');
                const hoverCard = document.querySelector(`.card-hover[data-id="${imageId}"]`);

                if (hoverCard) {
                    image.addEventListener('mouseenter', () => {
                        // Show the hover card with smooth transition
                        hoverCard.style.opacity = '1';
                        hoverCard.style.transform = 'translateY(0)';
                        hoverCard.style.pointerEvents = 'auto'; // Allow interaction
                    });

                    image.addEventListener('mouseleave', () => {
                        // Hide the hover card with smooth transition
                        hoverCard.style.opacity = '0';
                        hoverCard.style.transform = 'translateY(-10px)';
                        hoverCard.style.pointerEvents = 'none'; // Prevent interaction
                    });
                }
            });


        });
        //sweetalert2

        document.addEventListener('DOMContentLoaded', () => {
            // Bulk Delete Confirmation
            document.querySelector('.bulk-delete-btn').addEventListener('click', (e) => {
                e.preventDefault(); // Prevent default button behavior
                const form = document.getElementById('bulk-delete-form');
                Swal.fire({
                    title: 'Confirm Bulk Deletion',
                    text: "Are you sure you want to delete selected items?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete them!',
                    cancelButtonText: 'Cancel',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Submit the form if confirmed
                    }
                });
            });

            // Single Delete Confirmation
            document.querySelectorAll('.delete-btn').forEach((button) => {
                button.addEventListener('click', (e) => {
                    e.preventDefault(); // Prevent default form submission
                    const form = button.closest('form');
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "This action cannot be undone!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'Cancel',
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit(); // Submit the form if confirmed
                        }
                    });
                });
            });
        });

        //Popup Image on click
        document.addEventListener('DOMContentLoaded', () => {
            const images = document.querySelectorAll('.image-trigger');
            const popOverLay = document.getElementById('imagePopup');
            const popupImage = document.getElementById('popupImage');
            const closePopup = document.getElementById('popupClose');
            const popupText = document.getElementById('popupImageText')

            images.forEach(image => {
                image.addEventListener('click', () => {
                    const name = image.closest('.card').querySelector('.name-emp');
                    popupImage.src = image.src;
                    popOverLay.style.display = 'flex';
                    popupText.textContent = name.textContent;
                })
            });

            popOverLay.addEventListener('click', (e) => {
                if (e.target === popOverLay) {
                    popOverLay.style.display = 'none';
                }
            })


            closePopup.addEventListener('click', () => {
                popOverLay.style.display = 'none'; // Hide the popup directly
            });
        })

        //show the files to download
        document.addEventListener('DOMContentLoaded', function() {
            const links = document.querySelectorAll('.get-files-link');
            const popupWrapper = document.getElementById('popupWrapper');
            const popup = document.getElementById('filesPopup');

            links.forEach(link => {
                link.addEventListener('click', async function(event) {
                    event.preventDefault(); // Prevent default behavior

                    const card = this.closest('.card');
                    if (card) {
                        const employeeName = card.querySelector('.name-emp').innerText.trim();
                        const pinCode = card.querySelector('#pinCode').innerText.trim().replace(
                            /[()]/g, '');

                        try {
                            const response = await fetch(
                                `/employee-files/${encodeURIComponent(employeeName)}/${encodeURIComponent(pinCode)}`
                            );
                            if (!response.ok) {
                                throw new Error('Failed to fetch files');
                            }

                            const data = await response.json();
                            const files = data.files;

                            // Update popup content
                            popup.querySelector('.file-name h1').innerText =
                                `${employeeName} (${pinCode})`;
                            popup.querySelector('.file-name p').innerText =
                                `${files.length} Files`;

                            const treeContainer = document.getElementById('fileTreeView');
                            treeContainer.innerHTML = '';

                            if (files.length === 0) {
                                const noFilesMsg = document.createElement('div');
                                noFilesMsg.style.textAlign = 'center';
                                noFilesMsg.style.color = 'var(--second-color)';
                                noFilesMsg.textContent = 'No files found';
                                treeContainer.appendChild(noFilesMsg);
                            } else {
                                const treeContainer = document.getElementById('fileTreeView');
                                treeContainer.innerHTML = '';

                                // Group files by folders (subfolder => [files])
                                const folders = {};

                                files.forEach(file => {
                                    const parts = file.name.split('/');
                                    const folder = parts.length > 1 ? parts[0] : 'Root';
                                    const filename = parts.length > 1 ? parts.slice(1)
                                        .join('/') : parts[0];

                                    if (!folders[folder]) folders[folder] = [];
                                    folders[folder].push({
                                        ...file,
                                        displayName: filename
                                    });
                                });

                                // Build UI
                                // Build all folders first
                                Object.entries(folders).forEach(([folderName, folderFiles]) => {
                                    const folder = document.createElement('div');
                                    folder.className = 'folder-block';
                                    folder.innerHTML = `
                                            <div class="folder-header" data-toggle>
                                                <span class="folder-icon">
                                                    <svg width="16" height="16" viewBox="0 0 16 16" stroke="#333" stroke-width="1.5" fill="none">
                                                        <path d="M4.75 2.25v8h9.5v-6.5h-5l-1.5-1.5z"/>
                                                        <path d="M4.75 5.25h-3v8h9.5v-3"/>
                                                    </svg>
                                                </span>
                                                <span class="folder-name">${folderName}</span>
                                            </div>
                                            <div class="file-list" style="display:none;"></div>
                                             `;

                                    const fileList = folder.querySelector('.file-list');
                                    folderFiles.forEach(file => {
                                        const fileItem = document.createElement(
                                            'div');
                                        fileItem.className = 'file-item';
                                        fileItem.innerHTML = `
                                                 <div class="file-entry">
                                                     <span class="file-icon">
                                                         <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="#000" stroke-width="2" viewBox="0 0 24 24">
                                                             <path d="M15.5 2H8.6c-.4 0-.8.2-1.1.5S7 3.2 7 3.6v12.8c0 .4.2.8.5 1.1s.7.5 1.1.5h9.8c.4 0 .8-.2.1-.5s.5-.7.5-1.1V6.5z"/>
                                                             <path d="M3 7.6v12.8c0 .4.2.8.5 1.1s.7.5 1.1.5h9.8M15 2v5h5"/>
                                                         </svg>
                                                     </span>
                                                        <span class="file-name" title="${file.displayName}">
                                                            ${file.displayName.length > 20 ? file.displayName.slice(0, 18) + '...' : file.displayName}
                                                        </span>
                                                 </div>
                                                 <div class="file-actions">
                                                     <a href="${file.url}" download title="Download">

                                                        <svg fill="#9da3af" class="files-download"  viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M232 64h48v150l-3 56 23-28 56-53 32 32-132 132-132-132 32-32 56 53 23 28-3-56zM64 400h384v48H64z"/></svg>
                                                        
                                                        </a>
                                                     <a href="javascript:void(0)" class="delete-file" 
                                                        data-employee-name="${employeeName}" 
                                                        data-pin-code="${pinCode}" 
                                                        data-file-name="${file.name}" 
                                                        title="Delete">
                                                        
                                                        <svg class="files-delete" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2h4a1 1 0 1 1 0 2h-1.069l-.867 12.142A2 2 0 0 1 17.069 22H6.93a2 2 0 0 1-1.995-1.858L4.07 8H3a1 1 0 0 1 0-2h4zm2 2h6V4H9zM6.074 8l.857 12H17.07l.857-12zM10 10a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1m4 0a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1" fill="#9da3af"/></svg>

                                                        </a>
                                                 </div>
                                             `;
                                        fileList.appendChild(fileItem);
                                    });

                                    treeContainer.appendChild(folder);
                                });

                                // ✅ Now bind expand/collapse AFTER tree is rendered
                                treeContainer.querySelectorAll('[data-toggle]').forEach(
                                    toggle => {
                                        toggle.addEventListener('click', () => {
                                            const list = toggle.nextElementSibling;
                                            list.style.display = list.style
                                                .display === 'none' ? 'flex' :
                                                'none';
                                        });
                                    });


                                const downloadAllBtn = document.createElement('button');
                                downloadAllBtn.id = 'downloadAll';
                                downloadAllBtn.className = 'download-all-btn';
                                downloadAllBtn.innerHTML = 'Download All';
                                downloadAllBtn.style.marginTop = '10px';
                                treeContainer.appendChild(downloadAllBtn);

                                // Add event listener to "Download All" button
                                document.getElementById('downloadAll').addEventListener('click',
                                    async () => {
                                        try {
                                            const zipResponse = await fetch(
                                                `/employee-files/${encodeURIComponent(employeeName)}/${encodeURIComponent(pinCode)}/download-all`
                                            );
                                            if (!zipResponse.ok) {
                                                throw new Error(
                                                    'Failed to download ZIP');
                                            }

                                            const blob = await zipResponse.blob();
                                            const url = window.URL.createObjectURL(
                                                blob);
                                            const a = document.createElement('a');
                                            a.href = url;
                                            a.download =
                                                `${employeeName}-${pinCode}.zip`;
                                            document.body.appendChild(a);
                                            a.click();
                                            a.remove();
                                            window.URL.revokeObjectURL(url);
                                        } catch (error) {
                                            console.error(error);
                                            alert(
                                                'Failed to download all files. Please try again later.'
                                            );
                                        }
                                    });
                            }

                            popupWrapper.style.display = 'flex';
                        } catch (error) {
                            console.error(error);
                            popup.querySelector('.file-name h1').innerText =
                                `${employeeName} (${pinCode})`;
                            popup.querySelector('.file-name p').innerText = `0 Files`;
                            popup.querySelector('.file-name h1').innerText =
                                `${employeeName} (${pinCode})`;
                            popup.querySelector('.file-name p').innerText = `0 Files`;

                            const treeContainer = document.getElementById('fileTreeView');
                            treeContainer.innerHTML =
                                `<div style="text-align:center;">No files found</div>`;

                            popupWrapper.style.display = 'flex';

                        }
                    }
                });
            });

            document.querySelector('.close-popup').addEventListener('click', function() {
                popupWrapper.style.display = 'none';
            });

            popupWrapper.addEventListener('click', function(event) {
                if (event.target === popupWrapper) {
                    popupWrapper.style.display = 'none';
                }
            });
        });

        //helper for upload files:
        document.addEventListener('DOMContentLoaded', function() {
            const uploadLinks = document.querySelectorAll('.upload-files-link');
            const fileInput = document.getElementById('fileUpload');
            const csrfToken = document.querySelector('meta[name="csrf-token"]');

            if (!csrfToken) {
                console.error('CSRF token not found in the HTML.');
                alert('CSRF token is missing. Please ensure it is included in the HTML.');
                return;
            }

            uploadLinks.forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault();

                    const card = this.closest('.card');
                    if (card) {
                        const employeeNameElement = card.querySelector('.name-emp');
                        const pinCodeElement = card.querySelector('#pinCode');

                        if (!employeeNameElement || !pinCodeElement) {
                            alert('Employee information not found.');
                            return;
                        }

                        const employeeName = employeeNameElement.innerText.trim();
                        const pinCode = pinCodeElement.innerText.trim().replace(/[()]/g, '');

                        fileInput.dataset.employeeName = employeeName;
                        fileInput.dataset.pinCode = pinCode;

                        document.getElementById('subfolderPopup').style.display = 'flex';
                        fileInput.dataset.employeeName = employeeName;
                        fileInput.dataset.pinCode = pinCode;

                        // Load existing subfolders
                        fetch(`/get-subfolders/${employeeName}/${pinCode}`)
                            .then(res => res.json())
                            .then(data => {
                                const select = document.getElementById('existingSubfolder');
                                select.innerHTML =
                                    `<option value="">-- Select Existing Subfolder --</option>`;
                                data.subfolders.forEach(sub => {
                                    const option = document.createElement('option');
                                    option.value = sub;
                                    option.textContent = sub;
                                    select.appendChild(option);
                                });
                            });

                        document.getElementById('existingSubfolder').addEventListener('change',
                            function() {
                                const newFolderInput = document.getElementById('newSubfolder');
                                if (this.value.trim() !== "") {
                                    newFolderInput.value = "";
                                    newFolderInput.setAttribute("readonly", "readonly");
                                } else {
                                    newFolderInput.removeAttribute("readonly");
                                }
                            });

                        document.getElementById('confirmSubfolder').addEventListener('click',
                            () => {
                                const selectVal = document.getElementById('existingSubfolder')
                                    .value.trim();
                                const newVal = document.getElementById('newSubfolder').value
                                    .trim();

                                let chosenFolder = newVal !== '' ? newVal : selectVal;
                                if (!chosenFolder) return alert(
                                    'Please choose or type a folder name');

                                fileInput.dataset.subfolder =
                                    chosenFolder; // ✅ save folder to dataset
                                document.getElementById('subfolderPopup').style.display =
                                    'none';
                                fileInput.click(); // trigger file select
                            });

                    } else {
                        alert('Employee card not found.');
                    }
                });
            });

            fileInput.addEventListener('change', async function() {
                if (!this.dataset.employeeName || !this.dataset.pinCode) {
                    alert('Employee information is missing.');
                    return;
                }

                const employeeName = this.dataset.employeeName;
                const pinCode = this.dataset.pinCode;
                const files = this.files;

                if (files.length === 0) return;

                const formData = new FormData();
                formData.append('employeeName', employeeName);
                formData.append('pinCode', pinCode);
                formData.append('subfolder', this.dataset.subfolder); // <== add this


                for (const file of files) {
                    if (file.name.endsWith('.zip')) {
                        alert('ZIP files are not allowed!');
                        return;
                    }
                    formData.append('files[]', file);
                }

                // Show SweetAlert Spinner
                Swal.fire({
                    title: 'Uploading...',
                    html: 'Please wait while your file is being uploaded.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                try {
                    const response = await fetch('/upload-employee-files', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
                        },
                    });

                    Swal.close(); // Close SweetAlert Spinner
                    document.getElementById('newSubfolder').value = '';
                    document.getElementById('existingSubfolder').selectedIndex = 0;

                    const contentType = response.headers.get('Content-Type');
                    if (!contentType.includes('application/json')) {
                        throw new Error('Invalid response type: ' + contentType);
                    }

                    const result = await response.json();

                    if (response.ok) {
                        new Notyf({
                            duration: 4000,
                            position: {
                                x: 'right',
                                y: 'top'
                            }
                        }).success(result.message);
                    } else {
                        new Notyf({
                            duration: 4000,
                            position: {
                                x: 'right',
                                y: 'top'
                            }
                        }).error(result.message || 'Failed to upload files');
                    }
                } catch (error) {
                    Swal.close();
                    console.error('Error during upload:', error);
                    new Notyf({
                        duration: 4000,
                        position: {
                            x: 'right',
                            y: 'top'
                        }
                    }).error('An error occurred during the file upload.');
                }
            });
        });

        //Delete Button for the file popup
        document.addEventListener('DOMContentLoaded', () => {
            document.body.addEventListener('click', async function(event) {
                const button = event.target.closest('.delete-file');
                if (!button) return; // Ignore clicks outside delete buttons

                const employeeName = button.getAttribute('data-employee-name');
                const pinCode = button.getAttribute('data-pin-code');
                const fileName = button.getAttribute('data-file-name');

                if (!employeeName || !pinCode || !fileName) {
                    alert('Missing required file information.');
                    return;
                }

                if (confirm(`Are you sure you want to delete ${fileName}?`)) {
                    try {
                        const response = await fetch('/delete-file', {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').content,
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                employeeName,
                                pinCode,
                                fileName
                            }),
                        });

                        const result = await response.json();

                        if (response.ok) {
                            alert(result.message || 'File deleted successfully.');

                            const fileItem = button.closest('.file-item');
                            if (fileItem) {
                                const folderBlock = fileItem.closest('.folder-block');
                                fileItem.remove();

                                const remaining = folderBlock.querySelectorAll('.file-item');
                                if (remaining.length === 0) {
                                    folderBlock.remove(); // Remove empty folder
                                }
                            } else {
                                console.error('Error: Could not find the file item to remove.');
                            }

                        } else {
                            alert(result.message || 'Failed to delete file.');
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        alert('An error occurred while deleting the file.');
                    }
                }
            });
        });

        //Search Functionality inside the files popup
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search-file');

            if (!searchInput) return;

            searchInput.addEventListener('input', function() {
                const searchValue = searchInput.value.toLowerCase().trim();

                // Loop through all folders
                document.querySelectorAll('.folder-block').forEach(folder => {
                    let matchFound = false;
                    const fileList = folder.querySelector('.file-list');

                    // Loop through all file items inside this folder
                    fileList.querySelectorAll('.file-item').forEach(fileItem => {
                        const fileName = fileItem.querySelector('.file-name')?.textContent
                            .toLowerCase() || '';
                        const match = fileName.includes(searchValue);
                        fileItem.style.display = match ? '' : 'none';
                        if (match) matchFound = true;
                    });

                    // Show folder if it contains at least one match
                    folder.style.display = matchFound ? '' : 'none';
                });
            });
        });



        document.addEventListener('DOMContentLoaded', () => {
            const filterSearch = document.getElementById('filter-search');
            const branchCheckboxes = document.querySelectorAll('.branch-checkbox');
            const cards = document.querySelectorAll('.card');
            const clearFilterButton = document.getElementById('clear-filter');


            // Listen for changes in the checkboxes
            branchCheckboxes.forEach((checkbox) => {
                checkbox.addEventListener('change', filterCards);
            });

            // Filter cards based on selected branches
            function filterCards() {
                const selectedBranches = Array.from(branchCheckboxes)
                    .filter((cb) => cb.checked)
                    .map((cb) => cb.value.toLowerCase());

                cards.forEach((card) => {
                    const branchName = card.querySelector('.details-second')?.textContent
                        .toLowerCase()
                        .trim();
                    card.style.display = selectedBranches.length === 0 || selectedBranches
                        .includes(
                            branchName) ?
                        'flex' :
                        'none';
                });
            }
        });

        document.addEventListener('DOMContentLoaded', () => {
            const clearSearchBtn = document.getElementById('clear-search');

            if (clearSearchBtn) {
                clearSearchBtn.addEventListener('click', () => {
                    window.location.href = "/employees"; // Redirect to remove search filter
                });
            }
        });

        document.addEventListener('DOMContentLoaded', () => {
            function updateEmployeeCount() {
                let search = document.getElementById('search-box')?.value || '';
                let branch = document.getElementById('branch-filter')?.value || '';
                let job = document.getElementById('job-filter')?.value || '';

                fetch(`/countEmp?search=${encodeURIComponent(search)}&branch=${branch}&job=${job}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('emp-count').textContent =
                            `${data.total_employees}`;

                        const newHire = document.getElementById('new-hire');
                        if (newHire) {
                            const countDate = data.new_joiners;
                            const plural = countDate === 1 ? '' : 's';
                            newHire.innerHTML =
                                `<small class="hire-alert">+ ${countDate} New Hire${plural}</small>`;
                        }
                    })
                    .catch(error => console.error('Error fetching employee count:', error));
            }

            document.getElementById('search-box')?.addEventListener('input', updateEmployeeCount);
            document.getElementById('branch-filter')?.addEventListener('change', updateEmployeeCount);
            document.getElementById('job-filter')?.addEventListener('change', updateEmployeeCount);

            updateEmployeeCount();
        });

        document.addEventListener('DOMContentLoaded', () => {
            const branchInput = new Choices('#branch-filter', {
                removeItemButton: false,
                addItems: true,
                duplicateItemsAllowed: false,
                searchEnabled: true,
                shouldSort: true,
                placeholderValue: 'Select a branch...',
                noResultsText: 'No results found',
                noChoicesText: 'No choices available',
                addItemFilter: function(value) {
                    return value.trim() !== ''; // Prevent adding empty items
                },
            });

            const jobInput = new Choices('#job-filter', {
                removeItemButton: false,
                addItems: true,
                duplicateItemsAllowed: false,
                searchEnabled: true,
                shouldSort: true,
                placeholderValue: 'Select a job...',
                noResultsText: 'No results found',
                noChoicesText: 'No choices available',
                addItemFilter: function(value) {
                    return value.trim() !== ''; // Prevent adding empty items
                },
            });
        });

        document.addEventListener('DOMContentLoaded', function() {

            // Handle View button
            document.querySelectorAll('.card-more-action').forEach(btn => {
                btn.addEventListener('click', async () => {
                    if (btn.closest('a[href]')) return; // Skip if the button is inside a link
                    const card = btn.closest('.card');
                    const empId = card.getAttribute('data-id');

                    const res = await fetch('/get-employees-info');
                    const data = await res.json();
                    const emp = data.find(e => e.id == empId);

                    document.getElementById('employeeImage').src = emp.image_path ? 'storage/' +
                        emp.image_path : '/default.jpg';
                    document.getElementById('sidebarName').textContent = emp.name;
                    document.getElementById('sidebarCodeJob').textContent =
                        `${emp.pin_code} - ${emp.job}`;

                    const hiredDate = new Date(emp.date_hired);
                    const now = new Date();
                    let years = now.getFullYear() - hiredDate.getFullYear();
                    let months = now.getMonth() - hiredDate.getMonth();
                    if (months < 0) {
                        years--;
                        months += 12;
                    }

                    console.log(emp.status);
                    console.log(emp.name);

                    if (emp.left_date) {
                        document.getElementById('workingSince').textContent =
                            `Left on ${emp.left_date}`;
                    } else {
                        document.getElementById('workingSince').textContent =
                            `${years} year(s) and ${months} month(s)`;
                    }
                    // Personal Info
                    document.getElementById('empEmail').textContent = emp.email;
                    document.getElementById('empPhone').textContent = emp.phone;
                    const dateBirth = new Date(emp.birthday);
                    const BirthformattedDate = ('0' + dateBirth.getDate()).slice(-2) + '-' +
                        ('0' + (dateBirth.getMonth() + 1)).slice(-2) + '-' +
                        dateBirth.getFullYear();

                    document.getElementById('empBirthday').textContent = BirthformattedDate;
                    document.getElementById('empBlood').textContent = emp.blood_type;
                    document.getElementById('empAddress').textContent = emp.address;
                    document.getElementById('empCar').textContent = emp.car;

                    // Job Info
                    document.getElementById('empBranch').textContent = emp.branch_name;
                    document.getElementById('empStatus').textContent = emp.status == 1 ?
                        'Active' : 'Inactive';
                    document.getElementById('empTitle').textContent = emp.title;
                    const date = new Date(emp.date_hired);
                    const formattedDate = ('0' + date.getDate()).slice(-2) + '-' +
                        ('0' + (date.getMonth() + 1)).slice(-2) + '-' +
                        date.getFullYear();

                    document.getElementById('startDate').textContent = formattedDate;
                    document.getElementById('empShift').textContent = emp.shift;
                    document.getElementById('empJob').textContent = emp.job;
                    document.getElementById('empWhere').textContent = emp.where_can_work;

                    // Left Info (ONLY if inactive)
                    const leftSection = document.getElementById('section-left');
                    const leftTabBtn = document.getElementById('leftTabBtn');

                    if (emp.status == 0) {
                        document.getElementById('section-left').innerHTML += `
                     <a href="/employees/${emp.id}/cover-letter" class="download-btn">Save and Get Cover Letter</a>`;

                        leftTabBtn.style.display = '';
                        leftSection.style.display = '';
                        leftTabBtn.classList.remove('hidden');
                        leftSection.classList.remove('hidden');

                        document.getElementById('empLeftDate').textContent = emp.left_date;
                        document.getElementById('empLeftReason').textContent = emp.left_reason;
                        document.getElementById('empNotice').textContent = emp.give_notice ?
                            'Yes' :
                            'No';
                        document.getElementById('empPerformer').textContent = emp
                            .is_good_performer ? 'Yes' : 'No';
                        document.getElementById('empPositive').textContent = emp
                            .is_positive_person ? 'Yes' : 'No';
                        document.getElementById('empReturn').textContent = emp
                            .is_recommended_to_back ? 'Yes' : 'No';
                        document.getElementById('empRemarks').textContent = emp
                            .exit_interview_remarks;
                    } else {
                        leftTabBtn.classList.add('hidden');
                        leftSection.classList.add('hidden');
                    }

                    // Always activate Personal Info tab first
                    document.querySelectorAll('#sidebarTabs button').forEach(btn => btn
                        .classList.remove('active'));
                    document.querySelector('#sidebarTabs button[data-tab="personal"]').classList
                        .add('active');

                    document.querySelectorAll('.sidebar-section').forEach(sec => sec.classList
                        .remove('active'));
                    document.getElementById('section-personal').classList.add('active');

                    const overlay = document.getElementById('sidebarOverlay');
                    if (overlay) {
                        overlay.classList.add('active');
                    }
                });
            });

            // Close sidebar
            const closeBtn = document.querySelector('.close-sidebar');
            const sidebarOverlay = document.getElementById('sidebarOverlay');

            if (closeBtn) {
                closeBtn.addEventListener('click', () => {
                    sidebarOverlay?.classList.remove('active');
                });
            }

            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', (e) => {
                    if (e.target === sidebarOverlay) {
                        sidebarOverlay.classList.remove('active');
                    }
                });
            }


            // Click outside to close
            document.getElementById('sidebarOverlay').addEventListener('click', (e) => {
                if (e.target.id === 'sidebarOverlay') {
                    e.target.classList.remove('active');
                }
            });

            // ✅ Tab switcher logic
            const tabs = document.querySelectorAll('#sidebarTabs button');
            const sections = document.querySelectorAll('.sidebar-section');

            tabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    const selectedTab = tab.dataset.tab;

                    document.querySelectorAll('.sidebar-section').forEach(section => {
                        if (section.id === `section-${selectedTab}`) {
                            section.classList.add('active');
                        } else {
                            section.classList.remove('active');
                        }
                    });

                    document.querySelectorAll('#sidebarTabs button').forEach(btn => btn.classList
                        .remove('active'));
                    tab.classList.add('active');
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const closeBtn = document.querySelector('.close-sidebar');
            const sidebarOverlay = document.getElementById('sidebarOverlay');

            if (closeBtn) {
                closeBtn.addEventListener('click', () => {
                    sidebarOverlay?.classList.remove('active');
                });
            }

            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', (e) => {
                    if (e.target === sidebarOverlay) {
                        sidebarOverlay.classList.remove('active');
                    }
                });
            }
        });
    </script>
@endpush


<style>
    form {
        margin-bottom: 0 !important;
    }

    .main .header .actions .bulk-delete-btn {
        background-color: transparent !important;
    }

    #search-file {
        margin: 10px;
    }

    #bulk-delete-form {
        margin-bottom: 0 !important;
    }

    .main {
        gap: 10px !important;
    }

    .choices {
        margin-bottom: 0 !important;
    }

    #search-box {
        width: 100% !important;
    }

    .choices[data-type*="select-one"] .choices__inner {
        margin-top: 0 !important;
    }

    .choices[data-type*=select-one] {
        width: 100%;
    }

    .choices[data-type*=select-one] .choices__inner {
        border-radius: 5px !important;
    }

    .download-btn {
        display: inline-block;
        margin-top: 20px;
        padding: 8px 15px;
        background: var(--primary-color);
        color: #fff;
        border-radius: 5px;
        text-decoration: none;
        transition: background 0.3s ease;
    }

    .download-btn:hover {
        background: var(--second-color);
    }
</style>
