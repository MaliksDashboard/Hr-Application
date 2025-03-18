@extends('layouts.master')
@section('title', 'Edit New Joiner')

@section('main')
    <div class="main add-emp add-joiner">
        <h1>Edit New Joiner</h1>



        <div class="container">
            <div class="add-employee-controller tab-controller">
                <p data-step="1" class="active">Personal Information</p>
                <p data-step="2">Reference Data</p>
            </div>

            <form action="{{ route('new-joiners.update', $newJoiner->id) }}" method="POST" enctype="multipart/form-data"
                class="container">
                @csrf
                @method('PUT')

                <div class="form-section" data-section="1">

                    <div class="container-title">
                        <p>Update Joiner Details</p>
                        <small>Modify the details as needed 👌</small>
                    </div>

                    <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px;">
                        <div class="input-group">
                            <label for="name">Full Name <b style="color:red;">*</b></label>
                            <input type="text" name="name" id="name" value="{{ old('name', $newJoiner->name) }}"
                                required>
                            @error('name')
                                <span class="error-message" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="input-group">
                            <label for="job">Job Position <b style="color:red;">*</b></label>
                            <select name="job" id="job" required>
                                <option value="">Select Job</option>
                                @foreach ($jobs as $job)
                                    <option value="{{ $job->name }}"
                                        {{ old('job', $newJoiner->job) == $job->name ? 'selected' : '' }}>
                                        {{ $job->name }}
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
                            <label for="mode">Hiring Mode <b style="color:red;">*</b></label>
                            <select name="mode" id="mode" required>
                                <option value="full-time" {{ $newJoiner->mode == 'full-time' ? 'selected' : '' }}>Full-Time
                                </option>
                                <option value="part-time" {{ $newJoiner->mode == 'part-time' ? 'selected' : '' }}>Part-Time
                                </option>
                                <option value="internship" {{ $newJoiner->mode == 'internship' ? 'selected' : '' }}>
                                    Internship
                                </option>
                            </select>
                            @error('mode')
                                <span class="error-message" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="input-group">
                            <label for="start_date">Start Date <b style="color:red;">*</b></label>
                            <input type="date" name="start_date" id="start_date"
                                value="{{ old('start_date', $newJoiner->start_date) }}" required>
                            @error('start_date')
                                <span class="error-message" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px;">
                        <div class="input-group">
                            <label for="target_branch">Target Branch<b style="color:red;">*</b></label>
                            <input type="text" name="target_branch" id="target_branch"
                                value="{{ old('target_branch', $newJoiner->target_branch) }}">
                            @error('target_branch')
                                <span class="error-message" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                </div>

                {{-- Reference Data --}}
                <div class="form-section" data-section="2" style="display:none;">
                    <div class="container-title">
                        <p>Reference Data</p>
                        <small>Add or Update References for this joiner 👌</small>
                    </div>

                    <div style="display: flex; flex-direction: column; gap: 15px; width: 100%;">

                        <div class="input-group">
                            <label for="company_name">Company Name <b style="color:red;">*</b></label>
                            <input type="text" name="company_name" id="company_name"
                                value="{{ old('company_name', $reference->company_name ?? '') }}">
                            @error('company_name')
                                <span class="error-message" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="input-group">
                            <label for="contact_name">Contact Name <b style="color:red;">*</b></label>
                            <input type="text" name="contact_name" id="contact_name"
                                value="{{ old('contact_name', $reference->contact_name ?? '') }}">
                            @error('contact_name')
                                <span class="error-message" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="input-group">
                            <label for="phone">Phone <b style="color:red;">*</b></label>
                            <input type="text" name="phone" id="phone"
                                value="{{ old('phone', $reference->phone ?? '') }}">
                            @error('phone')
                                <span class="error-message" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="input-group">
                            <label for="position">Position <b style="color:red;">*</b></label>
                            <input type="text" name="position" id="position"
                                value="{{ old('position', $reference->position ?? '') }}">
                            @error('position')
                                <span class="error-message" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="input-group">
                            <label for="have_recommendation_letter">Has Recommendation Letter?</label>
                            <select name="have_recommendation_letter" id="have_recommendation_letter">
                                <option value="1"
                                    {{ old('have_recommendation_letter', $reference->have_recommendation_letter ?? '') == '1' ? 'selected' : '' }}>
                                    Yes</option>
                                <option value="0"
                                    {{ old('have_recommendation_letter', $reference->have_recommendation_letter ?? '') == '0' ? 'selected' : '' }}>
                                    No</option>
                            </select>
                            @error('have_recommendation_letter')
                                <span class="error-message" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="input-group">
                            <label for="feedback">Feedback (optional)</label>
                            <textarea name="feedback" id="feedback">{{ old('feedback', $reference->feedback ?? '') }}</textarea>
                            @error('feedback')
                                <span class="error-message" style="color:red;">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                </div>

                <div class="btns">
                    <button type="submit" class="add">Update Joiner</button>
                    <a href="{{ route('new-joiners.index') }}" class="back">Cancel</a>
                </div>

            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {

            const jobInput = new Choices('#job', {
                removeItemButton: false,
                addItems: true,
                duplicateItemsAllowed: false,
                searchEnabled: true,
                placeholderValue: 'Select a job...',
                noResultsText: 'No results found',
                noChoicesText: 'No choices available',
                addItemFilter: function(value) {
                    return value.trim() !== '';
                },
            });
        })

        document.addEventListener('DOMContentLoaded', () => {
            const tabs = document.querySelectorAll(".tab-controller p");
            const sections = document.querySelectorAll(".form-section");

            function showSection(step) {
                sections.forEach((section) => {
                    section.style.display = section.dataset.section === step ? "flex" : "none";
                    section.style.opacity = '1';
                });

                tabs.forEach((tab) => {
                    tab.classList.toggle("active", tab.dataset.step === step);
                });
            }

            tabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    const step = tab.dataset.step;
                    showSection(step);
                });
            });

            // Automatically go to the first error-containing tab
            @if ($errors->any())
                const errorSections = document.querySelectorAll('.error-message');
                if (errorSections.length > 0) {
                    const errorSection = errorSections[0].closest('.form-section').dataset.section;
                    showSection(errorSection);
                }
            @endif

            showSection("1"); // Default
        });
    </script>
@endsection
