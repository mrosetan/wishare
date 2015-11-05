@extends('admin.master')
@section('title', 'Reports')
@section('content')
<div class="row">

    <div class="col-md-4">

        <div class="widget widget-primary widget-item-icon">
            <div class="widget-item-left">
                <span class="fa fa-users"></span>
            </div>
            <div class="widget-data">
                <div class="widget-int num-count">567</div>
                <div class="widget-title">Registered users</div>
                <div class="widget-subtitle">On wishare</div>
            </div>
            <!-- <div class="widget-controls">
                <a href="#" class="widget-control-right"><span class="fa fa-times"></span></a>
            </div> -->
        </div>

    </div>

    <div class="col-md-4">

        <div class="widget widget-info widget-item-icon">
            <div class="widget-item-left">
                <span class="fa fa-star"></span>
            </div>
            <div class="widget-data">
                <div class="widget-int num-count">6,953</div>
                <div class="widget-title">Wishes</div>
                <div class="widget-subtitle">Posted on wishare</div>
            </div>
            <!-- <div class="widget-controls">
                <a href="#" class="widget-control-right"><span class="fa fa-times"></span></a>
            </div> -->
        </div>

    </div>

    <div class="col-md-4">

        <div class="widget widget-success widget-item-icon">
            <div class="widget-item-left">
                <span class="fa fa-gift"></span>
            </div>
            <div class="widget-data">
                <div class="widget-int num-count">234</div>
                <div class="widget-title">Granters</div>
                <div class="widget-subtitle">Fulfilled another person's wish</div>
            </div>
            <!-- <div class="widget-controls">
                <a href="#" class="widget-control-right"><span class="fa fa-times"></span></a>
            </div> -->
        </div>

    </div>

</div>
@stop
