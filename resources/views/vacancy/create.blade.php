@extends('layouts.master')
@section('title', 'Add Vacancy')
@section('custom_title', 'Add Vacacny')

@section('main')
    <div class="main add-vacancy">

        <div class="container">
            <form action="{{ route('vacancies.store') }}" method="POST" enctype="multipart/form-data" class="container">
                @csrf
                <div class="container-title">
                    <p>Vacancy Form</p>
                    <small>Fill out the form carefully before submitting 👌</small>
                </div>

                <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px;">
                    <div class="input-group">
                        <label for="branch_id">Branch Name <b style="color:red;">*</b></label>
                        <select class="form-control" name="branch_id" id="branch_id" required>
                            <option value="" disabled selected>Please Select Branch</option>
                            @foreach ($branches as $branch)
                                <option value="{{ $branch->id }}" {{ old('branch_id') == $branch->id ? 'selected' : '' }}>
                                    {{ $branch->branch_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('branch_id')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="job">Job <b style="color:red;">*</b></label>
                        <select id="job" name="job" class="form-control" required>
                            <option value="" disabled selected>Select or type a job...</option> <!-- Placeholder -->
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
                        <label for="asked_date">Asked Date<b style="color:red;">*</b></label>
                        <input type="date" name="asked_date" id="asked_date"
                            value="{{ old('asked_date', date('Y-m-d')) }}" required>
                        @error('asked_date')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="status">Priority <b style="color:red;">*</b></label>
                        <select id="status" name="status" class="form-control" required>
                            <option value="" disabled selected>Select Priority</option>
                            <option value="low" {{ old('status') == 'low' ? 'selected' : '' }}>Low</option>
                            <option value="medium" {{ old('status') == 'medium' ? 'selected' : '' }}>Medium</option>
                            <option value="high" {{ old('status') == 'high' ? 'selected' : '' }}>High</option>
                        </select>
                        @error('status')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="input-group">
                    <label for="remarks">Remarks</label>
                    <textarea name="remarks" id="remarks" class="form-control" rows="4">{{ old('remarks') }}</textarea>
                    @error('remarks')
                        <span class="error-message" style="color:red;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="btns">
                    <button type="submit" class="add">Add Vacancy</button>
                    <button type="reset" class="clear">Clear</button>
                    <a href="{{ route('vacancies.index') }}" class="back">Go Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const branchName = document.getElementById('branch_id');

        const nameSelect = new Choices(branchName, {
            removeItemButton: false,
            addItems: true,
            duplicateItemsAllowed: false,
            searchEnabled: true,
            placeholderValue: 'Select a branch...',
            noResultsText: 'No results found',
            noChoicesText: 'No choices available',

        });

        const job = document.getElementById('job');
        const jobSelect = new Choices(job, {
            removeItemButton: false,
            addItems: true,
            duplicateItemsAllowed: false,
            searchEnabled: true,
            noResultsText: 'No results found',
            noChoicesText: 'No choices available',
        });
    })
</script>
