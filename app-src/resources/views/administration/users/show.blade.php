@extends('layouts.pf4-primary')

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
  
</div>

@endsection


@section('footerScripts')

@endsection