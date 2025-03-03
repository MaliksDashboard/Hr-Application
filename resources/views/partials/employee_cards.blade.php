    @foreach ($employees as $employee)
        <div class="card" data-id="{{ $employee->id }}">
            <div class="card-header">
                <input class="box" id="box" type="checkbox">
                <div class="card-header-right">

                    <svg class="three-points" viewBox="0 0 256 256" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M80 128a16 16 0 1 1-16-16 16.02 16.02 0 0 1 16 16m112-16a16 16 0 1 0 16 16 16.02 16.02 0 0 0-16-16m-64 0a16 16 0 1 0 16 16 16.02 16.02 0 0 0-16-16" />
                    </svg>
                </div>
            </div>

            <div class="card-info">
                <div class="img-container"> <img data-id="{{ $employee->id }}" style="cursor: pointer;"
                        class="image-trigger"
                        src="{{ asset($employee->image_path ? 'storage/' . $employee->image_path : 'storage/' . 'images/default.jpg') }}"
                        alt="Profile Image">
                    @if ($employee->date_hired > Illuminate\Support\Carbon::now()->subMonths(6) && $employee->status === 1)
                        <p class="active-style-new">
                        </p>
                    @elseif ($employee->status === 1)
                        <p class="active-style">
                        </p>
                    @else
                        <p class="unactive-style">
                            <b style="display: none">New</b>
                        </p>
                    @endif

                </div>

                <div class="card-hover" data-id="{{ $employee->id }}">
                    <div class="card-hover-top">
                        <img style="cursor: pointer; border:3px solid var(--primary-color)" class="image-trigger"
                            src="{{ asset($employee->image_path ? 'storage/' . $employee->image_path : 'imgs/default-profile.jpg') }}"
                            alt="Profile Image">

                        <div class="top-parg">
                            <div class="top-parg-name">
                                <div class="horz-top"> <strong>
                                        {{ explode(' ', $employee->name)[0] }}
                                        {{ strtoupper(substr(explode(' ', $employee->name)[1] ?? '', 0, 1)) }}.
                                    </strong>
                                    <small>{{ \Illuminate\Support\Str::limit($employee->title, 10, '...') }}</small>
                                </div>
                                <div style="display: flex; flex-direction: column; gap:10px;">
                                    <p class="details-second">{{ $employee->branch->branch_name }}</p>
                                    <p class="email-truncate details-call"> {{ $employee->email }}</p>
                                    <p>{{ $employee->phone }}
                                    </p>
                                    <p class="join-date">
                                        {{ \Carbon\Carbon::parse($employee->date_hired)->format('d-m-Y') }}</p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="display: flex; gap:5px; justify-content: center; align-items: center;">
                    <b class="name-emp">{{ $employee->name }}</b>
                    <small id="pinCode" style="color:var(--second-color)">({{ $employee->pin_code }})</small>
                </div>
                <p>{{ $employee->title }}</p>

            </div>


            <div class="card-actions">
                <a href="javascript:void(0)" class="get-files-link">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3 14v6a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-6M12 3v14m0 0-5-5.444M12 17l5-5.444"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg> Get Files</a>
                <a href="javascript:void(0)" class="upload-files-link">
                    <svg viewBox="0 0 256 256" xmlns="http://www.w3.org/2000/svg">
                        <circle
                            style="fill:none;stroke-width:16;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                            cx="128" cy="128" r="112" />
                        <path
                            style="fill:none;stroke-width:16;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                            d="M80 128h96m-48-48v96" />
                    </svg>
                    Add File
                </a>
                <input type="file" id="fileUpload" multiple accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"
                    style="display:none;" />

            </div>

            <p class="job">{{ $employee->job }}</p>

            <div class="card-more">
                <div class="card-more-action">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 42 42" xml:space="preserve">
                        <path
                            d="M15.3 20.1c0 3.1 2.6 5.7 5.7 5.7s5.7-2.6 5.7-5.7-2.6-5.7-5.7-5.7-5.7 2.6-5.7 5.7m8.1 12.3C30.1 30.9 40.5 22 40.5 22s-7.7-12-18-13.3c-.6-.1-2.6-.1-3-.1-10 1-18 13.7-18 13.7s8.7 8.6 17 9.9c.9.4 3.9.4 4.9.2M11.1 20.7c0-5.2 4.4-9.4 9.9-9.4s9.9 4.2 9.9 9.4S26.5 30 21 30s-9.9-4.2-9.9-9.3" />
                    </svg> View
                </div>

                @can('Edit')
                    <a href="{{ route('employees.edit', ['employee' => $employee->id]) }}" class="card-more-action">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" xml:space="preserve" aria-hidden="true"
                            focusable="false">
                            <path
                                d="M29.586 9.414 26 13l-7-7 3.586-3.586a2.005 2.005 0 0 1 2.828 0l4.172 4.172c.778.778.778 2.05 0 2.828M18 7l7 7-14.293 14.293C10.318 28.682 9.55 29 9 29H4c-.55 0-1-.45-1-1v-5c0-.55.318-1.318.707-1.707zM8.464 26.293l-2.757-2.757c-.389-.389-.707-.258-.707.292V26c0 .55.45 1 1 1h2.172c.55 0 .681-.318.292-.707" />
                        </svg>
                        Edit
                    </a>
                @endcan

                @can('Delete')
                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="card-more-action">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="delete-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" xml:space="preserve">
                                <path
                                    d="M42.7 469.3c0 23.5 19.1 42.7 42.7 42.7h341.3c23.5 0 42.7-19.1 42.7-42.7V192H42.7zm320-213.3h42.7v192h-42.7zm-128 0h42.7v192h-42.7zm-128 0h42.7v192h-42.7zm384-170.7h-128V42.7C362.7 19.1 343.5 0 320 0H192c-23.5 0-42.7 19.1-42.7 42.7v42.7h-128C9.5 85.3 0 94.9 0 106.7V128c0 11.8 9.5 21.3 21.3 21.3h469.3c11.8 0 21.3-9.5 21.3-21.3v-21.3c.1-11.8-9.4-21.4-21.2-21.4m-170.7 0H192V42.7h128z" />
                            </svg>
                            Delete
                        </button>
                    </form>
                @endcan
            </div>
            <p style="position: absolute; color: red; font-weight: 500;">
                {{ $employee->left_date ? ' Left: ' . \Carbon\Carbon::parse($employee->left_date)->format('d-m-Y') : '' }}
        </div>
    @endforeach
