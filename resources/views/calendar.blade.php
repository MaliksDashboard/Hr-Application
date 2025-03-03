@extends('layouts.master')
@section('title', 'Calendar')
@section('custom_title', 'Calendar')

<meta name="csrf-token" content="{{ csrf_token() }}">

<link href="https://cdn.jsdelivr.net/npm/fullcalendar/main.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar/main.min.js"></script>


@section('main')
    <div class="main">
        <div id="calendar"></div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById('calendar');

        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay',
            },
            editable: true,
            selectable: true,
            events: '/events', // Fetch events from the server

            // Handle adding events
            dateClick: function(info) {
                const clickedDate = info.dateStr; // The selected date in YYYY-MM-DD format

                Swal.fire({
                    title: 'Add Event',
                    html: `
                        <div style="text-align: left; display:flex; flex-direction:column; gap:10px;">
                             <div style="display:flex; flex-direction:column; gap:5px;">
                             <label for="event-title" style="font-weight: bold;">Event Title:</label>
                    <input type="text" id="event-title" class="swal2-input" placeholder="Enter event title">
                      </div>
                      <div style="display:flex; flex-direction:column; gap:5px;">
                    <label for="start-time" style="font-weight: bold;">Start Time:</label>
                    <input type="text" id="start-time" class="swal2-input">
                      </div>
                          <div style="display:flex; flex-direction:column; gap:5px;">
                           <label for="end-time" style="font-weight: bold;">End Time:</label>
                    <input type="text" id="end-time" class="swal2-input">
                         </div>
                     </div>
                           `,
                    didOpen: () => {
                        // Convert clickedDate to a suitable format for flatpickr
                        const formattedDate = new Date(clickedDate);

                        // Initialize Flatpickr with the clicked date and default times
                        flatpickr("#start-time", {
                            enableTime: true,
                            dateFormat: "d-m-Y h:i K", // Format: dd-mm-yyyy h:mm AM/PM
                            defaultDate: new Date(formattedDate.setHours(9,
                                0)), // 9:00 AM on the clicked date
                        });

                        flatpickr("#end-time", {
                            enableTime: true,
                            dateFormat: "d-m-Y h:i K", // Format: dd-mm-yyyy h:mm AM/PM
                            defaultDate: new Date(formattedDate.setHours(10,
                                0)), // 10:00 AM on the clicked date
                        });
                    },
                    focusConfirm: false,
                    showCancelButton: true,
                    confirmButtonText: 'Add Event',
                    cancelButtonText: 'Cancel',
                    preConfirm: () => {
                        const title = document.getElementById('event-title').value
                            .trim();
                        const startInput = document.getElementById('start-time').value
                            .trim();
                        const endInput = document.getElementById('end-time').value
                            .trim();

                        // Check if any field is empty
                        if (!title || !startInput || !endInput) {
                            Swal.showValidationMessage('Please fill in all fields.');
                            return false;
                        }

                        // Parse and format dates
                        try {
                            const start = flatpickr.formatDate(
                                flatpickr.parseDate(startInput, "d-m-Y h:i K"),
                                "Y-m-d H:i"
                            );
                            const end = flatpickr.formatDate(
                                flatpickr.parseDate(endInput, "d-m-Y h:i K"),
                                "Y-m-d H:i"
                            );

                            // Check if start time is before end time
                            if (new Date(start) >= new Date(end)) {
                                Swal.showValidationMessage(
                                    'End time must be after start time.');
                                return false;
                            }

                            return {
                                title,
                                start,
                                end
                            };
                        } catch (error) {
                            console.error('Error parsing dates:', error);
                            Swal.showValidationMessage(
                                'Invalid date format. Please try again.');
                            return false;
                        }
                    },


                }).then((result) => {
                    if (result.isConfirmed) {
                        const {
                            title,
                            start,
                            end
                        } = result.value;

                        // Save the new event to the server
                        fetch('/events', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]').content,
                                },
                                body: JSON.stringify({
                                    title,
                                    start,
                                    end
                                }),
                            })
                            .then(response => {
                                if (!response.ok) {
                                    return response.text().then(text => {
                                        throw new Error(text);
                                    });
                                }
                                return response.json();
                            })
                            .then(data => {
                                if (data.success) {
                                    calendar.addEvent(data.event);
                                    Swal.fire('Added!', 'Event successfully added.',
                                        'success');
                                } else {
                                    throw new Error(data.message ||
                                        'Unknown error occurred');
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error.message);
                                Swal.fire('Error!', error.message, 'error');
                            });

                    }
                });
            },

            // Handle editing/deleting events
            // Event click for editing or deleting
            eventClick: function(info) {
                const event = info.event;

                Swal.fire({
                    title: 'Edit Event',
                    html: `
            <div style="text-align: left; display:flex; flex-direction:column; gap:10px;">
                <div style="display:flex; flex-direction:column; gap:5px;">
                    <label for="edit-title" style="font-weight: bold;">Event Title:</label>
                    <input type="text" id="edit-title" class="swal2-input" value="${event.title}">
                </div>
                <div style="display:flex; flex-direction:column; gap:5px;">
                    <label for="edit-start-time" style="font-weight: bold;">Start Time:</label>
                    <input type="text" id="edit-start-time" class="swal2-input">
                </div>
                <div style="display:flex; flex-direction:column; gap:5px;">
                    <label for="edit-end-time" style="font-weight: bold;">End Time:</label>
                    <input type="text" id="edit-end-time" class="swal2-input">
                </div>
            </div>
        `,
                    didOpen: () => {
                        // Initialize Flatpickr for the fields
                        flatpickr("#edit-start-time", {
                            enableTime: true,
                            dateFormat: "d-m-Y h:i K",
                            defaultDate: event.start ? event.start
                                .toISOString() : null,
                        });
                        flatpickr("#edit-end-time", {
                            enableTime: true,
                            dateFormat: "d-m-Y h:i K",
                            defaultDate: event.end ? event.end.toISOString() :
                                event.start.toISOString(),
                        });
                    },
                    focusConfirm: false,
                    showCancelButton: true,
                    confirmButtonText: 'Save Changes',
                    cancelButtonText: 'Delete Event',
                    preConfirm: () => {
                        // Safely retrieve input values
                        const title = document.getElementById('edit-title')?.value
                            .trim();
                        const startInput = document.getElementById('edit-start-time')
                            ?.value.trim();
                        const endInput = document.getElementById('edit-end-time')?.value
                            .trim();

                        if (!title || !startInput || !endInput) {
                            Swal.showValidationMessage('Please fill in all fields.');
                            return false;
                        }

                        // Convert Flatpickr input to database format
                        const start = flatpickr.formatDate(flatpickr.parseDate(
                            startInput, "d-m-Y h:i K"), "Y-m-d H:i");
                        const end = flatpickr.formatDate(flatpickr.parseDate(endInput,
                            "d-m-Y h:i K"), "Y-m-d H:i");

                        if (new Date(start) >= new Date(end)) {
                            Swal.showValidationMessage(
                                'End time must be after start time.');
                            return false;
                        }

                        return {
                            title,
                            start,
                            end
                        };
                    },
                }).then((result) => {
                    if (result.isConfirmed) {
                        const {
                            title,
                            start,
                            end
                        } = result.value;

                        // Update the event via API
                        fetch(`/events/${event.id}`, {
                                method: 'PUT',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]').content,
                                },
                                body: JSON.stringify({
                                    title,
                                    start,
                                    end
                                }),
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // Update event on the calendar
                                    event.setProp('title', title);
                                    event.setStart(start);
                                    event.setEnd(end);
                                    Swal.fire('Updated!', 'Event successfully updated.',
                                        'success');
                                } else {
                                    Swal.fire('Error!', 'Failed to update event.',
                                        'error');
                                }
                            })
                            .catch(error => {
                                console.error('Error updating event:', error);
                                Swal.fire('Error!',
                                    'An error occurred while updating the event.',
                                    'error');
                            });
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        // Confirm deletion
                        Swal.fire({
                            title: 'Are you sure?',
                            text: 'This event will be permanently deleted.',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Yes, delete it!',
                            cancelButtonText: 'No, keep it',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                fetch(`/events/${event.id}`, {
                                        method: 'DELETE',
                                        headers: {
                                            'X-CSRF-TOKEN': document
                                                .querySelector(
                                                    'meta[name="csrf-token"]')
                                                .content,
                                        },
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.success) {
                                            event
                                                .remove(); // Remove from calendar
                                            Swal.fire('Deleted!',
                                                'Event successfully deleted.',
                                                'success');
                                        } else {
                                            Swal.fire('Error!',
                                                'Failed to delete event.',
                                                'error');
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Error deleting event:',
                                            error);
                                        Swal.fire('Error!',
                                            'An error occurred while deleting the event.',
                                            'error');
                                    });
                            }
                        });
                    }
                });
            },


        });

        calendar.render();
    });
</script>


<style>
    div:where(.swal2-container) div:where(.swal2-popup) {
        widows: 40em !important;
        height: 500px !important;
        overflow: hidden !important;
    }

    div:where(.swal2-container) div:where(.swal2-html-container) {
        overflow: hidden !important;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    div:where(.swal2-container) .swal2-input {
        margin-left: 0 !important;
    }
</style>
