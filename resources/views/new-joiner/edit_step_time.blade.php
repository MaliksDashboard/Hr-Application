@extends('layouts.master')
@section('title', 'Edit The Step Time')
@section('custom_title', 'Edit the Step Time')

@section('main')
    <div class="main add-emp add-joiner">
        <h1>Edit Step Time</h1>

        <div class="container">
            <form action="{{ route('update.step.time', $step->id) }}" method="POST" enctype="multipart/form-data"
                class="container">
                @csrf
                @method('PUT')

                <input type="hidden" name="id" value="{{ $step->id }}">
                <div class="container-title">
                    <p>Update The time of the Step</p>
                    <small>Modify the details as needed 👌</small>
                </div>

                <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px;">
                    <div class="input-group">
                        <label for="interview_time">Full Name <b style="color:red;">*</b></label>
                        <input type="text" name="interview_time" id="interview_time"
                            value="{{ old('interview_time', $step->interview_time) }}" required>
                        @error('interview_time')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="btns">
                    <button type="submit" class="add">Update Time</button>
                    <a href="{{ route('new-joiners.index') }}" class="back">Cancel</a>
                </div>

            </form>
        </div>
    </div>


@endsection
