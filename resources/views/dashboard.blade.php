@extends('layouts.main')

@section('content')
    <div class="container">


        <div id="layoutSidenav_content">
            <main>
                <!-- changed content -->
                <div class="px-4">
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                    {{-- @dd(Auth::user()->remember_token) --}}
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="p-4  h-100 rounded-4 Larger shadow bg-white text-info mb-4">

                                <div class="card-body">
                                    <i class="fa-solid fa-calendar"></i>
                                    Daily Order {{ $orderCountD ?? 00 }}

                                    <div class="card-body">
                                        <i class="fa-solid fa-weight-scale"></i>
                                        Daily Sell = {{ $totalSalesD ?? 00 }}TK From {{ $salesCountD ?? 00 }} Orders
                                        <br> <span><i class="fa-solid fa-tags"></i> Daily Discount =
                                            {{ $totalDisD ?? 00 }}TK
                                        </span>
                                        <br><span><i class="fa-solid fa-cart-arrow-down"></i> Net Sales =
                                            {{ $totalSalesD - $totalDisD ?? 00 }}TK</span>
                                    </div>
                                </div>

                                <a class="nav-link" href="{{ url('offorder') }}">View Details</a>


                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="p-4  h-100 rounded-4 Larger shadow  bg-white text-warning mb-4">

                                <div class="p-4-body">
                                    <i class="fa-regular fa-calendar-check"></i>
                                    Weekly Order {{ $orderCountW ?? 00 }}
                                    <div class="card-body">
                                        <i class="fa-solid fa-weight-scale"></i>
                                        Weekly Sell = {{ $totalSalesW ?? 00 }}TK From {{ $salesCountW ?? 00 }} Orders
                                        <br> <span><i class="fa-solid fa-tags"></i> Weekly Discount =
                                            {{ $totalDisW ?? 00 }}TK
                                        </span>
                                        <br><span><i class="fa-solid fa-cart-arrow-down"></i> Net Sales =
                                            {{ $totalSalesW - $totalDisW ?? 00 }}TK</span>
                                    </div>
                                </div>

                                <div class=" d-flex align-items-center justify-content-between p-4">
                                    <a class=" nav-link " href="{{ url('offorder') }}">View Details</a>
                                    <div class="small "><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="p-4  h-100 rounded-4 Larger shadow bg-white text-success mb-4">

                                <div class="card-body">
                                    <i class="fa-regular fa-calendar-days"></i>
                                    Monthly Order {{ $orderCountM ?? 00 }}

                                    <div class="card-body">
                                        <i class="fa-solid fa-weight-scale"></i>
                                        Monthly Sell = {{ $totalSalesM ?? 00 }}TK From {{ $salesCountM ?? 00 }} Orders
                                        <br> <span><i class="fa-solid fa-tags"></i> Monthly Discount =
                                            {{ $totalDisM ?? 00 }}TK
                                        </span>
                                        <br><span><i class="fa-solid fa-cart-arrow-down"></i> Monthly Sales =
                                            {{ $totalSalesM - $totalDisM ?? 00 }}TK</span>
                                    </div>
                                </div>
                                <div class="fixed-bottom d-flex align-items-center justify-content-between">
                                    <a class="small nav-link stretched-link" href="{{ url('offorder') }}">View Details</a>
                                    <div class="small "><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="p-4  h-100 rounded-4 shadow bg-white text-danger mb-4">
                                <div class="card-body">Danger Card</div>
                                <div class="fixed-bottom d-flex align-items-center justify-content-between">
                                    <a class="small nav-link stretched-link" href="{{ url('offorder') }}">View Details</a>
                                    <div class="small"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-4 rounded-4 Larger shadow  bg-white card-hover  my-5">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h4 class="m-0 font-weight-bold text-info">Daily Order</h4>

                        </div>
                        <!-- Card Body -->
                        <div class="card-body mt-4">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th colspan="6" class="tablebtn text-end">
                                                <span>@php
                                                    $currentDate = date('d M Y');

                                                    echo $currentDate; // 5 OCT 2023

                                                @endphp</span>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>Order ({{ $orderCountD }})</th>
                                            <th>Food Name</th>
                                            <th>Total Amount ({{ $totalSalesD }} TK)</th>
                                            <th>Discount ({{ $totalDisD }} TK)</th>
                                            <th>Reason</th>
                                            <th>Net Sale: {{ $totalSalesD - $totalDisD }} TK</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($items as $offorder)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>
                                                    @foreach ($offorder->offorderdetails as $detail)
                                                        <div class="">
                                                            <span class="fs-6 me-3">{{ $detail->menu->name }} -</span>
                                                            <span class="fs-6"> Q: {{ $detail->quantity }} </span>
                                                        </div>
                                                    @endforeach
                                                </td>
                                                <td>{{ $offorder->total }}</td>
                                                <td>{{ $offorder->discount }}</td>
                                                <td>{{ $offorder->reason }}</td>
                                                <td>{{ $offorder->total - $offorder->discount }}</td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="p-4 rounded-4 Larger shadow  bg-white card-hover  my-5">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h4 class="m-0 font-weight-bold text-info">Daily Order</h4>

                        </div>
                        <!-- Card Body -->
                        <div class="card-body mt-4">
                            <label for="filterDate">Filter by Date:</label>
                            <input type="date" id="filterDate">
                            <button onclick="filterData()">Apply Filter</button>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="orderDetails" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Menu ID</th>
                                            <th>Menu Name</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- changed content  ends-->
            </main>
            <!-- footer -->
        </div>
        <h3>Dashboaard Home</h3>
    </div>
@endsection

@section('script')
    {{-- <script>
        $(document).ready(function() {
            // Make an AJAX request to your API
            $.ajax({
                // url: 'http://localhost/acrh/role-permission/public/orderdetailsapi',
                url: '{{ url('orderdetailsapi') }}',
                method: 'GET',
                success: function(data) {
                    // Process the received data
                    // console.log(data);
                    processData(data);
                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });

            // Function to process and display the data
            function processData(data) {
                // Create an object to store aggregated data based on menu id
                var aggregatedData = {};

                // Iterate through each order in the data
                data.forEach(function(order) {
                    var menuId = order.menu_id;

                    // If menu id is not in aggregatedData, add it; otherwise, update quantity and total
                    if (!aggregatedData[menuId]) {
                        aggregatedData[menuId] = {
                            quantity: order.quantity,
                            total: order.total
                        };
                    } else {
                        aggregatedData[menuId].quantity += order.quantity;
                        aggregatedData[menuId].total += order.total;
                    }
                });

                // Display the aggregated data in the table
                var tbody = $('#orderDetails tbody');
                for (var menuId in aggregatedData) {
                    var row = '<tr><td>' + menuId + '</td><td>' + aggregatedData[menuId].quantity + '</td><td>' +
                        aggregatedData[menuId].total + '</td></tr>';
                    tbody.append(row);
                }
            }
        });
    </script> --}}

    <script>
        $(document).ready(function() {
            var filterDateInput = $('#filterDate');
            var tbody = $('#orderDetails tbody');

            // Initial load
            fetchData();

            // Function to make an AJAX request and process the data
            function fetchData() {
                $.ajax({
                    url: 'http://localhost/acrh/role-permission/public/orderdetailsapi',
                    method: 'GET',
                    success: function(data) {
                        processData(data);
                    },
                    error: function(error) {
                        console.error('Error fetching data:', error);
                    }
                });
            }

            // Function to process and display the data
            function processData(data) {
                // Clear existing rows
                tbody.empty();

                // Create an object to store aggregated data based on menu id
                var aggregatedData = {};

                // Iterate through each order in the data
                data.forEach(function(order) {
                    var menuId = order.menu_id;

                    // If menu id is not in aggregatedData, add it; otherwise, update quantity and total
                    if (!aggregatedData[menuId]) {
                        aggregatedData[menuId] = {
                            menuName: order.menu.name,
                            date: order.created_at,
                            quantity: order.quantity,
                            total: order.total
                        };
                    } else {
                        aggregatedData[menuId].quantity += order.quantity;
                        aggregatedData[menuId].total += order.total;
                    }
                });

                // Display the aggregated data in the table
                for (var menuId in aggregatedData) {
                    var row = '<tr><td>' + menuId + '</td><td>' + aggregatedData[menuId].menuName + '</td><td>' +
                        aggregatedData[menuId].quantity + '</td><td>' + aggregatedData[menuId].total + '</td><td>' +
                        aggregatedData[menuId].date + '</td></tr>';
                    tbody.append(row);
                }
            }

            // Function to filter data based on the selected date
            window.filterData = function() {
                var selectedDate = filterDateInput.val();

                // Make an AJAX request with the selected date as a parameter
                $.ajax({
                    url: 'http://localhost/acrh/role-permission/public/orderdetailsapi?date=' +
                        selectedDate,
                    method: 'GET',
                    success: function(data) {
                        processData(data);
                    },
                    error: function(error) {
                        console.error('Error fetching filtered data:', error);
                    }
                });
            };
        });
    </script>
@endsection
