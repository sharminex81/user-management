@extends('layouts.application')
@section('title', 'Profile')
@section('content')
    <div class="content-heading">
        <div class="pull-right">
            <div class="btn-group">
                <a href="/profile/edit" class="mb-sm btn btn-info btn-outline">Update Profile</a>
            </div>
            <div class="btn-group">
                <button type="button" data-toggle="modal" data-target="#changeProfilePhoto" class="mb-sm btn btn-info btn-outline">Change Profile Photo
                </button>
            </div>
            <div class="btn-group">
                <a href="/profile/settings" class="mb-sm btn btn-info btn-outline">Profile Settings</a>
            </div>
        </div>
        Profile
        <small data-localize="dashboard.WELCOME">Your Profile Information</small>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body text-center">
                    <div class="pv-lg">
                        <img src="/admin-theme/img/profile.png " alt="Contact"
                             class="center-block img-responsive img-circle img-thumbnail thumb96" onerror="this.onerror=null;this.src='/admin-theme/img/profile.png ';">
                    </div>
                    <h3 class="m0 text-bold">{{ $userDetails['profile']['first_name'] . " " . $userDetails['profile']['last_name'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="h4 text-center">General Information</div>
                    <table class="table">
                        <tbody>
                        <tr>
                            <td>
                                <strong>Name</strong>
                            </td>
                            <td>{{ $userDetails['profile']['first_name'] . " " . $userDetails['profile']['last_name'] }}</td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Email</strong>
                            </td>
                            <td>{{ $userDetails['email_address'] }}</td>
                        </tr>
                        <tr>
                            <td><strong>Title</strong></td>
                            <td>{{ $userDetails['profile']['title'] ?: "-" }}</td>
                        </tr>
                        <tr>
                            <td><strong>Gender</strong></td>
                            <td>{{ $userDetails['profile']['gender'] ?: "-" }}</td>
                        </tr>
                        <tr>
                            <td><strong>Date of Birth</strong></td>
                            <td>{{ $userDetails['profile']['date_of_birth'] ?: "-" }}</td>
                        </tr>
                        <tr>
                            <td><strong>Country</strong></td>
                            <td>{{ $userDetails['profile']['country'] ?: "-" }}</td>
                        </tr>
                        <tr>
                            <td><strong>Timezone</strong></td>
                            <td>{{ $userDetails['profile']['timezone'] ?: "-" }}</td>
                        </tr>
                        <tr>
                            <td><strong>Language</strong></td>
                            <td>{{ $userDetails['profile']['language'] == 'en_US' ? 'English(US)' : "Bengali" }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@endsection