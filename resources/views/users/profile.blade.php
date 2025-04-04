@extends('layouts.master')
@section('title', 'Profile')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('custom_title', 'Profile')

@php
    use Carbon\Carbon;
    use Illuminate\Support\Str;

    $canUpdateImage = false;
    $hiredDatee = $user->employee?->date_hired;

    $experienceText = 'N/A';

    if ($hiredDatee) {
        $hiredAt = Carbon::parse($hiredDatee);
        $now = Carbon::now();

        $years = $hiredAt->diff($now)->y;
        $months = $hiredAt->diff($now)->m;

        if ($years >= 1) {
            $experienceText = $years . ' ' . Str::plural('year', $years);
            if ($months > 0) {
                $experienceText .= ' & ' . $months . ' ' . Str::plural('month', $months);
            }
        } else {
            $experienceText = $months . ' ' . Str::plural('month', $months);
        }

        $canUpdateImage = $years >= 1;
    }

    $jobTitle = $user->employee?->title ?? 'N/A';

@endphp

@section('main')

    <div class="main">
        <div class="profile-top">
            <div class="profile-info">
                <div class="imgs">
                    <img src="/images/profile-cover.jpg" alt="Cover">
                    <img id="mainProfileImage" src="{{ asset('storage/' . $user->image) }}" alt="{{ $user->name }}">
                </div>
                <div class="profile-name">
                    <div style="margin-top: 10px;" class="name-title flex flex-row justify-center items-center gap-2">
                        <p class="text-[22px] text-[var(--primary-color)]">{{ $user->name }}</p> ✅

                        @if ($canUpdateImage)
                            <button id="changeImageBtn"
                                class="ml-4 px-3 py-1.5 text-sm rounded-md text-white transition duration-200"
                                style="background-color: #f56b2c;">
                                Change Picture
                            </button>
                        @else
                            <button onclick="notAllowedYet()" id=""
                                class="ml-4 px-3 py-1.5 text-sm rounded-md text-white transition duration-200"
                                style="background-color: #f56b2c;">
                                Change Picture
                            </button>
                        @endif

                    </div>

                    <div style="display: flex; gap: 10px; justify-content: center;align-items: center"> <a
                            href="{{ url('/home') }}">Home</a>
                        <a id="lock-link"
                            style="display: flex; justify-content: center;align-items: center; gap: 10px; background-color: var(--light-color);color:var(--primary-color); font-weight: bold;"
                            href="">
                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M17 9V7A5 5 0 0 0 7 7v2a3 3 0 0 0-3 3v7a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3v-7a3 3 0 0 0-3-3M9 7a3 3 0 0 1 6 0v2H9Zm9 12a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1v-7a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1Z" />
                            </svg>
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
                            <p>+{{ $experienceText }} of Experience</p>
                            <p>{{ $jobTitle }}</p>
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
                <h3 class="profile-title">Personal Information</h3>
                <span class="line"></span>

                <div class="info-columns">
                    <div class="info-row"><strong>Name:</strong><span>{{ $user->name }}</span></div>
                    <div class="info-row"><strong>Email:</strong><span>{{ $user->email }}</span></div>
                    <div class="info-row"><strong>PIN Code:</strong><span>{{ $user->pin_code }}</span></div>
                    <div class="info-row"><strong>Status:</strong><span>{{ $user->status ? 'Active' : 'Inactive' }}</span>
                    </div>
                    <div class="info-row">
                        <strong>Job:</strong><span>{{ $user->employee->jobRelation->name ?? 'N/A' }}</span>
                    </div>
                    <div class="info-row"><strong>Branch
                            ID:</strong><span>{{ $user->employee->branch->branch_name ?? 'N/A' }}</span></div>

                    @if ($user->employee)
                        <div class="info-row"><strong>Phone:</strong><span>{{ $user->employee->phone }}</span></div>
                        <div class="info-row"><strong>Address:</strong><span>{{ $user->employee->address }}</span></div>
                        <div class="info-row"><strong>Title:</strong><span>{{ $user->employee->title }}</span></div>
                        <div class="info-row"><strong>Date Hired:</strong><span>{{ $user->employee->date_hired }}</span>
                        </div>
                        <div class="info-row"><strong>Blood Type:</strong><span>{{ $user->employee->blood_type }}</span>
                        </div>
                        <div class="info-row"><strong>Birthday:</strong><span>{{ $user->employee->birthday }}</span></div>
                        <div class="info-row"><strong>Marital
                                Status:</strong><span>{{ $user->employee->marital_status }}</span></div>
                        <div class="info-row"><strong>Car:</strong><span>{{ $user->employee->car ? 'Yes' : 'No' }}</span>
                        </div>
                    @else
                        <div class="info-row full-width">No additional employee info available.</div>
                    @endif
                </div>
            </div>

            <div class="body-left">
                <h3>About (Write what you think)</h3>
                <textarea id="about-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae, quod impedit! Ducimus ad itaque vero veritatis unde, magnam nulla libero repellat quo nihil aut a mollitia assumenda, nobis aperiam similique?Laboriosam odit vero quasi perferendis omnis obcaecati sequi dolorem doloremque at. Voluptates omnis consequuntur sint officiis ab adipisci quidem, numquam tenetur velit veniam, quod laborum accusantium deleniti voluptatum earum est.</textarea>
            </div>
        </div>

    </div>

    <!-- Upload Image Modal -->
    <div id="uploadModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div id="uploadModalContent" class="bg-white rounded-md p-6 w-full max-w-md relative">
            <h2 class="text-lg font-semibold mb-4 text-gray-700">Update Profile Picture</h2>

            <form id="uploadForm" enctype="multipart/form-data">
                @csrf

                <input type="file" id="imageInput" name="image"
                    class="mb-4 w-full border border-gray-300 rounded-md px-3 py-2 text-sm" accept="image/*" required>

                <div class="mb-4">
                    <p class="text-sm text-gray-500 mb-2">Preview:</p>
                    <img id="previewImage" src="{{ asset('storage/images/default.jpg') }}" alt="Image preview"
                        class="w-32 h-32 object-cover rounded-full border border-gray-300 mx-auto" />
                </div>

                <div class="flex justify-end gap-2 bg-white pt-4">
                    <button type="button" onclick="closeUploadModal()"
                        class="px-4 py-2 text-sm font-semibold bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 shadow">
                        Cancel
                    </button>

                    <button type="submit"
                        class="px-4 py-2 text-sm font-semibold bg-sky-500 text-white rounded-md hover:bg-sky-600 shadow-md transition duration-200">
                        Update
                    </button>
                </div>

            </form>
        </div>
    </div>



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
                    lockLink.textContent = userData.temp_pass ?
                        "Change Lock Password" :
                        "Add Lock Password";

                    // Attach click event listener
                    lockLink.addEventListener('click', async (event) => {
                        event.preventDefault(); // Prevent link default behavior

                        const dialogTitle = userData.temp_pass ?
                            "Change Lock Password" :
                            "Add Lock Password";

                        // Show SweetAlert
                        const {
                            value: password
                        } = await Swal.fire({
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
                                    'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]').content
                                },
                                body: JSON.stringify({
                                    temp_pass: password
                                })
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

        function notAllowedYet() {
            Swal.fire({
                title: 'Not Allowed Yet',
                text: 'You can only change your picture after 1 year of joining! Please contact the HR Department',
                imageUrl: '/images/cat.gif',
                imageWidth: 250,
                imageHeight: 200,
                imageAlt: 'Cute cat',
                confirmButtonText: 'Okay 😿',
            });
        }


        document.addEventListener('DOMContentLoaded', () => {
            const changeImageBtn = document.getElementById('changeImageBtn');
            if (changeImageBtn) {
                changeImageBtn.addEventListener('click', () => {
                    document.getElementById('uploadModal').classList.remove('hidden');
                    document.getElementById('imageInput').value = '';
                });
            }
        });

        function closeUploadModal() {
            document.getElementById('uploadModal').classList.add('hidden');
        }



        // 🖼️ Show image preview when selected
        document.addEventListener('DOMContentLoaded', () => {
            const imageInput = document.getElementById('imageInput');
            const previewImage = document.getElementById('previewImage');
            const DEFAULT_IMAGE = "{{ asset('storage/images/default.jpg') }}";
            console.log("🚀 Upload form script loaded");

            imageInput?.addEventListener('change', function(e) {
                const file = e.target.files[0];

                if (!file) {
                    previewImage.src = DEFAULT_IMAGE;
                    return;
                }

                const maxSizeMB = 2;
                if (file.size > maxSizeMB * 1024 * 1024) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Too Large!',
                        text: `Image must be less than ${maxSizeMB} MB.`,
                    });
                    e.target.value = '';
                    previewImage.src = DEFAULT_IMAGE;
                    return;
                }

                const reader = new FileReader();

                reader.onload = function(event) {
                    previewImage.src = event.target.result;
                };

                reader.readAsDataURL(file);
            });
        });



        document.getElementById('uploadForm')?.addEventListener('submit', function(e) {
            e.preventDefault();
            console.log("🧠 FORM SUBMIT TRIGGERED");

            const form = e.target;
            const formData = new FormData(form);

            fetch("{{ route('profile.upload.image') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
                    },
                    body: formData,
                })
                .then(res => res.json())
                .then(data => {
                    console.log("✅ Upload success", data);
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Updated!',
                            text: data.message,
                        });

                        if (data.image_url) {
                            document.querySelector('#mainProfileImage')?.setAttribute('src', data.image_url +
                                '?t=' + new Date().getTime());
                        }

                        closeUploadModal();
                    } else {
                        throw new Error('Upload failed.');
                    }
                })
                .catch(error => {
                    console.error("❌ Upload error", error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: error.message || 'Something went wrong.',
                    });
                });
        });
    </script>

@endsection


<style>
    #previewImage {
        transition: opacity 0.3s ease;
    }

    button[type="submit"] {
        background-color: #0ea5e9 !important;
        /* Tailwind's sky-500 */
        color: white !important;
    }
</style>
