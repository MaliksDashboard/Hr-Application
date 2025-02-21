@extends('layouts.master')
@section('title', 'Edit New Joiner')

@section('main')
    <div class="main add-emp add-joiner">
        <h1>Edit New Joiner</h1>

        <div class="container">
            <form action="{{ route('new-joiners.update', $newJoiner->id) }}" method="POST" enctype="multipart/form-data"
                class="container">
                @csrf
                @method('PUT')

                <div class="container-title">
                    <p>Update Joiner Details</p>
                    <small>Modify the details as needed 👌</small>
                </div>

                <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px;">
                    <div class="input-group">
                        <label for="name">Full Name <b style="color:red;">*</b></label>
                        <input type="text" name="name" id="name" value="{{ old('name', $newJoiner->name) }}"
                            required>
                        @error('name')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="job">Job Position <b style="color:red;">*</b></label>
                        <select name="job" id="job" required>
                            @foreach ($jobs as $job)
                                <option value="{{ $job }}" {{ $newJoiner->job == $job ? 'selected' : '' }}>
                                    {{ $job }}
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
                            <option value="full-time" {{ $newJoiner->mode == 'full-time' ? 'selected' : '' }}>Full-Time
                            </option>
                            <option value="part-time" {{ $newJoiner->mode == 'part-time' ? 'selected' : '' }}>Part-Time
                            </option>
                            <option value="internship" {{ $newJoiner->mode == 'internship' ? 'selected' : '' }}>Internship
                            </option>
                        </select>
                        @error('mode')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="start_date">Start Date <b style="color:red;">*</b></label>
                        <input type="date" name="start_date" id="start_date"
                            value="{{ old('start_date', $newJoiner->start_date) }}" required>
                        @error('start_date')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="btns">
                    <button type="submit" class="add">Update Joiner</button>
                    <a href="{{ route('new-joiners.index') }}" class="back">Cancel</a>
                </div>

            </form>
        </div>
    </div>
@endsection
