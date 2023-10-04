@extends('layouts.main')
@section('content')
    <div class="card card-hover shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h4 class="m-0 font-weight-bold text-info">Update Class</h4>
            <a href="{{ url('offorder') }}" class="btn btn-info  btn-sm" title="Back to Class">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
        <div class="card-body">
            {!! Form::model($offorder, [
                'method' => 'put',
                'enctype' => 'multipart/form-data',
                'class' => 'user',
                'route' => ['offorder.update', $offorder->id],
            ]) !!}
            {{-- @include('partial.flash')
            @include('partial.error') --}}
            <div class="col-sm-4">
                <label for="tab_id" class="form-label">Table Name:</label>
                {!! Form::select('tab_id',$tabs,null, [
                    'required',
                    'class' => 'form-control form-control-profile',
                    'id' => 'tab_id',
                ]) !!}
            </div>
            
            <div class="form-group row">
                <div class="col-sm-4 mb-3 mb-sm-0">
                    <label for="total" class="form-label">Name :</label>
                    {!! Form::text('total', null, [
                        'required',
                        'class' => 'form-control form-control-profile',
                        'id' => 'total',
                    ]) !!}
                </div>
                
               
            </div>
            <div class="form-group">
                {!! Form::submit('Update Orders', ['class' => 'mt-3 btn btn-info btn-profile btn-block']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
