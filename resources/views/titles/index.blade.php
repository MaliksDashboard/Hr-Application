@extends('layouts.master')
@section('title', 'Titles')
@section('custom_title', 'Titles Managment')

<meta name="csrf-token" content="{{ csrf_token() }}">
@can('Edit')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
@endcan

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
    <div class="main">
        <div class="container titles">
            <form id="add-title-form">
                <input type="text" id="name" placeholder="Title Name" required>
                <select id="category" required>
                    <option value="manager">Manager</option>
                    <option value="employee">Employee</option>
                </select>
                @can('Create')
                    <button class="add-titlles" type="submit">Add Title</button>
                @endcan

            </form>

            <ul id="title-list">
                @foreach ($titles as $title)
                    <li data-id="{{ $title->id }}">
                        <span>{{ $title->name }} ({{ ucfirst($title->category) }})</span>
                        <div style="display: flex; gap:5px">

                            @can('Edit')
                                <button class="edit-btn" data-id="{{ $title->id }}"><svg viewBox="0 0 24 24" version="1.2"
                                        baseProfile="tiny" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="m21.561 5.318-2.879-2.879A1.5 1.5 0 0 0 17.621 2c-.385 0-.768.146-1.061.439L13 6H4a1 1 0 0 0-1 1v13a1 1 0 0 0 1 1h13a1 1 0 0 0 1-1v-9l3.561-3.561c.293-.293.439-.677.439-1.061s-.146-.767-.439-1.06M11.5 14.672 9.328 12.5l6.293-6.293 2.172 2.172zm-2.561-1.339 1.756 1.728L9 15zM16 19H5V8h6l-3.18 3.18c-.293.293-.478.812-.629 1.289-.16.5-.191 1.056-.191 1.47V17h3.061c.414 0 1.108-.1 1.571-.29.464-.19.896-.347 1.188-.64L16 13zm2.5-11.328L16.328 5.5l1.293-1.293 2.171 2.172z" />
                                    </svg></button>
                            @endcan

                            @can('Delete')
                                <form id="delete-form-{{ $title->id }}" action="{{ route('titles.destroy', $title->id) }}"
                                    method="POST" style="display:none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <button class="delete-btn" data-id="{{ $title->id }}">
                                    <svg viewBox="-32 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M128 416q-14 0-23-9t-9-23V176H64v-48h80V96q0-14 9-23t23-9h96q14 0 23 9t9 23v32h80v48h-32v208q0 14-9 23t-23 9zm128-272v-32h-64v32zm-56 224V192h-56v176zm104 0V192h-56v176z" />
                                    </svg>
                                </button>
                            @endcan

                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

        <div id="edit-title-popup" class="popup" style="display: none;">
            <form id="edit-title-form">
                <input type="hidden" id="edit-id">
                <label for="edit-name">Title Name:</label>
                <input type="text" id="edit-name" required>
                <label style="margin-top: 10px" for="edit-category">Category:</label>
                <select id="edit-category" required>
                    <option value="manager">Manager</option>
                    <option value="employee">Employee</option>
                </select>
                <div style="display: flex; justify-content: center; align-items: center; gap:10px;"><button
                        type="submit">Save
                        Changes</button>
                    <button type="button" id="close-edit-popup">Cancel</button>
                </div>
            </form>
        </div>
        <div id="popup-overlay"></div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const titleList = document.getElementById('title-list');
        const addTitleForm = document.getElementById('add-title-form');
        const editTitlePopup = document.getElementById('edit-title-popup');
        const editTitleForm = document.getElementById('edit-title-form');
        const closeEditPopup = document.getElementById('close-edit-popup');
        const popupOverlay = document.getElementById('popup-overlay');

        // Initialize Notyf for notifications
        const notyf = new Notyf({
            duration: 4000,
            position: {
                x: 'right',
                y: 'top'
            },
        });

        // Add Title
        if (addTitleForm) {
            addTitleForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const name = document.getElementById('name').value;
                const category = document.getElementById('category').value;

                fetch('/titles', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content'),
                        },
                        body: JSON.stringify({
                            name,
                            category
                        }),
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Failed to add title');
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Add Title Response:', data); // Debugging

                        if (!data.title || !data.title.id) {
                            throw new Error('Invalid response structure: Missing title ID');
                        }

                        notyf.success(data.success || 'Title added successfully!');

                        const li = document.createElement('li');
                        li.setAttribute('data-id', data.title.id);
                        li.innerHTML = `
                    <span>${data.title.name} (${data.title.category})</span>
                    <div style="display: flex; gap: 5px;">
                        <button class="edit-btn" data-id="{{ $title->id }}"><svg
                                    viewBox="0 0 24 24" version="1.2" baseProfile="tiny"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m21.561 5.318-2.879-2.879A1.5 1.5 0 0 0 17.621 2c-.385 0-.768.146-1.061.439L13 6H4a1 1 0 0 0-1 1v13a1 1 0 0 0 1 1h13a1 1 0 0 0 1-1v-9l3.561-3.561c.293-.293.439-.677.439-1.061s-.146-.767-.439-1.06M11.5 14.672 9.328 12.5l6.293-6.293 2.172 2.172zm-2.561-1.339 1.756 1.728L9 15zM16 19H5V8h6l-3.18 3.18c-.293.293-.478.812-.629 1.289-.16.5-.191 1.056-.191 1.47V17h3.061c.414 0 1.108-.1 1.571-.29.464-.19.896-.347 1.188-.64L16 13zm2.5-11.328L16.328 5.5l1.293-1.293 2.171 2.172z" />
                                </svg></button>
                            <button class="delete-btn" data-id="{{ $title->id }}"><svg viewBox="-32 0 512 512"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M128 416q-14 0-23-9t-9-23V176H64v-48h80V96q0-14 9-23t23-9h96q14 0 23 9t9 23v32h80v48h-32v208q0 14-9 23t-23 9zm128-272v-32h-64v32zm-56 224V192h-56v176zm104 0V192h-56v176z" />
                                </svg></button>                      </div>
                     `;
                        titleList.appendChild(li);
                        addTitleForm.reset();
                    })
                    .catch(error => {
                        console.error('Error adding title:', error);
                        notyf.error(error.message || 'Failed to add title.');
                    });
            });

        }

        // Edit Title
        titleList.addEventListener('click', function(e) {
            if (e.target.closest('.edit-btn')) {
                const id = e.target.closest('.edit-btn').getAttribute('data-id');

                fetch(`/titles/${id}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Failed to fetch title');
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Edit Title Response:', data); // Debugging

                        if (!data.title || !data.title.id) {
                            throw new Error('Invalid response structure: Missing title ID');
                        }

                        document.getElementById('edit-id').value = data.title.id;
                        document.getElementById('edit-name').value = data.title.name;
                        document.getElementById('edit-category').value = data.title.category;

                        editTitlePopup.style.display = 'block';
                        popupOverlay.style.display = 'block';
                    })
                    .catch(error => {
                        console.error('Error fetching title:', error);
                        notyf.error('Failed to fetch title.');
                    });
            }
        });



        // Close Edit Popup
        closeEditPopup.addEventListener('click', () => {
            editTitlePopup.style.display = 'none';
            popupOverlay.style.display = 'none';
        });

        popupOverlay.addEventListener('click', () => {
            editTitlePopup.style.display = 'none';
            popupOverlay.style.display = 'none';
        });

        // Submit Edit Form
        editTitleForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const id = document.getElementById('edit-id').value;
            const name = document.getElementById('edit-name').value;
            const category = document.getElementById('edit-category').value;

            fetch(`/titles/${id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                            .getAttribute('content'),
                    },
                    body: JSON.stringify({
                        name,
                        category
                    }),
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Failed to update title');
                    }
                    return response.json();
                })
                .then(data => {
                    notyf.success(data.success || 'Title updated successfully!');

                    // Update the title in the list dynamically
                    const li = document.querySelector(`li[data-id="${id}"]`);
                    if (li) {
                        li.querySelector('span').textContent = `${name} (${category})`;
                    }

                    editTitlePopup.style.display = 'none';
                    popupOverlay.style.display = 'none';
                })
                .catch(error => {
                    console.error('Error updating title:', error);
                    notyf.error('Failed to update title.');
                });
        });

        // Sortable for Rank Updates
        new Sortable(titleList, {
            animation: 150,
            onEnd: function() {
                const order = Array.from(titleList.children).map((item, index) => ({
                    id: item.dataset.id,
                    rank: index,
                }));

                fetch('/titles/update-ranks', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content'),
                        },
                        body: JSON.stringify({
                            titles: order.map(o => o.id)
                        }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        notyf.success(data.success || 'Ranks updated successfully!');
                    })
                    .catch(error => {
                        console.error('Error updating ranks:', error);
                        notyf.error('Failed to update ranks.');
                    });
            },
        });
    });


    //sweetalret2
    document.addEventListener('DOMContentLoaded', () => {
        document.body.addEventListener('click', (e) => {
            if (e.target.closest('.delete-btn')) {
                e.preventDefault();

                const button = e.target.closest('.delete-btn');
                const id = button.getAttribute('data-id');
                const form = document.getElementById(`delete-form-${id}`);

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'This action cannot be undone!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Send the delete request via Fetch API
                        fetch(form.action, {
                                method: 'POST', // Use POST since we're simulating a form submission
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]').getAttribute(
                                        'content'),
                                },
                                body: JSON.stringify({
                                    _method: 'DELETE', // Explicitly set DELETE method
                                }),
                            })
                            .then((response) => {
                                console.log('Fetch Response:',
                                    response); // Debugging response
                                if (!response.ok) {
                                    throw new Error(
                                        'Failed to delete the record. Status: ' +
                                        response.status);
                                }
                                return response.json();
                            })
                            .then((data) => {
                                Swal.fire(
                                    'Deleted!',
                                    data.success || 'The record has been deleted.',
                                    'success'
                                );

                                const listItem = document.querySelector(
                                    `li[data-id="${id}"]`);
                                if (listItem) {
                                    listItem.remove();
                                }
                            })
                            .catch((error) => {
                                console.error('Error:', error); // Debugging error
                                Swal.fire(
                                    'Error!',
                                    'An error occurred while deleting the record.',
                                    'error'
                                );
                            });
                    }
                });
            }
        });
    });
</script>
