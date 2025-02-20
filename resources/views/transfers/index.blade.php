@extends('layouts.master')
@section('title', 'Transfers Management')

@section('main')
    <div class="main">
        <div class="dashboard-header">
            <h1>Transfers & Rotation Management</h1>
            @can('Create')
                <a class="instructor" href="{{ route('transfers.create') }}"><svg viewBox="-60 0 512 512"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="m64 96 264 160L64 416z" />
                    </svg> Add New Trasnfer</a>
            @endcan
        </div>

        <!-- First Row: Summary Cards -->
        <div class="summary-cards">
            <div class="card" style="--border-color: #FF5733;">
                <h3>Total Transfers</h3>
                <h2 style="font-size: 40px">{{ $totalTransfers }}</h2>
            </div>

            <div class="card" style="--border-color: #0d8d24;">
                <h3>Most Transfer Branch</h3>
                <ul>
                    <h2>{{ $mostEffectedBranchData['branch_name'] }}</h2>
                    <li>Total Transfers: {{ $mostEffectedBranchData['total'] }}</li>
                </ul>
            </div>

            <div class="card" style="--border-color: #3357FF;">
                <h3>Top Transferred Roles</h3>
                <ul
                    style="display: flex;flex-direction: column;gap: 5px;justify-content: center;font-size: 14px; align-items: start;">
                    @foreach ($mostTransferredRoles as $role)
                        <p style="color:var(--text-light-color)">{{ $role->employee->job }}: {{ $role->total }}
                            transfers</p>
                    @endforeach
                </ul>
            </div>
            <div class="card" style="--border-color: #9c0b89;">
                <h3>Top Transferred Roles</h3>
                <ul
                    style="display: flex;flex-direction: column;gap: 5px;justify-content: center;font-size: 14px; align-items: start;">
                    @foreach ($mostTransferredRoles as $role)
                        <p style="color:var(--text-light-color)">{{ $role->employee->job }}: {{ $role->total }}
                            transfers</p>
                    @endforeach
                </ul>
            </div>

            <div class="card" style="--border-color: #ffa033;">
                <h3>Top Transferred Roles</h3>
                <ul
                    style="display: flex;flex-direction: column;gap: 5px;justify-content: center;font-size: 14px; align-items: start;">
                    @foreach ($mostTransferredRoles as $role)
                        <p style="color:var(--text-light-color)">{{ $role->employee->job }}: {{ $role->total }}
                            transfers</p>
                    @endforeach
                </ul>
            </div>

            <div class="card" style="--border-color: #33c5ff;">
                <h3>Top Transferred Roles</h3>
                <ul
                    style="display: flex;flex-direction: column;gap: 5px;justify-content: center;font-size: 14px; align-items: start;">
                    @foreach ($mostTransferredRoles as $role)
                        <p style="color:var(--text-light-color)">{{ $role->employee->job }}: {{ $role->total }}
                            transfers</p>
                    @endforeach
                </ul>
            </div>
        </div>

        <div>
            <!-- Transfers Table -->
            <div class="table-container">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <h2 style="color: var(--primary-color); font-weight: 400;">All Transfers</h2>
                    <div style="display: flex; gap: 5px;justify-content: end; align-items: center;"> <label
                            for="records-per-page" style="margin-right: 8px;">Records per
                            page:</label>
                        <select id="records-per-page" style="padding: 5px; border: 1px solid #ccc; border-radius: 4px;">
                            <option value="5">5</option>
                            <option value="10" selected>10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                </div>
            </div>
            <div id="transfers-table"></div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const transferData = [
            @foreach ($transfers as $transfer)
                [
                    `<div style="display: flex; align-items: center; gap:10px;">
                <img src="{{ asset('storage/' . $transfer->employee->image_path ?? 'images/default.jpg') }}" 
                     alt="Employee Image" 
                     style="width: 40px; height: 40px; border-radius: 50%; margin-right: 10px;border:3px solid var(--text-light-color);">
                <span>{{ $transfer->employee->name ?? 'N/A' }}</span>
            </div>`, // Employee name with image
                    "{{ $transfer->oldBranch->branch_name ?? 'N/A' }}", // Old branch name
                    "{{ $transfer->newBranch->branch_name ?? 'N/A' }}", // New branch name
                    "{{ $transfer->employee->job ?? 'N/A' }}", // Job title
                    "{{ $transfer->type ?? 'N/A' }}", // Type
                    "{{ $transfer->rotation_duration ? \Carbon\Carbon::parse($transfer->rotation_duration)->format('d-m-Y') : 'N/A' }}",
                    "{{ $transfer->transfer_start_date ? \Carbon\Carbon::parse($transfer->transfer_start_date)->format('d-m-Y') : 'N/A' }}",
                    "{{ $transfer->created_by_name ?? 'N/A' }}", // Created by
                    `<button onclick="downloadPDF({{ $transfer->id }})" class="btn btn-primary">Download PDF</button>` +
                    `@can('Delete')
                <button data-id="{{ $transfer->id }}" style="margin-left:10px;" class="btn btn-danger cancel-transfer">Cancel</button>
                @if ($transfer->type === 'Rotation')
                    <button data-id="{{ $transfer->id }}" style="margin-left:10px;" class="btn btn-warning change-action-type">Make Transfer</button>
                @endif
            @endcan`
                ],
            @endforeach
        ];

        // Initial pagination limit
        let paginationLimit = 10;

        const grid = new gridjs.Grid({
            columns: [{
                    name: 'Employee',
                    formatter: (cell) => gridjs.html(cell),
                },
                'From Branch',
                'To Branch',
                'Job',
                'Type',
                'Rotation Duration',
                'Transfer Date',
                'Created by',
                {
                    name: 'Actions',
                    formatter: (cell) => gridjs.html(cell), // Render HTML for buttons
                },
            ],
            data: transferData,
            search: true,
            pagination: {
                limit: paginationLimit,
            },
            sort: true,
            className: {
                table: 'gridjs-table',
                th: 'gridjs-th',
                td: 'gridjs-td',
            },
            style: {
                table: {
                    'font-size': '14px',
                },
            },
        }).render(document.getElementById('transfers-table'));

        // Event listener for the records-per-page dropdown
        const recordsPerPageDropdown = document.getElementById('records-per-page');
        recordsPerPageDropdown.addEventListener('change', (event) => {
            paginationLimit = parseInt(event.target.value);

            // Re-render the Grid.js table with the new pagination limit
            grid.updateConfig({
                pagination: {
                    limit: paginationLimit,
                },
            }).forceRender();
        });
    });


    // Placeholder for Download PDF action
    function downloadPDF(transferId) {
        window.location.href = `/transfers/${transferId}/pdf`;
    }

    //Cancel The Transfer
    document.addEventListener('click', (event) => {
        if (event.target.classList.contains('cancel-transfer')) {
            const transferId = event.target.dataset.id;

            Swal.fire({
                title: 'Are you sure?',
                text: 'This will cancel the transfer and roll back changes!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, cancel it!',
                cancelButtonText: 'No, keep it',
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/transfers/${transferId}/cancel`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                        })
                        .then((response) => response.json())
                        .then((data) => {
                            if (data.success) {
                                Swal.fire(
                                    'Cancelled!',
                                    data.message,
                                    'success'
                                ).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire('Error!', data.message, 'error');
                            }
                        })
                        .catch((error) => {
                            Swal.fire(
                                'Error!',
                                'An unexpected error occurred. Please try again later.',
                                'error'
                            );
                            console.error('Error:', error);
                        });
                }
            });
        }
    });

    // Handle the 'Change to Transfer' button click
    document.addEventListener('click', (event) => {
        if (event.target.classList.contains('change-action-type')) {
            const transferId = event.target.dataset.id;

            Swal.fire({
                title: 'Are you sure?',
                text: 'This will change the action type from Rotation to Transfer!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, change it!',
                cancelButtonText: 'No, keep it',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Call the function to change the action type to Transfer
                    fetch(`/transfers/${transferId}/change-action-type`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                        })
                        .then((response) => response.json())
                        .then((data) => {
                            if (data.success) {
                                Swal.fire(
                                    'Changed!',
                                    data.message,
                                    'success'
                                ).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire('Error!', data.message, 'error');
                            }
                        })
                        .catch((error) => {
                            Swal.fire(
                                'Error!',
                                'An unexpected error occurred. Please try again later.',
                                'error'
                            );
                            console.error('Error:', error);
                        });
                }
            });
        }
    });
</script>


<style>
    .table-container {
        flex-direction: column;
        padding: 0 !important;

        height: 40px !important;
    }

    body {
        color: var(--primary-color);
    }

    .summary-cards {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-bottom: 20px;
    }

    .card {
        display: flex;
        flex-direction: column;
        padding: 20px;
        gap: 20px;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 8px;
        text-align: center;
        width: 100%;
        max-width: 250px;
        height: 150px;
        position: relative;
        border-top: 5px solid var(--border-color, black);
    }



    .card h2 {
        font-size: 24px;
    }

    .card li {
        margin-top: 10px;
        bottom: 2;
        position: absolute;
        color: var(--text-light-color);
        left: 50%;
        transform: translatex(-50%);
        width: 100%;
    }

    .analytics {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
    }

    .chart-card {
        flex: 1;
        padding: 20px;
        background-color: #f8f9fa;
        border: 1px solid #ddd;
        border-radius: 8px;
        text-align: center;
    }

    .table-container {
        margin-top: 20px;
    }

    h3 {
        font-size: 16px;
        text-align: start;
    }

    td.gridjs-td {
        border: none !important;
        border-bottom: 1px solid #ddd !important;
        font-size: 16px;
    }

    input.gridjs-input {
        width: 100%;
    }

    .btn {
        padding: 5px 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.3s;
        background-color: var(--primary-color);
        font-weight: bold;
        color: white;
    }

    .btn:hover {
        transform: scale(1.05);
    }
</style>
