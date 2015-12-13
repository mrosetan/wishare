<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- END META SECTION -->

    <!-- CSS INCLUDE -->
    <link rel="stylesheet" type="text/css" id="theme" href="{{ URL::asset('css/theme-default.css') }}"/>
    <link rel="stylesheet" type="text/css" id="theme" href="{{ URL::asset('css/bootstrap/admin-styles.css') }}"/>
    <title></title>
  </head>

  <body>
    <div class="page-content-wrap">
      <div class="container-fluid wishare-report" style="width:90%">
        <div class="row">
          <div class="col-xs-12 report-header">
            <img src="../../../img/logo-complete-word.jpg" alt="" class="report-header-img"/>
          </div>
        </div>

        <div class="row">
          <div class="col-xs-12 report-header">
            <h3>Wishare Status/Statistical Report</h3>
            <h4>{!! date('F d, Y g:i A') !!}</h4>
          </div>
        </div>

        <div class="row wishare-report-row report-alt-color">
          <div class="col-xs-6">Registered users</div>
          <div class="col-xs-6">{!! $userCount !!}</div>
        </div>

        <div class="row wishare-report-row">
          <div class="col-xs-6">Active Users</div>
          <div class="col-xs-6">{!! $userActiveCount !!}</div>
        </div>

        <div class="row wishare-report-row report-alt-color">
          <div class="col-xs-6">Inactive / Banned / Deactivated Users</div>
          <div class="col-xs-6">{!! $userInactiveCount !!}</div>
        </div>

        <div class="row wishare-report-row">
          <div class="col-xs-6">Admin Accounts</div>
          <div class="col-xs-6">{!! $adminActiveCount !!}</div>
        </div>

        <div class="row wishare-report-row report-alt-color">
          <div class="col-xs-6">Deleted Admin Accounts</div>
          <div class="col-xs-6">{!! $adminInactiveCount !!}</div>
        </div>

        <div class="row wishare-report-row ">
          <div class="col-xs-6">Number of Wishes</div>
          <div class="col-xs-6">{!! $wishesCount !!}</div>
        </div>

        <div class="row wishare-report-row report-alt-color">
          <div class="col-xs-6">Deleted Wishes</div>
          <div class="col-xs-6">{!! $wishDelCount !!}</div>
        </div>

        <div class="row wishare-report-row">
          <div class="col-xs-6">Wishes Granted</div>
          <div class="col-xs-6">{!! $wishGrantedCount !!}</div>
        </div>

        <div class="row wishare-report-row report-alt-color">
          <div class="col-xs-6">Granters</div>
          <div class="col-xs-6">{!! $granters !!}</div>
        </div>
      </div>
    </div>

    <!-- <button type="button" class="btn btn-default mb-control" data-box="#message-box-default">Default</button> -->

    <div class="message-box animated fadeIn open" id="message-box-default">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="glyphicon glyphicon-print"></span> Wishare printable status/statistical report</div>
                    <div class="mb-content">
                        <p>To print or save this report as pdf, press Ctrl+P.</p>
                        <p>To go back to previous page, simple click the back button.</p>
                    </div>
                    <div class="mb-footer">
                        <button class="btn btn-default btn-lg pull-right mb-control-close">Continue</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- START PRELOADS -->
        <audio id="audio-alert" src="audio/alert.mp3" preload="auto"></audio>
        <audio id="audio-fail" src="audio/fail.mp3" preload="auto"></audio>
        <!-- END PRELOADS -->

    <!-- START SCRIPTS -->
        <!-- START PLUGINS -->
        <script type="text/javascript" src="{!! asset('js/plugins/jquery/jquery.min.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/plugins/jquery/jquery-ui.min.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/plugins/bootstrap/bootstrap.min.js') !!}"></script>
        <!-- END PLUGINS -->

        <!-- THIS PAGE PLUGINS -->
        <script type='text/javascript' src="{!! asset('js/plugins/icheck/icheck.min.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js') !!}"></script>

        <script type="text/javascript" src="{!! asset('js/plugins/datatables/jquery.dataTables.min.js') !!}"></script>

        <!-- END PAGE PLUGINS -->

        <!-- START TEMPLATE -->

        <script type="text/javascript" src="{!! asset('js/plugins.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/actions.js') !!}"></script>
        <!-- END TEMPLATE -->
  </body>
</html>
