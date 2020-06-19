@extends('layouts.pf4-utility')

@section('pageTitle', 'Verify your email address')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              <div class="card-header pf-u-mb-xl">
                <h2>{{ __('Verify Your Email Address') }}</h2>
              </div>

                <div class="card-body">
                    @if (session('resent'))
                    <div class="pf-c-alert pf-m-success" aria-label="Success alert">
                      <div class="pf-c-alert__icon">
                        <i class="fas fa-fw fa-check-circle" aria-hidden="true"></i>
                      </div>
                      <h4 class="pf-c-alert__title pf-u-mt-0">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                      </h4>
                    </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="pf-u-display-inline pf-c-form" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="pf-c-button pf-m-link pf-u-pl-0  pf-u-pr-0">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
