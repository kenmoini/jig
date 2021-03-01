@extends('layouts.pf4-primary')

@if(!Auth::user()->hasPermission('panel.events.view'))

@section('pageTitle', 'Permission Denied')

@section('content')
<p class="pf-u-text-center">Permission Denied</p>
@endsection
@else

@section('pageTitle', 'Events')

@section('content')

<div class="pf-c-toolbar pf-u-mb-xl" id="eventActionToolbar">
  <div class="pf-c-toolbar__content">
    <div class="pf-c-toolbar__content-section pf-u-flex-direction-row-reverse">
      <div class="pf-c-toolbar__group pf-m-button-group">
        <div class="pf-c-toolbar__item">
          <a href="{{ route('panel.get.events.create') }}" class="pf-c-button pf-m-primary" type="button">Create event</a>
        </div>
        <!--
        <div class="pf-c-toolbar__item">
          <div class="pf-c-select">
            <span id="toolbar-group-types-example-select-checkbox-filter1-label" hidden>Choose one</span>
            <button class="pf-c-select__toggle" type="button" id="toolbar-group-types-example-select-checkbox-filter1-toggle" aria-haspopup="true" aria-expanded="false" aria-labelledby="toolbar-group-types-example-select-checkbox-filter1-label toolbar-group-types-example-select-checkbox-filter1-toggle">
              <div class="pf-c-select__toggle-wrapper">
                <span class="pf-c-select__toggle-text">Actions</span>
              </div>
              <span class="pf-c-select__toggle-arrow">
                <i class="fas fa-caret-down" aria-hidden="true"></i>
              </span>
            </button>
            <ul class="pf-c-select__menu" aria-labelledby="toolbar-group-types-example-select-checkbox-filter1-label" hidden>
              <li>
                <button type="button" class="pf-c-select__menu-item" aria-pressed="false">Running</button>
              </li>
              <li>
                <button type="button" class="pf-c-select__menu-item" aria-pressed="false">Stopped</button>
              </li>
              <li>
                <button type="button" class="pf-c-select__menu-item" aria-pressed="false">Down</button>
              </li>
              <li>
                <button type="button" class="pf-c-select__menu-item" aria-pressed="false">Degraded</button>
              </li>
              <li>
                <button type="button" class="pf-c-select__menu-item" aria-pressed="false">Needs Maintenance</button>
              </li>
            </ul>
          </div>
        </div>
        -->
      </div>
    </div>
  </div>
</div>

<table class="pf-c-table pf-m-grid-lg pf-u-mt-xl pf-u-mb-xl" role="grid" aria-label="Listing of events" id="events-table">
  <thead>
    <tr role="row">
      <th class="pf-c-table__sort pf-m-selected" role="columnheader" aria-sort="ascending" scope="col">
        <button class="pf-c-table__button">
          <div class="pf-c-table__button-content">
            <span class="pf-c-table__text">Name</span>
            <span class="pf-c-table__sort-indicator">
              <i class="fas fa-long-arrow-alt-up"></i>
            </span>
          </div>
        </button>
      </th>
      <th class="pf-c-table__sort" role="columnheader" aria-sort="none" scope="col">
        <button class="pf-c-table__button">
          <div class="pf-c-table__button-content">
            <span class="pf-c-table__text">EID</span>
            <span class="pf-c-table__sort-indicator">
              <i class="fas fa-arrows-alt-v"></i>
            </span>
          </div>
        </button>
      </th>
      <th class="pf-c-table__sort " role="columnheader" aria-sort="none" scope="col">
        <button class="pf-c-table__button">
          <div class="pf-c-table__button-content">
            <span class="pf-c-table__text">Created by</span>
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
      <th class="pf-c-table__sort " role="columnheader" aria-sort="none" scope="col">
        <button class="pf-c-table__button">
          <div class="pf-c-table__button-content">
            <span class="pf-c-table__text">Workshop</span>
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
    @if(count($events))
      @foreach($events as $event)
      <tr role="row">
        <td role="cell" title="{{ $event->status_description }}" data-label="Event Name" data-order="{{ $event->event_title }}" data-search="{{ $event->event_title }}"><span class="eventStatus {{ $event->status_class }}"></span>{{ $event->event_title }}</td>
        <td role="cell" data-label="Event ID">{{ $event->event_id }}</td>
        <td role="cell" data-label="Created by">{{ $event->user()->first()->name }}</td>
        <td role="cell" data-label="Event Start" data-order="{{ $event->start_time->timestamp }}">{{ $event->start_time->format('M j, Y @ H:i') }}</td>
        <td role="cell" data-label="Event Workshop">{{ $event->workshop()->first()->name }}</td>
        <td role="cell" data-label="Actions">
          <a href="{{ route('panel.get.events.edit', $event->id) }}" class="pf-c-button pf-m-primary pf-u-mr-md">Edit</a><a href="{{ route('panel.get.events.show', $event->id) }}" class="pf-c-button pf-m-secondary pf-u-mr-md">View</a>
          <a href="#" class="pf-c-button pf-m-danger" onclick="event.preventDefault();document.getElementById('delete-event-{{ $event->id }}-form').submit();">Delete</a>
          <form id="delete-event-{{ $event->id }}-form" action="{{ route('panel.post.events.destroy', $event->id) }}" method="POST" style="display: none;">
              @csrf
          </form>
        </td>
      </tr>
      @endforeach
    @else
      <tr role="row">
        <td role="cell" class="pf-u-text-align-center" data-label="No records" colspan="6">No records found!</td>
      </tr>
    @endif
  </tbody>
</table>

@endsection


@section('footerScripts')

<script type="text/javascript" src="/assets/js/vendor-jquery.dataTables.min.js"></script>
<script type="text/javascript">
  jQuery(document).ready( function () {
      jQuery('#events-table').DataTable({
          searching: false,
          ordering:  true
      });
  });
</script>
@endsection

@endif