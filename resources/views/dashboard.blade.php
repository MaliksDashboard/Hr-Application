@extends('layouts.master')
@section('title', 'Dashboard')
@section('custom_title', 'Dashboard')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- jsVectorMap -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap/dist/css/jsvectormap.min.css">
<script src="https://cdn.jsdelivr.net/npm/jsvectormap/dist/js/jsvectormap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jsvectormap/dist/maps/world.js"></script>

@section('main')

    <div class="main dashboard">

        <div class="dashboard-header">
            <a class="instructor" href=""><svg viewBox="-60 0 512 512" xmlns="http://www.w3.org/2000/svg">
                    <path d="m64 96 264 160L64 416z" />
                </svg> Getting Started</a>
        </div>

        <div class="first-row">
            <div class="first-card">
                <div class="first-card-header">
                    <h2>Hiring Pipeline</h2>
                    <a href="{{ url('/employees') }}">View All Employees</a>
                </div>
                <span class="line"></span>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th style="text-align: left">Role</th>
                                <th>Legendary</th>
                                <th>Heroes</th>
                                <th>Experts</th>
                                <th>Professionals</th>
                                <th>Experienced</th>
                                <th>New Hired</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $role => $categories)
                                <tr class="{{ $loop->index % 2 == 0 ? 'row-even' : 'row-odd' }}">
                                    <td class="roles">{{ $role }}</td>
                                    @foreach ($categories as $category => $count)
                                        <td
                                            class="{{ $count > 0 ? 'category-' . strtolower(str_replace(' ', '-', $category)) : 'empty' }}">
                                            {{ $count > 0 ? $count : '-' }}
                                            @if ($count > 0)
                                                <span class="word-emp">Employee{{ $count != 1 ? 's' : '' }}</span>
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

            <div class="second-card">
                <div class="second-card-header">
                    <h2>Vacancies Available</h2>
                </div>
                <div class="line"></div>

                <div class="donut-chart"
                    style="display: flex; align-items: center; justify-content: center;margin-top:30px">
                    <canvas id="jobDonutChart" width="200" height="200"></canvas>
                    <div class="chart-legend">
                        <ul class="custom-legend">
                            <li><span class="legend-box" style="background-color: #AA5486;"></span> Services 54</li>
                            <li><span class="legend-box" style="background-color: #FC8F54;"></span> Stationery 14</li>
                            <li><span class="legend-box" style="background-color: #FDE7BB;"></span> Computer 51</li>
                            <li><span class="legend-box" style="background-color: #FDE7BB;"></span> Computer 51</li>
                            <li><span class="legend-box" style="background-color: #FBF4DB;"></span> Cashiers 26</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="third-card">
                <div class="second-card-header">
                    <h2>Action System</h2>
                    <small>(This will show you the latest aciton made by the users)</small>
                </div>

                <div class="third-card-container">
                    @foreach ($notifications as $action)
                        <div class="third-card-container-action">
                            <img src="storage/{{ $action->user_image }}" alt="{{ $action->type }}">
                            <div class="aciton-info">
                                <span>{{ $action->message }}</span>
                                <small>Action</small>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

            <div class="fourth-card">
                <div class="second-card-header">
                    <h2>🎖️ Work Anniversaries</h2>
                    <small>(Celebrate your colleagues! 🎊)</small>
                </div>

                @if ($workAnniversaries->isEmpty())
                    <p class="no-anniversaries">No work anniversaries this month.</p>
                @else
                    <div class="anniversary-list">
                        @foreach ($workAnniversaries as $emp)
                            <div
                                class="anniversary-card {{ Carbon\Carbon::now()->addDay()->format('F d') == $emp['anniversary_date'] ? 'highlight' : '' }}">
                                <div class="avatar">
                                    <img src="{{ asset('storage/' . $emp['image_path']) }}" alt="{{ $emp['name'] }}">
                                </div>
                                <div class="info">
                                    <h3>{{ $emp['name'] }} -
                                        {{ $emp['years'] }} Year{{ $emp['years'] > 1 ? 's' : '' }}

                                    </h3>
                                    <p class="anniversary-date">Since {{ $emp['anniversary_date'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="fifth-card">
                <div class="second-card-header">
                    <h3>🎂 Birthday Celebrations</h3>
                    <small style="color:var(--text-light-color);">(Celebrate your colleagues! 🎊)</small>
                </div>

                @if ($birthdays->isEmpty())
                    <p class="no-birthdays">No upcoming birthdays.</p>
                @else
                    <div class="birthday-list">
                        @foreach ($birthdays as $emp)
                            <div class="birthday-card {{ $emp['is_today'] ? 'highlight' : '' }}">
                                <div class="avatar">
                                    <img src="{{ asset('storage/' . $emp['image_path']) }}" alt="{{ $emp['name'] }}">
                                </div>
                                <div class="info">
                                    <h3>{{ $emp['name'] }} 🎉</h3>
                                    <p class="branch-name">📍 {{ $emp['branch'] }}</p>
                                    <p class="birthday-date">🎂 {{ $emp['birthday'] }} (Turning {{ $emp['age'] }})</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>



        </div>


    </div>

@endsection


<script>
    //Donut chart
    document.addEventListener('DOMContentLoaded', async function() {
        try {
            // Fetch data from API
            const response = await fetch('/getVaccanciesData');
            const jobData = await response.json();

            // Extract labels and values from API response
            const jobLabels = Object.keys(jobData);
            const jobCounts = Object.values(jobData);

            // Chart colors (you can change or add more if needed)
            const chartColors = ['#AA5486', '#FC8F54', '#FDE7BB', '#FBF4DB'];

            // Create the chart
            const ctx = document.getElementById('jobDonutChart').getContext('2d');

            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: jobLabels, // Dynamic section labels
                    datasets: [{
                        data: jobCounts, // Dynamic values from API
                        backgroundColor: chartColors.slice(0, jobLabels
                            .length), // Assign colors dynamically
                        borderWidth: 2,
                    }],
                },
                options: {
                    plugins: {
                        legend: {
                            display: false, // Hide default legend
                        },
                    },
                    responsive: true,
                    cutout: '80%', // Make the chart thinner
                    layout: {
                        padding: {
                            right: 20, // Space for the labels
                        },
                    },
                },
            });

            // Update the legend dynamically
            const legendContainer = document.querySelector('.custom-legend');
            legendContainer.innerHTML = ''; // Clear existing legend

            jobLabels.forEach((job, index) => {
                const legendItem = document.createElement('li');
                legendItem.innerHTML =
                    `<span class="legend-box" style="background-color: ${chartColors[index]};"></span> ${job}: ${jobCounts[index]}`;
                legendContainer.appendChild(legendItem);
            });

        } catch (error) {
            console.error("Error fetching vacancy data:", error);
        }
    });
</script>
