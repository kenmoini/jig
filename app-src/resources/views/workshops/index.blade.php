@extends('layouts.pf4-primary')

@section('pageTitle', 'Workshops')

@section('content')

<div class="pf-c-toolbar pf-u-mb-xl" id="workshopActionToolbar">
  <div class="pf-c-toolbar__content">
    <div class="pf-c-toolbar__content-section pf-u-flex-direction-row-reverse">
      <div class="pf-c-toolbar__group pf-m-button-group">
        <div class="pf-c-toolbar__item">
          <a href="{{ route('panel.get.workshops.create') }}" class="pf-c-button pf-m-primary" type="button">Create Workshop</a>
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

<table class="pf-c-table pf-m-grid-lg pf-u-mt-xl pf-u-mb-xl" role="grid" aria-label="Listing of Workshops" id="workshops-table">
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
    @if(count($workshops))
      @foreach($workshops as $workshop)
      <tr role="row">
        <td role="cell" data-label="Workshop name">{{ $workshop->name }}</td>
        <td role="cell" data-label="Created by">{{ $workshop->user()->first()->name }}</td>
        <td role="cell" data-label="Duration">{{ $workshop->typical_length_in_hours }}</td>
        <td role="cell" data-label="Actions">
          <a href="{{ route('panel.get.workshops.edit', $workshop->id) }}" class="pf-c-button pf-m-primary pf-u-mr-md">Edit</a><a href="{{ route('panel.get.workshops.show', $workshop->id) }}" class="pf-c-button pf-m-secondary pf-u-mr-md">View</a>
          <a href="#" class="pf-c-button pf-m-danger" onclick="event.preventDefault();document.getElementById('delete-workshop-{{ $workshop->id }}-form').submit();">Delete</a>
          <form id="delete-workshop-{{ $workshop->id }}-form" action="{{ route('panel.post.workshops.destroy', $workshop->id) }}" method="POST" style="display: none;">
              @csrf
          </form>
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

@endsection


@section('footerScripts')

<script type="text/javascript" src="/assets/js/vendor-jquery.dataTables.min.js"></script>
<script type="text/javascript">
  jQuery(document).ready( function () {
      jQuery('#workshops-table').DataTable({
          searching: false,
          ordering:  true
      });
  });
</script>
@endsection