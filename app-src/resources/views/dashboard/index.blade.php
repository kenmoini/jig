@extends('layouts.pf4-primary')

@section('pageTitle', 'Dashboard')

@section('headerScripts')
  <style rel="stylesheet">
    #highlights h1 {
      font-size:1.25rem;
      font-weight:bold;
    }
  </style>
@endsection

@section('content')


<div class="pf-l-gallery pf-m-gutter" id="highlights">
  <div class="pf-l-gallery__item">
    <div class="pf-c-card">
      <div class="pf-c-card__body">
        <h1 class="pf-u-mr-xl pf-u-float-left">{{ \App\Workshop::all()->count() }} Workshops</h1>
      </div>
    </div>
  </div>
  <div class="pf-l-gallery__item">
    <div class="pf-c-card">
      <div class="pf-c-card__body"><h1 class="pf-u-mr-xl pf-u-float-left">{{ $previousEvents }} Previous Events</h1></div>
    </div>
  </div>
  <div class="pf-l-gallery__item">
    <div class="pf-c-card">
      <div class="pf-c-card__body"><h1 class="pf-u-mr-xl pf-u-float-left">{{ $upcommingEvents }} Upcoming Events</h1></div>
    </div>
  </div>
  <div class="pf-l-gallery__item">
    <div class="pf-c-card">
      <div class="pf-c-card__body"><h1 class="pf-u-mr-xl pf-u-float-left">{{ \App\Student::all()->count() }} Unique Students</h1></div>
    </div>
  </div>
</div>
Todo:
<ul>
  <li>Event calendar</li>
  <li>Current Active Workshops</li>
  <li>Current Active Students</li>
</ul>

@endsection
