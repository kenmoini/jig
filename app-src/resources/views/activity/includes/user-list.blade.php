<table class="pf-c-table pf-m-grid-lg" role="grid" aria-label="Listing of Users" id="user-table">
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
            <span class="pf-c-table__text">Email</span>
            <span class="pf-c-table__sort-indicator">
              <i class="fas fa-arrows-alt-v"></i>
            </span>
          </div>
        </button>
      </th>
      <th class="pf-c-table__sort " role="columnheader" aria-sort="none" scope="col">
        <button class="pf-c-table__button">
          <div class="pf-c-table__button-content">
            <span class="pf-c-table__text">Last Logged In</span>
            <span class="pf-c-table__sort-indicator">
              <i class="fas fa-arrows-alt-v"></i>
            </span>
          </div>
        </button>
      </th>
      <th class="pf-c-table__sort " role="columnheader" aria-sort="none" scope="col">
        <button class="pf-c-table__button">
          <div class="pf-c-table__button-content">
            <span class="pf-c-table__text">Created</span>
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
    @if(count($data['users']))
      @foreach($data['users'] as $user)
      <tr role="row">
        <td role="cell" data-label="Workshop name">{{ $user->name }}</td>
        <td role="cell" data-label="Email">{{ $user->email }}</td>
        <td role="cell" data-label="Last Logged In" title="{{ $user->last_login->created_at->format('m/d/Y @ g:iA') }}">{{ $user->last_login->created_at->format('m/d/Y') }}</td>
        <td role="cell" data-label="Created" title="{{ $user->created_at->format('m/d/Y @ g:iA') }}">{{ $user->created_at->format('m/d/Y') }}</td>
        <td role="cell" data-label="Actions"><a href="{{ route('panel.get.activity.index', ['reportType' => 'user', 'reportTarget' => $user->id]) }}" class="pf-c-button pf-m-secondary pf-u-mr-md">View</a></td>
      </tr>
      @endforeach
    @else
      <tr role="row">
        <td role="cell" class="pf-u-text-align-center" data-label="No records" colspan="4">No records found!</td>
      </tr>
    @endif
  </tbody>
</table>