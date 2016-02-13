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
              @if(($wish->wishlist->privacy == 0))
                @if($wish->granted == 1)
                  <span class="label label-success label-form wish-label"><span class="fa fa-check"></span> Granted </span>
                @endif

                @if($wish->granterid != 0 AND $wish->date_granted == '0000-00-00 00:00:00')
                  <span class="label label-info label-form wish-label"><span class="fa fa-exclamation"></span></span> Pending Grant Request </span>
                @endif

                <h4>{{ $wish->title }}</h4>

                <p>
                  Wishlist: {{ $wish->wishlist->title }}
                </p>

                <p>
                  Wisher: <a href="{!! action('OtherUserController@profile', $wish->user->id) !!}">{{ $wish->user->username }}</a>
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
                         <a href="{!! action('OtherUserController@profile', $t->user->id) !!}"><span class="fa fa-tag"></span> {{ $t->user->firstname }} {{ $t->user->lastname }}</a>
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
                            Granter: <a href="{!! action('OtherUserController@profile', $wish->granterid) !!}">{{ $wish->granter->username }}</a>
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


                    <div class="favetrack-count pull-right">
                      <span class="count">{!! $wish['faves'] !!} </span><a class="favetrack-count" data-toggle="modal" data-target="#modal_faves">Favorited</a>
                      &nbsp;&nbsp;
                       <span class="count">{!! $wish['tracks'] !!} </span><a class="favetrack-count" data-toggle="modal" data-target="#modal_tracks">Tracked</a>
                    </div>
                    <br/>

                </div>
              @else
                <div class="alert alert-warning">
                  This wish belongs to a private wishlist.
                </div>
              @endif
            @else
              <div class="alert alert-info">
                Wish not found.
              </div>
            @endif
          </div>
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
