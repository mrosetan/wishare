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

                @if($wish->granted == 2)
                  <span class="label label-info label-form wish-label"><span class="fa fa-exclamation"></span></span> Pending Grant Request </span>
                @endif

                <h4>{!! $wish->title !!}</h4>

                <p>
                  Wishlist: {!! $wish->wishlist->title !!}
                </p>

                <p>
                  Wisher: <a href="{!! action('OtherUserController@profile', $wish->user->id) !!}">{!! $wish->user->username !!}</a>
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
                         <a href="{!! action('OtherUserController@profile', $t->user->id) !!}"><span class="fa fa-tag"></span> {!! $t->user->firstname !!} {!! $t->user->lastname !!}</a>
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
                            Granter: <a href="{!! action('OtherUserController@profile', $wish->granterid) !!}">{!! $wish->granter->username !!}</a>
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


                    <div class="favetrack-count pull-right">
                      <span class="count">{!! $wish['faves'] !!} Favorited</span>
                      &nbsp;&nbsp;
                       <span class="count">{!! $wish['tracks'] !!} Tracked</span>
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
@endsection
