<?php

namespace App\Http\Controllers;

use App\Event;
use App\Workshop;
use Illuminate\Http\Request;

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
        'event_start_time'  => 'required',
        'event_end_time'    => 'required',
        'event_event_id'    => 'required',
        'event_seat_count'  => 'required|numeric'
      );
      $validator = Validator::make($request->all(), $rules);

      // process the event
      if ($validator->fails()) {
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
          $event->start_time = $request->input('event_start_time');
          $event->end_time = $request->input('event_end_time');
          $event->event_id = $request->input('event_event_id');
          $event->seat_count = $request->input('event_seat_count');
          $event->effective_asset_data = $request->input('');
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
        //
    }
}
