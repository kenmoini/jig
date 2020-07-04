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
  <li class="pf-c-data-list__item" aria-labelledby="event-event_id">
    <div class="pf-c-data-list__item-row">
      <div class="pf-c-data-list__item-content">
        <div class="pf-c-data-list__cell">
          <span id="event-event_id">Created By</span>
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
  <li class="pf-c-data-list__item" aria-labelledby="event-event_id">
    <div class="pf-c-data-list__item-row">
      <div class="pf-c-data-list__item-content">
        <div class="pf-c-data-list__cell">
          <span id="event-event_id">Number of Seats</span>
        </div>
        <div class="pf-c-data-list__cell">{{ $event->seat_count }}</div>
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
  <li class="pf-c-data-list__item" aria-labelledby="event-description">
    <div class="pf-c-data-list__item-row">
      <div class="pf-c-data-list__item-content">
        <div class="pf-c-data-list__cell">
          <span id="event-private_notes">Private Notes</span>
        </div>
        <div class="pf-c-data-list__cell">{{ $event->private_notes }}</div>
      </div>
    </div>
  </li>
  <li class="pf-c-data-list__item" aria-labelledby="event-event_id">
    <div class="pf-c-data-list__item-row">
      <div class="pf-c-data-list__item-content">
        <div class="pf-c-data-list__cell">
          <span id="event-event_id">Effective Assets (make this nicer)</span>
        </div>
        <div class="pf-c-data-list__cell">{{ $event->effective_asset_data }}</div>
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
        @if ($attendee->student_name)
          <td role="cell" data-label="Student ">{{ $attendee->student()->first()->name }}</td>
        @else
          <td role="cell" data-label="Student: N/A">N/A</td>
        @endif
        <td role="cell" data-label="Time: {{ $attendee->updated_at }}">{{ $attendee->updated_at }}</td>
        <td role="cell" data-label="Actions">
          <a href="#" class="pf-c-button pf-m-primary pf-u-mr-md">Release</a><a href="#" class="pf-c-button pf-m-secondary pf-u-mr-md">Reset</a>
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