@extends('layouts.pf4-utility')

@section('pageTitle', 'Confirm Password')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              <div class="card-header pf-u-mb-xl">
                <h2>{{ __('Confirm Password') }}</h2>
              </div>

                <div class="card-body">
                    {{ __('Please confirm your password before continuing.') }}

                    <form class="pf-c-form" method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="pf-c-form__group">
                          <div class="pf-c-form__group-label">
                            <label class="pf-c-form__label" for="password">
                              <span class="pf-c-form__label-text">{{ __('Password') }}</span>
                            </label>
                          </div>
                          <div class="pf-c-form__group-control">
                            <input id="password" type="password" class="pf-c-form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                              <button type="submit" class="pf-c-button pf-m-primary">
                                  {{ __('Confirm Password') }}
                              </button>

                              @if (Route::has('password.request'))
                                <a class="pf-c-button pf-mlink" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                              @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
