@extends('layouts.master')
@section('title', 'Add Job')
@section('custom_title', 'Add Job')

@section('main')

    <div class="main add-emp">

        <div class="container">
            <form action="{{ route('jobs.store') }}" method="POST" enctype="multipart/form-data" class="container">
                @csrf
                <div class="container-title">
                    <p>Basic Form</p>
                    <small>Make sure you know what you are doing 👌</small>
                </div>

                <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px;">
                    <div class="input-group">
                        <label for="name">Job Name <b style="color:red;">*</b></label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required>
                        @error('name')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="dept_id">Department Belongs to <b style="color:red;">*</b></label>
                        <select name="dept_id" id="dept_id">
                            <option value="" disabled selected>Select a manager...</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}"
                                    {{ old('dept_id') == $department->id ? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('dept_id')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                <div class="btns">
                    <button type="submit" class="add">Add Record</button>
                    <button type="reset" class="clear">Clear</button>
                    <a href="{{ route('jobs.index') }}" class="back">Go Back</a>
                </div>

            </form>
        </div>
    </div>

@endsection


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const selectHead = new Choices('#dept_id', {
            removeItemButton: false,
            addItems: true,
            duplicateItemsAllowed: false,
            searchEnabled: true,
            placeholderValue: 'Select a manager...',
            noResultsText: 'No results found',
            noChoicesText: 'No choices available',
            addItemFilter: function(value) {
                return value.trim() !== ''; // Prevent adding empty items
            },
        })
    })
</script>
