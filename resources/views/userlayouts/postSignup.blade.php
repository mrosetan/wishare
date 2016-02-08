@extends('userlayouts-master.user-master')
@section('title', 'Home')

@section('content')



<!-- <div class="page-title">
    <h4>Event Stream</h4>
</div> -->
<div class="page-content-wrap container-fluid no-stream-content ">
	<div class="row wp-header-wrap">
	  	<div class="col-md-12">
	  		<img src="{{ URL::asset('img/logo.png') }}" class="img-responsive no-stream-content-img"/>
		</div>
	</div>
	<br/>
	<div class="row wp-header-wrap">
  		<div class="col-md-12 text-center alert alert-success">
  			<h3 class="wp-body">Wishare is still in beta stage.</h3>
  			<h5 class="wp-body">If you encounter any bugs or error, please do not hesitate to inform us.</h5>
  			<h5 class="wp-body">You can reach us through our <a href="https://www.facebook.com/wishare.net/">facebook page</a> 
  			or you can also email us at appwishare@gmail.com</h5>
		</div>
	</div>
</div>
@endsection
