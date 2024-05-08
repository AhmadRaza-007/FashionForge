@extends('app')
@section('content')
    <style>
        :root {
            /* --text-color: rgba(34, 42, 66, .7); */
            --success-text: #0d6832;
            --primary-text: #273e63;
            --warning-text: #73510d;
            --danger-text: #A61001;
            --success-bg: #d6f0e0;
            --primary-bg: #dfe7f6;
            --warning-bg: #fbf0da;
            --danger-bg: #FFEBE9;
            /* --primary-btn-text: #3b71ca; */
        }

        * {
            /* color:var(--text-color); */
            /* font-family: 'Open Sans', sans-serif;
                            font-family: 'Poppins', sans-serif; */
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        .main {
            /* background-color: #f5f6f8bb !important; */
            height: 100vh;
            min-height: fit-content;
        }

        .text-primary {
            /* color: var(--primary-btn-text) !important; */
        }

        .fw-bold {
            font-weight: 500 !important;
        }

        h2 {
            font-weight: 400;
            margin-bottom: unset;

        }

        .action-icon {
            font-size: 1.08rem;
        }

        /* //Badge color overwirte */



        .badge-success {
            color: var(--success-text) !important;
            background-color: var(--success-bg);
            border: 1px solid;
        }

        .badge-primary {
            color: var(--primary-text) !important;
            ;
            background-color: var(--primary-bg);
            border: 1px solid;
        }

        .badge-warning {
            color: var(--warning-text) !important;
            ;
            background-color: var(--warning-bg);
            border: 1px solid;
        }

        .badge-danger {
            color: var(--danger-text) !important;
            ;
            background-color: var(--danger-bg);
            border: 1px solid;
        }

        .time {
            font-size: .75rem;
        }


        /* //Badge color overwirte end */


        /* table styling */

        /* primary table container  */
        .table-container {
            box-shadow: 0px 1px 2px 0px rgb(60 64 67 / 25%), 0px 2px 6px 2px rgb(60 64 67 / 10%);
            padding: 1rem;
            border-radius: 12px;
            background-color: white;
            overflow-x: scroll;
        }

        /* Hide scrollbar for WebKit-based browsers (like Chrome, Safari) */
        .table-container::-webkit-scrollbar {
            display: none;
            /* Hide scrollbar */
        }

        /* Optional: Additional styles to customize scrollbar appearance */
        .table-container::-webkit-scrollbar-track {
            background: transparent;
            /* Transparent track */
        }

        .table-container::-webkit-scrollbar-thumb {
            background-color: rgba(0, 0, 0, 0.2);
            /* Scrollbar thumb color */
            border-radius: 10px;
            /* Rounded corners */
        }


        th {
            padding: 1rem .5rem !important;
            font-size: .875rem;
            margin-bottom: 1rem !important;
            background-color: white !important;
            /* color: var(--text-color) !important; */
            font-weight: 600 !important;
        }

        th:last-child {
            border-top-right-radius: 12px;
        }

        th:first-child {
            border-top-left-radius: 12px;
        }

        /* //Removes border from last table row */

        tr {
            border: 1px solid transparent !important;
        }

        table {
            margin-top: 1.5rem;
        }


        table tbody td {
            padding: .5rem 2rem !important;
        }

        tr td:last-child {
            text-align: left;
        }

        tr td:first-child {
            width: 15rem;
        }


        /* Changing TH bottom border color*/
        .table>:not(:last-child)>:last-child>* {
            border-bottom-color: rgba(128, 128, 128, 0.277) !important;

        }

        ul {
            margin-bottom: 0rem !important;
        }

        .avatar-span {
            width: 40px;
            height: 40px;
            cursor: pointer;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            border-radius: 20px;
            object-fit: fill;
            background-image: url("https://st4.depositphotos.com/14903220/22197/v/450/depositphotos_221970610-stock-illustration-abstract-sign-avatar-icon-profile.jpg");
        }

        /* table styling end*/

        /*  button styling */
        .btn-link {
            font-weight: 500;
            /* color: var(--primary-text); */
            /* border:1px solid #2c58a094 !important; */
            border-radius: 8px;
            text-decoration: underline 0.1em rgb(255, 255, 255) !important;
            text-underline-offset: 0.2em !important;
            transition: text-decoration-color 300ms, text-underline-offset 300ms !important;
        }

        .btn-link:hover {
            text-decoration-color: #0d6efd !important;
            text-underline-offset: 0.4em !important;
        }

        .logout-btn {
            text-decoration: none;
            font-size: 1rem;
        }

        .page-link {
            border: unset !important;
            /* color: var(--primary-btn-text) */
        }

        .main-sub ul {
            width: 35%;
            min-width: 20rem;
            list-style: none;
        }

        .main-sub ul li a:hover {
            border-bottom: 2px solid orange;
        }

        .active {
            border-bottom: 2px solid orange;
        }

        .main-sub ul li a {
            text-decoration: none;
            font-weight: 600;
        }
    </style>

    <div class="container">

        <!-- //Bootstrap CDN -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
        <!-- //Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" />
        <!-- fonts -->
        <style>
            @import url("https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600&family=Poppins:ital,wght@0,100;0,200;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap");
        </style>
        <!-- //Custom Styling -->
        <link rel="stylesheet" href="style.css" />
        <title>Document</title>
        </head>

        <body>
            @php
                $userAddress = App\Models\Address::where('user_id', auth()->user()->id)->first();
            @endphp
            <div class="main">
                <div class="container">
                    <div class="main-sub row align-items-center pt-5">
                        <ul class="d-flex justify-content-between">
                            <li>
                                <a href="{{ route('user.profile') }}"
                                    class="@if (Route::currentRouteNamed('user.profile')) active @endif">Address</a>
                            </li>
                            <li>
                                <a href="{{ route('user.currentOrders') }}"
                                    class="@if (Route::currentRouteNamed('user.currentOrders')) active @endif">Order</a>
                            </li>
                            <li>
                                <a href="{{ route('user.ordersHistory') }}"
                                    class="@if (Route::currentRouteNamed('user.ordersHistory')) active @endif">History</a>
                            </li>
                        </ul>
                    </div>
                    <div class="table-container mt-5">
                        <div class="mb-2  d-flex justify-content-between">
                            <h2 class="">Personal Information</h2>
                            <a href="{{ route('user.edit') }}" style="text-decoration: none">Edit</a>
                            {{-- <small class="text-secondary">View all form tasks assigned to your group.</small> --}}
                        </div>
                        <table id="mytable" class="table align-middle mb-0 bg-white">
                            {{-- <thead class="bg-light">
                                <tr class="header-row">
                                    <th>ID #</th>
                                    <th>Task Name</th>
                                    <th>Status</th>
                                    <th>Assignee</th>
                                    <th>Process</th>
                                    <th>Due</th>
                                    <th></th>
                                </tr>
                            </thead> --}}
                            <tbody>
                                <tr>
                                    {{-- <td>
                                        <div class="d-flex align-items-center">
                                            <div class="">
                                                <p class="fw-bold mb-1">12</p>
                                            </div>
                                        </div>
                                    </td> --}}
                                    <td>
                                        <p class="fw-bold fw-normal mb-1">Name: </p>
                                    </td>
                                    {{-- <td>
                                        <span class="badge badge-success rounded-pill d-inline">In Progress</span>
                                    </td> --}}
                                    <td>
                                        <span>
                                            {{-- <a
                                                class="btn avatar-button rounded-circle overflow-hidden p-0 m-0 d-inline-flex"><span
                                                    data-v-0a07f886=""
                                                    class="avatar-span border-0 d-inline-flex align-items-center justify-content-center text-white text-uppercase text-nowrap font-weight-normal"></span></a> --}}
                                            <!----></span>
                                        {{ auth()->user()->first_name . ' ' . auth()->user()->second_name }}
                                    </td>
                                    {{-- <td>Human Resources</td>
                                    <td>
                                        <div class="">
                                            <span class="">01/2/2023</span>
                                            <p class="time text-muted mb-0">
                                                06:30 <span class="fw-bold">am</span>
                                            </p>
                                        </div>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-link btn-sm btn-rounded text-primary">
                                            <i class="me-1 action-icon bi bi-file-earmark-richtext text-primary"></i>
                                            Preview Form
                                        </button>
                                    </td> --}}
                                </tr>
                                <tr>
                                    {{-- <td>
                                        <div class="d-flex align-items-center">
                                            <div class="">
                                                <p class="fw-bold mb-1">2</p>
                                            </div>
                                        </div>
                                    </td> --}}
                                    <td>
                                        <p class="fw-bold fw-normal mb-1">Email: </p>
                                    </td>
                                    {{-- <td>
                                        <span class="badge badge-warning rounded-pill d-inline">Overdue</span>
                                    </td> --}}
                                    <td>
                                        <span>
                                            {{-- <a
                                                class="btn avatar-button rounded-circle overflow-hidden p-0 m-0 d-inline-flex"><span
                                                    data-v-0a07f886=""
                                                    class="avatar-span border-0 d-inline-flex align-items-center justify-content-center text-white text-uppercase text-nowrap font-weight-normal"></span></a> --}}
                                            <!----></span>
                                        {{ auth()->user()->email }}
                                    </td>
                                    {{-- <td>IT Ticketing</td>
                                    <td>
                                        <div class="">
                                            <span class="">11/22/2022</span>
                                            <p class="time text-muted mb-0">
                                                03:30 <span class="fw-bold">pm</span>
                                            </p>
                                        </div>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-link btn-sm btn-rounded text-primary">
                                            <i class="me-1 action-icon bi bi-file-earmark-richtext text-primary"></i>
                                            Preview Form
                                        </button>
                                    </td> --}}
                                </tr>
                                <tr>
                                    {{-- <td>
                                        <div class="d-flex align-items-center">
                                            <div class="">
                                                <p class="fw-bold mb-1">27</p>
                                            </div>
                                        </div>
                                    </td> --}}
                                    <td>
                                        <p class="fw-bold fw-normal mb-1">Address: </p>
                                    </td>
                                    {{-- <td>
                                        <span class="badge badge-primary rounded-pill d-inline">Open</span>
                                    </td> --}}
                                    <td>
                                        <span>
                                            {{-- <a
                                                class="btn avatar-button rounded-circle overflow-hidden p-0 m-0 d-inline-flex"><span
                                                    data-v-0a07f886=""
                                                    class="avatar-span border-0 d-inline-flex align-items-center justify-content-center text-white text-uppercase text-nowrap font-weight-normal"></span></a> --}}
                                            <!----></span>
                                        {{ $userAddress->address }}
                                    </td>
                                    {{-- <td>Routing Process #21G</td>
                                    <td>
                                        <div class="">
                                            <span class="">10/15/2022</span>
                                            <p class="time text-muted mb-0">
                                                10:22 <span class="fw-bold">pm</span>
                                            </p>
                                        </div>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-link btn-sm btn-rounded text-primary">
                                            <i class="me-1 action-icon bi bi-file-earmark-richtext text-primary"></i>
                                            Preview Form
                                        </button>
                                    </td> --}}
                                </tr>
                                <tr>
                                    {{-- <td>
                                        <div class="d-flex align-items-center">
                                            <div class="">
                                                <p class="fw-bold mb-1">65</p>
                                            </div>
                                        </div>
                                    </td> --}}
                                    <td>
                                        <p class="fw-bold fw-normal mb-1">Phone Number: </p>
                                    </td>
                                    {{-- <td>
                                        <span class="badge badge-danger rounded-pill d-inline">Expired</span>
                                    </td> --}}
                                    <td>
                                        <span>
                                            {{-- <a
                                                class="btn avatar-button rounded-circle overflow-hidden p-0 m-0 d-inline-flex"><span
                                                    data-v-0a07f886=""
                                                    class="avatar-span border-0 d-inline-flex align-items-center justify-content-center text-white text-uppercase text-nowrap font-weight-normal"></span></a> --}}
                                            <!----></span>
                                        {{ $userAddress->phone }}
                                    </td>
                                    {{-- <td>Routing Process #114F</td>
                                    <td>
                                        <div class="">
                                            <span class="">12/02/2022</span>
                                            <p class="time text-muted mb-0">
                                                2:00 <span class="fw-bold">pm</span>
                                            </p>
                                        </div>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-link btn-sm btn-rounded text-primary">
                                            <i class="me-1 action-icon bi bi-file-earmark-richtext text-primary"></i>
                                            Preview Form
                                        </button>
                                    </td> --}}
                                </tr>
                            </tbody>
                        </table>

                        {{-- <nav class="mt-4">
                            <ul class="pagination justify-content-center">
                                <li class="page-item disabled">
                                    <a class="page-link">Previous</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Next</a>
                                </li>
                            </ul>
                        </nav> --}}
                    </div>
                </div>
            </div>
    </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>


    </div>
@endsection
