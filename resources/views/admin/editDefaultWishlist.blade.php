@extends('admin.master')
@section('title', 'Edit Default Wishlist')
@section('content')
<div class="row">

  <div class="container col-md-6 col-md-offset-3">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2> Edit Default Wishlist </h2>

            @if(session('status'))
              <div class="alert alert-success">
                  {{ session('status') }}
              </div>
            @endif

            {!! Form::open(array(
                          'action' => array('AdminController@updateDefaultWishlist', $defaultwishlist->id),
                          'class' => 'form')) !!}

            <div class="form-group">
                {!! Form::label('Wishlist Title') !!}
                {!! Form::text('title', $defaultwishlist->title,
                                array('class'=>'form-control')) !!}
            </div>

            <div class="row">
              <div class="col-sm-12 form-group ">
                  {!! Form::submit('Save',
                                    array('class'=>'btn btn-info btn-block')) !!}
              </div>

              <!-- <div class="col-sm-6 form-group">
                  {!! Form::reset('Cancel',
                                    array('class'=>'btn btn-info btn-block')) !!}
              </div> -->
            </div>

            {!! Form::close() !!}

        </div>


    </div>
  </div>

</div>
@stop
