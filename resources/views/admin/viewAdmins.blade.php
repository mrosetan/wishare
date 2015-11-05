@extends('admin.master')
@section('title', 'Wishare Admins')
@section('content')
  <div class="row">
      <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Admins</h3>
            </div>
            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Username</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>
                              <a href="#"><span class="glyphicon glyphicon-edit"></span></a>
                              <a href="#"><span class="glyphicon glyphicon-trash"></span></a>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                            <td>
                              <a href="#"><span class="glyphicon glyphicon-edit"></span></a>
                              <a href="#"><span class="glyphicon glyphicon-trash"></span></a>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                            <td>
                              <a href="#"><span class="glyphicon glyphicon-edit"></span></a>
                              <a href="#"><span class="glyphicon glyphicon-trash"></span></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

      </div>
  </div>
@stop
