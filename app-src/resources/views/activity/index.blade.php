@extends('layouts.pf4-primary')

@if(!Auth::user()->hasPermission('panel.activity-reports.view'))

@section('pageTitle', 'Permission Denied')

@section('content')
<p class="pf-u-text-center">Permission Denied</p>
@endsection
@else

@section('pageTitle', 'Activity Reports')
@section('pageAction')
<select id="reportTypeSwitcher" class="pf-c-form-control pf-u-display-inline" style="display: inline-block;float: right;width: fit-content;padding-right: 3rem;">
  <option value="">Select a report type...</option>
  <option value="user" {{ (isset($data["reportType"]) && ($data["reportType"] == 'user')) ? 'selected="selected"' : '' }}>Individual User Report</option>
  <option value="workshop" {{ (isset($data["reportType"]) && ($data["reportType"] == 'workshop')) ? 'selected="selected"' : '' }}>Per Workshop Activity Report</option>
  <option value="event" {{ (isset($data["reportType"]) && ($data["reportType"] == 'event')) ? 'selected="selected"' : '' }}>Per Event Activity Report</option>
</select>
@endsection
@section('content')

<div class="pf-c-card">
    @if(isset($data['reportType']))
    @switch($data['reportType'])
    @case("user")
      @if(isset($data['reportTarget']))
      @else
      @include('activity.includes.user-list')
      @endif
    @break
    @case("workshop")
      @if(isset($data['reportTarget']))
      @else
      @include('activity.includes.workshop-list')
      @endif
    @break
    @case("event")
      @if(isset($data['reportTarget']))
      @else
      @include('activity.includes.event-list')
      @endif
    @break
    @default
    <div class="pf-c-card__body">
      <p class="pf-u-text-align-center">INVALID RESOURCE TYPE</p>
    </div>
    @break
    @endswitch
    @else
    <div class="pf-c-card__body">
      <p class="pf-u-text-align-center">Select a report type</p>
    </div>
    @endif
</div>

@endsection

@section('footerScripts')
<script type="text/javascript">
  jQuery(document).ready(function() {
    jQuery("#reportTypeSwitcher").change(function(e) {
      e.preventDefault();
      window.location.href = "{{ route('panel.get.activity.index') }}/" + this.value;
    });
  });
</script>
@endsection

@endif