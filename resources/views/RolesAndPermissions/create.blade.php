@extends('layouts.master')
@section('title', 'Create Role')


@section('main')
    <div class="main add-emp">
        <h1>Add Role</h1>

        <div class="container">
            <form action="{{ route('roles.store') }}" method="POST" class="container">
                @csrf
                <div class="container-title">
                    <p>Role Creation Form</p>
                    <small>Assign a role with permissions 👌</small>
                </div>

                <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px;">
                    <div class="input-group">
                        <label for="name">Role Name <b style="color:red;">*</b></label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required>
                        @error('name')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="input-group">
                    <label for="permissions">Assign Permissions <b style="color:red;">*</b></label>
                    <div class="control">
                        <select class="form-control" name="permission[]" id="choices-multiple-remove-button" multiple
                            required>
                            @foreach ($permissions as $permission)
                                <option value="{{ $permission->name }}"
                                    {{ in_array($permission->name, old('permission', [])) ? 'selected' : '' }}>
                                    {{ $permission->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('permission')
                        <span class="error-message" style="color:red;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="btns">
                    <button type="submit" class="add">Add Role</button>
                    <button type="reset" class="clear">Clear</button>
                    <a href="{{ route('roles.index') }}" class="back">Go Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
            removeItemButton: true, // Allows removing the selected options
            searchEnabled: true, // Enables searching through the options
            placeholderValue: 'Select Permissions', // Placeholder for the select box
            itemSelectText: '', // No "Select" text on item
            duplicateItems: false, // Prevents selecting the same item twice
        });
    });
</script>
