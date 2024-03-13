@extends('voyager::master')

@section('css')
    <!-- Any additional CSS styles -->
@stop
@php
    $title_view = "Error";
@endphp
@section('page_title', __('voyager::generic.viewing').' Wellness Events Up Points')

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-ticket"></i>
        {{$title_view}}
        <span class="page-description">The event not is active</span>
    </h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="side-body padding-top">
            <div class="container-fluid">
                <h1 class="page-title text-danger">
                    <i class=""></i> {{$title_view}} date active is {{$event->start_date}} to {{$event->end_date}}
                </h1>
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
                                    <a href="{{ URL::previous() }}">Volver</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@stop

@section('javascript')
    <!-- Any additional JavaScript code -->
@stop
