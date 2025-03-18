@extends('layouts.master')

@section('title', 'Settings')
@section('custom_title', 'Settings')

@section('main')
    <div class="main">
        <div class="settings-page">
            <div class="settings-container">
                <h2 class="settings-title">Application Settings</h2>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form action="{{ url('settings') }}" method="POST" class="settings-form">
                    @csrf

                    <div class="form-group">
                        <label for="third_color" class="label">Choose Your Third Color</label>
                        <input type="color" name="third_color" id="third_color" class="color-picker"
                            value="{{ session('third_color', '#ff5733') }}">
                    </div>

                    <div class="form-group">
                        <label for="font" class="label">Select Your Font</label>
                        <select name="font" id="font" class="font-selector">
                            <option value="Poppins" {{ session('font', 'Poppins') == 'Poppins' ? 'selected' : '' }}>Poppins
                            </option>
                            <option value="Montserrat" {{ session('font', 'Poppins') == 'Montserrat' ? 'selected' : '' }}>
                                Montserrat</option>
                            <option value="Raleway" {{ session('font', 'Poppins') == 'Raleway' ? 'selected' : '' }}>Raleway
                            </option>
                            <option value="Roboto Slab" {{ session('font', 'Poppins') == 'Roboto Slab' ? 'selected' : '' }}>
                                Roboto Slab</option>
                            <option value="Lora" {{ session('font', 'Poppins') == 'Lora' ? 'selected' : '' }}>Lora
                            </option>
                            <option value="Play" {{ session('font', 'Poppins') == 'Play' ? 'selected' : '' }}>Play
                            </option>
                        </select>
                    </div>

                    <div class="form-buttons">
                        <button type="submit" class="btn save-btn">Save Settings</button>

                    </div>
                </form>

                <!-- Reset Form -->
                <form style="width:100%;display:flex; justify-content:start; margin-top:10px "
                    action="{{ route('reset.settings') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn reset-btn">Reset to Default</button>
                </form>


            </div>
        </div>
    </div>
@endsection



<style>
    .settings-page {
        padding: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .settings-container {
        background: #ffffff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        padding: 40px;
        border-radius: 12px;
        width: 100%;
        max-width: 600px;
        text-align: center;
    }

    .settings-title {
        font-size: 2.5rem;
        color: #333;
        margin-bottom: 30px;
        font-weight: 600;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .label {
        font-weight: 500;
        color: #444;
        margin-bottom: 10px;
        display: block;
    }

    .color-picker {
        width: 100%;
        height: 40px;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 5px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .color-picker:focus {
        border-color: #4CAF50;
    }

    .font-selector {
        width: 100%;
        height: 40px;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 5px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .font-selector:focus {
        border-color: var(--third-color);
    }

    .form-buttons {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .btn {
        font-size: 1rem;
        padding: 12px 24px;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        border: none;
    }

    .save-btn {
        background-color: var(--third-color);
        color: white;
    }

    .save-btn:hover {
        background-color: var(--third-color);
    }

    .reset-btn {
        background-color: #ddd;
        color: white;
        text-decoration: none;
        display: inline-block;
        text-align: center;
    }

    .reset-btn:hover {
        background-color: #e53935;
    }

    /* Responsive Design */
    @media (max-width: 600px) {
        .settings-container {
            padding: 25px;
        }

        .settings-title {
            font-size: 1.8rem;
        }

        .form-group input,
        .form-group select {
            font-size: 1rem;
        }

        .btn {
            padding: 10px 18px;
        }
    }
</style>
