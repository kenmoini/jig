@extends('layouts.pf4-primary')

@if(!Auth::user()->hasPermission('admin.groups.view'))

@section('pageTitle', 'Permission Denied')

@section('content')
<p class="pf-u-text-center">Permission Denied</p>
@endsection
@else

@section('pageTitle', 'Viewing Group - ' . $group->name)

@section('content')

<div class="pf-c-form pf-m-horizontal">
  <div class="pf-c-form__group">
    <div class="pf-c-form__group-label">
      <label class="pf-c-form__label" for="name">
        <span class="pf-c-form__label-text">Name</span>
      </label>
    </div>
    <div class="pf-c-form__group-control">
      <input disabled="disabled" class="pf-c-form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" value="{{ $group->name }}" />
    </div>
  </div>
  <div class="pf-c-form__group">
    <div class="pf-c-form__group-label">
      <label class="pf-c-form__label" for="group">
        <span class="pf-c-form__label-text">Associated Roles</span>
      </label>
    </div>
    <div class="pf-c-form__group-control">
      @foreach($group->roles()->get() as $role)
      <input class="pf-c-form-control" disabled="disabled" type="text" id="role{{ $role->id }}" name="role{{ $role->id }}" value="{{ $role->name }}" aria-label="{{ $role->name }} Role" />
      @endforeach
    </div>
  </div>
  <div class="pf-c-form__group">
    <div class="pf-c-form__group-label">
      <label class="pf-c-form__label" for="users">
        <span class="pf-c-form__label-text">Users</span>
      </label>
    </div>
    <div class="pf-c-form__group-control">
      @foreach($group->users()->get() as $user)
      <input class="pf-c-form-control" disabled="disabled" type="text" id="user{{ $user->id }}" name="user{{ $user->id }}" value="{{ $user->name }} ({{ $user->email }})" aria-label="{{ $user->name }} ({{ $user->email }}) User" />
      @endforeach
    </div>
  </div>
  <div class="pf-c-form__group">
    <div class="pf-c-form__group-label">
      <label class="pf-c-form__label" for="users">
        <span class="pf-c-form__label-text">Effective Capabilities</span>
      </label>
    </div>
    <div class="pf-c-form__group-control">
    @foreach($group->capabilitiesList() as $cap)
    {{ $cap }}<br />
    @endforeach
    </div>
  </div>
  
</div>

@endsection


@section('footerScripts')

@endsection

@endif