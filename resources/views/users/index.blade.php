@extends('layouts.master')
@section('title', 'Users')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('main')

    <div class="main">


        <div class="user-controller">
            <h1 class="user-title">Members</h1>
            <a href="{{ url('users\create') }}">Add New</a>
            <button>Export member (Excel)</button>
        </div>

        <div id="user-table"></div> <!-- All users -->
    </div>

@endsection

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Fetch users and render table
        async function fetchAndRender() {
            try {
                const response = await fetch('/getusers');
                const users = await response.json();

                const gridData = users.map(user => {
                    const formattedDate = new Date(user.created_at).toLocaleDateString(
                        'en-GB'); // Format as dd-mm-yyyy
                    return [
                        gridjs.html(
                            `<img src="storage/${user.image}" alt="${user.name}" style="width:50px;height:50px;border-radius:5px;">`
                        ),
                        user.name,
                        user.email,
                        formattedDate, // Use formatted date here
                        gridjs.html(
                            `<span style="display:inline-block; padding:5px 10px; border-radius:5px; background-color:${
                user.status === 'active' ? 'green' : 'red'
            }; color:white;">
                ${user.status === 'active' ? 'Active' : 'Inactive'}
            </span>`
                        ),
                        user.role_name,
                        gridjs.html(
                            `<div style="display: flex; justify-content: center; gap: 5px;">
                <a href="users/${user.id}/edit" class="edit-btn" style="
                    background-color: var(--primary-color);
                    color: white;
                    padding: 5px 10px;
                    border-radius: 5px;
                    text-decoration: none;">Edit</a>
                <button class="delete-btn" data-id="${user.id}" style="
                    background-color: var(--second-color);
                    color: white;
                    padding: 5px 10px;
                    border-radius: 5px;
                    border: none;
                    cursor: pointer;">Delete</button>
            </div>`
                        ),
                    ];
                });


                new gridjs.Grid({
                    columns: ['Image', 'Name', 'Email', 'Created At', 'Status', 'Role', 'Action'],
                    data: gridData,
                    pagination: true,
                    search: true,
                    sort: true,
                }).render(document.getElementById('user-table'));

                // Attach event listeners to delete buttons
                attachDeleteListeners();
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        }

        // Function to attach delete listeners
        function attachDeleteListeners() {
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', async () => {
                    const userId = button.dataset.id;

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
                                const response = await fetch(
                                    `/users/${userId}`, {
                                        method: 'DELETE',
                                        headers: {
                                            'X-CSRF-TOKEN': document
                                                .querySelector(
                                                    'meta[name="csrf-token"]'
                                                ).content,
                                        },
                                    });

                                if (response.ok) {
                                    Swal.fire('Deleted!',
                                        'The user has been deleted.',
                                        'success');
                                    fetchAndRender(); // Refresh the table
                                } else {
                                    Swal.fire('Error!',
                                        'Failed to delete the user.',
                                        'error');
                                }
                            } catch (error) {
                                Swal.fire('Error!',
                                    'An unexpected error occurred.', 'error'
                                );
                            }
                        }
                    });
                });
            });
        }

        // Initial table rendering
        fetchAndRender();
    });

    //Check the role:
    document.addEventListener('DOMContentLoaded', function() {
        checkUserRole();
    });
</script>

<style>
    .delete-btn,
    .edit-btn,
    .login-btn {
        width: 60px !important;
        text-align: center;
        transition: .3s ease-in-out;
    }

    .delete-btn:hover,
    .edit-btn:hover,
    .login-btn:hover {
        transform: scale(1.05);
    }

    .gridjs-container .gridjs-table td,
    .gridjs-container .gridjs-table th {
        border: none !important;
        font-size: 16px;
    }

    .edit-btn,
    .delete-btn {
        padding: 5px 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .edit-btn {
        background-color: blue;
        color: white;
    }

    .delete-btn {
        background-color: red;
        color: white;
    }
</style>
