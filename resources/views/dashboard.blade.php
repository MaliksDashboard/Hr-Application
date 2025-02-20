@extends('layouts.master')
@section('title', 'Dashboard')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- jsVectorMap -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap/dist/css/jsvectormap.min.css">
<script src="https://cdn.jsdelivr.net/npm/jsvectormap/dist/js/jsvectormap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jsvectormap/dist/maps/world.js"></script>

@section('main')

    <div class="main">

        <div class="dashboard-header">
            <h1>Dashboard</h1>
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
                                            {{ $count > 0 ? $count . ' Employee' . ($count > 1 ? 's' : '') : '-' }}
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

                <div style="display: flex; align-items: center; justify-content: center;margin-top:30px">
                    <canvas id="jobDonutChart" width="200" height="200"></canvas>
                    <div class="chart-legend">
                        <ul class="custom-legend">
                            <li><span class="legend-box" style="background-color: #AA5486;"></span> Services 54</li>
                            <li><span class="legend-box" style="background-color: #FC8F54;"></span> Stationery 14</li>
                            <li><span class="legend-box" style="background-color: #FDE7BB;"></span> Computer 51</li>
                            <li><span class="legend-box" style="background-color: #FBF4DB;"></span> Cashiers 26</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection


<script>
    //Donut chart
    document.addEventListener('DOMContentLoaded', function() {
        // Random data for missing jobs
        const missingJobs = {
            Services: Math.floor(Math.random() * 50 + 10),
            Stationery: Math.floor(Math.random() * 50 + 10),
            ComputerOperators: Math.floor(Math.random() * 50 + 10),
            Cashiers: Math.floor(Math.random() * 50 + 10),
        };

        // Chart colors (darker, vintage tones)
        const chartColors = [
            '#AA5486', // Dark vintage green
            '#FC8F54', // Olive green
            '#FDE7BB', // Slate blue
            '#FBF4DB', // Charcoal blue
        ];

        // Create the chart
        const ctx = document.getElementById('jobDonutChart').getContext('2d');
        const totalEmployees = 39; // Example total (12 + 19 + 3 + 5)

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: Object.keys(missingJobs), // Section labels
                datasets: [{
                    data: Object.values(missingJobs), // Random values
                    backgroundColor: chartColors, // Vintage colors
                    borderWidth: 2,
                }],
            },
            options: {
                plugins: {
                    legend: {
                        display: false, // Disable default legend
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

    });
</script>
