@extends('userlayouts-master.user-master')
@section('title', 'Notes')

@section('content')
<div class="page-content-wrap">
  <div class="row">
    <div class="notes-container">
      <div class="col-md-12">
        <div class="panel panel-default tabs">
            <ul class="nav nav-tabs nav-justified" role="tablist">
                <li class="active"><a href="#tab-notes" role="tab" data-toggle="tab">Notes</a></li>
                <li><a href="#tab-tynotes" role="tab" data-toggle="tab">Thank You Notes</a></li>
                <li><a href="#tab-outbox" role="tab" data-toggle="tab">Outbox</a></li>
            </ul>
            <br />
            <!---->
            <div class="panel-body tab-content">
              <div class="tab-pane active" id="tab-notes">
              @if(session('noteDelete'))
                <div class="alert alert-success">
                    {{ session('noteDelete') }}
                </div>
              @endif
              @if(isset($notes) and count($notes) > 0)
                @foreach($notes as $note)
                  <div class="panel panel-default">
                    <div class="panel-body">
                      {!! $note->pivot->message !!}
                      <br />
                      <br />
                      <br />
                      <b>Sender:</b> {!! $note->firstname !!} {!! $note->lastname !!}<br />
                      <b>Received:</b> {!! date('F d, Y g:i a', strtotime($note->created_at)) !!}
                      <div class="pull-right">
                        {!! Form::button('Reply', array('class'=>'btn btn-info', 'data-toggle'=>'modal', 'data-target'=>'#modal_reply')) !!}
                        <a href="#" class="mb-control" data-box="#mb-delete"><button class="btn btn-default">Delete</button></a>
                      </div>
                    </div>
                  </div>
                @endforeach
              @else
              <div class="alert alert-danger">
                  No Notes.
              </div>
              @endif
              @foreach($notes as $note)
                <!-- message box-->
                <div class="message-box animated fadeIn" data-sound="alert" id="mb-delete">
                    <div class="mb-container">
                        <div class="mb-middle">
                            <div class="mb-title"><span class="glyphicon glyphicon-trash"></span>Delete Note</div>
                            <div class="mb-content">
                                <p>Are you sure you want to delete this note?</p>
                            </div>
                            <div class="mb-footer">
                                @if(!empty($note))
                                <div class="pull-right">
                                    <a href="{!! action('UserController@deleteNote', $note->pivot->id) !!}" class="btn btn-success btn-lg">Yes</a>
                                    <button class="btn btn-default btn-lg mb-control-close">No</button>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!--end of message box-->
              @endforeach
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
</div>
@endsection
