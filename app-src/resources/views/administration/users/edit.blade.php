@extends('layouts.pf4-primary')

@section('pageTitle', 'Edit User - ' . $user->name)

@section('content')

<form novalidate class="pf-c-form pf-m-horizontal" id="editWorkshopForm" action="{{ route('panel.post.users.update', $user->id) }}" method="POST">
  @csrf
  <div class="pf-c-form__group">
    <div class="pf-c-form__group-label">
      <label class="pf-c-form__label" for="name">
        <span class="pf-c-form__label-text">Name</span>
        <span class="pf-c-form__label-required" aria-hidden="true">&#42;</span>
      </label>
    </div>
    <div class="pf-c-form__group-control">
      <input class="pf-c-form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" value="{{ $user->name }}" required />
      
      @error('name')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
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
      
      @error('email')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
  </div>
  <div class="pf-c-form__group">
    <div class="pf-c-form__group-label"></div>
    <div class="pf-c-form__group-control">
      <hr/>
      <p class="pf-u-mt-lg"><em>Note: The default Administrator user (and any other user) cannot have a default password set!</em></p>
    </div>
  </div>
  <div class="pf-c-form__group">
    <div class="pf-c-form__group-label">
      <label class="pf-c-form__label" for="password">
        <span class="pf-c-form__label-text">New Password</span>
      </label>
    </div>
    <div class="pf-c-form__group-control">
      <input id="password" type="password" class="pf-c-form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
      
      @error('password')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
  </div>
  <div class="pf-c-form__group">
    <div class="pf-c-form__group-label">
      <label class="pf-c-form__label" for="password">
        <span class="pf-c-form__label-text">Confirm Password</span>
      </label>
    </div>
    <div class="pf-c-form__group-control">
      <input id="password-confirm" type="password" class="pf-c-form-control" name="password_confirmation" required autocomplete="new-password">
    </div>
  </div>

  <div class="pf-c-form__group">
    <div class="pf-c-form__group-label"></div>
    <div class="pf-c-form__group-control">
      <hr/>
    </div>
  </div>
  <div class="pf-c-form__group">
    <div class="pf-c-form__group-label">
      <label class="pf-c-form__label" for="user_group">
        <span class="pf-c-form__label-text">User Group</span>
      </label>
    </div>
    <div class="pf-c-form__group-control">
      <select id="user_group" name="user_group" class="pf-c-form-control">
        @foreach($groups as $group)
        <option @if($group->id === $user->groups()->first()->id){{ 'selected="selected"' }}@endif value="{{ $group->id }}">{{ $group->name }}</option>
        @endforeach
      </select>
    </div>
  </div>
  
  <div class="pf-c-form__group pf-m-action">
    <div class="pf-c-form__actions">
    </div>
    <div class="pf-c-form__group-control">
      <button class="pf-c-button pf-m-primary" type="submit">Update</button>
      <a class="pf-c-button pf-m-secondary" href="{{ route('panel.get.users.index') }}">Cancel</a>
    </div>
  </div>
</form>

@endsection


@section('footerScripts')

@endsection