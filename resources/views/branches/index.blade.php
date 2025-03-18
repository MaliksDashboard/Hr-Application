@extends('layouts.master')
@section('title', 'All Branches')
@section('custom_title', 'Branches')


@section('main')

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const notyf = new Notyf({
                    duration: 4000, // Notification duration (ms)
                    position: {
                        x: 'right',
                        y: 'top'
                    }, // Position of notifications
                });

                notyf.success('{{ session('success') }}'); // Display success message
            });
        </script>
    @endif

    <div style="gap:0px" class="main">
        <div class="table-controls" style="display: flex; justify-content: space-between; align-items: center;">
            <div class="left" style="display: flex; gap: 20px;">
                <label class="rowPerPage" for="rowPerPage">
                    Show
                    <select id="rowsPerPage">
                        <option value="10">10</option>
                        <option selected value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select> entries
                </label>
            </div>

            <div class="right" style="display: flex; gap: 15px; align-items: center; width: 100%; justify-content: end">

                @can('Delete')
                    <form id="bulk-delete-form" action="{{ route('employees.bulkDelete') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="selected_ids" id="selected_ids">
                        <button type="button" class="bulk-delete-btn">
                            <svg class="dlt" viewBox="0 0 24 24" fill="" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2h4a1 1 0 1 1 0 2h-1.069l-.867 12.142A2 2 0 0 1 17.069 22H6.93a2 2 0 0 1-1.995-1.858L4.07 8H3a1 1 0 0 1 0-2h4zm2 2h6V4H9zM6.074 8l.857 12H17.07l.857-12zM10 10a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1m4 0a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1" />
                            </svg>
                        </button>
                    </form>
                @endcan

                @can('Create')
                    <a class="add-btn" href="{{ route('branches.create') }}">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M18 10h-4V6a2 2 0 0 0-4 0l.071 4H6a2 2 0 0 0 0 4l4.071-.071L10 18a2 2 0 0 0 4 0v-4.071L18 14a2 2 0 0 0 0-4" />
                        </svg>
                        Add Branch
                    </a>
                @endcan

            </div>
        </div>

        <div id="branchesGrid" class="gridjs-container"></div>

        <div id="employeeSheet" class="side-sheet ">
            <div class="expand-close">
                <svg viewBox="0 0 15 15" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M8.293 2.293a1 1 0 0 1 1.414 0l4.5 4.5a1 1 0 0 1 0 1.414l-4.5 4.5a1 1 0 0 1-1.414-1.414L11 8.5H1.5a1 1 0 0 1 0-2H11L8.293 3.707a1 1 0 0 1 0-1.414" />
                </svg>
            </div>

            <div class="sheet-header">
                <h2>Chart of Employees</h2>
                <button id="closeSheet" class="close-btn">Close</button>
            </div>
            <div id="employeeList" class="sheet-content">

                {{-- Java Script Mestelim hal shi --}}

            </div>
            <div class="sheet-footer">
                <button id="downloadButton" title="Download Chart">
                    <svg viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M14 9a1 1 0 0 1 1 1v3a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-3a1 1 0 0 1 2 0v3h10v-3a1 1 0 0 1 1-1M8 1a1 1 0 0 1 1 1v4.586l1.293-1.293a1 1 0 1 1 1.414 1.414L8 10.414 4.293 6.707a1 1 0 0 1 1.414-1.414L7 6.586V2a1 1 0 0 1 1-1" />
                    </svg>
                    Download Chart
                </button>
            </div>


        </div>

        <div id="overlay" class="overlay"></div>

    </div>

@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf-lib/1.16.0/pdf-lib.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<script>
    //fetch the table
    document.addEventListener('DOMContentLoaded', () => {
        let rowsPerPage = 25;

        async function fetchBranches() {
            const branchesResponse = await fetch('/branches-data');
            const managersResponse = await fetch('/branches-manager');

            const branches = await branchesResponse.json();
            const managers = await managersResponse.json();

            return branches.map(branch => {
                const manager = managers.find(m => m.id === branch.id);
                return {
                    ...branch,
                    manager_name: manager?.manager_name || 'Not Found',
                    manager_image: manager?.manager_image || '/storage/images/Default.jpg',
                };
            });
        }

        function getManagerInfo(imageSrc, managerName) {
            return `
                <div style="display: flex; align-items: center; gap: 10px;">
                                <img src="${imageSrc}" alt="Manager Image" style="width: 40px; height: 40px; border-radius: 50%;" />
                                <span>${managerName}</span>
                            </div>
            `
        }

        let canDelete = @json(auth()->user()->can('Delete'));
        let canEdit = @json(auth()->user()->can('Edit'));

        function actionsColumn(branchId) {
            return `
        <div class="table-svg" style="display:flex; justify-content:center; align-items:center; gap:10px;">
            ${canDelete ? `
            <form action="/branches/${branchId}" method="POST" class="delete-form" style="display:inline;">
                <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                <input type="hidden" name="_method" value="DELETE">
                <button type="button" class="delete-btn" data-branch-id="${branchId}">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2h4a1 1 0 1 1 0 2h-1.069l-.867 12.142A2 2 0 0 1 17.069 22H6.93a2 2 0 0 1-1.995-1.858L4.07 8H3a1 1 0 0 1 0-2h4zm2 2h6V4H9zM6.074 8l.857 12H17.07l.857-12zM10 10a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1m4 0a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1" fill="#0D0D0D" />
                    </svg>
                </button>
            </form>` : ''}
            
            ${canEdit ? `
            <a href="/branches/${branchId}/edit" style="background-color:transparent; border:none; cursor:pointer;" class="edit-btn" data-id="${branchId}">
               <svg style="fill:var(--primary-color);" viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg">
                    <path class="clr-i-solid clr-i-solid-path-1" d="m4.22 23.2-1.9 8.2a2.06 2.06 0 0 0 2 2.5 2 2 0 0 0 .43 0L13 32l15.84-15.78L20 7.4Z" />
                    <path class="clr-i-solid clr-i-solid-path-2" d="m33.82 8.32-5.9-5.9a2.07 2.07 0 0 0-2.92 0L21.72 5.7l8.83 8.83 3.28-3.28a2.07 2.07 0 0 0-.01-2.93" />
                    <path fill="none" d="M0 0h36v36H0z" />
                </svg>
            </a>` : ''}

            <button style="background-color:transparent; border:none; cursor:pointer;" class="edit-btn view-report-btn" data-branch-id="${branchId}">
                <svg style="fill:var(--primary-color);" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 42 42" xml:space="preserve">
                    <path d="M15.3 20.1c0 3.1 2.6 5.7 5.7 5.7s5.7-2.6 5.7-5.7-2.6-5.7-5.7-5.7-5.7 2.6-5.7 5.7m8.1 12.3C30.1 30.9 40.5 22 40.5 22s-7.7-12-18-13.3c-.6-.1-2.6-.1-3-.1-10 1-18 13.7-18 13.7s8.7 8.6 17 9.9c.9.4 3.9.4 4.9.2M11.1 20.7c0-5.2 4.4-9.4 9.9-9.4s9.9 4.2 9.9 9.4S26.5 30 21 30s-9.9-4.2-9.9-9.3" />
                </svg>
            </button>
        </div>
     `;
        }


        fetchBranches().then(branches => {
            const grid = new gridjs.Grid({
                columns: [{
                        name: 'Select',
                        formatter: (_, row) => gridjs.html(`
                            <input type="checkbox" class="select-checkbox" data-id="${row.cells[1].data}">
                        `),
                        width: '50px',
                    },
                    'Branch Name',
                    'Location',
                    {
                        name: 'Manager',
                        formatter: (_, row) => gridjs.html(getManagerInfo(row.cells[3]
                            .data, row.cells[4].data)),
                    },
                    {
                        name: 'Email',
                        formatter: (_, row) => {
                            const email = row.cells[5]
                                .data;
                            return email ? email :
                                'Email Not Found';
                        },
                    },
                    {
                        name: 'Actions',
                        formatter: (_, row) => gridjs.html(actionsColumn(row.cells[0]
                            .data)),
                        width: '150px',
                    },
                ],
                data: branches.map(branch => [
                    branch.id,
                    branch.branch_name,
                    branch.location,
                    branch.manager_image,
                    branch.manager_name,
                    branch.manager_email,
                ]),
                pagination: {
                    enabled: true,
                    limit: rowsPerPage,
                },
                search: true,
                sort: true,
                style: {
                    table: {
                        'white-space': 'nowrap',
                    },
                },
            }).render(document.getElementById('branchesGrid'));


            const rowsPerPageSelector = document.getElementById('rowsPerPage');
            rowsPerPageSelector.addEventListener('change', () => {
                rowsPerPage = parseInt(rowsPerPageSelector.value, 10);
                grid.updateConfig({
                    pagination: {
                        enabled: true,
                        limit: rowsPerPage,
                    },
                }).forceRender();
            });
        });

    });

    // ✅ Ensure jsPDF is properly initialized
    document.addEventListener('DOMContentLoaded', () => {
        const downloadButton = document.getElementById('downloadButton');
        const sheetContent = document.querySelector('.sheet-content');

        if (downloadButton) {
            downloadButton.addEventListener('click', () => downloadChartAsPDF(sheetContent));
        }
    });

    async function downloadChartAsPDF(content) {
        if (!content) {
            console.error("❌ Error: .sheet-content not found!");
            return;
        }

        const branchTitle = document.querySelector('.chart-title-left h2');
        const branchName = branchTitle ? branchTitle.textContent.trim() : "Branch";

        try {
            const canvas = await html2canvas(content, {
                scale: 2, // High quality
                useCORS: true,
                backgroundColor: null, // Transparent background
            });

            const imgData = canvas.toDataURL('image/png');
            const pdfDoc = await PDFLib.PDFDocument.create();
            const img = await pdfDoc.embedPng(imgData);

            // 🔹 Create a properly sized page (960x540 px)
            const page = pdfDoc.addPage([960, 540]);

            // 🔹 Calculate correct scaling to fit
            const {
                width,
                height
            } = img.scaleToFit(960, 540);
            page.drawImage(img, {
                x: (960 - width) / 2, // Center horizontally
                y: (540 - height) / 2, // Center vertically
                width: width,
                height: height,
            });

            const pdfBytes = await pdfDoc.save();
            const blob = new Blob([pdfBytes], {
                type: "application/pdf"
            });

            const link = document.createElement("a");
            link.href = URL.createObjectURL(blob);
            link.download = `${branchName}.pdf`;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        } catch (error) {
            console.error("❌ Error generating PDF:", error);
        }
    }

    //sweetalret2
    document.addEventListener('DOMContentLoaded', () => {
        document.body.addEventListener('click', (e) => {
            if (e.target.closest('.delete-btn')) {
                e.preventDefault();

                const form = e.target.closest('form');

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'This action cannot be undone!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel',
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            }
        });
    });


    //Generate The HR Chart
    document.addEventListener('DOMContentLoaded', () => {
        const employeeSheet = document.getElementById('employeeSheet');
        const employeeList = document.getElementById('employeeList');
        const overlay = document.getElementById('overlay');
        const closeSheet = document.getElementById('closeSheet');
        const expandClose = document.querySelector('.expand-close');
        const branchTitle = document.querySelector('.chart-title-left h2');

        document.getElementById('branchesGrid').addEventListener('click', (e) => {
            const button = e.target.closest('.view-report-btn');
            if (button) {
                const branchId = button.getAttribute('data-branch-id');
                const branchName = button.closest('tr')?.querySelector('td:nth-child(2)')?.textContent
                    .trim() || 'Unknown Branch';

                console.log("✅ Opening sheet for branch:", branchId, branchName);
                fetchBranchEmployees(branchId, branchName);

            }
        });

        async function fetchBranchEmployees(branchId, branchName) {
            try {
                console.log("✅ Fetching Employees for:", branchId, branchName);

                // ✅ Ensure branchTitle exists before setting text
                if (branchTitle) {
                    branchTitle.textContent = branchName;
                } else {
                    console.warn("⚠️ Warning: `branchTitle` element not found!");
                }

                // ✅ Fetch employees data
                const response = await fetch(`/branches/${branchId}/employees`);
                const employees = await response.json();

                if (!employees.length) {
                    if (employeeList) {
                        employeeList.innerHTML =
                            `<p style="text-align: center; font-weight: bold;">No employees found for this branch.</p>`;
                    } else {
                        console.warn("⚠️ Warning: `employeeList` element not found!");
                    }
                    return;
                }

                // ✅ Fetch titles data
                const responseTitles = await fetch(`/get-titles-data`);
                const titlesData = await responseTitles.json();
                const titles = titlesData.reduce((acc, title) => {
                    acc[title.name] = {
                        rank: title.rank,
                        category: title.category
                    };
                    return acc;
                }, {});

                console.log("✅ Titles Data:", titles);

                // ✅ Assign ranks and categories to employees
                employees.forEach(emp => {
                    emp.rank = titles[emp.title] ? titles[emp.title].rank : 999;
                    emp.category = titles[emp.title] ? titles[emp.title].category : 'employee';
                });

                // ✅ Sort employees by rank (ascending, best rank first)
                employees.sort((a, b) => a.rank - b.rank);

                // ✅ Find the top manager (lowest rank in manager category)
                const managers = employees.filter(emp => emp.category === 'manager');
                const topManager = managers.length ? managers[0] : null;

                // ✅ Get supervisors (Managers who are NOT the top manager)
                let supervisors = employees.filter(emp => emp.category === 'manager' && emp.id !==
                    topManager?.id);

                // ✅ Get normal employees
                let normalEmployees = employees.filter(emp => emp.category === 'employee');

                // ✅ If no supervisors, add a faded one
                if (supervisors.length === 0) {
                    supervisors.push(getFadedCard("Supervisor"));
                }

                // ✅ Balance employee count (even number)
                normalEmployees = balanceEmployees(normalEmployees);

                // ✅ Apply theme before rendering the chart
                applyTheme(branchName);

                // ✅ Ensure `employeeList` exists before modifying it
                if (employeeList) {
                    employeeList.innerHTML = `
                <div class="chart-title">
                    <div class="chart-title-left">
                        <h2>${branchName}</h2>
                        <h3>Meet our Team</h3>
                        <span class="border"></span>
                    </div>
                    <div class="chart-title-right">
                        <img id="branchLogo" src="/logos/maliks.png" alt="">
                    </div>
                </div>

                <div class="chart-container">
                    <p class="supervisors-mark-left">Supervisors</p>
                    <p class="supervisors-mark-right">Supervisors</p>
                    <p class="employees-mark-left">Employees</p>
                    <p class="employees-mark-right">Employees</p>

                    ${renderTopManager(topManager)}
                    <span class="vertical-border"></span>
                    ${renderSupervisors(supervisors)}
                    ${renderEmployees(normalEmployees)}
                </div>
            `;
                } else {
                    console.warn("⚠️ Warning: `employeeList` element not found!");
                }

                // ✅ Activate the side-sheet
                employeeSheet.classList.add('active');
                overlay.classList.add('active');

                // ✅ Adjust labels and card scaling dynamically
                adjustLabels(supervisors, normalEmployees);
                adjustCardScaling(normalEmployees);

            } catch (error) {
                console.error("❌ Error fetching employees:", error);
                if (employeeList) {
                    employeeList.innerHTML =
                        `<p style="text-align: center; font-weight: bold; color: red;">Failed to load employees. Try again later.</p>`;
                }
            }
        }


        function applyTheme(branchName) {
            setTimeout(() => {
                const lowerCaseName = branchName.toLowerCase();

                const isDoculand = lowerCaseName.includes("doculand");
                const isGizmo = lowerCaseName.includes("gizmo");
                const isLab88 = lowerCaseName.includes("lab88");
                const isBooksAndPens = lowerCaseName.includes("books and pens") || lowerCaseName
                    .includes("b&p");

                const themeColor = isDoculand ? "#0077C8" :
                    isGizmo ? "#333333" :
                    isLab88 ? "#8DAF74" :
                    "#E30613"; // Default Red for others

                const logoSrc = isDoculand ? "/logos/doculand.png" :
                    isGizmo ? "/logos/gizmo.png" :
                    isLab88 ? "/logos/lab88.png" :
                    isBooksAndPens ? "/logos/books_and_pens.png" :
                    "/logos/maliks.png"; // Default logo

                // ✅ Update CSS variable for colors
                document.documentElement.style.setProperty('--red-theme-color', themeColor);

                // ✅ Change title colors
                const title = document.querySelector('.chart-title-left h2');
                const border = document.querySelector('.chart-title-left .border');

                if (title) title.style.color = themeColor;
                if (border) border.style.borderColor = themeColor;

                // ✅ Change section labels
                document.querySelectorAll(
                        '.supervisors-mark-left, .supervisors-mark-right, .employees-mark-left, .employees-mark-right'
                    )
                    .forEach(el => el.style.backgroundColor = themeColor);

                // ✅ Change horizontal border colors
                document.querySelectorAll(
                        '.horiz-border::before, .horiz-border::after, .horiz-border span')
                    .forEach(el => el.style.backgroundColor = themeColor);

                // ✅ Change the red circle behind profile pictures
                document.querySelectorAll(
                        '.chart-container .container-cards .container-card .rec-circle')
                    .forEach(el => el.style.backgroundColor = themeColor);

                // ✅ Change the logo
                const logo = document.getElementById('branchLogo');
                if (logo) {
                    logo.src = logoSrc;
                } else {
                    console.warn("⚠️ Warning: #branchLogo element not found!");
                }

            }, 100);
        }


        function renderTopManager(manager) {
            if (!manager) return '';
            return `
            <div class="container-cards supervisors">
                <div class="container-card manager">
                    <div class="manager-img">
                        <span class="rec-circle"></span>
                        <img src="${manager.image_path}" alt="">
                    </div>
                    <div class="manager-info">
                        <p>${formatName(manager.name)}</p>
                        <small>${manager.title}</small>
                    </div>
                </div>
            </div>
        `;
        }

        function renderSupervisors(supervisors) {
            if (!supervisors.length) return '';
            let supervisorHTML = `<div class="container-cards supervisors">`;

            supervisors.forEach((supervisor, index) => {
                supervisorHTML += `
                <div class="container-card ${supervisor.faded ? 'faded' : ''}">
                    <div class="manager-img">
                        <span class="rec-circle"></span>
                        <img src="${supervisor.image_path}" alt="">
                    </div>
                    <div class="manager-info">
                        <p>${formatName(supervisor.name)}</p>
                        <small>${supervisor.title}</small>
                    </div>
                </div>
            `;
                if (supervisors.length > 1 && index < supervisors.length - 1) {
                    supervisorHTML += `<span class="horiz-border"><span></span></span>`;
                }
            });

            supervisorHTML += `</div>`;
            return supervisorHTML;
        }

        function renderEmployees(employees) {
            if (!employees.length) return '';
            const mid = Math.ceil(employees.length / 2);
            const leftEmployees = employees.slice(0, mid);
            const rightEmployees = employees.slice(mid);

            return `
            <div class="emp-container-cards">
                <div class="emp-container-cards-left">${renderEmployeeGroup(leftEmployees)}</div>
                <div class="emp-container-cards-right">${renderEmployeeGroup(rightEmployees)}</div>
            </div>
        `;
        }

        function renderEmployeeGroup(employees) {
            if (!employees.length) return '';
            let employeeHTML = `<span class="horiz-border"><span></span></span>`;
            employeeHTML += `<div class="container-cards employees">`;

            employees.forEach(emp => {
                employeeHTML += `
                <div class="container-card ${emp.faded ? 'faded' : ''}">
                    <div class="manager-img">
                        <span class="rec-circle"></span>
                        <img src="${emp.image_path}" alt="">
                    </div>
                    <div class="manager-info">
                        <p>${formatName(emp.name)}</p>
                        <small>${emp.title}</small>
                    </div>
                </div>
            `;
            });

            employeeHTML += `</div>`;
            return employeeHTML;
        }

        function getFadedCard(title) {
            return {
                name: "None",
                title: title,
                image_path: "storage/images/default.jpg",
                faded: true
            };
        }

        function adjustCardScaling(employees) {
            const cards = document.querySelectorAll('.container-card');
            const chart = document.querySelector('.chart-container');
            const employeeContainers = document.querySelectorAll(
                '.employees'); // Select all employee containers
            const employeeMarks = document.querySelectorAll(
                '.employees-mark-left, .employees-mark-right'); // Employee labels

            let imgSize = 117; // Default image size
            let circleSize = 144; // Default red circle size
            let cardWidth = 160; // Default card width
            let cardHeight = 180; // Default card height
            let fontSize = 16; // Default font size
            let smallFontSize = 12; // Default small font size
            let padding = 10; // Default padding
            let gapSize = 30; // Default gap
            let employeesMarkTop = "420px"; // Default position

            if (employees.length > 16) {
                imgSize = 70;
                circleSize = 90;
                cardWidth = 100;
                cardHeight = 150;
                fontSize = 10;
                smallFontSize = 8;
                padding = 5;
                gapSize = 5;
                employeesMarkTop = "320px"; // Adjust mark position

                if (chart) {
                    chart.style.marginTop = "-120px"; // Move chart up
                }
            } else if (employees.length >= 10) {
                imgSize = 80;
                circleSize = 100;
                cardWidth = 120;
                cardHeight = 150;
                fontSize = 10;
                smallFontSize = 8;
                padding = 5;
                gapSize = 15;
                employeesMarkTop = "320px"; // Adjust mark position

                if (chart) {
                    chart.style.marginTop = "-100px";
                }
            } else {
                imgSize = 100;
                circleSize = 122;
                cardWidth = 160;
                cardHeight = 200;
                fontSize = 14;
                smallFontSize = 10;
                padding = 8;
                gapSize = 20;
                employeesMarkTop = "420px"; // Default mark position

                if (chart) {
                    chart.style.marginTop = "-100px"; // Reset margin
                }
            }

            // Apply styles dynamically
            cards.forEach(card => {
                card.style.width = `${cardWidth}px`;
                card.style.height = `${cardHeight}px`;
                card.style.padding = `${padding}px`;
            });

            document.querySelectorAll('.container-card .manager-img img').forEach(img => {
                img.style.width = `${imgSize}px`;
                img.style.height = `${imgSize}px`;
            });

            document.querySelectorAll('.container-card .rec-circle').forEach(circle => {
                circle.style.width = `${circleSize}px`;
                circle.style.height = `${circleSize}px`;
            });

            document.querySelectorAll('.container-card .manager-info p').forEach(text => {
                text.style.fontSize = `${fontSize}pt`;
            });

            document.querySelectorAll('.container-card .manager-info small').forEach(smallText => {
                smallText.style.fontSize = `${smallFontSize}pt`;
            });

            employeeContainers.forEach(empContainer => {
                empContainer.style.gap = `${gapSize}px`;
                empContainer.style.flexWrap = "wrap"; // Ensure wrapping
                empContainer.style.justifyContent = "center"; // Keep alignment centered
            });

            // Adjust employees-mark-left & employees-mark-right position
            employeeMarks.forEach(mark => {
                mark.style.top = employeesMarkTop;
            });
        }


        function adjustLabels(supervisors, employees) {
            const supervisorLeft = document.querySelector('.supervisors-mark-left');
            const supervisorRight = document.querySelector('.supervisors-mark-right');
            const employeesLeft = document.querySelector('.employees-mark-left');
            const employeesRight = document.querySelector('.employees-mark-right');

            // ✅ If there is only ONE supervisor, move left/right marks to 450px
            if (supervisors.length === 1) {
                supervisorLeft.style.left = '550px';
                supervisorRight.style.right = '550px';
            } else {
                supervisorLeft.style.left = '550px';
                supervisorRight.style.right = '550px';
            }

            // ✅ If there are LESS THAN 6 employees, move left/right marks to 250px
            if (employees.length < 6) {
                employeesLeft.style.left = '150px';
                employeesRight.style.right = '150px';
            } else {
                employeesLeft.style.left = '100px';
                employeesRight.style.right = '100px';
            }
        }

        function balanceEmployees(employees) {
            while (employees.length % 2 !== 0) {
                employees.push(getFadedCard("Employee"));
            }
            return employees;
        }

        function formatName(fullName) {
            const parts = fullName.split(' ');
            return parts.length > 1 ? `${parts[0]} ${parts[1][0]}.` : fullName;
        }

        closeSheet.addEventListener('click', () => {
            employeeSheet.classList.remove('active');
            overlay.classList.remove('active');
        });

        expandClose.addEventListener('click', () => {
            employeeSheet.classList.remove('active');
            overlay.classList.remove('active');
        });

        overlay.addEventListener('click', () => {
            employeeSheet.classList.remove('active');
            overlay.classList.remove('active');
        });
    });
</script>
