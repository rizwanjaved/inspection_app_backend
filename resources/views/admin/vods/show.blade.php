@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    @lang('blog/title.blogdetail')
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<link rel="stylesheet" href="{{ asset('assets/css/pages/blog.css') }}" />
@stop


{{-- Page content --}}
@section('content')
<section class="content-header">
    <!--section starts-->
    <h1>{!! $vod->title!!}</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.dashboard') }}"> <i class="livicon" data-name="home" data-size="14" data-c="#000" data-loop="true"></i>
                @lang('general.dashboard')
            </a>
        </li>
        <li>Vods</li>
        <li class="active">Vod Details</li>
    </ol>
</section>
<!--section ends-->
<section class="content">
    <!--main content-->
    <div class="row">
        <div class="col-sm-11 col-md-12 col-full-width-right">
            <div class="blog-detail-image mrg_btm15 col-md-6">
                @if(!empty($vod->image))
                <img src="{{URL::to('uploads/vods/'.$vod->image)}}" class="img-responsive" alt="Image" style="width:100%!important">
                @else
                <img data-src="holder.js/791x380/#6cc66c:#fff" class="img-responsive" alt="Image">
                @endif
                </div>
            <!-- /.blog-detail-image -->
            <div class="the-box no-border blog-detail-content">
                <p>
                    <span class="label label-danger square">{!! $vod->created_at!!}</span>
                </p>
                <hr>
                <p><strong>link:</strong> {!! $vod->link !!}</p>
                <p><strong>year:</strong> {!! $vod->year !!}</p>
                <hr>
            </div>
            <!-- /the.box .no-border --> </div>
        <!-- /.col-sm-9 --></div>
    <!--main content ends-->
</section>
    @stop
@section('footer_scripts')
    <script>
        $("img").addClass("img-responsive");
    </script>
@stop
