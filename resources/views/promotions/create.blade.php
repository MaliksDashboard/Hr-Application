@extends('layouts.master')
@section('title', 'Create Promotion')
@section('custom_title', 'Add Promotion')


@section('main')
    <div class="main add-emp add-promotion">

        <div class="container">
            <form id="promotion-form" action="{{ route('promotions.store') }}" method="POST" enctype="multipart/form-data"
                class="container">
                @csrf

                <div class="container-title">
                    <p>Basic Form</p>
                    <small>Make sure you know what you are doing 👌</small>
                </div>

                <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px;">
                    <div class="input-group">
                        <label for="employee_id">Employee <b style="color:red;">*</b></label>
                        <select name="employee_id" id="employee_id" onchange="updateBadgePreview()">
                            <option value="">Select Employee</option>
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}" data-name="{{ $employee->name }}"
                                    data-title="{{ $employee->title }}" data-barcode="{{ $employee->pin_code }}"
                                    data-branch-name="{{ $employee->branch_name }}"
                                    {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
                                    {{ $employee->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('employee_id')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label for="old_title">Old Title <b style="color:red;">*</b></label>
                        <input type="text" name="old_title" id="old_title" value="{{ old('old_title') }}" readonly>
                        @error('old_title')
                            <span class="error-message" style="color:red;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px;">
                    <div class="input-group">
                        <label for="new_title">New Title <b style="color:red;">*</b></label>
                        <select name="new_title" id="new_title" onchange="updateBadgePreview()">
                            <option value="">Select New Title</option>
                            @foreach ($titles as $title)
                                <option value="{{ $title->name }}"
                                    {{ old('new_title') == $title->name ? 'selected' : '' }}>
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
                        <input type="date" name="promotion_date" id="promotion_date" class="form-control"
                            value="{{ old('promotion_date', \Carbon\Carbon::now()->format('d-m-Y')) }}">
                    </div>
                </div>

                <div class="btns">
                    <button id="submit-promotion" type="button" class="add">Submit Promotion</button>
                    <button type="reset" class="clear">Clear</button>
                    <a href="{{ route('promotions.index') }}" class="back">Go Back</a>
                </div>
                <div class="live-preview-barcode">
                    <h3>Live Preview</h3>
                    <div style="display: flex; gap: 10px; justify-content: center; align-items: end;">
                        <div class="badge-preview">
                            <div class="badge-preview-img">
                                <img id="preview-logo" src="/logos/maliks.png" width="50px">
                                <svg id="preview-barcode"></svg>
                            </div>
                            <div class="badge-preview-text">
                                <div class="name" id="preview-name">Name</div>
                                <div class="title" id="preview-title">New Title</div>
                            </div>
                        </div>
                        <div class="btns" style="margin-top: 20px;">
                            <button type="button" class="add" onclick="downloadBadgeAsPDF()">
                                <svg viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                    <path fill="#fff" d="M16 10h-5.5L8 12.5 5.5 10H0v6h16zM4 14H2v-2h2z" />
                                    <path fill="#fff" d="M10 6V0H6v6H3l5 5 5-5z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </form>

        </div>

        <!-- ✅ Live Preview Badge -->

    </div>
@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/JsBarcode.all.min.js"></script>

<script>
    function updateBadgePreview() {
        let employeeSelect = document.getElementById('employee_id');
        let titleSelect = document.getElementById('new_title');
        let previewName = document.getElementById('preview-name');
        let previewTitle = document.getElementById('preview-title');
        let previewLogo = document.getElementById('preview-logo');
        let previewBarcode = document.getElementById('preview-barcode');

        let fullName = employeeSelect.selectedOptions[0]?.getAttribute("data-name") || "Name";
        let nameParts = fullName.trim().split(" ");

        let employeeName = nameParts.length > 1 ?
            `${nameParts[0]} ${nameParts[1][0]}.` :
            fullName; // If only one name exists, use it as is.

        let newTitle = titleSelect.value || "New Title";

        let barcodeValue = employeeSelect.selectedOptions[0]?.getAttribute("data-barcode") || "0000000";
        barcodeValue = barcodeValue.padStart(7, '0'); // Ensure 7 digits for barcode format

        let branchName = employeeSelect.selectedOptions[0]?.getAttribute("data-branch-name") || "";
        let logoSrc = "/logos/maliks.png"; // Default logo

        if (branchName.toLowerCase().includes("doculand")) {
            logoSrc = "/logos/doculand.png";
        } else if (branchName.toLowerCase().includes("gizmo")) {
            logoSrc = "/logos/gizmo.png";
        } else if (branchName.toLowerCase().includes("books")) {
            logoSrc = "/logos/books_and_pens.png";
        }

        // ✅ Update the preview
        previewName.innerText = employeeName;
        previewTitle.innerText = newTitle;
        previewLogo.src = logoSrc;

        // ✅ Generate barcode
        JsBarcode("#preview-barcode", barcodeValue, {
            format: "EAN8",
            width: 1.5,
            height: 40,
            displayValue: false
        });

        console.log(`Updated logo: ${logoSrc}`);
    }

    function downloadBadgeAsPDF() {
        if (!window.jspdf || !window.jspdf.jsPDF) {
            console.error("❌ Error: jsPDF is not loaded. Make sure the script is included correctly.");
            return;
        }

        const jsPDF = window.jspdf.jsPDF;
        const badgePreview = document.querySelector('.badge-preview');

        if (!badgePreview) {
            console.error("❌ Error: Badge preview not found.");
            return;
        }

        console.log("⏳ Generating PDF...");

        html2canvas(badgePreview, {
            scale: 4
        }).then(canvas => {
            const imgData = canvas.toDataURL('image/png');

            // ✅ Create A4-sized PDF
            const pdf = new jsPDF({
                orientation: 'portrait',
                unit: 'cm',
                format: [21, 29.7] // A4 dimensions
            });

            // ✅ Position badge at the top-left with a margin
            const marginX = 1.5; // 1.5 cm from left
            const marginY = 1.5; // 1.5 cm from top
            const badgeWidth = 7.5; // Badge width
            const badgeHeight = 3.1; // Badge height

            pdf.addImage(imgData, 'PNG', marginX, marginY, badgeWidth, badgeHeight);
            pdf.save('badge_A4.pdf');

            console.log("✅ PDF Downloaded Successfully");
        }).catch(error => {
            console.error("❌ Error generating PDF:", error);
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        const employeeDropDown = document.getElementById('employee_id');
        const oldTitleInput = document.getElementById('old_title');

        employeeDropDown.addEventListener('change', function() {
            const selectedOption = employeeDropDown.selectedOptions[0];
            oldTitleInput.value = selectedOption.dataset.title || '';
            updateBadgePreview();
        });

        document.getElementById('new_title').addEventListener('change', updateBadgePreview);
    });
</script>

<script>
    //Fetch the old title
    document.addEventListener('DOMContentLoaded', function() {
        const employeeDropDown = document.getElementById('employee_id');
        const oldTitleInput = document.getElementById('old_title');
        const promotionForm = document.getElementById('promotion-form');
        const submitButton = document.getElementById('submit-promotion');

        // Fetch the old title when employee changes
        employeeDropDown.addEventListener('change', function(event) {
            const selectedOption = event.target.selectedOptions[0]; // Correctly reference the event
            const currentTitle = selectedOption.dataset.title || '';
            oldTitleInput.value = currentTitle; // Update the old title field
        });

        // Submit form with AJAX and handle responses
        submitButton.addEventListener('click', () => {
            const formData = new FormData(promotionForm);

            fetch('{{ route('promotions.store') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: formData,
                })
                .then((response) => response.json())
                .then((data) => {
                    if (data.error) {
                        Swal.fire({
                            title: 'Are you sure?',
                            text: data.message,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Yes, proceed',
                            cancelButtonText: 'No, cancel',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                formData.append('confirmed', true);
                                fetch('{{ route('promotions.store') }}', {
                                        method: 'POST',
                                        headers: {
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        },
                                        body: formData,
                                    })
                                    .then((res) => res.json())
                                    .then((finalData) => {
                                        if (finalData.success) {
                                            Swal.fire('Success', finalData.message,
                                                'success').then(() => {
                                                window.location.href = finalData
                                                    .redirect;
                                            });
                                        }
                                    });
                            }
                        });
                    } else if (data.success) {
                        Swal.fire('Success', data.message, 'success').then(() => {
                            window.location.href = data.redirect;
                        });
                    }
                })
                .catch((error) => {
                    console.error('Error:', error);
                    Swal.fire('Error', 'An unexpected error occurred.', 'error');
                });
        });

        //today() for promotion date
        document.getElementById('promotion_date').value = new Date().toISOString().split('T')[0];

        //apply Select2 to the dropdowns
        if (employeeDropDown) {
            new Choices(employeeDropDown, {
                removeItemButton: false,
                addItems: true,
                duplicateItemsAllowed: false,
                searchEnabled: true,
                placeholderValue: 'Select an Employee...',
                noResultsText: 'No results found',
                noChoicesText: 'No Employees available',
            });
        }

        const titleDropDown = document.getElementById('new_title');
        if (titleDropDown) {
            new Choices(titleDropDown, {
                removeItemButton: false,
                addItems: true,
                duplicateItemsAllowed: false,
                searchEnabled: true,
                placeholderValue: 'Select a Title...',
                noResultsText: 'No results found',
                noChoicesText: 'No Titles available',
            })
        }

    });
</script>


<style>
    #preview-barcode {
        width: 100% !important;
        height: 60px !important;
    }
</style>
