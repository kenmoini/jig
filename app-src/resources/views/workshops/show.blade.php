@extends('layouts.pf4-primary')

@section('pageTitle', 'View Workshop - ' . $workshop['name'])

@section('content')
<div class="pf-c-card pf-u-mb-lg">
  <div class="pf-c-card__title">Information</div>
  <div class="pf-c-card__body">
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
      <div class="pf-c-form__group">
        <div class="pf-c-form__group-label">
          <label class="pf-c-form__label" for="workshop_curriculum_slug">
            <span class="pf-c-form__label-text">Created by</span>
          </label>
        </div>
        <div class="pf-c-form__group-control">
          {{ $workshop->user()->first()->name }} @ {{ $workshop->created_at }}
        </div>
      </div>
    </div>
  </div>
</div>

<div class="pf-c-card">
  <div class="pf-c-card__header">
    <div class="pf-c-card__header-main">
      <strong>Assets</strong>
    </div>
    <div class="pf-c-card__actions">
      <a class="pf-c-button pf-m-primary" href="#" data-toggle="collapse" aria-controls="addAssetFormHolder" data-target="#addAssetFormHolder">Add Asset</a>
    </div>
  </div>
  <div class="pf-c-card__body collapse" id="addAssetFormHolder">
    <form novalidate class="pf-c-form pf-m-horizontal" id="addAssetForm" aria-labelledby="addAssetForm" action="{{ route('panel.post.assets.store') }}" method="POST">
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
      
      <div class="pf-c-form__group pf-m-action">
        <div class="pf-c-form__actions">
          <input type="hidden" value="{{ $workshop->id }}" id="workshop_id" name="workshop_id" />
        </div>
        <div class="pf-c-form__group-control">
          <button class="pf-c-button pf-m-primary" type="submit">Create</button>
          <button class="pf-c-button pf-m-secondary" type="reset">Reset</button>
        </div>
      </div>

      <hr />
    </form>
  </div>
  <div class="pf-c-card__body">
    <table class="pf-c-table pf-m-grid-lg pf-u-mt-xl pf-u-mb-xl" role="grid" aria-label="Listing of Assets" id="assets-table">
      <thead>
        <tr role="row">
          <th class="pf-c-table__sort pf-m-selected" role="columnheader" aria-sort="ascending" scope="col">
            <button class="pf-c-table__button">
              <div class="pf-c-table__button-content">
                <span class="pf-c-table__text">Name</span>
                <span class="pf-c-table__sort-indicator">
                  <i class="fas fa-long-arrow-alt-up"></i>
                </span>
              </div>
            </button>
          </th>
          <th class="pf-c-table__sort " role="columnheader" aria-sort="none" scope="col">
            <button class="pf-c-table__button">
              <div class="pf-c-table__button-content">
                <span class="pf-c-table__text">Type</span>
                <span class="pf-c-table__sort-indicator">
                  <i class="fas fa-arrows-alt-v"></i>
                </span>
              </div>
            </button>
          </th>
          <th class="pf-c-table__sort " role="columnheader" aria-sort="none" scope="col">
            <button class="pf-c-table__button">
              <div class="pf-c-table__button-content">
                <span class="pf-c-table__text">Details</span>
                <span class="pf-c-table__sort-indicator">
                  <i class="fas fa-arrows-alt-v"></i>
                </span>
              </div>
            </button>
          </th>
          <th role="columnheader" scope="col">Actions</th>
        </tr>
      </thead>
      <tbody role="rowgroup">
        @if(count($workshop->assets()->get()))
          @foreach($workshop->assets()->get() as $asset)
          <tr role="row">
            <td role="cell" data-label="Workshop name">{{ $asset->name }}</td>
            <td role="cell" data-label="Type">{{ ucfirst($asset->asset_type) }}</td>
            <td role="cell" data-label="Details">{!! $asset->important_facts !!}</td>
            <td role="cell" data-label="Actions">
              <a href="#" class="pf-c-button pf-m-danger" onclick="event.preventDefault();document.getElementById('delete-asset-{{ $asset->id }}-form').submit();">Delete</a>
              <form id="delete-asset-{{ $asset->id }}-form" action="{{ route('panel.post.assets.destroy', $asset->id) }}" method="POST" style="display: none;">
                  @csrf
              </form>
            </td>
          </tr>
          @endforeach
        @else
          <tr role="row">
            <td role="cell" class="pf-u-text-align-center" data-label="No records" colspan="4">No records found!</td>
          </tr>
        @endif
      </tbody>
    </table>
  </div>
</div>


@endsection


@section('footerScripts')
<script type="text/javascript">
  jQuery(document).ready(function() {
    
    jQuery("#addAssetFormHolder").on('change', "#asset_asset_type", function(e) {
      e.preventDefault();
      jQuery(".asset_type_holder").removeClass('show');
      jQuery("#asset_type_"+this.value+"Holder").addClass('show');
    });

    jQuery("#addAssetForm").on('reset', function(e) {
      jQuery(".asset_type_holder").removeClass('show');
    });
    
  });
</script>
@endsection