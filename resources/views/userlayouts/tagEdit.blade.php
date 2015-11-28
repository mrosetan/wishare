@extends('userlayouts-master.user-master')
@section('title', 'Edit/Add Tagged Friends')

@section('content')
<div class="page-content-wrap">
  <div class="row">
    <div class="actions-container">

        <div class="panel panel-default">
          <div class="panel-heading">
            <h5><a href="{{ url('user/profile') }}"><span class="fa fa-arrow-circle-o-left"></span>&nbsp;Back</a></h5>
            <h4>Edit or Add Tagged Friends</h4>
              {!! Form::open(array( 'action' => array('UserController@updateTags', $wishid),
                                    'class' => 'form')) !!}

              <div class="form-group">
              <label>Tagged</label>
              
                <div class="row">
                  <div class="col-sm-12">

                    @if(!empty($friends))
                      <select class="my-select" name="tags[]" multiple="multiple">


                          @foreach($friends as $f)
                              @if($f->tagstatus == 1)
                                <option value="{!! $f->id !!}" selected="selected"> {!!$f->firstname !!} {!! $f->lastname !!} ( {!! $f->username !!} ) </option>
                              @else
                                <option value="{!! $f->id !!}">{!!$f->firstname !!} {!! $f->lastname !!} ({!! $f->username !!})</option>
                              @endif
                          @endforeach

                      </select>
                    @else
                      You currently have no friends on wishare.
                    @endif
                  </div>
                </div>
                <br/>
                <div class="row">
                  <div class="col-md-12">
                    <div class="pull-right">
                      {!! Form::submit('Update', array('class'=>'btn btn-info')) !!}
                    </div>
                  </div>
                </div>
            </div>
            {!! Form::close() !!}
          </div>
        </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
@endsection
