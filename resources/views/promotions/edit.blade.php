@extends('layouts.master')
@section('title', 'Edit Promotion')

@section('main')
    <div class="main add-emp add-promotion">
        <h1>Edit Promotion</h1>

        <div class="container">
            <form id="promotion-form" action="{{ route('promotions.update', $promotion->id) }}" method="POST"
                enctype="multipart/form-data" class="container">
                @csrf
                @method('PUT')

                <div class="container-title">
                    <p>Edit Form</p>
                    <small>Update the promotion details carefully 👌</small>
                </div>

                <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px;">
                    <div class="input-group">
                        <label for="employee_id">Employee <b style="color:red;">*</b></label>
                        <select name="employee_id" id="employee_id" disabled>
                            <option value="{{ $promotion->employee_id }}">
                                {{ $promotion->employee->name }}
                            </option>
                        </select>
                    </div>

                    <div class="input-group">
                        <label for="old_title">Old Title <b style="color:red;">*</b></label>
                        <input type="text" name="old_title" id="old_title" value="{{ $promotion->old_title }}" readonly>
                    </div>
                </div>

                <div style="display: flex; justify-content:space-between; width: 100%; gap: 20px;">
                    <div class="input-group">
                        <label for="new_title">New Title <b style="color:red;">*</b></label>
                        <select name="new_title" id="new_title">
                            <option value="">Select New Title</option>
                            @foreach ($titles as $title)
                                <option value="{{ $title->name }}"
                                    {{ $promotion->new_title == $title->name ? 'selected' : '' }}>
                                    {{ $title->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('new_title')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-group">
                        <label for="promotion_date">Promotion Date <b style="color:red;">*</b></label>
                        <input type="text" name="promotion_date" id="promotion_date" class="form-control"
                            value="{{ $promotion->promotion_date }}" readonly>
                    </div>
                </div>

                <div class="btns">
                    <button id="submit-promotion" type="submit" class="add">Update Promotion</button>
                    <a href="{{ route('promotions.index') }}" class="back">Go Back</a>
                </div>

            </form>
        </div>
    </div>
@endsection
