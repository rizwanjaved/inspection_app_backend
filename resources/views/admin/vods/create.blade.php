@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    @lang('blog/title.add-blog') :: @parent
@stop

{{-- page level styles --}}
@section('header_styles')

    <link href="{{ asset('assets/vendors/summernote/css/summernote-bs4.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendors/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/bootstrap-tagsinput/css/bootstrap-tagsinput.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/pages/blog.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}">
    <link href="{{ asset('assets/vendors/pickadate/css/default.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/vendors/pickadate/css/default.date.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/vendors/pickadate/css/default.time.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/vendors/airDatepicker/css/datepicker.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/vendors/flatpickr/css/flatpickr.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/css/pages/adv_date_pickers.css') }}" rel="stylesheet" type="text/css"/>
    <!--end of page level css-->
@stop


{{-- Page content --}}
@section('content')
<section class="content-header">
    <!--section starts-->
    <h1>Add New VOD</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.dashboard') }}"> <i class="livicon" data-name="home" data-size="14" data-c="#000" data-loop="true"></i>
                @lang('general.home')
            </a>
        </li>
        <li>
            <a href="#">Vods</a>
        </li>
        <li class="active">Vod Create</li>
    </ol>
</section>
<!--section ends-->
<section class="content paddingleft_right15">
    <!--main content-->
    <div class="row">
        <div class="col-12">
        <div class="the-box no-border">
            <!-- errors -->
            {!! Form::open(array('url' => URL::to('admin/vod'), 'method' => 'post', 'class' => 'bf', 'files'=> true)) !!}
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                 <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group {{ $errors->first('title', 'has-error') }}">
                            {!! Form::label('title', 'Title') !!}
                            {!! Form::text('title', null, array('class' => 'form-control input-lg','placeholder'=> trans('blog/form.ph-title'))) !!}
                            <span class="help-block">{{ $errors->first('title', ':message') }}</span>
                        </div>
                         <div class="form-group {{ $errors->first('title', 'has-error') }}">
                            {!! Form::label('link', 'link') !!}
                            {!! Form::text('link', null, array('class' => 'form-control input-lg','placeholder'=> trans('blog/form.ph-title'))) !!}
                            <span class="help-block">{{ $errors->first('title', ':message') }}</span>
                        </div>
                        <div class="form-group">
                            <label>Year</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                      <span class="input-group-text"> <i class="livicon" data-name="laptop" data-size="16" data-c="#555555"
                                       data-hc="#555555" data-loop="true"></i></span>
                                </div>
                                <input type="text" class="form-control" id="rangepicker4" name="year"/>
                            </div>
                            <!-- /.input group -->
                        </div>
                       
                    </div>
                    <!-- /.col-sm-8 -->
                    <div class="col-sm-4">
                        <div class="form-group {{ $errors->first('blog_category_id', 'has-error') }}">
                            <label for="blog_category" class="">Blog Category</label>
                            {!! Form::select('category_id',$categories ,null, array('class' => 'form-control select2', 'id'=>'blog_category' ,'placeholder'=>trans('blog/form.select-category'))) !!}
                            <span class="help-block text-danger">{{ $errors->first('category_id', ':message') }}</span>
                        </div>
                        <label>@lang('blog/form.lb-featured-img')</label>
                        <div class="form-group">


                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="max-width: 200px; max-height: 200px;">
                                    <img src="{{ asset('assets/images/authors/no_avatar.jpg') }}" alt="..."
                                         class="img-responsive"/>
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                <div>
                                            <span class="btn btn-primary btn-file">
                                                <span class="fileinput-new">Select image</span>
                                                <span class="fileinput-exists">Change</span>
                                                <input type="file" name="image" id="pic" accept="image/*" />
                                            </span>
                                    <span class="btn btn-primary fileinput-exists" data-dismiss="fileinput">Remove</span>
                                </div>
                                <span class="help-block text-danger">{{ $errors->first('image', ':message') }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">@lang('blog/form.publish')</button>
                            <a href="{!! URL::to('admin/vod') !!}"
                               class="btn btn-danger">@lang('blog/form.discard')</a>
                        </div>
                    </div>
                    <!-- /.col-sm-4 --> 
                </div>
                {!! Form::close() !!}
        </div>
        </div>
    </div>
    <!--main content ends-->
</section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
<!-- begining of page level js -->
<!--edit blog-->
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
     $("#daterange_custom").daterangepicker({
    timePicker: true,
    timePickerIncrement: 1,
    locale: {
        format: 'MM/DD/YYYY h:mm A'
    }
</script>

@stop
