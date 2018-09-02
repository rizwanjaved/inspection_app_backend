@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    @lang('blog/title.edit')
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

    <!--end of page level css-->
@stop


{{-- Page content --}}
@section('content')
<section class="content-header">
    <!--section starts-->
    <h1>Edit Event</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.dashboard') }}"> <i class="livicon" data-name="home" data-size="14" data-c="#000" data-loop="true"></i>
                @lang('general.home')
            </a>
        </li>
        <li>
            <a href="#">Event</a>
        </li>
        <li class="active">Edit Event</li>
    </ol>
</section>
<!--section ends-->
<section class="content paddingleft_right15">
    <!--main content-->
    <div class="row">
        <div class="col-12">
        <div class="the-box no-border">
           {!! Form::model($event, ['url' => URL::to('admin/event/' . $event->id), 'method' => 'put', 'class' => 'bf', 'files'=> true]) !!}
                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group {{ $errors->first('title', 'has-error') }}">
                            {!! Form::label('title','Title') !!}
                            {!! Form::text('title', null, array('class' => 'form-control input-lg', 'placeholder'=>trans('blog/form.ph-title'))) !!}
                            <span class="help-block">{{ $errors->first('title', ':message') }}</span>
                        </div>
                         <div class="form-group">
                            <label>
                                Date and Time:
                            </label>
                            <div class="input-group {{ $errors->first('dates', 'has-error') }}">
                                <div class="input-group-append">
                                      <span class="input-group-text"> <i class="livicon" data-name="calender" data-size="16" data-c="#555555"
                                       data-hc="#555555" data-loop="true"></i></span>
                                </div>
                                <input type="text" class="form-control" id="daterange_custom" name="dates" value=""/>
                            </div>
                            <span class="help-block">{{ $errors->first('dates', ':message') }}</span>
                        </div>
                        <div class="form-group {{ $errors->first('channels', 'has-error') }}">
                            <label for="select22" class="control-label">
                               Channels
                            </label>
                            <select id="select22" class="form-control select2" name ="channels[]" value="{{ json_encode($selectedChannels) }}" multiple>
                                @foreach($channels as $channel)
                                <option value="{{ $channel->id }}">{{$channel->title}}</option>
                                @endforeach
                            </select>
                            <span class="help-block">{{ $errors->first('channels', ':message') }}</span>
                        </div>
                    </div>
                    <!-- /.col-sm-8 -->
                    <div class="col-sm-4">
                         <div class="form-group {{ $errors->first('event_type', 'has-error') }}">
                            <label for="blog_category" class="">Event Type</label>
                            {!! Form::select('event_type',$eventTypes ,$event->event_type, array('class' => 'form-control select2', 'id'=>'blog_category' ,'placeholder'=>trans('Select Event Type'))) !!}
                            <span class="help-block">{{ $errors->first('event_type', ':message') }}</span>
                        </div>
                         <div class="form-group {{ $errors->first('event_status', 'has-error') }}">
                            <label for="blog_category" class="">Event Status</label>
                            {!! Form::select('event_status',$eventStatus ,$event->event_status, array('class' => 'form-control select2', 'id'=>'blog_category' ,'placeholder'=>trans('Select Event Status'))) !!}
                            <span class="help-block">{{ $errors->first('event_status', ':message') }}</span>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success blog_submit">@lang('blog/form.update')</button>
                            <a href="{{ URL::to('admin/event') }}" class="btn btn-danger">@lang('blog/form.cancel')</a>
                        </div>
                    </div>
                    <!-- /.col-sm-4 --> </div>
        </div>
                <!-- /.row -->
                {!! Form::close() !!}
        </div>
    </div>
    <!--main content ends-->
</section>
@stop
{{-- page level scripts --}}
@section('footer_scripts')
  <script src="{{ asset('assets/vendors/summernote/js/summernote-bs4.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/select2/js/select2.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/bootstrap-tagsinput/js/bootstrap-tagsinput.js') }}" type="text/javascript" ></script>
<script type="text/javascript" src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}"></script>
<script src="{{ asset('assets/js/pages/add_newblog.js') }}" type="text/javascript"></script>


<script src="{{ asset('assets/vendors/moment/js/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/daterangepicker/js/daterangepicker.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/vendors/clockface/js/clockface.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/js/pages/datepicker.js') }}" type="text/javascript"></script>

<script language="javascript" type="text/javascript"
        src="{{ asset('assets/vendors/bootstrap-multiselect/js/bootstrap-multiselect.js') }}"></script>
<script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/select2/js/select2.js') }}"></script>
<script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/select2/js/select2.js') }}"></script>

<script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/sifter/sifter.js') }}"></script>
<script language="javascript" type="text/javascript"
        src="{{ asset('assets/vendors/microplugin/microplugin.js') }}"></script>
<script language="javascript" type="text/javascript"
        src="{{ asset('assets/vendors/selectize/js/selectize.min.js') }}"></script>
<script language="javascript" type="text/javascript" src="{{ asset('assets/vendors/iCheck/js/icheck.js') }}"></script>
<script language="javascript" type="text/javascript"
        src="{{ asset('assets/vendors/bootstrap-switch/js/bootstrap-switch.js') }}"></script>
<script language="javascript" type="text/javascript"
        src="{{ asset('assets/vendors/switchery/js/switchery.js') }}"></script>
<script language="javascript" type="text/javascript"
        src="{{ asset('assets/vendors/bootstrap-maxlength/js/bootstrap-maxlength.js') }}"></script>
<script language="javascript" type="text/javascript"
        src="{{ asset('assets/vendors/card/js/jquery.card.js') }}"></script>
<script language="javascript" type="text/javascript" src="{{ asset('assets/js/pages/custom_elements.js') }}"></script>
<script>
    $('body').on('hidden.bs.modal', '.modal', function () {
        $(this).removeData('bs.modal');
    });

    var date_from = '{{$event->time_from}}';
    var date_to = '{{$event->time_to}}';
    var channels = JSON.parse('{{ json_encode($selectedChannels) }}');
    console.log(channels);
    
   $("#daterange_custom").daterangepicker({
        timePicker: true,
        timePickerIncrement: 1,
        startDate: moment(date_from),
        endDate: moment(date_to),//moment().startOf('hour').add(32, 'hour'),
        locale: {
            format: 'MM/DD/YYYY h:mm A'
        }
    });
    $('#select22').val(channels);
     $('#select22').trigger('change');
    // $('#select22').select2('val', ["1","5"]);
</script>
@stop
