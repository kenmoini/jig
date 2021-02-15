@extends('layouts.pf4-primary')

@section('pageTitle', 'Administration - Roles')

@section('content')
<table class="pf-c-table pf-m-grid-lg" role="grid" aria-label="Listing of Roles" id="role-table">
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
            <span class="pf-c-table__text"># Groups</span>
            <span class="pf-c-table__sort-indicator">
              <i class="fas fa-arrows-alt-v"></i>
            </span>
          </div>
        </button>
      </th>
      <th class="pf-c-table__sort " role="columnheader" aria-sort="none" scope="col">
        <button class="pf-c-table__button">
          <div class="pf-c-table__button-content">
            <span class="pf-c-table__text"># Capabilities</span>
            <span class="pf-c-table__sort-indicator">
              <i class="fas fa-arrows-alt-v"></i>
            </span>
          </div>
        </button>
      </th>
      <th role="columnheader" scope="col">Actions</th>
    </tr>
  </thead>
  <tbody role="rowrole">
    @if(count($roles))
      @foreach($roles as $role)
      <tr role="row">
        <td role="cell" data-label="Role name">{{ $role->name }}</td>
        <td role="cell" data-label="Number of groups in role">{{ $role->groups()->count() }}</td>
        <td role="cell" data-label="Number of capabilites in role">{{ $role->capabilities()->count() }}</td>
        <td role="cell" data-label="Actions"><a href="{{ route('panel.get.roles.edit', $role->id) }}" class="pf-c-button">Edit</a><a href="{{ route('panel.get.roles.show', $role->id) }}" class="pf-c-button">View</a></td>
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
      jQuery('#role-table').DataTable({
          searching: false,
          ordering:  true
      });
  });
</script>
@endsection