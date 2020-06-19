@extends('layouts.pf4-utility')

@section('pageTitle', 'Reset Password')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              <div class="card-header pf-u-mb-xl">
                <h2>{{ __('Reset Password') }}</h2>
              </div>

                <div class="card-body">
                    @if (session('status'))
                      <div class="pf-c-alert pf-m-success" aria-label="Success alert">
                        <div class="pf-c-alert__icon">
                          <i class="fas fa-fw fa-check-circle" aria-hidden="true"></i>
                        </div>
                        <h4 class="pf-c-alert__title pf-u-mt-0">{{ session('status') }}</h4>
                      </div>
                    @endif

                    <form class="pf-c-form" method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="pf-c-form__group">
                          <div class="pf-c-form__group-label">
                            <label class="pf-c-form__label" for="email">
                              <span class="pf-c-form__label-text">{{ __('E-Mail Address') }}</span>
                            </label>
                          </div>
                          <div class="pf-c-form__group-control">
                            <input id="email" type="email" class="pf-c-form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="pf-c-button pf-m-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
