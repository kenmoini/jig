@extends('layouts.pf4-utility')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header pf-u-mb-xl">
                  <h2>{{ __('Login') }}</h2>
                </div>

                <div class="card-body">
                    <form method="POST" class="pf-c-form" action="{{ route('login') }}">
                        @csrf

                        <div class="pf-c-form__group">
                          <div class="pf-c-form__group-label">
                            <label class="pf-c-form__label" for="email">
                              <span class="pf-c-form__label-text">{{ __('E-Mail Address') }}</span>
                            </label>
                          </div>
                          <div class="pf-c-form__group-control">
                            <input class="pf-c-form-control @error('email') is-invalid @enderror" type="text" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus />
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                        </div>


                        <div class="pf-c-form__group">
                          <div class="pf-c-form__group-label">
                            <label for="password" class="pf-c-form__label">
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

                        <div class="pf-c-form__group">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="pf-c-form__group pf-m-action">
                          <div class="pf-c-form__actions">
                            <button class="pf-c-button pf-m-primary" type="submit">{{ __('Login') }}</button>
                            

                            @if (Route::has('password.request'))
                                <a class="pf-c-button pf-m-link" href="{{ route('password.request') }}">
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
