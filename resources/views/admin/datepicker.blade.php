@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Date Picker
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
    
    <link href="{{ asset('assets/vendors/summernote/css/summernote-bs4.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendors/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/select2/css/select2-bootstrap.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/vendors/bootstrap-tagsinput/css/bootstrap-tagsinput.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/pages/blog.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}">
    
    <link href="{{ asset('assets/vendors/daterangepicker/css/daterangepicker.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/clockface/css/clockface.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}" rel="stylesheet" type="text/css" />

    {{--<style>--}}


        {{--.bootstrap-datetimepicker-widget li.collapse.in--}}
        {{--{--}}
            {{--display: none;--}}
        {{--}--}}
        {{--.show1--}}
        {{--{--}}
            {{--display:block !important;--}}
        {{--}--}}
        {{--/*.bootstrap-datetimepicker-widget li.collapse.in{*/--}}
            {{--/*display: block !important;*/--}}
        {{--/*}*/--}}



    {{--</style>--}}

    <style>

        .ranges li.active{
            color: #fff !important;
        }

    </style>




@stop

{{-- Page content --}}
@section('content')

<section class="content-header">
                <!--section starts-->
                <h1>Date pickers</h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="#">Forms</a>
                    </li>
                    <li class="active">Date pickers</li>
                </ol>
            </section>
            <!--section ends-->
<section class="content">
    <!--main content-->
    <div class="row">
        <div class="col-md-12">
            <div class="card panel-info">
                <div class="card-heading">
                    <h3 class="card-title">
                        <i class="livicon" data-name="bell" data-size="16" data-loop="true" data-c="#fff"
                           data-hc="white"></i> Date Time Picker
                    </h3>
                    <span class="float-right ">
                                    <i class="fa fa-chevron-up clickable"></i>
                                </span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            {{--<div class="form-group">--}}
                                {{--<label>Default:</label>--}}
                                {{--<div class="input-group">--}}
                                    {{--<div class="input-group-append">--}}
                                        {{--<span class="input-group-text"><i class="livicon" data-name="laptop" data-size="16" data-c="#555555"--}}
                                           {{--data-hc="#555555" data-loop="true"></i></span>--}}
                                    {{--</div>--}}
                                    {{--<input type="text" class="form-control" id="datetime1"/>--}}
                                {{--</div>--}}
                                {{--<!-- /.input group -->--}}
                            {{--</div>--}}
                            <div class="form-group">
                                <label>Custom Format:</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="livicon" data-name="laptop" data-size="16" data-c="#555555"
                                           data-hc="#555555" data-loop="true"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="datetime2"/>
                                </div>
                                <!-- /.input group -->
                            </div>
                            {{--<div class="form-group">--}}
                                {{--<label>Custom View:</label>--}}
                                {{--<div class="input-group">--}}
                                    {{--<div class="input-group-append">--}}
                                        {{--<span class="input-group-text"><i class="livicon" data-name="laptop" data-size="16" data-c="#555555"--}}
                                           {{--data-hc="#555555" data-loop="true"></i></span>--}}
                                    {{--</div>--}}
                                    {{--<input type="text" class="form-control" id="datetime3"/>--}}
                                {{--</div>--}}
                                {{--<!-- /.input group -->--}}
                            {{--</div>--}}
                            <div class="form-group">
                                <label>Min View:</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="livicon" data-name="laptop" data-size="16" data-c="#555555"
                                           data-hc="#555555" data-loop="true"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="datetime4"/>
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label>Inline View:</label>
                            <div id="datetime5"></div>
                            <!-- /.input group -->
                        </div>
                    </div>
                </div>
                <!--ends-->
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-12 my-3">
            <div class="card panel-primary">
                <div class="card-heading">
                    <h3 class="card-title">
                        <i class="livicon" data-name="magic" data-size="16" data-loop="true" data-c="#fff"
                           data-hc="white"></i> Date Range Picker
                    </h3>
                                <span class="pull-right ">
                                    <i class="fa fa-chevron-up clickable"></i>
                                </span>
                </div>
                <div class="card-body">
                    <div class="box-body">
                        <!-- Date dd/mm/yyyy -->
                        <div class="form-group">
                            <label>
                                Default:
                            </label>
                            <div class="input-group">
                                <div class="input-group-append">
                                   <span class="input-group-text"> <i class="livicon" data-name="calendar" data-size="16" data-c="#555555"
                                       data-hc="#555555" data-loop="true"></i></span>
                                </div>
                                <input type="text" class="form-control" id="daterange1"/>
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- phone mask -->
                        <div class="form-group">
                            <label>
                                Date and Time:
                            </label>
                            <div class="input-group">
                                <div class="input-group-append">
                                      <span class="input-group-text"> <i class="livicon" data-name="phone" data-size="16" data-c="#555555"
                                       data-hc="#555555" data-loop="true"></i></span>
                                </div>
                                <input type="text" class="form-control" id="daterange2"/>
                            </div>
                        </div>
                        <!-- /.input group -->
                        <!-- /.form group -->
                        <!-- phone mask -->
                        <div class="form-group">
                            <label>
                                Predefined Range:
                            </label>
                            <div class="input-group">
                                <div class="input-group-append">
                                      <span class="input-group-text"> <i class="livicon" data-name="phone" data-size="16" data-c="#555555"
                                       data-hc="#555555" data-loop="true"></i></span>
                                </div>
                                <input type="text" class="form-control" id="daterange3"/>
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                        <!-- IP mask -->
                        <div class="form-group">
                            <label>Single Date Picker:</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                      <span class="input-group-text"> <i class="livicon" data-name="laptop" data-size="16" data-c="#555555"
                                       data-hc="#555555" data-loop="true"></i></span>
                                </div>
                                <input type="text" class="form-control" id="rangepicker4"/>
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                    </div>
                </div>
            </div>
            <!--select2 starts-->
            <div class="card panel-success my-3">
                <div class="card-heading">
                    <h3 class="card-title">
                        <i class="livicon" data-name="magic" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i> Clock Picker
                    </h3>
                    <span class="pull-right ">
                                    <i class="fa fa-chevron-up clickable"></i>
                                </span>
                </div>
                <div class="card-body">
                    <div class="box-body">
                        <div class="form-group">
                            <label>
                                Default:
                            </label>
                            <div class="input-group">
                                <div class="input-group-append">
                                     <span class="input-group-text">  <i class="livicon" data-name="clock" data-size="16" data-c="#555555" data-hc="#555555" data-loop="true"></i></span>
                                </div>
                                <input type="text" class="form-control" id="clockface1" value="2:30 PM" data-format="hh:mm A" />
                            </div>
                            <!-- /.input group -->
                        </div>
                        <div class="form-group">
                            <label>
                                Read only:
                            </label>
                            <div class="input-group">
                                <div class="input-group-append">
                                      <span class="input-group-text"> <i class="livicon" data-name="clock" data-size="16" data-c="#555555" data-hc="#555555" data-loop="true"></i></span>
                                </div>
                                    <input type="text" class="form-control input-small" id="clockface2" value="14:30" readonly="">
                            </div>
                        </div>
                        <!-- /.input group -->
                        <!-- /.form group -->
                        <div class="form-group">
                            <label>
                                Inline:
                            </label>
                            <div id="clockface3">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-6 col-lg-6 col-12 my-3">

            <!--select2 starts-->
            <div class="card panel-warning">
                <div class="card-heading">
                    <h3 class="card-title">
                        <i class="livicon" data-name="bell" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i> Masking
                    </h3>
                    <span class="pull-right ">
                        <i class="fa fa-chevron-up clickable"></i>
                    </span>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Time Mask:</label>
                        <div class="input-group">
                            <div class="input-group-append">
                                 <span class="input-group-text">  <i class="livicon" data-name="laptop" data-size="16" data-c="#555555" data-hc="#555555" data-loop="true"></i>
                            </span></div>
                            <input type="text" class="form-control" data-mask="99:99:99" placeholder="HH:MM:SS">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <div class="form-group">
                        <label>Date Mask:</label>
                        <div class="input-group">
                            <div class="input-group-append">
                                 <span class="input-group-text">  <i class="livicon" data-name="laptop" data-size="16" data-c="#555555" data-hc="#555555" data-loop="true"></i>
                           </span> </div>
                            <input type="text" class="form-control" data-mask="99/99/9999" placeholder="MM/DD/YYYY"/>
                        </div>
                        <!-- /.input group -->
                    </div>
                    <div class="form-group">
                        <label>Date-Time Mask:</label>
                        <div class="input-group">
                            <div class="input-group-append">
                                 <span class="input-group-text">  <i class="livicon" data-name="laptop" data-size="16" data-c="#555555" data-hc="#555555" data-loop="true"></i>
                           </span> </div>
                            <input type="text" class="form-control" data-mask="99/99/9999 99:99:99" placeholder="MM/DD/YYYY HH:mm:ss">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <div class="form-group">
                        <label>Phone Mask:</label>
                        <div class="input-group">
                            <div class="input-group-append">
                                  <span class="input-group-text"> <i class="livicon" data-name="laptop" data-size="16" data-c="#555555" data-hc="#555555" data-loop="true"></i>
                           </span> </div>
                            <input type="text" id="phone_mask" class="form-control" data-mask="(999)999-9999" placeholder="(999)999-9999">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.input group -->
                </div>
                <!--ends-->
            </div>
        </div>
    </div>
    <!--select2 ends-->
    <!--main content ends-->
</section>
<!-- content -->
        
    @stop

{{-- page level scripts --}}
@section('footer_scripts')

<!-- begining of page level js -->
<script src="{{ asset('assets/vendors/moment/js/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/daterangepicker/js/daterangepicker.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/vendors/clockface/js/clockface.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/js/pages/datepicker.js') }}" type="text/javascript"></script>
<!-- end of page level js -->
<script>


</script>

@stop
