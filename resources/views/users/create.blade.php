@extends('layouts.master')
@section('title', 'Add User')

@section('main')
    <div class="main add-emp">
        <h1>Add User</h1>

        <div class="container">
            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data" class="container">
                @csrf
                <div class="container-title">
                    <p>Basic Form</p>
                    <small>Make sure you know what you are doing 👌</small>
                </div>

                <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px;">
                    <div class="input-group">
                        <label for="name">Name <b style="color:red;">*</b></label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required>
                        @error('name')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="email">Email <b style="color:red;">*</b></label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required>
                        @error('email')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px;">
                    <div class="input-group">
                        <label for="password">Password <b style="color:red;">*</b></label>
                        <input type="password" name="password" id="password" required>
                        @error('password')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="status">Status <b style="color:red;">*</b></label>
                        <select name="status" id="status" required>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px;">
                    <div class="input-group">
                        <label for="role_name">Role <b style="color:red;">*</b></label>
                        <select name="role_name" id="role_name" required>
                            <option value="">Select Role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}"
                                    {{ old('role_name') == $role->name ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('role_name')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="image">Profile Image</label>
                        <input type="file" name="image" id="image" accept="image/*">
                        @error('image')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="btns">
                    <button type="submit" class="add">Add User</button>
                    <button type="reset" class="clear">Clear</button>
                    <a href="{{ route('users.index') }}" class="back">Go Back</a>
                </div>

            </form>
        </div>
    </div>
@endsection
