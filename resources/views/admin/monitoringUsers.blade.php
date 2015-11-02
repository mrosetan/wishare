@extends('admin.master')
@section('title', 'Monitor Users')
@section('content')
  <div class="row">
      <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Users</h3>
            </div>
            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Date Joined</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>qwedsasd</td>
                            <td>asd@asd.com</td>
                            <td>07-15-15</td>
                            <td><a href="#"><span class="fa fa-ban"></span></a></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>qwedsasd</td>
                            <td>asd@asd.com</td>
                            <td>07-15-15</td>
                            <td><a href="#"><span class="fa fa-ban"></span></a></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>qwedsasd</td>
                            <td>asd@asd.com</td>
                            <td>07-15-15</td>
                            <td><a href="#"><span class="fa fa-ban"></span></a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

      </div>
  </div>
@stop
