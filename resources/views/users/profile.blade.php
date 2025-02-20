@extends('layouts.master')
@section('title', 'Profile')

@section('main')

    <div class="main">
        <div class="profile-top">
            <div class="profile-info">
                <div class="imgs">
                    <img src="/images/profile-cover.jpg" alt="">
                    <img src="/storage/{{ $user->image }}" alt="{{ $user->name }}">
                </div>
                <div class="profile-name">
                    <div class="name-title">
                        <p>{{ $user->name }} ✅</p>
                        <p>{{ $user->role_name }}</p>

                    </div>
                   <div style="display: flex; gap: 10px; justify-content: center;align-items: center"> <a href="{{ url('/dashboard') }}">Dashboard</a>
                    <a id="lock-link" style="display: flex; justify-content: center;align-items: center; gap: 10px; background-color: var(--light-color);color:var(--primary-color); font-weight: bold;" href="">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M17 9V7A5 5 0 0 0 7 7v2a3 3 0 0 0-3 3v7a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3v-7a3 3 0 0 0-3-3M9 7a3 3 0 0 1 6 0v2H9Zm9 12a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1v-7a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1Z"/></svg>
                        Change Lock Password</a>
                   </div>
                </div>
                <div class="ach">
                    <div class="ach1">
                        <svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10 0c5.523 0 10 4.477 10 10s-4.477 10-10 10S0 15.523 0 10 4.477 0 10 0m-.93 5.581a.7.7 0 0 0-.698.698v5.581c0 .386.312.698.698.698h5.581a.698.698 0 1 0 0-1.395H9.767V6.279a.7.7 0 0 0-.697-.698" />
                        </svg>
                        <div class="ach1-info">
                            <p>3+ Years Job</p>
                            <p>Back Office</p>
                        </div>
                    </div>

                    <div class="ach1">
                        <svg viewBox="0 0 24 24" data-name="Flat Color" xmlns="http://www.w3.org/2000/svg"
                            class="icon flat-color">
                            <path
                                d="M17 12a1 1 0 0 1 0-2 3 3 0 0 0 3-3V6h-2.83a1 1 0 0 1 0-2H20a2 2 0 0 1 2 2v1a5 5 0 0 1-5 5m-9-1a1 1 0 0 0-1-1 3 3 0 0 1-3-3V6h2.74a1 1 0 0 0 0-2H4a2 2 0 0 0-2 2v1a5 5 0 0 0 5 5 1 1 0 0 0 1-1m5 10v-4.82a1 1 0 0 0-2 0V21a1 1 0 0 0 2 0" />
                            <path
                                d="M16 22H8a1 1 0 0 1 0-2h8a1 1 0 0 1 0 2m1-20H7a1 1 0 0 0-1 1v6.57a7.75 7.75 0 0 0 4.89 7.22A3 3 0 0 0 12 17a3.1 3.1 0 0 0 1.12-.21A7.76 7.76 0 0 0 18 9.57V3a1 1 0 0 0-1-1" />
                        </svg>
                        <div class="ach1-info">
                            <p>5 Training Sessions</p>
                            <p>Completed</p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="profile-details">
                <h3>Personal Information</h3>
                <span class="line"></span>
            </div>
        </div>

        <div class="profile-body">
            <div class="body-left">
                <h3>About (Write what you think)</h3>
                <span style="top: 17%" class="line"></span>
                <textarea id="about-text" style="margin-top: 20px">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae, quod impedit! Ducimus ad itaque vero veritatis unde, magnam nulla libero repellat quo nihil aut a mollitia assumenda, nobis aperiam similique?Laboriosam odit vero quasi perferendis omnis obcaecati sequi dolorem doloremque at. Voluptates omnis consequuntur sint officiis ab adipisci quidem, numquam tenetur velit veniam, quod laborum accusantium deleniti voluptatum earum est.</textarea>    
                <h3>My Approach :</h3>
                <textarea id="approach-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Esse, tempora vitae expedita exercitationem possimus ratione nihil aspernatur quos? Repudiandae ab perferendis excepturi amet quaerat in nemo nostrum. Voluptatum, unde minus!Hic, delectus aliquid? Ratione voluptates illum necessitatibus perferendis voluptatum obcaecati voluptatibus, sit dicta repudiandae sint corrupti maiores sunt modi reiciendis ea alias iusto. Molestiae id similique quidem quasi, illum iure!</textarea>
            </div>    
            
            <div class="body-right"></div>
        </div>
    </div>
@endsection


<script>
document.addEventListener('DOMContentLoaded', async () => {
    const lockLink = document.getElementById('lock-link');
    if (lockLink) {
        try {
            // Fetch the current user's temp_pass state
            const userResponse = await fetch('/check-temp-pass', {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });
            const userData = await userResponse.json();

            // Dynamically update button text based on temp_pass existence
            lockLink.textContent = userData.temp_pass
                ? "Change Lock Password"
                : "Add Lock Password";

            // Attach click event listener
            lockLink.addEventListener('click', async (event) => {
                event.preventDefault(); // Prevent link default behavior

                const dialogTitle = userData.temp_pass
                    ? "Change Lock Password"
                    : "Add Lock Password";

                // Show SweetAlert
                const { value: password } = await Swal.fire({
                    title: dialogTitle,
                    input: "password",
                    inputLabel: "Password",
                    inputPlaceholder: "Enter your password",
                    inputAttributes: {
                        maxlength: "10",
                        autocapitalize: "off",
                        autocorrect: "off"
                    },
                    showCancelButton: true,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    confirmButtonText: "Submit",
                    cancelButtonText: "Cancel"
                });

                // Handle password submission
                if (password) {
                    const saveResponse = await fetch('/lock-rule', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({ temp_pass: password })
                    });

                    const result = await saveResponse.json();

                    if (saveResponse.ok) {
                        Swal.fire('Success', result.message, 'success');
                        // Update button text to "Change Lock Password" after successful addition
                        lockLink.textContent = "Change Lock Password";
                    } else {
                        Swal.fire('Error', result.message, 'error');
                    }
                }
            });
        } catch (error) {
            console.error("Error fetching temp_pass:", error);
            Swal.fire('Error', 'Unable to load user data. Please try again later.', 'error');
        }
    }
});

    // Function to save text from a textarea to localStorage
    function saveToLocalStorage(id) {
        const textarea = document.getElementById(id);
        if (textarea) {
            textarea.addEventListener('input', () => {
                localStorage.setItem(id, textarea.value);
            });
        }
    }

    // Function to load text from localStorage into a textarea
    function loadFromLocalStorage(id) {
        const textarea = document.getElementById(id);
        if (textarea) {
            const savedText = localStorage.getItem(id);
            if (savedText !== null) {
                textarea.value = savedText;
            }
        }
    }

    // Initialize for each textarea
    document.addEventListener('DOMContentLoaded', () => {
        const textareas = ['about-text', 'approach-text']; // Add IDs of all textareas
        textareas.forEach(id => {
            loadFromLocalStorage(id); // Load saved text
            saveToLocalStorage(id);  // Enable saving
        });
    });

</script>