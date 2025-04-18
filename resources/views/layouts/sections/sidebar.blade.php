<nav id="nav">
    <article>
        <div class="container">
            <div class="logo">
                <svg viewBox="0 0 24 24" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg">
                    <circle class="cls-1" cx="12" cy="4.34" r="2.86" fill="#fff" />
                    <circle class="cls-1" cx="19.64" cy="16.75" r="2.86" fill="#fff" />
                    <circle class="cls-1" cx="4.36" cy="16.75" r="2.86" fill="#fff" />
                    <path class="cls-1" fill="#fff"
                        d="M6 19.09a8.59 8.59 0 0 0 12 0M14.82 4.82a8.57 8.57 0 0 1 5.77 8.11 7 7 0 0 1-.08 1.1M3.49 14a7 7 0 0 1-.08-1.1 8.57 8.57 0 0 1 5.77-8.08" />
                </svg>
                <p>Maliks</p>

                <span class="nav-toggle" onclick="toggleNav()">&#9776;</span>

            </div>

            <div class="main-tools">
                <div id="seperator">
                    <p class="seperator">Main Tools</p>
                </div>


                @can('Dashboard')
                    <a href="{{ url('/') }}" class="tool {{ request()->is('/') ? 'active' : '' }}">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 14a1 1 0 0 1 1 1v6a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-6a1 1 0 0 1 1-1zm11-5a1 1 0 0 1 1 1v11a1 1 0 0 1-1 1h-7a1 1 0 0 1-1-1V10a1 1 0 0 1 1-1zM10 2a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1zm11 0a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-7a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1z" />
                        </svg>
                        <p>Dashboard</p>
                    </a>
                @endcan


                @can('Settings')
                    <a href="{{ url('/home') }}" class="tool {{ request()->is('home') ? 'active' : '' }}">
                        <svg viewBox="0 0 24 24" version="1.2" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12 3s-6.186 5.34-9.643 8.232A1.04 1.04 0 0 0 2 12a1 1 0 0 0 1 1h2v7a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-4h4v4a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-7h2a1 1 0 0 0 1-1 .98.98 0 0 0-.383-.768C18.184 8.34 12 3 12 3" />
                        </svg>
                        <p>Home</p>
                    </a>
                @endcan

                @can('Employees')
                    <a href="{{ route('employees.index') }}" class="tool {{ request()->is('employees*') ? 'active' : '' }}">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M6.75 6.5a5.25 5.25 0 1 1 10.5 0 5.25 5.25 0 0 1-10.5 0m-2.5 12.071a5.32 5.32 0 0 1 5.321-5.321h4.858a5.32 5.32 0 0 1 5.321 5.321 4.18 4.18 0 0 1-4.179 4.179H8.43a4.18 4.18 0 0 1-4.179-4.179"
                                fill-rule="evenodd" clip-rule="evenodd" />
                        </svg>
                        <p>Employees</p>
                    </a>
                @endcan

                <a href="{{ route('news.index') }}" target="blank"
                    class="tool {{ request()->is('news*') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52" xml:space="preserve">
                        <path
                            d="M50.5 6h-41C8.7 6 8 6.7 8 7.5V38c0 1.2-1.1 2.2-2.3 2-1-.2-1.7-1.1-1.7-2.1V16c0-.6-.4-1-1-1H1.5c-.8 0-1.5.7-1.5 1.5V42c0 2.2 1.8 4 4 4h44c2.2 0 4-1.8 4-4V7.5c0-.8-.7-1.5-1.5-1.5M28 35c0 .6-.4 1-1 1H15c-.6 0-1-.4-1-1v-2c0-.6.4-1 1-1h12c.6 0 1 .4 1 1zm0-8c0 .6-.4 1-1 1H15c-.6 0-1-.4-1-1v-2c0-.6.4-1 1-1h12c.6 0 1 .4 1 1zm18 8c0 .6-.4 1-1 1H33c-.6 0-1-.4-1-1v-2c0-.6.4-1 1-1h12c.6 0 1 .4 1 1zm0-8c0 .6-.4 1-1 1H33c-.6 0-1-.4-1-1v-2c0-.6.4-1 1-1h12c.6 0 1 .4 1 1zm0-8c0 .6-.4 1-1 1H15c-.6 0-1-.4-1-1v-6c0-.6.4-1 1-1h30c.6 0 1 .4 1 1z" />
                    </svg>
                    <p>Al Nashra</p>
                </a>

                @can('Users')
                    <a href="{{ url('/users') }}" class="tool {{ request()->is('users') ? 'active' : '' }}">
                        <svg viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M5.5 0a3.499 3.499 0 1 0 0 6.996A3.499 3.499 0 1 0 5.5 0m-2 8.994a3.5 3.5 0 0 0-3.5 3.5v2.497h11v-2.497a3.5 3.5 0 0 0-3.5-3.5zm9 1.006H12v5h3v-2.5a2.5 2.5 0 0 0-2.5-2.5" />
                            <path d="M11.5 4a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5" />
                        </svg>
                        <p>Users</p>
                    </a>
                @endcan


                @can('Role And Permission')
                    <a href="{{ url('/roles') }}" class="tool {{ request()->is('roles') ? 'active' : '' }}">
                        <svg viewBox="0 0 1920 1920" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M1600 1066.667c117.653 0 213.333 95.68 213.333 213.333v106.667H1920V1760c0 88.213-71.787 160-160 160h-320c-88.213 0-160-71.787-160-160v-373.333h106.667V1280c0-117.653 95.68-213.333 213.333-213.333M800 0c90.667 0 179.2 25.6 254.933 73.6 29.867 18.133 58.667 40.533 84.267 66.133 49.067 49.067 84.8 106.88 108.053 169.814 11.307 30.4 20.8 61.44 25.814 94.08l2.24 14.613 3.626 20.16-.533.32v.213l-52.693 32.427c-44.694 28.907-95.467 61.547-193.067 61.867-.427 0-.747.106-1.173.106-24.534 0-46.08-2.133-65.28-5.653-.64-.107-1.067-.32-1.707-.427-56.32-10.773-93.013-34.24-126.293-55.68-9.6-6.293-18.774-12.16-28.16-17.6-27.947-16-57.92-27.306-108.16-27.306h-.32c-57.814.106-88.747 15.893-121.387 36.266-4.48 2.88-8.853 5.44-13.44 8.427-3.093 2.027-6.72 4.16-9.92 6.187-6.293 4.053-12.693 8.106-19.627 12.16-4.48 2.666-9.493 5.013-14.293 7.573-6.933 3.627-13.973 7.147-21.76 10.453-6.613 2.987-13.76 5.547-21.12 8.107-6.933 2.347-14.507 4.267-22.187 6.293-8.96 2.347-17.813 4.587-27.84 6.187-1.173.213-2.133.533-3.306.747v57.6c0 17.066 1.066 34.133 4.266 50.133C454.4 819.2 611.2 960 800 960c195.2 0 356.267-151.467 371.2-342.4 48-14.933 82.133-37.333 108.8-54.4v23.467c0 165.546-84.373 311.786-212.373 398.08h4.906a1641 1641 0 0 1 294.08 77.76C1313.28 1119.68 1280 1195.733 1280 1280h-106.667v480c0 1.387.427 2.667.427 4.16-142.933 37.547-272.427 49.173-373.76 49.173-345.493 0-612.053-120.32-774.827-221.333L0 1576.32v-196.373c0-140.054 85.867-263.04 218.667-313.28 100.373-38.08 204.586-64.96 310.186-82.347h4.8C419.52 907.413 339.2 783.787 323.2 640c-2.133-17.067-3.2-35.2-3.2-53.333V480c0-56.533 9.6-109.867 27.733-160C413.867 133.333 592 0 800 0m800 1173.333c-58.773 0-106.667 47.894-106.667 106.667v106.667h213.334V1280c0-58.773-47.894-106.667-106.667-106.667"
                                fill-rule="evenodd" />
                        </svg>
                        <p>Role And Permission</p>
                    </a>
                @endcan

                {{-- <a href="{{ url('/chat') }}" class="tool {{ request()->is('chat') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52" xml:space="preserve">
                        <path
                            d="M26 4C12.7 4 2.1 13.8 2.1 25.9c0 3.8 1.1 7.4 2.9 10.6.3.5.4 1.1.2 1.7l-3.1 8.5c-.3.8.5 1.5 1.3 1.3l8.6-3.3c.5-.2 1.1-.1 1.7.2 3.6 2 7.9 3.2 12.5 3.2C39.3 48 50 38.3 50 26.1 49.9 13.8 39.2 4 26 4M14 30c-2.2 0-4-1.8-4-4s1.8-4 4-4 4 1.8 4 4-1.8 4-4 4m12 0c-2.2 0-4-1.8-4-4s1.8-4 4-4 4 1.8 4 4-1.8 4-4 4m12 0c-2.2 0-4-1.8-4-4s1.8-4 4-4 4 1.8 4 4-1.8 4-4 4" />
                    </svg>
                    <p>Live Chat</p>
                </a> --}}
                {{-- @can('Calendar & Tools')
                    <a href="{{ url('/calendar') }}" class="tool {{ request()->is('calendar') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 448">
                            <g
                                style="font-style:normal;font-variant:normal;font-weight:700;font-stretch:normal;font-size:58.14687347px;line-height:125%;font-family:&quot;Segoe UI&quot;;-inkscape-font-specification:&quot;Segoe UI Bold&quot;;letter-spacing:0;word-spacing:0;fill-opacity:1;stroke:none;stroke-width:1px;stroke-linecap:butt;stroke-linejoin:miter;stroke-opacity:1">
                                <path
                                    style="font-style:normal;font-variant:normal;font-weight:700;font-stretch:normal;font-size:261.66091919px;font-family:&quot;Segoe UI&quot;;-inkscape-font-specification:&quot;Segoe UI Bold&quot;"
                                    d="M338.214 193.631v189.277H297.97V239.115q-3.322 2.94-7.922 5.622a91 91 0 0 1-9.582 4.727 103 103 0 0 1-10.604 3.578 84 84 0 0 1-10.86 2.044v-33.985q15.715-4.6 29.64-11.755 13.928-7.155 25.17-15.715zM115.016 374.93v-35.135q18.398 13.415 42.93 13.415 15.458 0 24.019-6.644 8.688-6.643 8.688-18.526 0-12.266-10.732-18.909-10.605-6.644-29.258-6.644H133.67v-30.918h15.715q35.774 0 35.774-23.765 0-22.358-27.47-22.358-18.398 0-35.773 11.882v-32.963q19.291-9.71 44.973-9.71 28.108 0 43.695 12.648 15.715 12.65 15.715 32.836 0 35.901-36.413 44.973v.638q19.42 2.428 30.664 14.182 11.243 11.627 11.243 28.62 0 25.68-18.781 40.628t-51.873 14.949q-28.363 0-46.123-9.2m11.35-370.795c-25.15 0-45.397 21.13-45.397 47.375V67.3H50.705c-16.766 0-30.264 14.086-30.264 31.583v315.829c0 17.496 13.498 31.582 30.264 31.582h363.17c16.766 0 30.264-14.086 30.264-31.582V98.882c0-17.496-13.498-31.582-30.264-31.582H383.61V51.509c0-26.246-20.247-47.375-45.397-47.375s-45.396 21.13-45.396 47.375V67.3H171.762V51.509c0-26.246-20.247-47.375-45.397-47.375m0 31.583c8.383 0 15.132 7.043 15.132 15.792v47.374c0 8.748-6.75 15.791-15.133 15.791s-15.132-7.043-15.132-15.791V51.509c0-8.749 6.75-15.792 15.132-15.792m211.848 0c8.384 0 15.132 7.043 15.132 15.792v47.374c0 8.748-6.748 15.791-15.132 15.791-8.383 0-15.132-7.043-15.132-15.791V51.509c0-8.749 6.75-15.792 15.132-15.792M50.705 162.05h363.17v252.663H50.705z"
                                    transform="matrix(1.05736 0 0 1.0132 -21.613 -4.189)" />
                            </g>
                        </svg>
                        <p>Calendar & Tools</p>
                    </a>
                @endcan --}}
            </div>

            <div id="seperator">
                <p class="seperator">Actions</p>
            </div>

            <div class="org-tools actions-tools">

                @can('Vacancies')
                    <a href="{{ url('/vacancies') }}" class="tool {{ request()->is('vacancies') ? 'active' : '' }}">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M19 6h-3V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v1H5a3 3 0 0 0-3 3v9a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V9a3 3 0 0 0-3-3m-9-1h4v1h-4Zm10 13a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-5.61L8.68 14A1.2 1.2 0 0 0 9 14h6a1.2 1.2 0 0 0 .32-.05L20 12.39Zm0-7.72L14.84 12H9.16L4 10.28V9a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1Z" />
                        </svg>
                        <p>Vacancies</p>
                    </a>
                @endcan

                @can('New Joiners')
                    <a href="{{ url('/new-joiners') }}"
                        class="tool {{ request()->is('new-joiners*', 'steps') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" xml:space="preserve">
                            <path
                                d="M443.4 221.1c.5-.1.9-.1 1.4-.1 3.8-.2 7.6.7 10.5 3.3 2.8 2.6 4.8 5.8 4.8 9.7 0 1.6-.2 3.7-.8 5.2-2.2 5.3-14.4 15.7-19.1 20.4-3.6 3.6-7.8 8.6-12.5 10.7-2.7 1.2-29.6.6-34 .6l-20.4.2c-4.2 0-8 0-11.6-2.5-2.8-2-4.5-5.2-5-8.5-.5-3.7.3-7.4 2.5-10.3 1.6-2 3.6-3.5 6.1-4.2 4.3-1.1 9.2-.6 13.6-.6l23.3-.1c4.5 0 9.4.4 13.8-.2l.3-.1c4.8-4.3 9.5-9 14.1-13.5 2.9-2.8 5.7-6 9.1-8.2 1.3-1.1 2.5-1.4 3.9-1.8m-.1 84.8c.5-.1 1-.1 1.5-.1 4.1-.2 8.6 1.3 11.6 4.2 2.5 2.5 3.9 6 3.8 9.5 0 7.4-5.3 12.2-10.2 17.1-4.3 4.3-14.9 15.5-19.8 17.6-1.4.6-3.4.7-4.9.7-5.9.3-11.9 0-17.8 0h-34.7c-4.4.1-8.6-.3-12.1-3.3-2.6-2.2-4.1-5.6-4.3-9-.2-3.5 1-7 3.3-9.6 1.9-2.1 4.4-3.5 7.1-4 4.5-.9 9.7-.3 14.3-.3l25.6.1c4.3 0 8.7.2 13 0 1.8-2 3.3-4.5 5-6.7 4-5.6 11.5-14.9 18.6-16.2m1.8 84.2c3.8.2 7.3 1.1 10.2 3.7 2.7 2.5 4.3 5.8 4.4 9.5.2 8.1-5.6 12.6-11 17.5-2.3 2.2-4.5 4.5-6.8 6.7-3 3.1-8.6 9.2-12.4 10.8-1.3.5-2.9.6-4.3.7-5.4.3-10.9 0-16.2 0l-38.6.1c-4.1.1-7.4-.7-10.5-3.5-2.4-2.2-3.7-5-3.9-8.2-.2-3.9.7-7.7 3.4-10.6 1.7-1.9 4-3 6.5-3.5 5.2-1.1 11.4-.5 16.8-.6 12.1-.1 24.3 0 36.5-.2 1.7-2.2 3.3-4.3 5.1-6.4 1.9-2.3 3.9-4.4 5.9-6.6 4.5-5.3 7.6-8.8 14.9-9.4m-151.9 3c11-.6 21.8 2.5 30.1 10 6.6 5.9 12 15.9 12.4 24.9.1 3.1-.6 6.2-2.8 8.5-1.2 1.2-2.6 2-4.3 2.4-4.2.9-9.3.3-13.6.2-4.7-.1-9.3-.1-14-.1h-21.7c-4.2 0-8.9.5-13.1-.1-1.7-.3-3-.9-4.3-1.9-2-1.5-3.2-3.7-3.5-6.2-1-7.4 3.4-17.6 7.9-23.3 6.9-8.6 15.9-13.1 26.9-14.4m.7-88.8c10.3-.9 20.1 2.3 28.2 8.7 7.3 5.8 12.8 15.7 13.8 25 1 9.7-1.5 19.6-7.7 27.2-7 8.5-16.8 14.3-27.9 15.4-10.4.7-20.7-2.5-28.8-9.1-7.3-5.9-12.2-15.3-13.1-24.5-1-10.4 2-20.6 8.6-28.6 6.9-8.5 16-13 26.9-14.1m1.9-89.9c10 .1 19.8 3 27.4 9.7 7.4 6.6 11.9 15.9 12.5 25.8.6 10.3-2.8 19.9-9.7 27.5-7.4 8.2-17.5 12.9-28.5 13.4-9.6.4-19-2.9-26.3-9.1-8-6.8-12.4-15.3-13.2-25.9-.7-10.4 2.1-20.1 9-28 7.6-8.7 17.4-12.7 28.8-13.4M170.1 0H192c2.5 1.3 7.6 1.7 10.5 2.3C209.9 4 217.2 6 224 9.2c30.2 14.2 50.3 35.8 61.5 67.3 10 28.1 7.6 61.3-5.2 88.1-3.4 7.2-8.2 14.1-13.3 20.2-14.3 17.3-29.9 27.9-51 35.4-27.4 9.5-57.4 7.8-83.5-4.8-26.9-12.9-47.5-36-57.1-64.2-10.1-28.8-7.5-61.4 5.7-88.7C94.4 35 118.5 14.1 147.7 4.9c3.7-1.2 7.5-2.3 11.3-2.9 3-.5 7.9-.8 10.6-1.8.2-.1.4-.1.5-.2" />
                            <path
                                d="M357.3 92.6c11.9-.1 22.8 4.1 31.5 12.4 7.1 6.8 12.1 15.9 12.8 25.8.3 4.6 0 9.2.1 13.8 0 1.5.2 3.3 1.6 4.2.8.5 2.1.6 3.1.7 4.3.3 8.8-.1 13.1-.1h36.7c6.4 0 13.1-.4 19.5.1 2.5.2 5 .6 7.4 1.2 5.5 1.4 10.7 4.5 14.8 8.4 9.2 8.7 12.6 18.6 12.9 31.1.2 7.7.1 15.5.1 23.2v249.7c0 5 .2 10-.5 15-1 7.6-4.6 14.9-9.9 20.4-5.5 5.8-13.3 10.2-21.2 11.6-7.2 1.3-15.5.6-22.8.6H312.2c-18.7 0-37.4-.4-56.1.1-.3-4-.1-8.1-.1-12-7.4-.4-14.8-.2-22.2-.2h-36.1l-108.6.1h-38c-7.1 0-14.7.6-21.6-.5-6.6-1.1-12.7-4.1-17.5-8.7-8.7-8.2-9.9-17.4-10.3-28.8-.3-9.3 0-18.7.1-28v-59.2c0-14.5-.1-29.7 3.8-43.8 2.9-10.4 7.8-20 13.8-29.1 3.8-5.8 7.8-11.5 12.5-16.6 19.9-22 42.2-32.7 70.8-39.1 3.9-.9 11.9-3.2 15.4-2.8 3.2.4 6.9 2.7 10 3.9 4.2 1.7 8.6 3.3 13 4.6 32.1 9 61.9 6.5 92.9-4.6.3 50.5.4 100.9.2 151.4l-.1 46.6c0 6.2-.4 15 .3 20.9.3 2.5.5 3.7 2.6 5.3 2.3 1.8 4.5 1.8 7.4 1.9 6.4.2 12.8 0 19.2-.1l33.6-.1h98.9l46.9.1 14.2.1c2.8 0 5.9.2 8.7-.2 2.3-.3 4.5-1.8 5.8-3.7 1.2-1.7 1.3-3.3 1.4-5.3.5-21.7 0-43.5 0-65.2V204.9c0-3 .3-6.2-.3-9.2-.6-3.1-2-5.3-5.1-6.3-3.5-1.1-28.1-.7-34-.7l-89.1-.1h-26.8c-4.8 0-9.7.2-14.6 0-.7 0-1.2 0-1.8-.4 0-1.3 2.7-5 3.4-6.3 2.7-5.2 5.3-10.7 7.3-16.2 4.5-12.1 7.1-24 8.3-36.9.4-4.2-.1-11.8 1-15.4.7-2.4 3.2-4.8 4.8-6.7 8-8.7 19.3-13.2 31.1-14.1M170.2 300.9c-1.6.1-3.2.1-4.8.2-4.2 2.6-16.2 20.8-19.3 25.8l.2.2c4.5 4.7 24.4 15.9 26.5 19.4-.6 3.3-7.6 14.1-9.6 17.8-2 3.5-16 27.5-16.1 29.3 0 1 30.4 55.2 33.5 60.2 1.7-2.7 3.2-5.5 4.7-8.3 3.8-7.4 8.1-14.6 12.2-21.8l9.6-17.4c2.1-3.8 4.6-7.4 6.4-11.3.4-.8.7-1.6.8-2.6-1-2.3-2.3-4.4-3.5-6.6-2.2-4-4.5-7.9-6.8-11.9-3.5-5.9-6.7-12-10-17.9-1.7-3-3.9-6.1-5.3-9.2l.2-.2c2.2-2 4.8-3.6 7.2-5.3l14.2-10.1c1.8-1.3 4.3-2.5 5.8-4.1-.3-1.5-13.2-20.1-14.9-22.3-.7-.9-1.6-1.8-2.6-2.5-3.2-2.3-23.1-1.4-28.4-1.4" />
                        </svg>
                        <p>New Joiners</p>
                    </a>
                @endcan

                @can('Trasnfers/Rotation')
                    <a href="{{ route('transfers.index') }}"
                        class="tool {{ request()->is('transfers*') ? 'active' : '' }}">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M14 5V2.5L21 7l-7 4.5V9H5.115a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1zm-4 7.5V15h8.832a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H10v2.5L3 17z"
                                fill-rule="evenodd" />
                        </svg>
                        <p>Transfers/Rotation</p>
                    </a>
                @endcan

                @can('Promotions')
                    <a href="{{ route('promotions.index') }}"
                        class="tool {{ request()->is('promotions') ? 'active' : '' }}">
                        <svg viewBox="0 0 1920 1920" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M357.542 0H1562.46v119.181H1920v423.687a423.7 423.7 0 0 1-124.09 299.592 423.74 423.74 0 0 1-237.96 119.589A423.64 423.64 0 0 1 1438.36 1200c-77.91 77.91-183.04 122.35-293.03 124.05v172.26c0 14.07 5.58 27.56 15.53 37.5a53.04 53.04 0 0 0 37.5 15.54c64.96 0 127.25 25.8 173.18 71.73a244.93 244.93 0 0 1 71.74 173.18V1920H476.723v-125.74a244.91 244.91 0 0 1 244.916-244.91 53.02 53.02 0 0 0 37.501-15.54 53 53 0 0 0 15.534-37.5v-172.26A423.7 423.7 0 0 1 481.637 1200a423.68 423.68 0 0 1-119.589-237.951A423.695 423.695 0 0 1 0 542.868V119.181h357.542zm0 251.471H132.29v291.397a291.4 291.4 0 0 0 225.252 283.791zM1562.46 826.659V251.471h225.25v291.397a291.4 291.4 0 0 1-85.35 206.049 291.4 291.4 0 0 1-139.9 77.742M959.198 320l75.392 244.21H1280l-198.9 151.58L1159.7 960 960.801 808.422 761.906 960l76.992-245.896L640 562.527h245.413z" />
                        </svg>
                        <p>Promotions</p>
                    </a>
                @endcan

            </div>

            <div id="seperator">
                <p class="seperator">Target</p>
            </div>

            <div class="org-tools actions-tools">

                @can('View Evaluation')
                    <a href="{{ url('/view-evaluation') }}"
                        class="tool {{ request()->is('view-evaluation') ? 'active' : '' }}">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 14a2 2 0 1 0 0-4 2 2 0 0 0 0 4" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12 6.477 2 12 2s10 4.477 10 10m-10 6a6 6 0 1 0 0-12 6 6 0 0 0 0 12" />
                        </svg>
                        <p>View Evaluation</p>
                    </a>
                @endcan

                @can('Apply Evaluation')
                    <a href="{{ route('evaluation.index') }}"
                        class="tool {{ request()->is('evaluation') ? 'active' : '' }}">
                        <svg viewBox="0 0 256 256" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M199.917 194.852a8 8 0 0 1-6.125 13.146H22.208a8 8 0 0 1-6.125-13.146 119.9 119.9 0 0 1 55.774-37.294 68 68 0 1 1 72.286 0 119.9 119.9 0 0 1 55.774 37.294M251.177 154a7.996 7.996 0 0 1-10.928 2.928l-4.669-2.695a24 24 0 0 1-7.58 4.39V164a8 8 0 0 1-16 0v-5.376a24 24 0 0 1-7.58-4.391l-4.669 2.695a8 8 0 0 1-8-13.856l4.657-2.689a23.7 23.7 0 0 1 0-8.766l-4.657-2.689a8 8 0 1 1 8-13.856l4.669 2.695a24 24 0 0 1 7.58-4.39V108a8 8 0 0 1 16 0v5.376a24 24 0 0 1 7.58 4.391l4.669-2.695a8 8 0 1 1 8 13.856l-4.657 2.689a23.7 23.7 0 0 1 0 8.766l4.657 2.689A8 8 0 0 1 251.177 154M220 144a8 8 0 1 0-8-8 8.01 8.01 0 0 0 8 8" />
                        </svg>
                        <p>Apply Evalaution</p>
                    </a>
                @endcan

                @can('Target Controller')
                    <a href="{{ url('/evaluation-forms') }}"
                        class="tool {{ request()->is('evaluation-forms') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 226.834 226.834" xml:space="preserve">
                            <path
                                d="M80.197 44.939v-9.746A3.197 3.197 0 0 1 83.39 32h60.053a3.197 3.197 0 0 1 3.193 3.193v9.746a3.197 3.197 0 0 1-3.193 3.193H83.391a3.196 3.196 0 0 1-3.194-3.193M131.841 17c-.768-9.5-8.729-17-18.424-17S95.761 7.5 94.993 17zm60.468 38.334v151.333c0 11.12-9.047 20.167-20.167 20.167H54.692c-11.12 0-20.167-9.047-20.167-20.167V55.334c0-11.12 9.047-20.167 20.167-20.167h10.506l-.001.026v9.746c0 10.032 8.162 18.193 18.193 18.193h60.053c10.032 0 18.193-8.161 18.193-18.193v-9.746l-.001-.026h10.506c11.121 0 20.168 9.047 20.168 20.167M88.183 143.449a7.5 7.5 0 0 0-10.32 2.449l-7.092 11.504-3.661-2.884a7.5 7.5 0 0 0-9.28 11.785l10.271 8.089a7.5 7.5 0 0 0 11.025-1.957l11.506-18.666a7.5 7.5 0 0 0-2.449-10.32m0-54a7.5 7.5 0 0 0-10.32 2.449l-7.092 11.504-3.661-2.884a7.5 7.5 0 0 0-9.28 11.785l10.271 8.089a7.5 7.5 0 0 0 11.025-1.957L90.632 99.77a7.5 7.5 0 0 0-2.449-10.321m77.675 79.051c0-4.143-3.357-7.5-7.5-7.5h-49c-4.142 0-7.5 3.357-7.5 7.5s3.358 7.5 7.5 7.5h49c4.143 0 7.5-3.357 7.5-7.5m0-54c0-4.143-3.357-7.5-7.5-7.5h-49c-4.142 0-7.5 3.357-7.5 7.5s3.358 7.5 7.5 7.5h49c4.143 0 7.5-3.357 7.5-7.5" />
                        </svg>
                        <p>Evaluation Forms</p>
                    </a>
                @endcan

                <a href="{{ url('/evaluation-chains') }}"
                    class="tool {{ request()->is('evaluation-chains') ? 'active' : '' }}">
                    <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M16 32C7.163 32 0 24.837 0 16S7.163 0 16 0s16 7.163 16 16-7.163 16-16 16M9.51 11.744l6.376-3.668 6.36 3.676-6.36 3.677zm12.976-.13 3.257-1.9L15.886 4 6 9.714v11.429l9.886 5.714 9.857-5.714-3.495-2.038-6.362 3.676-6.39-3.676v-3.296l6.4 3.696 6.418-3.715v3.315l3.457 2.038V9.714z" />
                    </svg>
                    <p>Evaluation Chains</p>
                </a>

            </div>

            <div id="seperator">
                <p class="seperator">Apps</p>
            </div>

            <div class="org-tools actions-tools">

                @can('Badge Maker')
                    <a href="{{ route('badge.index') }}" class="tool {{ request()->is('badge*') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 1200" xml:space="preserve">
                            <path
                                d="M0 99.87v1000.26h100.26V99.87zm186.135 0v1000.26h24.089V99.87zm57.883 0v1000.26h76.219V99.87zm153.658 0v1000.26h32.525V99.87zm118.449 0v1000.26h24.041V99.87zm34.379 0v1000.26h99.626V99.87zm159.411 0v1000.26h50.18V99.87zm149.025 0v1000.26h11.118V99.87zm87.63 0v1000.26h33.501V99.87zm119.376 0v1000.26h24.09V99.87zm34.428 0v1000.26H1200V99.87z" />
                        </svg>
                        <p>Badge Maker</p>
                    </a>
                @endcan

                @can('Sundays')
                    <a href="{{ route('sundays.index') }}" class="tool {{ request()->is('sundays*') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 57 57" xml:space="preserve">
                            <path
                                d="M22.66 0H3.34A3.343 3.343 0 0 0 0 3.34v19.32A3.343 3.343 0 0 0 3.34 26h19.32A3.343 3.343 0 0 0 26 22.66V3.34A3.343 3.343 0 0 0 22.66 0m10.68 26h19.32A3.343 3.343 0 0 0 56 22.66V3.34A3.343 3.343 0 0 0 52.66 0H33.34A3.343 3.343 0 0 0 30 3.34v19.32A3.343 3.343 0 0 0 33.34 26m-10.68 4H3.34A3.343 3.343 0 0 0 0 33.34v19.32A3.343 3.343 0 0 0 3.34 56h19.32A3.343 3.343 0 0 0 26 52.66V33.34A3.343 3.343 0 0 0 22.66 30M55 41H45V31a2 2 0 0 0-4 0v10H31a2 2 0 0 0 0 4h10v10a2 2 0 0 0 4 0V45h10a2 2 0 0 0 0-4" />
                        </svg>
                        <p>Sundays</p>
                    </a>
                @endcan

            </div>

            <div id="seperator">
                <p class="seperator">Organization</p>
            </div>

            <div class="org-tools">


                @can('Branches')
                    <a href="{{ route('branches.index') }}"
                        class="tool {{ request()->is('branches*') ? 'active' : '' }}">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M21.026 6.105a3.1 3.1 0 0 1-2.365 3.848A3.03 3.03 0 0 1 15.1 7.222l-.042-.5A3.03 3.03 0 0 1 12.041 10h-.082A3.03 3.03 0 0 1 8.94 6.719l-.031.375a3.12 3.12 0 0 1-2.83 2.9 3.03 3.03 0 0 1-3.138-3.758l.87-3.479A1 1 0 0 1 4.781 2h14.438a1 1 0 0 1 .97.757ZM18.121 12A5 5 0 0 0 20 11.631V21a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-9.369a4.91 4.91 0 0 0 4.907-.683A5.13 5.13 0 0 0 12.042 12a5.03 5.03 0 0 0 3.051-1.052A4.98 4.98 0 0 0 18.121 12M14 17a2 2 0 0 0-4 0v3h4Z" />
                        </svg>
                        <p>Branches</p>
                    </a>
                @endcan

                @can('Branches')
                    <a href="{{ url('/departments') }}"
                        class="tool {{ request()->is('departments*') ? 'active' : '' }}">
                        <svg viewBox="0 0 74 74" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M1 1v72h28.1V1zm8.3 8.5c0-.1.1-.1.1-.1h11.1c.1 0 .1.1.1.1V42c0 .1 0 .1-.1.1h-11c-.1 0-.1-.1-.1-.1V9.5zM15 64.6c-3.4 0-6.2-2.8-6.2-6.2s2.8-6.2 6.2-6.2 6.2 2.8 6.2 6.2c.1 3.4-2.7 6.2-6.2 6.2" />
                            <path
                                d="m55.9 4.3-26.8 7.5v.8L46 73l27-7.5zM45.8 41l-6.6-23.3.1-.1 10.7-3s.1 0 .1.1l6.5 23.2c0 .1 0 .1-.1.1zm11.4 20.2c-.5.2-1.1.2-1.7.2-2.8 0-5.3-1.9-6-4.6-.5-1.6-.2-3.3.6-4.7.8-1.5 2.2-2.5 3.8-2.9.5-.1 1.1-.2 1.7-.2 2.8 0 5.3 1.9 6 4.6.5 1.6.2 3.3-.6 4.7s-2.2 2.4-3.8 2.9" />
                        </svg>
                        <p>Departments</p>
                    </a>
                @endcan

                @can('Titles')
                    <a href="{{ url('/jobs') }}" class="tool {{ request()->is('jobs*') ? 'active' : '' }}">
                        <svg viewBox="0 0 512 512" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M452 120h-76C376 53.726 322.274 0 256 0S136 53.726 136 120H60c-33.137 0-60 26.863-60 60v272c0 33.137 26.863 60 60 60h392c33.137 0 60-26.863 60-60V180c0-33.137-26.863-60-60-60M256 60c33.137 0 60 26.863 60 60H196c0-33.137 26.863-60 60-60m146 200v20c0 16.569-13.431 30-30 30s-30-13.431-30-30v-20H170v20c0 16.569-13.431 30-30 30s-30-13.431-30-30v-20c-16.569 0-30-13.431-30-30s13.431-30 30-30h292c16.569 0 30 13.431 30 30s-13.431 30-30 30" />
                        </svg>
                        <p>Jobs</p>
                    </a>
                @endcan


                @can('Titles')
                    <a href="{{ url('/titles') }}" class="tool {{ request()->is('titles') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 95.824 95.824" xml:space="preserve">
                            <path
                                d="M23.681 66.137H2a2 2 0 0 0-2 2v21.682a2 2 0 0 0 2 2h21.681a2 2 0 0 0 2-2V68.137a2 2 0 0 0-2-2m34.729 0H36.728a2 2 0 0 0-2 2v21.682a2 2 0 0 0 2 2h21.681a2 2 0 0 0 2-2V68.137c.001-1.105-.895-2-1.999-2m35.414 0H72.143a2 2 0 0 0-2 2v21.682a2 2 0 0 0 2 2h21.682a2 2 0 0 0 2-2V68.137a2 2 0 0 0-2.001-2m-56.752-36.45h21.68a2 2 0 0 0 2-2V6.006a2 2 0 0 0-2-2h-21.68a2 2 0 0 0-2 2v21.681a2 2 0 0 0 2 2M9.513 59.209h4.103a2 2 0 0 0 2-2v-8.441h28.245v8.465a2 2 0 0 0 2 2h4.103a2 2 0 0 0 2-2v-8.465h28.245v8.449a2 2 0 0 0 2 2h4.104a2 2 0 0 0 2-2V42.663a2 2 0 0 0-2-2h-34.35v-2.775a2 2 0 0 0-2-2H45.86a2 2 0 0 0-2 2v2.775H9.513a2 2 0 0 0-2 2v14.545c0 1.104.896 2.001 2 2.001" />
                        </svg>
                        <p>Titles</p>
                    </a>
                @endcan

                {{-- @can('Settings')
                    <a class="tool {{ request()->is('setting') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 376.664 376.664" xml:space="preserve">
                            <path
                                d="M154.277 231.806c4.604-1.788 6.979-6.503 5.645-11.269a83 83 0 0 0-7.188-17.433c-1.557-2.819-4.788-4.571-8.434-4.571-1.413 0-2.814.271-4.052.785l-.115.05a11.3 11.3 0 0 1-4.61.963c-3.233 0-6.41-1.329-8.713-3.641-3.589-3.611-4.541-9.172-2.368-13.84 2.048-4.41.329-9.715-3.896-12.069a82.4 82.4 0 0 0-17.211-7.242 9.3 9.3 0 0 0-2.623-.376c-3.929 0-7.461 2.49-8.791 6.204-1.629 4.573-6.68 8.156-11.547 8.156-5.17-.016-9.798-3.326-11.512-8.226a9.33 9.33 0 0 0-8.809-6.268c-.867 0-1.731.122-2.556.358a82.6 82.6 0 0 0-17.26 7.101c-4.25 2.338-6.004 7.631-3.989 12.06 2.139 4.675 1.149 10.224-2.458 13.805-2.156 2.136-5.477 3.412-8.885 3.412-1.797.001-3.519-.362-5-1.057a9.3 9.3 0 0 0-3.94-.872c-3.346 0-6.459 1.809-8.143 4.752a82.7 82.7 0 0 0-7.313 17.393c-1.384 4.734 1.169 9.744 5.817 11.407 4.902 1.748 8.182 6.391 8.159 11.558-.018 4.841-3.043 9.35-7.536 11.24l-.731.28c-4.58 1.572-7.209 6.627-5.871 11.35a82.8 82.8 0 0 0 7.191 17.438c1.566 2.835 4.795 4.596 8.427 4.596 1.381 0 2.751-.266 3.961-.768a12.7 12.7 0 0 1 4.898-.985c3.28 0 6.349 1.269 8.633 3.569 3.587 3.62 4.54 9.181 2.376 13.833-2.059 4.407-.344 9.718 3.899 12.09a82 82 0 0 0 17.229 7.228c.845.246 1.718.37 2.596.37a9.36 9.36 0 0 0 8.8-6.211c1.623-4.571 6.692-8.151 11.544-8.151 5.17.028 9.796 3.342 11.506 8.235a9.333 9.333 0 0 0 11.373 5.912 83 83 0 0 0 17.252-7.102c4.25-2.338 6.005-7.63 3.994-12.052-2.137-4.685-1.146-10.241 2.459-13.822 2.15-2.131 5.475-3.403 8.892-3.403 1.795 0 3.511.361 4.972 1.049a9.3 9.3 0 0 0 3.958.883h.001a9.37 9.37 0 0 0 8.143-4.756 82.4 82.4 0 0 0 7.311-17.393c1.38-4.728-1.171-9.734-5.815-11.401-4.898-1.749-8.176-6.396-8.155-11.563.023-4.905 3.351-9.453 8.485-11.606m-41.259 11.025c0 18.024-14.663 32.687-32.688 32.687s-32.688-14.664-32.688-32.687 14.663-32.688 32.688-32.688 32.688 14.664 32.688 32.688m262.965-92.952c-.658-5.895-6.619-9.544-11.764-9.544l-.127.001c-7.041.186-13.781-4.326-16.566-11.095-2.829-6.897-1.001-14.951 4.55-20.042 4.129-3.791 4.643-10.2 1.181-14.573a107.8 107.8 0 0 0-17.186-17.392 10.8 10.8 0 0 0-6.743-2.379 10.8 10.8 0 0 0-7.987 3.545c-3.228 3.568-8.501 5.785-13.763 5.785-2.313.001-4.475-.415-6.429-1.235-6.984-2.922-11.388-9.991-10.958-17.576.34-5.699-3.836-10.67-9.49-11.316a108.7 108.7 0 0 0-24.443-.07c-5.558.615-9.764 5.479-9.575 11.084.27 7.517-4.181 14.465-11.07 17.287-1.923.785-4.048 1.183-6.315 1.183-5.251.001-10.523-2.206-13.771-5.771a10.82 10.82 0 0 0-7.943-3.494 10.9 10.9 0 0 0-6.645 2.285 108.3 108.3 0 0 0-17.571 17.373c-3.564 4.432-3.057 10.895 1.159 14.717 5.647 5.112 7.476 13.23 4.549 20.205-2.743 6.547-9.376 10.953-16.521 10.979l-1.096-.029c-5.705-.383-10.612 3.842-11.278 9.495a108.4 108.4 0 0 0-.048 24.701c.662 5.895 6.552 9.545 11.628 9.545 7.461 0 14.066 4.354 16.826 11.088 2.82 6.907.994 14.962-4.538 20.037-4.139 3.783-4.659 10.197-1.188 14.6a107.5 107.5 0 0 0 17.213 17.382 10.78 10.78 0 0 0 6.724 2.36c3.043 0 5.956-1.292 7.993-3.546 3.213-3.56 8.485-5.771 13.758-5.771 2.319 0 4.488.414 6.432 1.225 6.977 2.937 11.373 10.01 10.941 17.589-.337 5.686 3.835 10.656 9.501 11.316 4.144.48 8.355.723 12.513.723 3.969 0 7.981-.222 11.924-.659 5.56-.615 9.765-5.478 9.574-11.074-.262-7.527 4.194-14.481 11.083-17.303 1.907-.779 4.022-1.174 6.286-1.174 5.271 0 10.548 2.203 13.776 5.755a10.8 10.8 0 0 0 7.957 3.512c2.39 0 4.745-.81 6.643-2.29a108 108 0 0 0 17.572-17.374c3.555-4.423 3.05-10.881-1.158-14.71-5.642-5.109-7.466-13.232-4.54-20.211 2.783-6.627 9.791-10.917 17.866-10.939l.289.003h.001c5.55 0 10.061-3.992 10.728-9.511.953-8.14.969-16.448.046-24.697m-74.965 11.952c0 18.024-14.663 32.688-32.688 32.688s-32.688-14.664-32.688-32.688 14.663-32.688 32.688-32.688 32.688 14.664 32.688 32.688" />
                        </svg>
                        <p>Settings</p>
                    </a>
                @endcan --}}

            </div>

            <a style="text-decoration: none;" href="https://wa.me/96176938653" target="blank" id="help"
                class="help">
                <svg viewBox="-2 -2 24 24" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMinYMin"
                    class="jam jam-help">
                    <path
                        d="M10 20C4.477 20 0 15.523 0 10S4.477 0 10 0s10 4.477 10 10-4.477 10-10 10m0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16m0-3a1 1 0 1 1 0-2 1 1 0 0 1 0 2m1.276-3.218a1 1 0 0 1-1.232-1.576l.394-.308a1.5 1.5 0 1 0-1.847-2.364l-.394.308a1 1 0 1 1-1.23-1.576l.393-.308a3.5 3.5 0 1 1 4.31 5.516z" />
                </svg>
                <p>Need Help?</p>
                <small>Call Shadi Farhat</small>
            </a>
        </div>
    </article>
</nav>



<!-- Burger Icon -->
<div id="burger-menu" class="burger">
    <span></span>
    <span></span>
    <span></span>
</div>
