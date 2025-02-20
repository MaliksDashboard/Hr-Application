@extends('layouts.master')
@section('title', 'Create New Joiner')

@section('main')
    <div class="main add-emp add-new-joiner">
        <h1>Add New Joiner</h1>

        <div class="container">
            <form id="new-joiner-form" action="{{ route('new-joiners.store') }}" method="POST" enctype="multipart/form-data"
                class="container">
                @csrf

                <div class="container-title">
                    <p>Basic Form</p>
                    <small>Make sure you know what you are doing 👌</small>
                </div>

                <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px;">
                    <div class="input-group">
                        <label for="name">Full Name <b style="color:red;">*</b></label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required>
                        @error('name')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="mode">Mode <b style="color:red;">*</b></label>
                        <select name="mode" id="mode" required>
                            <option selected value="First Interview - Silva"
                                {{ old('mode') == 'First Interview - Silva' ? 'selected' : '' }}>First
                                Interview -
                                Silva</option>
                            <option value="To Start Training" {{ old('mode') == 'To Start Training' ? 'selected' : '' }}>To
                                Start
                                Training
                            </option>
                            <option value="Started Training" {{ old('mode') == 'Started Training' ? 'selected' : '' }}>
                                Started
                                Training
                            </option>
                            <option value="Godfather Training" {{ old('mode') == 'Godfather Training' ? 'selected' : '' }}>
                                Godfather
                                Training
                            </option>
                            <option value="Already Team Member"
                                {{ old('mode') == 'Already Team Member' ? 'selected' : '' }}>Already
                                Team Member
                            </option>
                        </select>
                        @error('mode')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px;">
                    <div class="input-group">
                        <label for="date_mode">Joining Date <b style="color:red;">*</b></label>
                        <input type="date" name="date_mode" id="date_mode" value="{{ old('date_mode') }}" required>
                        @error('date_mode')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="job">Job Title <b style="color:red;">*</b></label>
                        <select name="job" id="job" required>
                            <option value="">Select Job</option>
                            @foreach ($jobs as $job)
                                <option value="{{ $job }}" {{ old('job') == $job ? 'selected' : '' }}>
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
                        <label for="current_branch">Current Branch</label>
                        <select name="current_branch" id="current_branch">
                            <option value="">Select Branch</option>
                            @foreach ($branches as $branch)
                                <option value="{{ $branch->branch_name }}"
                                    {{ old('current_branch') == $branch->branch_name ? 'selected' : '' }}>
                                    {{ $branch->branch_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="input-group">
                    <label for="remarks">Remarks</label>
                    <textarea name="remarks" id="remarks" maxlength="255">{{ old('remarks') }}</textarea>
                    @error('remarks')
                        <span class="error-message" style="color:red;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="btns">
                    <button id="submit-new-joiner" type="submit" class="add">Submit New Joiner</button>
                    <button type="reset" class="clear">Clear</button>
                    <a href="{{ url('new-joiners') }}" class="back">Go Back</a>
                </div>

            </form>
        </div>
    </div>
@endsection


<script>
    document.addEventListener('DOMContentLoaded', () => {

        $(document).ready(function() {
            // Initialize Selectize for the #job field
            const selectize = $('#job').selectize({
                create: true, // Allow user to create new options
                sortField: 'text',
                placeholder: 'Select or type a job...', // Correct way to set placeholder
                maxItems: 1,
            });

            // Ensure the placeholder works correctly
            if (!selectize[0].selectize.getValue()) {
                selectize[0].selectize.$control_input.attr('placeholder', 'Select or type a job...');
            }
        });

        const branchDropdown = document.getElementById('current_branch');
        if (branchDropdown) {
            new Choices(branchDropdown, {
                removeItemButton: false,
                addItems: true,
                duplicateItemsAllowed: false,
                searchEnabled: true,
                placeholderValue: 'Select a branch...',
                noResultsText: 'No results found',
                noChoicesText: 'No titles available',
            });
        } else {
            console.error('Branch dropdown (#branch) not found in the DOM.');
        }
    })
</script>
