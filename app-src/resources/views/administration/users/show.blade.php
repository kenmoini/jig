@extends('layouts.pf4-primary')

@if(!Auth::user()->hasPermission('admin.users.view'))

@section('pageTitle', 'Permission Denied')

@section('content')
<p class="pf-u-text-center">Permission Denied</p>
@endsection
@else

@section('pageTitle', 'Viewing User - ' . $user->name)

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
      <input disabled="disabled" class="pf-c-form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" value="{{ $user->name }}" />
    </div>
  </div>
  <div class="pf-c-form__group">
    <div class="pf-c-form__group-label">
      <label class="pf-c-form__label" for="email">
        <span class="pf-c-form__label-text">Email</span>
      </label>
    </div>
    <div class="pf-c-form__group-control">
      <input class="pf-c-form-control" disabled="disabled" type="email" id="email" name="email" value="{{ $user->email }}" aria-label="User email" />
    </div>
  </div>
  <div class="pf-c-form__group">
    <div class="pf-c-form__group-label">
      <label class="pf-c-form__label" for="group">
        <span class="pf-c-form__label-text">Group</span>
      </label>
    </div>
    <div class="pf-c-form__group-control">
      <input class="pf-c-form-control" disabled="disabled" type="text" id="group" name="group" value="{{ $user->groups()->first()->name }}" aria-label="User group" />
    </div>
  </div>
  <div class="pf-c-form__group">
    <div class="pf-c-form__group-label">
      <label class="pf-c-form__label" for="auth-provider">
        <span class="pf-c-form__label-text">Auth Provider</span>
      </label>
    </div>
    <div class="pf-c-form__group-control">
      <input class="pf-c-form-control" style="text-transform:capitalize;" disabled="disabled" type="text" id="auth-provider" name="auth-provider" value="{{ $user->provider }}" aria-label="User Identity Provider" />
    </div>
  </div>
  <div class="pf-c-form__group">
    <div class="pf-c-form__group-label">
      <label class="pf-c-form__label" for="users">
        <span class="pf-c-form__label-text">Effective Capabilities</span>
      </label>
    </div>
    <div class="pf-c-form__group-control">
    @foreach($user->capabilitiesList() as $cap)
    {{ $cap }}<br />
    @endforeach
    </div>
  </div>
  
</div>

@endsection


@section('footerScripts')

@endsection

@endif