@extends('layouts.master')
@section('title', 'Dashboard')
@section('custom_title', 'Dashboard')


@section('main')

    <div class="main dashboard">

        <div class="dashboard-header">
            <a class="instructor" href=""><svg viewBox="-60 0 512 512" xmlns="http://www.w3.org/2000/svg">
                    <path d="m64 96 264 160L64 416z" />
                </svg> Getting Started</a>
        </div>

        <div class="first-row">
            <div class="first-card">

                <span class="dashboard-message">Consistency fuels success—keep going!
                </span>

                <div class="contents-dashboard">

                    <div class="first-card-content">
                        <span>
                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M6.75 6.5a5.25 5.25 0 1 1 10.5 0 5.25 5.25 0 0 1-10.5 0m-2.5 12.071a5.32 5.32 0 0 1 5.321-5.321h4.858a5.32 5.32 0 0 1 5.321 5.321 4.18 4.18 0 0 1-4.179 4.179H8.43a4.18 4.18 0 0 1-4.179-4.179"
                                    fill-rule="evenodd" clip-rule="evenodd"></path>
                            </svg>
                        </span>
                        <div class="card-contnet-info">
                            <p>Total Employees</p>
                            <small>{{ $countEmployees }}</small>
                        </div>
                    </div>

                    <div class="first-card-content">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 297 297" xml:space="preserve">
                                <path
                                    d="M284.583 276.914h-30.892c-1.702-19.387-5.386-59.954-7.771-75.858-2.715-18.113-17.518-33.527-36.835-38.357l-20.107-5.027c-3.25 19.41-20.159 34.253-40.477 34.253s-37.227-14.843-40.477-34.253l-20.107 5.027c-19.317 4.829-34.121 20.244-36.835 38.357-2.385 15.904-6.069 56.471-7.771 75.858H12.417c-5.546 0-10.043 4.497-10.043 10.043S6.871 297 12.417 297h272.165c5.546 0 10.043-4.497 10.043-10.043s-4.495-10.043-10.042-10.043m-57.403 0h-14.06v-65.258H83.881v65.258h-14.06v-72.288a7.03 7.03 0 0 1 7.03-7.03h143.3a7.03 7.03 0 0 1 7.03 7.03v72.288zm-78.679-162.28c27.103 0 48.125-35.753 48.125-66.509C196.626 18.89 177.735 0 148.501 0s-48.125 18.89-48.125 48.125c0 30.757 21.022 66.509 48.125 66.509" />
                                <path
                                    d="M129.774 124.617c-.053 7.43-1.516 17.95-8.265 25.567 0 14.883 12.107 27.681 26.991 27.681s26.991-12.798 26.991-27.681c-6.748-7.617-8.212-18.136-8.263-25.567-5.86 2.617-12.139 4.078-18.727 4.078-6.587 0-12.867-1.461-18.727-4.078" />
                            </svg>
                        </span>
                        <div class="card-contnet-info">
                            <p>Branch Employees</p>
                            <small>{{ $countBranches }}</small>
                        </div>
                    </div>

                    <div class="first-card-content">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 479.624 479.624" xml:space="preserve">
                                <path
                                    d="M260.836 0c-28 0-54.5 6.3-78.3 17.5-62.6 29-105.9 92.4-105.9 165.9v30.4l-37.3 71.3c-9.4 18-.5 32.7 19.8 32.7h17.5v67.8c0 21.2 17.3 38.5 38.5 38.5l52.9-7.9.1 52.8v.4c.3 6.8 6 11.3 13 10l190.4-33.7c7.2-1.3 13.1-8.3 13.1-15.6V318.3c36.5-33.5 59.4-81.6 59.4-135-.1-101.2-82.1-183.3-183.2-183.3m-54.4 91c-33.2 19.2-53.8 54.9-53.8 93.2 0 10.9-8.8 19.7-19.7 19.7s-19.7-8.8-19.7-19.7c.1-52.3 28.2-101.1 73.5-127.3 9.4-5.4 21.4-2.2 26.9 7.2s2.2 21.5-7.2 26.9m53.8-14.4c-10.9 0-19.7-8.8-19.7-19.7s8.8-19.7 19.7-19.7 19.7 8.8 19.7 19.7-8.8 19.7-19.7 19.7" />
                            </svg>
                        </span>
                        <div class="card-contnet-info">
                            <p>Head Office</p>
                            <small>{{ $countHeadOffice }}</small>
                        </div>
                    </div>

                    <div class="first-card-content">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 267.874 267.874" xml:space="preserve">
                                <path
                                    d="m106.808 180.323 21.23-33.523-32.392-14.525L85.587 146.8zm32.236-33.523 21.23 33.523 21.22-33.523-10.061-14.525z" />
                                <path
                                    d="M28.455 267.874H133.83l13.753-13.592 2.279 12.132-1.264 1.46h90.83c5.852 0 8.974-4.453 6.954-9.952l-34.48-94.185c-.777-2.217-1.947-4.147-3.263-5.986-.596-.844-1.905-2.236-1.905-2.236-2.771-3.123-6.188-5.35-10.072-6.333l-5.99-.591h-5.981c-.072.425-.104.87-.347 1.254l-4.08 6.451-14.976 23.644-2.164 3.428a3.35 3.35 0 0 1-2.833 1.554 3.36 3.36 0 0 1-2.837-1.554l-9.994-15.782 2.408 10.424-12.575 21.359 2.312 12.345-13.908 13.742 4.894-26.087-12.572-21.359 2.573-11.455-10.654 16.813a3.35 3.35 0 0 1-2.835 1.554 3.35 3.35 0 0 1-2.832-1.554l-2.509-3.95-10.636-16.793-8.081-12.77c-.238-.394-.277-.828-.344-1.258h-5.474l-6.017.585c-3.889.989-7.301 3.221-10.082 6.338 0 0-1.292 1.398-1.802 2.092-1.396 1.968-2.561 3.925-3.351 6.131l-34.481 94.18c-2.018 5.498 1.102 9.951 6.961 9.951m93.895-24.564 19.562-19.33 3.382 18.046-26.08 25.771-1.193-1.383zM82.542 92.481c-.753-18.815-1.261-65.936 12.197-69.139 5.393-1.3 8.394.684 12.189 3.174 7.185 4.714 20.573 13.533 71.111 12.244l1.46-.036.809 1.214c.403.604 9.507 14.639 10.791 49.109 1.678-1.352 3.66-3.355 5.427-6.032 1.31-5.212 2.076-10.641 2.076-16.262 0-35.708-28.024-64.761-63.3-66.573V0c-.616 0-1.163.075-1.761.085-.576-.01-1.144-.085-1.739-.085v.176C96.505 1.983 68.481 31.03 68.481 66.741c0 5.048.616 9.942 1.68 14.667 3.633 5.144 8.029 9.862 12.381 11.073" />
                                <path
                                    d="m189.696 96.267-3.713 1.734-.062-4.101c-.455-30.349-7.15-45.604-9.336-49.798-50.921 1.054-64.975-8.166-72.566-13.147-3.464-2.269-4.901-3.195-8.055-2.455-6.845 1.634-9.481 35.937-7.993 66.785l.125 2.586-2.584.187q-.428.031-.859.031c-3.684 0-7.18-1.711-10.369-4.256 9.958 22.323 31.775 38.194 57.513 39.525v.176c.596 0 1.157-.083 1.74-.088.593.005 1.145.088 1.76.088v-.176c25.412-1.315 46.994-16.811 57.112-38.693-1.491 1.001-2.542 1.521-2.713 1.602" />
                            </svg>
                        </span>
                        <div class="card-contnet-info">
                            <p>Team Leaders</p>
                            <small>{{ $countTeamLeader }}</small>
                        </div>
                    </div>

                </div>
            </div>

            <div class="second-card">
                <div class="second-card-header">
                    <h2>Employees Graph</h2>
                </div>

                <!-- Parent container for dynamic sizing -->
                <div class="bar-chart-container"
                    style="display: flex; align-items: center; justify-content: center; width: 100%; height: auto; min-height: 300px;">
                    <canvas id="jobBarChart"></canvas>
                </div>
            </div>

            <div class="third-card">
                <div class="second-card-header">
                    <h2>Vacancies Available</h2>
                </div>

                <div class="donut-chart"
                    style="display: flex; align-items: center; justify-content: center; margin-top:30px; flex-direction: column; position: relative;">
                    <canvas id="jobDonutChart" width="300" height="300"></canvas>
                </div>

                <!-- ✅ Vacancies List Below Graph -->
                <div class="vacancies-list"></div>

                <!-- ✅ View All Vacancies Button -->
                <a href="{{ url('/vacancies') }}" class="view-all-btn">View All Vacancies</a>
            </div>

            <div class="fourth-card">
                <div class="second-card-header">
                    <h2>Probation Period</h2>
                    <small>(End of Probation Period)</small>
                </div>

                <div class="table-container">
                    <table class="probation-table">
                        <thead>
                            <tr>
                                <th>Employee</th>
                                <th>Branch</th>
                                <th>End of Probation</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($noticeEmployees as $employee)
                                <tr>
                                    <td class="employee-info">
                                        <img src="storage/{{ $employee['image_path'] }}" alt="{{ $employee['name'] }}"
                                            class="employee-img">
                                        <span
                                            title="{{ $employee['name'] }}">{{ Str::limit($employee['name'], 10, '...') }}</span>
                                    </td>
                                    <td>{{ $employee['branch_name'] }}</td>
                                    <td>{{ \Carbon\Carbon::parse($employee['date_hired'])->addDays(90)->format('d-m-Y') }}
                                    </td>
                                    <td>
                                        <button class="send-email-btn-period" data-name="{{ $employee['name'] }}"
                                            data-branch="{{ $employee['branch_name'] }}"
                                            data-email="{{ $employee['branch_email'] }}" data-id="{{ $employee['id'] }}">
                                            Send Email
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="fifth-card">
                <div class="second-card-header">
                    <h2>Work Anniversaries</h2>
                    <small>(Recognizing dedicated employees)</small>
                </div>

                @if ($workAnniversaries->isEmpty())
                    <p class="no-anniversaries-message">No work anniversaries this month.</p>
                @else
                    <div class="anniversary-container">
                        @foreach ($workAnniversaries as $emp)
                            <div
                                class="anniversary-row {{ Carbon\Carbon::now()->addDay()->format('F d') == $emp['anniversary_date'] ? 'highlight-anniversary' : '' }}">
                                <div class="anniversary-avatar">
                                    <img src="{{ asset('storage/' . $emp['image_path']) }}" alt="{{ $emp['name'] }}">
                                </div>
                                <div class="anniversary-info">
                                    <h3>{{ Str::limit($emp['name'], 20, '...') }} - {{ $emp['years'] }}
                                        Year{{ $emp['years'] > 1 ? 's' : '' }}</h3>
                                    <p class="anniversary-date-text">Birthday: {{ $emp['anniversary_date'] }}</p>
                                </div>
                                <button class="anniversary-email-btn" data-email="{{ $emp['email'] }}"
                                    data-name="{{ $emp['name'] }}">
                                    Send Email
                                </button>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="sixth-card">
                <div class="second-card-header">
                    <h3>Birthday Celebrations</h3>
                    <small>Honoring our team members on their special day</small>
                </div>

                @if ($birthdays->isEmpty())
                    <p class="no-birthdays-message">No upcoming birthdays.</p>
                @else
                    <div class="birthday-container">
                        @foreach ($birthdays as $emp)
                            <div class="birthday-row {{ $emp['is_today'] ? 'highlight-birthday' : '' }}">
                                <div class="birthday-avatar">
                                    <img src="{{ asset('storage/' . $emp['image_path']) }}" alt="{{ $emp['name'] }}">
                                </div>
                                <div class="birthday-info">
                                    <h3>{{ Str::limit($emp['name'], 25, '...') }}</h3>
                                    <p class="birthday-branch">{{ $emp['branch'] }}</p>
                                    <p class="birthday-date">Born on {{ $emp['birthday'] }} (Turning {{ $emp['age'] }})
                                    </p>
                                </div>
                                <button class="birthday-email-btn" data-email="{{ $emp['email'] }}"
                                    data-name="{{ $emp['name'] }}">
                                    Send Birthday Wish
                                </button>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="seventh-card">
                <div class="second-card-header">
                    <h3>Employee Performance</h3>
                    <small>Recent evaluations & progress</small>
                </div>

                <div class="performance-container">
                    <table class="performance-table">
                        <thead>
                            <tr>
                                <th>Employee</th>
                                <th>Department</th>
                                <th>Last Evaluation Score</th>
                                <th>Progress</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employeeEvaluations as $evaluation)
                                <tr>
                                    <td>{{ Str::limit($evaluation['employee_name'], 12, '...') }}</td>
                                    <td>{{ $evaluation['department'] }}</td>
                                    <td>{{ $evaluation['score'] }}%</td>
                                    <td>
                                        <span class="progress-bar">
                                            <span class="progress-fill" style="width: {{ $evaluation['score'] }}%;"></span>
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Donut chart
        document.addEventListener('DOMContentLoaded', async function() {
            try {
                // Fetch data from API
                const response = await fetch('/getVaccanciesData');
                const jobData = await response.json();

                // Extract labels and values from API response
                const jobLabels = Object.keys(jobData);
                const jobCounts = Object.values(jobData);

                // Chart colors
                const chartColors = ['#FC8F54', '#AA5486', '#FDE7BB', '#FBF4DB'];

                // Get total vacancies
                const totalVacancies = jobCounts.reduce((acc, value) => acc + value, 0);

                // Get canvas context
                const ctx = document.getElementById('jobDonutChart').getContext('2d');

                let jobChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: jobLabels,
                        datasets: [{
                            data: jobCounts,
                            backgroundColor: chartColors.slice(0, jobLabels.length),
                            borderWidth: 1,
                            borderColor: '#ffffff',
                        }],
                    },
                    options: {
                        plugins: {
                            legend: {
                                display: false, // Hide default legend
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(tooltipItem) {
                                        return `${tooltipItem.label}: ${tooltipItem.raw} `;
                                    }
                                }
                            }
                        },
                        responsive: true,
                        cutout: '65%', // Slightly adjust cutout size
                        layout: {
                            padding: {
                                right: 20,
                            },
                        },
                    },
                });

                // ✅ Dynamically insert total vacancies in the center
                let centerText = document.createElement("div");
                centerText.classList.add("donut-center-text");
                centerText.innerHTML = `<strong>${totalVacancies}</strong> <br> Vacancies`;
                document.querySelector(".donut-chart").appendChild(centerText);

                // ✅ Update job vacancies list below the chart
                const vacanciesList = document.querySelector('.vacancies-list');
                vacanciesList.innerHTML = ''; // Clear existing list

                jobLabels.forEach((job, index) => {
                    let formattedJob = job.replace(/\b\w/g, char => char.toUpperCase());

                    const listItem = document.createElement('div');
                    listItem.classList.add('vacancy-item');
                    listItem.innerHTML =
                        `<strong>${formattedJob}: <br> </strong> ${jobCounts[index]}  Vacancies`;
                    vacanciesList.appendChild(listItem);
                });

            } catch (error) {
                console.error("Error fetching vacancy data:", error);
            }
        });

        //bar graphs:
        document.addEventListener("DOMContentLoaded", async function() {
            console.log("Checking if jobBarChart exists...");

            let canvas = document.getElementById('jobBarChart');
            console.log("Canvas found:", canvas);

            if (!canvas) {
                console.error("Canvas element #jobBarChart NOT found in the DOM!");
                return;
            }

            let ctx = canvas.getContext('2d');
            console.log("Context:", ctx);

            if (!ctx) {
                console.error("getContext('2d') returned null! Check if Chart.js is correctly loaded.");
                return;
            }

            console.log("All checks passed. Fetching data...");

            try {
                const response = await fetch("{{ route('getTopBranches') }}");

                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }

                const data = await response.json();
                console.log("Fetched Data:", data);

                if (!Array.isArray(data) || data.length === 0) {
                    console.warn("No data available for the chart.");
                    return;
                }

                // ✅ Shorten branch names
                let branchNames = data.map(branch =>
                    branch.branch_name.length > 10 ? branch.branch_name.substring(0, 10) + "..." : branch
                    .branch_name
                );

                let employeeCounts = data.map(branch => branch.employees_count || 10);

                // ✅ Get --third-color from CSS
                let rootStyles = getComputedStyle(document.documentElement);
                let thirdColor = rootStyles.getPropertyValue('--third-color').trim() ||
                    'rgba(255, 99, 132, 0.7)';

                if (window.myChart) {
                    window.myChart.destroy(); // ✅ Prevent duplicate charts
                }

                window.myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: branchNames,
                        datasets: [{
                            label: 'Employees',
                            data: employeeCounts,
                            backgroundColor: thirdColor, // ✅ Use CSS variable
                            borderColor: thirdColor,
                            borderWidth: 1,
                            borderRadius: 5, // ✅ Rounded top corners
                            barThickness: 60 // ✅ Thinner bars
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            x: {
                                ticks: {
                                    font: {
                                        size: 10
                                    },
                                    autoSkip: false,
                                    maxRotation: 0,
                                    minRotation: 0
                                },
                                grid: {
                                    color: 'rgba(0, 0, 0, 0.05)' // ✅ Lower opacity for background grid
                                }
                            },
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 10
                                },
                                grid: {
                                    color: 'rgba(0, 0, 0, 0.05)' // ✅ Lower opacity for background grid
                                }
                            }
                        },
                        layout: {
                            padding: 10
                        }
                    }
                });

            } catch (error) {
                console.error("Error fetching vacancy data:", error);
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.send-email-btn-period').forEach(button => {
                button.addEventListener('click', function() {
                    let employeeName = this.dataset.name;
                    let branch = this.dataset.branch;
                    let branchEmail = this.dataset.email;
                    let employeeID = this.dataset.id;

                    // Log the email to make sure it's being captured correctly
                    console.log('Employee Name:', employeeName);
                    console.log('Branch:', branch);
                    console.log('Branch Email:', branchEmail);

                    if (!branchEmail || branchEmail.trim() === '') {
                        alert("No branch email found for this employee.");
                        return;
                    }

                    // Show confirmation popup
                    Swal.fire({
                        title: "Send Notice Email?",
                        text: `Are you sure you want to request an assessment for ${employeeName}?`,
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Yes, send it!",
                        cancelButtonText: "No, cancel"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Show spinner
                            Swal.fire({
                                title: 'Sending...',
                                text: 'Please wait while we send the email.',
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            });

                            // Send email request
                            fetch('/send-notice-assessment-email', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector(
                                            'meta[name="csrf-token"]').getAttribute(
                                            'content')
                                    },
                                    body: JSON.stringify({
                                        employee_id: employeeID,
                                        name: employeeName,
                                        branch: branch,
                                        email: branchEmail
                                    })
                                })
                                .then(response => response.json())
                                .then(data => {
                                    Swal.close(); // Hide spinner
                                    Swal.fire("Success!", data.message, "success");
                                })
                                .catch(error => {
                                    Swal.close(); // Hide spinner on error
                                    console.error("Error sending email:", error);
                                    Swal.fire("Error!", "Failed to send the email.",
                                        "error");
                                });
                        }
                    });
                });
            });
        });

        $(document).on('click', '.birthday-email-btn', function() {
            let email = $(this).data('email');
            let name = $(this).data('name');

            Swal.fire({
                title: 'Sending Email...',
                text: 'Please wait while we send the birthday email.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            $.ajax({
                url: "{{ route('send.birthday.email') }}",
                type: "POST",
                data: {
                    email: email,
                    name: name,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    Swal.fire({
                        title: 'Email Sent!',
                        text: response.message,
                        icon: 'success'
                    });
                },
                error: function() {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Something went wrong, please try again.',
                        icon: 'error'
                    });
                }
            });
        });

        $(document).on('click', '.anniversary-email-btn', function() {
            let email = $(this).data('email');
            let name = $(this).data('name');

            Swal.fire({
                title: 'Sending Email...',
                text: 'Please wait while we send the anniversary email.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            $.ajax({
                url: "{{ route('send.anniversary.email') }}",
                type: "POST",
                data: {
                    email: email,
                    name: name,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    Swal.fire('Email Sent!', response.message, 'success');
                },
                error: function(xhr, status, error) {
                    Swal.fire('Error!', 'Something went wrong: ' + error, 'error');
                    console.error("AJAX Error:", xhr.responseText);
                }
            });
        });
    </script>

    <style>
        .birthday-card {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 15px;
            display: flex;
            align-items: center;
            gap: 15px;
            border: 1px solid #ddd;
            transition: all 0.3s ease-in-out;
        }

        .birthday-card:hover {
            background: #f1f1f1;
            transform: translateY(-2px);
        }

        .birthday-avatar img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            border: 2px solid var(--third-color);
        }

        .highlight {
            background: #ffebcc;
            border-left: 5px solid #ffa500;
        }

        .send-birthday-email {
            background: var(--third-color);
            color: #fff;
            border: none;
            padding: 5px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: 0.3s;
        }

        .send-birthday-email:hover {
            background: #d9534f;
        }

        .bar-chart-container {
            width: 100% !important;
            height: 100% !important;
            max-height: 400px !important;
            /* Adjust height */
        }

        #jobBarChart {
            width: 100% !important;
            height: 100% !important;
        }

        .donut-chart {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .donut-center-text {
            position: absolute;
            font-size: 20px;
            font-weight: 300;
            text-align: center;
            color: var(--primary-color);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .vacancies-list {
            margin-top: 20px;
            text-align: center;
            padding: 10px;
            font-size: 14px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            width: 100%;
            flex-wrap: wrap;
        }

        .vacancy-item {
            font-size: 18px;
            display: flex;
            flex-direction: column;
            gap: 5px;
            margin-bottom: 5px;
            font-weight: bold;
            color: var(--primary-color);
        }

        .vacancy-item strong {
            font-weight: 400 !important;
            font-size: 14px !important;
        }

        .view-all-btn {
            justify-content: center;
            align-items: center;
            display: flex;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #f5f5f5;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            color: var(--primary-color);
            cursor: pointer;
            width: 80%;
            transition: 0.3s;
        }

        .view-all-btn:hover {
            background-color: #eaeaea;
        }

        .table-container {
            width: 100%;
            overflow-x: auto;
            background: white;
            padding: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            /* Subtle shadow for modern look */
        }

        .probation-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 14px;
            text-align: left;
        }

        .probation-table thead {
            background: white;
            font-weight: bold;
        }

        .probation-table th,
        .probation-table td {
            padding: 12px 15px;
        }

        .probation-table tr {
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            /* Very light separation */
        }

        .probation-table tr:last-child {
            border-bottom: none;
        }

        .employee-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .employee-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .send-email-btn-period {
            background: var(--third-color, #007bff);
            /* Use theme color */
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 12px;
            transition: 0.3s;
        }

        .send-email-btn-period:hover {
            filter: brightness(0.9)
        }

        /* Smooth hover effect */
        .probation-table tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.02);
        }

        th,
        td {
            border: none !important;
        }


        .second-card-header h2 {
            font-size: 18px;
            font-weight: 600;
            color: #333;
        }

        .second-card-header small {
            color: var(--text-light-color);
        }

        .anniversary-container {
            display: flex;
            flex-direction: column;
            gap: 15px;
            width: 100%;
            margin-top: 15px;
        }

        .anniversary-row {
            display: flex;
            align-items: center;
            border-bottom: 1px solid var(--light-color);
            padding: 12px;
            transition: 0.3s ease-in-out;
        }

        .anniversary-avatar img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #ddd;
        }

        .anniversary-info {
            flex: 1;
            margin-left: 15px;
        }

        .anniversary-info h3 {
            font-size: 16px;
            font-weight: 500;
            color: var(--primary-color);
        }

        .anniversary-date-text {
            font-size: 13px;
            color: var(--text-light-color);
        }

        .anniversary-email-btn {
            background: var(--third-color, #007bff);
            /* ✅ Uses theme color */
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            cursor: pointer;
            transition: 0.3s;
        }

        .anniversary-email-btn:hover {
            filter: brightness(0.9)
        }

        .no-anniversaries-message {
            text-align: center;
            font-size: 14px;
            color: #777;
            margin-top: 20px;
        }


        .second-card-header small {
            color: #777;
            font-size: 14px;
        }

        .birthday-container {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-top: 15px;
            width: 100%;
        }

        .birthday-row {
            display: flex;
            align-items: center;
            background: #f9f9f9;
            border-radius: 10px;
            padding: 12px;
            transition: 0.3s ease-in-out;
        }

        .birthday-row:hover {
            background: #f3f3f3;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .birthday-avatar img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #ddd;
        }

        .birthday-info {
            flex: 1;
            margin-left: 15px;
        }

        .birthday-info h3 {
            font-size: 16px;
            font-weight: 500;
            color: #333;
        }

        .birthday-branch {
            font-size: 14px;
            color: #777;
        }

        .birthday-date {
            font-size: 13px;
            color: #888;
        }

        .birthday-email-btn {
            background: var(--third-color, #007bff);
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            cursor: pointer;
            transition: 0.3s;
        }

        .birthday-email-btn:hover {
            background: rgba(0, 123, 255, 0.8);
        }

        .seventh-card {
            background: #ffffff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .second-card-header h3 {
            font-size: 18px;
            font-weight: 600;
            color: #333;
        }

        .second-card-header small {
            color: #777;
            font-size: 14px;
        }

        .performance-container {
            width: 100%;
            overflow-x: auto;
        }

        .performance-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 14px;
            text-align: left;
        }

        .performance-table th,
        .performance-table td {
            padding: 12px;
        }

        .performance-table th {
            background: var(--third-color, #007bff);
            color: white;
            font-weight: bold;
        }

        .performance-table tr {
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .performance-table tr:last-child {
            border-bottom: none;
        }

        .performance-table tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.02);
        }

        /* Progress Bar */
        .progress-bar {
            display: block;
            width: 100px;
            height: 10px;
            background: #ddd;
            border-radius: 5px;
            overflow: hidden;
            position: relative;
        }

        .progress-fill {
            display: block;
            height: 100%;
            background: var(--third-color, #007bff);
            transition: width 0.3s ease-in-out;
        }
    </style>

@endsection
