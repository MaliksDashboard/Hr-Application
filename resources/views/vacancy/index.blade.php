@extends('layouts.master')
@section('title', 'Vacancies')
@section('custom_title', 'Vacacnies Managment')

@section('main')

    <div class="main vacancy px-4 sm:px-6 lg:px-8 py-6">

        <!-- Top Action -->
        <div class="flex justify-start mb-6">
            @can('Create')
                <a href="{{ route('vacancies.create') }}"
                    class="inline-flex items-center gap-2 px-5 py-2 bg-orange-600 hover:bg-orange-700 text-white font-semibold rounded-full shadow-md transition">
                    <svg class="w-4 h-4" fill="white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path
                            d="M256 0C114.6 0 0 114.6 0 256s114.6 256 256 256 256-114.6 256-256S397.4 0 256 0m149.3 277.3c0 11.8-9.5 21.3-21.3 21.3h-85.3V384c0 11.8-9.5 21.3-21.3 21.3h-42.7c-11.8 0-21.3-9.6-21.3-21.3v-85.3H128c-11.8 0-21.3-9.6-21.3-21.3v-42.7c0-11.8 9.5-21.3 21.3-21.3h85.3V128c0-11.8 9.5-21.3 21.3-21.3h42.7c11.8 0 21.3 9.6 21.3 21.3v85.3H384c11.8 0 21.3 9.6 21.3 21.3z" />
                    </svg>
                    Add Vacancy
                </a>
            @endcan
        </div>

        <!-- Layout -->
        <div class="flex flex-col xl:flex-row gap-6">
            <div class="flex flex-col space-y-6 gap-6">


                @php
                    $selectedArea = request('area'); // null, "Shar2iye", or "Gharbiye"
                @endphp

                <!-- Controls -->
                <div class="flex gap-2">
                    <a href="{{ route('vacancies.index') }}"
                        class="px-4 py-2 text-base font-medium rounded-full shadow transition
                              {{ !$selectedArea ? 'bg-orange-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        All
                    </a>

                    <a href="{{ route('vacancies.index', ['area' => 'Shar2iye']) }}"
                        class="px-4 py-2 text-base font-medium rounded-full shadow transition
                              {{ $selectedArea === 'Shar2iye' ? 'bg-orange-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        Shar2iye
                    </a>

                    <a href="{{ route('vacancies.index', ['area' => 'Gharbiye']) }}"
                        class="px-4 py-2 text-base font-medium rounded-full shadow transition
                              {{ $selectedArea === 'Gharbiye' ? 'bg-orange-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        Gharbiye
                    </a>


                    <input type="text" id="vacancySearch"
                        class="w-full text-base text-gray-700 placeholder-gray-400 focus:outline-none"
                        placeholder="Search by Branch or Job...">

                </div>


                <!-- Vacancy Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-2 gap-6">
                    @foreach ($vacancies as $vacancy)
                        @php
                            $status = strtolower(trim($vacancy->status ?? 'high'));

                            $styles = match ($status) {
                                'high' => [
                                    'badge' => 'bg-gradient-to-r from-pink-500 to-red-500 text-white',
                                    'icon' => 'fas fa-fire',
                                    'border' => 'border-l-4 border-pink-500',
                                ],
                                'medium' => [
                                    'badge' => 'bg-gradient-to-r from-yellow-400 to-orange-400 text-white',
                                    'icon' => 'fas fa-bolt',
                                    'border' => 'border-l-4 border-yellow-400',
                                ],
                                'low' => [
                                    'badge' => 'bg-gradient-to-r from-green-400 to-emerald-500 text-white',
                                    'icon' => 'fas fa-leaf',
                                    'border' => 'border-l-4 border-green-500',
                                ],
                                default => [
                                    'badge' => 'bg-gray-400 text-white',
                                    'icon' => 'fas fa-question',
                                    'border' => 'border-l-4 border-gray-400',
                                ],
                            };
                        @endphp
                        <div class="vacancy-card bg-white rounded-xl ...">
                            <div
                                class="bg-white rounded-xl p-6 shadow hover:shadow-md transition-all flex flex-col gap-4 {{ $styles['border'] }}">
                                <!-- Top -->
                                <div class="flex justify-between items-center">
                                    <span class="text-base text-gray-400 flex items-center gap-2">
                                        <i class="fas fa-clock"></i>Asked:
                                        {{ \Carbon\Carbon::parse($vacancy->asked_date)->format('d-m-Y') }}
                                    </span>
                                    <span
                                        class="text-white text-base font-semibold rounded-full px-4 py-1 shadow-sm inline-flex items-center gap-2"
                                        style="
                                            background-image:
                                            @if ($status === 'high') linear-gradient(to right, #ec4899, #ef4444);
                                            @elseif ($status === 'medium')
                                                linear-gradient(to right, #facc15, #f97316);
                                            @elseif ($status === 'low')
                                                linear-gradient(to right, #4ade80, #10b981);
                                            @else
                                                #6b7280; @endif
                                             ">
                                        <i class="{{ $styles['icon'] }}"></i>
                                        {{ ucfirst($status) }}
                                    </span>


                                </div>

                                <!-- Job Info -->
                                <div class="space-y-1">
                                    <h3 class="job-title font-bold text-gray-800 text-xl">
                                        {{ $vacancy->jobRelation->name ?? 'No Job' }}
                                    </h3>
                                    <p class="branch-name text-base text-gray-600">Branch:
                                        {{ $vacancy->branch->branch_name ?? 'N/A' }}
                                    </p>

                                    <p class="area text-base text-gray-600">Area:
                                        {{ $vacancy->area ?? 'N/A' }}
                                    </p>

                                    <p class="shift text-base text-gray-600">Shift:
                                        {{ $vacancy->shift }}
                                    </p>
                                </div>

                                <p class="text-base italic text-gray-500">Remarks:
                                    {{ $vacancy->remarks ? $vacancy->remarks : 'Nothing' }}</p>

                                <!-- Actions -->
                                <div class="flex gap-3 pt-2">
                                    @can('Edit')
                                        <a href="{{ route('vacancies.edit', $vacancy->id) }}"
                                            class="inline-flex items-center gap-2 px-4 py-1 text-base font-medium text-blue-700 bg-blue-100 hover:bg-blue-200 rounded-full transition">
                                            <i class="fas fa-pen"></i> Edit
                                        </a>
                                    @endcan

                                    @can('Delete')
                                        <form action="{{ route('vacancies.destroy', $vacancy->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center gap-2 px-4 py-1 text-base font-medium text-red-700 bg-red-100 hover:bg-red-200 rounded-full transition delete-button">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>



@endsection

<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
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
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.getElementById('vacancySearch');
        const cards = document.querySelectorAll('.vacancy-card');

        if (searchInput) {
            searchInput.addEventListener('input', function() {
                const keyword = this.value.toLowerCase();

                cards.forEach(card => {
                    const title = card.querySelector('.job-title')?.textContent.toLowerCase() ||
                        '';
                    const branch = card.querySelector('.branch-name')?.textContent
                        .toLowerCase() || '';
                    const shift = card.querySelector('.shift')?.textContent.toLowerCase() || '';
                    const area = card.querySelector('.area')?.textContent.toLowerCase() || '';

                    if (
                        title.includes(keyword) ||
                        branch.includes(keyword) ||
                        shift.includes(keyword) ||
                        area.includes(keyword)
                    ) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        }
    });
</script>


<style>
    path {
        display: block !important;
    }

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

    .dashboard-header {
        display: flex !important;
        justify-content: start;
    }
</style>
