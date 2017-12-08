<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="Bootstrap Admin App + jQuery">
    <meta name="keywords" content="app, responsive, jquery, bootstrap, dashboard, admin">
    <title>Signup | Web Accounts</title>
    <link rel="shortcut icon" type="image/png" href="/admin-theme/img/favicon.png"/>
    <!-- =============== VENDOR STYLES ===============-->
    <!-- FONT AWESOME-->
    <link rel="stylesheet" href="/admin-theme/assets/fontawesome/css/font-awesome.min.css">
    <!-- SIMPLE LINE ICONS-->
    <link rel="stylesheet" href="/admin-theme/assets/simple-line-icons/css/simple-line-icons.css">

    <!-- =============== BOOTSTRAP STYLES ===============-->
    <link rel="stylesheet" href="/admin-theme/css/bootstrap.css" id="bscss">
    <!-- =============== APP STYLES ===============-->
    <link rel="stylesheet" href="/admin-theme/css/app.css" id="maincss">
    <link rel="stylesheet" href="/admin-theme/css/auth.css" id="maincss">
</head>

<body>
<div class="wrapper">
    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-md-offset-3">
            <div class="block-center mt-xl">
                <div class="col-lg-12">
                    <!-- Flash Message -->
                </div>
                <div class="clearfix"></div>
                <div class="panel panel-dark panel-flat">
                    <div class="panel-heading text-center">
                        <a href="#">
                            <img src="/admin-theme/img/favicon.png" alt="Image"
                                 class="block-center img-rounded" style="width: 5%">
                        </a>
                    </div>
                    <div class="panel-body">
                        <p class="text-center pv">SIGNUP TO GET INSTANT ACCESS</p>
                        <form role="form" data-parsley-validate="" novalidate="" class="mb-lg" role="form" method="POST" action="/signup/process">
                            {{ csrf_field() }}
                            <div class="form-group has-feedback">
                                <label for="signupFirstName" class="text-muted">First Name</label>
                                <input id="signupFirstName" type="text" placeholder="First Name" name="profile[first_name]"
                                       autocomplete="off" required class="form-control">
                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group has-feedback">
                                <label for="signupLastName" class="text-muted">Last Name</label>
                                <input id="signupLastName" type="text" placeholder="Last Name" name="profile[last_name]"
                                       autocomplete="off" required class="form-control">
                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group has-feedback">
                                <label for="signupInputEmail1" class="text-muted">Email address</label>
                                <input id="signupInputEmail1" type="email" placeholder="email" autocomplete="off" required
                                       class="form-control" name="user[email_address]">
                                @if ($errors->has('email_address'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('email_address') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group has-feedback">
                                <label for="signupInputPassword1" class="text-muted">Password</label>
                                <input id="signupInputPassword1" type="password" placeholder="Password" autocomplete="off" required
                                       class="form-control" name="user[password]">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group has-feedback">
                                <label for="signupInputRePassword1" class="text-muted">Retype Password</label>
                                <input id="signupInputRePassword1" type="password" placeholder="Retype Password" autocomplete="off"
                                       required data-parsley-equalto="#signupInputPassword1" class="form-control"
                                       name="user[password_confirmation]" >
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="clearfix">
                                <div class="checkbox c-checkbox pull-left mt0">
                                    <label>
                                        <input type="checkbox" value="" required name="agreed">
                                        <span class="fa fa-check"></span>I agree with the <a href="#">terms</a>
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-block btn-primary mt-lg">Create account</button>
                        </form>
                        <p class="pt-lg text-center">Have an account?</p>
                        <a href="/" class="btn btn-block btn-default">Signin</a>
                    </div>
                </div>
                <!-- END panel-->
            </div>
        </div>
    </div>
    <!-- =============== VENDOR SCRIPTS ===============-->
    <!-- MODERNIZR-->
    <script src="/admin-theme/assets/modernizr/modernizr.custom.js"></script>
    <!-- JQUERY-->
    <script src="/admin-theme/assets/jquery/dist/jquery.js"></script>
    <!-- BOOTSTRAP-->
    <script src="/admin-theme/assets/bootstrap/dist/js/bootstrap.js"></script>
    <!-- STORAGE API-->
    <script src="/admin-theme/assets/jQuery-Storage-API/jquery.storageapi.js"></script>
    <!-- PARSLEY-->
    <script src="/admin-theme/assets/parsleyjs/dist/parsley.min.js"></script>
    <!-- =============== APP SCRIPTS ===============-->
    <script src="/admin-theme/js/app.js"></script>
</body>
</html>
