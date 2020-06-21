@extends('layouts.pf4-primary')

@section('pageTitle', 'Create an Event')

@section('headerScripts')
<style type="text/css" rel="stylesheet">
  .pf-c-form-control[readonly] {
    background-color:inherit;
  }
  h1 {
    font-weight:bold;
    font-size:1rem;
    margin-bottom:1rem;
  }
  #assetFactoryHolder .asset_group {
    margin-bottom:1rem;
    border-bottom:1px solid grey;
    padding-bottom: 1rem;
  }
  .pf-c-button.pf-m-small {
    --pf-c-button--FontSize: var(--pf-c-button--m-small--FontSize);
    padding: 5px 10px;
    font-size: 0.8rem;
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
      
    <div class="pf-c-form__group pf-u-mb-sm">
      <div class="pf-c-form__group-label">
        <label class="pf-c-form__label" for="event_eid">
          <span class="pf-c-form__label-text">Event ID</span>
          <span class="pf-c-form__label-required" aria-hidden="true">&#42;</span>
        </label>
      </div>
      <div class="pf-c-form__group-control">
        <input class="pf-c-form-control" type="text" id="event_eid" name="event_eid" required />
      </div>
    </div>
      
    <div class="pf-c-form__group pf-u-mb-sm">
      <div class="pf-c-form__group-label">
        <label class="pf-c-form__label" for="event_seat_count">
          <span class="pf-c-form__label-text">Seat Count</span>
          <span class="pf-c-form__label-required" aria-hidden="true">&#42;</span>
        </label>
      </div>
      <div class="pf-c-form__group-control">
        <input class="pf-c-form-control" type="number" value="50" step="1" id="event_seat_count" name="event_seat_count" required />
      </div>
    </div>
      
    <div class="collapse" id="assetFactoryHolder">
      <div class="pf-c-form__group pf-u-mb-sm">
        <div class="pf-c-form__group-label">
          <label class="pf-c-form__label">
            <span class="pf-c-form__label-text">Assets</span>
          </label>
        </div>
        <div class="pf-c-form__group-control">
          <div class="pf-c-card">
            <div class="pf-c-card__body">
            </div>
            <div class="pf-c-card__footer">
              <button class="pf-c-button pf-m-secondary pf-u-float-right" role="button">Add Asset</button>
            </div>
          </div>
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
    jQuery("#createEventForm").on('change', "#event_workshop_id", function(e) {
      e.preventDefault();
      var workshop_id = this.value;
      jQuery("#assetFactoryHolder").removeClass('show');
      jQuery.ajax({method: "POST", data: { id: workshop_id }, url: "{{ route('panel.post.workshop.listAssets') }}", async: false, success: function(result){
        console.log(result);
        jQuery("#assetFactoryHolder .pf-c-card__body .asset_group").remove();
        for (var key in result) {
            // skip loop if the property is from prototype
            if (!result.hasOwnProperty(key)) continue;

            var obj = result[key];
            var asset_data = JSON.parse(obj['asset_data']);
            switch (obj['asset_type']) {
              case "cookie":
                jQuery("#assetFactoryHolder .pf-c-card__body").append('<div class="asset_group" id="event-asset_cookie_'+obj['slug']+'-holder"><h1>['+obj['asset_type'].charAt(0).toUpperCase() + obj['asset_type'].slice(1) +'] '+obj['name']+'<button class="pf-c-button pf-m-danger pf-m-small pf-u-float-right"><i class="pf-icon pf-icon-remove2"></i></button></h1>' +
                '<div class="pf-c-form__group"><div class="pf-c-form__group-label"><label class="pf-c-form__label" for="event-asset_cookie-key_'+obj['slug']+'"><span class="pf-c-form__label-text">Key</span></label></div>' +
                '<div class="pf-c-form__group-control"><input class="pf-c-form-control" type="text" id="event-asset_cookie-key_'+obj['slug']+'" name="event-asset_cookie-key_'+obj['slug']+'" value="'+asset_data['key']+'" /></div></div>' +
                '<div class="pf-c-form__group"><div class="pf-c-form__group-label"><label class="pf-c-form__label" for="event-asset_cookie-value_'+obj['slug']+'"><span class="pf-c-form__label-text">Value</span></label></div>' +
                '<div class="pf-c-form__group-control"><input class="pf-c-form-control" type="text" id="event-asset_cookie-value_'+obj['slug']+'" name="event-asset_cookie-value_'+obj['slug']+'" value="'+asset_data['default_value']+'" /></div></div>' +
                '<input type="hidden" id="event-asset_cookie-domain_'+obj['slug']+'" name="event-asset_cookie-domain_'+obj['slug']+'" value="'+asset_data['domain']+'" />' +
                '<input type="hidden" id="event-asset_cookie-path_'+obj['slug']+'" name="event-asset_cookie-path_'+obj['slug']+'" value="'+asset_data['path']+'" />' +
                '<input type="hidden" id="event-asset_cookie-expiration_'+obj['slug']+'" name="event-asset_cookie-expiration_'+obj['slug']+'" value="'+asset_data['expiration']+'" />' +
                '<input type="hidden" id="event-asset_cookie-name_'+obj['slug']+'" name="event-asset_cookie-name_'+obj['slug']+'" value="'+obj['name']+'" />' +
                '</div>');

                for (var prop in obj) {
                    // skip loop if the property is from prototype
                    if (!obj.hasOwnProperty(prop)) continue;

                    // your code
                    console.log(prop + " = " + obj[prop]);
                }
              break;
              case "credentials":
              break;
              case "link":
              break;
            }
        }
        //jQuery("#assetFactoryHolder .pf-c-card__body").text(result);
      }});
      jQuery("#assetFactoryHolder").addClass('show');

      jQuery(".asset_group").on("click", ".pf-m-danger", function(e) {
        e.preventDefault();
        jQuery(this).parent().parent().remove();
      });
    });

    jQuery("#createEventForm").on('reset', function(e) {
      jQuery("#assetFactoryHolder .pf-c-card__body .asset_group").remove();
      jQuery("#assetFactoryHolder").removeClass('show');
    });

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