@extends('layouts.master')
@section('title', 'Promotions')
@section('custom_title', 'Promotions')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@section('main')

    <div class="main promotions">

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

        <div class="promo-header">
            @can('Create')
                <a href="{{ route('promotions.create') }}" class="add-btn" href="{{ route('promotions.create') }}"><svg
                        viewBox="-60 0 512 512" xmlns="http://www.w3.org/2000/svg">
                        <path d="m64 96 264 160L64 416z" />
                    </svg> Apply Promotion</a>
            @endcan
        </div>

        <div class="promo-overview">
            <div class="promo-first">
                <div class="promo-first-title">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none">
                        <circle cx="12" cy="9" r="7" stroke="#d9534f" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" />
                        <path fill="#d9534f" stroke="#d9534f" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"
                            d="M7 20.234V14c.667.667 2.6 2 5 2s4.333-1.333 5-2v6.234a1 1 0 0 1-1.514.857l-2.972-1.782a1 1 0 0 0-1.028 0L8.514 21.09A1 1 0 0 1 7 20.234" />
                    </svg>
                    Total Promotions
                </div>

                <div class="promo-first-analysis">
                    @foreach ($promotionsByYear as $promotion)
                        <div class="analysis">
                            <div class="analysis-pc">
                                <p>{{ $promotion->year }}</p>
                                <span>{{ $promotion->count }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="promo-second">
                <div class="promo-second-title">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52" xml:space="preserve">
                        <path
                            d="M2 45.5c0 2.2 1.8 4 4 4h42.4c.9 0 1.6-.7 1.6-1.6v-2.8c0-.9-.7-1.6-1.6-1.6H9.5c-.8 0-1.5-.7-1.5-1.5V4.1c0-.9-.7-1.6-1.6-1.6H3.6c-.9 0-1.6.7-1.6 1.6z" />
                        <path
                            d="M49.7 14.1c0-1.7-1.3-3-3-3-.9 0-1.6.4-2.2.9l-8.6 8.6L30 15l-.1-.1-.2-.2c-.1 0-.1-.1-.2-.1-.1-.1-.2-.1-.3-.2-.1 0-.1-.1-.2-.1s-.2-.1-.4-.1c-.1 0-.1 0-.2-.1-.2 0-.4-.1-.6-.1s-.4 0-.6.1c-.1 0-.1 0-.2.1-.1 0-.3.1-.4.1s-.1.1-.2.1c-.1.1-.2.1-.3.2-.1 0-.1.1-.2.2s-.2.1-.3.2L14.2 26.5c-.6.6-1 1.3-1 2.2 0 1.7 1.3 3 3 3 .7 0 1.4-.3 1.9-.7l9.8-9.7 5.7 5.6c.1.1.2.1.3.2l.2.2c.1.1.2.1.3.2.1 0 .1.1.2.1.1.1.3.1.4.1s.1 0 .2.1c.2 0 .4.1.6.1s.4 0 .6-.1h.2c.1 0 .2-.1.4-.1.1 0 .1-.1.2-.1s.2-.1.3-.2c.1 0 .1-.1.2-.1l.1-.1.1-.1.1-.1 10.8-10.7c.5-.6.9-1.3.9-2.2" />
                    </svg>
                    Promotions Analysis
                </div>

                <div class="promo-first-analysis">
                    <div class="chart-container" id="promotion-stats"></div>
                </div>
            </div>
        </div>

        <div id="promo-table"></div> <!-- Grid.js will render here -->

    </div>

@endsection

@php
    $canDelete = auth()->user()->can('Delete'); // Check if user can delete
@endphp

@push('scripts')
    <script>
        const canDelete = @json($canDelete); // Pass the value to JavaScript

        document.addEventListener('DOMContentLoaded', () => {
            const promoTable = document.getElementById('promo-table');
            let allData = []; // 🔥 Declare allData globally to store promotions

            function formatDate(dateString) {
                if (!dateString) return 'No Date';
                const date = new Date(dateString);
                if (isNaN(date)) return 'Invalid Date';
                return `${String(date.getDate()).padStart(2, '0')}-${String(date.getMonth() + 1).padStart(2, '0')}-${date.getFullYear()}`;
            }

            function fetchAllPromotions() {
                fetch(`/getAllPromo`)
                    .then(response => response.json())
                    .then(data => {
                        console.log("🔍 Debug - All Promotions Data:", data);

                        allData = data; // 🔥 Store data globally for delete function

                        if (!data.length) {
                            promoTable.innerHTML = "<p>No promotions found.</p>";
                            return;
                        }

                        const gridData = data.map(promotion => [
                            gridjs.html(`
                    <div style="display: flex; align-items: center; gap:30px;" data-promotion-id="${promotion.id}">
                        <img src="storage/${promotion.image_path || '/default-image.jpg'}"
                             alt="${promotion.employee_name || 'No Name'}"
                             style="width:50px;height:50px;border-radius:5px;border:3px solid var(--primary-color);">
                        <span>${promotion.employee_name || 'N/A'}</span>
                    </div>
                `),
                            promotion.new_title || 'No Title',
                            promotion.old_title || 'No Title',
                            formatDate(promotion.promotion_date),
                            gridjs.html(`
                            <div class=promo-btns>
                    <button class="down-promo" data-id="${promotion.id}">
                        <svg fill="#fff" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" xml:space="preserve">
                            <path d="M84.514 49.615H67.009a4.91 4.91 0 0 0-4.679 3.406 12.92 12.92 0 0 1-12.329 8.983 12.92 12.92 0 0 1-12.329-8.983 4.92 4.92 0 0 0-4.681-3.406H15.486a4.92 4.92 0 0 0-4.919 4.919v28.054a4.92 4.92 0 0 0 4.919 4.917h69.028a4.92 4.92 0 0 0 4.919-4.917V54.534c0-2.719-2.2-4.919-4.919-4.919"/>
                            <path d="M48.968 52.237c.247.346.651.553 1.076.553h.003c.428 0 .826-.207 1.076-.558l13.604-19.133a1.33 1.33 0 0 0 .096-1.374 1.32 1.32 0 0 0-1.177-.716h-6.399V13.821c0-.735-.593-1.326-1.323-1.326H44.078c-.732 0-1.323.591-1.323 1.326v17.188h-6.404a1.323 1.323 0 0 0-1.076 2.09z"/>
                        </svg>
                    </button>
                    ${canDelete ? `
                                                        <button class="delete-promo" data-id="${promotion.id}" style="color:red;">
                                                             <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M7 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2h4a1 1 0 1 1 0 2h-1.069l-.867 12.142A2 2 0 0 1 17.069 22H6.93a2 2 0 0 1-1.995-1.858L4.07 8H3a1 1 0 0 1 0-2h4zm2 2h6V4H9zM6.074 8l.857 12H17.07l.857-12zM10 10a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1m4 0a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1" fill="#fff"/>
                                                             </svg>
                                                          </button> </div>` : ''}
                `)
                        ]);

                        promoTable.innerHTML = ''; // Clear table before re-rendering

                        new gridjs.Grid({
                            columns: ['Employee', 'New Title', 'Old Title', 'Promotion Date',
                                'Actions'
                            ],
                            data: gridData,
                            pagination: true,
                            search: true,
                            sort: true
                        }).render(promoTable);

                        setTimeout(attachEventListeners, 500); // Re-attach event listeners after rendering
                    })
                    .catch(error => console.error('❌ Fetch Error:', error));
            }

            function attachEventListeners() {
                console.log("🔗 Attaching Event Listeners...");

                // ✅ Download Event
                document.querySelectorAll('.down-promo').forEach(button => {
                    button.addEventListener('click', event => {
                        const buttonElement = event.target.closest('.down-promo');
                        const promotionId = buttonElement.dataset.id;
                        console.log("⬇️ Downloading PDF for Promotion ID:", promotionId);
                        window.location.href =
                            `/promotions/${promotionId}/download`; // ✅ Redirect to download
                    });
                });

                // ✅ Delete Event
                document.querySelectorAll('.delete-promo').forEach(button => {
                    button.addEventListener('click', event => {
                        const buttonElement = event.target.closest('.delete-promo');
                        const promotionId = buttonElement.dataset.id;

                        // 🔥 Find the correct promotion in allData
                        const promotion = allData.find(p => p.id == promotionId);
                        if (!promotion) {
                            console.error("❌ Error: Promotion data not found for ID:", promotionId);
                            return;
                        }

                        const employeeId = promotion.employee_id; // ✅ Get employee_id
                        const oldTitle = promotion.old_title; // ✅ Get old_title

                        console.log(
                            `🔥 Deleting Promotion ID: ${promotionId}, Employee ID: ${employeeId}, Old Title: ${oldTitle}`
                        );
                        deletePromotion(promotionId, employeeId, oldTitle);
                    });
                });
            }


            function deletePromotion(promotionId, employeeId, oldTitle) {
                Swal.fire({
                    title: "Are you sure?",
                    text: "This action cannot be undone!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Yes, delete it!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/promotions/${promotionId}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                        .content,
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify({
                                    employee_id: employeeId,
                                    old_title: oldTitle
                                })
                            })
                            .then(response => response.json())
                            .then(data => {

                                if (data.success) {
                                    Swal.fire("Deleted!", "Promotion deleted successfully.", "success");

                                    // ✅ Remove the row dynamically from the DOM
                                    const rowToDelete = document.querySelector(
                                        `[data-promotion-id="${promotionId}"]`);
                                    if (rowToDelete) {
                                        rowToDelete.remove();
                                    } else {
                                        console.warn(
                                            "⚠️ Row not found in the DOM. Grid.js might need refreshing."
                                        );
                                    }

                                    // ✅ Refresh the Grid.js Table after deletion
                                    fetchAllPromotions();

                                } else {
                                    Swal.fire("Error!", data.message || "Failed to delete promotion.",
                                        "error");
                                }
                            })
                            .catch(error => {
                                console.error("❌ Fetch Error:", error);
                                Swal.fire("Error!", "An unexpected error occurred.", "error");
                            });
                    }
                });
            }

            fetchAllPromotions(); // Initial load
        });
    </script>
@endpush

<style>
    #load-more-button {
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }

    #load-more-button:hover {
        background-color: #0056b3;
    }

    #loader {
        font-size: 16px;
        color: gray;
    }

    @keyframes fadeIn {

        0%,
        100% {
            opacity: 0;
        }

        50% {
            opacity: 1;
        }
    }

    .chart-container {
        font-family: Arial, sans-serif;
        width: 100%;
        max-width: 600px;
        margin: 20px auto;
    }

    .chart-title {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .chart-title svg {
        width: 20px;
        height: 20px;
        fill: #007bff;
    }

    .bar {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .bar-label {
        width: 150px;
        font-size: 14px;
    }

    .bar-fill-container {
        flex-grow: 1;
        height: 8px;
        background-color: #e5e5e5;
        position: relative;
        border-radius: 4px;
        overflow: hidden;
        margin-right: 10px;
    }

    .bar-fill {
        height: 100%;
        background-color: #007bff;
        width: 0%;
        border-radius: 4px;
    }

    .bar-value {
        font-size: 14px;
        color: #333;
        min-width: 30px;
        text-align: right;
    }

    input.gridjs-input {
        width: 100%;
    }

    #show-rows {
        padding: 10px;
        background-color: white;
        border-radius: 10px;
        cursor: pointer;
        border: 1px solid var(--light-color);
    }

    .add-btn {
        max-width: 200px !important;
    }

    .promo-btns {
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
        gap: 10px !important;
    }
</style>
