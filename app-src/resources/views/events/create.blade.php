@extends('layouts.pf4-primary')

@section('pageTitle', 'Create an Event')

@section('headerScripts')
<style type="text/css" rel="stylesheet">
.pf-c-form-control[readonly] {
  background-color:inherit;
}
</style>
@endsection

@section('content')
<form novalidate class="pf-c-form pf-m-horizontal" id="createEventForm" action="{{ route('panel.post.events.store') }}" method="POST">
  @csrf
  <div class="pf-c-form__group">
    <div class="pf-c-form__group-label">
      <label class="pf-c-form__label" for="event_title">
        <span class="pf-c-form__label-text">Event Title</span>
        <span class="pf-c-form__label-required" aria-hidden="true">&#42;</span>
      </label>
    </div>
    <div class="pf-c-form__group-control">
      <input class="pf-c-form-control" type="text" id="event_title" name="event_title" required />
    </div>
  </div>
  <div class="pf-c-form__group">
    <div class="pf-c-form__group-label">
      <label class="pf-c-form__label" for="event_workshop_id">
        <span class="pf-c-form__label-text">Event Workshop</span>
        <span class="pf-c-form__label-required" aria-hidden="true">&#42;</span>
      </label>
    </div>
    <div class="pf-c-form__group-control">
      <select class="pf-c-form-control" id="event_workshop_id" name="event_workshop_id" required>
        <option value="">Select an workshop...</option>
        @foreach($workshops as $workshop)
          <option value="{{ $workshop->id }}">{{ $workshop->name }}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="" id="eventDetailsHolder">
    <div class="pf-c-form__group">
      <div class="pf-c-form__group-label">
        <label class="pf-c-form__label" for="event_description">
          <span class="pf-c-form__label-text">Description</span>
        </label>
      </div>
      <div class="pf-c-form__group-control">
        <textarea class="pf-c-form-control" type="text" id="event_description" name="event_description" aria-label="A description of the event, used publicly"></textarea>
      </div>
    </div>
    <div class="pf-c-form__group">
      <div class="pf-c-form__group-label">
        <label class="pf-c-form__label" for="event_private_notes">
          <span class="pf-c-form__label-text">Private Notes</span>
        </label>
      </div>
      <div class="pf-c-form__group-control">
        <textarea class="pf-c-form-control" type="text" id="event_private_notes" name="event_private_notes" aria-label="Private notes, used internally"></textarea>
      </div>
    </div>

    <div class="pf-c-form__group pf-u-mb-sm">
      <div class="pf-c-form__group-label">
        <label class="pf-c-form__label" for="event_start_date">
          <span class="pf-c-form__label-text">Start Date</span>
          <span class="pf-c-form__label-required" aria-hidden="true">&#42;</span>
        </label>
      </div>
      <div class="pf-c-form__group-control">
        <div class="pf-c-input-group">
          <span class="pf-c-input-group__text">
            <i class="pf-icon pf-icon-on-running" aria-hidden="true"></i>
          </span>
          <input class="pf-c-form-control" type="text" id="event_start_date" name="event_start_date" aria-label="Event start date" required />
        </div>
      </div>
    </div>
    <div class="pf-c-form__group pf-u-mb-sm">
      <div class="pf-c-form__group-label">
        <label class="pf-c-form__label" for="event_end_date">
          <span class="pf-c-form__label-text">End Date</span>
          <span class="pf-c-form__label-required" aria-hidden="true">&#42;</span>
        </label>
      </div>
      <div class="pf-c-form__group-control">
        <div class="pf-c-input-group">
          <span class="pf-c-input-group__text">
            <i class="pf-icon pf-icon-asleep" aria-hidden="true"></i>
          </span>
          <input class="pf-c-form-control" type="text" id="event_end_date" name="event_end_date" aria-label="Event end date" required />
        </div>
      </div>
    </div>

    <div class="pf-c-form__group pf-m-action">
      <div class="pf-c-form__actions">
      </div>
      <div class="pf-c-form__group-control">
        <button class="pf-c-button pf-m-primary" type="submit">Create</button>
        <button class="pf-c-button pf-m-secondary" type="reset">Reset form</button>
      </div>
    </div>
  </div>
</form>

@endsection

@section('footerScripts')

<script type="text/javascript" src="/assets/js/vendor-flatpickr.min.js"></script>
<script type="text/javascript">
  jQuery(document).ready(function() {
    
    /*
    jQuery("#createEventForm").on('change', "#event_workshop_id", function(e) {
      e.preventDefault();
      jQuery("#eventDetailsHolder").removeClass('show');
      jQuery("#eventDetailsHolder").addClass('show');
    });

    jQuery("#addAssetForm").on('reset', function(e) {
      jQuery("#eventDetailsHolder").removeClass('show');
    });
    */
    flatpickr("#event_start_date", {
      enableTime: true,
      dateFormat: "Y-m-d H:i:S",
      defaultHour: 8,
    });
    flatpickr("#event_end_date", {
      enableTime: true,
      dateFormat: "Y-m-d H:i:S",
      defaultHour: 8,
    });
      /*
      $("#event_start_date").on("change.datetimepicker", function (e) {
        $('#event_end_date').datetimepicker('minDate', e.date);
      });
      $("#event_end_date").on("change.datetimepicker", function (e) {
        $('#event_start_date').datetimepicker('maxDate', e.date);
      });*/
  });
</script>
@endsection