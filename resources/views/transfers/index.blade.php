@extends('layouts.master')
@section('title', 'Transfers Management')
@section('custom_title',
    'Transfers & Rotations
    ')


@section('main')
    <div class="main transfers">
        <div class="dashboard-header">
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
                    <h2 class="table-trans-header" style="color: var(--primary-color); font-weight: 400;">All Transfers</h2>
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
                    `<div class="btns-trans">
                    <button onclick="downloadPDF({{ $transfer->id }})" class="btn btn-primary down-btn-transfer"><svg fill="#fff" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 100 100" xml:space="preserve"><path d="M84.514 49.615H67.009a4.91 4.91 0 0 0-4.679 3.406 12.92 12.92 0 0 1-12.329 8.983 12.92 12.92 0 0 1-12.329-8.983 4.92 4.92 0 0 0-4.681-3.406H15.486a4.92 4.92 0 0 0-4.919 4.919v28.054a4.92 4.92 0 0 0 4.919 4.917h69.028a4.92 4.92 0 0 0 4.919-4.917V54.534c0-2.719-2.2-4.919-4.919-4.919"/><path d="M48.968 52.237c.247.346.651.553 1.076.553h.003c.428 0 .826-.207 1.076-.558l13.604-19.133a1.33 1.33 0 0 0 .096-1.374 1.32 1.32 0 0 0-1.177-.716h-6.399V13.821c0-.735-.593-1.326-1.323-1.326H44.078c-.732 0-1.323.591-1.323 1.326v17.188h-6.404a1.323 1.323 0 0 0-1.076 2.09z"/></svg></button>` +
                    `@can('Delete')
                <button  data-id="{{ $transfer->id }}" style="margin-left:10px;" class="btn btn-danger cancel-transfer"><svg fill="#fff" viewBox="0 0 24 24" version="1.2" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg"><path d="M12 4c-4.411 0-8 3.589-8 8s3.589 8 8 8 8-3.589 8-8-3.589-8-8-8m-5 8c0-.832.224-1.604.584-2.295l6.711 6.711A4.94 4.94 0 0 1 12 17c-2.757 0-5-2.243-5-5m9.416 2.295L9.705 7.584A4.94 4.94 0 0 1 12 7c2.757 0 5 2.243 5 5 0 .832-.224 1.604-.584 2.295"/></svg></button>
                @if ($transfer->type === 'Rotation')
                    <button data-id="{{ $transfer->id }}" style="margin-left:10px;" class="btn btn-warning change-action-type"><svg fill="#fff" viewBox="0 0 52 52" xmlns="http://www.w3.org/2000/svg"><path d="M30.87 2.42a1.37 1.37 0 0 0-2 0l-2 1.8a1.28 1.28 0 0 0 0 1.94l3.37 3.26a.89.89 0 0 1-.61 1.58H11.38a1.53 1.53 0 0 0-1.46 1.38v2.78a1.47 1.47 0 0 0 1.46 1.38h18.25a.9.9 0 0 1 .66 1.46l-3.37 3.26a1.28 1.28 0 0 0 0 1.94l2 1.94a1.37 1.37 0 0 0 2 0l10.77-10.4a1.3 1.3 0 0 0 0-1.94Zm-9.75 24.42a1.38 1.38 0 0 1 2 0l2 1.8a1.3 1.3 0 0 1 0 1.94l-3.37 3.26a.88.88 0 0 0 .66 1.53h18.2a1.54 1.54 0 0 1 1.47 1.38v2.78a1.49 1.49 0 0 1-1.47 1.39H22.37a.89.89 0 0 0-.66 1.52l3.37 3.26a1.3 1.3 0 0 1 0 1.94l-2 1.94a1.38 1.38 0 0 1-2 0l-10.72-10.4a1.28 1.28 0 0 1 0-1.94Z" fill-rule="evenodd"/></svg></button>
                @endif
            @endcan
            </div>`
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
                'Rotation End',
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
    body {
        color: var(--primary-color);
    }

    .dashboard-header {
        display: flex !important;
        justify-content: start;
    }
</style>
