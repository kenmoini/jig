@extends('layouts.pf4-primary')

@if(!Auth::user()->hasPermission('panel.activity-reports.view'))

@section('pageTitle', 'Permission Denied')

@section('content')
<p class="pf-u-text-center">Permission Denied</p>
@endsection
@else

@section('pageTitle', 'Activity Reports')

@section('content')

GOOD STUFF RIGHT HERE

@endsection

@endif