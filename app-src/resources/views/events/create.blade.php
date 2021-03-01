@extends('layouts.pf4-primary')

@if(!Auth::user()->hasPermission('panel.events.edit'))

@section('pageTitle', 'Permission Denied')

@section('content')
<p class="pf-u-text-center">Permission Denied</p>
@endsection
@else

@section('pageTitle', 'Create an Event')

@section('headerScripts')
<style type="text/css" rel="stylesheet">
  .pf-c-form-control[readonly] {
    background-color:inherit;
  }
  h1 {
    font-weight:bold;
    font-size:1rem;
    margin-bottom:1rem;
  }
  #assetFactoryHolder .asset_group {
    margin-bottom:1rem;
    border-bottom:1px solid grey;
    padding-bottom: 1rem;
  }
  .pf-c-button.pf-m-small {
    --pf-c-button--FontSize: var(--pf-c-button--m-small--FontSize);
    padding: 5px 10px;
    font-size: 0.8rem;
  }
</style>
@endsection

@section('content')
<form novalidate class="pf-c-form pf-m-horizontal" id="createEventForm" action="{{ route('panel.post.events.store') }}" method="POST">
  @csrf
  <div class="pf-c-form__group">
    <div class="pf-c-form__group-label">
      <label class="pf-c-form__label" for="event_workshop_id">
        <span class="pf-c-form__label-text">Event Workshop</span>
        <span class="pf-c-form__label-required" aria-hidden="true">&#42;</span>
      </label>
    </div>
    <div class="pf-c-form__group-control">
      <select class="pf-c-form-control" id="event_workshop_id" name="event_workshop_id" required>
        <option value="">Select a workshop...</option>
        @foreach($workshops as $workshop)
          <option value="{{ $workshop->id }}">{{ $workshop->name }}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="pf-c-form__group">
    <div class="pf-c-form__group-label">
      <label class="pf-c-form__label" for="event_title">
        <span class="pf-c-form__label-text">Event Title</span>
        <span class="pf-c-form__label-required" aria-hidden="true">&#42;</span>
      </label>
    </div>
    <div class="pf-c-form__group-control">
      <input class="pf-c-form-control" type="text" id="event_title" name="event_title" required />
    </div>
  </div>
  <div class="" id="eventDetailsHolder">
    <div class="pf-c-form__group">
      <div class="pf-c-form__group-label">
        <label class="pf-c-form__label" for="event_description">
          <span class="pf-c-form__label-text">Description</span>
        </label>
      </div>
      <div class="pf-c-form__group-control">
        <textarea class="pf-c-form-control" type="text" id="event_description" name="event_description" aria-label="A description of the event, used publicly"></textarea>
      </div>
    </div>
    <div class="pf-c-form__group">
      <div class="pf-c-form__group-label">
        <label class="pf-c-form__label" for="event_private_notes">
          <span class="pf-c-form__label-text">Private Notes</span>
        </label>
      </div>
      <div class="pf-c-form__group-control">
        <textarea class="pf-c-form-control" type="text" id="event_private_notes" name="event_private_notes" aria-label="Private notes, used internally"></textarea>
      </div>
    </div>
      
    <div class="pf-c-form__group pf-u-mb-sm">
      <div class="pf-c-form__group-label">
        <label class="pf-c-form__label" for="event_location">
          <span class="pf-c-form__label-text">Location</span>
        </label>
      </div>
      <div class="pf-c-form__group-control">
        <input class="pf-c-form-control" type="text" id="event_location" name="event_location" />
      </div>
    </div>

    <div class="pf-c-form__group pf-u-mb-sm">
      <div class="pf-c-form__group-label">
        <label class="pf-c-form__label" for="event_start_date">
          <span class="pf-c-form__label-text">Start Date</span>
          <span class="pf-c-form__label-required" aria-hidden="true">&#42;</span>
        </label>
      </div>
      <div class="pf-c-form__group-control">
        <div class="pf-c-input-group">
          <span class="pf-c-input-group__text">
            <i class="pf-icon pf-icon-on-running" aria-hidden="true"></i>
          </span>
          <input class="pf-c-form-control" type="text" id="event_start_date" name="event_start_date" aria-label="Event start date" required />
        </div>
      </div>
    </div>
    <div class="pf-c-form__group pf-u-mb-sm">
      <div class="pf-c-form__group-label">
        <label class="pf-c-form__label" for="event_end_date">
          <span class="pf-c-form__label-text">End Date</span>
          <span class="pf-c-form__label-required" aria-hidden="true">&#42;</span>
        </label>
      </div>
      <div class="pf-c-form__group-control">
        <div class="pf-c-input-group">
          <span class="pf-c-input-group__text">
            <i class="pf-icon pf-icon-asleep" aria-hidden="true"></i>
          </span>
          <input class="pf-c-form-control" type="text" id="event_end_date" name="event_end_date" aria-label="Event end date" required />
        </div>
      </div>
    </div>
      
    <div class="pf-c-form__group pf-u-mb-sm">
      <div class="pf-c-form__group-label">
        <label class="pf-c-form__label" for="event_eid">
          <span class="pf-c-form__label-text">Event ID</span>
          <span class="pf-c-form__label-required" aria-hidden="true">&#42;</span>
        </label>
      </div>
      <div class="pf-c-form__group-control">
        <input class="pf-c-form-control" type="text" id="event_eid" name="event_eid" required />
      </div>
    </div>
    
    <div class="pf-c-form__group pf-u-mb-sm">
      <div class="pf-c-form__group-label">
        <label class="pf-c-form__label" for="privacy_level">
          <span class="pf-c-form__label-text">Privacy Level</span>
          <span class="pf-c-form__label-required" aria-hidden="true">&#42;</span>
        </label>
      </div>
      <div class="pf-c-form__group-control">
        <select class="pf-c-form-control" id="privacy_level" name="privacy_level" required>
          <option value="0">Publicly listed</option>
          <option value="1" disabled="disabled">Publicly listed, require passcode</option>
          <option value="2">Private & Unlisted, only via Event ID</option>
        </select>
      </div>
    </div>
    
    <div class="pf-c-form__group pf-u-mb-sm pf-u-hidden" id="passcodeHolder">
      <div class="pf-c-form__group-label">
        <label class="pf-c-form__label" for="passcode">
          <span class="pf-c-form__label-text">Passcode</span>
          <span class="pf-c-form__label-required" aria-hidden="true">&#42;</span>
        </label>
      </div>
      <div class="pf-c-form__group-control">
        <input class="pf-c-form-control" type="text" id="passcode" name="passcode" />
      </div>
    </div>
      
    <div class="pf-c-form__group pf-u-mb-sm">
      <div class="pf-c-form__group-label">
        <label class="pf-c-form__label" for="event_seat_count">
          <span class="pf-c-form__label-text">Seat Count</span>
          <span class="pf-c-form__label-required" aria-hidden="true">&#42;</span>
        </label>
      </div>
      <div class="pf-c-form__group-control">
        <input class="pf-c-form-control" type="number" value="50" step="1" id="event_seat_count" name="event_seat_count" required />
      </div>
    </div>
      
    <div class="collapse" id="assetFactoryHolder">
      <div class="pf-c-form__group pf-u-mb-sm">
        <div class="pf-c-form__group-label">
          <label class="pf-c-form__label">
            <span class="pf-c-form__label-text">Assets</span>
          </label>
        </div>
        <div class="pf-c-form__group-control">
          <div class="pf-c-card">
            <div class="pf-c-card__body">
            </div>
            <div class="pf-c-card__footer">
              <button id="addCustomAssetBtn" class="pf-c-button pf-m-secondary pf-u-float-right" role="button"data-toggle="modal" data-target="#addCustomAssetModal">Add Asset</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="pf-c-form__group pf-m-action">
      <div class="pf-c-form__actions">
      </div>
      <div class="pf-c-form__group-control">
        <button class="pf-c-button pf-m-primary" type="submit">Create</button>
        <button class="pf-c-button pf-m-secondary" type="reset">Reset form</button>
      </div>
    </div>
  </div>
</form>

@endsection

@section('footerScripts')

<div id="modalHolder">
  <div class="pf-c-backdrop">
    <div class="pf-l-bullseye">
      <div id="addCustomAssetModal" class="pf-c-modal-box pf-m-sm modal" role="dialog" aria-modal="true" aria-labelledby="Add Custom Asset" aria-describedby="Add additional assets for your event">
        <button class="pf-c-button pf-m-plain close" type="button" data-dismiss="modal" aria-label="Close dialog">
          <i class="fas fa-times" aria-hidden="true"></i>
        </button>
        <div class="pf-c-modal-box__header" id="modal-header">
          <h1 class="pf-c-modal-box__title" id="modal-title">Add Custom Asset</h1>
        </div>
        <form novalidate class="pf-c-form pf-m-horizontal" id="addCustomAssetForm" aria-labelledby="addCustomAssetForm" action="" method="POST">
          <div class="pf-c-modal-box__body" id="modal-description">
            
              @csrf
              <div class="pf-c-form__group">
                <div class="pf-c-form__group-label">
                  <label class="pf-c-form__label" for="asset_name">
                    <span class="pf-c-form__label-text">Name</span>
                    <span class="pf-c-form__label-required" aria-hidden="true">&#42;</span>
                  </label>
                </div>
                <div class="pf-c-form__group-control">
                  <input class="pf-c-form-control" type="text" id="asset_name" name="asset_name" required />
                </div>
              </div>
              <div class="pf-c-form__group">
                <div class="pf-c-form__group-label">
                  <label class="pf-c-form__label" for="asset_asset_type">
                    <span class="pf-c-form__label-text">Asset Type</span>
                    <span class="pf-c-form__label-required" aria-hidden="true">&#42;</span>
                  </label>
                </div>
                <div class="pf-c-form__group-control">
                  <select class="pf-c-form-control" id="asset_asset_type" name="asset_asset_type" required>
                    <option value="">Select an asset type...</option>
                    <option value="cookie">Cookie [Legacy]</option>
                    <option value="credentials">Credentials</option>
                    <option value="link">Link</option>
                  </select>
                </div>
              </div>

              <div id="asset_type_cookieHolder" class="collapse asset_type_holder">
                <div class="pf-c-form__group">
                  <div class="pf-c-form__group-label">
                    <label class="pf-c-form__label" for="asset_cookie_key">
                      <span class="pf-c-form__label-text">Cookie Key</span>
                    </label>
                  </div>
                  <div class="pf-c-form__group-control">
                    <input class="pf-c-form-control" type="text" id="asset_cookie_key" name="asset_cookie_key" required />
                  </div>
                </div>
                <div class="pf-c-form__group">
                  <div class="pf-c-form__group-label">
                    <label class="pf-c-form__label" for="asset_cookie_default_value">
                      <span class="pf-c-form__label-text">Cookie Default Value</span>
                    </label>
                  </div>
                  <div class="pf-c-form__group-control">
                    <input class="pf-c-form-control" type="text" id="asset_cookie_default_value" name="asset_cookie_default_value" required />
                  </div>
                </div>
                <div class="pf-c-form__group">
                  <div class="pf-c-form__group-label">
                    <label class="pf-c-form__label" for="asset_cookie_domain">
                      <span class="pf-c-form__label-text">Cookie Domain</span>
                    </label>
                  </div>
                  <div class="pf-c-form__group-control">
                    <input class="pf-c-form-control" type="text" id="asset_cookie_domain" name="asset_cookie_domain" value="{{ $workshop->base_domain }}" required />
                  </div>
                </div>
                <div class="pf-c-form__group">
                  <div class="pf-c-form__group-label">
                    <label class="pf-c-form__label" for="asset_cookie_path">
                      <span class="pf-c-form__label-text">Cookie Path</span>
                    </label>
                  </div>
                  <div class="pf-c-form__group-control">
                    <input class="pf-c-form-control" type="text" id="asset_cookie_path" name="asset_cookie_path" value="{{ $workshop->workshop_path }}" required />
                  </div>
                </div>
                <div class="pf-c-form__group">
                  <div class="pf-c-form__group-label">
                    <label class="pf-c-form__label" for="asset_cookie_expiration">
                      <span class="pf-c-form__label-text">Cookie Expiration</span>
                    </label>
                  </div>
                  <div class="pf-c-form__group-control">
                    <input class="pf-c-form-control" type="number" step="1" min="1" max="30" value="7" id="asset_cookie_expiration" name="asset_cookie_expiration" required />
                  </div>
                </div>
              </div>
              
              <div id="asset_type_credentialsHolder" class="collapse asset_type_holder">
                <div class="pf-c-form__group">
                  <div class="pf-c-form__group-label">
                  </div>
                  <div class="pf-c-form__group-control">
                    <p class="pf-u-mb-lg"><small>Add Cookie variables with double brackets eg <span class="greyCode">[[domain]]</span>, <span class="greyCode">[[workshop]]</span>, <span class="greyCode">[[seat_number]]</span>, etc</small></p>
                  </div>
                </div>
                <div class="pf-c-form__group">
                  <div class="pf-c-form__group-label">
                    <label class="pf-c-form__label" for="asset_credential_title">
                      <span class="pf-c-form__label-text">Credential Title</span>
                    </label>
                  </div>
                  <div class="pf-c-form__group-control">
                    <input class="pf-c-form-control" type="text" id="asset_credential_title" name="asset_credential_title" required />
                  </div>
                </div>
                <div class="pf-c-form__group">
                  <div class="pf-c-form__group-label">
                    <label class="pf-c-form__label" for="asset_credential_url">
                      <span class="pf-c-form__label-text">Credential URL</span>
                    </label>
                  </div>
                  <div class="pf-c-form__group-control">
                    <input class="pf-c-form-control" type="text" id="asset_credential_url" name="asset_credential_url" required />
                  </div>
                </div>
                <div class="pf-c-form__group">
                  <div class="pf-c-form__group-label">
                    <label class="pf-c-form__label" for="asset_credential_username">
                      <span class="pf-c-form__label-text">Credential Username</span>
                    </label>
                  </div>
                  <div class="pf-c-form__group-control">
                    <input class="pf-c-form-control" type="text" id="asset_credential_username" name="asset_credential_username" value="student[[seat_number]]" required />
                  </div>
                </div>
                <div class="pf-c-form__group">
                  <div class="pf-c-form__group-label">
                    <label class="pf-c-form__label" for="asset_credential_password">
                      <span class="pf-c-form__label-text">Credential Password</span>
                    </label>
                  </div>
                  <div class="pf-c-form__group-control">
                    <input class="pf-c-form-control" type="text" id="asset_credential_password" name="asset_credential_password" value="R3dh4t1!" required />
                  </div>
                </div>

              </div>
              
              <div id="asset_type_linkHolder" class="collapse asset_type_holder">
                <div class="pf-c-form__group">
                  <div class="pf-c-form__group-label">
                    <label class="pf-c-form__label" for="asset_link_title">
                      <span class="pf-c-form__label-text">Link Title</span>
                    </label>
                  </div>
                  <div class="pf-c-form__group-control">
                    <input class="pf-c-form-control" type="text" id="asset_link_title" name="asset_link_title" required />
                  </div>
                </div>
                <div class="pf-c-form__group">
                  <div class="pf-c-form__group-label">
                    <label class="pf-c-form__label" for="asset_link_url">
                      <span class="pf-c-form__label-text">Link URL</span>
                    </label>
                  </div>
                  <div class="pf-c-form__group-control">
                    <input class="pf-c-form-control" type="text" id="asset_link_url" name="asset_link_url" required />
                  </div>
                </div>
              </div>

          </div>
          <footer class="pf-c-modal-box__footer">
            <button class="pf-c-button pf-m-primary" type="submit">Create</button>
            <button class="pf-c-button pf-m-secondary" type="reset">Reset</button>
          </footer>
        
        </form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" src="/assets/js/vendor-flatpickr.min.js"></script>
<script type="text/javascript">
  function templateCookieAsset(obj, asset_data, type = 'Inherited') {
    jQuery("#assetFactoryHolder .pf-c-card__body").append('<div class="asset_group" id="event-asset_cookie_'+obj['slug']+'-holder"><h1>['+type+']['+obj['asset_type'].charAt(0).toUpperCase() + obj['asset_type'].slice(1) +'] '+obj['name']+'<button class="pf-c-button pf-m-danger pf-m-small pf-u-float-right"><i class="pf-icon pf-icon-remove2"></i></button></h1>' +
    '<div class="pf-c-form__group"><div class="pf-c-form__group-label"><label class="pf-c-form__label" for="event-asset_cookie-key_'+obj['slug']+'"><span class="pf-c-form__label-text">Key</span></label></div>' +
    '<div class="pf-c-form__group-control"><input class="pf-c-form-control" type="text" id="event-asset_cookie-key_'+obj['slug']+'" name="event-asset_cookie-key_'+obj['slug']+'" value="'+asset_data['key']+'" /></div></div>' +
    '<div class="pf-c-form__group"><div class="pf-c-form__group-label"><label class="pf-c-form__label" for="event-asset_cookie-value_'+obj['slug']+'"><span class="pf-c-form__label-text">Value</span></label></div>' +
    '<div class="pf-c-form__group-control"><input class="pf-c-form-control" type="text" id="event-asset_cookie-value_'+obj['slug']+'" name="event-asset_cookie-value_'+obj['slug']+'" value="'+asset_data['default_value']+'" /></div></div>' +
    '<input type="hidden" id="event-asset_cookie-domain_'+obj['slug']+'" name="event-asset_cookie-domain_'+obj['slug']+'" value="'+asset_data['domain']+'" />' +
    '<input type="hidden" id="event-asset_cookie-path_'+obj['slug']+'" name="event-asset_cookie-path_'+obj['slug']+'" value="'+asset_data['path']+'" />' +
    '<input type="hidden" id="event-asset_cookie-expiration_'+obj['slug']+'" name="event-asset_cookie-expiration_'+obj['slug']+'" value="'+asset_data['expiration']+'" />' +
    '<input type="hidden" id="event-asset_cookie-name_'+obj['slug']+'" name="event-asset_cookie-name_'+obj['slug']+'" value="'+obj['name']+'" />' +
    '</div>');
  }
  function templateCredentialAsset(obj, asset_data, type = 'Inherited') {
    jQuery("#assetFactoryHolder .pf-c-card__body").append('<div class="asset_group" id="event-asset_credential_'+obj['slug']+'-holder"><h1>['+type+']['+obj['asset_type'].charAt(0).toUpperCase() + obj['asset_type'].slice(1) +'] '+obj['name']+'<button class="pf-c-button pf-m-danger pf-m-small pf-u-float-right"><i class="pf-icon pf-icon-remove2"></i></button></h1>' +
    '<div class="pf-c-form__group"><div class="pf-c-form__group-label"><label class="pf-c-form__label" for="event-asset_credential-title_'+obj['slug']+'"><span class="pf-c-form__label-text">Title</span></label></div>' +
    '<div class="pf-c-form__group-control"><input class="pf-c-form-control" type="text" id="event-asset_credential-title_'+obj['slug']+'" name="event-asset_credential-title_'+obj['slug']+'" value="'+asset_data['title']+'" /></div></div>' +
    '<div class="pf-c-form__group"><div class="pf-c-form__group-label"><label class="pf-c-form__label" for="event-asset_credential-url_'+obj['slug']+'"><span class="pf-c-form__label-text">URL</span></label></div>' +
    '<div class="pf-c-form__group-control"><input class="pf-c-form-control" type="text" id="event-asset_credential-url_'+obj['slug']+'" name="event-asset_credential-url_'+obj['slug']+'" value="'+asset_data['url']+'" /></div></div>' +
    '<div class="pf-c-form__group"><div class="pf-c-form__group-label"><label class="pf-c-form__label" for="event-asset_credential-username_'+obj['slug']+'"><span class="pf-c-form__label-text">Username</span></label></div>' +
    '<div class="pf-c-form__group-control"><input class="pf-c-form-control" type="text" id="event-asset_credential-username_'+obj['slug']+'" name="event-asset_credential-username_'+obj['slug']+'" value="'+asset_data['username']+'" /></div></div>' +
    '<div class="pf-c-form__group"><div class="pf-c-form__group-label"><label class="pf-c-form__label" for="event-asset_credential-password_'+obj['slug']+'"><span class="pf-c-form__label-text">Password</span></label></div>' +
    '<div class="pf-c-form__group-control"><input class="pf-c-form-control" type="text" id="event-asset_credential-password_'+obj['slug']+'" name="event-asset_credential-password'+obj['slug']+'" value="'+asset_data['password']+'" /></div></div>' +
    '<input type="hidden" id="event-asset_credential-name_'+obj['slug']+'" name="event-asset_credential-name_'+obj['slug']+'" value="'+obj['name']+'" />' +
    '</div>');    
  }
  function templateLinkAsset(obj, asset_data, type = 'Inherited') {
    jQuery("#assetFactoryHolder .pf-c-card__body").append('<div class="asset_group" id="event-asset_credential_'+obj['slug']+'-holder"><h1>['+type+']['+obj['asset_type'].charAt(0).toUpperCase() + obj['asset_type'].slice(1) +'] '+obj['name']+'<button class="pf-c-button pf-m-danger pf-m-small pf-u-float-right"><i class="pf-icon pf-icon-remove2"></i></button></h1>' +
    '<div class="pf-c-form__group"><div class="pf-c-form__group-label"><label class="pf-c-form__label" for="event-asset_credential-title_'+obj['slug']+'"><span class="pf-c-form__label-text">Title</span></label></div>' +
    '<div class="pf-c-form__group-control"><input class="pf-c-form-control" type="text" id="event-asset_credential-title_'+obj['slug']+'" name="event-asset_credential-title_'+obj['slug']+'" value="'+asset_data['title']+'" /></div></div>' +
    '<div class="pf-c-form__group"><div class="pf-c-form__group-label"><label class="pf-c-form__label" for="event-asset_credential-url_'+obj['slug']+'"><span class="pf-c-form__label-text">URL</span></label></div>' +
    '<div class="pf-c-form__group-control"><input class="pf-c-form-control" type="text" id="event-asset_credential-url_'+obj['slug']+'" name="event-asset_credential-url_'+obj['slug']+'" value="'+asset_data['url']+'" /></div></div>' +
    '<input type="hidden" id="event-asset_link-name_'+obj['slug']+'" name="event-asset_link-name_'+obj['slug']+'" value="'+obj['name']+'" />' +
    '</div>');
  }

  jQuery(document).ready(function() {
    jQuery("#createEventForm").on('change', "#event_workshop_id", function(e) {
      e.preventDefault();
      //showLoadingScreen();
      var workshop_id = this.value;
      jQuery("#assetFactoryHolder").removeClass('show');
      jQuery.ajax({method: "POST", data: { id: workshop_id }, url: "{{ route('panel.post.workshop.listAssets') }}", async: false, success: function(result){
        console.log(result);
        jQuery("#assetFactoryHolder .pf-c-card__body .asset_group").remove();
        for (var key in result) {
            // skip loop if the property is from prototype
            if (!result.hasOwnProperty(key)) continue;

            var obj = result[key];
            var asset_data = JSON.parse(obj['asset_data']);
            switch (obj['asset_type']) {
              case "cookie":
                templateCookieAsset(obj, asset_data);
              break;
              case "credentials":
                templateCredentialAsset(obj, asset_data);
              break;
              case "link":
                templateLinkAsset(obj, asset_data);
              break;
            }
            
            for (var prop in obj) {
                // skip loop if the property is from prototype
                if (!obj.hasOwnProperty(prop)) continue;

                // your code
                //console.log(prop + " = " + obj[prop]);
            }
        }
        //jQuery("#assetFactoryHolder .pf-c-card__body").text(result);
        
        jQuery("#assetFactoryHolder").addClass('show');
        
        jQuery(".asset_group").on("click", ".pf-m-danger", function(e) {
          e.preventDefault();
          jQuery(this).parent().parent().remove();
        });
      }});

      //hideLoadingScreen();
    });

    jQuery("#createEventForm").on('reset', function(e) {
      showLoadingScreen();
      jQuery("#assetFactoryHolder .pf-c-card__body .asset_group").remove();
      jQuery("#assetFactoryHolder").removeClass('show');
      hideLoadingScreen();
    });

    jQuery("#createEventForm").on('change', 'select#privacy_level', function() {
      if (jQuery(this).children("option:selected").val() == 1) {
        jQuery("#passcodeHolder").removeClass('pf-u-hidden');
      }
      else {
        jQuery("#passcodeHolder").addClass('pf-u-hidden');
      }
    });

    flatpickr("#event_start_date", {
      enableTime: true,
      dateFormat: "Y-m-d H:i:S",
      defaultHour: 8,
    });
    flatpickr("#event_end_date", {
      enableTime: true,
      dateFormat: "Y-m-d H:i:S",
      defaultHour: 8,
    });
    jQuery("#createEventForm").on('click', "#addCustomAssetBtn", function(e) {
      e.preventDefault();
      //Whoops - this is a TODO
    });
      /*
      $("#event_start_date").on("change.datetimepicker", function (e) {
        $('#event_end_date').datetimepicker('minDate', e.date);
      });
      $("#event_end_date").on("change.datetimepicker", function (e) {
        $('#event_start_date').datetimepicker('maxDate', e.date);
      });*/
    jQuery("#addCustomAssetModal").on('click', '.close', function(e) {
      e.preventDefault();
      jQuery("#addCustomAssetModal form").trigger('reset');
      jQuery('#addCustomAssetModal').modal('hide')
    });
    jQuery('.modal').on('hidden.bs.modal', function (e) {
      jQuery("#modalHolder").hide();
    });
    jQuery('.modal').on('shown.bs.modal', function (e) {
      jQuery("#modalHolder").show();
    });
    jQuery("#addCustomAssetForm").on('submit', function(e) {
      e.preventDefault();
      // Generate needed HTML in asset view
      //recreate obj
      var obj = {
        asset_type: jQuery("#asset_asset_type").val(),
        name: jQuery("#asset_name").val(),
        slug: slugify(jQuery("#asset_name").val().toLowerCase()),
      };
      switch(jQuery("#asset_asset_type").val()) {
        case "cookie":
          var asset_data = {
            key: jQuery("#asset_cookie_key").val(),
            default_value: jQuery("#asset_cookie_default_value").val(),
            domain: jQuery("#asset_cookie_domain").val(),
            path: jQuery("#asset_cookie_path").val(),
            expiration: jQuery("#asset_cookie_expiration").val(),
          }
          templateCookieAsset(obj, asset_data, 'Custom');
        break;
        case "credentials":
          var asset_data = {
            title: jQuery("#asset_credential_title").val(),
            url: jQuery("#asset_credential_url").val(),
            username: jQuery("#asset_credential_username").val(),
            password: jQuery("#asset_credential_password").val(),
          }
          templateCredentialAsset(obj, asset_data, 'Custom');
        break;
        case "link":
          var asset_data = {
            title: jQuery("#asset_link_title").val(),
            url: jQuery("#asset_link_url").val(),
          }
          templateLinkAsset(obj, asset_data, 'Custom');
        break;
      }
      jQuery("#addCustomAssetModal form").trigger('reset');
      jQuery("#addCustomAssetModal").modal('hide');
    });
    
    jQuery("#addCustomAssetForm").on('change', "#asset_asset_type", function(e) {
      e.preventDefault();
      jQuery(".asset_type_holder").removeClass('show');
      jQuery("#asset_type_"+this.value+"Holder").addClass('show');
    });
    jQuery("#addCustomAssetForm").on('reset', function(e) {
      jQuery(".asset_type_holder").removeClass('show');
    });

  });
</script>
@endsection

@endif