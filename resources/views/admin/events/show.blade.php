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
    <h1>{!! $event->title!!}</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.dashboard') }}"> <i class="livicon" data-name="home" data-size="14" data-c="#000" data-loop="true"></i>
                @lang('general.dashboard')
            </a>
        </li>
        <li>Events</li>
        <li class="active">Event Details</li>
    </ol>
</section>
<!--section ends-->
<section class="content">
    <!--main content-->
    <div class="row">
        <div class="col-sm-11 col-md-12 col-full-width-right">
            <div class="the-box no-border blog-detail-content">
                <p>
                    <span class="label label-danger square">{!! $event->created_at!!}</span>
                </p>
                <p><strong>From:</strong> {!! $event->f_from !!}</p>
                <hr>
                <p><strong>To:</strong> {!! $event->f_to !!}</p>
                <hr>
                <p><strong>Event Type:</strong> {!! $event->event_type !!}</p>
                <hr>
                <p><strong>Event Status:</strong> {!! $event->event_status !!}</p>
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
