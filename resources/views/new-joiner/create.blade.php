@extends('layouts.master')
@section('title', 'Add New Joiner')
@section('custom_title', 'Add New Joiner')

@section('main')
    <div class="main add-emp add-joiner">

        <div class="container">
            <form action="{{ route('new-joiners.store') }}" method="POST" enctype="multipart/form-data" class="container">
                @csrf
                <div class="container-title">
                    <p>New Joiner Form</p>
                    <small>Fill in the details carefully 👌</small>
                </div>

                <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px; align-items: center">
                    <div class="input-group">
                        <label for="name">Full Name <b style="color:red;">*</b></label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required>
                        @error('name')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-group">
                        <label for="job">Job Position <b style="color:red;">*</b></label>
                        <select name="job" id="job" required>
                            <option value="">Select Job</option>
                            @foreach ($jobs as $job)
                                <option value="{{ $job->name }}" {{ old('job') == $job->name ? 'selected' : '' }}>
                                    {{ $job->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('job')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px;">
                    <div class="input-group">
                        <label for="mode">Hiring Mode <b style="color:red;">*</b></label>
                        <select name="mode" id="mode" required>
                            <option value="full-time" {{ old('mode') == 'full-time' ? 'selected' : '' }}>Full-Time</option>
                            <option value="part-time" {{ old('mode') == 'part-time' ? 'selected' : '' }}>Part-Time</option>
                            <option value="internship" {{ old('mode') == 'internship' ? 'selected' : '' }}>Internship
                            </option>
                        </select>
                        @error('mode')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="start_date">Start Date <b style="color:red;">*</b></label>
                        <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}" required>
                        @error('start_date')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px;">
                    <div class="input-group">
                        <label for="target_branch">Target Branch<b style="color:red;">*</b></label>
                        <input type="text" name="target_branch" id="target_branch" value="{{ old('target_branch') }}">
                        @error('target_branch')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="interview_time">Interview Time<b style="color:red;">*</b></label>
                        <input type="text" name="interview_time" id="interview_time"
                            value="{{ old('interview_time') }}">
                        @error('interview_time')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="btns">
                    <button type="submit" class="add">Add Joiner</button>
                    <button type="reset" class="clear">Clear</button>
                    <a href="{{ route('new-joiners.index') }}" class="back">Go Back</a>
                </div>

            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {

            const jobInput = new Choices('#job', {
                removeItemButton: false,
                addItems: true,
                duplicateItemsAllowed: false,
                searchEnabled: true,
                placeholderValue: 'Select a job...',
                noResultsText: 'No results found',
                noChoicesText: 'No choices available',
                addItemFilter: function(value) {
                    return value.trim() !== '';
                },
            });
        })
    </script>

@endsection
