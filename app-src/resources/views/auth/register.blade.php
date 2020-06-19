@extends('layouts.pf4-utility')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header pf-u-mb-xl">
                  <h2>{{ __('Register') }}</h2>
                </div>

                <div class="card-body">
                    <form method="POST" class="pf-c-form" action="{{ route('register') }}">
                        @csrf

                        <div class="pf-c-form__group">
                          <div class="pf-c-form__group-label">
                            <label class="pf-c-form__label" for="name">
                              <span class="pf-c-form__label-text">{{ __('Name') }}</span>
                            </label>
                          </div>
                          <div class="pf-c-form__group-control">
                            <input id="name" type="text" class="pf-c-form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

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
                              <span class="pf-c-form__label-text">{{ __('E-Mail Address') }}</span>
                            </label>
                          </div>
                          <div class="pf-c-form__group-control">
                            <input id="email" type="email" class="pf-c-form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>

                        <div class="pf-c-form__group">
                          <div class="pf-c-form__group-label">
                            <label class="pf-c-form__label" for="password">
                              <span class="pf-c-form__label-text">{{ __('Password') }}</span>
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
                            <label class="pf-c-form__label" for="password-confirm">
                              <span class="pf-c-form__label-text">{{ __('Confirm Password') }}</span>
                            </label>
                          </div>
                          <div class="pf-c-form__group-control">
                              <input id="password-confirm" type="password" class="pf-c-form-control" name="password_confirmation" required autocomplete="new-password">
                          </div>
                        </div>

                        <div class="pf-c-form__group pf-m-action">
                          <div class="pf-c-form__actions">
                            <button class="pf-c-button pf-m-primary" type="submit">
                                {{ __('Register') }}
                            </button>
                            <a class="pf-c-button pf-m-link" href="{{ route('login') }}">
                                {{ __('Or, Login') }}
                            </a>
                          </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
