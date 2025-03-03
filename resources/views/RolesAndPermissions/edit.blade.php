@extends('layouts.master')
@section('title', 'Edit Role')
@section('custom_title', 'Edit Role')

@section('main')
    <div class="main add-emp">

        <div class="container">
            <form action="{{ route('roles.update', $role->id) }}" method="POST">
                @csrf
                @method('PUT') <!-- This tells Laravel it's an update request -->

                <div class="input-group">
                    <label for="name">Role Name <b style="color:red;">*</b></label>
                    <input type="text" name="name" id="name" value="{{ old('name', $role->name ?? '') }}" required>
                </div>

                <div class="input-group">
                    <label for="permissions">Assign Permissions <b style="color:red;">*</b></label>
                    <select class="form-control" name="permission[]" id="choices-multiple-remove-button" multiple required>
                        @foreach ($permissions as $permission)
                            <option value="{{ $permission->name }}"
                                {{ in_array($permission->name, old('permission', $role->permissions->pluck('name')->toArray())) ? 'selected' : '' }}>
                                {{ $permission->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Update Role</button>
            </form>

        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
            removeItemButton: true,
            searchEnabled: true,
            placeholderValue: 'Select Permissions',
            itemSelectText: '',
            duplicateItems: false,
        });
    });
</script>
