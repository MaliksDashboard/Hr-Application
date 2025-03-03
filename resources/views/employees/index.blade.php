@extends('layouts.master')
@section('title', 'All Employees')
@section('custom_title', 'Employees')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<meta name="csrf-token" content="{{ csrf_token() }}">

@section('main')
    <div class="main">

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
                            <option value="{{ $job }}" {{ request('job') == $job ? 'selected' : '' }}>
                                {{ $job }}
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


        {{-- <div id="loading" style="display: none; text-align: center; margin-top: 20px;">
            <img src="{{ asset('loading.gif') }}" width="50px" alt="Loading..." />
        </div> --}}

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
                const branchName = card.querySelector('.details-second')?.textContent.toLowerCase()
                    .trim();
                card.style.display = selectedBranches.length === 0 || selectedBranches.includes(
                        branchName) ?
                    'flex' :
                    'none';
            });
        }
    });

    // let nextPage = "{{ $employees->nextPageUrl() }}";
    // let loading = false;

    // window.addEventListener("scroll", function() {
    //     if (loading || !nextPage) return;

    //     if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 100) {
    //         loading = true;
    //         document.getElementById("loading").style.display = "block";

    //         fetch(nextPage, {
    //                 headers: {
    //                     "X-Requested-With": "XMLHttpRequest"
    //                 }
    //             })
    //             .then(response => response.json())
    //             .then(data => {
    //                 if (data.employees) {
    //                     document.getElementById("cards").insertAdjacentHTML("beforeend", data.employees);
    //                     nextPage = data.next_page;

    //                     // 🔥 No need to reattach listeners, event delegation will handle it
    //                 } else {
    //                     nextPage = null;
    //                 }
    //             })
    //             .finally(() => {
    //                 loading = false;
    //                 document.getElementById("loading").style.display = "none";
    //             });
    //     }
    // });

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
    })
</script>


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
</style>
