<?php

namespace App\Http\Controllers;

use Redirect;
use App\Event;
use App\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $events = Event::all();
      return view('events.index')->with(['events' => $events]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $workshops = Workshop::with(['assets'])->get();
      return view('events.create')->with(['workshops' => $workshops]);
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
        'event_workshop_id' => 'required',
        'event_title'       => 'required',
        'event_start_date'  => 'required',
        'event_end_date'    => 'required',
        'event_eid'         => 'required',
        'event_seat_count'  => 'required|numeric'
      );
      $validator = Validator::make($request->all(), $rules);

      // process the event
      if ($validator->fails()) {
          Session::flash('message-danger', 'Validation error!');
          return Redirect::route('panel.get.events.create')
              ->withErrors($validator)
              ->withInput();
      } else {
          // store
          $event = new Event;
          $event->user_id = Auth::user()->id;
          $event->workshop_id = $request->input('event_workshop_id');
          $event->event_title = $request->input('event_title');
          $event->description = $request->input('event_description');
          $event->private_notes = $request->input('event_private_notes');
          $event->start_time = $request->input('event_start_date');
          $event->end_time = $request->input('event_end_date');
          $event->event_id = $request->input('event_eid');
          $event->seat_count = $request->input('event_seat_count');
          $inputs = $request->all();
          $effective_asset_data = [];
          foreach ($inputs as $iK => $iV) {
            $exIn = explode('_', $iK);
            if ($exIn[0] == 'event-asset') {
              if (strstr($exIn[1], 'cookie-')) {
                switch ($exIn[1]) {
                  case "cookie-name":
                    $effective_asset_data['cookies'][$exIn[2]]['cookie-name'] = $iV;
                  break;
                  case "cookie-key":
                    $effective_asset_data['cookies'][$exIn[2]]['cookie-key'] = $iV;
                  break;
                  case "cookie-value":
                    $effective_asset_data['cookies'][$exIn[2]]['cookie-value'] = $iV;
                  break;
                  case "cookie-domain":
                    $effective_asset_data['cookies'][$exIn[2]]['cookie-domain'] = $iV;
                  break;
                  case "cookie-path":
                    $effective_asset_data['cookies'][$exIn[2]]['cookie-path'] = $iV;
                  break;
                  case "cookie-expiration":
                    $effective_asset_data['cookies'][$exIn[2]]['cookie-expiration'] = $iV;
                  break;
                }
              }
              if (strstr($exIn[1], 'credential-')) {
                switch ($exIn[1]) {
                  case "credential-name":
                    $effective_asset_data['credentials'][$exIn[2]]['credential-name'] = $iV;
                  break;
                  case "credential-title":
                    $effective_asset_data['credentials'][$exIn[2]]['credential-title'] = $iV;
                  break;
                  case "credential-url":
                    $effective_asset_data['credentials'][$exIn[2]]['credential-url'] = $iV;
                  break;
                  case "credential-username":
                    $effective_asset_data['credentials'][$exIn[2]]['credential-username'] = $iV;
                  break;
                  case "credential-password":
                    $effective_asset_data['credentials'][$exIn[2]]['credential-url'] = $iV;
                  break;
                }
              }
              if (strstr($exIn[1], 'link-')) {
                switch ($exIn[1]) {
                  case "link-name":
                    $effective_asset_data['links'][$exIn[2]]['link-name'] = $iV;
                  break;
                  case "link-title":
                    $effective_asset_data['links'][$exIn[2]]['link-title'] = $iV;
                  break;
                  case "link-url":
                    $effective_asset_data['links'][$exIn[2]]['link-url'] = $iV;
                  break;
                }
              }
            }
          }
          $event->effective_asset_data = json_encode($effective_asset_data);
          $event->save();

          // redirect
          Session::flash('message', 'Successfully created event!');
          return Redirect::route('panel.get.events.index');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Event::destroy($id);
      
      // Session::flash('message-danger', 'This is a danger message!');
      // Session::flash('message-warning', 'This is an orange warning message!');
      // Session::flash('message-info', 'This is a simple info message!');
      // Session::flash('message-success', 'This is a successful message!');

      Session::flash('message-success', 'Event successfully deleted.');
      return Redirect::route('panel.get.events.index');
    }
}
