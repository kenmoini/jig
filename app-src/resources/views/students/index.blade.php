@extends('layouts.pf4-primary')

@section('pageTitle', 'Students')

@section('content')

<table class="pf-c-table pf-m-grid-lg pf-u-mt-xl pf-u-mb-xl" role="grid" aria-label="Listing of Workshops" id="students-table">
  <thead>
    <tr role="row">
      <th class="pf-c-table__sort pf-m-selected" role="columnheader" aria-sort="ascending" scope="col">
        <button class="pf-c-table__button">
          <div class="pf-c-table__button-content">
            <span class="pf-c-table__text">Email</span>
            <span class="pf-c-table__sort-indicator">
              <i class="fas fa-long-arrow-alt-up"></i>
            </span>
          </div>
        </button>
      </th>
      <th class="pf-c-table__sort " role="columnheader" aria-sort="none" scope="col">
        <button class="pf-c-table__button">
          <div class="pf-c-table__button-content">
            <span class="pf-c-table__text">Last Name (Of #)</span>
            <span class="pf-c-table__sort-indicator">
              <i class="fas fa-arrows-alt-v"></i>
            </span>
          </div>
        </button>
      </th>
      <th class="pf-c-table__sort " role="columnheader" aria-sort="none" scope="col">
        <button class="pf-c-table__button">
          <div class="pf-c-table__button-content">
            <span class="pf-c-table__text">Last Active</span>
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
    @if(count($students))
      @foreach($students as $student)
      <tr role="row">
        <td role="cell" data-label="Workshop name">{{ $student->email }}</td>
        <td role="cell" data-label="Created by">{{ $student->student_names()->first()->name }} ({{$student->student_names()->count()}})</td>
        <td role="cell" data-label="Duration">{{ $student->student_names()->first()->updated_at }}</td>
        <td role="cell" data-label="Actions">
          <!--
            <a href="{{ route('panel.get.students.edit', $student->id) }}" class="pf-c-button pf-m-primary pf-u-mr-md">Edit</a><a href="{{ route('panel.get.students.show', $student->id) }}" class="pf-c-button pf-m-secondary pf-u-mr-md">View</a>
            <a href="#" class="pf-c-button pf-m-danger" onclick="event.preventDefault();document.getElementById('delete-student-{{ $student->id }}-form').submit();">Delete</a>
            <form id="delete-workshop-{{ $student->id }}-form" action="{{ route('panel.post.students.destroy', $student->id) }}" method="POST" style="display: none;">
              @csrf
            </form>
          -->
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
      jQuery('#students-table').DataTable({
          searching: false,
          ordering:  true
      });
  });
</script>
@endsection