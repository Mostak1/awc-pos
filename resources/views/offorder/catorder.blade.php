@extends('layouts.main')

@section('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endsection

@section('content')
    <div class="container afterNav">

        <div class="card card-hover shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-info">Dummy Page {{config('setting.c_name')}}</h6>
                <select class="js-data-example-ajax"></select>
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

                    <div style="border: 1px solid black; padding: 100px" class="container">
                        <div style="padding: 100px">
                            <div class="row">
                                <div class="col-md-8">
                                    {{-- <input class="prompt" type="text" placeholder="Search countries..." /> --}}
                                    <input type="text" id="searchInput" />

                                </div>
                                <div class="col-md-4">
                                    <a onclick="btn_handler()" class="btn btn-primary">Submit</a>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $('.js-data-example-ajax').select2({
            ajax: {
                url: 'https://api.github.com/search/repositories',
                dataType: 'json'
                // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
            }
        });
        $(document).ready(function() {
            // Fetch data from http://127.0.0.1:8000/menu


            $('#searchInput').select2({
                ajax: {
                    url: 'http://127.0.0.1:8000/menu',
                    dataType: 'json',
                    processResults: function(data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                },
                minimumInputLength: 1
                width: "100%",
                multiple: true,
                placeholder: "Enter First Name",
                // templateResult: formatState, // Minimum characters to trigger the search
            });




            var items = [];

            $.ajax({
                url: 'http://127.0.0.1:8000/menu', // Replace with your API endpoint
                method: 'GET', // Use 'POST' for sending data to the server
                dataType: 'json', // The expected data type
                success: function(data) {

                    console.log(data);
                    var menuData = data;
                    console.log(menuData);

                    var vector = menuData.map(function(item) {

                        var d = {
                            id: item.id,
                            text: item.name,
                        };
                        items.push(d);
                        return d;
                    });
                    console.log(vector);
                    $(".prompt").select2({
                        data: items,
                        minimumInputLength: 2,
                        width: "100%",
                        multiple: true,
                        placeholder: "Enter First Name",
                        templateResult: formatState,
                    });
                    return items;
                },
                error: function(error) {

                    console.error('Error:', error);
                }
            });



            function formatState(text) {
                str = "";
                str +=
                    "<p style='padding-left: 12px;'>" + text.text + "</p>";
                var $state = $(str);
                return $state;
            }

            function btn_handler() {
                var data = $(".prompt").select2("data");
                alert(data[0].text);
            }
        });
    </script>
@endsection
