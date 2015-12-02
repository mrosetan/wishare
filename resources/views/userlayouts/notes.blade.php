@extends('userlayouts-master.user-master')
@section('title', 'Notes')

@section('content')
<div class="page-content-wrap">
  <div class="row">
    <div class="notes-container">
      <div class="col-md-12">
        <div class="panel panel-default tabs">
            <ul class="nav nav-tabs nav-justified" role="tablist" id="myTab">
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
              @if(session('noteStatus'))
                <div class="alert alert-success">
                    {{ session('noteStatus') }}
                </div>
              @endif
              @if(isset($notes) and $notes->count())
                @foreach($notes as $id => $note)
                  <div class="panel panel-default">
                    <div class="panel-body">
                      {!! $note->pivot->message !!}
                      <br />
                      <br />
                      <br />
                      <b>Sender:</b> {!! $note->firstname !!} {!! $note->lastname !!}<br />
                      <b>Received:</b> {!! date('F d, Y g:i A', strtotime($note->pivot->updated_at)) !!}
                      <div class="pull-right">
                        <a href="#" data-toggle="modal" data-target="#modal_reply{!! $id !!}"><button class="btn btn-info">Reply</button></a>
                        <a href="#" class="mb-control" data-box="#mb-deletenote{!! $id !!}"><button class="btn btn-default">Delete</button></a>
                      </div>
                    </div>
                  </div>
                  @endforeach
                @else
                <div class="alert alert-danger">
                    No Notes.
                </div>
                @endif

                <!-- note message box -->
                @if(isset($notes) and $notes->count())
                  @foreach($notes as $id => $note)
                  <div class="message-box animated fadeIn" data-sound="alert" id="mb-deletenote{!! $id !!}">
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
                  @endforeach
                @endif
                <!--  -->

                <!--reply modal -->
                @if(isset($notes) and $notes->count())
                  @foreach($notes as $id => $note)
                  <div class="modal" id="modal_reply{!! $id !!}" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="defModalHead">Reply</h4>
                            </div>
                            <div class="modal-body">
                            {!! Form::open(array(
                                          'action' => array('UserController@createNoteModal', $note->id),
                                          'class' => 'form')) !!}
                              <div class="row">
                                <div class="col-md-12">
                                  <label>Recipient:</label>
                                  <br />
                                  {!! Form::text('recipient', $note->firstname.' '.$note->lastname, array('class'=>'form-control', 'disabled'=>'true')) !!}
                                </div>
                              </div>
                              <br />
                              <div class="row">
                                <div class="col-md-12">
                                  {!! Form::textarea('message', null, ['class'=>'form-control', 'placeholder'=>'Note', 'size'=>'50x5']) !!}
                                </div>
                              </div>
                              <br />
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="pull-right">
                                    {!! Form::submit('Send', array('class'=>'btn btn-info')) !!}
                                  </div>
                                </div>
                              </div>
                              {!! Form::close() !!}
                            </div>
                          </div>
                        </div>
                      </div>
                  <!--  -->
                  @endforeach
                @endif
              </div>
              <!--end of notes tab-->
              <!-- ty notes tab -->
              <div class="tab-pane" id="tab-tynotes">
                @if(isset($tynotes) and $tynotes->count())
                @foreach($tynotes as $id => $ty)
                <div class="panel-group accordion accordion-dc">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h6 class="panel-title">
                        <a href="#tynote-content{!! $id !!}">
                          <h6>From {!! $ty->firstname!!} {!! $ty->lastname !!} - {!! date('m/d/y g:i A', strtotime($ty->pivot->updated_at)) !!}</h6>
                        </a>
                      </h6>
                      <div class="pull-right">
                        <a href="#" class="mb-control" data-box="#mb-deletetynote{!! $id !!}"><span class="glyphicon glyphicon-trash"></span></a>
                      </div>
                    </div>
                    <div class="panel-body" id="tynote-content{!! $id !!}">
                      <h5>{!! $ty->pivot->message !!}</h5>
                      <b>Sender:</b> {!! $ty->firstname !!} {!! $ty->lastname !!} <br />
                      <b>Received:</b> {!! date('F d, Y g:i A', strtotime($ty->pivot->updated_at)) !!}
                      <hr />
                      @if($ty->pivot->imageurl == 'null' and $ty->pivot->sticker == 'null')
                        <div></div>
                      @else
                        @if($ty->pivot->imageurl != 'null')
                          <div class="tynote-image-container">
                            <img src="{!! $ty->pivot->imageurl!!}" class="tynote-image" />
                          </div>
                          <hr />
                        @elseif($ty->pivot->sticker != 'null')
                          <div class="tynote-sticker-container">
                            <img src="{!! $ty->pivot->sticker !!}" class="tynote-sticker" />
                          </div>
                          <hr />
                        @else
                          <hr />
                        @endif
                      @endif
                      <div class="pull-right">
                        <a href="#" class="mb-control" data-box="#mb-deletetynote{!! $id !!}"><button class="btn btn-info">Delete</button></a>
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach

                @else
                <div class="alert alert-danger">
                    No Thank You Notes.
                </div>
                @endif
                <!-- tynote message box -->
                @if(isset($tynotes) and $tynotes->count())
                  @foreach($tynotes as $id => $ty)
                  <div class="message-box animated fadeIn" data-sound="alert" id="mb-deletetynote{!! $id !!}">
                      <div class="mb-container">
                          <div class="mb-middle">
                              <div class="mb-title"><span class="glyphicon glyphicon-trash"></span>Delete Thank You Note</div>
                              <div class="mb-content">
                                  <p>Are you sure you want to delete this note?</p>
                              </div>
                              <div class="mb-footer">
                                  @if(!empty($ty))
                                  <div class="pull-right">
                                      <a href="{!! action('UserController@deleteTYNote', $ty->pivot->id) !!}" class="btn btn-success btn-lg">Yes</a>
                                      <button class="btn btn-default btn-lg mb-control-close">No</button>
                                  </div>
                                  @endif
                              </div>
                          </div>
                      </div>
                  </div>
                  @endforeach
                @endif
              </div>
              <!-- end of tynotes tab -->
              <!-- outbox tab -->
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
              <!--end of outbox tab-->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
