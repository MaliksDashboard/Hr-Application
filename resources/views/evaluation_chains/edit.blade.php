@extends('layouts.master')
@section('title', 'Edit Evaluation Rule')
@section('custom_title', 'Edit Evaluation Rule')

@section('main')
    <div class="main add-emp">
        <div class="container">
            <form action="{{ route('evaluation-chains.update', $evaluationChain->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="container-title">
                    <p>Edit Evaluation Rule</p>
                    <small>Update evaluator logic 🎯</small>
                </div>

                <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px;">
                    <div class="input-group">
                        <label for="evaluator_role">Evaluator Role <b style="color:red;">*</b></label>
                        <select name="evaluator_role" required>
                            @foreach ($roles as $role)
                                <option value="{{ $role }}"
                                    {{ $evaluationChain->evaluator_role === $role ? 'selected' : '' }}>{{ $role }}
                                </option>
                            @endforeach
                        </select>
                        @error('evaluator_role')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="target_role">Target Role <b style="color:red;">*</b></label>
                        <select name="target_role" required>
                            @foreach ($roles as $role)
                                <option value="{{ $role }}"
                                    {{ $evaluationChain->target_role === $role ? 'selected' : '' }}>{{ $role }}
                                </option>
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
                                <option value="{{ $id }}"
                                    {{ $evaluationChain->job_id == $id ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-group">
                        <label for="department_id">Target Department (Optional)</label>
                        <select name="department_id">
                            <option value="">--</option>
                            @foreach ($departments as $id => $name)
                                <option value="{{ $id }}"
                                    {{ $evaluationChain->department_id == $id ? 'selected' : '' }}>{{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px;">
                    <div class="input-group">
                        <label for="priority">Priority <b style="color:red;">*</b></label>
                        <input type="number" name="priority" min="1" required
                            value="{{ old('priority', $evaluationChain->priority) }}">
                        @error('priority')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="skip_if_done_by_higher">Skip if higher already evaluated?</label>
                        <select name="skip_if_done_by_higher">
                            <option value="0" {{ !$evaluationChain->skip_if_done_by_higher ? 'selected' : '' }}>No
                            </option>
                            <option value="1" {{ $evaluationChain->skip_if_done_by_higher ? 'selected' : '' }}>Yes
                            </option>
                        </select>
                    </div>
                </div>

                <div class="btns">
                    <button type="submit" class="add">Update</button>
                    <a href="{{ route('evaluation-chains.index') }}" class="back">Go Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection
