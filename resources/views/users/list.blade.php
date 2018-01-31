@extends('layouts.application')
@section('title', 'User List')
@section('content')
    <div class="content-heading">
        <div class="pull-right">
            <div class="btn-group">
                <a href="/admin/users/create" class="mb-sm btn btn-info btn-outline">Create New User</a>
            </div>

            <div class="btn-group">
                <button type="button" data-toggle="modal" data-target="#searchUser"
                        class="mb-sm btn btn-info btn-outline">Search User
                </button>
            </div>
        </div>
        Users List
        <small>User found</small>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">User List</div>
                    <div class="panel-body">
                        <div class="table-responsive table-bordered">
                            <table class="table">
                                <thead>
                                <tr class="text-uppercase table-header">
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th class="text-right">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Shanta</td>
                                        <td>exam@gmail.com</td>
                                        <td>5656767688</td>
                                        <td>
                                            Admin
                                        </td>
                                        <td>
                                           Active
                                        </td>
                                        <td class="text-right action-icons">
                                            Edit
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="text-right">

                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
@endsection

@section('bottomExtraContent')
    <!-- Change Profile Photo Modal-->
    <div id="searchUser" tabindex="-1" role="dialog" aria-labelledby="changeProfilePhotoLabel"
         aria-hidden="true" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 id="changeProfilePhotoLabel" class="modal-title text-center text-uppercase">Search User</h4>
                </div>
                <form method="get" action="/admin/users" >
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Name </label>
                                    <input type="text" name="name" value="{{ isset($request['name']) ? $request['name'] : '' }}" placeholder="Name" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" value="{{ isset($request['email']) ? $request['email'] : '' }}" placeholder="Email" class="form-control">
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" name="phone_number" value="{{ isset($request['phone_number']) ? $request['phone_number'] : '' }}" placeholder="Phone number" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Role</label>
                                    <select name="role" class="form-control">
                                        <option value="" selected>All</option>
                                        <option value="2" {{ isset($request['role']) &&   $request['role'] == 2 ? 'selected' : '' }}>General User</option>
                                        <option value="1" {{ isset($request['role']) &&  $request['role'] == 1 ? 'selected' : '' }}>Admin</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control">
                                        <option value="" selected>All</option>
                                        <option value="1" {{ isset($request['status']) && $request['status'] == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="2" {{ isset($request['status']) && $request['status'] == 2 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
                        <button type="submit" class="btn btn-success ">Search User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Change Profile Photo Modal-->
@endsection