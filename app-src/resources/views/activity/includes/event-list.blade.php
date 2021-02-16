
<table class="pf-c-table pf-m-grid-lg pf-u-mb-xl" role="grid" aria-label="Listing of events" id="events-table">
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
    @if(count($data['events']))
      @foreach($data['events'] as $event)
      <tr role="row">
        <td role="cell" title="{{ $event->status_description }}" data-label="Event Name" data-order="{{ $event->event_title }}" data-search="{{ $event->event_title }}"><span class="eventStatus {{ $event->status_class }}"></span>{{ $event->event_title }}</td>
        <td role="cell" data-label="Event ID">{{ $event->event_id }}</td>
        <td role="cell" data-label="Created by">{{ $event->user()->first()->name }}</td>
        <td role="cell" data-label="Event Start" data-order="{{ $event->start_time->timestamp }}">{{ $event->start_time->format('M j, Y @ H:i') }}</td>
        <td role="cell" data-label="Event Workshop">{{ $event->workshop()->first()->name }}</td>
        <td role="cell" data-label="Actions">
          <a href="{{ route('panel.get.activity.index', ['reportType' => 'event', 'reportTarget' => $event->id]) }}" class="pf-c-button pf-m-secondary pf-u-mr-md">View</a>
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
