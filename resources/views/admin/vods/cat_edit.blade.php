@extends('admin/layouts/default')

{{-- Web site Title --}}
@section('title')
@lang('groups/title.edit')
@parent
@stop

{{-- Content --}}
@section('content')
<section class="content-header">
    <h1>
        Edit VOD Categories
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.dashboard') }}">
                <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                @lang('general.dashboard')
            </a>
        </li>
         <li>Vod</li>
        <li class="active">
          Edit VOD Categories
        </li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card panel-primary ">
                <div class="card-heading">
                    <h4 class="card-title"> <i class="livicon" data-name="wrench" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                       Edit VOD Categories
                    </h4>
                </div>
                <div class="card-body">
                    @if($category)
                        {!! Form::model($category, ['url' => URL::to('admin/vodc/'. $category->id.'/update'), 'method' => 'put', 'class' => 'form-horizontal']) !!}
                            <!-- CSRF Token -->
                            {{ csrf_field() }}

                            <div class="form-group {{ $errors->
                                first('name', 'has-error') }}">
                                <div class="row">
                                <label for="title" class="col-sm-2 control-label">
                                   Title
                                </label>
                                <div class="col-sm-5">
                                    <input type="text" id="name" name="title" class="form-control"
                                           placeholder=@lang('groups/form.name') value="{!! old('title', $category->
                                    title) !!}">
                                </div>
                                <div class="col-sm-4">
                                    {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
                                </div>
                                </div>
                            </div>
                            </div>
                        <div class="form-group">
                            <div class="row">
                            <div class="offset-sm-2 col-sm-4">
                                <a class="btn btn-danger" href="{{ route('admin.catIndex') }}">
                                    @lang('button.cancel')
                                </a>
                                <button type="submit" class="btn btn-success">
                                    @lang('button.save')
                                </button>
                            </div>
                            </div>
                        </div>
                    </form>
                    @else
                        <h1>@lang('groups/message.error.no_role_exists')</h1>
                            <a class="btn btn-danger" href="{{ route('admin.category.index') }}">
                                @lang('button.back')
                            </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- row-->
</section>

@stop
