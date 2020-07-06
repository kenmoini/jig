<?php

namespace App\Http\Controllers;

use Redirect;
use App\Attendee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AttendeeController extends Controller
{

  
  public function releaseStudent(Request $request, $id) {
    $attendee = Attendee::where('id', $id)->get()->first();
    $attendee->seat_state = 2; // Taint the seat
    $attendee->save();

    Session::flash('message-success', 'Student successfully released.');
    return Redirect::route('panel.get.events.show', $attendee->event_id);
  }


  public function resetSeat(Request $request, $id) {
    $attendee = Attendee::where('id', $id)->get()->first();
    $attendee->seat_state = 0; // Reset the seat
    
    $previousNames = [];
    if ($attendee->previous_student_name_ids !== null) {
      $previousNames = json_decode($attendee->previous_student_name_ids);
    }
    
    array_push($previousNames, $attendee->student_name_id);
    $attendee->previous_student_name_ids = $previousNames;
    $attendee->student_name_id = null;
    $attendee->save();

    Session::flash('message-success', 'Seat successfully reset.');
    return Redirect::route('panel.get.events.show', $attendee->event_id);
    
  }
}
