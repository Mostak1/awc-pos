@extends('layouts.main')
@section('css')
    <style>
        @media print {

            table,
            .ptext {
                font-size: 10pt;
                margin-bottom: 1px;
            }

            th,
            td {
                padding: 0px;
                height: 4px;

            }



            @page {
                margin: 0.1in;
            }
        }
    </style>
@endsection
@section('content')
    <div class="container">


        <div id="layoutSidenav_content">
            <main>
                <!-- changed content -->
                @php
                    $user = Auth::guard('web')->user();
                @endphp
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
                                            <th colspan="8" class="tablebtn text-end">
                                                <span class="me-2">
                                                    Cash {{ $cash }},
                                                    bKash {{ $bkash }},
                                                    Card {{ $card }}

                                                </span>
                                                <span>@php
                                                    $currentDate = date('d M Y');

                                                    echo $currentDate; // 5 OCT 2023

                                                @endphp</span>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>Order ({{ $orderCountD }})</th>
                                            <th>Food Name</th>
                                            <th>Payment Method ({{ $bkash }})</th>
                                            <th>Total Amount ({{ $totalSalesD }} TK)</th>
                                            <th>Discount ({{ $totalDisD }} TK)</th>
                                            <th>Reason</th>
                                            <th>Net Sale: {{ $totalSalesD - $totalDisD }} TK</th>
                                            <th>Order Slip</th>

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
                                                <td>{{ $offorder->payment->method }}</td>
                                                <td>{{ $offorder->total }}</td>
                                                <td>{{ $offorder->discount }}</td>
                                                <td>{{ $offorder->reason }}</td>
                                                <td>{{ $offorder->total - $offorder->discount }}</td>
                                                <td>
                                                    {{-- <button class="btn btn-outline-info print-btn"
                                                        data-id="{{ $offorder->id }}">Print </button> --}}
                                                    <button type="button" class="btn btn-outline-info print-btn"
                                                        data-id="{{ $offorder->id }}" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal">
                                                        Print
                                                    </button>

                                                </td>
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
                            <h4 class="m-0 font-weight-bold text-info">Order Report Table</h4>
                            <div class="m-0 font-weight-bold btn btn-outline-info" id="submitp"><i
                                    class="fa-solid fa-print"></i></div>

                        </div>
                        <div class="card-body mt-4">
                            @if ($user->can('category.index') || $user->can('subcategory.index') || $user->can('tab.index'))
                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                                aria-expanded="false" aria-controls="flush-collapseOne">
                                                Apply Filter
                                            </button>
                                        </h2>
                                        <div id="flush-collapseOne" class="accordion-collapse collapse"
                                            data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">


                                                <div class="row row-cols-4 g-4 mb-2">
                                                    <div class="col">
                                                        <label class="form-label" for="filterDate">Filter by Date:</label>
                                                        <input class="form-control" type="date" id="filterDate">
                                                    </div>

                                                    <div class="col">
                                                        <label class="form-label" for="filterCategory">Filter by
                                                            Category:</label>
                                                        <select class="form-select" id="filterCategory">
                                                            <option value="">All Categories</option>
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->name }}">
                                                                    {{ $category->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col">
                                                        <label class="form-label" for="filterStaff">Filter by
                                                            Staff/Customer:</label>
                                                        <select class="form-select" id="filterStaff">
                                                            <option value="">Select</option>
                                                            <option value="1">Staff</option>
                                                            <option value="2">Customer</option>
                                                        </select>
                                                    </div>
                                                    <div class="col">
                                                        <label class="form-label" for="filterDateRange">Filter by Date
                                                            Range:</label>
                                                        <input class="form-control mb-1" type="date"
                                                            id="filterStartDate">
                                                        <input class="form-control" type="date" id="filterEndDate">
                                                    </div>
                                                    <div class="col">
                                                        <label class="form-label" for="filterTimeRange">Filter by Time
                                                            Range:</label>
                                                        <input class="form-control mb-1" type="time"
                                                            id="filterStartTime">
                                                        <input class="form-control" type="time" id="filterEndTime">
                                                    </div>
                                                </div>
                                                <span class="me-4">
                                                    <button class="btn btn-outline-info" type="button"
                                                        id="applyFilters">Apply Filters</button>
                                                </span>
                                                <span class="">
                                                    <button class="btn btn-outline-info" type="button"
                                                        id="clearFilters">Clear Filters</button>
                                                </span>


                                            </div>
                                        </div>
                                    </div>

                                </div>
                            @endif
                            <div class="table-responsive" id="">
                                <div class="text-center fs-2 d-none d-print-block">Green-Kitchen Daily Report</div>
                                <div class="text-center fs-3" id="filterHead"></div>
                                <table class="table table-bordered" id="orderDetails" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Menu Name</th>
                                            <th>Category</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                            <th>Date</th>
                                            <!-- Add more table headers based on your new filters -->
                                        </tr>
                                    </thead>
                                    {{-- <tbody id="tableBody">

                                    </tbody> --}}

                                </table>
                                <div id="totalsale">
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="card p-4 d-none d-print-block">
                        <div class="row fs-6" id="printTable">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <div class="text-center fs-5">Green-Kitchen Daily Report</div>
                                    <div class="py-1 ptext d-flex flex-row align-items-center justify-content-between">
                                        <span class="m-0 font-weight-bold ">Date: @php
                                            $currentDate = date('d M Y');

                                            echo $currentDate; // 5 OCT 2023

                                        @endphp
                                        </span>
                                        <span>
                                            Total Order: {{ $orderCountD }}
                                        </span>
                                        <span>
                                            Total Sale: {{ $totalSalesD }}TK ; Cash: {{ $cash }}TK; Bkash:
                                            {{ $bkash }}TK; Card: {{ $card }}TK
                                        </span>
                                    </div>
                                    <div class="text-center fs-5">Staff </div>

                                    <table class="table table-bordered" id="stafforderdetails" width="100%"
                                        cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Menu Name</th>
                                                <th>Category</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Total</th>

                                                <!-- Add more table headers based on your new filters -->
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                    <div id="stafftotal">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="table-responsive" id="">
                                    <div class="text-center fs-5">Customer</div>
                                    <div class="text-center fs-3" id="filterHead"></div>
                                    <table class="table table-bordered" id="customerdata" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Menu Name</th>
                                                <th>Category</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                    <div id="customertotal">
                                       
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="p-4 rounded-4 Larger shadow  bg-white card-hover  my-5">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h4 class="m-0 font-weight-bold text-info">Order Report Chart Product Vs Sale Quantity</h4>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body mt-4">
                            <div class="accordion accordion-flush" id="accordionFlushExample1">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#flush-collapseOne1"
                                            aria-expanded="false" aria-controls="flush-collapseOne1">
                                            Apply Filter
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne1" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionFlushExample1">
                                        <div class="accordion-body">


                                            <div class="row row-cols-4 g-4 mb-2">
                                                <div class="col">
                                                    <label class="form-label" for="filterDate1">Filter by Date:</label>
                                                    <input class="form-control" value="{{ $currentDate }}"
                                                        type="date" id="filterDate1">
                                                </div>

                                                <div class="col">
                                                    <label class="form-label" for="filterCategory1">Filter by
                                                        Category:</label>
                                                    <select class="form-select" id="filterCategory1">
                                                        <option value="">All Categories</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->name }}">{{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col">
                                                    <label class="form-label" for="filterStaff">Filter by
                                                        Staff/Customer:</label>
                                                    <select class="form-select" id="filterStaff1">
                                                        <option value="">Select</option>
                                                        <option value="1">Staff</option>
                                                        <option value="2">Customer</option>
                                                    </select>
                                                </div>

                                                <div class="col">
                                                    <label class="form-label" for="filterDateRange1">Filter by Date
                                                        Range:</label>
                                                    <input class="form-control mb-1" type="date"
                                                        id="filterStartDate1">
                                                    <input class="form-control" type="date" id="filterEndDate1">
                                                </div>
                                                <div class="col">
                                                    <label class="form-label" for="filterTimeRange1">Filter by Time
                                                        Range:</label>
                                                    <input class="form-control mb-1" type="time"
                                                        id="filterStartTime1">
                                                    <input class="form-control" type="time" id="filterEndTime1">
                                                </div>
                                            </div>
                                            <span class="me-3">
                                                <button class="btn btn-outline-info" type="button"
                                                    id="applyFilters1">Apply Filters</button>
                                            </span>
                                            <span class="">
                                                <button class="btn btn-outline-info" type="button"
                                                    id="clearFilters1">Clear Filters</button>
                                            </span>


                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div>
                                <canvas id="myChart"></canvas>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- changed content  ends-->
            </main>
            <!-- footer -->
        </div>
    </div>
    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Money Receipt</h1>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                </div>
                <div class="modal-body">
                    <div id="print" class="card p-2">
                        <div class=" d-print-block">
                            <div class="fs-3 text-center r-heading">GREEN KITCHEN</div>
                            <div class="r-text text-center">Islam Tower,2nd Floor,102 Shukrabad,Dhanmondi-32,Dhaka-1207
                                <br>
                                Phone#
                                01979756069
                            </div>
                            <div class="aw-ul">----------------------------</div>

                            <div class="d-flex justify-content-between my-2">
                                <div class="r-text ">
                                    Date: @php
                                        $currentDateTime = date('Y-m-d');
                                        echo $currentDateTime;
                                    @endphp

                                </div>

                                <div class="r-text ">
                                    Time: @php
                                        $currentTime = date('H:i A');
                                        echo $currentTime;
                                    @endphp

                                </div>


                            </div>
                            <div class="d-flex justify-content-between my-2">
                                <div class="fs-2 font-weight-bold">Paid</div>
                                <div class="r-text">Invoice ID: 000
                                </div>
                            </div>
                        </div>
                        <div class="row row-cols-1 d-none d-print-block">
                            <div class="col">Payment Methode: <span id="paymentMethod1">Cash</span></div>
                            <div class="col"> <span id="transactionId1"></span></div>
                        </div>
                        <div class="row row-cols-2 d-print-none">

                            <div class="mb-3 col">
                                <label for="paymentMethod" class="form-label">Select Payment Method</label>
                                <select class="form-select" id="paymentMethod" name="paymentMethod">
                                    <option value="cash">Cash</option>
                                    <option value="bkash">Bkash</option>
                                    <option value="card">Card</option>
                                </select>
                            </div>
                            <div class="col">

                                <div class="mb-3 d-none" id="bkashInput">
                                    <label for="transactionId" class="form-label">Transaction ID</label>
                                    <input type="text" class="form-control" id="transactionId" name="transactionId"
                                        required>
                                </div>

                                <div class="mb-3 d-none" id="cardInput">
                                    <label for="cardLastDigits" class="form-label">Laast 4 digit of Card</label>
                                    <input type="text" class="form-control" id="cardLastDigits" name="cardLastDigits"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div id="invoiceStaff" class="text-center text-danger fs-4 my-2">

                        </div>
                        <div class="aw-ul text-center">----------------------</div>

                        <div class="row r-text mb-2">
                            <div class="col-3">
                                Item
                            </div>
                            <div class="col-2">
                                Qty
                            </div>
                            <div class="col-3">
                                Price
                            </div>
                            <div class="col-2">
                                Total
                            </div>
                        </div>

                        <div class="orders r-text" id="orders">

                        </div>


                        <div class="mt-4">
                            <span>GROSS Total: </span>
                            <span id="total-order"></span>
                            <span>TK</span>
                        </div>


                        <div class="form-row my-2">
                            <div class="form-group col-md-6 col-sm-6" id="reason">

                            </div>
                        </div>


                        <div class="">
                            <span>Special Discount: </span>
                            <span id="discount">0</span>
                            <span>TK</span>
                        </div>
                        <div>
                            <span>Ammount to Pay: </span>
                            <span id="total-order2"></span>
                            <span>TK</span>
                        </div>

                        <div class="aw-ul text-center">----------------------</div>

                        <div class="d-none d-print-block">
                            THANK YOU, COME AGAIN <br> Print By:
                            @if (Auth::Check())
                                {{ Auth::user()->name }}
                            @endif

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- DataTables JavaScript -->
    {{-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.9/js/buttons.print.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(document).ready(function() {


            function orderPrint(items) {
                let q = "";
                items.forEach(order => {
                    let html = '';

                    html += `
                    <div class="order-item mb-2" data-id="${id}">
                        <div class="row">
                                        <div class="col-3">
                                            <div class="order-info d-inline">
                                                <span class="order-name">${name}</span>
                                                <span class="order-price d-none">${dis}</span>
                                                </div>
                                                </div>
                                                <div class="col-2">
                                                    <input type="number" class="quantity pnone" style="width:50px"  value="1" min="1">
                                                    <span class="order-q d-none d-print-block"></span>
                       
                                        </div>
                                        <div class="col-3 ">
                                            <div class="text-decoration-line-through">
                                                
                                                <span class="">${price}</span>
                                                <span >TK</span>
                                                </div>
                                            <span class="">${dis}</span>
                                            <span >TK</span>
                                            
                                        </div>
                                        <div class="col-2">
                                            
                                            <span class="total">${dis}</span>
                                            <span >TK</span>
                                        </div>
                                        <div class="col-2">
                                            <button class="pnone btn btn-outline-danger remove-item"><i class="fa-solid fa-xmark"></i></button>
                                        </div>
                        </div>
                    </div> 
                    `;

                });
                $("#orders").html(q);
            }
            $('.print-btn').click(function() {
                // alert('working')
                var orderId = $(this).data('id');

                // Make an AJAX request to fetch order details
                $.ajax({
                    type: 'GET',
                    url: '{{ url('printrecipt') }}/' + orderId,
                    success: function(data) {
                        orderPrint(data);
                        console.log(data);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });


            var filterDateInput = $('#filterDate');
            var filterCategoryInput = $('#filterCategory');
            var filterStartDateInput = $('#filterStartDate');
            var filterEndDateInput = $('#filterEndDate');
            var filterStartTimeInput = $('#filterStartTime');
            var filterEndTimeInput = $('#filterEndTime');
            var tbody = $('#orderDetails tbody');
            var staff = $('#filterStaff');

            var tfoot = $('#totalsale');
            // Initial load
            fetchData();

            // Apply filters button click event
            $('#applyFilters').on('click', function() {
                fetchData(); // Reload data when the Apply Filters button is clicked
                var stafffilter = staff.val();
                if (stafffilter == 1) {
                    // Handle the case when stafffilter is 0
                    $('#filterHead').text('Staff Report');
                } else if (stafffilter == 2) {
                    $('#filterHead').text('Customer Report');

                }
            });

            // clear filter
            $('#clearFilters').click(function() {
                // Reset filter input values after processing the data
                filterDateInput.val('');
                filterCategoryInput.val('');
                filterStartDateInput.val('');
                filterEndDateInput.val('');
                filterStartTimeInput.val('');
                filterEndTimeInput.val('');
                staff.val('');
                $('#filterHead').text('');
            })
            // Function to make an AJAX request and process the data
            function fetchData() {
                // Destroy existing DataTable instance (if it exists)
                if ($.fn.DataTable.isDataTable('#orderDetails')) {
                    $('#orderDetails').DataTable().destroy();
                }
                $.ajax({
                    url: '{{ url('orderdetailsapi') }}',
                    method: 'GET',
                    data: {
                        date: filterDateInput.val(),
                        category: filterCategoryInput.val(),
                        startDate: filterStartDateInput.val(),
                        endDate: filterEndDateInput.val(),
                        startTime: filterStartTimeInput.val(),
                        endTime: filterEndTimeInput.val(),
                        staff: staff.val(),
                    },
                    success: function(data) {
                        // console.log(data);
                        processData(data);
                        staffdata(data);
                        customerdata(data);

                        // Reset filter input values after processing the data
                        // filterDateInput.val('');
                        // filterCategoryInput.val('');
                        // filterStartDateInput.val('');
                        // filterEndDateInput.val('');
                        // filterStartTimeInput.val('');
                        // filterEndTimeInput.val('');
                        // staff.val('');
                    },
                    error: function(error) {
                        console.error('Error fetching data:', error);
                    }
                });

            }


            // Function to process and display the data
            function processData(data) {
                function getCurrentDate() {
                    var today = new Date();
                    var dd = String(today.getDate()).padStart(2, '0');
                    var mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
                    var yyyy = today.getFullYear();

                    return yyyy + '-' + mm + '-' + dd;
                }
                console.log(getCurrentDate());
                if (
                    filterDateInput.val() == '' &&
                    filterCategoryInput.val() == '' &&
                    filterStartDateInput.val() == '' &&
                    filterEndDateInput.val() == '' &&
                    filterStartTimeInput.val() == '' &&
                    filterEndTimeInput.val() == '' &&
                    staff.val() == ''
                ) {
                    var selectedDate = getCurrentDate();
                } else {
                    var selectedDate = filterDateInput.val();
                }



                // Populate the category filter dropdown dynamically
                var uniqueCategories = [...new Set(data.map(order => order.menu.category.name))];
                var categorySelect = $('#filterCategory');




                // // categorySelect.empty();
                // categorySelect.append('<option value="">All Categories</option>');
                // // Add options based on unique categories
                // uniqueCategories.forEach(category => {

                //     categorySelect.append('<option value="' + category + '">' + category + '</option>');
                // });

                // Filter data based on the selected date and additional criteria
                var filteredData = data.filter(function(order) {
                    var orderDate = order.created_at.split('T')[0];

                    // Assuming date format from the API is in 'YYYY-MM-DD'
                    if (selectedDate && orderDate !== selectedDate) {
                        return false;
                    }

                    // Add more conditions for other filters (category, date range, time range)
                    if (filterCategoryInput.val() && order.menu.category.name !== filterCategoryInput
                        .val()) {
                        return false;
                    }
                    if (order.off_order.active == staff.val()) {
                        return false;
                    }


                    // Date range filter
                    if (filterStartDateInput.val() && filterEndDateInput.val()) {
                        var orderDateTime = new Date(order.created_at);
                        var filterStartDate = new Date(filterStartDateInput.val());
                        var filterEndDate = new Date(filterEndDateInput.val());

                        if (orderDateTime < filterStartDate || orderDateTime > filterEndDate) {
                            return false;
                        }
                    }

                    // Time range filter
                    if (filterStartTimeInput.val() && filterEndTimeInput.val()) {
                        var orderTime = order.created_at.split('T')[1].substring(0, 5);
                        var filterStartTime = filterStartTimeInput.val();
                        var filterEndTime = filterEndTimeInput.val();

                        if (orderTime < filterStartTime || orderTime > filterEndTime) {
                            return false;
                        }
                    }
                    return true;
                });
                // Clear existing rows
                tbody.empty();
                tfoot.empty();
                // Clear existing options

                // Create an object to store aggregated data based on menu id
                var aggregatedData = {};

                // Iterate through each order in the filtered data
                filteredData.forEach(function(order) {
                    var menuId = order.menu_id;
                    var reason = order.off_order.reason;
                    console.log(menuId, reason);
                    // If menu id is not in aggregatedData, add it; otherwise, update quantity and total

                    if (!aggregatedData[menuId]) {
                        var cDiscount = order.menu.price - Math.round(((order.menu.category.discount * order
                                .menu.price) / 100) /
                            5) * 5;
                        var sDiscount = cDiscount - Math.round(((order.menu.discount * cDiscount) / 100) /
                            5) * 5;

                        if (order.off_order.active == 2) {
                            aggregatedData[menuId] = {
                                menuName: order.menu.name,
                                category: order.menu.category.name,
                                date: order.created_at,
                                quantity: order.quantity,
                                price: sDiscount,
                                total: order.total,
                            };
                        } else if (order.off_order.active == 1) {
                            aggregatedData[menuId] = {
                                menuName: order.menu.name,
                                category: order.menu.category.name,
                                date: order.created_at,
                                quantity: order.quantity,
                                price: cDiscount,
                                total: order.total,
                            };
                        }

                    } else {
                        aggregatedData[menuId].quantity += order.quantity;
                        aggregatedData[menuId].total += order.total;
                    }

                });

                // ...
                console.log(aggregatedData);
                console.log(data);

                var filterdataArray = $.map(aggregatedData, function(value) {
                    return value;
                });

                console.log(filterdataArray);

                $('#orderDetails').DataTable({
                    data: filterdataArray,
                    columns: [{
                            data: 'menuName'
                        },
                        {
                            data: 'category'
                        },
                        {
                            data: 'quantity'
                        },
                        {
                            data: 'price'
                        },
                        {
                            data: 'total'
                        },
                        {
                            data: 'date'
                        }
                    ],
                    buttons: [
                        'copy',
                        'excel',
                        'pdf',
                        'print' // Add the 'print' button for printing
                    ]

                });
                var subTotalQuantity = 0;
                var subTotalTotal = 0;

                for (var menuId in aggregatedData) {
                    subTotalQuantity += aggregatedData[menuId].quantity;
                    subTotalTotal += aggregatedData[menuId].total;
                }

                // Append a new row at the bottom with the sub-total
                var subTotalRow = '<div class="sub-total"><span >Total Quantity: </span><span class="me-2">' +
                    subTotalQuantity + 'Pices </span><span>Total Sale: </span><span>' + subTotalTotal +
                    'TK </span></div>';
                tfoot.append(subTotalRow);


            }
            // Function to process and display the Staff  data for current date
            function staffdata(data) {
                function getCurrentDate() {
                    var today = new Date();
                    var dd = String(today.getDate()).padStart(2, '0');
                    var mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
                    var yyyy = today.getFullYear();

                    return yyyy + '-' + mm + '-' + dd;
                }
                console.log(getCurrentDate());

                var selectedDate = getCurrentDate();
                var filteredData = data.filter(function(order) {
                    var orderDate = order.created_at.split('T')[0];

                    // Assuming date format from the API is in 'YYYY-MM-DD'
                    if (selectedDate && orderDate !== selectedDate) {
                        return false;
                    }
                    if (order.off_order.active == 1) {
                        return false;
                    }
                    return true;

                });
                // Create an object to store aggregated data based on menu id
                var aggregatedData = {};

                // Iterate through each order in the filtered data
                filteredData.forEach(function(order) {
                    var menuId = order.menu_id;
                    var reason = order.off_order.reason;
                    console.log(menuId, reason);
                    // If menu id is not in aggregatedData, add it; otherwise, update quantity and total

                    if (!aggregatedData[menuId]) {
                        var cDiscount = order.menu.price - Math.round(((order.menu.category.discount * order
                                .menu.price) / 100) /
                            5) * 5;
                        var sDiscount = cDiscount - Math.round(((order.menu.discount * cDiscount) / 100) /
                            5) * 5;


                        aggregatedData[menuId] = {
                            menuName: order.menu.name,
                            category: order.menu.category.name,
                            date: order.created_at,
                            quantity: order.quantity,
                            price: sDiscount,
                            total: order.total,
                        };


                    } else {
                        aggregatedData[menuId].quantity += order.quantity;
                        aggregatedData[menuId].total += order.total;
                    }

                });

                // ...
                console.log(aggregatedData);
                console.log(data);

                var filterdataArray = $.map(aggregatedData, function(value) {
                    return value;
                });

                console.log('filterdataArray');
                console.log(filterdataArray);
                var tableBody = $('#stafforderdetails tbody');
                $.each(filterdataArray, function(index, data) {
                    var row = $('<tr>');
                    row.append($('<td>').text(data.menuName));
                    row.append($('<td>').text(data.category));
                    row.append($('<td>').text(data.quantity));
                    row.append($('<td>').text(data.price));
                    row.append($('<td>').text(data.total));

                    // Add more cells if there are additional properties in your data

                    tableBody.append(row);
                });

                var subTotalQuantity = 0;
                var subTotalTotal = 0;

                for (var menuId in aggregatedData) {
                    subTotalQuantity += aggregatedData[menuId].quantity;
                    subTotalTotal += aggregatedData[menuId].total;
                }

                // Append a new row at the bottom with the sub-total
                var subTotalRow =
                    '<div class="sub-total"><span >Total Quantity: </span><span class="me-2">' +
                    subTotalQuantity + 'Pices </span><span>Total Sale: </span><span>' + subTotalTotal +
                    'TK </span></div>';
                $('#stafftotal').append(subTotalRow);
            }
            // Function to process and display the Customer data for current date
            function customerdata(data) {
                function getCurrentDate() {
                    var today = new Date();
                    var dd = String(today.getDate()).padStart(2, '0');
                    var mm = String(today.getMonth() + 1).padStart(2, '0'); // January is 0!
                    var yyyy = today.getFullYear();

                    return yyyy + '-' + mm + '-' + dd;
                }
                console.log(getCurrentDate());

                var selectedDate = getCurrentDate();
                var filteredData = data.filter(function(order) {
                    var orderDate = order.created_at.split('T')[0];

                    // Assuming date format from the API is in 'YYYY-MM-DD'
                    if (selectedDate && orderDate !== selectedDate) {
                        return false;
                    }
                    if (order.off_order.active == 2) {
                        return false;
                    }
                    return true;

                });
                // Create an object to store aggregated data based on menu id
                var aggregatedData = {};

                // Iterate through each order in the filtered data
                filteredData.forEach(function(order) {
                    var menuId = order.menu_id;
                    var reason = order.off_order.reason;
                    console.log(menuId, reason);
                    // If menu id is not in aggregatedData, add it; otherwise, update quantity and total

                    if (!aggregatedData[menuId]) {
                        var cDiscount = order.menu.price - Math.round(((order.menu.category.discount * order
                                .menu.price) / 100) /
                            5) * 5;
                        var sDiscount = cDiscount - Math.round(((order.menu.discount * cDiscount) / 100) /
                            5) * 5;


                        aggregatedData[menuId] = {
                            menuName: order.menu.name,
                            category: order.menu.category.name,
                            date: order.created_at,
                            quantity: order.quantity,
                            price: cDiscount,
                            total: order.total,
                        };


                    } else {
                        aggregatedData[menuId].quantity += order.quantity;
                        aggregatedData[menuId].total += order.total;
                    }

                });

                // ...
                console.log(aggregatedData);
                console.log(data);

                var filterdataArray = $.map(aggregatedData, function(value) {
                    return value;
                });

                console.log('filterdataArray');
                console.log(filterdataArray);
                var tableBody = $('#customerdata tbody');
                $.each(filterdataArray, function(index, data) {
                    var row = $('<tr>');
                    row.append($('<td>').text(data.menuName));
                    row.append($('<td>').text(data.category));
                    row.append($('<td>').text(data.quantity));
                    row.append($('<td>').text(data.price));
                    row.append($('<td>').text(data.total));

                    // Add more cells if there are additional properties in your data

                    tableBody.append(row);
                });

                var subTotalQuantity = 0;
                var subTotalTotal = 0;

                for (var menuId in aggregatedData) {
                    subTotalQuantity += aggregatedData[menuId].quantity;
                    subTotalTotal += aggregatedData[menuId].total;
                }

                // Append a new row at the bottom with the sub-total
                var subTotalRow =
                    '<div class="sub-total"><span >Total Quantity: </span><span class="me-2">' +
                    subTotalQuantity + 'Pices </span><span>Total Sale: </span><span>' + subTotalTotal +
                    'TK </span></div>';
                $('#customertotal').append(subTotalRow);
            }
        });

        $(document).ready(function() {
            var filterDateInput1 = $('#filterDate1');
            var filterCategoryInput1 = $('#filterCategory1');
            var filterStartDateInput1 = $('#filterStartDate1');
            var filterEndDateInput1 = $('#filterEndDate1');
            var filterStartTimeInput1 = $('#filterStartTime1');
            var filterEndTimeInput1 = $('#filterEndTime1');
            var staff1 = $('#filterStaff1');
            var myChart; // Declare myChart outside the fetchData function

            // Initial load
            fetchData1();

            // Apply filters button click event
            $('#applyFilters1').on('click', function() {
                fetchData1(); // Reload data when the Apply Filters button is clicked


            });
            // clear filter
            $('#clearFilters1').click(function() {
                // Reset filter input values after processing the data
                filterDateInput1.val('');
                filterCategoryInput1.val('');
                filterStartDateInput1.val('');
                filterEndDateInput1.val('');
                filterStartTimeInput1.val('');
                filterEndTimeInput1.val('');
                staff1.val('');

            })
            // Function to make an AJAX request and process the data
            function fetchData1() {

                $.ajax({
                    url: '{{ url('orderdetailsapi') }}',
                    method: 'GET',
                    data: {
                        date: filterDateInput1.val(),
                        category: filterCategoryInput1.val(),
                        startDate: filterStartDateInput1.val(),
                        endDate: filterEndDateInput1.val(),
                        startTime: filterStartTimeInput1.val(),
                        endTime: filterEndTimeInput1.val(),
                    },
                    success: function(data) {
                        // console.log(data);
                        processData1(data);

                        // Reset filter input values after processing the data
                        // filterDateInput1.val('');
                        // filterCategoryInput1.val('');
                        // filterStartDateInput1.val('');
                        // filterEndDateInput1.val('');
                        // filterStartTimeInput1.val('');
                        // filterEndTimeInput1.val('');
                    },
                    error: function(error) {
                        console.error('Error fetching data:', error);
                    }
                });

            }


            // Function to process and display the data
            function processData1(data) {
                var selectedDate1 = filterDateInput1.val();


                // Populate the category filter dropdown dynamically
                var uniqueCategories1 = [...new Set(data.map(order => order.menu.category.name))];
                var categorySelect1 = $('#filterCategory1');





                // // Add options based on unique categories
                // uniqueCategories1.forEach(category => {
                //     categorySelect1.append('<option value="' + category + '">' + category + '</option>');
                // });

                // Filter data based on the selected date and additional criteria
                var filteredData1 = data.filter(function(order) {
                    var orderDate1 = order.created_at.split('T')[0];

                    // Assuming date format from the API is in 'YYYY-MM-DD'
                    if (selectedDate1 && orderDate1 !== selectedDate1) {
                        return false;
                    }

                    // Add more conditions for other filters (category, date range, time range)
                    if (filterCategoryInput1.val() && order.menu.category.name !==
                        filterCategoryInput1
                        .val()) {
                        return false;
                    }
                    if (order.off_order.active == staff1.val()) {
                        return false;
                    }
                    // Date range filter
                    if (filterStartDateInput1.val() && filterEndDateInput1.val()) {
                        var orderDateTime1 = new Date(order.created_at);
                        var filterStartDate1 = new Date(filterStartDateInput1.val());
                        var filterEndDate1 = new Date(filterEndDateInput1.val());

                        if (orderDateTime1 < filterStartDate1 || orderDateTime1 >
                            filterEndDate1) {
                            return false;
                        }
                    }

                    // Time range filter
                    if (filterStartTimeInput1.val() && filterEndTimeInput1.val()) {
                        var orderTime1 = order.created_at.split('T')[1].substring(0, 5);
                        var filterStartTime1 = filterStartTimeInput1.val();
                        var filterEndTime1 = filterEndTimeInput1.val();

                        if (orderTime1 < filterStartTime1 || orderTime1 > filterEndTime1) {
                            return false;
                        }
                    }

                    return true;

                });



                // Create an object to store aggregated data based on menu id
                var aggregatedData1 = {};

                // Iterate through each order in the filtered data
                filteredData1.forEach(function(order) {
                    var menuId1 = order.menu_id;

                    // If menu id is not in aggregatedData, add it; otherwise, update quantity and total
                    if (!aggregatedData1[menuId1]) {
                        aggregatedData1[menuId1] = {
                            menuName1: order.menu.name,
                            category1: order.menu.category.name,
                            date1: order.created_at,
                            quantity1: order.quantity,
                            total1: order.total
                        };
                    } else {
                        aggregatedData1[menuId1].quantity1 += order.quantity;
                        aggregatedData1[menuId1].total1 += order.total;
                    }
                });

                // ...




                // Convert aggregated data to arrays for Chart.js
                var labels = [];
                var quantities = [];

                for (var menuId1 in aggregatedData1) {
                    labels.push(aggregatedData1[menuId1].menuName1);
                    quantities.push(aggregatedData1[menuId1].quantity1);
                }

                // Destroy the existing chart instance (if it exists)
                if (myChart) {
                    myChart.destroy();
                }

                // Create a bar chart using Chart.js
                var ctx = document.getElementById('myChart').getContext('2d');
                myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Quantity Sold',
                            data: quantities,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: .5
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

            }


            // Printn
            $('#submitp').click(function() {
                var printContents = $('#printTable').html();

                var originalContents = document.body.innerHTML;
                document.body.innerHTML = printContents;
                window.print();
                document.body.innerHTML = originalContents;


                // $("#orders").empty();
                location.reload();
            });
        });
    </script>
@endsection
