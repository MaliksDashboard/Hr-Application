@extends('layouts.master')
@section('title', 'Jobs')
@section('custom_title', 'Jobs Management')

<meta name="csrf-token" content="{{ csrf_token() }}">

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
        @can('Create')
            <a href="{{ url('jobs/create') }}" class="add-btn">Add Job</a>
        @endcan

        <div class="container titles">
            <form id="search-form">
                <input type="text" id="search" placeholder="Search Here">
            </form>

            <ul id="title-list">
                @foreach ($jobs as $job)
                    <li data-id="{{ $job->id }}">
                        <span>{{ $job->name }} ({{ ucfirst($job->department->name ?? 'No Department') }})</span>
                        <div style="display: flex; gap:5px">

                            @can('Edit')
                                <a href="{{ url('jobs/' . $job->id . '/edit') }}" class="edit-btn">
                                    <svg viewBox="0 0 24 24" version="1.2" baseProfile="tiny"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="m21.561 5.318-2.879-2.879A1.5 1.5 0 0 0 17.621 2c-.385 0-.768.146-1.061.439L13 6H4a1 1 0 0 0-1 1v13a1 1 0 0 0 1 1h13a1 1 0 0 0 1-1v-9l3.561-3.561c.293-.293.439-.677.439-1.061s-.146-.767-.439-1.06M11.5 14.672 9.328 12.5l6.293-6.293 2.172 2.172zm-2.561-1.339 1.756 1.728L9 15zM16 19H5V8h6l-3.18 3.18c-.293.293-.478.812-.629 1.289-.16.5-.191 1.056-.191 1.47V17h3.061c.414 0 1.108-.1 1.571-.29.464-.19.896-.347 1.188-.64L16 13zm2.5-11.328L16.328 5.5l1.293-1.293 2.171 2.172z" />
                                    </svg>
                                </a>
                            @endcan

                            @can('Delete')
                                <form id="delete-form-{{ $job->id }}" action="{{ route('jobs.destroy', $job->id) }}"
                                    method="POST" style="display:none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <button class="delete-btn" data-id="{{ $job->id }}">
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
    </div>

@endsection

<style>
    input[type="text"],
    input[type="datetime-local"] {
        width: 100% !important;
    }
</style>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        console.log("Script loaded successfully.");

        // Live Search
        document.getElementById("search").addEventListener("input", function() {
            let filter = this.value.toLowerCase();
            let jobs = document.querySelectorAll("#title-list li");

            jobs.forEach(job => {
                let jobName = job.querySelector("span").textContent.toLowerCase();
                job.style.display = jobName.includes(filter) ? "" : "none";
            });
        });

        // Delete with SweetAlert2
        document.querySelectorAll(".delete-btn").forEach(button => {
            button.addEventListener("click", function() {
                let jobId = this.getAttribute("data-id");
                let form = document.getElementById(`delete-form-${jobId}`);

                Swal.fire({
                    title: "Are you sure?",
                    text: "This job will be permanently deleted!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

    });
</script>
