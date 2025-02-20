@extends('layouts.master')
@section('title', 'All Employees')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('main')
    <div class="main">

        <div class="header">
            <div class="count">
                <p id="emp-count"></p>
                <div id="new-hire"></div>
                <button class="filter">
                    <svg viewBox="-2 -2 24 24" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMinYMin"
                        class="jam jam-filter">
                        <path
                            d="m2.08 2 6.482 8.101A2 2 0 0 1 9 11.351V18l2-1.5v-5.15a2 2 0 0 1 .438-1.249L17.92 2zm0-2h15.84a2 2 0 0 1 1.561 3.25L13 11.35v5.15a2 2 0 0 1-.8 1.6l-2 1.5A2 2 0 0 1 7 18v-6.65L.519 3.25A2 2 0 0 1 2.08 0" />
                    </svg>Fillter</button>

                <div class="filter-box hide-box">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <input id="filter-search" type="text" placeholder="Filter by Branch">
                        <button id="clear-filter"
                            style="background: none; border: none; font-size: 12px; cursor: pointer;">&#10005;</button>
                    </div>
                    <div class="filter-text">
                        @foreach ($branches as $branch)
                            <label class="filter-branch">
                                <input type="checkbox" class="branch-checkbox" value="{{ $branch->branch_name }}">
                                {{ $branch->branch_name }}
                            </label>
                        @endforeach
                    </div>
                </div>

            </div>

            <div class="actions">
                <div class="actions-first">

                    <div id="count-select">
                    </div>
                    <form id="bulk-delete-form" action="{{ route('employees.bulkDelete') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="selected_ids" id="selected_ids">
                        <button type="button" class="bulk-delete-btn">
                            <svg class="dlt" viewBox="0 0 24 24" fill="" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2h4a1 1 0 1 1 0 2h-1.069l-.867 12.142A2 2 0 0 1 17.069 22H6.93a2 2 0 0 1-1.995-1.858L4.07 8H3a1 1 0 0 1 0-2h4zm2 2h6V4H9zM6.074 8l.857 12H17.07l.857-12zM10 10a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1m4 0a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1" />
                            </svg>
                        </button>
                    </form>


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


                    @if (session('error'))
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const notyf = new Notyf({
                                    duration: 4000,
                                    position: {
                                        x: 'right',
                                        y: 'top'
                                    }
                                });
                                notyf.error('{{ session('error') }}');
                            });
                        </script>
                    @endif


                    <div class="view-style">

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
                    </div>
                </div>

                <div class="actions-second">
                    <a class="pdf-down" href="{{ route('employees.export') }}"> <svg viewBox="-5 -5 24 24"
                            xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMinYMin" class="jam jam-download">
                            <path
                                d="m8 6.641 1.121-1.12a1 1 0 0 1 1.415 1.413L7.707 9.763a.997.997 0 0 1-1.414 0L3.464 6.934A1 1 0 1 1 4.88 5.52L6 6.641V1a1 1 0 1 1 2 0zM1 12h12a1 1 0 0 1 0 2H1a1 1 0 0 1 0-2" />
                        </svg>
                    </a>

                    <form>
                        <button class="print" type="button" onclick="printEmployees()">
                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6 2h12v6h4v10h-4v4H6v-4H2V8h4zm2 6h8V4H8zm-2 8v-4h12v4h2v-6H4v6zm2-2v6h8v-6z" />
                            </svg>
                        </button>
                    </form>

                </div>

                <a class="add-btn" href="{{ route('employees.create') }}"> <svg viewBox="0 0 24 24" version="1.2"
                        baseProfile="tiny" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M18 10h-4V6a2 2 0 0 0-4 0l.071 4H6a2 2 0 0 0 0 4l4.071-.071L10 18a2 2 0 0 0 4 0v-4.071L18 14a2 2 0 0 0 0-4" />
                    </svg>Add Candidate
                </a>
            </div>
        </div>

        <div id="cards" class="cards">

            @foreach ($employees as $employee)
                <div class="card" data-id="{{ $employee->id }}">
                    <div class="card-header">
                        <input class="box" id="box" type="checkbox">
                        <div class="card-header-right">

                            <svg class="three-points" viewBox="0 0 256 256" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M80 128a16 16 0 1 1-16-16 16.02 16.02 0 0 1 16 16m112-16a16 16 0 1 0 16 16 16.02 16.02 0 0 0-16-16m-64 0a16 16 0 1 0 16 16 16.02 16.02 0 0 0-16-16" />
                            </svg>
                        </div>
                    </div>

                    <div class="card-info">
                        <div class="img-container"> <img data-id="{{ $employee->id }}" style="cursor: pointer;"
                                class="image-trigger"
                                src="{{ asset($employee->image_path ? 'storage/' . $employee->image_path : 'imgs/default-profile.jpg') }}"
                                alt="Profile Image">
                            @if ($employee->status === 1)
                                <p class="active-style">
                                </p>
                            @else
                                <p class="unactive-style">
                                </p>
                            @endif

                        </div>

                        <div class="card-hover" data-id="{{ $employee->id }}">
                            <div class="card-hover-top">
                                <img style="cursor: pointer;" class="image-trigger"
                                    src="{{ asset($employee->image_path ? 'storage/' . $employee->image_path : 'imgs/default-profile.jpg') }}"
                                    alt="Profile Image">

                                <div class="top-parg">
                                    <div class="top-parg-name">
                                        <div class="horz-top"> <strong>
                                                {{ explode(' ', $employee->name)[0] }}
                                                {{ strtoupper(substr(explode(' ', $employee->name)[1] ?? '', 0, 1)) }}.
                                            </strong>
                                            <small>{{ \Illuminate\Support\Str::limit($employee->title, 10, '...') }}</small>
                                        </div>
                                        <div style="display: flex; flex-direction: column; gap:10px;">
                                            <p class="details-second">{{ $employee->branch->branch_name }}</p>
                                            <p class="email-truncate details-call"> {{ $employee->email }}</p>
                                            <p>{{ substr($employee->phone, 0, 2) }} {{ substr($employee->phone, 2, 3) }}
                                                {{ substr($employee->phone, 5, 3) }}</p>
                                            <p class="join-date">
                                                {{ \Carbon\Carbon::parse($employee->date_hired)->format('d-m-Y') }}</p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div style="display: flex; gap:5px; justify-content: center; align-items: center;">
                            <b class="name-emp">{{ $employee->name }}</b>
                            <small id="pinCode" style="color:var(--second-color)">({{ $employee->pin_code }})</small>
                        </div>
                        <p>{{ $employee->title }}</p>

                    </div>

                    {{-- <div class="details">

                        <div class="details-header">
                            <p>Department</p>
                            <p>Date Hired</p>
                        </div>

                        <div class="details-second">
                            <p>{{ $employee->branch->branch_name }}</p>
                            <p class="join-date">{{ \Carbon\Carbon::parse($employee->date_hired)->format('d-m-Y') }}</p>
                        </div>

                        <div class="details-call">
                            <div class="call">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M2 6a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2zm3.519 0L12 11.671 18.481 6zM20 7.329l-7.341 6.424a1 1 0 0 1-1.318 0L4 7.329V18h16z" />
                                </svg> {{ $employee->email }}
                            </div>

                            <div class="call">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M3.833 4h4.49L9.77 7.618l-2.325 1.55A1 1 0 0 0 7 10c.003.094 0 .001 0 .001v.021a2 2 0 0 0 .006.134q.008.124.035.33c.039.27.114.642.26 1.08.294.88.87 2.019 1.992 3.141s2.261 1.698 3.14 1.992c.439.146.81.22 1.082.26a4 4 0 0 0 .463.04l.013.001h.008s.112-.006.001 0a1 1 0 0 0 .894-.553l.67-1.34 4.436.74v4.32c-2.111.305-7.813.606-12.293-3.874S3.527 6.11 3.833 4m5.24 6.486 1.807-1.204a2 2 0 0 0 .747-2.407L10.18 3.257A2 2 0 0 0 8.323 2H3.781c-.909 0-1.764.631-1.913 1.617-.34 2.242-.801 8.864 4.425 14.09s11.848 4.764 14.09 4.425c.986-.15 1.617-1.004 1.617-1.913v-4.372a2 2 0 0 0-1.671-1.973l-4.436-.739a2 2 0 0 0-2.118 1.078l-.346.693a5 5 0 0 1-.363-.105c-.62-.206-1.481-.63-2.359-1.508s-1.302-1.739-1.508-2.36a5 5 0 0 1-.125-.447z" />
                                </svg>
                                <p class="number">{{ $employee->phone }}</p>
                            </div>
                        </div>
                    </div> --}}

                    <div class="card-actions">
                        <a href="javascript:void(0)" class="get-files-link">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3 14v6a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-6M12 3v14m0 0-5-5.444M12 17l5-5.444"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg> Get Files</a>
                        <a href="javascript:void(0)" class="upload-files-link">
                            <svg viewBox="0 0 256 256" xmlns="http://www.w3.org/2000/svg">
                                <circle
                                    style="fill:none;stroke-width:16;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                                    cx="128" cy="128" r="112" />
                                <path
                                    style="fill:none;stroke-width:16;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                                    d="M80 128h96m-48-48v96" />
                            </svg>
                            Add File
                        </a>
                        <input type="file" id="fileUpload" multiple accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"
                            style="display:none;" />

                    </div>

                    <p class="job">{{ $employee->job }}</p>

                    <div class="card-more">
                        <div class="card-more-action">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 42 42" xml:space="preserve">
                                <path
                                    d="M15.3 20.1c0 3.1 2.6 5.7 5.7 5.7s5.7-2.6 5.7-5.7-2.6-5.7-5.7-5.7-5.7 2.6-5.7 5.7m8.1 12.3C30.1 30.9 40.5 22 40.5 22s-7.7-12-18-13.3c-.6-.1-2.6-.1-3-.1-10 1-18 13.7-18 13.7s8.7 8.6 17 9.9c.9.4 3.9.4 4.9.2M11.1 20.7c0-5.2 4.4-9.4 9.9-9.4s9.9 4.2 9.9 9.4S26.5 30 21 30s-9.9-4.2-9.9-9.3" />
                            </svg> View
                        </div>

                        <a href="{{ route('employees.edit', ['employee' => $employee->id]) }}" class="card-more-action">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" xml:space="preserve"
                                aria-hidden="true" focusable="false">
                                <path
                                    d="M29.586 9.414 26 13l-7-7 3.586-3.586a2.005 2.005 0 0 1 2.828 0l4.172 4.172c.778.778.778 2.05 0 2.828M18 7l7 7-14.293 14.293C10.318 28.682 9.55 29 9 29H4c-.55 0-1-.45-1-1v-5c0-.55.318-1.318.707-1.707zM8.464 26.293l-2.757-2.757c-.389-.389-.707-.258-.707.292V26c0 .55.45 1 1 1h2.172c.55 0 .681-.318.292-.707" />
                            </svg>
                            Edit
                        </a>

                        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST"
                            class="card-more-action">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="delete-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" xml:space="preserve">
                                    <path
                                        d="M42.7 469.3c0 23.5 19.1 42.7 42.7 42.7h341.3c23.5 0 42.7-19.1 42.7-42.7V192H42.7zm320-213.3h42.7v192h-42.7zm-128 0h42.7v192h-42.7zm-128 0h42.7v192h-42.7zm384-170.7h-128V42.7C362.7 19.1 343.5 0 320 0H192c-23.5 0-42.7 19.1-42.7 42.7v42.7h-128C9.5 85.3 0 94.9 0 106.7V128c0 11.8 9.5 21.3 21.3 21.3h469.3c11.8 0 21.3-9.5 21.3-21.3v-21.3c.1-11.8-9.4-21.4-21.2-21.4m-170.7 0H192V42.7h128z" />
                                </svg>
                                Delete
                            </button>
                        </form>
                    </div>
                    <p style="position: absolute; color: red; font-weight: 500;">
                        {{ $employee->left_date ? ' Left: ' . \Carbon\Carbon::parse($employee->left_date)->format('d-m-Y') : '' }}
                </div>
            @endforeach

        </div>

        <div id="popupWrapper" class="popup-wrapper" style="display: none;">
            <div class="filesPopup" id="filesPopup">
                <div class="file-name">
                    <h1></h1>
                    <p></p>
                </div>
                <input type="text" name="search" id="search-file" placeholder="Search Here...">
                <table>
                    <thead>
                        <tr>
                            <th>Icon</th>
                            <th>Name</th>
                            <th>File Size</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- File items will be dynamically added here -->
                    </tbody>
                </table>
                <button class="close-popup">Close</button>
            </div>
        </div>

        <div id="table" class="table">

            <div style="display: flex; justify-content: flex-start; align-items: center; gap: 10px;margin-bottom: 10px;">
                <p style="font-weight: bold; color: var(--primary-color);">Show</p>
                <select id="rowsPerPage">
                    <option value="5">5 rows</option>
                    <option value="10" selected>10 rows</option>
                    <option value="20">20 rows</option>
                    <option value="50">50 rows</option>
                    <option value="100">100 rows</option>
                </select>
            </div>

            <div id="employeesGrid"></div>

            <div class="table-data" id="table-data">
                <!-- Data will be fetched automaticlly by the js code using grid js library -->
            </div>
        </div>

    </div>

    <div id="deletePopup" class="popup-overlay" style="display: none;">
        <div class="popup-content">
            <h3>Are you sure?</h3>
            <p>Do you really want to delete this record? This action cannot be undone.</p>
            <div class="popup-actions">
                <button id="confirmDelete" class="btn-confirm">Yes, Delete</button>
                <button id="cancelDelete" class="btn-cancel">Cancel</button>
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

            console.log('Selected IDs:', selectedIds); // Log selected IDs to the console

            if (selectedIds.length === 0) {
                count.innerHTML = ``;
            } else {
                count.innerHTML =
                    `<div style="display:flex; gap:5px; justify-content:center; align-items:center;">
                <p style="color:var(--primary-color); font-weight:bold; font-size:24px;">` +
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

        // Counting the New Joiners
        const newHire = document.getElementById('new-hire');
        const joinDate = document.querySelectorAll('.join-date');
        const sixMonthsAgo = new Date();
        sixMonthsAgo.setMonth(sixMonthsAgo.getMonth() - 6);

        let countDate = 0;

        joinDate.forEach((date) => {
            const [day, month, year] = date.textContent.trim().split('-').map(
                Number);
            const hireDate = new Date(year, month - 1, day);
            if (!isNaN(hireDate) && hireDate >= sixMonthsAgo) {
                countDate++;
            }
        });

        const plural = countDate === 1 ? '' : 's';

        if (newHire) {
            newHire.innerHTML = `<small class="hire-alert">+ ${countDate} New Hire${plural}</small>`;
        }

        // Search Functionality
        const searchBox = document.getElementById('search-box');
        const cards = document.querySelectorAll('.card');

        searchBox.addEventListener('input', (e) => {
            const searchValue = e.target.value.toLowerCase().trim();
            const searchWords = searchValue.split(/\s+/);

            if (searchValue === '') {
                cards.forEach((card) => {
                    card.style.display = 'flex';
                });
                return;
            }

            cards.forEach((card) => {
                const nameElement = card.querySelector('.card-info b');
                const departmentElement = card.querySelector('.details-second');
                const statusElement = card.querySelector('.card-header-right p');
                const phoneElement = card.querySelector('.number');
                const pinCodes = card.querySelector('#pinCode');
                const jobs = card.querySelector('.job');

                const name = nameElement ? nameElement.textContent.toLowerCase() : '';
                const department = departmentElement ? departmentElement.textContent
                    .toLowerCase() : '';
                const status = statusElement ? statusElement.textContent.toLowerCase() : '';
                const phone = phoneElement ? phoneElement.textContent.toLowerCase().trim() : '';
                const pinCode = pinCodes ? pinCodes.textContent.trim() : '';
                const job = jobs ? jobs.textContent.toLowerCase().trim() : '';

                const isMatch = searchWords.every((word) =>
                    name.includes(word) || department.includes(word) || status.includes(
                        word) || phone.includes(word) || pinCode.includes(word) || job
                    .includes(word)
                );

                if (isMatch) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        });

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


        // Open The Filter Box
        const filterBtn = document.querySelector('.filter');
        const filterBox = document.querySelector('.filter-box');

        filterBtn.addEventListener('click', (e) => {
            e.stopPropagation(); // Prevent the click from propagating to the document
            if (filterBox.classList.contains('show-box')) {
                filterBox.classList.add('hide-box');
                filterBox.classList.remove('show-box');
            } else {
                filterBox.classList.add('show-box');
                filterBox.classList.remove('hide-box');
            }
        });

        // Prevent the filter box from closing when clicking inside it
        filterBox.addEventListener('click', (e) => {
            e.stopPropagation(); // Prevent the click from propagating to the document
        });

        document.addEventListener('click', () => {
            if (filterBox.classList.contains('show-box')) {
                filterBox.classList.add('hide-box');
                filterBox.classList.remove('show-box');
            }
        });

        // Search Functionality
        const filterSearch = document.getElementById('filter-search');
        const namebranch = document.querySelectorAll('.filter-branch');

        filterSearch.addEventListener('input', (e) => {
            const searchValue = e.target.value.toLowerCase().trim();
            const searchWords = searchValue.split(/\s+/);

            namebranch.forEach((branch) => {
                const branchText = branch.textContent.toLowerCase().trim();

                const isMatch = searchWords.every((word) =>
                    branchText.includes(word)
                );

                if (isMatch) {
                    branch.style.display = 'block';
                } else {
                    branch.style.display = 'none';
                }
            });
        });

        // Count Employees
        const countEmp = document.getElementById('emp-count');
        let empCount = 0;

        cards.forEach((card) => {
            const empStatus = card.querySelector('.active-style');
            if (empStatus) {
                empCount++;
            }
        });

        countEmp.innerHTML = `${empCount} Active Employees`;

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

    //Fetch the employees info using Grid JS
    async function fetchEmployees() {
        try {
            const response = await fetch('/get-employees-info'); // Replace with your API endpoint
            if (!response.ok) {
                throw new Error('Network response was not ok ' + response.statusText);
            }
            const employees = await response.json();
            return employees;
        } catch (error) {
            console.error('Error fetching employee data:', error);
            return []; // Return an empty array if an error occurs
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        let rowsPerPage = 10; // Default rows per page

        const popOverLay = document.getElementById('imagePopup');
        const popupImage = document.getElementById('popupImage');
        const closePopup = document.getElementById('popupClose');
        const popupText = document.getElementById('popupImageText');
        const countDisplay = document.getElementById('count-select');

        // Function to update the count of selected checkboxes
        function updateCount() {
            const selectedIds = [];
            const checkboxes = document.querySelectorAll('.box');
            checkboxes.forEach((box) => {
                if (box.checked) {
                    const id = box.getAttribute('data-id');
                    if (id) selectedIds.push(id);
                }
            });

            // Update the count display
            if (selectedIds.length === 0) {
                countDisplay.innerHTML = '';
            } else {
                countDisplay.innerHTML = `
                <div style="display: flex; gap: 5px; justify-content: center; align-items: center;">
                    <p style="color: var(--primary-color); font-weight: bold; font-size: 24px;">
                        ${selectedIds.length}
                    </p>
                    <p style="color: var(--second-color);">Selected</p>
                </div>`;
            }

            console.log('Selected IDs:', selectedIds); // Debugging
        }

        // Function to initialize popup for images
        function initializeImagePopup() {
            const gridImages = document.querySelectorAll('.image-trigger-grid');
            gridImages.forEach(image => {
                image.addEventListener('click', () => {
                    const name = image.dataset.name || 'Unknown';
                    popupImage.src = image.src;
                    popOverLay.style.display = 'flex';
                    popupText.textContent = name;
                });
            });
        }

        popOverLay.addEventListener('click', (e) => {
            if (e.target === popOverLay) {
                popOverLay.style.display = 'none';
            }
        });

        closePopup.addEventListener('click', () => {
            popOverLay.style.display = 'none'; // Hide the popup directly
        });

        async function fetchEmployees() {
            try {
                const response = await fetch('/get-employees-info');
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                const employees = await response.json();
                return employees;
            } catch (error) {
                console.error('Error fetching employee data:', error);
                return []; // Return an empty array if an error occurs
            }
        }

        fetchEmployees().then(employees => {
            console.log(employees.map(employee => employee.image_path));

            const grid = new gridjs.Grid({
                columns: [{
                        name: 'Select',
                        formatter: (_, row) => gridjs.html(`
                        <input type="checkbox" class="box" data-id="${row.cells[0]?.data}">
                        `),
                        width: '50px',
                    },

                    {
                        name: 'Name',
                        formatter: (_, row) => {
                            const name = row.cells[1]?.data || 'N/A';
                            const imagePath = row.cells[6]?.data ?
                                `/storage/${row.cells[6].data}` :
                                '/storage/images/Default.jpg';
                            const status = row.cells[8]?.data === 1 ? 'active' :
                                'inactive';
                            const statusColor = status === 'active' ? 'green' : 'red';

                            return gridjs.html(`
                <div style="display: flex; align-items: center;">
                    <div style="position: relative; display: inline-block;">
                        <img class="image-trigger-grid" src="${imagePath}" data-name="${name}" style="width: 50px; height: 50px; cursor: pointer; border-radius: 50%;">
                        <span style="
                            position: absolute;
                            bottom: 0;
                            right: -2px;
                            width: 18px;
                            height: 18px;
                            border-radius: 50%;
                            background-color: ${statusColor};
                            border: 2px solid white;">
                        </span>
                    </div>
                    <p style="font-weight: bold; color: var(--primary-color); margin-left: 10px;">
                        ${name}
                    </p>
                </div>
            `);
                        },
                    },
                    {
                        name: 'Branch',
                        formatter: (_, row) => row.cells[2]?.data || 'N/A',
                    },
                    {
                        name: 'Title',
                        formatter: (_, row) => row.cells[3]?.data || 'N/A',
                    },
                    {
                        name: 'Phone',
                        formatter: (_, row) => {
                            const phone = row.cells[4]?.data || 'Phone Not Available';
                            return phone.replace(/(\d{2})(\d{3})(\d{3})/, '$1 $2 $3');
                        },
                    },
                    {
                        name: 'Email',
                        formatter: (_, row) => row.cells[5]?.data || 'Email Not Found',
                    },
                    {
                        name: 'Actions',
                        formatter: (_, row) => gridjs.html(`
                        <svg style="cursor:pointer; width:30px;" class="three-points" viewBox="0 0 256 256" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M80 128a16 16 0 1 1-16-16 16.02 16.02 0 0 1 16 16m112-16a16 16 0 1 0 16 16 16.02 16.02 0 0 0-16-16m-64 0a16 16 0 1 0 16 16 16.02 16.02 0 0 0-16-16" />
                        </svg>
                    `),
                        width: '150px',
                    },
                ],


                data: employees.map(employee => [

                    employee.id, // row.cells[0]
                    employee.name, // row.cells[1]
                    employee.branch_name, // row.cells[2]
                    employee.title, // row.cells[3]
                    employee.phone, // row.cells[4]
                    employee.email, // row.cells[5]
                    employee.image_path, // row.cells[6]
                    employee.job, // row.cells[7]
                    employee.status, // row.cells[8]
                ]),

                pagination: {
                    enabled: true,
                    limit: rowsPerPage,
                },
                search: true, // Enable built-in search
                sort: true, // Enable sorting
                style: {
                    table: {
                        'white-space': 'nowrap',
                    },
                },
            }).render(document.getElementById('employeesGrid'));

            // Attach functionality to count checkboxes after grid render
            grid.on('ready', () => {
                console.log('Grid is ready');
                const checkboxes = document.querySelectorAll('.box');
                checkboxes.forEach((box) => {
                    box.addEventListener('change', updateCount);
                });
                // Log the row data to the console
                grid.on('rowClick', (row) => {
                    console.log(row.cells);
                });
            });

            // Add functionality for the "Show entries" dropdown
            const rowsPerPageSelector = document.getElementById('rowsPerPage');
            rowsPerPageSelector.addEventListener('change', () => {
                rowsPerPage = parseInt(rowsPerPageSelector.value, 10);
                grid.updateConfig({
                    pagination: {
                        enabled: true,
                        limit: rowsPerPage,
                    },
                }).forceRender();
            });
        });
    });

    //Change the view Mode
    document.addEventListener('DOMContentLoaded', () => {
        const cardViewButton = document.getElementById('card-view');
        const tableViewButton = document.getElementById('table-view');
        const cardsDiv = document.querySelector('.cards');
        const tableDiv = document.querySelector('.table');

        // Function to update styles
        function updateStyles(activeButton, inactiveButton, isTableView = false) {
            // Active button styles
            activeButton.style.backgroundColor = 'white';
            activeButton.style.stroke = 'var(--primary-color)';

            if (isTableView) {
                activeButton.style.borderRight = '4px solid var(--text-light-color)';
                activeButton.style.borderLeft = 'none';
            } else {
                activeButton.style.borderLeft = '4px solid var(--text-light-color)';
                activeButton.style.borderRight = 'none';
            }

            // Inactive button styles
            inactiveButton.style.backgroundColor = 'transparent';
            inactiveButton.style.stroke = 'var(--light-color)';
            inactiveButton.style.border = 'none';
        }

        // Function to toggle view
        function toggleView(view) {
            if (view === 'table') {
                cardsDiv.style.display = 'none';
                tableDiv.style.display = 'block';
                updateStyles(tableViewButton, cardViewButton, true);
            } else {
                cardsDiv.style.display = 'flex';
                tableDiv.style.display = 'none';
                updateStyles(cardViewButton, tableViewButton, false);
            }
            // Save the selected view to localStorage
            localStorage.setItem('selectedView', view);
        }

        // Retrieve the selected view from localStorage on page load
        const savedView = localStorage.getItem('selectedView') || 'cards'; // Default to "cards" view
        toggleView(savedView);

        // Add event listeners for buttons
        cardViewButton.addEventListener('click', () => {
            toggleView('cards');
        });

        tableViewButton.addEventListener('click', () => {
            toggleView('table');
        });
    });

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
                            `${files.length} items`;

                        const tbody = popup.querySelector('tbody');
                        tbody.innerHTML = ''; // Clear previous content

                        if (files.length === 0) {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                            <td colspan="4" style="text-align: center;">No files found</td>
                        `;
                            tbody.appendChild(row);
                        } else {
                            files.forEach(file => {
                                const maxLength =
                                    10;
                                const fileName = file.name;
                                const truncatedFileName = fileName.length >
                                    maxLength ?
                                    `${fileName.substring(0, maxLength)}...${fileName.substring(fileName.lastIndexOf('.') + 1)}` :
                                    fileName;

                                const row = document.createElement('tr');
                                row.innerHTML = `
                                <td><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="icon">
                                    <path d="M19.41 7L15 2.59A2 2 0 0 0 13.59 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8.41A2 2 0 0 0 19.41 7" />
                                </svg></td>
                                <td>${truncatedFileName}</td>
                                <td>${file.size}</td>
                                <td style="display:flex; justify-content:center; align-items:center; gap:5px;cursor:pointer;">
                                    <a href="${file.url}" download>
                                        <svg class="download-file" viewBox="-5 -5 24 24" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMinYMin" class="jam jam-download">
                                            <path d="m8 6.641 1.121-1.12a1 1 0 0 1 1.415 1.413L7.707 9.763a.997.997 0 0 1-1.414 0L3.464 6.934A1 1 0 1 1 4.88 5.52L6 6.641V1a1 1 0 1 1 2 0zM1 12h12a1 1 0 0 1 0 2H1a1 1 0 0 1 0-2"/>
                                        </svg>
                                    </a>

                                   <a href="javascript:void(0)" 
                            class="delete-file" 
                            data-employee-name="${employeeName}" 
                            data-pin-code="${pinCode}" 
                            data-file-name="${file.name}">
                             <svg class="delete-file-icon download-file" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/                         svg">
                                    <path fill-rule="evenodd" d="M17 8a1 1 0 0 1 1 1v10a3 3 0 0 1-3 3H9a3 3 0 0 1-3-3V9a1 1 0 0                             1 1-1zm-1 2H8v9a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1zM9 3a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1h4a1 1 0 0                            1 0 2H5a1 1 0 1 1 0-2h4z"/>
                             </svg>
                                 </a>

                                    
                                           </td>
                                            `;
                                tbody.appendChild(row);
                            });

                            const downloadAllRow = document.createElement('tr');
                            downloadAllRow.innerHTML = `
                            <td colspan="4" style="text-align: center;">
                                <button id="downloadAll" class="download-all-btn"><svg viewBox="-5 -5 24 24" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMinYMin" class="jam jam-download"><path d="m8 6.641 1.121-1.12a1 1 0 0 1 1.415 1.413L7.707 9.763a.997.997 0 0 1-1.414 0L3.464 6.934A1 1 0 1 1 4.88 5.52L6 6.641V1a1 1 0 1 1 2 0zM1 12h12a1 1 0 0 1 0 2H1a1 1 0 0 1 0-2"/></svg> Download All</button>
                            </td>
                        `;
                            tbody.appendChild(downloadAllRow);

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
                        popup.querySelector('.file-name p').innerText = `0 items`;
                        const tbody = popup.querySelector('tbody');
                        tbody.innerHTML = `
                        <tr>
                            <td colspan="4" style="text-align: center;">No files found</td>
                        </tr>
                    `;
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

                    fileInput.click();
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

            for (const file of files) {
                if (file.name.endsWith('.zip')) {
                    alert('ZIP files are not allowed!');
                    return;
                }
                formData.append('files[]', file);
            }

            try {
                const response = await fetch('/upload-employee-files', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken.getAttribute('content'),
                    },
                });

                const contentType = response.headers.get('Content-Type');
                if (!contentType.includes('application/json')) {
                    throw new Error('Invalid response type: ' + contentType);
                }

                const result = await response.json();

                if (response.ok) {
                    const notyf = new Notyf({
                        duration: 4000,
                        position: {
                            x: 'right',
                            y: 'top'
                        },
                    });
                    notyf.success(result.message); // Show success message
                } else {
                    const notyf = new Notyf({
                        duration: 4000,
                        position: {
                            x: 'right',
                            y: 'top'
                        },
                    });
                    notyf.error(result.message || 'Failed to upload files');
                }
            } catch (error) {
                console.error('Error during upload:', error);
                const notyf = new Notyf({
                    duration: 4000,
                    position: {
                        x: 'right',
                        y: 'top'
                    },
                });
                notyf.error('An error occurred during the file upload.');
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
                        },
                        body: JSON.stringify({
                            employeeName,
                            pinCode,
                            fileName
                        }),
                    });

                    const result = await response.json();

                    if (response.ok) {
                        // Redirect to the provided URL to show the flash message
                        window.location.href = result.redirect;
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
        const fileTableBody = document.querySelector('#filesPopup tbody');

        if (!searchInput || !fileTableBody) return;

        searchInput.addEventListener('input', function() {
            const searchValue = searchInput.value.toLowerCase().trim();

            // Loop through each row in the table body
            fileTableBody.querySelectorAll('tr').forEach(row => {
                const fileNameCell = row.querySelector(
                    'td:nth-child(2)'); // Assuming the name is in the 2nd column

                if (fileNameCell) {
                    const fileName = fileNameCell.textContent.toLowerCase();
                    if (fileName.includes(searchValue)) {
                        row.style.display = ''; // Show the row
                    } else {
                        row.style.display = 'none'; // Hide the row
                    }
                }
            });
        });
    });

    //Function to Print the chart:
    function printEmployees() {
        fetch('/get-employees-info')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(employees => {
                // Build the printable table
                let printableContent = `
                <html>
                <head>
                    <title>Employees List</title>
                    <style>
                        table {
                            width: 100%;
                            border-collapse: collapse;
                        }
                        th, td {
                            border: 1px solid black;
                            padding: 8px;
                            text-align: left;
                        }
                        th {
                            background-color: #f2f2f2;
                        }
                    </style>
                </head>
                <body>
                    <h1>Employees List</h1>
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Branch</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Date Hired</th>
                                <th>Email</th>
                                <th>Phone</th>
                            </tr>
                        </thead>
                        <tbody>
            `;

                employees.forEach(employee => {
                    const status = employee.status === 1 ? 'Active' : 'Left';
                    printableContent += `
                    <tr>
                        <td>${employee.name}</td>
                        <td>${employee.branch_name}</td>
                        <td>${employee.title}</td>
                        <td>${status}</td>
                        <td>${employee.date_hired}</td>
                        <td>${employee.email}</td>
                        <td>${employee.phone}</td>
                    </tr>
                `;
                });

                printableContent += `
                        </tbody>
                    </table>
                </body>
                </html>
            `;

                // Open a new window for printing
                const printWindow = window.open('', '', 'width=800,height=600');
                printWindow.document.write(printableContent);
                printWindow.document.close();
                printWindow.focus();
                printWindow.print();
                printWindow.close();
            })
            .catch(error => {
                console.error('Error fetching employees:', error);
            });
    }

    document.addEventListener('DOMContentLoaded', () => {
        const filterSearch = document.getElementById('filter-search');
        const branchCheckboxes = document.querySelectorAll('.branch-checkbox');
        const cards = document.querySelectorAll('.card');
        const clearFilterButton = document.getElementById('clear-filter');

        // Dynamically filter branches based on search input
        filterSearch.addEventListener('input', (e) => {
            const searchValue = e.target.value.toLowerCase().trim();
            branchCheckboxes.forEach((checkbox) => {
                const branchName = checkbox.value.toLowerCase();
                const parentLabel = checkbox.closest('.filter-branch');
                parentLabel.style.display = branchName.includes(searchValue) ? 'block' : 'none';
            });
        });

        // Listen for changes in the checkboxes
        branchCheckboxes.forEach((checkbox) => {
            checkbox.addEventListener('change', filterCards);
        });

        // Clear filters and reset view
        clearFilterButton.addEventListener('click', () => {
            filterSearch.value = ''; // Clear search input
            branchCheckboxes.forEach((checkbox) => (checkbox.checked =
                false)); // Uncheck all checkboxes
            filterCards(); // Show all cards
        });

        // Filter cards based on selected branches
        function filterCards() {
            const selectedBranches = Array.from(branchCheckboxes)
                .filter((cb) => cb.checked)
                .map((cb) => cb.value.toLowerCase());

            cards.forEach((card) => {
                const branchName = card.querySelector('.details-second')?.textContent.toLowerCase()
                    .trim();
                card.style.display = selectedBranches.length === 0 || selectedBranches.includes(
                        branchName) ?
                    'flex' :
                    'none';
            });
        }
    });
</script>
