@extends('userlayouts-master.solowish-master')
@section('title', 'Wish')

@section('content')
<div class="page-title">
    <h2></h2>
</div>
<div class=" ">
  <div class="row solo">
    <div class=" col-md-12">

      <div class="panel panel-default">
          <div class="panel-body">
            @if(!empty($wish))
              @if(($wish->user->id == $user->id) OR ($wish->wishlist->privacy == 0) OR ($wish->user->privacy == 1 AND $checkfriends = 2))
                @if($wish->granted == 1)
                  <span class="label label-success label-form wish-label"><span class="fa fa-check"></span> Granted </span>
                @endif

                @if($wish->granted == 0 AND $wish->granterid != 0 AND $wish->date_granted == '0000-00-00 00:00:00')
                  <span class="label label-info label-form wish-label"><span class="fa fa-exclamation"></span> Pending Grant Request </span>
                @endif

                <h4>{{ $wish->title }}</h4>

                <p>
                  Wishlist: {{ $wish->wishlist->title }}
                </p>

                <p>
                  Wisher: <a href="{!! action('UserProfilesController@profile', $wish->user->id) !!}">{{ $wish->user->username }}</a>
                </p>



                @if(!empty($wish->details))
                  <p>
                    Details: {{ $wish->details }}
                    <br />
                  </p>

                @endif

                @if(!empty($wish->alternatives))
                <p>
                  Alternatives: {{ $wish->alternatives }}
                  <br />
                </p>

                @endif

                @if(!empty($wish->due_date))
                  <p>
                    Due Date: {!! date('F d, Y', strtotime($wish->due_date)) !!}
                    <br />
                  </p>
                @endif

                @if(count($wish->tags)>0)
                <p>
                  Tagged:
                </p>
                  <ul class="list-tags">
                  @foreach($tags as $t)
                      <li class="tagged-user">
                         <a href="{!! action('UserProfilesController@profile', $t->user->id) !!}"><span class="fa fa-tag"></span> {{ $t->user->firstname }} {{ $t->user->lastname }}</a>
                      </li>
                  @endforeach
                  </ul>
                @endif
                <hr />
                @if(!empty($wish->wishimageurl))
                  <div></div>
                @endif
                @if(!empty($wish->wishimageurl))
                  <div class="wish-image-container">
                    <img src='{!! $wish->wishimageurl !!}' class="wish-image"/>
                  </div>
                  <hr />
                @endif


                @if($wish->granted == 1)
                  <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">Granted Details</h3>

                    </div>
                      <div class="panel-body">

                        @if($wish->granted == 1)
                          <p>
                            Granter: <a href="{!! action('UserProfilesController@profile', $wish->granterid) !!}">{{ $wish->granter->username }}</a>
                          </p>
                          @endif

                          @if(!empty($wish->date_granted))
                            <p>
                              Date Granted: {!!  date('F d, Y', strtotime($wish->details)) !!}
                              <br />
                            </p>
                          @endif

                          @if(!empty($wish->granteddetails))
                          <p>
                            Details: {{ $wish->granteddetails }}
                            <br />
                          </p>

                          @endif

                          <hr />
                          @if(empty($wish->grantedimageurl))
                            <div></div>
                          @else
                            <div class="wish-image-container">
                              <img src='{!! $wish->grantedimageurl !!}' class="wish-image"/>
                            </div>
                          @endif
                      </div>
                  </div>
                @endif

                <div class="wishaction-btns pull-right">
                    <span data-wishid="{!! $wish->id !!}" data-toggle="tooltip" data-placement="top" title="Favorite" class="favorite" data-favestatus="{!! !empty($wish['favorited']) ? 'unfave' : 'favorite' !!}"><span class="fa fa-star {!! !empty($wish['favorited']) ? 'favorited-icon' : 'unfave-icon' !!}"></span> <span class="count">{!! $wish['faves'] !!}</span>  </span> <a class="favetrack-count" data-toggle="modal" data-target="#modal_faves">Favorited</a>
                    &nbsp;&nbsp;
                    <span data-wishid="{!! $wish->id !!}" data-toggle="tooltip" data-placement="top" title="Track Wish" class="trackwish" data-trackstatus="{!! !empty($wish['tracked']) ? 'untrack' : 'trackwish' !!}"><span class="fa fa-bookmark {!! !empty($wish['tracked']) ? 'tracked-icon' : 'untracked-icon' !!}"></span> <span class="count">{!! $wish['tracks'] !!}</span>  </span> <a class="favetrack-count" data-toggle="modal" data-target="#modal_tracks">Tracked</a>
                    &nbsp;&nbsp;
                    <a href="{!! action('UserController@rewishDetails', $wish->id) !!}" data-toggle="tooltip" data-placement="top" title="Rewish"><span class="fa fa-retweet"></span></a>
                    &nbsp;&nbsp;

                    @if($wish->user->id == $user->id)
                      &nbsp;&nbsp;
                      <a href="{!! action('UserController@updateWishDetails', $wish->id) !!}" data-toggle="tooltip" data-placement="top" title="Edit Wish"><span class="fa fa-edit"></span></a>

                      &nbsp;&nbsp;
                      <a href="{!! url('user/edit/tags', $wish->id) !!}" data-toggle="tooltip" data-placement="top" title="Tag">

                        <span class="fa fa-tag"></span>
                      </a>

                      &nbsp;&nbsp;
                      <a href="#" data-toggle="tooltip" data-placement="top" title="Delete" class="mb-control" data-box="#mb-deletewish{!!$wish->id !!}">

                        <span class="fa fa-trash-o"></span>
                      </a>
                      &nbsp;&nbsp;
                    @endif

                    @if($wish->granterid != 0 AND $wish->date_granted == '0000-00-00 00:00:00')
                      @if($wish->granterid == $user->id)
                        <span data-toggle="tooltip" data-placement="top" title="Grant"><a class="mb-control" data-box="#mb-deletegrant{!! $wish->id !!}"><span class="fa fa-magic granted-icon"></span></a></span>
                      @endif
                    @endif


                </div>
              @else
                <div class="alert alert-warning">
                  This wish belong to a private wishlist.
                </div>
              @endif
            @else
              <div class="alert alert-info">
                Wish not found
              </div>
            @endif
          </div>
      </div>

    </div>
  </div>
</div>

<div class="message-box animated fadeIn" data-sound="alert" id="mb-deletegrant{!! $wish->id !!}">
    <div class="mb-container">
        <div class="mb-middle">
            <div class="mb-title"><span class="glyphicon glyphicon-trash"></span>Cancel Grant Request</div>
            <div class="mb-content">
                <p>Cancel grant request?</p>
            </div>
            <div class="mb-footer">
                <div class="pull-right">
                    <a href="{!! action('UserController@deleteWishGranted', $wish->id) !!}" class="btn btn-success btn-lg">Yes</a>
                    <button class="btn btn-default btn-lg mb-control-close">No</button>
                </div>
            </div>
        </div>
    </div>
</div>

@if($wish->user->id == $user->id)
  @if($wish->granted == 1)
    <!-- message box-->
    <div class="message-box animated fadeIn" data-sound="alert" id="mb-deletegrant{!! $wish->id !!}">
        <div class="mb-container">
            <div class="mb-middle">
                <div class="mb-title"><span class="glyphicon glyphicon-trash"></span>Remove Granted Details</div>
                <div class="mb-content">
                    <p>Are you sure you want to remove granted details?</p>
                </div>
                <div class="mb-footer">
                    <div class="pull-right">
                        <a href="{!! action('UserController@deleteWishGranted', $wish->id) !!}" class="btn btn-success btn-lg">Yes</a>
                        <button class="btn btn-default btn-lg mb-control-close">No</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- message box-->
    @endif
    @if(($wish->granted == 0) and ($wish->granterid != 0) and ($wish->date_granted == '0000-00-00 00:00:00'))
      @if(isset($wishes))
        @foreach($wishes as $wish)
          <div class="message-box animated fadeIn" data-sound="alert" id="mb-deletewish{!! $wish->id !!}">
              <div class="mb-container">
                  <div class="mb-middle">
                      <div class="mb-title"><span class="glyphicon glyphicon-trash"></span>Delete Wish</div>
                      <div class="mb-content">
                          <p>Are you sure you want to delete this wish?</p>
                      </div>
                      <div class="mb-footer">
                          @if(!empty($wishes))
                          <div class="pull-right">
                              <a href="{!! action('UserController@deleteWish', $wish->id) !!}" class="btn btn-success btn-lg">Yes</a>
                              <button class="btn btn-default btn-lg mb-control-close">No</button>
                          </div>
                          @endif
                      </div>
                  </div>
              </div>
          </div>
        @endforeach
      @endif
    @endif
  @endif


  <div class="modal" id="modal_grant{!! $wish['id'] !!}" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4>Grant Wish</h4>
              </div>
              <div class="modal-body">
                @foreach($errors->all() as $error)
                    <p class="alert alert-danger"> {{ $error }}</p>
                @endforeach
                {!! Form::open(array('action'=>array('UserController@grantWish', $wish['id']), 'class' => 'form', 'files'=>true)) !!}
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-12">
                      <label>Wish</label>
                      {!! Form::text('wish', $wish['title'], array('class'=>'form-control', 'placeholder'=>'', 'disabled'=>'disabled')) !!}
                    </div>
                  </div>
                  <br />
                  <div class="row">
                    <div class="col-sm-12">
                      {!! Form::text('granteddetails', null, array('class'=>'form-control', 'placeholder'=>'Caption'))!!}
                    </div>
                  </div>
                  <br />
                  <div class="row">
                    {!! Form::file('grantedimageurl', array('class'=>'fileinput btn btn-info'))!!}
                  </div>
                  <br />
                  <div class="row">
                    <div class="col-md-12">
                      <div class="pull-right">
                        {!! Form::submit('Grant', array('class'=>'btn btn-info')) !!}
                        {!! Form::reset('Cancel', array('class'=>'btn btn-default')) !!}
                      </div>
                    </div>
                  </div>
                </div>
                {!! Form::close() !!}
              </div>
          </div>
      </div>
  </div>


  <div class="modal" id="modal_faves" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                  <h4 class="modal-title" id="defModalHead">People who favorited this wish:</h4>
              </div>
              <div class="modal-body">
                  <ol>
                    @foreach($wish['favoriters'] as $favoriters)
                      <li><a href="{!! action('UserProfilesController@profile', $favoriters->user->id) !!}"><b>{{ $favoriters->user->firstname }} {{ $favoriters->user->lastname }}</b> ( {{ $favoriters->user->username }} )</a></li>
                    @endforeach
                  </ol>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
          </div>
      </div>
  </div>

  <div class="modal" id="modal_tracks" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                  <h4 class="modal-title" id="defModalHead">People who tracked this wish:</h4>
              </div>
              <div class="modal-body">
                  <ol>
                    @foreach($wish['trackers'] as $trackers)
                      <li><a href="{!! action('UserProfilesController@profile', $favoriters->user->id) !!}"><b>{{ $trackers->user->firstname }} {{ $trackers->user->lastname }}</b> ( {{ $trackers->user->username }} )</a></li>
                    @endforeach
                  </ol>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
          </div>
      </div>
  </div>


@endsection
