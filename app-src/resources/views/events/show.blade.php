@extends('layouts.pf4-primary')

@section('pageTitle', 'Viewing Event - ' . $event->name)

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

- Add Current Attendee Listing and Controls

@endsection


@section('footerScripts')

@endsection