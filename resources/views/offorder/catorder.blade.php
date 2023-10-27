@extends('layouts.main')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        .form-check-label {
            text-transform: capitalize;
        }
    </style>
@endsection

@section('content')
    <div class="container afterNav">

        <div class="card card-hover shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-info">Dummy Page {{ config('setting.c_name') }}</h6>
                <select class="js-data-example-ajax"></select>
            </div>

            <div class="card-body">
                <section>

                    <div class="card  mb-1">
                        <label for="password">Assign Category</label>
                        <select name="roles[]" id="roles" class="form-control select2" multiple>
                            @foreach ($cats as $role)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        mmmm
                        <select class="js-data-example-ajax"></select>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
            $('.js-data--ajax').select2({
                ajax: {
                    url: 'https://api.github.com/search/repositories',
                    dataType: 'json'
                    // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
                }
            });
            $(".js-data-example-ajax").select2({
                ajax: {
                    url: "https://res.awcbd.org/api/menus",
                    dataType: 'json',
                    delay: 50,
                    data: function(params) {
                        return {
                            q: params.term, // search term
                            page: params.page
                        };
                    },
                    processResults: function(data, params) {
                        params.page = params.page || 1;

                        return {
                            results: data.items,
                            pagination: {
                                more: (params.page * 30) < data.total_count
                            }
                        };
                    },
                    cache: true
                },
                placeholder: 'Search for a repository',
                minimumInputLength: 1,
                templateResult: formatRepo,
                templateSelection: formatRepoSelection
            });

            function formatRepo(repo) {
                if (repo.loading) {
                    return repo.text;
                }

                var $container = $(
                    "<div class='select2-result-repository clearfix'>" +
                    "<div class='select2-result-repository__avatar'><img width='100px' src='https://res.awcbd.org/storage/menu/" +
                    repo.image +
                    "' /></div>" +
                    "<div class='select2-result-repository__meta'>" +
                    "<div class='select2-result-repository__title'></div>" +
                    "<div class='select2-result-repository__description'></div>" +
                    "<div class='select2-result-repository__statistics'>" +
                    "<div class='select2-result-repository__forks'><i class='fa fa-flash'></i> </div>" +
                    "<div class='select2-result-repository__stargazers'><i class='fa fa-star'></i> </div>" +
                    "<div class='select2-result-repository__watchers'><i class='fa fa-eye'></i> </div>" +
                    "</div>" +
                    "</div>" +
                    "</div>"
                );

                $container.find(".select2-result-repository__title").text(repo.name);
                $container.find(".select2-result-repository__description").text(repo.details);
                $container.find(".select2-result-repository__forks").append(repo.price + " Forks");
                $container.find(".select2-result-repository__stargazers").append(repo.discount + " Stars");
                $container.find(".select2-result-repository__watchers").append(repo.quantity + " Watchers");

                return $container;
            }

            function formatRepoSelection(repo) {
                return repo.name || repo.text;
            }

        })
    </script>
@endsection
