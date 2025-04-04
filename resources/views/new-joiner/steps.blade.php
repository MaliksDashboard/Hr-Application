@extends('layouts.master')
@section('title', 'Training Steps')
@section('custom_title', 'Manage Steps')

<meta name="csrf-token" content="{{ csrf_token() }}">

@can('Edit')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
@endcan

@section('main')

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const notyf = new Notyf({
                    duration: 4000,
                    position: {
                        x: 'right',
                        y: 'top'
                    }
                });
                notyf.success('{{ session('success') }}');
            });
        </script>
    @endif

    <div class="main">
        <div class="container titles">
            <div class="steps-header">
                <a class="btn-primary" href="{{ url('/new-joiners') }}">Back</a>
            </div>
            <form id="add-step-form">
                <input type="text" id="name" placeholder="Step Name" required>

                <select id="type" required>
                    <option value="">Select Step Type</option>
                    <option value="interview">Interview</option>
                    <option value="reference">Reference</option>
                    <option value="training">Training</option>
                </select>

                <label style="font-size:14px; color:#444;">
                    <input type="checkbox" id="is_reference_step" />
                    Is Reference Step?
                </label>
                <div class="color-picker-container">
                    <input type="color" id="color" class="color-input" value="#FFFFFF" required>
                </div>
                @can('Create')
                    <button class="add-titlles" type="submit">Add Step</button>
                @endcan
            </form>

            <ul id="title-list">
                @foreach ($steps as $step)
                    <li data-id="{{ $step->id }}" style="background-color: {{ $step->color }};">
                        <span>{{ $step->name }}</span>
                        <div style="display: flex; gap:5px">

                            @can('Edit')
                                <button class="edit-btn" data-id="{{ $step->id }}"><svg viewBox="0 0 24 24" version="1.2"
                                        baseProfile="tiny" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="m21.561 5.318-2.879-2.879A1.5 1.5 0 0 0 17.621 2c-.385 0-.768.146-1.061.439L13 6H4a1 1 0 0 0-1 1v13a1 1 0 0 0 1 1h13a1 1 0 0 0 1-1v-9l3.561-3.561c.293-.293.439-.677.439-1.061s-.146-.767-.439-1.06M11.5 14.672 9.328 12.5l6.293-6.293 2.172 2.172zm-2.561-1.339 1.756 1.728L9 15zM16 19H5V8h6l-3.18 3.18c-.293.293-.478.812-.629 1.289-.16.5-.191 1.056-.191 1.47V17h3.061c.414 0 1.108-.1 1.571-.29.464-.19.896-.347 1.188-.64L16 13zm2.5-11.328L16.328 5.5l1.293-1.293 2.171 2.172z" />
                                    </svg></button>
                            @endcan

                            @can('Delete')
                                <form id="delete-form-{{ $step->id }}" action="{{ route('steps.destroy', $step->id) }}"
                                    method="POST" style="display:none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <button class="delete-btn" data-id="{{ $step->id }}">
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

        <div id="edit-step-popup" class="popup" style="display: none;">
            <form id="edit-step-form">
                <input type="hidden" id="edit-id">
                <label for="edit-name">Step Name:</label>
                <input type="text" id="edit-name" required>
                <select id="edit-type" required>
                    <option value="">Select Step Type</option>
                    <option value="interview">Interview</option>
                    <option value="reference">Reference</option>
                    <option value="training">Training</option>
                </select>

                <label style="font-size:14px; color:#444;">
                    <input type="checkbox" id="edit-is-reference-step" />
                    Is Reference Step?
                </label>

                <div class="color-picker-container">
                    <input type="color" id="edit-color" class="color-input" required>
                    <button type="button" class="color-preview" id="color-preview-edit"></button>
                </div>
                <div style="display: flex; justify-content: center; align-items: center; gap:10px;">
                    <button type="submit" class="btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
        <div id="popup-overlay"></div>
    </div>

@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const titleList = document.getElementById('title-list');
        const addStepForm = document.getElementById('add-step-form');
        const editStepPopup = document.getElementById('edit-step-popup');
        const editStepForm = document.getElementById('edit-step-form');
        const closeEditPopup = document.getElementById('close-edit-popup');
        const popupOverlay = document.getElementById('popup-overlay');

        console.log("Elements Found: ", {
            titleList,
            addStepForm,
            editStepPopup,
            editStepForm,
            closeEditPopup,
            popupOverlay
        });

        if (!titleList || !addStepForm || !editStepPopup || !editStepForm || !closeEditPopup || !popupOverlay) {
            console.error(
                "❌ One or more required elements are missing. Make sure all IDs exist in your Blade file.");
            return; // Stop execution
        }

        const notyf = new Notyf({
            duration: 4000,
            position: {
                x: 'right',
                y: 'top'
            }
        });

        if (addStepForm) {
            addStepForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const name = document.getElementById('name').value;
                const color = document.getElementById('color').value;
                const type = document.getElementById('type').value;
                const is_reference_step = document.getElementById('is_reference_step').checked ? 1 : 0;

                fetch('/steps', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content'),
                        },
                        body: JSON.stringify({
                            name,
                            color,
                            type,
                            is_reference_step
                        }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        notyf.success(data.success || 'Step added successfully!');
                        location.reload();
                    })
                    .catch(() => notyf.error('Failed to add step.'));
            });
        }


        titleList.addEventListener('click', function(e) {
            if (e.target.closest('.edit-btn')) {
                const id = e.target.closest('.edit-btn').getAttribute('data-id');

                fetch(`/steps/${id}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('edit-id').value = data.step.id;
                        document.getElementById('edit-name').value = data.step.name;
                        document.getElementById('edit-color').value = data.step
                            .color; // Set color input
                        editStepPopup.style.display = 'block';
                        popupOverlay.style.display = 'block';
                    })
                    .catch(() => notyf.error('Failed to fetch step.'));
            }
        });


        closeEditPopup.addEventListener('click', () => {
            editStepPopup.style.display = 'none';
            popupOverlay.style.display = 'none';
        });

        popupOverlay.addEventListener('click', () => {
            editStepPopup.style.display = 'none';
            popupOverlay.style.display = 'none';
        });

        editStepForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const id = document.getElementById('edit-id').value;
            const name = document.getElementById('edit-name').value;
            const color = document.getElementById('edit-color').value;
            const type = document.getElementById('edit-type').value;
            const is_reference_step = document.getElementById('edit-is-reference-step').checked ? 1 : 0;


            fetch(`/steps/${id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                            .getAttribute('content'),
                    },
                    body: JSON.stringify({
                        name,
                        color,
                        type,
                        is_reference_step
                    }),
                })
                .then(response => response.json())
                .then(() => location.reload())
                .catch(() => notyf.error('Failed to update step.'));
        });


        document.body.addEventListener('click', (e) => {
            if (e.target.closest('.delete-btn')) {
                e.preventDefault();
                const id = e.target.closest('.delete-btn').getAttribute('data-id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'This action cannot be undone!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel',
                }).then(result => {
                    if (result.isConfirmed) {
                        fetch(`/steps/${id}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]').getAttribute(
                                        'content')
                                }
                            })
                            .then(() => location.reload())
                            .catch(() => notyf.error('Failed to delete step.'));
                    }
                });
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const titleList = document.getElementById('title-list');

        if (titleList) {
            new Sortable(titleList, {
                animation: 150,
                ghostClass: 'sortable-ghost', // Add ghost effect while dragging
                onEnd: function(event) {
                    const order = [];
                    document.querySelectorAll('#title-list li').forEach((li, index) => {
                        order.push({
                            id: li.getAttribute('data-id'),
                            step_order: index + 1
                        });
                    });

                    fetch('/steps/update-ranks', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').getAttribute('content'),
                            },
                            body: JSON.stringify({
                                steps: order
                            }),
                        })
                        .then(response => response.json())
                        .then(data => {
                            console.log("Step order updated:", data);
                            new Notyf().success(data.success || 'Order updated successfully!');
                        })
                        .catch(error => console.error("Error updating order:", error));
                },
            });
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        const colorInputAdd = document.getElementById('color');
        const colorInputEdit = document.getElementById('edit-color');
        const colorPreviewEdit = document.getElementById('color-preview-edit');

        // Function to update preview button background color
        function updatePreview(input, preview) {
            preview.style.backgroundColor = input.value;
        }

        // // Update preview on color change (Add form)
        // if (colorInputAdd) {
        //     updatePreview(colorInputAdd, colorPreviewAdd);
        //     colorInputAdd.addEventListener('input', function() {
        //         updatePreview(colorInputAdd, colorPreviewAdd);
        //     });
        // }

        // Update preview on color change (Edit form)
        if (colorInputEdit) {
            updatePreview(colorInputEdit, colorPreviewEdit);
            colorInputEdit.addEventListener('input', function() {
                updatePreview(colorInputEdit, colorPreviewEdit);
            });
        }

        // Set preview color when opening the edit popup
        document.body.addEventListener('click', function(e) {
            if (e.target.closest('.edit-btn')) {
                const id = e.target.closest('.edit-btn').getAttribute('data-id');

                fetch(`/steps/${id}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('edit-id').value = data.step.id;
                        document.getElementById('edit-name').value = data.step.name;
                        colorInputEdit.value = data.step.color; // Set color input
                        updatePreview(colorInputEdit, colorPreviewEdit); // Update preview
                        document.getElementById('edit-step-popup').style.display = 'block';
                        document.getElementById('popup-overlay').style.display = 'block';
                        document.getElementById('edit-type').value = data.step.type || "";
                        document.getElementById('edit-is-reference-step').checked = data.step
                            .is_reference_step == 1;

                    })
                    .catch(() => console.error("Failed to fetch step."));
            }
        });
    });
</script>

<style>
    #popup-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.4);
        z-index: 1000;
        display: none;
    }

    #edit-step-popup {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: #ffffff;
        padding: 25px 30px;
        border-radius: 16px;
        z-index: 11000000000;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        width: 400px;
        max-width: 90vw;
        display: flex;
        flex-direction: column;
        gap: 15px;
        font-family: 'Segoe UI', sans-serif;
    }

    #edit-step-popup h3 {
        font-size: 20px;
        color: #333;
        margin-bottom: 10px;
        text-align: center;
    }

    #edit-step-popup input[type="text"],
    #edit-step-popup input[type="color"],
    #edit-step-popup select {
        width: 100%;
        padding: 10px 12px;
        border-radius: 8px;
        border: 1px solid #ccc;
        font-size: 14px;
        box-sizing: border-box;
        background: #f9f9f9;
    }

    #edit-step-popup input[type="checkbox"] {
        transform: scale(1.2);
        margin-right: 6px;
    }

    #edit-step-popup label {
        font-size: 14px;
        color: #444;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    #edit-step-popup .color-picker-container {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: 5px;
        width: 100%;
    }

    #edit-step-popup .color-input {
        width: 40px;
        height: 40px;
        border: none;
        cursor: pointer;
        background: transparent;
    }

    #edit-step-popup .color-preview {
        width: 40px;
        height: 40px;
        border: 2px solid #ccc;
        border-radius: 5px;
        cursor: pointer;
    }

    #edit-step-popup .color-preview:hover {
        border-color: #666;
    }

    #edit-step-popup button {
        padding: 10px 15px;
        background-color: var(--third-color, #007bff);
        color: #fff;
        border: none;
        border-radius: 8px;
        font-size: 14px;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    #edit-step-popup button:hover {
        background-color: #0056b3;
    }

    #edit-step-form {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 10px;
        width: 100%;
    }

    #name {
        width: 300px !important;
    }

    .titles form {
        justify-content: space-between !important;
    }
</style>
