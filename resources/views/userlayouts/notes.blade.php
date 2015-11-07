@extends('userlayouts-master.user-master')
@section('title', 'Notes')

@section('content')
<div class="page-title">
    <h2></h2>
</div>
<div class="page-content-wrap">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default tabs">
          <ul class="nav nav-tabs" role="tablist">
              <li class="active"><a href="#tab-notes" role="tab" data-toggle="tab">Notes</a></li>
              <li><a href="#tab-tynotes" role="tab" data-toggle="tab">Thank You Notes</a></li>
              <li><a href="#tab-outbox" role="tab" data-toggle="tab">Outbox</a></li>
          </ul>
          <br />
          <!---->
          <div class="panel-body tab-content">
            <div class="tab-pane active" id="tab-notes">
              <div class="panel panel-default">
                  <div class="panel-body">
                    <h5>Hello sprikitik!</h5>
                    <br />
                    <br />
                    <br />
                    Sender: Bobby <br />
                    2:08AM 11/06/15
                    <div class="pull-right">
                        {!! Form::button('Reply', array('class'=>'btn btn-info', 'data-toggle'=>'modal', 'data-target'=>'#modal_reply')) !!}
                        {!! Form::button('Delete', array('class'=>'btn btn-default mb-control-close')) !!}
                    </div>
                  </div>
              </div>
            </div>
            <div class="modal" id="modal_reply" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="defModalHead">Accept Grant Request</h4>
                        </div>
                        <div class="modal-body">
                            {!! Form::open() !!}
                            {!! Form::textarea('caption', null, array('class'=>'form-control', 'placeholder'=>'Add a caption')) !!}
                            <br />
                        </div>
                        <div class="modal-footer">
                          {!! Form::button('Reply', ['class'=>'btn btn-info'])!!}
                          {!! Form::reset('Cancel', ['class'=>'btn btn-default'])!!}
                          {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        <!---->
            <div class="tab-pane" id="tab-tynotes">
              <div class="panel panel-default">
                  <div class="panel-body">
                    <h5>Thank you sprikitik!</h5>
                    '<'picture or sticker here'>'
                    <br />
                    <br />
                    <br />
                    Sender: Bobby <br />
                    2:08AM 11/06/15
                    <div class="pull-right">
                        {!! Form::button('Delete', array('class'=>'btn btn-default mb-control-close')) !!}
                    </div>
                  </div>
              </div>
            </div>
            <!---->
            <div class="tab-pane" id="tab-outbox">
              <div class="panel panel-default">
                  <div class="panel-body">
                    To: Bobby <br/>
                    Sent: 2:29AM 11/06/15
                    <br />
                    <br />
                    <br />
                    <h5>I miss you huhu</h5>
                  </div>
              </div>
            </div>
          </div>
      </div>
      <!---->
    </div>
  </div>
</div>
@endsection
