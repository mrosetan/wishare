@extends('admin.master')
@section('title', 'Admin')
@section('content')

<div class="col-md-10 col-md-offset-1">
  <div class="row">

      <div class="col-md-4">

          <div class="widget widget-default widget-item-icon">
              <div class="widget-item-left">
                  <span class="fa fa-users"></span>
              </div>
              <div class="widget-data">
                  <div class="widget-int num-count">{!! $userCount !!}</div>
                  <div class="widget-title">Registered users</div>
                  <div class="widget-subtitle">On wishare</div>
              </div>
          </div>

      </div>

      <div class="col-md-4">

          <div class="widget widget-default widget-item-icon">
              <div class="widget-item-left">
                  <span class="fa fa-star"></span>
              </div>
              <div class="widget-data">
                  <div class="widget-int num-count">{!! $userActiveCount !!}</div>
                  <div class="widget-title">Active users</div>
                  <div class="widget-subtitle">On wishare</div>
              </div>
          </div>

      </div>

      <div class="col-md-4">

          <div class="widget widget-default widget-item-icon">
              <div class="widget-item-left">
                  <span class="fa fa-ban"></span>
              </div>
              <div class="widget-data">
                  <div class="widget-int num-count">{!! $userInactiveCount !!}</div>
                  <div class="widget-title">Inactive / Banned users</div>
                  <div class="widget-subtitle">On wishare</div>
              </div>
          </div>

      </div>

  </div>

  <div class="row">

      <div class="col-md-6">

          <div class="widget widget-info widget-item-icon">
              <div class="widget-item-left">
                  <span class="fa fa-users"></span>
              </div>
              <div class="widget-data">
                  <div class="widget-int num-count">{!! $adminActiveCount !!}</div>
                  <div class="widget-title">Active Admin accounts</div>
                  <div class="widget-subtitle">On wishare</div>
              </div>
          </div>

      </div>

      <div class="col-md-6">


          <div class="widget widget-info widget-item-icon">
              <div class="widget-item-left">
                  <span class="fa fa-ban"></span>
              </div>
              <div class="widget-data">
                  <div class="widget-int num-count">{!! $adminInactiveCount !!}</div>
                  <div class="widget-title">Deleted/Inactive Admin accounts</div>
                  <div class="widget-subtitle">On wishare</div>
              </div>
          </div>

      </div>


  </div>

  <div class="row">

      <div class="col-md-6">

          <div class="widget widget-default widget-item-icon">
              <div class="widget-item-left">
                  <span class="fa fa-star"></span>
              </div>
              <div class="widget-data">
                  <div class="widget-int num-count">{!! $wishesCount !!}</div>
                  <div class="widget-title">Wishes</div>
                  <div class="widget-subtitle">Posted on wishare</div>
              </div>
              <!-- <div class="widget-controls">
                  <a href="#" class="widget-control-right"><span class="fa fa-times"></span></a>
              </div> -->
          </div>

      </div>

      <div class="col-md-6">

          <div class="widget widget-default widget-item-icon">
              <div class="widget-item-left">
                  <span class="fa fa-trash-o"></span>
              </div>
              <div class="widget-data">
                  <div class="widget-int num-count">{!! $wishDelCount !!}</div>
                  <div class="widget-title">Deleted wishes</div>
                  <div class="widget-subtitle">On wishare</div>
              </div>
              <!-- <div class="widget-controls">
                  <a href="#" class="widget-control-right"><span class="fa fa-times"></span></a>
              </div> -->
          </div>

      </div>


  </div>

  <div class="row">

      <div class="col-md-6">

          <div class="widget widget-info widget-item-icon">
              <div class="widget-item-left">
                  <span class="fa fa-magic"></span>
              </div>
              <div class="widget-data">
                  <div class="widget-int num-count">{!! $wishGrantedCount !!}</div>
                  <div class="widget-title">Granted wishes</div>
                  <div class="widget-subtitle">On wishare</div>
              </div>
              <!-- <div class="widget-controls">
                  <a href="#" class="widget-control-right"><span class="fa fa-times"></span></a>
              </div> -->
          </div>

      </div>

      <div class="col-md-6">

          <div class="widget widget-info widget-item-icon">
              <div class="widget-item-left">
                  <span class="fa fa-magic"></span>
              </div>
              <div class="widget-data">
                  <div class="widget-int num-count">{!! $granters !!}</div>
                  <div class="widget-title">Users granted</div>
                  <div class="widget-subtitle">Wish/Wishes</div>
              </div>
              <!-- <div class="widget-controls">
                  <a href="#" class="widget-control-right"><span class="fa fa-times"></span></a>
              </div> -->
          </div>

      </div>


  </div>
</div>




@stop
