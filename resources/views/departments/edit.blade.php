@extends('layouts.master')
@section('title', 'Edit Department')
@section('custom_title', 'Edit Department')

@section('main')

    <div class="main add-emp">

        <div class="container">
            <form action="{{ route('departments.update', $department->id) }}" method="POST" enctype="multipart/form-data"
                class="container">
                @csrf
                @method('PUT')

                <div class="container-title">
                    <p>Edit Department</p>
                    <small>Make sure you know what you are doing 👌</small>
                </div>

                <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px;">
                    <div class="input-group">
                        <label for="name">Department Name <b style="color:red;">*</b></label>
                        <input type="text" name="name" id="name" value="{{ old('name', $department->name) }}"
                            required>
                        @error('name')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="head_of_dept_id">Head of Dept <b style="color:red;">*</b></label>
                        <select name="head_of_dept_id" id="head_of_dept_id">
                            <option value="" disabled>Select a manager...</option>
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}"
                                    {{ old('head_of_dept_id', $department->head_of_dept_id) == $employee->id ? 'selected' : '' }}>
                                    {{ $employee->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('head_of_dept_id')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="btns">
                    <button type="submit" class="add">Update Record</button>
                    <button type="reset" class="clear">Clear</button>
                    <a href="{{ route('departments.index') }}" class="back">Go Back</a>
                </div>

            </form>
        </div>
    </div>

@endsection

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const selectElement = document.querySelector('#head_of_dept_id');

        if (selectElement) {
            new Choices(selectElement, {
                removeItemButton: false,
                searchEnabled: true,
                placeholderValue: 'Select a manager...',
                noResultsText: 'No results found',
                noChoicesText: 'No choices available',
            });
        }
    });
</script>
