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
    <style>
    .label {
        white-space:unset !important;
        word-wrap: break-word !important;
    }
    </style>
    <!--end of page level css-->
@stop


{{-- Page content --}}
@section('content')
<section class="content-header">
    <!--section starts-->
    <h1>Add Contravention</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.dashboard') }}"> <i class="livicon" data-name="home" data-size="14" data-c="#000" data-loop="true"></i>
                @lang('general.home')
            </a>
        </li>
        <li>
            <a href="#">Contraventions</a>
        </li>
        <li class="active">Add Contraventions</li>
    </ol>
</section>
<!--section ends-->
<section class="content paddingleft_right15">
    <!--main content-->
    <div class="row">
        <div class="col-12">
        <div class="the-box no-border">
            <!-- errors -->
            {!! Form::open(array('url' => URL::to('admin/contraventions'), 'method' => 'post', 'class' => 'bf', 'files'=> true)) !!}
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                 <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group {{ $errors->first('car_id', 'has-error') }}">
                            {!! Form::label('car_id',"Car") !!}
                            {!! Form::select('car_id',$cars ,null, array('class' => 'form-control select2', 'id'=>'blog_category' ,'placeholder'=>trans('Select Car'))) !!}
                            <span class="help-block">{{ $errors->first('car_id', ':message') }}</span>
                        </div>
                        <!--  -->
                        <div class="form-group {{ $errors->first('due_date', 'has-error') }}">
                            {!! Form::label('due_date',"due_date") !!}
                            {!! Form::date('due_date', null, array('class' => 'form-control input-lg amount','placeholder'=> trans('blog/form.ph-title'))) !!}                           
                            <span class="help-block">{{ $errors->first('due_date', ':message') }}</span>
                        </div>
                    </div>
                    <!-- /.col-sm-8 -->
                    <div class="col-sm-4">
                        <div class="form-group {{ $errors->first('contravention_type', 'has-error') }}">
                            {!! Form::label('contravention_type',"contravention_type") !!}
                            {!! Form::select('contravention_type',$contravention_types ,null, array('class' => 'form-control select2', 'id'=>'contravention_type' ,'placeholder'=>trans('Select contravention_type'))) !!}
                            <span class="help-block">{{ $errors->first('contravention_type', ':message') }}</span>
                        </div>

                        <div class="form-group {{ $errors->first('registration_fee', 'has-error') }}">
                            {!! Form::label('registration_fee',' Amount') !!}
                            {!! Form::text('registration_fee', null, array('class' => 'form-control input-lg contravention_amount','disabled','placeholder'=> trans('blog/form.ph-title'))) !!}
                            <span class="help-block">{{ $errors->first('registration_fee', ':message') }}</span>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success">@lang('blog/form.publish')</button>
                            <a href="{!! URL::to('admin/channel') !!}"
                               class="btn btn-danger">@lang('blog/form.discard')
                            </a>
                        </div>
                       <p>
                            <span class="help-block text-danger">{{ $errors->first('image', ':message') }}</span>                       
                       </p>
                    </div>
                    <!-- /.col-sm-4 --> </div>
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
<script>
    $('body').on('hidden.bs.modal', '.modal', function () {
        $(this).removeData('bs.modal');
    });
    $(document).ready(function(){
        var types =JSON.parse('<?=$types ?>');
        var el =  $('#contravention_type');
        if(el.val()){
            setAmount()
        }
        el.change(function() {
              if(el.val()){
                    setAmount()
                }
        });
        var setAmount = function() {
            var obj = types.find((x)=> {return x.id==el.val() ? x : ''});
            $('.contravention_amount').val(obj.amount);
        }
    });
</script>

@stop
