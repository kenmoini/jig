@extends('layouts.pf4-primary')

@section('pageTitle', 'Edit Workshop - ' . $workshop['name'])

@section('content')

<form novalidate class="pf-c-form pf-m-horizontal" id="editWorkshopForm" action="{{ route('panel.post.workshops.update', $workshop->id) }}" method="POST">
  @csrf
  <div class="pf-c-form__group">
    <div class="pf-c-form__group-label">
      <label class="pf-c-form__label" for="workshop_name">
        <span class="pf-c-form__label-text">Name</span>
        <span class="pf-c-form__label-required" aria-hidden="true">&#42;</span>
      </label>
    </div>
    <div class="pf-c-form__group-control">
      <input class="pf-c-form-control" type="text" id="workshop_name" name="workshop_name" value="{{ $workshop->name }}" required />
    </div>
  </div>
  <div class="pf-c-form__group">
    <div class="pf-c-form__group-label">
      <label class="pf-c-form__label" for="workshop_description">
        <span class="pf-c-form__label-text">Description</span>
      </label>
    </div>
    <div class="pf-c-form__group-control">
      <textarea class="pf-c-form-control" type="text" id="workshop_description" name="workshop_description" value="{{ $workshop->description }}" aria-label="A description of the workshop, used internally"></textarea>
    </div>
  </div>
  <div class="pf-c-form__group">
    <div class="pf-c-form__group-label">
      <label class="pf-c-form__label" for="workshop_typical_length_in_hours">
        <span class="pf-c-form__label-text">Typical Hours</span>
        <span class="pf-c-form__label-required" aria-hidden="true">&#42;</span>
      </label>
    </div>
    <div class="pf-c-form__group-control">
      <input class="pf-c-form-control" type="number" value="8" id="workshop_typical_length_in_hours" name="workshop_typical_length_in_hours" value="{{ $workshop->typical_length_in_hours }}"  min="0.5" max="72" step="0.5" required />
    </div>
  </div>
  <div class="pf-c-form__group">
    <div class="pf-c-form__group-label">
      <label class="pf-c-form__label" for="workshop_curriculum_endpoint">
        <span class="pf-c-form__label-text">Curriculum Endpoint</span>
        <span class="pf-c-form__label-required" aria-hidden="true">&#42;</span>
      </label>
    </div>
    <div class="pf-c-form__group-control">
      <select class="pf-c-form-control" id="workshop_curriculum_endpoint" name="workshop_curriculum_endpoint" required>
        <option value="">Select an endpoint...</option>
        <option value="https://redhatgov.io/workshops/" @if($workshop->curriculum_endpoint == "https://redhatgov.io/workshops/") selected @endif>https://redhatgov.io/workshops/</option>
        <option value="https://workshops.polyglot.academy/" @if($workshop->curriculum_endpoint == "https://workshops.polyglot.academy/") selected @endif>https://workshops.polyglot.academy/</option>
      </select>
    </div>
  </div>
  <div class="pf-c-form__group">
    <div class="pf-c-form__group-label">
      <label class="pf-c-form__label" for="workshop_curriculum_slug">
        <span class="pf-c-form__label-text">Curriculum Slug</span>
        <span class="pf-c-form__label-required" aria-hidden="true">&#42;</span>
      </label>
    </div>
    <div class="pf-c-form__group-control">
      <input class="pf-c-form-control" type="text" id="workshop_curriculum_slug" name="workshop_curriculum_slug" value="{{ $workshop->curriculum_slug }}" required />
    </div>
  </div>
  <div class="pf-c-form__group pf-m-action">
    <div class="pf-c-form__actions">
    </div>
    <div class="pf-c-form__group-control">
      <button class="pf-c-button pf-m-primary" type="submit">Update</button>
      <a class="pf-c-button pf-m-secondary" href="{{ route('panel.get.workshops.index') }}">Cancel</a>
    </div>
  </div>
</form>

@endsection


@section('footerScripts')

@endsection