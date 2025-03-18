@extends('layouts.master')
@section('title', 'All Departments')
@section('custom_title', 'Departments')

@section('main')

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

    <div style="gap:0px" class="main">
        <div class="table-controls" style="display: flex; justify-content: space-between; align-items: center;">
            <div class="left" style="display: flex; gap: 20px;">
                <label class="rowPerPage" for="rowPerPage">
                    Show
                    <select id="rowsPerPage">
                        <option value="10">10</option>
                        <option selected value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select> entries
                </label>
            </div>

            <div class="right" style="display: flex; gap: 15px; align-items: center; width: 100%; justify-content: end">


                @can('Create')
                    <a style="" class="add-btn add-dept" href="{{ url('/departments/create') }}">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M18 10h-4V6a2 2 0 0 0-4 0l.071 4H6a2 2 0 0 0 0 4l4.071-.071L10 18a2 2 0 0 0 4 0v-4.071L18 14a2 2 0 0 0 0-4" />
                        </svg>
                        Add Department
                    </a>
                @endcan

            </div>
        </div>

        <div id="DepartmentGrid" class="gridjs-container"></div>

    </div>

@endsection


<script>
    document.addEventListener('DOMContentLoaded', () => {
        let rowsPerPage = 25;

        async function fetchDepartments() {
            try {
                const response = await fetch('/getDeptData');
                const departments = await response.json();
                return departments;
            } catch (error) {
                console.error('Error fetching departments:', error);
                return [];
            }
        }

        function actionsColumn(departmentId) {
            return `
        <div class="table-svg" style="display:flex; justify-content:center; align-items:center; gap:10px;">
            ${canDelete ? `
            <form action="/departments/${departmentId}" method="POST" class="delete-form" style="display:inline;">
                <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                <input type="hidden" name="_method" value="DELETE">
                <button type="button" class="delete-btn" data-id="${departmentId}">
                    <svg class="delete-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2h4a1 1 0 1 1 0 2h-1.069l-.867 12.142A2 2 0 0 1 17.069 22H6.93a2 2 0 0 1-1.995-1.858L4.07 8H3a1 1 0 0 1 0-2h4zm2 2h6V4H9zM6.074 8l.857 12H17.07l.857-12zM10 10a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1m4 0a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1" fill="#0D0D0D" />
                    </svg>
                </button>
            </form>` : ''}
            
            ${canEdit ? `
            <a href="/departments/${departmentId}/edit" class="edit-btn" data-id="${departmentId}">
               <svg class="edit-icon" style="fill:var(--primary-color);" viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg">
                    <path class="clr-i-solid clr-i-solid-path-1" d="m4.22 23.2-1.9 8.2a2.06 2.06 0 0 0 2 2.5 2 2 0 0 0 .43 0L13 32l15.84-15.78L20 7.4Z" />
                    <path class="clr-i-solid clr-i-solid-path-2" d="m33.82 8.32-5.9-5.9a2.07 2.07 0 0 0-2.92 0L21.72 5.7l8.83 8.83 3.28-3.28a2.07 2.07 0 0 0-.01-2.93" />
                    <path fill="none" d="M0 0h36v36H0z" />
                </svg>
            </a>` : ''}
        </div>
    `;
        }



        function headOfDeptInfo(deptImage, deptName) {

            return `
                <div class=dept-manager-info>
                    <img src="storage/${deptImage}"/>
                    <p>${deptName}</p>
                </div>  
            `;
        }

        let canDelete = @json(auth()->user()->can('Delete'));
        let canEdit = @json(auth()->user()->can('Edit'));

        fetchDepartments().then(departments => {
            const grid = new gridjs.Grid({
                columns: [{
                        name: 'Select',
                        formatter: (_, row) => gridjs.html(`
                        <input type="checkbox" class="select-checkbox" data-id="${row.cells[1].data}">
                    `),
                        width: '100px',
                    },
                    'Department Name',
                    {
                        name: 'Manager',
                        formatter: (_, row) => gridjs.html(headOfDeptInfo(row.cells[3].data,
                            row.cells[2].data)),
                        width: '300px',
                    },
                    {
                        name: 'Actions',
                        formatter: (_, row) => gridjs.html(actionsColumn(row.cells[0]
                            .data)),
                        width: '150px',
                    },
                ],
                data: departments.map(department => [
                    department.id,
                    department.name,
                    department.manager_name,
                    department.manager_image
                ]),
                pagination: {
                    enabled: true,
                    limit: rowsPerPage,
                },
                search: true,
                sort: true,
                style: {
                    table: {
                        'white-space': 'nowrap',
                    },
                },
            }).render(document.getElementById('DepartmentGrid'));

            const rowsPerPageSelector = document.getElementById('rowsPerPage');
            rowsPerPageSelector.addEventListener('change', () => {
                rowsPerPage = parseInt(rowsPerPageSelector.value, 10);
                grid.updateConfig({
                    pagination: {
                        enabled: true,
                        limit: rowsPerPage,
                    },
                }).forceRender();
            });
        });

    });

    document.addEventListener('DOMContentLoaded', () => {
        document.body.addEventListener('click', function(event) {
            if (event.target.closest('.delete-btn')) {
                event.preventDefault(); // Prevent form submission

                let button = event.target.closest('.delete-btn');
                let form = button.closest('form');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "This action cannot be undone!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Submit the form after confirmation
                    }
                });
            }
        });
    });
</script>
