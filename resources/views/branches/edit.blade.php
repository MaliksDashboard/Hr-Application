@extends('layouts.master')
@section('title', 'Edit Branch')
@section('custom_title', 'Edit Branch')

@section('main')
    <div class="main add-emp">

        <div class="container">
            <form action="{{ route('branches.update', $branch->id) }}" method="POST" enctype="multipart/form-data"
                class="container">
                @csrf
                @method('PUT')
                <div class="container-title">
                    <p>Basic Form</p>
                    <small>Make sure you know what you are doing 👌</small>
                </div>

                <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px;">
                    <div class="input-group">
                        <label for="branch_name">Branch Name <b style="color:red;">*</b></label>
                        <input type="text" name="branch_name" id="branch_name"
                            value="{{ old('name', $branch->branch_name) }}" required>
                        @error('branch_name')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="location">Location <b style="color:red;">*</b></label>
                        <input type="text" name="location" id="location"
                            value="{{ old('location', $branch->location) }}" required>
                        @error('location')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px;">

                    <div class="input-group">
                        <label for="manager_email">Manager Email <b style="color:red;">*</b></label>
                        <input type="email" name="manager_email" id="manager_email"
                            value="{{ old('manager_email', $branch->manager_email) }}">
                        @error('manager_email')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="services_gmail">Services Email <b style="color:red;">*</b></label>
                        <input type="email" name="services_gmail" id="services_gmail"
                            value="{{ old('services_gmail', $branch->services_gmail) }}">
                        @error('services_gmail')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px;">

                    <div class="input-group">
                        <label for="latitude">Latitude<b style="color:red;">*</b></label>
                        <input type="text" name="latitude" id="latitude"
                            value="{{ old('latitude', $branch->latitude) }}">
                        @error('latitude')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="longitude">Longitude<b style="color:red;">*</b></label>
                        <input type="text" name="longitude" id="longitude"
                            value="{{ old('longitude', $branch->longitude) }}">
                        @error('longitude')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="btns">
                    <button type="submit" class="add">Update Record</button>
                    <button type="reset" class="clear">Clear</button>
                    <a href="{{ route('branches.index') }}" class="back">Go Back</a>
                </div>

            </form>
        </div>
    </div>
@endsection
