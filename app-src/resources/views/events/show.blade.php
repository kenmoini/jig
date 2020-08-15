@extends('layouts.pf4-primary')

@section('pageTitle', 'Viewing Event - ' . $event->event_title)

@section('content')


<ul class="pf-c-data-list" role="list" aria-label="Basic data list example" id="data-list-basic">
  <li class="pf-c-data-list__item" aria-labelledby="event-title">
    <div class="pf-c-data-list__item-row">
      <div class="pf-c-data-list__item-content">
        <div class="pf-c-data-list__cell">
          <span id="event-title">Event Title</span>
        </div>
        <div class="pf-c-data-list__cell">{{ $event->event_title }}</div>
      </div>
    </div>
  </li>
  <li class="pf-c-data-list__item" aria-labelledby="event-created-at">
    <div class="pf-c-data-list__item-row">
      <div class="pf-c-data-list__item-content">
        <div class="pf-c-data-list__cell">
          <span id="event-created-at">Created at</span>
        </div>
        <div class="pf-c-data-list__cell">{{ $event->created_at->format('m/d/y h:iA') }}</div>
      </div>
    </div>
  </li>
  <li class="pf-c-data-list__item" aria-labelledby="event-user">
    <div class="pf-c-data-list__item-row">
      <div class="pf-c-data-list__item-content">
        <div class="pf-c-data-list__cell">
          <span id="event-user">Created By</span>
        </div>
        <div class="pf-c-data-list__cell">{{ $event->user()->first()->name }}</div>
      </div>
    </div>
  </li>
  <li class="pf-c-data-list__item" aria-labelledby="event-times">
    <div class="pf-c-data-list__item-row">
      <div class="pf-c-data-list__item-content">
        <div class="pf-c-data-list__cell">
          <span id="event-times">Dates</span>
        </div>
        <div class="pf-c-data-list__cell"><strong>Start</strong> {{ $event->start_time->format('m/d/y h:iA') }}
        <br /><strong>End</strong> {{ $event->end_time->format('m/d/y h:iA') }}</div>
      </div>
    </div>
  </li>
  <li class="pf-c-data-list__item" aria-labelledby="event-event_id">
    <div class="pf-c-data-list__item-row">
      <div class="pf-c-data-list__item-content">
        <div class="pf-c-data-list__cell">
          <span id="event-event_id">Event ID</span>
        </div>
        <div class="pf-c-data-list__cell">{{ $event->event_id }}</div>
      </div>
    </div>
  </li>
  <li class="pf-c-data-list__item" aria-labelledby="event-location">
    <div class="pf-c-data-list__item-row">
      <div class="pf-c-data-list__item-content">
        <div class="pf-c-data-list__cell">
          <span id="event-location">Location</span>
        </div>
        <div class="pf-c-data-list__cell">{{ $event->location }}</div>
      </div>
    </div>
  </li>
  <li class="pf-c-data-list__item" aria-labelledby="event-seat_count">
    <div class="pf-c-data-list__item-row">
      <div class="pf-c-data-list__item-content">
        <div class="pf-c-data-list__cell">
          <span id="event-seat_count">Number of Seats</span>
        </div>
        <div class="pf-c-data-list__cell">{{ $event->seat_count }}</div>
      </div>
    </div>
  </li>
  <li class="pf-c-data-list__item" aria-labelledby="event-privacy_level">
    <div class="pf-c-data-list__item-row">
      <div class="pf-c-data-list__item-content">
        <div class="pf-c-data-list__cell">
          <span id="event-privacy_level">Privacy Level</span>
        </div>
        <div class="pf-c-data-list__cell">
        @if($event->privacy_level == 0)
        Public
        @elseif($event->privacy_level == 1)
        Public, passcode protected ({{$event->passcode}})
        @else
        Private
        @endif
        </div>
      </div>
    </div>
  </li>
  <li class="pf-c-data-list__item" aria-labelledby="event-description">
    <div class="pf-c-data-list__item-row">
      <div class="pf-c-data-list__item-content">
        <div class="pf-c-data-list__cell">
          <span id="event-description">Description</span>
        </div>
        <div class="pf-c-data-list__cell">{{ $event->description }}</div>
      </div>
    </div>
  </li>
  <li class="pf-c-data-list__item" aria-labelledby="event-private_notes">
    <div class="pf-c-data-list__item-row">
      <div class="pf-c-data-list__item-content">
        <div class="pf-c-data-list__cell">
          <span id="event-private_notes">Private Notes</span>
        </div>
        <div class="pf-c-data-list__cell">{{ $event->private_notes }}</div>
      </div>
    </div>
  </li>
  <li class="pf-c-data-list__item" aria-labelledby="event-Assets">
    <div class="pf-c-data-list__item-row">
      <div class="pf-c-data-list__item-content">
        <div class="pf-c-data-list__cell">
          <span id="event-Assets">Effective Assets (make this nicer)</span>
        </div>
        <div class="pf-c-data-list__cell">
        <table class="pf-c-table pf-m-grid-lg" role="grid" id="effectiveAsset-table">
          <thead>
            <tr role="row">
              <th role="columnheader" scope="col">
                <div class="pf-c-table__button-content">
                  <span class="pf-c-table__text">Type</span>
                </div>
              </th>
              <th role="columnheader" scope="col">
                <div class="pf-c-table__button-content">
                  <span class="pf-c-table__text">Key</span>
                </div>
              </th>
              <th role="columnheader" scope="col">
                <div class="pf-c-table__button-content">
                  <span class="pf-c-table__text">Value</span>
                </div>
              </th>
            </tr>
          </thead>
          <tbody>
          @php
          $assetDatas = json_decode($event->effective_asset_data);
          @endphp
          @if(isset($assetDatas->cookies))
          @foreach($assetDatas->cookies as $cookies)
            <tr role="row">
              <td role="cell" data-label="Asset Type: Cookie">Cookie</td>
              <td role="cell" data-label="Key: {{ $cookies->cookie_key }}">{{ $cookies->cookie_key }}</td>
              <td role="cell" data-label="Value: {{ $cookies->cookie_value }}">{{ $cookies->cookie_value }}</td>
            </tr>
          @endforeach
          @else
            <tr role="row">
              <td role="cell" class="pf-u-text-align-center" data-label="No records" colspan="3">No cookie assets found!</td>
            </tr>
          @endif
          </tbody>
        </table>
        <span class="pf-u-display-none">{{ $event->effective_asset_data }}</span>
        </div>
      </div>
    </div>
  </li>
</ul>

<table class="pf-c-table pf-m-grid-lg pf-u-mt-xl pf-u-mb-xl" role="grid" aria-label="Listing of event attendees and seats" id="attendees-table">
  <thead>
    <tr role="row">
      <th class="pf-c-table__sort pf-m-selected" role="columnheader" aria-sort="ascending" scope="col">
        <button class="pf-c-table__button">
          <div class="pf-c-table__button-content">
            <span class="pf-c-table__text">Seat Number</span>
            <span class="pf-c-table__sort-indicator">
              <i class="fas fa-long-arrow-alt-up"></i>
            </span>
          </div>
        </button>
      </th>
      <th class="pf-c-table__sort" role="columnheader" aria-sort="none" scope="col">
        <button class="pf-c-table__button">
          <div class="pf-c-table__button-content">
            <span class="pf-c-table__text">Status</span>
            <span class="pf-c-table__sort-indicator">
              <i class="fas fa-arrows-alt-v"></i>
            </span>
          </div>
        </button>
      </th>
      <th class="pf-c-table__sort " role="columnheader" aria-sort="none" scope="col">
        <button class="pf-c-table__button">
          <div class="pf-c-table__button-content">
            <span class="pf-c-table__text">Student</span>
            <span class="pf-c-table__sort-indicator">
              <i class="fas fa-arrows-alt-v"></i>
            </span>
          </div>
        </button>
      </th>
      <th class="pf-c-table__sort " role="columnheader" aria-sort="none" scope="col">
        <button class="pf-c-table__button">
          <div class="pf-c-table__button-content">
            <span class="pf-c-table__text">Time</span>
            <span class="pf-c-table__sort-indicator">
              <i class="fas fa-arrows-alt-v"></i>
            </span>
          </div>
        </button>
      </th>
      <th role="columnheader" scope="col">Actions</th>
    </tr>
  </thead>
  <tbody role="rowgroup">
    @if(count($attendees))
      @foreach($attendees as $attendee)
      <tr role="row">
        <td role="cell" data-label="Seat Number {{ $attendee->seat_number }}">{{ $attendee->seat_number }}</td>
        <td role="cell" data-label="Seat Status: {{ $attendee->current_seat_state }}">{{ $attendee->current_seat_state }}</td>
        @if ($attendee->student()->first())
          <td role="cell" data-label="Student: { $attendee->student()->first()->name }}">{{ $attendee->student()->first()->name }}</td>
        @else
          <td role="cell" data-label="Student: N/A">N/A</td>
        @endif
        <td role="cell" data-label="Time: {{ $attendee->updated_at }}">{{ $attendee->updated_at }}</td>
        <td role="cell" data-label="Actions">
        @if($attendee->seat_state == 1)
          <a href="#" class="pf-c-button pf-m-primary pf-u-mr-md" onclick="event.preventDefault();document.getElementById('release-student-{{ $event->id }}-form').submit();">Release</a>
          <form id="release-student-{{ $event->id }}-form" action="{{ route('panel.post.attendee.releaseStudent', $attendee->id) }}" method="POST" style="display: none;">
              @csrf
          </form>
        @endif
        @if($attendee->seat_state == 2)
          <a href="#" class="pf-c-button pf-m-secondary pf-u-mr-md" onclick="event.preventDefault();document.getElementById('reset-seat-{{ $event->id }}-form').submit();">Reset</a>
          <form id="reset-seat-{{ $event->id }}-form" action="{{ route('panel.post.attendee.resetSeat', $attendee->id) }}" method="POST" style="display: none;">
              @csrf
          </form>
        @endif
        </td>
      </tr>
      @endforeach
    @else
      <tr role="row">
        <td role="cell" class="pf-u-text-align-center" data-label="No records" colspan="5">No records found!</td>
      </tr>
    @endif
  </tbody>
</table>

@endsection


@section('footerScripts')

<script type="text/javascript" src="/assets/js/vendor-jquery.dataTables.min.js"></script>
<script type="text/javascript">
  jQuery(document).ready( function () {
      jQuery('#attendees-table').DataTable({
          searching: false,
          ordering:  true
      });
  });
</script>

@endsection