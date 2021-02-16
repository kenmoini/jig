@extends('layouts.pf4-primary')

@if(!Auth::user()->hasPermission('admin.roles.view'))

@section('pageTitle', 'Permission Denied')

@section('content')
<p class="pf-u-text-center">Permission Denied</p>
@endsection
@else

@section('pageTitle', 'Viewing Role - ' . $role->name)

@section('content')

<div class="pf-c-form pf-m-horizontal">
  <div class="pf-c-form__group">
    <div class="pf-c-form__group-label">
      <label class="pf-c-form__label" for="name">
        <span class="pf-c-form__label-text">Name</span>
        <span class="pf-c-form__label-required" aria-hidden="true">&#42;</span>
      </label>
    </div>
    <div class="pf-c-form__group-control">
      <input disabled="disabled" class="pf-c-form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" value="{{ $role->name }}" />
    </div>
  </div>
  <div class="pf-c-form__group">
    <div class="pf-c-form__group-label">
      <label class="pf-c-form__label" for="group">
        <span class="pf-c-form__label-text">Associated Groups</span>
      </label>
    </div>
    <div class="pf-c-form__group-control">
      @foreach($role->groups()->get() as $group)
      <input class="pf-c-form-control" disabled="disabled" type="text" id="group{{ $group->id }}" name="group{{ $group->id }}" value="{{ $group->name }}" aria-label="{{ $group->name }} Group" />
      @endforeach
    </div>
  </div>
  <div class="pf-c-form__group">
    <div class="pf-c-form__group-label">
      <label class="pf-c-form__label" for="capabilties">
        <span class="pf-c-form__label-text">Capabilties</span>
      </label>
    </div>
    <div class="pf-c-form__group-control">
      @foreach($role->capabilities()->get() as $capabilty)
      <input class="pf-c-form-control" disabled="disabled" type="text" id="capabilty{{ $capabilty->id }}" name="capabilty{{ $capabilty->id }}" value="{{ $capabilty->key }}" aria-label="{{ $capabilty->key }} Capability" />
      @endforeach
    </div>
  </div>
  
</div>

@endsection


@section('footerScripts')

@endsection

@endif