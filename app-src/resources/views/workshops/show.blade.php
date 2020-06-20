@extends('layouts.pf4-primary')

@section('pageTitle', 'View Workshop - ' . $workshop['name'])

@section('content')

<div class="pf-c-form pf-m-horizontal">
  <div class="pf-c-form__group">
    <div class="pf-c-form__group-label">
      <label class="pf-c-form__label" for="workshop_name">
        <span class="pf-c-form__label-text">Name</span>
      </label>
    </div>
    <div class="pf-c-form__group-control">
      {{ $workshop->name }}
    </div>
  </div>
  <div class="pf-c-form__group">
    <div class="pf-c-form__group-label">
      <label class="pf-c-form__label" for="workshop_description">
        <span class="pf-c-form__label-text">Description</span>
      </label>
    </div>
    <div class="pf-c-form__group-control">
      {{ $workshop->description }}
    </div>
  </div>
  <div class="pf-c-form__group">
    <div class="pf-c-form__group-label">
      <label class="pf-c-form__label" for="workshop_typical_length_in_hours">
        <span class="pf-c-form__label-text">Typical Hours</span>
      </label>
    </div>
    <div class="pf-c-form__group-control">
      {{ $workshop->typical_length_in_hours }}
    </div>
  </div>
  <div class="pf-c-form__group">
    <div class="pf-c-form__group-label">
      <label class="pf-c-form__label" for="workshop_curriculum_endpoint">
        <span class="pf-c-form__label-text">Curriculum Endpoint</span>
      </label>
    </div>
    <div class="pf-c-form__group-control">
      {{ $workshop->curriculum_endpoint }}
    </div>
  </div>
  <div class="pf-c-form__group">
    <div class="pf-c-form__group-label">
      <label class="pf-c-form__label" for="workshop_curriculum_slug">
        <span class="pf-c-form__label-text">Curriculum Slug</span>
      </label>
    </div>
    <div class="pf-c-form__group-control">
      {{ $workshop->curriculum_slug }}
    </div>
  </div>
</div>

@endsection


@section('footerScripts')

@endsection