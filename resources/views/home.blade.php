@extends('layouts.application')
@section('title', 'Dashboard')
@section('content')
    <?php
    $usersModel = new \Besofty\Web\Accounts\Models\UsersModel();
    $isAdmin = $usersModel->isAdmin(Session::get('authinfo'));
    $authInfo = $usersModel->getAuthInfo(Session::get('authinfo'));
    ?>
    @if ($isAdmin)
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <!-- START widget-->
                <div class="panel bg-info-light pt b0 widget">
                    <div class="ph">
                        <em class="icon-cloud-upload fa-lg pull-right"></em>
                        <div class="h2 mt0">1700</div>
                        <div class="text-uppercase">Uploads</div>
                    </div>
                    <div data-sparkline="" data-type="line" data-width="100%" data-height="75px" data-line-color="#23b7e5" data-chart-range-min="0" data-fill-color="#23b7e5" data-spot-color="#23b7e5" data-min-spot-color="#23b7e5" data-max-spot-color="#23b7e5"
                         data-highlight-spot-color="#23b7e5" data-highlight-line-color="#23b7e5" values="2,5,3,7,4,5" style="margin-bottom: -2px" data-resize="true"></div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <!-- START widget-->
                <div class="panel widget bg-purple-light pt b0 widget">
                    <div class="ph">
                        <em class="icon-globe fa-lg pull-right"></em>
                        <div class="h2 mt0">700
                            <span class="text-sm text-white">GB</span>
                        </div>
                        <div class="text-uppercase">Quota</div>
                    </div>
                    <div data-sparkline="" data-type="line" data-width="100%" data-height="75px" data-line-color="#7266ba" data-chart-range-min="0" data-fill-color="#7266ba" data-spot-color="#7266ba" data-min-spot-color="#7266ba" data-max-spot-color="#7266ba"
                         data-highlight-spot-color="#7266ba" data-highlight-line-color="#7266ba" values="1,4,5,4,8,7,10" style="margin-bottom: -2px" data-resize="true"></div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <!-- START widget-->
                <div class="panel widget bg-info-light pt b0 widget">
                    <div class="ph">
                        <em class="icon-bubbles fa-lg pull-right"></em>
                        <div class="h2 mt0">500</div>
                        <div class="text-uppercase">Reviews</div>
                    </div>
                    <div data-sparkline="" data-type="line" data-width="100%" data-height="75px" data-line-color="#23b7e5" data-chart-range-min="0" data-fill-color="#23b7e5" data-spot-color="#23b7e5" data-min-spot-color="#23b7e5" data-max-spot-color="#23b7e5"
                         data-highlight-spot-color="#23b7e5" data-highlight-line-color="#23b7e5" values="4,5,3,10,7,15" style="margin-bottom: -2px" data-resize="true"></div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <!-- START widget-->
                <div class="panel widget bg-purple-light pt b0 widget">
                    <div class="ph">
                        <em class="icon-pencil fa-lg pull-right"></em>
                        <div class="h2 mt0">35</div>
                        <div class="text-uppercase">Annotations</div>
                    </div>
                    <div data-sparkline="" data-type="line" data-width="100%" data-height="75px" data-line-color="#7266ba" data-chart-range-min="0" data-fill-color="#7266ba" data-spot-color="#7266ba" data-min-spot-color="#7266ba" data-max-spot-color="#7266ba"
                         data-highlight-spot-color="#7266ba" data-highlight-line-color="#7266ba" values="1,3,4,5,7,8" style="margin-bottom: -2px" data-resize="true"></div>
                </div>
            </div>
        </div>
        <!-- END widgets box-->
        <!-- START chart-->
        <div class="row">
            <div class="col-lg-12">
                <!-- START widget-->
                <div id="panelChart9" class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">Event Chart</div>
                    </div>
                    <div collapse="panelChart9" class="panel-wrapper">
                        <div class="panel-body">
                            <div class="chart-splinev3 flot-chart"></div>
                        </div>
                    </div>
                </div>
                <!-- END widget-->
            </div>
        </div>
    @else
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
            Dashboard
            <small data-localize="dashboard.WELCOME">Your dashboard</small>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">Login History</div>
                <div class="panel-body">
                    <div class="table-responsive table-bordered">
                        <table class="table">
                            <thead>
                            <tr class="text-uppercase table-header">
                                <th>Time</th>
                                <th>Location IP</th>
                                <th>Status</th>
                                <th>User Agent</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td> <?php echo date('Y-m-d');?></td>
                                <td>192.168.1.5</td>
                                <td><span class="label label-primary">Success</span></td>
                                <td>
                                    Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection