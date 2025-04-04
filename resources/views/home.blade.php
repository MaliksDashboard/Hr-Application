@extends('layouts.master')
@section('title', 'Home')
@section('custom_title', 'Home')

@section('main')
    <div class="main bg-[#f5f7fa] min-h-screen px-4 md:px-10 py-8 space-y-8">

        <div class="grid grid-cols-2 xl:grid-cols-2 gap-6 items-stretch">

            <!-- LEFT SIDE: 2x2 Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 xl:col-span-2">
                <!-- Card 1 -->
                <div class="bg-white p-6 rounded-2xl shadow-md flex items-center gap-4">
                    <div class="bg-blue-100 text-blue-600 p-2 rounded-full">
                        <svg style="fill:var(--primary-color)" viewBox="0 0 15 15" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M2 13.748c0 .138.112.25.25.25h3.749v-3h3v3h3.749a.25.25 0 0 0 .25-.25v-5.75H2zm11.93-7.17-.932-.82V2a1 1 0 1 0-2 0v2L7.681 1.09a.25.25 0 0 0-.353-.011l-.011.011-6.25 5.463a.25.25 0 0 0 .18.42L3 7h10.747a.25.25 0 0 0 .183-.421" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-s text-gray-500">Branch Name</p>
                        <h3 class="text-lg font-bold text-gray-800">{{ $user->employee->branch->branch_name }}</h3>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white p-6 rounded-2xl shadow-md flex items-center gap-4">
                    <div class="bg-green-100 text-green-600 p-2 rounded-full">
                        <svg viewBox="0 0 24 24" version="1.2" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M17.657 5.304c-3.124-3.073-8.189-3.073-11.313 0a7.78 7.78 0 0 0 0 11.13L12 21.999l5.657-5.565a7.78 7.78 0 0 0 0-11.13M12 13.499c-.668 0-1.295-.26-1.768-.732a2.503 2.503 0 0 1 0-3.536c.472-.472 1.1-.732 1.768-.732s1.296.26 1.768.732a2.503 2.503 0 0 1 0 3.536c-.472.472-1.1.732-1.768.732" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-s text-gray-500">Location</p>
                        <h3 class="text-lg font-bold text-gray-800">{{ $user->employee->branch->location }}</h3>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white p-6 rounded-2xl shadow-md flex items-center gap-4">
                    <div class="bg-purple-100 text-purple-600 p-2 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52" xml:space="preserve">
                            <path
                                d="M24.9 30.1c.6.6 1.5.6 2.1 0l22.6-21c.4-.8.3-2.1-1.3-2.1l-44.7.1c-1.2 0-2.2 1.1-1.3 2.1z" />
                            <path
                                d="M50 17.3c0-1-1.2-1.6-2-.9L30.3 32.7c-1.2 1.1-2.7 1.7-4.3 1.7s-3.1-.6-4.3-1.6L4.1 16.4c-.8-.7-2-.2-2 .9C2 17 2 40 2 40c0 2.2 1.8 4 4 4h40c2.2 0 4-1.8 4-4z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-s text-gray-500">Manager Email</p>
                        <p class="text-m font-bold text-gray-700">{{ $user->employee->branch->manager_email }}</p>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="bg-white p-6 rounded-2xl shadow-md flex items-center gap-4">
                    <div class="bg-yellow-100 text-yellow-600 p-2 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52" xml:space="preserve">
                            <path
                                d="M24.9 30.1c.6.6 1.5.6 2.1 0l22.6-21c.4-.8.3-2.1-1.3-2.1l-44.7.1c-1.2 0-2.2 1.1-1.3 2.1z" />
                            <path
                                d="M50 17.3c0-1-1.2-1.6-2-.9L30.3 32.7c-1.2 1.1-2.7 1.7-4.3 1.7s-3.1-.6-4.3-1.6L4.1 16.4c-.8-.7-2-.2-2 .9C2 17 2 40 2 40c0 2.2 1.8 4 4 4h40c2.2 0 4-1.8 4-4z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-s text-gray-500">Services Gmail</p>
                        <p class="text-m font-bold text-gray-700">{{ $user->employee->branch->services_gmail }}</p>
                    </div>
                </div>

                <!-- Card 5 -->
                <div class="bg-white p-6 rounded-2xl shadow-md flex items-center gap-4">
                    <div class="bg-yellow-100 text-yellow-600 p-2 rounded-full">
                        <svg viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg">
                            <g data-name="Layer 3">
                                <circle cx="16.86" cy="9.73" r="6.46" />
                                <path d="M21 28h7v1.4h-7z" />
                                <path
                                    d="M15 30v3a1 1 0 0 0 1 1h17a1 1 0 0 0 1-1V23a1 1 0 0 0-1-1h-7v-1.47a1 1 0 0 0-2 0V22h-2v-3.58a32 32 0 0 0-5.14-.42 26 26 0 0 0-11 2.39 3.28 3.28 0 0 0-1.88 3V30Zm17 2H17v-8h7v.42a1 1 0 0 0 2 0V24h6Z" />
                            </g>
                        </svg>
                    </div>
                    <div>
                        <p class="text-s text-gray-500">Total Employees</p>
                        <p class="text-lg font-bold text-gray-700">{{ $totalEmployees }} Members</p>
                    </div>
                </div>

                <!-- Card 6 -->
                <div class="bg-white p-6 rounded-2xl shadow-md flex items-center gap-4">
                    <div class="bg-yellow-100 text-yellow-600 p-2 rounded-full">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 8l9 6 9-6M21 8v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-s text-gray-500">Services Gmail</p>
                        <p class="text-m font-bold text-gray-700">{{ $user->employee->branch->services_gmail }}</p>
                    </div>
                </div>
            </div>

            <!-- RIGHT SIDE: Graph Card -->
            <div class="bg-white p-6 rounded-2xl shadow-md h-full">
                <h2 class="text-lg font-bold text-gray-700 mb-4 flex items-center gap-2">
                    <svg class="w-6 h-6 text-[var(--third-color)]" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 11V7h2v4h2l-3 3-3-3h2z" />
                    </svg>
                    Job Chart
                </h2>
                <div class="w-full h-[300px]">
                    <canvas id="jobChart"></canvas>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">

            <div class=" bg-white p-6 rounded-2xl shadow-md max-h-[600px] overflow-y-auto pr-2">
                <h2 class="text-lg font-bold text-gray-700 mb-4 flex items-center gap-2">
                    <svg viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg">
                        <g data-name="Layer 3">
                            <circle cx="16.86" cy="9.73" r="6.46" />
                            <path d="M21 28h7v1.4h-7z" />
                            <path
                                d="M15 30v3a1 1 0 0 0 1 1h17a1 1 0 0 0 1-1V23a1 1 0 0 0-1-1h-7v-1.47a1 1 0 0 0-2 0V22h-2v-3.58a32 32 0 0 0-5.14-.42 26 26 0 0 0-11 2.39 3.28 3.28 0 0 0-1.88 3V30Zm17 2H17v-8h7v.42a1 1 0 0 0 2 0V24h6Z" />
                        </g>
                    </svg>
                    Branch Employees
                </h2>

                <div
                    class="grid home-emp grid-cols-2 sm:grid-cols-2 md:grid-cols-3 gap-4 max-h-[350px] overflow-y-auto pr-1">
                    @forelse($employees as $emp)
                        <div class="flex items-center justify-between gap-4 bg-gray-100 p-2 rounded-lg shadow-sm">
                            <div class="flex items-center gap-2 p-2 rounded-s">
                                <img src="{{ asset('storage/' . ($emp->image_path ?? 'default.png')) }}"
                                    class="w-12 h-12 border rounded-full object-cover border" alt="{{ $emp->name }}">
                                <span class="text-sm font-medium text-gray-800">{{ $emp->name }}</span>
                            </div>
                            <span class="text-s, text-gray-500 ">{{ $emp->job_name ?? 'N/A' }}</span>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">No employees found.</p>
                    @endforelse
                </div>
            </div>


            <div class="bg-white p-6 rounded-2xl shadow-md">
                <h2 class="text-lg font-bold text-gray-700 mb-4 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path
                            d="M12 6a2 2 0 0 0 2-2c0-.38-.1-.73-.29-1.03L12 0l-1.71 2.97c-.19.3-.29.65-.29 1.03 0 1.1.9 2 2 2m4.6 9.99-1.07-1.07-1.08 1.07c-1.3 1.3-3.58 1.31-4.89 0l-1.07-1.07-1.09 1.07C6.75 16.64 5.88 17 4.96 17c-.73 0-1.4-.23-1.96-.61V21c0 .55.45 1 1 1h16c.55 0 1-.45 1-1v-4.61c-.56.38-1.23.61-1.96.61-.92 0-1.79-.36-2.44-1.01M18 9h-5V7h-2v2H6c-1.66 0-3 1.34-3 3v1.54c0 1.08.88 1.96 1.96 1.96.52 0 1.02-.2 1.38-.57l2.14-2.13 2.13 2.13c.74.74 2.03.74 2.77 0l2.14-2.13 2.13 2.13c.37.37.86.57 1.38.57 1.08 0 1.96-.88 1.96-1.96V12C21 10.34 19.66 9 18 9" />
                    </svg>
                    Upcoming Birthdays
                </h2>

                <ul class="space-y-2 text-sm text-gray-700">
                    @forelse($birthdays as $bday)
                        <li class="flex justify-between items-center py-1 border-b border-gray-100">
                            <div class="flex items-center gap-2">
                                <img src="{{ asset('storage/' . ($bday->image_path ?? 'default.png')) }}"
                                    class="w-12 h-12 rounded-full object-cover border" alt="{{ $bday->name }}">
                                <span class="text-lg">{{ $bday->name }}</span>
                            </div>
                            <span class="text-lg text-gray-500">
                                {{ \Carbon\Carbon::parse($bday->birthday)->format('M d') }}
                            </span>
                        </li>
                    @empty
                        <li class="text-gray-500">No upcoming birthdays 🎉</li>
                    @endforelse
                </ul>
            </div>

        </div>



        <!-- Chart Script -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const ctx = document.getElementById('jobChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: @json(array_keys($employeesByJob)),
                        datasets: [{
                            label: 'Employees',
                            data: @json(array_values($employeesByJob)),
                            backgroundColor: getComputedStyle(document.documentElement)
                                .getPropertyValue('--third-color').trim(),
                            borderRadius: 6,
                            barThickness: 36
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
        </script>
        <style>
            .home-emp {
                max-height: 600px !important;
                overflow-y: auto;
            }

            .main {
                gap: 0 !important;
            }
        </style>

    @endsection
