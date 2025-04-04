@extends('layouts.master')
@section('title', 'Evaluation Chains')
@section('custom_title', 'Evaluation Rules Management')

@section('main')
    <div class="main">
        <div class="user-controller">
            <a class="add-btn" href="{{ route('evaluation-chains.create') }}">Add Evaluation Rule</a>
        </div>

        <div class="custom-roles-table">
            <div id="chains-table"></div> <!-- Dynamic gridjs table -->
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', () => {
        async function fetchAndRender() {
            try {
                const response = await fetch(`/evaluation-chains-data?timestamp=${new Date().getTime()}`);
                const chains = await response.json();

                const container = document.getElementById('chains-table');
                if (!container) return;

                container.innerHTML = '';

                const gridData = chains.map(chain => {
                    return [
                        chain.evaluator_role,
                        chain.target_role,
                        chain.job_name ?? '-',
                        chain.department_name ?? '-',
                        chain.priority,
                        chain.skip_if_done_by_higher ? 'Yes' : 'No',
                        gridjs.html(`
                            <div style="display: flex; justify-content: center; gap: 5px;">
                                <a href="/evaluation-chains/${chain.id}/edit" class="edit-btn">Edit</a>
                                <button class="delete-btn" data-id="${chain.id}">Delete</button>
                            </div>
                        `)
                    ];
                });

                new gridjs.Grid({
                    columns: ['Evaluator', 'Target', 'Job', 'Department', 'Priority',
                        'Skip if Higher?', 'Actions'
                    ],
                    data: gridData,
                    pagination: true,
                    search: true,
                    sort: true,
                }).render(container);
            } catch (error) {
                console.error('Error fetching evaluation chains:', error);
            }
        }

        document.addEventListener('click', async function(e) {
            if (e.target && e.target.classList.contains('delete-btn')) {
                const id = e.target.dataset.id;

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won’t be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then(async (result) => {
                    if (result.isConfirmed) {
                        const response = await fetch(`/evaluation-chains/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').content
                            }
                        });

                        if (response.ok) {
                            Swal.fire('Deleted!', 'Evaluation rule deleted.',
                                'success');
                            fetchAndRender();
                        } else {
                            Swal.fire('Error!', 'Could not delete rule.', 'error');
                        }
                    }
                });
            }
        });

        fetchAndRender();
    });
</script>

<style>
    .custom-roles-table {
        width: 100%;
        margin-top: 20px;
    }

    .edit-btn,
    .delete-btn {
        padding: 5px 10px;
        border-radius: 5px;
        color: white;
        text-decoration: none;
    }

    .edit-btn {
        background-color: var(--primary-color);
    }

    .delete-btn {
        background-color: red;
        border: none;
        cursor: pointer;
    }

    .edit-btn:hover,
    .delete-btn:hover {
        opacity: 0.85;
    }
</style>
