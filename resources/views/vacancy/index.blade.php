@extends('layouts.master')
@section('title', 'Vacancies')

@section('main')


    <div class="main vacancy">

        <div class="dashboard-header">
            <h1>Vacacnies Managment</h1>
            @can('Create')
                <a class="add-vac" href="{{ route('vacancies.create') }} ">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" xml:space="preserve">
                        <path
                            d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256 256-114.6 256-256S397.4 0 256 0m149.3 277.3c0 11.8-9.5 21.3-21.3 21.3h-85.3V384c0 11.8-9.5 21.3-21.3 21.3h-42.7c-11.8 0-21.3-9.6-21.3-21.3v-85.3H128c-11.8 0-21.3-9.6-21.3-21.3v-42.7c0-11.8 9.5-21.3 21.3-21.3h85.3V128c0-11.8 9.5-21.3 21.3-21.3h42.7c11.8 0 21.3 9.6 21.3 21.3v85.3H384c11.8 0 21.3 9.6 21.3 21.3z" />
                    </svg>
                    Add Vacancy
                </a>
            @endcan
        </div>
        <div class="row">

            <div class="row-left">
                <div class="row-left-controller">
                    <strong>Vacancies</strong>
                    <div class="controller-toggle">
                        <p class="active">To Do</p>
                        <p>Completed</p>
                    </div>
                    <div class="input-search"
                        style="display: flex; gap: 10px; align-items: center; justify-content: center; border: 1px solid #a2a5b9; padding:0px 5px; border-radius: 5px;">
                        <svg style="width: 18px" viewBox="0 0 24 24" data-name="Line Color"
                            xmlns="http://www.w3.org/2000/svg" class="icon line-color">
                            <path style="fill:none;stroke:#a2a5b9;stroke-linecap:round;stroke-linejoin:round;stroke-width:2"
                                d="m21 21-6-6" />
                            <circle cx="10" cy="10" r="7"
                                style="fill:none;stroke:#a2a5b9;stroke-linecap:round;stroke-linejoin:round;stroke-width:2" />
                        </svg>
                        <input style="border: none; outline: none; margin-top: 0;" type="text" id="search"
                            placeholder="Search by Branch or Job..." class="search-input">

                    </div>

                </div>

                <div class="row-left-container">
                    @php
                        $borderColors = ['#AA5486', '#FC8F54', '#FDc7BB', '#FB3cDc'];
                    @endphp

                    @foreach ($vacancies as $index => $vacancy)
                        @php
                            $borderColor = $borderColors[$index % count($borderColors)]; // Cycle through colors
                            $statusClass = strtolower($vacancy->status); // Convert status to lowercase for class
                        @endphp

                        <div class="row-left-container-record" style="border-left-color: {{ $borderColor }};">
                            <div class="record-date">

                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12 6.477 2 12 2m0 2a8 8 0 1 0 0 16 8 8 0 0 0 0-16m0 2a1 1 0 0 1 .993.883L13 7v4.586l1.707 1.707a1 1 0 0 1-1.32 1.497l-.094-.083-2-2a1 1 0 0 1-.284-.576L11 12V7a1 1 0 0 1 1-1" />
                                </svg>
                                <p>Added: {{ \Carbon\Carbon::parse($vacancy->asked_date)->format('d-m-Y') }}</p>
                            </div>

                            <div class="record-needed">
                                {{ $vacancy->job }} - {{ $vacancy->branch->branch_name ?? 'N/A' }}
                                <span class="status {{ $statusClass }}">{{ ucfirst($vacancy->status) }}</span>
                            </div>

                            <div class="record-action">

                                @can('Edit')
                                    <button>
                                        <a href="{{ route('vacancies.edit', $vacancy->id) }}">
                                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M20.989 4.285 19.64 2.93c-1.236-1.241-3.146-1.241-4.382 0L13.011 5.3l5.73 5.754 2.36-2.37A3.1 3.1 0 0 0 22 6.542c0-.79-.45-1.693-1.011-2.257m-4.719 6.657L11.775 6.43 2.9 15.343c-.563.564-.9 1.354-.9 2.256v3.498c0 .452.337.903.899.903h3.595c.787 0 1.573-.338 2.248-.903l8.876-8.914z" />
                                            </svg>
                                        </a>
                                    </button>
                                @endcan


                                @can('Delete')
                                    <form action="{{ route('vacancies.destroy', $vacancy->id) }}" method="POST"
                                        class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="delete-button">
                                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2h4a1 1 0 1 1 0 2h-1.069l-.867 12.142A2 2 0 0 1 17.069 22H6.93a2 2 0 0 1-1.995-1.858L4.07 8H3a1 1 0 0 1 0-2h4zm2 2h6V4H9zM6.074 8l.857 12H17.07l.857-12zM10 10a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1m4 0a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1" />
                                            </svg>
                                        </button>
                                    </form>
                                @endcan

                            </div>
                        </div>
                    @endforeach

                </div>

                <div class="row-left-container vacancies-completed" style="display: none;">
                    @php
                        $borderColors = ['#AA5486', '#FC8F54', '#FDc7BB', '#FB3cDc'];
                    @endphp

                    @foreach ($vacanciesCompleted as $index => $vacancy)
                        @php
                            $borderColor = $borderColors[$index % count($borderColors)]; // Cycle through colors
                            $statusClass = strtolower($vacancy->status); // Convert status to lowercase for class
                        @endphp

                        <div class="row-left-container-record" style="border-left-color: {{ $borderColor }};">
                            <div class="record-date">
                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12 6.477 2 12 2m0 2a8 8 0 1 0 0 16 8 8 0 0 0 0-16m0 2a1 1 0 0 1 .993.883L13 7v4.586l1.707 1.707a1 1 0 0 1-1.32 1.497l-.094-.083-2-2a1 1 0 0 1-.284-.576L11 12V7a1 1 0 0 1 1-1" />
                                </svg>
                                <p>Added: {{ \Carbon\Carbon::parse($vacancy->asked_date)->format('d-m-Y') }}</p>
                            </div>

                            <div class="record-needed"
                                style="display: flex; justify-content: flex-start; margin-left: -60px;; gap: 10px; align-items: center;">
                                <img src="storage/{{ $vacancy->image_path }}"
                                    style="width: 50px; height: 50px; border-radius: 50%; baccground-color: #f1f1f1;  box-shadow: 1px 1px 4px 1px #333;">
                                <div>
                                    <p style="margin-left: -2px;font-size: 14px">{{ $vacancy->job }} -
                                        {{ $vacancy->branch->branch_name ?? 'N/A' }}</p>
                                    <p style="font-size: 14px; color: var(--text-light-color); font-weight: 500;">
                                        {{ $vacancy->employee->name }}</p>
                                </div>

                                <p style="color: green;font-size: 14px">Completed :
                                    {{ \Carbon\Carbon::parse($vacancy->completed_date)->format('d-m-Y') }}</p>
                            </div>

                            <div class="record-action">
                                <svg style="fill: var(--text-light-color); width: 25px;" viewBox="0 0 64 64"
                                    data-name="Layer 1" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M28.75 55.5a23.5 23.5 0 1 1 14-42.38 2 2 0 0 1-2.38 3.21A19.51 19.51 0 1 0 48.25 32a20 20 0 0 0-.25-3.07 2 2 0 1 1 4-.62 24 24 0 0 1 .25 3.69 23.52 23.52 0 0 1-23.5 23.5" />
                                    <path
                                        d="M31.25 39.5a2 2 0 0 1-1.41-.59l-9.5-9.5a2 2 0 0 1 2.82-2.82l8.09 8.08 24.09-24.08a2 2 0 0 1 2.82 2.82l-25.5 25.5a2 2 0 0 1-1.41.59" />
                                </svg>
                            </div>
                        </div>
                    @endforeach


                </div>

            </div>

            <div class="row-right-top item-1">
                <h2>Vacancies Graph</h2>
                <span class="line"></span>
                <div class="coming-soon">
                    <p>Coming Soon</p>
                    <div class="coming-soon-spinner"></div>
                </div>
            </div>

            <div class="row-right-top item-2">
                <h2>Vacancies Graph</h2>
                <span class="line"></span>
                <div class="coming-soon">
                    <p>Coming Soon</p>
                    <div class="coming-soon-spinner"></div>
                </div>
            </div>

        </div>

    </div>

@endsection

<script>
    //Toggle Buttons
    document.addEventListener('DOMContentLoaded', () => {
        const toggleController = document.querySelector('.controller-toggle');
        const toDoButton = toggleController.children[0]; // First <p> (To Do)
        const completedButton = toggleController.children[1]; // Second <p> (Completed)

        const toDoContainer = document.querySelector('.row-left-container:not(.vacancies-completed)');
        const completedContainer = document.querySelector('.row-left-container.vacancies-completed');

        // Load state from localStorage
        const activeToggle = localStorage.getItem('activeToggle') || 'toDo';

        if (activeToggle === 'completed') {
            completedContainer.style.display = 'flex';
            toDoContainer.style.display = 'none';
            toDoButton.classList.remove('active');
            completedButton.classList.add('active');
        } else {
            completedContainer.style.display = 'none';
            toDoContainer.style.display = 'flex';
            toDoButton.classList.add('active');
            completedButton.classList.remove('active');
        }

        toggleController.addEventListener('click', (e) => {
            if (e.target.tagName === 'P') {
                if (e.target === completedButton) {
                    // Show completed and hide to-do
                    completedContainer.style.display = 'flex';
                    toDoContainer.style.display = 'none';
                    localStorage.setItem('activeToggle', 'completed'); // Save state
                } else if (e.target === toDoButton) {
                    // Show to-do and hide completed
                    completedContainer.style.display = 'none';
                    toDoContainer.style.display = 'flex';
                    localStorage.setItem('activeToggle', 'toDo'); // Save state
                }

                // Update active class
                toDoButton.classList.remove('active');
                completedButton.classList.remove('active');
                e.target.classList.add('active');
            }
        });
    });

    //sweetalert2
    document.addEventListener('DOMContentLoaded', () => {
        const deleteButtons = document.querySelectorAll('.delete-button');

        deleteButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                const form = button.closest('form'); // Find the parent form

                Swal.fire({
                    title: 'Are you sure?',
                    text: "This action cannot be undone!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Submit the form if confirmed
                    }
                });
            });
        });
    });

    //Search Functionality
    document.addEventListener('DOMContentLoaded', () => {
        const searchInput = document.getElementById('search');
        const vacancyRecords = document.querySelectorAll('.row-left-container-record');

        // Function to filter records
        const filterVacancies = () => {
            const searchValue = searchInput.value.toLowerCase();

            vacancyRecords.forEach(record => {
                const recordNeeded = record.querySelector('.record-needed');
                const recordNeededSpan = record.querySelector('.record-needed span');

                const recordText = recordNeeded ? recordNeeded.textContent.toLowerCase() : '';
                const recordTextStatus = recordNeededSpan ? recordNeededSpan.textContent
                    .toLowerCase() : '';

                if (recordText.includes(searchValue) || recordTextStatus.includes(searchValue)) {
                    record.style.display = 'flex'; // Show matching records
                } else {
                    record.style.display = 'none'; // Hide non-matching records
                }
            });
        };

        searchInput.addEventListener('input', filterVacancies);
    });


    //function to ask if i need to add a new vacancy
</script>


<style>
    body {
        overflow: hidden
    }

    input[type="text"],
    input[type="datetime-local"] {
        font-size: 14px !important;
    }

    .row-right-top {
        text-align: center;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background: #f9f9f9;
        margin-bottom: 20px;
    }

    .coming-soon {
        position: relative;
        padding: 50px 20px;
        border-radius: 8px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 200px;
    }

    .coming-soon p {
        font-size: 24px;
        font-weight: bold;
        color: #333;
        margin: 10px 0;
    }

    .coming-soon-spinner {
        width: 40px;
        height: 40px;
        border: 4px solid #ccc;
        border-top: 4px solid #00b7f1;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>
