@extends('admin/layouts/default')

{{-- Web site Title --}}
@section('title')
@lang('groups/title.management')
@parent
@stop

{{-- Content --}}
@section('content')
<section class="content-header">
    <h1>Channel Regions Management</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('admin.dashboard') }}">
                <i class="livicon" data-name="home" data-size="14" data-color="#000"></i>
                @lang('general.dashboard')
            </a>
        </li>
        <li><a href="#"> Categorie</a></li>
        <li class="active">@lang('groups/title.groups_list')</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card panel-primary ">
                <div class="card-heading clearfix">
                    <h4 class="card-title float-left"> <i class="livicon" data-name="users" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Regions
                    </h4>
                    <div class="float-right">
                    <a href="{{ route('admin.region.create') }}" class="btn btn-sm btn-default"><span class="fa fa-plus"></span> @lang('button.create')</a>
                    </div>
                </div>
                <br />
                <div class="card-body">
                    @if ($regions->count() >= 1)
                        <div class="table-responsive-lg table-responsive-md table-responsive-sm table-responsive ">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>@lang('groups/table.id')</th>
                                    <th>@lang('groups/table.name')</th>
                                    <th>@lang('groups/table.created_at')</th>
                                    <th>@lang('groups/table.actions')</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($regions as $region)
                                <tr>
                                    <td>{!! $region->id !!}</td>
                                    <td>{!! $region->name !!}</td>
                                    <td>{!! $region->created_at->diffForHumans() !!}</td>
                                    <td>
                                        <a href="{{ route('admin.region.edit', $region->id) }}">
                                            <i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="Edit Region"></i>
                                        </a>
                                            @if($region->channels()->count())
                                                <a href="#" data-toggle="modal" data-target="#users_exists" data-name="{!! $region->name !!}" class="users_exists">
                                                    <i class="livicon" data-name="warning-alt" data-size="18"
                                                        data-loop="true" data-c="#f56954" data-hc="#f56954"
                                                        title="Channels Exists"></i>
                                                </a>
                                            @else
                                                <a href="{{ route('admin.region.destroy', $region->id) }}" data-toggle="modal" data-id ="{{ $region->id }}" data-target="#delete_confirm">
                                                    <i class="livicon" data-name="remove-alt" data-size="18"
                                                        data-loop="true" data-c="#f56954" data-hc="#f56954"
                                                        title="Delete Category"></i>
                                                </a>
                                            @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    @else
                        @lang('general.noresults')
                    @endif   
                </div>
            </div>
        </div>
    </div>    <!-- row-->
</section>




@stop

{{-- Body Bottom confirm modal --}}
@section('footer_scripts')
{{--<div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="user_delete_confirm_title" aria-hidden="true">--}}
  {{--<div class="modal-dialog">--}}
    {{--<div class="modal-content">--}}
    {{--</div>--}}
  {{--</div>--}}
{{--</div>--}}
<div class="modal fade" id="users_exists" tabindex="-2" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Regions Exists</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                Region contains Channels, region can not be deleted
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="deleteLabel">Delete Region</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                Are you sure to delete this Region? This operation is irreversible.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a  type="button" class="btn btn-danger Remove_square">Delete</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
</div>
{{--<script>--}}
    {{--$(function () {$('body').on('hidden.bs.modal', '.modal', function () {$(this).removeData('bs.modal');});});--}}
    {{--$(document).on("click", ".users_exists", function () {--}}

        {{--var group_name = $(this).data('name');--}}
        {{--$(".modal-header h4").text( group_name+" Group" );--}}
    {{--});</script>--}}


<script>
    var $url_path = '{!! url('/') !!}';
    $('#delete_confirm').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var $recipient = button.data('id');
        var modal = $(this)
        modal.find('.modal-footer a').prop("href",$url_path+"/admin/region/"+$recipient+"/delete");
    })
</script>
@stop
