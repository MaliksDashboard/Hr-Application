@extends('layouts.master')
@section('title', 'Evaluate Employees')
@section('custom_title', 'Evaluate Employees')

@php
    $isDeptManager = $userRole === 'Department Manager';
    $isSMC = $userRole === 'SMC';
@endphp

@section('main')
    <div class="main">
        {{-- <div class="top" style="display: flex; width: 100%; justify-content: space-between; align-items: center;">
            <h2 class="evaluation-title">Evaluation for {{ date('F', mktime(0, 0, 0, $month, 1)) }} {{ $currentYear }}</h2>
            <a href="{{ route('evaluation.index') }}" class="add-btn prev-btn">Back</a>
        </div> --}}

        <div style=" display: flex; justify-content: space-between;width: 100%; align-items: center">
            <input type="text" id="employee-search" placeholder="Search employee..."
                style="padding: 8px 12px; width: 100%; max-width: 400px; border-radius: 6px; border: 1px solid #ccc;">
            <div style="display: flex;justify-content: center; gap: 10px;" class="evaluation-nav">

                @if ($userRole === 'Branch Manager' || $userRole === 'Department Manager')
                    <button onclick="showSection('branch')" class="nav-btn active">My Team</button>
                @endif

                @if ($userRole === 'Department Manager')
                    <button onclick="showSection('myteam')" class="nav-btn">Branch Employees</button>
                @endif

                @if ($userRole === 'Branch Manager' || $userRole === 'Department Manager')
                    <button onclick="showSection('department')" class="nav-btn">Department Team</button>
                @endif

                @if ($userRole === 'SMC')
                    <button onclick="showSection('smc-dept-managers')" class="nav-btn active">Department Managers</button>
                    <button onclick="showSection('smc-dept-supervisors')" class="nav-btn">Department Supervisors</button>
                    <button onclick="showSection('smc-branch-managers')" class="nav-btn">Branch Managers</button>
                    <button onclick="showSection('smc-branch-supervisors')" class="nav-btn">Branch Supervisors</button>
                @endif
            </div>

        </div>



        @if (!$isSMC)
            <!--  My Team Section -->
            <div id="branch-section">
                <h3 class="section-title">Evaluations by Branch Manager</h3>
                <div class="employee-list">
                    @foreach ($byManager as $employee)
                        @include('evaluation.partials.employee_card', [
                            'employee' => $employee,
                            'month' => $month,
                            'currentMonth' => $currentMonth,
                            'currentDay' => $currentDay,
                        ])
                    @endforeach
                </div>

                @if ($byEmployee->count() > 0)
                    <h3 class="section-title" style="margin-top: 40px;"> Evaluations by Employee</h3>
                    <div class="employee-list">
                        @foreach ($byEmployee as $employee)
                            @include('evaluation.partials.employee_card', [
                                'employee' => $employee,
                                'month' => $month,
                                'currentMonth' => $currentMonth,
                                'currentDay' => $currentDay,
                            ])
                        @endforeach
                    </div>
                @else
                    <div></div>
                @endif

            </div>
        @endif

        <!-- Branch Employees (Department Manager Only) -->
        @if ($isDeptManager)
            <div id="myteam-section" style="display: none;">
                <h3 class="section-title">My Department Branch Employees</h3>
                <div class="employee-list">
                    @foreach ($deptBranchEmployees as $employee)
                        @include('evaluation.partials.employee_card', [
                            'employee' => $employee,
                            'month' => $month,
                            'currentMonth' => $currentMonth,
                            'currentDay' => $currentDay,
                        ])
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Department Section -->
        <div id="department-section" style="display: none;">
            <h3 class="section-title">Department Managers</h3>
            <div class="employee-list">
                @foreach ($departmentManagers as $employee)
                    @include('evaluation.partials.employee_card', [
                        'employee' => $employee,
                        'month' => $month,
                        'currentMonth' => $currentMonth,
                        'currentDay' => $currentDay,
                    ])
                @endforeach
            </div>

            <h3 class="section-title" style="margin-top: 30px;">
                Department Supervisors
            </h3>
            <div class="employee-list">
                @foreach ($departmentSupervisors as $employee)
                    @include('evaluation.partials.employee_card', [
                        'employee' => $employee,
                        'month' => $month,
                        'currentMonth' => $currentMonth,
                        'currentDay' => $currentDay,
                    ])
                @endforeach
            </div>
        </div>

        <!-- SMC Sections -->
        @if ($userRole === 'SMC')
            <!-- Department Managers -->
            <div id="smc-dept-managers">
                <h3 class="section-title">Department Managers</h3>
                <div class="employee-list">
                    @foreach ($smc_departmentManagers as $employee)
                        @include(
                            'evaluation.partials.employee_card',
                            compact('employee', 'month', 'currentMonth', 'currentDay'))
                    @endforeach
                </div>
            </div>

            <!-- Department Supervisors & Visitors -->
            <div id="smc-dept-supervisors" style="display:none;">
                <h3 class="section-title">Department Supervisors & Visitors</h3>
                <div class="employee-list">
                    @foreach ($smc_departmentSupervisors as $employee)
                        @include(
                            'evaluation.partials.employee_card',
                            compact('employee', 'month', 'currentMonth', 'currentDay'))
                    @endforeach
                </div>
            </div>

            <!-- Branch Managers -->
            <div id="smc-branch-managers" style="display:none;">
                <h3 class="section-title">Branch Managers</h3>
                <div class="employee-list">
                    @foreach ($smc_branchManagers as $employee)
                        @include(
                            'evaluation.partials.employee_card',
                            compact('employee', 'month', 'currentMonth', 'currentDay'))
                    @endforeach
                </div>
            </div>

            <!-- Branch Supervisors -->
            <div id="smc-branch-supervisors" style="display:none;">
                <h3 class="section-title">Branch Supervisors</h3>
                <div class="employee-list">
                    @foreach ($smc_branchSupervisors as $employee)
                        @include(
                            'evaluation.partials.employee_card',
                            compact('employee', 'month', 'currentMonth', 'currentDay'))
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <script>
        function showSection(section) {
            document.querySelectorAll('.nav-btn').forEach(btn => btn.classList.remove('active'));

            const sections = [
                'branch-section',
                'myteam-section',
                'department-section',
                'smc-dept-managers',
                'smc-dept-supervisors',
                'smc-branch-managers',
                'smc-branch-supervisors'
            ];

            sections.forEach(id => {
                const el = document.getElementById(id);
                if (el) el.style.display = 'none';
            });

            if (section === 'branch') {
                document.getElementById('branch-section').style.display = 'block';
                document.querySelector('.nav-btn:nth-child(1)').classList.add('active');
            } else if (section === 'myteam') {
                const myTeam = document.getElementById('myteam-section');
                if (myTeam) myTeam.style.display = 'block';
                document.querySelector('.nav-btn:nth-child(2)').classList.add('active');
            } else if (section === 'department') {
                document.getElementById('department-section').style.display = 'block';
                const btns = document.querySelectorAll('.nav-btn');
                btns[btns.length - 1].classList.add('active');
            } else {
                // SMC sections
                document.getElementById(section).style.display = 'block';
                document.querySelector(`button[onclick="showSection('${section}')"]`).classList.add('active');
            }
        }


        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('employee-search');
            const employeeCards = document.querySelectorAll('.employee-card');
            searchInput.addEventListener('keyup', function() {
                const query = this.value.toLowerCase();
                employeeCards.forEach(card => {
                    const name = card.getAttribute('data-name');
                    card.style.display = name.includes(query) ? 'flex' : 'none';
                });
            });
        });
    </script>
@endsection

<style>
    /* Main Container */
    .evaluation-container {
        max-width: 800px;
        margin: 40px auto;
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
    }

    /* Title */
    .evaluation-title {
        text-align: center;
        font-size: 22px;
        font-weight: bold;
        margin-bottom: 20px;
        color: #2c3e50;
    }

    /* Employee List */
    .employee-list {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }


    .employee-card:first-child {
        margin-top: 20px;
    }

    .employee-card {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #fff;
        padding: 16px 20px;
        border-radius: 10px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        border-left: 4px solid var(--third-color);
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .employee-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 14px rgba(0, 0, 0, 0.08);
    }

    .employee-info {
        display: flex;
        gap: 10px;
        justify-content: center;
        align-items: center;
    }

    .employee-info h3 {
        margin: 0;
        font-size: 18px;
        font-weight: 600;
        color: #222;
        display: flex;
        align-items: center;
        gap: 8px;
    }


    .employee-job {
        font-size: 14px;
        color: #666;
        margin: 0;
    }

    /* Buttons */
    .evaluation-btn {
        padding: 8px 14px;
        border-radius: 6px;
        font-size: 14px;
        font-weight: bold;
        text-transform: uppercase;
        text-decoration: none;
        transition: 0.3s ease;
    }

    .evaluate-btn {
        background: var(--third-color);
        color: white;
        padding: 8px 18px;
        font-size: 13px;
        border-radius: 6px;
        font-weight: 600;
        transition: 0.3s ease;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);
    }


    .evaluate-btn:hover {
        filter: brightness(0.9);
    }

    /* No Employee */
    .no-employees {
        text-align: center;
        font-size: 16px;
        color: #999;
    }

    /* Navigation Buttons */
    .evaluation-nav {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin: 10px 0;
    }

    .nav-btn {
        padding: 10px 20px;
        border-radius: 6px;
        background-color: rgba(255, 255, 255, 0.3);
        color: var(--second-color);
        font-weight: 600;
        border: 1px solid #ccc;
        cursor: pointer;
        transition: .3s ease-in-out;
    }

    .nav-btn:hover {
        filter: brightness(.9);
    }

    .nav-btn.active {
        background-color: var(--third-color);
        color: white;
        border-color: var(--third-color);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .section-title {
        font-size: 15px;
        font-weight: bold;
        color: var(--second-color);
        border-radius: 8px;
    }
</style>
