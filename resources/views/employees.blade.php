@extends('layouts.master')
@section('title', 'Dashboard')

@section('main')
    <div class="main">
        <div class="header">
            <div class="count">
                <p id="emp-count"></p>
                <div id="new-hire"></div>
                <button class="filter">
                    <svg viewBox="-2 -2 24 24" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMinYMin"
                        class="jam jam-filter">
                        <path
                            d="m2.08 2 6.482 8.101A2 2 0 0 1 9 11.351V18l2-1.5v-5.15a2 2 0 0 1 .438-1.249L17.92 2zm0-2h15.84a2 2 0 0 1 1.561 3.25L13 11.35v5.15a2 2 0 0 1-.8 1.6l-2 1.5A2 2 0 0 1 7 18v-6.65L.519 3.25A2 2 0 0 1 2.08 0" />
                    </svg>Fillter</button>

                <div class="filter-box hide-box">
                    <input id="filter-search" type="text" placeholder="Filter by Branch">
                    <div class="filter-text">
                        <p class="filter-branch">Abraj</p>
                        <p class="filter-branch">ABC</p>
                        <p class="filter-branch">Books & Pens</p>
                        <p class="filter-branch">Mazraa</p>
                        <p class="filter-branch">Mansourieh</p>
                    </div>
                </div>
            </div>

            <div class="actions">
                <div class="actions-first">

                    <div id="count-select">
                    </div>

                    <form action=""> <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2h4a1 1 0 1 1 0 2h-1.069l-.867 12.142A2 2 0 0 1 17.069 22H6.93a2 2 0 0 1-1.995-1.858L4.07 8H3a1 1 0 0 1 0-2h4zm2 2h6V4H9zM6.074 8l.857 12H17.07l.857-12zM10 10a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1m4 0a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1" />
                        </svg>
                    </form>

                    <button id="moreActions">
                        <svg viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M8.625 2.5a1.125 1.125 0 1 1-2.25 0 1.125 1.125 0 0 1 2.25 0m0 5a1.125 1.125 0 1 1-2.25 0 1.125 1.125 0 0 1 2.25 0M7.5 13.625a1.125 1.125 0 1 0 0-2.25 1.125 1.125 0 0 0 0 2.25" />
                        </svg>
                    </button>

                    <div class="more-actions">
                        <div id="delete"><svg viewBox="0 0 24 24" data-name="Line Color"
                                xmlns="http://www.w3.org/2000/svg" class="icon line-color">
                                <path
                                    d="M16 12a4 4 0 1 1-4-4 4 4 0 0 1 4 4m0-3v5.5a2.5 2.5 0 0 0 2.5 2.5h0a2.5 2.5 0 0 0 2.5-2.5v-2.19A9.2 9.2 0 0 0 12.6 3a9 9 0 1 0-.6 18 8.8 8.8 0 0 0 3-.52"
                                    style="fill:none;stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:2" />
                            </svg> Add Tags
                        </div>

                        <div id="clone"><svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M464 0H144c-26.51 0-48 21.49-48 48v48H48c-26.51 0-48 21.49-48 48v320c0 26.51 21.49 48 48 48h320c26.51 0 48-21.49 48-48v-48h48c26.51 0 48-21.49 48-48V48c0-26.51-21.49-48-48-48M362 464H54a6 6 0 0 1-6-6V150a6 6 0 0 1 6-6h42v224c0 26.51 21.49 48 48 48h224v42a6 6 0 0 1-6 6m96-96H150a6 6 0 0 1-6-6V54a6 6 0 0 1 6-6h308a6 6 0 0 1 6 6v308a6 6 0 0 1-6 6" />
                            </svg> Clone
                        </div>
                    </div>
                </div>

                <div class="actions-second">
                    <form action=""> <svg viewBox="-5 -5 24 24" xmlns="http://www.w3.org/2000/svg"
                            preserveAspectRatio="xMinYMin" class="jam jam-download">
                            <path
                                d="m8 6.641 1.121-1.12a1 1 0 0 1 1.415 1.413L7.707 9.763a.997.997 0 0 1-1.414 0L3.464 6.934A1 1 0 1 1 4.88 5.52L6 6.641V1a1 1 0 1 1 2 0zM1 12h12a1 1 0 0 1 0 2H1a1 1 0 0 1 0-2" />
                        </svg>
                    </form>

                    <form>
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 2h12v6h4v10h-4v4H6v-4H2V8h4zm2 6h8V4H8zm-2 8v-4h12v4h2v-6H4v6zm2-2v6h8v-6z" />
                        </svg>
                    </form>
                </div>

                <a class="add-btn" href=""> <svg viewBox="0 0 24 24" version="1.2" baseProfile="tiny"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M18 10h-4V6a2 2 0 0 0-4 0l.071 4H6a2 2 0 0 0 0 4l4.071-.071L10 18a2 2 0 0 0 4 0v-4.071L18 14a2 2 0 0 0 0-4" />
                    </svg>Add Candidate
                </a>
            </div>
        </div>

        <div class="cards">

            <div class="card">
                <div class="card-header">
                    <input id="box" type="checkbox">
                    <div class="card-header-right">
                        <p class="active-style">Active</p>
                        <svg viewBox="0 0 256 256" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M80 128a16 16 0 1 1-16-16 16.02 16.02 0 0 1 16 16m112-16a16 16 0 1 0 16 16 16.02 16.02 0 0 0-16-16m-64 0a16 16 0 1 0 16 16 16.02 16.02 0 0 0-16-16" />
                        </svg>
                    </div>
                </div>

                <div class="card-info">
                    <img src="/imgs/profile.jpg" alt="">
                    <b>Wissam Farhat</b>
                    <p>Senior Officer</p>
                </div>

                <div class="details">

                    <div class="details-header">
                        <p>Department</p>
                        <p>Date Hired</p>
                    </div>

                    <div class="details-second">
                        <p>Mazraa</p>
                        <p class="join-date">10/12/2024</p>
                    </div>

                    <div class="details-call">
                        <div class="call">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M2 6a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2zm3.519 0L12 11.671 18.481 6zM20 7.329l-7.341 6.424a1 1 0 0 1-1.318 0L4 7.329V18h16z" />
                            </svg> shadifarhat98@gmail.com
                        </div>

                        <div class="call">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M3.833 4h4.49L9.77 7.618l-2.325 1.55A1 1 0 0 0 7 10c.003.094 0 .001 0 .001v.021a2 2 0 0 0 .006.134q.008.124.035.33c.039.27.114.642.26 1.08.294.88.87 2.019 1.992 3.141s2.261 1.698 3.14 1.992c.439.146.81.22 1.082.26a4 4 0 0 0 .463.04l.013.001h.008s.112-.006.001 0a1 1 0 0 0 .894-.553l.67-1.34 4.436.74v4.32c-2.111.305-7.813.606-12.293-3.874S3.527 6.11 3.833 4m5.24 6.486 1.807-1.204a2 2 0 0 0 .747-2.407L10.18 3.257A2 2 0 0 0 8.323 2H3.781c-.909 0-1.764.631-1.913 1.617-.34 2.242-.801 8.864 4.425 14.09s11.848 4.764 14.09 4.425c.986-.15 1.617-1.004 1.617-1.913v-4.372a2 2 0 0 0-1.671-1.973l-4.436-.739a2 2 0 0 0-2.118 1.078l-.346.693a5 5 0 0 1-.363-.105c-.62-.206-1.481-.63-2.359-1.508s-1.302-1.739-1.508-2.36a5 5 0 0 1-.125-.447z" />
                            </svg>
                            <p class="number">+961 3 545 380</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div id="box" class="card-header">
                    <input type="checkbox">
                    <div class="card-header-right">
                        <p class="unactive-style">Unactive</p>
                        <svg viewBox="0 0 256 256" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M80 128a16 16 0 1 1-16-16 16.02 16.02 0 0 1 16 16m112-16a16 16 0 1 0 16 16 16.02 16.02 0 0 0-16-16m-64 0a16 16 0 1 0 16 16 16.02 16.02 0 0 0-16-16" />
                        </svg>
                    </div>
                </div>

                <div class="card-info">
                    <img src="/imgs/profile.jpg" alt="">
                    <b>Ali Farhat</b>
                    <p>Senior Officer</p>
                </div>

                <div class="details">

                    <div class="details-header">
                        <p>Department</p>
                        <p>Date Hired</p>
                    </div>

                    <div class="details-second">
                        <p>Services</p>
                        <p class="join-date">10/04/2024</p>
                    </div>

                    <div class="details-call">
                        <div class="call">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M2 6a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2zm3.519 0L12 11.671 18.481 6zM20 7.329l-7.341 6.424a1 1 0 0 1-1.318 0L4 7.329V18h16z" />
                            </svg> shadifarhat98@gmail.com
                        </div>

                        <div class="call">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M3.833 4h4.49L9.77 7.618l-2.325 1.55A1 1 0 0 0 7 10c.003.094 0 .001 0 .001v.021a2 2 0 0 0 .006.134q.008.124.035.33c.039.27.114.642.26 1.08.294.88.87 2.019 1.992 3.141s2.261 1.698 3.14 1.992c.439.146.81.22 1.082.26a4 4 0 0 0 .463.04l.013.001h.008s.112-.006.001 0a1 1 0 0 0 .894-.553l.67-1.34 4.436.74v4.32c-2.111.305-7.813.606-12.293-3.874S3.527 6.11 3.833 4m5.24 6.486 1.807-1.204a2 2 0 0 0 .747-2.407L10.18 3.257A2 2 0 0 0 8.323 2H3.781c-.909 0-1.764.631-1.913 1.617-.34 2.242-.801 8.864 4.425 14.09s11.848 4.764 14.09 4.425c.986-.15 1.617-1.004 1.617-1.913v-4.372a2 2 0 0 0-1.671-1.973l-4.436-.739a2 2 0 0 0-2.118 1.078l-.346.693a5 5 0 0 1-.363-.105c-.62-.206-1.481-.63-2.359-1.508s-1.302-1.739-1.508-2.36a5 5 0 0 1-.125-.447z" />
                            </svg> +961 76 938 653
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <input id="box" type="checkbox">
                    <div class="card-header-right">
                        <p class="unactive-style">Unactive</p>
                        <svg viewBox="0 0 256 256" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M80 128a16 16 0 1 1-16-16 16.02 16.02 0 0 1 16 16m112-16a16 16 0 1 0 16 16 16.02 16.02 0 0 0-16-16m-64 0a16 16 0 1 0 16 16 16.02 16.02 0 0 0-16-16" />
                        </svg>
                    </div>
                </div>

                <div class="card-info">
                    <img src="/imgs/profile.jpg" alt="">
                    <b>Shadi Farhat</b>
                    <p>Senior Officer</p>
                </div>

                <div class="details">

                    <div class="details-header">
                        <p>Department</p>
                        <p>Date Hired</p>
                    </div>

                    <div class="details-second">
                        <p>Services</p>
                        <p class="join-date">01/04/2024</p>
                    </div>

                    <div class="details-call">
                        <div class="call">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M2 6a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2zm3.519 0L12 11.671 18.481 6zM20 7.329l-7.341 6.424a1 1 0 0 1-1.318 0L4 7.329V18h16z" />
                            </svg> shadifarhat98@gmail.com
                        </div>

                        <div class="call">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M3.833 4h4.49L9.77 7.618l-2.325 1.55A1 1 0 0 0 7 10c.003.094 0 .001 0 .001v.021a2 2 0 0 0 .006.134q.008.124.035.33c.039.27.114.642.26 1.08.294.88.87 2.019 1.992 3.141s2.261 1.698 3.14 1.992c.439.146.81.22 1.082.26a4 4 0 0 0 .463.04l.013.001h.008s.112-.006.001 0a1 1 0 0 0 .894-.553l.67-1.34 4.436.74v4.32c-2.111.305-7.813.606-12.293-3.874S3.527 6.11 3.833 4m5.24 6.486 1.807-1.204a2 2 0 0 0 .747-2.407L10.18 3.257A2 2 0 0 0 8.323 2H3.781c-.909 0-1.764.631-1.913 1.617-.34 2.242-.801 8.864 4.425 14.09s11.848 4.764 14.09 4.425c.986-.15 1.617-1.004 1.617-1.913v-4.372a2 2 0 0 0-1.671-1.973l-4.436-.739a2 2 0 0 0-2.118 1.078l-.346.693a5 5 0 0 1-.363-.105c-.62-.206-1.481-.63-2.359-1.508s-1.302-1.739-1.508-2.36a5 5 0 0 1-.125-.447z" />
                            </svg> +961 3 545 380
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <input id="box" type="checkbox">
                    <div class="card-header-right">
                        <p class="active-style">Active</p>
                        <svg viewBox="0 0 256 256" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M80 128a16 16 0 1 1-16-16 16.02 16.02 0 0 1 16 16m112-16a16 16 0 1 0 16 16 16.02 16.02 0 0 0-16-16m-64 0a16 16 0 1 0 16 16 16.02 16.02 0 0 0-16-16" />
                        </svg>
                    </div>
                </div>

                <div class="card-info">
                    <img src="/imgs/profile.jpg" alt="">
                    <b>Shadi Farhat</b>
                    <p>Senior Officer</p>
                </div>

                <div class="details">

                    <div class="details-header">
                        <p>Department</p>
                        <p>Date Hired</p>
                    </div>

                    <div class="details-second">
                        <p>Services</p>
                        <p class="join-date">01/04/2024</p>
                    </div>

                    <div class="details-call">
                        <div class="call">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M2 6a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2zm3.519 0L12 11.671 18.481 6zM20 7.329l-7.341 6.424a1 1 0 0 1-1.318 0L4 7.329V18h16z" />
                            </svg> shadifarhat98@gmail.com
                        </div>

                        <div class="call">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M3.833 4h4.49L9.77 7.618l-2.325 1.55A1 1 0 0 0 7 10c.003.094 0 .001 0 .001v.021a2 2 0 0 0 .006.134q.008.124.035.33c.039.27.114.642.26 1.08.294.88.87 2.019 1.992 3.141s2.261 1.698 3.14 1.992c.439.146.81.22 1.082.26a4 4 0 0 0 .463.04l.013.001h.008s.112-.006.001 0a1 1 0 0 0 .894-.553l.67-1.34 4.436.74v4.32c-2.111.305-7.813.606-12.293-3.874S3.527 6.11 3.833 4m5.24 6.486 1.807-1.204a2 2 0 0 0 .747-2.407L10.18 3.257A2 2 0 0 0 8.323 2H3.781c-.909 0-1.764.631-1.913 1.617-.34 2.242-.801 8.864 4.425 14.09s11.848 4.764 14.09 4.425c.986-.15 1.617-1.004 1.617-1.913v-4.372a2 2 0 0 0-1.671-1.973l-4.436-.739a2 2 0 0 0-2.118 1.078l-.346.693a5 5 0 0 1-.363-.105c-.62-.206-1.481-.63-2.359-1.508s-1.302-1.739-1.508-2.36a5 5 0 0 1-.125-.447z" />
                            </svg> +961 76 938 653
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div id="box" class="card-header">
                    <input type="checkbox">
                    <div class="card-header-right">
                        <p class="active-style">Active</p>
                        <svg viewBox="0 0 256 256" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M80 128a16 16 0 1 1-16-16 16.02 16.02 0 0 1 16 16m112-16a16 16 0 1 0 16 16 16.02 16.02 0 0 0-16-16m-64 0a16 16 0 1 0 16 16 16.02 16.02 0 0 0-16-16" />
                        </svg>
                    </div>
                </div>

                <div class="card-info">
                    <img src="/imgs/profile.jpg" alt="">
                    <b>Shadi Farhat</b>
                    <p>Senior Officer</p>
                </div>

                <div class="details">

                    <div class="details-header">
                        <p>Department</p>
                        <p>Date Hired</p>
                    </div>

                    <div class="details-second">
                        <p>Services</p>
                        <p class="join-date">01/04/2024</p>
                    </div>

                    <div class="details-call">
                        <div class="call">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M2 6a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2zm3.519 0L12 11.671 18.481 6zM20 7.329l-7.341 6.424a1 1 0 0 1-1.318 0L4 7.329V18h16z" />
                            </svg> shadifarhat98@gmail.com
                        </div>

                        <div class="call">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M3.833 4h4.49L9.77 7.618l-2.325 1.55A1 1 0 0 0 7 10c.003.094 0 .001 0 .001v.021a2 2 0 0 0 .006.134q.008.124.035.33c.039.27.114.642.26 1.08.294.88.87 2.019 1.992 3.141s2.261 1.698 3.14 1.992c.439.146.81.22 1.082.26a4 4 0 0 0 .463.04l.013.001h.008s.112-.006.001 0a1 1 0 0 0 .894-.553l.67-1.34 4.436.74v4.32c-2.111.305-7.813.606-12.293-3.874S3.527 6.11 3.833 4m5.24 6.486 1.807-1.204a2 2 0 0 0 .747-2.407L10.18 3.257A2 2 0 0 0 8.323 2H3.781c-.909 0-1.764.631-1.913 1.617-.34 2.242-.801 8.864 4.425 14.09s11.848 4.764 14.09 4.425c.986-.15 1.617-1.004 1.617-1.913v-4.372a2 2 0 0 0-1.671-1.973l-4.436-.739a2 2 0 0 0-2.118 1.078l-.346.693a5 5 0 0 1-.363-.105c-.62-.206-1.481-.63-2.359-1.508s-1.302-1.739-1.508-2.36a5 5 0 0 1-.125-.447z" />
                            </svg> +961 76 938 653
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <input id="box" type="checkbox">
                    <div class="card-header-right">
                        <p class="active-style">Active</p>
                        <svg viewBox="0 0 256 256" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M80 128a16 16 0 1 1-16-16 16.02 16.02 0 0 1 16 16m112-16a16 16 0 1 0 16 16 16.02 16.02 0 0 0-16-16m-64 0a16 16 0 1 0 16 16 16.02 16.02 0 0 0-16-16" />
                        </svg>
                    </div>
                </div>

                <div class="card-info">
                    <img src="/imgs/profile.jpg" alt="">
                    <b>Shadi Farhat</b>
                    <p>Senior Officer</p>
                </div>

                <div class="details">

                    <div class="details-header">
                        <p>Department</p>
                        <p>Date Hired</p>
                    </div>

                    <div class="details-second">
                        <p>Services</p>
                        <p class="join-date">01/04/2024</p>
                    </div>

                    <div class="details-call">
                        <div class="call">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M2 6a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2zm3.519 0L12 11.671 18.481 6zM20 7.329l-7.341 6.424a1 1 0 0 1-1.318 0L4 7.329V18h16z" />
                            </svg> shadifarhat98@gmail.com
                        </div>

                        <div class="call">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M3.833 4h4.49L9.77 7.618l-2.325 1.55A1 1 0 0 0 7 10c.003.094 0 .001 0 .001v.021a2 2 0 0 0 .006.134q.008.124.035.33c.039.27.114.642.26 1.08.294.88.87 2.019 1.992 3.141s2.261 1.698 3.14 1.992c.439.146.81.22 1.082.26a4 4 0 0 0 .463.04l.013.001h.008s.112-.006.001 0a1 1 0 0 0 .894-.553l.67-1.34 4.436.74v4.32c-2.111.305-7.813.606-12.293-3.874S3.527 6.11 3.833 4m5.24 6.486 1.807-1.204a2 2 0 0 0 .747-2.407L10.18 3.257A2 2 0 0 0 8.323 2H3.781c-.909 0-1.764.631-1.913 1.617-.34 2.242-.801 8.864 4.425 14.09s11.848 4.764 14.09 4.425c.986-.15 1.617-1.004 1.617-1.913v-4.372a2 2 0 0 0-1.671-1.973l-4.436-.739a2 2 0 0 0-2.118 1.078l-.346.693a5 5 0 0 1-.363-.105c-.62-.206-1.481-.63-2.359-1.508s-1.302-1.739-1.508-2.36a5 5 0 0 1-.125-.447z" />
                            </svg> +961 76 938 653
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <input id="box" type="checkbox">
                    <div class="card-header-right">
                        <p class="unactive-style">Unactive</p>
                        <svg viewBox="0 0 256 256" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M80 128a16 16 0 1 1-16-16 16.02 16.02 0 0 1 16 16m112-16a16 16 0 1 0 16 16 16.02 16.02 0 0 0-16-16m-64 0a16 16 0 1 0 16 16 16.02 16.02 0 0 0-16-16" />
                        </svg>
                    </div>
                </div>

                <div class="card-info">
                    <img src="/imgs/profile.jpg" alt="">
                    <b>Shadi Farhat</b>
                    <p>Senior Officer</p>
                </div>

                <div class="details">

                    <div class="details-header">
                        <p>Department</p>
                        <p>Date Hired</p>
                    </div>

                    <div class="details-second">
                        <p>Services</p>
                        <p class="join-date">01/04/2024</p>
                    </div>

                    <div class="details-call">
                        <div class="call">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M2 6a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2zm3.519 0L12 11.671 18.481 6zM20 7.329l-7.341 6.424a1 1 0 0 1-1.318 0L4 7.329V18h16z" />
                            </svg> shadifarhat98@gmail.com
                        </div>

                        <div class="call">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M3.833 4h4.49L9.77 7.618l-2.325 1.55A1 1 0 0 0 7 10c.003.094 0 .001 0 .001v.021a2 2 0 0 0 .006.134q.008.124.035.33c.039.27.114.642.26 1.08.294.88.87 2.019 1.992 3.141s2.261 1.698 3.14 1.992c.439.146.81.22 1.082.26a4 4 0 0 0 .463.04l.013.001h.008s.112-.006.001 0a1 1 0 0 0 .894-.553l.67-1.34 4.436.74v4.32c-2.111.305-7.813.606-12.293-3.874S3.527 6.11 3.833 4m5.24 6.486 1.807-1.204a2 2 0 0 0 .747-2.407L10.18 3.257A2 2 0 0 0 8.323 2H3.781c-.909 0-1.764.631-1.913 1.617-.34 2.242-.801 8.864 4.425 14.09s11.848 4.764 14.09 4.425c.986-.15 1.617-1.004 1.617-1.913v-4.372a2 2 0 0 0-1.671-1.973l-4.436-.739a2 2 0 0 0-2.118 1.078l-.346.693a5 5 0 0 1-.363-.105c-.62-.206-1.481-.63-2.359-1.508s-1.302-1.739-1.508-2.36a5 5 0 0 1-.125-.447z" />
                            </svg> +961 76 938 653
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <input id="box" type="checkbox">
                    <div class="card-header-right">
                        <p class="active-style">Active</p>
                        <svg viewBox="0 0 256 256" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M80 128a16 16 0 1 1-16-16 16.02 16.02 0 0 1 16 16m112-16a16 16 0 1 0 16 16 16.02 16.02 0 0 0-16-16m-64 0a16 16 0 1 0 16 16 16.02 16.02 0 0 0-16-16" />
                        </svg>
                    </div>
                </div>

                <div class="card-info">
                    <img src="/imgs/profile.jpg" alt="">
                    <b>Shadi Farhat</b>
                    <p>Senior Officer</p>
                </div>

                <div class="details">

                    <div class="details-header">
                        <p>Department</p>
                        <p>Date Hired</p>
                    </div>

                    <div class="details-second">
                        <p>Services</p>
                        <p class="join-date">01/04/2024</p>
                    </div>

                    <div class="details-call">
                        <div class="call">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M2 6a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2zm3.519 0L12 11.671 18.481 6zM20 7.329l-7.341 6.424a1 1 0 0 1-1.318 0L4 7.329V18h16z" />
                            </svg> shadifarhat98@gmail.com
                        </div>

                        <div class="call">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M3.833 4h4.49L9.77 7.618l-2.325 1.55A1 1 0 0 0 7 10c.003.094 0 .001 0 .001v.021a2 2 0 0 0 .006.134q.008.124.035.33c.039.27.114.642.26 1.08.294.88.87 2.019 1.992 3.141s2.261 1.698 3.14 1.992c.439.146.81.22 1.082.26a4 4 0 0 0 .463.04l.013.001h.008s.112-.006.001 0a1 1 0 0 0 .894-.553l.67-1.34 4.436.74v4.32c-2.111.305-7.813.606-12.293-3.874S3.527 6.11 3.833 4m5.24 6.486 1.807-1.204a2 2 0 0 0 .747-2.407L10.18 3.257A2 2 0 0 0 8.323 2H3.781c-.909 0-1.764.631-1.913 1.617-.34 2.242-.801 8.864 4.425 14.09s11.848 4.764 14.09 4.425c.986-.15 1.617-1.004 1.617-1.913v-4.372a2 2 0 0 0-1.671-1.973l-4.436-.739a2 2 0 0 0-2.118 1.078l-.346.693a5 5 0 0 1-.363-.105c-.62-.206-1.481-.63-2.359-1.508s-1.302-1.739-1.508-2.36a5 5 0 0 1-.125-.447z" />
                            </svg> +961 76 938 653
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <input id="box" type="checkbox">
                    <div class="card-header-right">
                        <p class="unactive-style">Unactive</p>
                        <svg viewBox="0 0 256 256" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M80 128a16 16 0 1 1-16-16 16.02 16.02 0 0 1 16 16m112-16a16 16 0 1 0 16 16 16.02 16.02 0 0 0-16-16m-64 0a16 16 0 1 0 16 16 16.02 16.02 0 0 0-16-16" />
                        </svg>
                    </div>
                </div>

                <div class="card-info">
                    <img src="/imgs/profile.jpg" alt="">
                    <b>Shadi Farhat</b>
                    <p>Senior Officer</p>
                </div>

                <div class="details">

                    <div class="details-header">
                        <p>Department</p>
                        <p>Date Hired</p>
                    </div>

                    <div class="details-second">
                        <p>Services</p>
                        <p class="join-date">01/04/2024</p>
                    </div>

                    <div class="details-call">
                        <div class="call">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M2 6a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2zm3.519 0L12 11.671 18.481 6zM20 7.329l-7.341 6.424a1 1 0 0 1-1.318 0L4 7.329V18h16z" />
                            </svg> shadifarhat98@gmail.com
                        </div>

                        <div class="call">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M3.833 4h4.49L9.77 7.618l-2.325 1.55A1 1 0 0 0 7 10c.003.094 0 .001 0 .001v.021a2 2 0 0 0 .006.134q.008.124.035.33c.039.27.114.642.26 1.08.294.88.87 2.019 1.992 3.141s2.261 1.698 3.14 1.992c.439.146.81.22 1.082.26a4 4 0 0 0 .463.04l.013.001h.008s.112-.006.001 0a1 1 0 0 0 .894-.553l.67-1.34 4.436.74v4.32c-2.111.305-7.813.606-12.293-3.874S3.527 6.11 3.833 4m5.24 6.486 1.807-1.204a2 2 0 0 0 .747-2.407L10.18 3.257A2 2 0 0 0 8.323 2H3.781c-.909 0-1.764.631-1.913 1.617-.34 2.242-.801 8.864 4.425 14.09s11.848 4.764 14.09 4.425c.986-.15 1.617-1.004 1.617-1.913v-4.372a2 2 0 0 0-1.671-1.973l-4.436-.739a2 2 0 0 0-2.118 1.078l-.346.693a5 5 0 0 1-.363-.105c-.62-.206-1.481-.63-2.359-1.508s-1.302-1.739-1.508-2.36a5 5 0 0 1-.125-.447z" />
                            </svg> +961 76 938 653
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <input id="box" type="checkbox">
                    <div class="card-header-right">
                        <p class="active-style">Active</p>
                        <svg viewBox="0 0 256 256" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M80 128a16 16 0 1 1-16-16 16.02 16.02 0 0 1 16 16m112-16a16 16 0 1 0 16 16 16.02 16.02 0 0 0-16-16m-64 0a16 16 0 1 0 16 16 16.02 16.02 0 0 0-16-16" />
                        </svg>
                    </div>
                </div>

                <div class="card-info">
                    <img src="/imgs/profile.jpg" alt="">
                    <b>Shadi Farhat</b>
                    <p>Senior Officer</p>
                </div>

                <div class="details">

                    <div class="details-header">
                        <p>Department</p>
                        <p>Date Hired</p>
                    </div>

                    <div class="details-second">
                        <p>Services</p>
                        <p class="join-date">01/04/2024</p>
                    </div>

                    <div class="details-call">
                        <div class="call">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M2 6a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2zm3.519 0L12 11.671 18.481 6zM20 7.329l-7.341 6.424a1 1 0 0 1-1.318 0L4 7.329V18h16z" />
                            </svg> shadifarhat98@gmail.com
                        </div>

                        <div class="call">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M3.833 4h4.49L9.77 7.618l-2.325 1.55A1 1 0 0 0 7 10c.003.094 0 .001 0 .001v.021a2 2 0 0 0 .006.134q.008.124.035.33c.039.27.114.642.26 1.08.294.88.87 2.019 1.992 3.141s2.261 1.698 3.14 1.992c.439.146.81.22 1.082.26a4 4 0 0 0 .463.04l.013.001h.008s.112-.006.001 0a1 1 0 0 0 .894-.553l.67-1.34 4.436.74v4.32c-2.111.305-7.813.606-12.293-3.874S3.527 6.11 3.833 4m5.24 6.486 1.807-1.204a2 2 0 0 0 .747-2.407L10.18 3.257A2 2 0 0 0 8.323 2H3.781c-.909 0-1.764.631-1.913 1.617-.34 2.242-.801 8.864 4.425 14.09s11.848 4.764 14.09 4.425c.986-.15 1.617-1.004 1.617-1.913v-4.372a2 2 0 0 0-1.671-1.973l-4.436-.739a2 2 0 0 0-2.118 1.078l-.346.693a5 5 0 0 1-.363-.105c-.62-.206-1.481-.63-2.359-1.508s-1.302-1.739-1.508-2.36a5 5 0 0 1-.125-.447z" />
                            </svg> +961 76 938 653
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
