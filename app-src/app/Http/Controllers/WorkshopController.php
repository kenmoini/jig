<?php

namespace App\Http\Controllers;

use Redirect;
use App\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class WorkshopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $workshops = Workshop::with('user')->get();
      return view('workshops.index')->with(['workshops' => $workshops]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('workshops.create');
    }

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
      $rules = array(
        'workshop_name'       => 'required',
        'workshop_curriculum_endpoint'       => 'required',
        'workshop_curriculum_slug'       => 'required',
        'workshop_typical_length_in_hours' => 'required|numeric'
      );
      $validator = Validator::make($request->all(), $rules);

      // process the login
      if ($validator->fails()) {
          return Redirect::route('panel.get.workshops.create')
              ->withErrors($validator)
              ->withInput();
      } else {
          // store
          $workshop = new Workshop;
          $workshop->name = $request->input('workshop_name');
          $workshop->slug = Str::slug($request->input('workshop_name'), '-');
          $workshop->description = $request->input('workshop_description');
          $workshop->curriculum_slug = $request->input('workshop_curriculum_slug');
          $workshop->typical_length_in_hours = $request->input('workshop_typical_length_in_hours');
          $workshop->curriculum_endpoint = $request->input('workshop_curriculum_endpoint');
          $workshop->user_id = Auth::user()->id;
          $workshop->save();

          // redirect
          Session::flash('message', 'Successfully created workshop!');
          return Redirect::route('panel.get.workshops.index');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $workshop = Workshop::where('id', $id)->with(['user', 'assets'])->first();
      return view('workshops.show')->with(['workshop' => $workshop]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $workshop = Workshop::where('id', $id)->first();
      return view('workshops.edit')->with(['workshop' => $workshop]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      // validate
      // read more on validation at http://laravel.com/docs/validation
      $rules = array(
        'workshop_name'       => 'required',
        'workshop_curriculum_endpoint'       => 'required',
        'workshop_curriculum_slug'       => 'required',
        'workshop_typical_length_in_hours' => 'required|numeric'
      );
      $validator = Validator::make($request->all(), $rules);

      // process the login
      if ($validator->fails()) {
          return Redirect::route('panel.get.workshops.create')
              ->withErrors($validator)
              ->withInput();
      } else {
          // store
          $workshop = Workshop::find($id);
          $workshop->name = $request->input('workshop_name');
          $workshop->slug = Str::slug($request->input('workshop_name'), '-');
          $workshop->description = $request->input('workshop_description');
          $workshop->curriculum_slug = $request->input('workshop_curriculum_slug');
          $workshop->typical_length_in_hours = $request->input('workshop_typical_length_in_hours');
          $workshop->curriculum_endpoint = $request->input('workshop_curriculum_endpoint');
          $workshop->save();

          // redirect
          Session::flash('message-success', 'Successfully updated workshop!');
          return Redirect::route('panel.get.workshops.index');
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
      Workshop::destroy($id);
      
      // Session::flash('message-danger', 'This is a danger message!');
      // Session::flash('message-warning', 'This is an orange warning message!');
      // Session::flash('message-info', 'This is a simple info message!');
      // Session::flash('message-success', 'This is a successful message!');

      Session::flash('message-success', 'Workshop successfully deleted.');
      return Redirect::route('panel.get.workshops.index');
    }


    public function listAssets(Request $request) {
      $workshop = Workshop::where('id', $request->input('id'))->with(['assets'])->first();
      return response()->json($workshop->assets()->get());
    }
}
