@extends('layouts.master')
@section('title', 'Add Evaluation Rule')
@section('custom_title', 'Add Evaluation Rule')

@section('main')
    <div class="main add-emp">
        <div class="container">
            <form action="{{ route('evaluation-chains.store') }}" method="POST" class="container">
                @csrf
                <div class="container-title">
                    <p>Add New Evaluation Rule</p>
                    <small>Define who evaluates whom 🎯</small>
                </div>

                <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px;">
                    <div class="input-group">
                        <label for="evaluator_role">Evaluator Role <b style="color:red;">*</b></label>
                        <select name="evaluator_role" required>
                            <option disabled selected value="">Select Evaluator</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role }}">{{ $role }}</option>
                            @endforeach
                        </select>
                        @error('evaluator_role')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="target_role">Target Role <b style="color:red;">*</b></label>
                        <select name="target_role" required>
                            <option disabled selected value="">Select Target</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role }}">{{ $role }}</option>
                            @endforeach
                        </select>
                        @error('target_role')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px;">
                    <div class="input-group">
                        <label for="job_id">Target Job (Optional)</label>
                        <select name="job_id">
                            <option value="">--</option>
                            @foreach ($jobs as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-group">
                        <label for="department_id">Target Department (Optional)</label>
                        <select name="department_id">
                            <option value="">--</option>
                            @foreach ($departments as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px;">
                    <div class="input-group">
                        <label for="priority">Priority <b style="color:red;">*</b></label>
                        <input type="number" name="priority" min="1" required value="{{ old('priority') }}">
                        @error('priority')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="skip_if_done_by_higher">Skip if higher already evaluated?</label>
                        <select name="skip_if_done_by_higher">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>
                </div>

                <div class="btns">
                    <button type="submit" class="add">Add Rule</button>
                    <button type="reset" class="clear">Clear</button>
                    <a href="{{ route('evaluation-chains.index') }}" class="back">Go Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection
