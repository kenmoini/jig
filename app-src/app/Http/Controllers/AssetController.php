<?php

namespace App\Http\Controllers;

use Redirect;
use App\Asset;
use App\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AssetController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // validate
      // read more on validation at http://laravel.com/docs/validation
      switch ($request->input('asset_asset_type')) {
        case "cookie":
          $asset_data = [
            'key' => $request->input("asset_cookie_key"),
            'default_value' => $request->input("asset_cookie_default_value"),
            'domain' => $request->input("asset_cookie_domain"),
            'path' => $request->input("asset_cookie_path"),
            'expiration' => $request->input("asset_cookie_expiration"),
          ];
          $rules = array(
            'asset_asset_type'           => 'required',
            'asset_name'                 => 'required',
            'workshop_id'                => 'required',
            'asset_cookie_key'           => 'required',
            'asset_cookie_default_value' => 'required',
            'asset_cookie_domain'        => 'required',
            'asset_cookie_path'          => 'required',
            'asset_cookie_expiration'    => 'required',
          );
        break;
        case "credentials":
          $asset_data = [
            'title' => $request->input("asset_credentials_title"),
            'url' => $request->input("asset_credentials_url"),
            'username' => $request->input("asset_credentials_username"),
            'password' => $request->input("asset_credentials_password"),
          ];
          $rules = array(
            'asset_asset_type'          => 'required',
            'asset_name'                => 'required',
            'workshop_id'               => 'required',
            'asset_credential_title'    => 'required',
            'asset_credential_url'      => 'required',
            'asset_credential_username' => 'required',
            'asset_credential_password' => 'required',
          );
        break;
        case "link":
          $asset_data = [
            'title' => $request->input("asset_link_title"),
            'url' => $request->input("asset_link_url"),
          ];
          $rules = array(
            'asset_asset_type' => 'required',
            'asset_name'       => 'required',
            'workshop_id'      => 'required',
            'asset_link_title' => 'required',
            'asset_link_url'   => 'required',
          );
        break;
      }
      $validator = Validator::make($request->all(), $rules);
      
      // process the asset
      if ($validator->fails()) {
          Session::flash('message-warning', 'Validation failed!');
          return Redirect::route('panel.get.workshops.show', $request->input('workshop_id'))
              ->withErrors($validator)
              ->withInput();
      } else {
          // store
          $asset = new Asset;
          $asset->asset_type = $request->input('asset_asset_type');
          $asset->name = $request->input('asset_name');
          $asset->slug = Str::slug($request->input('asset_name'), '-');
          $asset->asset_data = json_encode($asset_data);
          $asset->user_id = Auth::user()->id;
          $asset->workshop_id = $request->input('workshop_id');
          
          $asset->save();

          // redirect
          Session::flash('message', 'Successfully created asset!');
          return Redirect::route('panel.get.workshops.show', $request->input('workshop_id'));
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $asset = Asset::find($id);
      if ($asset) {
        $assetDetail = $asset->first();
        $workshop_id = $assetDetail->workshop_id;
        unset($assetDetail);
        $asset->delete();
        Session::flash('message-success', 'Asset successfully deleted.');
        return Redirect::route('panel.get.workshops.show', $workshop_id);
      }
      else {
        Session::flash('message-danger', 'Invalid asset.');
        return Redirect::route('panel.get.workshops.index');
      }
    }
}
