@extends('layouts.pf4-primary')

@if(!Auth::user()->hasPermission('admin.users.view'))

@section('pageTitle', 'Permission Denied')

@section('content')
<p class="pf-u-text-center">Permission Denied</p>
@endsection
@else

@section('pageTitle', 'Administration - Users')

@section('content')
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
    @if(count($users))
      @foreach($users as $user)
      <tr role="row">
        <td role="cell" data-label="Workshop name">{{ $user->name }}</td>
        <td role="cell" data-label="Email">{{ $user->email }}</td>
        <td role="cell" data-label="Last Logged In" title="{{ $user->last_login->created_at->format('m/d/Y @ g:iA') }}">{{ $user->last_login->created_at->format('m/d/Y') }}</td>
        <td role="cell" data-label="Created" title="{{ $user->created_at->format('m/d/Y @ g:iA') }}">{{ $user->created_at->format('m/d/Y') }}</td>
        <td role="cell" data-label="Actions"><a href="{{ route('panel.get.users.edit', $user->id) }}" class="pf-c-button">Edit</a><a href="{{ route('panel.get.users.show', $user->id) }}" class="pf-c-button">View</a></td>
      </tr>
      @endforeach
    @else
      <tr role="row">
        <td role="cell" class="pf-u-text-align-center" data-label="No records" colspan="4">No records found!</td>
      </tr>
    @endif
  </tbody>
</table>

@endsection


@section('footerScripts')

<script type="text/javascript" src="/assets/js/vendor-jquery.dataTables.min.js"></script>
<script type="text/javascript">
  jQuery(document).ready( function () {
      jQuery('#users-table').DataTable({
          searching: false,
          ordering:  true
      });
  });
</script>
@endsection

@endif