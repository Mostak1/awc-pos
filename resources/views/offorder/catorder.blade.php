@extends('layouts.main')

@section('style')
   
@endsection

@section('content')
    <div class="container afterNav">

        <div class="card card-hover shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-info">Random Quiz</h6>
                
            </div>

            <div class="card-body">
                <section>

                    <div class="card  mb-1">
                        <div class="card-header py-3 d-flex justify-content-between">
                          
                            @foreach ($cats as $item)
                                <div class="btn btn-outline-success catbtn " id="catbtn"><span
                                        class="cid">{{ $item->id }}</span>{{ $item->name }}</div>
                            @endforeach

                        </div>
                    </div>
                </section>

                <div class="container mb-1 mt-5">
                    
                    <div class="row row-cols-1 row-cols-md-4 g-4" id="menuContainer">




                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.navbar-toggler-icon').trigger('click');
        $(document).ready(function() {



            function render_quiz_questions(quizzes) {
                let q = "";
                quizzes.forEach(menu => {
                    let html = '';



                    html +=

                        `<div class="col" >
                            <div class="card h-100">
                                    <img src="{{ asset('storage/menu') }}/${ menu.image }" height="130px"
                                        class="card-img-top" alt="${ menu.image }">
                                    <div class="card-body">
                                        <span class="id d-none">${ menu.id }</span>
                                        <h5 class="card-title clr name">${ menu.name }</h5>
                                        <div class="card-text ">
                                            <span>Price: </span><span class="price"> ${ menu.price }</span>TK
                                            
                                        </div>
                                        <div class="text-center mt-3">
                                            <button class="btn btn-outline-danger select">Add</button>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        `;

                    q += html;

                });
                $("#menuContainer").html(q);

            }
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


        });
    </script>
@endsection
