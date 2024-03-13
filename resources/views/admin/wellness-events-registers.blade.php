@extends('voyager::master')

@section('css')
    <!-- Any additional CSS styles -->
@stop
@php
$title_view = "Wellness Events Up Points";
@endphp
@section('page_title', __('voyager::generic.viewing').' Wellness Events Up Points')

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-ticket"></i>
        {{$title_view}}
        <span class="page-description">Load points by activity or event for a user using their identification number.</span>
    </h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="side-body padding-top">
        <div class="container-fluid">
            <h1 class="page-title">
                <i class=""></i> {{$title_view}}
            </h1>
            <a href="{{URL::current()}}" class="btn btn-success btn-add-new">
                <i class="voyager-plus"></i> <span>Add New</span>
            </a>
{{--            <a class="btn btn-danger" id="bulk_delete_btn"><i class="voyager-trash"></i> <span>Bulk Delete</span></a>--}}

        </div>
        <div id="voyager-notifications"></div>
        <div class="page-content browse container-fluid">
            <div class="alerts">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @elseif(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-bordered">
                        <div class="panel-body">
                            <div class="table-responsive">
                                {{--                {{ route('wellness-events-registers.save') }}--}}
                                <form id="points-form" action="{{ route('wellness-events-up-points.save') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <input type="hidden" name="id_event" value="{{$event_id}}">
                                        <label for="identification_number">Identification Number:</label>
                                        <input type="text" class="form-control" id="identification_number" name="identification_number" pattern="[0-9]+" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


{{--        <div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">--}}
{{--            <div class="modal-dialog">--}}
{{--                <div class="modal-content">--}}
{{--                    <div class="modal-header">--}}
{{--                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>--}}
{{--                        <h4 class="modal-title"><i class="voyager-trash"></i> Are you sure you want to delete this wellness event?</h4>--}}
{{--                    </div>--}}
{{--                    <div class="modal-footer">--}}
{{--                        <form action="#" id="delete_form" method="POST">--}}
{{--                            <input type="hidden" name="_method" value="DELETE">--}}
{{--                            <input type="hidden" name="_token" value="31MXzwA8GqUEqWjaMLyCMnXSHqnbF9ytQPVFXMQo">--}}
{{--                            <input type="submit" class="btn btn-danger pull-right delete-confirm" value="Yes, Delete it!">--}}
{{--                        </form>--}}
{{--                        <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancel</button>--}}
{{--                    </div>--}}
{{--                </div><!-- /.modal-content -->--}}
{{--            </div><!-- /.modal-dialog -->--}}
{{--        </div><!-- /.modal -->--}}
    </div>
</div>
@stop

@section('javascript')
    <!-- Any additional JavaScript code -->
@stop
