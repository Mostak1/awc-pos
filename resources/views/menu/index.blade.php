@extends('layouts.main')
@section('content')
    <div class="card card-hover shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h4 class="m-0 font-weight-bold text-info">List of Menus</h4>
            <div class="">
                
                <a class="btn btn-sm btn-info" href="{{ url('menus/create') }}">
                    <i class="fa-solid fa-plus"></i>
                    Add
                </a>
                
            </div>
        </div>
        <!-- Card Body -->
        <div class="card-body mt-4">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th colspan="10" class="tablebtn text-end">
                            </th>
                        </tr>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Category Name</th>
                            <th>Subcategory Name</th>
                            <th>Image</th>
                            <th>Details</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Discount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                   
                    <tbody>
                        @foreach ($menus as $menu)
                            <tr>
                                <td>{{ $menu->id }}</td>
                                <td>{{ $menu->name }}</td>
                                <td>{{ $menu->category->name }}</td>
                                <td>{{ $menu->subcategory->name }}</td>
                                <td> <img class="" height="50px"
                                        src="{{ asset('storage/menu') }}/{{ $menu->image }}"
                                        alt="{{ $menu->image }}" /></td>
                                <td>{{ $menu->details }}</td>
                                <td>{{ $menu->price }}</td>
                                <td>{{ $menu->quantity }}</td>
                                <td>{{ $menu->discount }}</td>
                                <td>
                                    
                                    
                                    <div class="skip d-flex justify-content-center">
                                        {!! Form::open(['method' => 'delete', 'route' => ['menus.destroy', $menu->id], 'id' => 'deleteform']) !!}
                                        <a href="javascript:void(0)" class="btn btn-danger  btn-sm" title="Delete"
                                            onclick="event.preventDefault();if (!confirm('Are you sure?')) return; document.getElementById('deleteform').submit();">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </a>
                                        {!! Form::close() !!}
                                        &nbsp;
                                        <a href="{{ url('menus/' . $menu->id . '/edit') }}" class="btn btn-info  btn-sm"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        &nbsp;
                                        <a href="{{ url('menus/' . $menu->id) }}" class="btn btn-info  btn-sm"
                                            title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                  
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
