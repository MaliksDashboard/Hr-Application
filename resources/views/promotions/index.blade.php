@extends('layouts.master')
@section('title', 'Promotions')
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
            <h1>Promotions</h1>
            <a href="{{ route('promotions.create') }}" class="instructor" href="{{ route('promotions.create') }}"><svg
                    viewBox="-60 0 512 512" xmlns="http://www.w3.org/2000/svg">
                    <path d="m64 96 264 160L64 416z" />
                </svg> Apply Promotion</a>
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

        <div id="promo-data" class="promo-data">

        </div>
        <button id="load-more-button" style="display: block; margin: 20px auto;">Load More</button>
        <div id="loader" style="display: none; text-align: center;">Loading...</div>
    </div>

@endsection

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const promoData = document.getElementById('promo-data');
        const loadMoreButton = document.getElementById('load-more-button');
        const loader = document.getElementById('loader');
        const searchBox = document.getElementById('search-box');
        const statsContainer = document.getElementById('promotion-stats');
        let offset = 10; // Initial offset
        let isFetching = false; // Prevent multiple simultaneous fetches
        let query = ''; // Store the current search query

        function truncateName(name, maxLength) {
            if (name.length > maxLength) {
                return name.slice(0, maxLength - 5) + '...'; // Truncate and add ellipsis
            }
            return name;
        }

        // Fetch more promotions
        const fetchMorePromotions = () => {
            if (isFetching) return;
            isFetching = true;
            loader.style.display = 'block';
            loadMoreButton.style.display = 'none';

            const formatDate = (dateString) => {
                if (!dateString) return 'No Date';
                const date = new Date(dateString);
                if (isNaN(date)) return 'Invalid Date';
                const day = String(date.getDate()).padStart(2, '0');
                const month = String(date.getMonth() + 1).padStart(2, '0');
                const year = date.getFullYear();
                return `${day}-${month}-${year}`;
            };

            fetch(`/load-more-promotions?offset=${offset}&query=${query}`)
                .then(response => response.json())
                .then(data => {
                    console.log("🔍 Debug - More Promotions Data:", data);

                    if (data.length === 0) {
                        loadMoreButton.style.display = 'none';
                        loader.style.display = 'none';
                        return;
                    }

                    data.forEach(promotion => {
                        console.log("🚀 Promotion Object:", promotion);

                        const promoCard = document.createElement('div');
                        promoCard.classList.add('promo-data-card');
                        promoCard.setAttribute('data-id', promotion.id);

                        promoCard.innerHTML = `
                    <img style="border:4px solid var(--text-light-color)" 
                         src="storage/${promotion.image_path || '/default-image.jpg'}" 
                         alt="${promotion.employee_name || 'No Name'}">
                    <div class="promo-data-name">
                        <div style="display:flex; justify-content:space-between; align-items: center; width:100%">
                            <p class="name">${truncateName(promotion.employee_name || 'Unknown Employee', 15)}</p>
                            <div>
                                <button class="down-promo"><svg viewBox="-5 -5 24 24" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMinYMin" class="jam jam-download"><path d="m8 6.641 1.121-1.12a1 1 0 0 1 1.415 1.413L7.707 9.763a.997.997 0 0 1-1.414 0L3.464 6.934A1 1 0 1 1 4.88 5.52L6 6.641V1a1 1 0 1 1 2 0zM1 12h12a1 1 0 0 1 0 2H1a1 1 0 0 1 0-2"/></svg></button>
                                <button class="delete-promo"><svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2h4a1 1 0 1 1 0 2h-1.069l-.867 12.142A2 2 0 0 1 17.069 22H6.93a2 2 0 0 1-1.995-1.858L4.07 8H3a1 1 0 0 1 0-2h4zm2 2h6V4H9zM6.074 8l.857 12H17.07l.857-12zM10 10a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1m4 0a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1" /></svg></button>
                            </div>
                        </div>
                        <small class="title">
                            ${promotion.new_title || 'No Title'}: 
                            ${formatDate(promotion.promotion_date)}
                        </small>
                    </div>
                `;

                        const downloadButton = promoCard.querySelector(".down-promo");
                        downloadButton.addEventListener("click", () => {
                            console.log("⬇️ Downloading PDF for Promotion ID:",
                                promotion.id);
                            window.location.href =
                                `/promotions/${promotion.id}/download`;
                        });


                        const deleteButton = promoCard.querySelector(".delete-promo");
                        deleteButton.addEventListener("click", () => {
                            console.log("🔥 Calling deletePromotion with:");
                            console.log("  ➡ Promotion ID:", promotion.id);
                            console.log("  ➡ Employee ID:", promotion.employee_id ||
                                "❌ MISSING");
                            console.log("  ➡ Old Title:", promotion.old_title);

                            if (!promotion.employee_id || isNaN(promotion
                                    .employee_id)) {
                                console.error(
                                    "❌ Error: Employee ID is missing or invalid:",
                                    promotion.employee_id);
                                Swal.fire("Error!",
                                    "Employee ID is missing. Cannot delete promotion.",
                                    "error");
                                return;
                            }

                            deletePromotion(promotion.id, promotion.employee_id,
                                promotion.employee_name,
                                promotion.old_title);
                        });

                        promoData.appendChild(promoCard);
                    });

                    offset += data.length;

                    loadMoreButton.style.display = data.length < 10 ? 'none' : 'block';
                })
                .catch(error => console.error('❌ Fetch Error:', error))
                .finally(() => {
                    isFetching = false;
                    loader.style.display = 'none';
                });
        };


        // Function to delete a promotion
        function deletePromotion(promotionId, employeeId, employeeName, oldTitle) {
            console.log("🔍 Debug - Sending DELETE Request");
            console.log("📌 Promotion ID:", promotionId);
            console.log("📌 Employee ID:", employeeId);
            console.log("📌 Old Title:", oldTitle);

            if (!employeeId || isNaN(employeeId)) {
                console.error("❌ Error: Invalid employee_id:", employeeId);
                return Swal.fire("Error!", "Invalid employee ID received.", "error");
            }

            Swal.fire({
                title: "Are you sure?",
                html: `You are about to cancel this promotion and reset the title of <b>${employeeName}</b> to <b>${oldTitle}</b>.`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, reset it!",
                cancelButtonText: "No, cancel"
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/promotions/${promotionId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content'),
                                'Content-Type': 'application/json',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                employee_id: Number(
                                    employeeId),
                                old_title: oldTitle
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            console.log("🔍 Debug - Server Response:", data);

                            if (data.success) {
                                Swal.fire("Deleted!", data.message, "success");
                                document.querySelector(`[data-id='${promotionId}']`)?.remove();
                            } else {
                                Swal.fire("Error!", data.message, "error");
                            }
                        })
                        .catch(error => {
                            console.error('❌ Fetch Error:', error);
                            Swal.fire("Error!", "Something went wrong!", "error");
                        });
                }
            });
        }

        // Function to fetch and display search results
        const fetchSearchResults = () => {
            offset = 0; // Reset the offset
            promoData.innerHTML = ''; // Clear existing promotions
            loadMoreButton.style.display = 'none'; // Hide the button until new results are fetched
            loader.style.display = 'block';

            const formatDate = (dateString) => {
                if (!dateString) return 'No Date';
                const date = new Date(dateString);
                if (isNaN(date)) return 'Invalid Date';
                const day = String(date.getDate()).padStart(2, '0');
                const month = String(date.getMonth() + 1).padStart(2, '0');
                const year = date.getFullYear();
                return `${day}-${month}-${year}`;
            };

            fetch(`/load-more-promotions?offset=${offset}&query=${query}`)
                .then(response => response.json())
                .then(data => {
                    if (data.length === 0) {
                        promoData.innerHTML = '<p>No promotions found.</p>';
                        loader.style.display = 'none';
                        return;
                    }

                    // Create a container to append new content efficiently
                    const fragment = document.createDocumentFragment();

                    data.forEach(promotion => {
                        const promoCard = document.createElement('div');
                        promoCard.classList.add('promo-data-card');
                        promoCard.setAttribute('data-id', promotion.id);

                        promoCard.innerHTML = `
                    <img style="border:4px solid var(--text-light-color)" src="storage/${promotion.image_path || '/default-image.jpg'}" 
                         alt="${promotion.employee_name || 'No Name'}">
                    <div class="promo-data-name">
                        <div style="display:flex; justify-content:space-between; align-items: center; width:100%">
                            <p class="name">${truncateName(promotion.employee_name || 'Unknown Employee', 15)}</p>
                            <div>
                                <button class="down-promo"><svg viewBox="-5 -5 24 24" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMinYMin" class="jam jam-download"><path d="m8 6.641 1.121-1.12a1 1 0 0 1 1.415 1.413L7.707 9.763a.997.997 0 0 1-1.414 0L3.464 6.934A1 1 0 1 1 4.88 5.52L6 6.641V1a1 1 0 1 1 2 0zM1 12h12a1 1 0 0 1 0 2H1a1 1 0 0 1 0-2"/></svg></button>
                                <button class="delete-promo"><svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2h4a1 1 0 1 1 0 2h-1.069l-.867 12.142A2 2 0 0 1 17.069 22H6.93a2 2 0 0 1-1.995-1.858L4.07 8H3a1 1 0 0 1 0-2h4zm2 2h6V4H9zM6.074 8l.857 12H17.07l.857-12zM10 10a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1m4 0a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1" /></svg></button>
                            </div>
                        </div>
                        <small class="title">
                            ${promotion.new_title || 'No Title'}: 
                            ${formatDate(promotion.promotion_date)}
                        </small>
                    </div>
                `;

                        const downloadButton = promoCard.querySelector(".down-promo");
                        downloadButton.addEventListener("click", () => {
                            console.log("⬇️ Downloading PDF for Promotion ID:",
                                promotion.id);
                            window.location.href =
                                `/promotions/${promotion.id}/download`;
                        });


                        // Attach event listener for delete button
                        promoCard.querySelector(".delete-promo").addEventListener("click",
                            () => {
                                deletePromotion(promotion.id, promotion.employee_id,
                                    promotion.employee_name,
                                    promotion.old_title);
                            });


                        // Append to the fragment
                        fragment.appendChild(promoCard);
                    });

                    // Append all elements at once to optimize DOM updates
                    promoData.appendChild(fragment);

                    offset = data.length;
                    loadMoreButton.style.display = data.length < 10 ? 'none' : 'block';
                })
                .catch(error => console.error('Error fetching search results:', error))
                .finally(() => {
                    loader.style.display = 'none';
                });
        };

        // Fetch and render stats
        const fetchStats = () => {
            fetch('/promotion-stats')
                .then(response => response.json())
                .then(data => {
                    statsContainer.innerHTML = '';

                    data.forEach(item => {
                        const percentage = (item.total / 400) *
                            100; // Adjust denominator if needed
                        statsContainer.innerHTML += `
                            <div class="bar">
                                <span class="bar-label">${item.new_title}</span>
                                <div class="bar-fill-container">
                                    <div class="bar-fill" style="width: ${percentage}%;"></div>
                                </div>
                                <span class="bar-value">${item.total}</span>
                            </div>
                        `;
                    });
                })
                .catch(error => console.error('Error fetching promotion stats:', error));
        };

        // Attach event listener to "Load More" button
        loadMoreButton.addEventListener('click', fetchMorePromotions);

        // Attach event listener to search box
        searchBox.addEventListener('input', (e) => {
            query = e.target.value.trim();
            fetchSearchResults();
        });

        // Initial fetch
        fetchStats(); // Fetch and display stats
        fetchSearchResults(); // Fetch initial promotions
    });
</script>


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
</style>
