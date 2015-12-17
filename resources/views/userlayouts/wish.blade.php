@extends('userlayouts-master.user-master')
@section('title', 'Wish')

@section('content')
<div class="page-title">
    <h2></h2>
</div>
<div class="page-content-wrap">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <h5><a href="{{ url('user/profile') }}"><span class="fa fa-arrow-circle-o-left"></span>&nbsp;Back</a></h5>
      <div class="panel panel-default">
          <div class="panel-body">
            @if(!empty($wish))
              @if($wish->granted == 1)
                <span class="label label-success label-form wish-label"><span class="fa fa-check"></span> Granted </span>
              @endif

              @if($wish->granted == 2)
                <span class="label label-info label-form wish-label"><span class="fa fa-exclamation"></span></span> Pending Grant Request </span>
              @endif

              <h4>{!! $wish->title !!}</h4>

              <p>
                Wishlist: {!! $wish->wishlist->title !!}
              </p>

              <p>
                Wisher: <a href="{!! action('UserController@otheruser', $wish->user->id) !!}">{!! $wish->user->username !!}</a>
              </p>



              @if(!empty($wish->details))
                <p>
                  Details: {!! $wish->details !!}
                  <br />
                </p>

              @endif

              @if(!empty($wish->alternatives))
              <p>
                Alternatives: {!! $wish->alternatives !!}
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
                       <a href="{!! action('UserController@otheruser', $t->user->id) !!}"><span class="fa fa-tag"></span> {!! $t->user->firstname !!} {!! $t->user->lastname !!}</a>
                    </li>
                @endforeach
                </ul>
              @endif
              <hr />
              @if($wish->wishimageurl == 'null')
                <div></div>
              @else
                @if($wish->wishimageurl != 'null')
                <div class="wish-image-container">
                  <img src='{!! $wish->wishimageurl !!}' class="wish-image"/>
                </div>
                <hr />
                @endif
              @endif

              @if($wish->granted == 1)
                <div class="panel panel-success">
                  <div class="panel-heading">
                      <h3 class="panel-title">Granted Details</h3>

                  </div>
                    <div class="panel-body">

                      @if($wish->granted == 1)
                        <p>
                          Granter: <a href="{!! action('UserController@otheruser', $wish->granterid) !!}">{!! $wish->granter->username !!}</a>
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
                          Details: {!! $wish->granteddetails !!}
                          <br />
                        </p>

                        @endif

                        <hr />
                        @if($wish->grantedimageurl == 'null')
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
                <span data-wishid="{!! $wish->id !!}" data-toggle="tooltip" data-placement="top" title="Favorite" class="favorite" data-favestatus="{!! !empty($wish['favorited']) ? 'unfave' : 'favorite' !!}"><span class="fa fa-star {!! !empty($wish['favorited']) ? 'favorited-icon' : 'unfave-icon' !!}"></span> <span class="count">{!! $wish['faves'] !!}</span>  </span>
                &nbsp;&nbsp;
                <span data-wishid="{!! $wish->id !!}" data-toggle="tooltip" data-placement="top" title="Track Wish" class="trackwish" data-trackstatus="{!! !empty($wish['tracked']) ? 'untrack' : 'trackwish' !!}"><span class="fa fa-bookmark {!! !empty($wish['tracked']) ? 'tracked-icon' : 'untracked-icon' !!}"></span> <span class="count">{!! $wish['faves'] !!}</span>  </span>
                <!-- <a href="#" data-toggle="tooltip" data-placement="top" title="Favorite"><span class="fa fa-star"></span></a>
                &nbsp;&nbsp;
                <a href="#" data-toggle="tooltip" data-placement="top" title="Track Wish"><span class="fa fa-bookmark"></span></a> -->
                &nbsp;&nbsp;
                <a href="{!! action('UserController@rewishDetails', $wish->id) !!}" data-toggle="tooltip" data-placement="top" title="Rewish"><span class="fa fa-retweet"></span></a>
              </div>
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
@endsection
