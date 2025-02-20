@extends('layouts.master')
@section('title', 'Roles And Permissions')

@section('main')

    <div class="main">
        <div class="user-controller">
            <h1 class="user-title">Roles and Permissions</h1>
            <a href="{{ url('roles/create') }}">Add New Role</a>
        </div>

        <div class="custom-roles-table">
            <div id="roles-table"></div> <!-- This is where the table will be rendered -->

        </div>
    @endsection

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Fetch roles and render table
            async function fetchAndRender() {
                try {
                    const response = await fetch(
                        `/getroles?timestamp=${new Date().getTime()}`); // Prevent caching
                    const roles = await response.json();

                    console.log("🔍 Debug - Roles Data:", roles); // ✅ Debugging Line

                    const container = document.getElementById('roles-table');
                    if (!container) {
                        console.error('❌ Error: Container element not found');
                        return;
                    }

                    container.innerHTML = ''; // ✅ Clear old table before rendering

                    const gridData = roles.map(role => {
                        return [
                            role.name,
                            Array.isArray(role.permissions) ? role.permissions.join(', ') :
                            'No Permissions', // ✅ Fix here
                            gridjs.html(
                                `<div style="display: flex; justify-content: center; gap: 5px;">
                        <a href="roles/${role.id}/edit" class="edit-btn" style="background-color: var(--primary-color); color: white; padding: 5px 10px; border-radius: 5px; text-decoration: none;">Edit</a>
                        <button class="delete-btn" data-id="${role.id}" style="background-color: red; color: white; padding: 5px 10px; border-radius: 5px; border: none; cursor: pointer;">Delete</button>
                    </div>`
                            ),
                        ];
                    });

                    new gridjs.Grid({
                        columns: ['Role Name', 'Permissions', 'Actions'],
                        data: gridData,
                        pagination: true,
                        search: true,
                        sort: true,
                    }).render(container);

                } catch (error) {
                    console.error('❌ Error fetching roles:', error);
                }
            }

            // Function to attach delete listeners using event delegation
            function attachDeleteListeners() {
                // Use event delegation to handle click event for delete buttons
                document.getElementById('roles-table').addEventListener('click', async (event) => {
                    if (event.target && event.target.classList.contains('delete-btn')) {
                        const roleId = event.target.dataset.id;

                        Swal.fire({
                            title: 'Are you sure?',
                            text: "This action cannot be undone!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete it!',
                        }).then(async result => {
                            if (result.isConfirmed) {
                                try {
                                    const response = await fetch(`/roles/${roleId}`, {
                                        method: 'DELETE',
                                        headers: {
                                            'X-CSRF-TOKEN': document.querySelector(
                                                    'meta[name="csrf-token"]')
                                                .content,
                                        },
                                    });

                                    if (response.ok) {
                                        Swal.fire('Deleted!', 'The role has been deleted.',
                                            'success');
                                        fetchAndRender(); // Refresh the table
                                    } else {
                                        Swal.fire('Error!', 'Failed to delete the role.',
                                            'error');
                                    }
                                } catch (error) {
                                    Swal.fire('Error!', 'An unexpected error occurred.',
                                        'error');
                                }
                            }
                        });
                    }
                });
            }

            // Initial table rendering
            fetchAndRender();
        });
    </script>


    <style>
        .custom-roles-table {
            width: 100%;
            margin-top: 20px;
        }

        .custom-badge {
            font-size: 12px;
            padding: 5px 10px;
            background-color: var(--third-color);
            color: white;
            border-radius: 5px;
            text-transform: capitalize;
            margin-right: 5px;
        }

        .custom-btn-edit,
        .custom-btn-danger {
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .custom-btn-edit {
            background-color: var(--primary-color);
            color: white;
        }

        .custom-btn-danger {
            background-color: red;
            color: white;
        }

        .custom-btn-edit:hover,
        .custom-btn-danger:hover {
            opacity: 0.8;
        }
    </style>
