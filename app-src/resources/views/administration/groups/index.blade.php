@extends('layouts.pf4-primary')

@section('pageTitle', 'Administration - Groups')

@section('content')
<table class="pf-c-table pf-m-grid-lg" role="grid" aria-label="Listing of Groups" id="group-table">
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
            <span class="pf-c-table__text"># Roles</span>
            <span class="pf-c-table__sort-indicator">
              <i class="fas fa-arrows-alt-v"></i>
            </span>
          </div>
        </button>
      </th>
      <th class="pf-c-table__sort " role="columnheader" aria-sort="none" scope="col">
        <button class="pf-c-table__button">
          <div class="pf-c-table__button-content">
            <span class="pf-c-table__text"># Users</span>
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
    @if(count($groups))
      @foreach($groups as $group)
      <tr role="row">
        <td role="cell" data-label="Group name">{{ $group->name }}</td>
        <td role="cell" data-label="Number of roles in group">{{ $group->roles()->count() }}</td>
        <td role="cell" data-label="Number of users in group">{{ $group->users()->count() }}</td>
        <td role="cell" data-label="Actions"><a href="{{ route('panel.get.groups.edit', $group->id) }}" class="pf-c-button">Edit</a><a href="{{ route('panel.get.groups.show', $group->id) }}" class="pf-c-button">View</a></td>
      </tr>
      @endforeach
    @else
      <tr role="row">
        <td role="cell" class="pf-u-text-align-center" data-label="No records" colspan="3">No records found!</td>
      </tr>
    @endif
  </tbody>
</table>

@endsection


@section('footerScripts')

<script type="text/javascript" src="/assets/js/vendor-jquery.dataTables.min.js"></script>
<script type="text/javascript">
  jQuery(document).ready( function () {
      jQuery('#group-table').DataTable({
          searching: false,
          ordering:  true
      });
  });
</script>
@endsection