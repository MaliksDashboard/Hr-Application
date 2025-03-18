@extends('layouts.master')
@section('title', 'Badge Maker')
@section('custom_title', 'Badge Maker')

<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/JsBarcode.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

@section('main')

    <div id="emp-badge" class="main add-emp">


        <div class="badge-controller add-emp">
            <p id="emp" class="active">Single Badge</p>
            <p id="branch-badge">Multiple Badges</p>
        </div>

        <div id="emp-form" class="container">
            <form action="{{ route('badge.generate') }}" method="POST" target="_blank">
                @csrf
                <div class="container-title">
                    <p>Single Badge Maker</p>
                    <small>Select an employee or enter details manually 👌</small>
                </div>

                <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px; margin-top: 20px;">
                    <div class="input-group">
                        <label for="employee">Select Employee</label>
                        <select id="employee" name="employee" onchange="fetchEmployeeData(this.value)">
                            <option value="" selected>Customized</option>
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}" data-name="{{ $employee->name }}"
                                    data-title="{{ $employee->title }}" data-barcode="{{ $employee->pin_code }}">
                                    {{ $employee->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-group">
                        <label for="name">Name <b style="color:red;">*</b></label>
                        <input style="margin-top: 0" type="text" name="name" id="name" oninput="updatePreview()">
                    </div>

                </div>

                <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px; margin-top: 20px;">

                    <div class="input-group">
                        <label for="employeeTitle">Title <b style="color:red;">*</b></label>
                        <input type="text" name="title" id="employeeTitle" required oninput="updatePreview()">
                    </div>

                    <div class="input-group">
                        <label for="barcode">Barcode <b style="color:red;">*</b></label>
                        <input type="text" name="barcode" id="barcode" maxlength="7" oninput="updatePreview()">
                    </div>
                </div>

                <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px; margin-top: 20px;">
                    <div class="input-group">
                        <label for="design">Badge Design</label>
                        <select id="design" name="design" onchange="updatePreview()">
                            <option value="maliks">Maliks</option>
                            <option value="doculand">Doculand</option>
                            <option value="books_and_pens">Books & Pens</option>
                            <option value="gizmo">Gizmo</option>
                            <option value="lab88">Lab88</option>
                        </select>
                    </div>
                </div>

                <div style="margin-top: 20px" class="btns">
                    <button type="reset" class="clear" onclick="resetPreview()">Clear</button>
                </div>
                <div class="live-preview-barcode">
                    <h3>Live Preview</h3>
                    <div style="display: flex; gap: 10px; justify-content: center; align-items: end;">
                        <div class="badge-preview">
                            <div class="badge-preview-img">
                                <img id="preview-logo" src="logos/maliks.png" width="50px">
                                <img id="preview-barcode" src="logos/barcode.png" alt="Barcode Preview">
                            </div>
                            <div class="badge-preview-text">
                                <div class="name" id="preview-name">Name</div>
                                <div class="title" id="preview-title">Title</div>
                            </div>
                        </div>
                        <div class="btns" style="margin-top: 20px;">
                            <button type="button" class="add" onclick="downloadAsPDFAtTop()"><svg viewBox="0 0 16 16"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill="#fff" d="M16 10h-5.5L8 12.5 5.5 10H0v6h16zM4 14H2v-2h2z" />
                                    <path fill="#fff" d="M10 6V0H6v6H3l5 5 5-5z" />
                                </svg></button>
                        </div>
                    </div>
                </div>
            </form>


        </div>

        <div style="display: none" id="branch-form" class="container">
            <form action="{{ route('badge.generate') }}" method="POST" target="_blank">
                @csrf
                <div class="container-title">
                    <p>Badge Maker per Branch</p>
                    <small>Select a branch 👌</small>
                </div>

                <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px; margin-top: 20px;">
                    <div class="input-group">
                        <label for="branch-select">Select Branch</label>
                        <select id="branch-select" name="branch-select">
                            <option value="" selected disabled>Choose a Branch</option>
                            @foreach ($branches as $branch)
                                <option value="{{ $branch->id }}">
                                    {{ $branch->branch_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div style="display: flex; justify-content: space-between; width: 100%; gap: 20px; margin-top: 20px;">
                    <div class="input-group">
                        <label for="branch-design">Badge Design</label>
                        <select id="branch-design" name="branch-design">
                            <option value="maliks">Maliks</option>
                            <option value="doculand">Doculand</option>
                            <option value="books_and_pens">Books & Pens</option>
                            <option value="gizmo">Gizmo</option>
                            <option value="lab88">Lab88</option>
                        </select>
                    </div>
                </div>
                <div class="multi-badge-container">

                    <div class="btn" style="margin-top: 20px; text-align: center;">
                        <button id="download-multiple-badges" type="button" class="add-multiple-badge" onclick="">
                            Download All Badges
                        </button>
                    </div>
                    <div id="multi-badge-preview" class="multi-badge-preview">
                    </div>
                </div>

            </form>


        </div>

    </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/JsBarcode.all.min.js"></script>

    <script>
        function fetchEmployeeData(employeeId) {
            const selectedOption = document.querySelector(`#employee option[value="${employeeId}"]`);
            if (selectedOption) {
                let name = selectedOption.getAttribute('data-name');
                let title = selectedOption.getAttribute('data-title');
                let barcode = selectedOption.getAttribute('data-barcode');

                // Log the fetched data
                console.log("Fetched Data:", {
                    name,
                    title,
                    barcode
                });

                // Update the fields directly
                document.getElementById('name').value = name;
                document.getElementById('employeeTitle').value = title; // Updated ID
                document.getElementById('barcode').value = barcode.padStart(7, '0');

                // Log the updated field values
                console.log("Updated Fields:", {
                    name: document.getElementById('name').value,
                    title: document.getElementById('employeeTitle').value, // Updated ID
                    barcode: document.getElementById('barcode').value
                });

                // Force DOM update for the title field
                const titleField = document.getElementById('employeeTitle'); // Updated ID
                titleField.dispatchEvent(new Event('input', {
                    bubbles: true
                }));
                titleField.dispatchEvent(new Event('change', {
                    bubbles: true
                }));

                // Explicitly call updatePreview to refresh the live preview
                updatePreview();
            }
        }

        function updatePreview() {
            console.log("🔄 Updating Live Preview...");

            let name = document.getElementById('name').value || 'Name';
            let title = document.getElementById('employeeTitle').value || '';
            let barcode = document.getElementById('barcode').value;

            let designDropdown = document.getElementById('design');
            let selectedDesign = designDropdown ? designDropdown.value : 'maliks';

            console.log("🎨 Selected Design:", selectedDesign);

            let previewLogo = document.getElementById('preview-logo');
            if (previewLogo) {
                previewLogo.src = `logos/${selectedDesign}.png`;
            }

            document.getElementById('preview-name').innerText = formatShortName(name);
            document.getElementById('preview-title').innerText = title;

            if (barcode.length >= 3 && /^\d+$/.test(barcode)) {
                let formattedBarcode = barcode.padStart(7, '0'); // Ensure minimum 7 digits
                JsBarcode("#preview-barcode", formattedBarcode, {
                    format: "EAN8",
                    width: 1.5,
                    height: 40,
                    displayValue: false
                });
            } else {
                document.getElementById('preview-barcode').src = 'logos/barcode.png'; // Reset if invalid
            }

            console.log("✅ Live Preview Updated");
        }

        // ✅ Helper Function to Format Short Name
        function formatShortName(name) {
            let nameParts = name.split(' ');
            return nameParts.length > 1 ? `${nameParts[0]} ${nameParts[1][0]}.` : nameParts[0];
        }

        document.getElementById("design").addEventListener("change", updatePreview);

        function downloadAsPDFAtTop() {
            const badgePreview = document.querySelector('.badge-preview');
            const cmToPx = (cm) => cm * 37.795276; // Conversion factor: 1 cm = ~37.795276 px

            const badgeWidth = cmToPx(7.5); // Badge width in pixels
            const badgeHeight = cmToPx(3.1); // Badge height in pixels

            const A4Width = 21; // A4 width in cm
            const A4Height = 29.7; // A4 height in cm

            html2canvas(badgePreview, {
                scale: 4, // Increase resolution for high-quality rendering
                width: badgePreview.offsetWidth, // Match badge preview size
                height: badgePreview.offsetHeight,
            }).then((canvas) => {
                const imgData = canvas.toDataURL('image/jpeg', 1.0);
                const pdf = new jspdf.jsPDF({
                    orientation: 'portrait', // A4 orientation
                    unit: 'cm',
                    format: [A4Width, A4Height], // A4 dimensions
                });

                // Place the badge at the top-left corner (1 cm margin)
                const xOffset = 1; // Horizontal margin
                const yOffset = 1; // Vertical margin

                pdf.addImage(imgData, 'JPEG', xOffset, yOffset, 7.5, 3.1);
                pdf.save('badge-A4.pdf');
            });
        }

        document.addEventListener("DOMContentLoaded", function() {
            const employeeDropdown = document.getElementById("employee");
            const employeeSelect = new Choices(employeeDropdown, {
                removeItemButton: false,
                addItems: true,
                duplicateItemsAllowed: false,
                searchEnabled: true,
                placeholderValue: 'Select an employee...',
                noResultsText: 'No results found',
                noChoicesText: 'No options available',
            });

            const branchDropdown = document.getElementById('branch-select');
            const branchSelect = new Choices(branchDropdown, {
                removeItemButton: false,
                addItems: true,
                duplicateItemsAllowed: false,
                searchEnabled: true,
                placeholderValue: 'Select a Branch...',
                noResultsText: 'No results found',
                noChoicesText: 'No options available',
            })


            document.getElementById('name').addEventListener('input', updatePreview);
            document.getElementById('employeeTitle').addEventListener('input', updatePreview); // Updated ID
            document.getElementById('barcode').addEventListener('input', updatePreview);
            document.getElementById('design').addEventListener('change', updatePreview);
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const singleBadge = document.getElementById('emp');
            const multipleBadge = document.getElementById('branch-badge');
            const singleForm = document.getElementById('emp-form');
            const branchForm = document.getElementById('branch-form');

            function setActiveBadge(selected) {
                if (selected === 'single') {
                    singleBadge.classList.add('active');
                    multipleBadge.classList.remove('active');
                    singleForm.style.display = 'flex';
                    branchForm.style.display = 'none';
                    localStorage.setItem('selectedBadge', 'single');
                } else {
                    multipleBadge.classList.add('active');
                    singleBadge.classList.remove('active');
                    singleForm.style.display = 'none';
                    branchForm.style.display = 'flex';
                    localStorage.setItem('selectedBadge', 'multiple');
                }
            }

            const savedSelection = localStorage.getItem('selectedBadge');
            if (savedSelection) {
                setActiveBadge(savedSelection);
            } else {
                setActiveBadge('single');
            }

            singleBadge.addEventListener('click', () => setActiveBadge('single'));
            multipleBadge.addEventListener('click', () => setActiveBadge('multiple'));
        });

        document.addEventListener("DOMContentLoaded", function() {
            const branchSelect = document.getElementById("branch-select");
            const multiPreviewContainer = document.getElementById("multi-badge-preview");
            const downloadButton = document.getElementById("download-multiple-badges");
            const branchDesignDropdown = document.getElementById("branch-design");

            if (!multiPreviewContainer || !downloadButton || !branchDesignDropdown) {
                console.error("Error: One or more required elements are missing.");
                return;
            }

            function getSelectedBranchDesign() {
                return branchDesignDropdown.options[branchDesignDropdown.selectedIndex].value;
            }

            function updateBranchPreview() {
                const branchDesignDropdown = document.getElementById("branch-design");

                if (!branchDesignDropdown) {
                    console.error("❌ Error: Branch Design dropdown not found.");
                    return;
                }

                let selectedDesign = branchDesignDropdown.value;
                console.log("🎨 Updating branch badge previews with design:", selectedDesign);

                // ✅ Update the design for multiple badges
                document.querySelectorAll(".multi-badge-preview img[id^='preview-logo-']").forEach(logo => {
                    logo.src = `logos/${selectedDesign}.png`;
                });

                console.log("✅ Updated branch previews to:", selectedDesign);
            }

            document.addEventListener("DOMContentLoaded", function() {
                const branchDesignDropdown = document.getElementById("branch-design");
                if (branchDesignDropdown) {
                    branchDesignDropdown.addEventListener("change", updateBranchPreview);
                }
            });

            branchDesignDropdown.addEventListener("change", updateBranchPreview);

            branchSelect.addEventListener("change", function() {
                const branchId = branchSelect.value;
                if (!branchId) return;

                let selectedDesign = getSelectedBranchDesign();
                console.log("🌟 Fetching employees for branch:", branchId, "with design:", selectedDesign);

                fetch(`/getEmployeesByBranch/${branchId}`)
                    .then(response => response.json())
                    .then(employees => {
                        console.log("✅ Fetched Employees:", employees);
                        multiPreviewContainer.innerHTML = ""; // Clear previous previews

                        employees.forEach(emp => {
                            let nameParts = emp.name.split(" ");
                            let shortName = nameParts.length > 1 ?
                                `${nameParts[0]} ${nameParts[1][0]}.` : nameParts[0];

                            let barcodeValue = emp.pin_code.replace(/\D/g, "").padStart(7, "0");

                            const badgePreview = document.createElement("div");
                            badgePreview.classList.add("badge-preview");
                            badgePreview.innerHTML = `
                        <div class="badge-preview-img">
                            <img id="preview-logo-${emp.id}" src="logos/${selectedDesign}.png" width="50px">
                            <svg id="preview-barcode-${emp.id}" class="preview-barcode"></svg>
                        </div>
                        <div class="badge-preview-text">
                            <div class="name">${shortName}</div>
                            <input style='width:125px !important;height: 20px !important;' class="title input-title" value="${emp.title}" >
                        </div>
                    `;

                            multiPreviewContainer.appendChild(badgePreview);

                            if (barcodeValue.length === 7 || barcodeValue.length === 8) {
                                JsBarcode(`#preview-barcode-${emp.id}`, barcodeValue, {
                                    format: "EAN8",
                                    width: 1.5,
                                    height: 40,
                                    displayValue: false
                                });
                            }
                        });

                        console.log("🔄 Updated multiple badge previews with design:", selectedDesign);
                    })
                    .catch(error => console.error("❌ Error fetching employees:", error));
            });
        });

        document.getElementById("download-multiple-badges").addEventListener("click", function() {
            const multiPreviewContainer = document.getElementById("multi-badge-preview");
            if (!multiPreviewContainer.children.length) {
                alert("No badges to download. Please select a branch first.");
                return;
            }

            const A4Width = 21; // A4 width in cm
            const A4Height = 29.7; // A4 height in cm
            const badgeWidth = 7.5; // Each badge width in cm
            const badgeHeight = 3.1; // Each badge height in cm

            const pdf = new jspdf.jsPDF({
                orientation: "portrait",
                unit: "cm",
                format: [A4Width, A4Height],
            });

            let xOffset = 1; // Start position X
            let yOffset = 1; // Start position Y
            let rowCount = 0; // Track badge positions

            const badges = document.querySelectorAll(".badge-preview");

            if (!badges.length) {
                alert("No badges to export!");
                return;
            }

            // Show SweetAlert loading spinner immediately when the download starts
            Swal.fire({
                title: 'Generating PDF...',
                text: 'Please wait while we generate the badges PDF.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            let badgePromises = Array.from(badges).map((badge, index) => {
                return html2canvas(badge, {
                    scale: 3
                }).then((badgeCanvas) => {
                    const badgeImg = badgeCanvas.toDataURL("image/jpeg", 1.0);
                    pdf.addImage(badgeImg, "JPEG", xOffset, yOffset, badgeWidth, badgeHeight);

                    xOffset += badgeWidth + 1; // Move right
                    rowCount++;

                    if (rowCount === 2) { // Two badges per row
                        xOffset = 1;
                        yOffset += badgeHeight + 1; // Move to next row
                        rowCount = 0;
                    }

                    // Check if we need to add a new page
                    if (yOffset + badgeHeight > A4Height) {
                        pdf.addPage(); // Add new page
                        yOffset = 1; // Reset Y position for the new page
                    }
                });
            });

            Promise.all(badgePromises).then(() => {
                // Close SweetAlert spinner and save the PDF once the process is complete
                Swal.close();
                pdf.save("branch-badges.pdf");
            }).catch(error => {
                Swal.close();
                Swal.fire('Error!', 'An unexpected error occurred. Please try again later.', 'error');
                console.error('Error generating PDF:', error);
            });
        });
    </script>
@endsection


<style>
    .add {
        padding: 5px !important;
    }

    .add svg {
        width: 15px !important;
    }

    .add:hover {
        background-color: green !important;
        transform: scale(1.05);
    }
</style>
