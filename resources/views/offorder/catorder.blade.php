@extends('layouts.main')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        .form-check-label {
            text-transform: capitalize;
        }

        @import url('https://fonts.googleapis.com/css2?family=Oranienbaum&family=Share+Tech+Mono&display=swap');

        .r-text {
            font-size: 18px;
        }

        @media print {
            * {
                font-family: 'Oranienbaum', serif;
                /* font-family: 'Share Tech Mono', monospace; */
                font-weight: 900 !important;
            }

            .pnone {
                display: none;
            }

            .r-text {
                font-size: 13px;
            }

            @page {

                margin: .08cm;
            }
        }
    </style>
@endsection
@section('content')
    <div class="my-5">
        <div class="card">
            <div class="row m-3">

                <div class="col-md-8">
                    <!--<div class="input-group mb-3">-->
                    <!--    <input type="text" class="form-control" placeholder="Search Product" aria-label="Username"-->
                    <!--        aria-describedby="basic-addon1">-->
                    <!--    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i></span>-->
                    <!--</div>-->
                    <div class="card  mb-1">
                        <div class="card-header py-3">
                            <div class="row row-cols-4 row-cols-md-5 g-3">

                                @foreach ($cats as $item)
                                    <div class="col">

                                        <div class="btn btn-outline-success catbtn " id="catbtn"><span
                                                class="cid d-none">{{ $item->id }}</span>{{ $item->name }}</div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                    <div class="">
                        <div class="row row-cols-1 row-cols-md-4 g-4" id="menuContainer">




                        </div>
                    </div>

                </div>
                <div class="col-md-4">
                    <div id="print" class="card p-2">
                        <div class="btn btn-outline-info d-print-none" id="staffCheckbox"> Staff</div>
                        <div class="d-none d-print-block">


                            <div class="fs-3 text-center r-heading">Green Kitchen</div>
                            <div class="r-text text-center">Islam Tower,Dhanmondi-32(Sukrabad), Mirpur Road,Dhaka-1207 <br>
                                Mobile No:
                                09666747470
                            </div>
                            <div class="d-flex justify-content-between my-2">
                                <div class="r-text ">
                                    Date: @php
                                        $currentDateTime = date('Y-m-d H:i:s');
                                        echo $currentDateTime;
                                    @endphp

                                </div>

                                <div class="r-text">Invoice ID: 000{{ $lastOrderId + 1 }}</div>
                            </div>
                        </div>
                        <ol>
                            <div class="row r-text mb-2">
                                <div class="col-2">
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

                        </ol>
                        <div class="mt-4">
                            <span>Total Bill: </span>
                            <span id="total-order"></span>
                            <span>TK</span>
                        </div>
                        {{-- <div>
                            <span>Tax: </span>
                            <span id="tax">50</span>
                            <span>TK</span>
                        </div> --}}
                        <div class="form-row my-2">
                            <div class="form-group col-md-6 col-sm-6">
                                <label for="staffs">Staff Name</label>
                                <select name="staffs" id="staffs" class="form-control select2">
                                    <option value="0">Customer</option>
                                    @foreach ($staffs as $staff)
                                        <option value="{{ $staff->id }}"
                                            data-sname="{{ $staff->name }}-{{ $staff->employeeId }}">{{ $staff->name }} -
                                            {{ $staff->employeeId }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!--<div>-->

                        <!--    <div class="d-print-none">-->
                        <!--        <div class="input-group mb-3">-->
                        <!--            <input type="text" class="form-control" id="dis_input"-->
                        <!--                placeholder="Discount Amount In TK" aria-label="Username"-->
                        <!--                aria-describedby="basic-addon1">-->
                        <!--            <span class="input-group-text btn btn-outline-danger" id="apply_dis">Apply-->
                        <!--                Discount</span>-->
                        <!--        </div>-->
                        <!--        <input type="text" class="form-control" id="reason" placeholder="Reason Of Discount">-->
                        <!--    </div>-->


                        <!--</div>-->

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
                        <div class="text-center d-none d-print-block">
                            Thank You <br> Please Visit Again <br> Print By:
                            @if (Auth::Check())
                                {{ Auth::user()->name }}
                            @endif
                            <br>
                            <img height="70px" src="{{ asset('assets/img/pngegg.png') }}" alt="">
                        </div>
                    </div>
                    <button class="btn btn-outline-danger pnone mt-5" id="submitp">Submit Order</button>
                </div>

            </div>

        </div>

    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        })

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="X-CSRF-TOKEN"]').attr('content')
            }
        });
        $(document).ready(function() {
            // product show by category
            function render_quiz_questions(quizzes) {
                let q = "";
                quizzes.forEach(menu => {
                    let html = '';

                    var cDiscount = menu.price - Math.round(((menu.category.discount * menu.price) / 100) /
                        5) * 5;
                    var sDiscount = cDiscount - Math.round(((menu.discount * cDiscount) / 100) / 5) * 5;

                    html +=

                        `<div class="col" >
                            <div class="card h-100">
                                    <img src="{{ asset('storage/menu') }}/${ menu.image }" height="130px"
                                        class="card-img-top" alt="${ menu.image }">
                                    <div class="card-body">
                                        <span class="id d-none">${ menu.id }</span>
                                        <h5 class="card-title clr name">${ menu.name }</h5>
                                        <div class="card-text ">
                                           <div class="text-decoration-line-through">
                                                <span>Price: </span><span class="price"> ${ menu.price }</span>TK
                                                </div>
                                           <div>
                                            <span>Discount Price:</span>
                                           <span  class="price customer"> ${cDiscount }</span>
                                            <span  class="sprice d-none staff"> ${sDiscount}</span>
                                            </div>
                                            
                                        </div>
                                        <div class="text-center mt-3">
                                            <button class="btn btn-outline-danger select">Add</button>
                                             <button class="btn btn-outline-danger d-none staff">Staff</button>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        `;

                    q += html;

                });
                $("#menuContainer").html(q);

            } <
            !--staff controlle js-- >
            $('#staffCheckbox').click(function() {

                $('.staff').removeClass('d-none');
                $('.select').addClass('d-none');
                $('.customer').addClass('d-none');
                let sName = $('#staffs').data('sname');

                $('#invoiceStaff').text('Staff-Invoice');


            });
            // mostak
            $(".catbtn").click(function() {
                var id = $(this).find('.cid').html();
                console.log(id);
                $.ajax({
                        method: "GET",
                        url: "{{ url('catmenu') }}/" + (id ?? 1),


                        dataType: "json",
                        success: function(response) {
                            render_quiz_questions(response);
                        }
                    })
                    .done(function(data) {
                        if (data.length != 0) {
                            //show the quiz
                        } else {
                            console.log("no quiz in the databaes");
                        }
                    });
            });
            $("#catbtn").trigger('click');

            // select product from card and input into menu
            $(document).on('click', '.select', function() {
                // $('.select').click(function() {
                var id = $(this).closest('.col').find('.id').text();
                var name = $(this).closest('.col').find('.name').text();
                var price = $(this).closest('.col').find('.price').text();
                var dis = $(this).closest('.col').find('.discount').text();

                // Check if an item with the same id already exists
                var existingItem = $('#orders').find(`.order-item[data-id="${id}"]`);

                if (existingItem.length > 0) {
                    var quantity = parseInt(existingItem.find('.quantity').val());
                    quantity++;
                    existingItem.find('.quantity').val(quantity);
                    var total = (parseFloat(price) * quantity).toFixed(2);
                    existingItem.find('.total').text(total);
                } else if (dis == price) {
                    var orderItem = `
                    <li class="order-item mb-2" data-id="${id}">
                        <div class="row">
                                        <div class="col-2">
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
                                           
                                            <span class="">${dis}</span>
                                            <span >TK</span>
                                            
                                        </div>
                                        <div class="col-2">
                                            
                                            <span class="total">${dis}</span>
                                            <span >TK</span>
                                        </div>
                                        <div class="col-3">
                                            <button class="pnone btn btn-outline-danger remove-item">Remove</button>
                                        </div>
                        </div>
                    
                   
                    </li> `;


                    $('#orders').append(orderItem);
                } else {
                    var orderItem = `
                    <li class="order-item mb-2" data-id="${id}">
                        <div class="row">
                                        <div class="col-2">
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
                                        <div class="col-3">
                                            <button class="pnone btn btn-outline-danger remove-item">Remove</button>
                                        </div>
                        </div>
                    
                   
                    </li> `;


                    $('#orders').append(orderItem);
                }
                updateSubtotal();
                payAmount();
            });

            $(document).on('click', '.staff', function() {
                // $('.select').click(function() {
                var id = $(this).closest('.col').find('.id').text();
                var name = $(this).closest('.col').find('.name').text();
                var dis = $(this).closest('.col').find('.sprice').text();
                var price = $(this).closest('.col').find('.discount').text();

                // Check if an item with the same id already exists
                var existingItem = $('#orders').find(`.order-item[data-id="${id}"]`);



                if (existingItem.length > 0) {
                    var quantity = parseInt(existingItem.find('.quantity').val());
                    quantity++;
                    existingItem.find('.quantity').val(quantity);
                    var total = (parseFloat(dis) * quantity).toFixed(2);
                    existingItem.find('.total').text(total);
                } else if (dis == price) {
                    var orderItem = `
                    <li class="order-item mb-2" data-id="${id}">
                        <div class="row">
                                        <div class="col-2">
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
                                           
                                            <span class="">${dis}</span>
                                            <span >TK</span>
                                            
                                        </div>
                                        <div class="col-2">
                                            
                                            <span class="total">${dis}</span>
                                            <span >TK</span>
                                        </div>
                                        <div class="col-3">
                                            <button class="pnone btn btn-outline-danger remove-item">Remove</button>
                                        </div>
                        </div>
                    
                   
                    </li> `;


                    $('#orders').append(orderItem);
                } else {
                    var orderItem = `
                    <li class="order-item mb-2" data-id="${id}">
                        <div class="row">
                                        <div class="col-2">
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
                                        <div class="col-3">
                                            <button class="pnone btn btn-outline-danger remove-item">Remove</button>
                                        </div>
                        </div>
                    </li> `;
                    $('#orders').append(orderItem);
                }

                updateSubtotal();
                payAmount();
            });

            $(document).on('input', '.quantity', function() {
                var quantity = $(this).val();
                var price = $(this).closest('.order-item').find('.order-price').text();
                var total = (parseFloat(price) * parseInt(quantity)).toFixed(2);
                $(this).closest('.order-item').find('.total').text(total);

                updateSubtotal();
                payAmount();
            });

            $(document).on('click', '.remove-item', function() {
                $(this).closest('.order-item').remove();
                updateSubtotal();
                payAmount();
            });
            $(document).on('click', '.staff', function() {
                $(this).closest('.order-item').remove();
                updateSubtotal();
                payAmount();
            });

            function updateSubtotal() {
                var subtotal = 0;
                $('#orders .order-item').each(function() {
                    var price = parseFloat($(this).find('.order-price').text());
                    var quantity = parseInt($(this).find('.quantity').val());
                    $(this).find('.order-q').text(quantity);
                    subtotal += (price * quantity);
                });

                $('#total-order').text(subtotal.toFixed(2));
            }

            $('#apply_dis').click(function() {
                var disc = parseInt($('#dis_input').val());
                $('#discount').text(disc);
                var tbill = parseFloat($('#total-order').text());
                var tax = parseFloat($('#tax').text());
                var dis = parseFloat($('#discount').text());

                var num = tbill - dis;
                $('#total-order2').text(num);
            })

            function payAmount() {


                var tbill = parseFloat($('#total-order').text());
                var tax = parseFloat($('#tax').text());
                var dis = parseFloat($('#discount').text());

                var num = tbill - dis;
                $('#total-order2').text(num);
            }




            // order Submitted

            $('#submitp').click(function() {
                var items = [];
                var totalbill = $('#total-order').text();
                var discount = $('#discount').text();
                var reason = $('#reason').val();
                var staff = parseFloat($('#staffs').val());
                var sInvoice = $('#invoiceStaff').text();
                let selectedOption = $('#staffs').find(':selected');
                let sNameAttribute = selectedOption.data('sname');
                let sNameText = selectedOption.text();
                if (sInvoice === "Staff-Invoice" && staff === 0) {

                    Swal.fire({
                        icon: 'warning',
                        title: 'Input Staff Name',
                        showCancelButton: false,
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                        customClass: {
                            confirmButton: 'btn btn-primary'
                        }
                    });

                    return;
                }
                if (discount > 0 && reason === "") {

                    Swal.fire({
                        icon: 'warning',
                        title: 'Input Discount Reason' + discount + reason,
                        showCancelButton: false,
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                        customClass: {
                            confirmButton: 'btn btn-primary'
                        }
                    });

                    return;
                }
                if (discount == 0 && reason !== "") {

                    Swal.fire({
                        icon: 'warning',
                        title: 'Apply Discount Or Remove Reason',
                        showCancelButton: false,
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                        customClass: {
                            confirmButton: 'btn btn-primary'
                        }
                    });

                    return;
                }

                $('#orders .order-item').each(function() {
                    var id = $(this).data('id');
                    var quantity = $(this).find('.order-q').html();

                    items.push({
                        id: id,
                        quantity: quantity
                    });
                });

                let csrfToken = $('meta[name="csrf-token"]').attr('content');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                });

                $.ajax({
                    url: '{{ url('offorder') }}',
                    type: 'POST',
                    data: {
                        items: items,
                        totalbill: totalbill,
                        discount: discount,
                        reason: reason
                    },
                    success: function(response) {
                        if (response.success) {
                            console.log(response.data);
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });

                // print section

                var printContents = $('#print').html();
                $(".order-q").removeClass("d-none");
                var originalContents = document.body.innerHTML;
                document.body.innerHTML = printContents;
                window.print();
                document.body.innerHTML = originalContents;


                $("#orders").empty();
                location.reload();

            });
            // Printn
            // $('#submitp').click(function() {
            //     var printContents = $('#print').html();
            //     $(".order-q").removeClass("d-none");
            //     var originalContents = document.body.innerHTML;
            //     document.body.innerHTML = printContents;
            //     window.print();
            //     document.body.innerHTML = originalContents;


            //     $("#orders").empty();
            //     location.reload();
            // });


        });
    </script>
@endsection
