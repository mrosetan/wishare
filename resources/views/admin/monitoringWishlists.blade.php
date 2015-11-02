@extends('admin.master')
@section('title', 'Monitor Wishlists')
@section('content')
  <div class="row">
      <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Wishlists</h3>
            </div>
            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Wishlist</th>
                            <th>Created by</th>
                            <th>Date Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Christmas</td>
                            <td>Otto</td>
                            <td>09-34-15</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Christmas</td>
                            <td>Otto</td>
                            <td>09-34-15</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Christmas</td>
                            <td>Otto</td>
                            <td>09-34-15</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

      </div>
  </div>
@stop
