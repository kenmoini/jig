
<table class="pf-c-table pf-m-grid-lg pf-u-mb-xl" role="grid" aria-label="Listing of Workshops" id="workshops-table">
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
            <span class="pf-c-table__text">Duration (Hours)</span>
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
    @if(count($data['workshops']))
      @foreach($data['workshops'] as $workshop)
      <tr role="row">
        <td role="cell" data-label="Workshop name">{{ $workshop->name }}</td>
        <td role="cell" data-label="Created by">{{ $workshop->user()->first()->name }}</td>
        <td role="cell" data-label="Duration">{{ $workshop->typical_length_in_hours }}</td>
        <td role="cell" data-label="Actions">
          <a href="{{ route('panel.get.activity.index', ['reportType' => 'workshop', 'reportTarget' => $workshop->id]) }}" class="pf-c-button pf-m-secondary pf-u-mr-md">View</a>
        </td>
      </tr>
      @endforeach
    @else
      <tr role="row">
        <td role="cell" class="pf-u-text-align-center" data-label="No records" colspan="4">No records found!</td>
      </tr>
    @endif
  </tbody>
</table>