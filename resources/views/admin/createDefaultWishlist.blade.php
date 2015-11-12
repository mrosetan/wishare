@extends('admin.master')
@section('title', 'Add Default Wishlist')
@section('content')
<div class="row">

  <div class="container col-md-6 col-md-offset-3">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2> Add New Default Wishlist </h2>
            @foreach($errors->all() as $error)
                <p class="alert alert-danger"> {{ $error }}</p>
            @endforeach
            {!! Form::open(array(
                          'action' => array('AdminController@storeDefaultWishlist', $user->id),
                          'class' => 'form')) !!}

            <div class="form-group">
                {!! Form::label('Input Wishlist Title') !!}
                {!! Form::text('title', null,
                                array('required',
                                'class'=>'form-control')) !!}
            </div>

            <div class="row">
              <div class="col-sm-6 form-group ">
                  {!! Form::submit('Add',
                                    array('class'=>'btn btn-info btn-block')) !!}
              </div>

              <div class="col-sm-6 form-group">
                  {!! Form::reset('Cancel',
                                    array('class'=>'btn btn-info btn-block')) !!}
              </div>
            </div>

            {!! Form::close() !!}

        </div>


    </div>
  </div>

</div>
@stop
