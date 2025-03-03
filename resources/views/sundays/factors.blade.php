@extends('layouts.master')
@section('title', 'Sundays')
@section('custom_title', 'Enter Shift Factors')

@section('main')

    <div class="main add-emp">
        <div class="container">

            <h2>Enter Multiplication Factors</h2>
            <form id="processing-form" action="{{ route('sundays.process') }}" method="POST">
                @csrf
                @foreach (session('sheetNames') as $sheetName)
                    <div class="input-group">
                        <label for="{{ $sheetName }}">Factor for {{ $sheetName }}</label>
                        <input type="number" name="factors[{{ $sheetName }}]" id="{{ $sheetName }}" required>
                    </div>
                @endforeach

                <button type="submit" class="btn btn-primary" onclick="startProcessing(event)">Process</button>
            </form>
        </div>
    </div>

@endsection

<script>
    function startProcessing(event) {
        event.preventDefault(); // Stop default form submission

        Swal.fire({
            title: 'Processing...',
            text: 'Generating report, please wait...',
            allowOutsideClick: false,
            showConfirmButton: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        // Submit the form normally
        document.getElementById("processing-form").submit();

        // Check if file download starts
        let checkDownload = setInterval(() => {
            if (document.hasFocus()) { // Detects when user switches back to tab (indicating download started)
                clearInterval(checkDownload);
                Swal.close();
                window.location.href = "{{ route('sundays.index') }}"; // Redirect back to index
            }
        }, 1000);
    }
</script>

<style>
    .btn-primary {
        width: 100%;
        height: 40px;
        margin-top: 10px;
    }
</style>
