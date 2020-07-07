<?php

namespace App\Http\Controllers\API;

use App\Activity;
use App\Attendee;
use App\Event;
use App\Student;
use App\StudentName;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class StudentLoginController extends Controller
{
    // Log student activity through workshop pageLoads
    public function handleFrontendActivity(Request $request) {

      // validate
      // read more on validation at http://laravel.com/docs/validation
      $rules = array(
        'student_name_id'       => 'required|numeric',
        'activity_type' => ['required', Rule::in(['pageLoad', 'logout', 'login']),],
        'initiating_url' => 'required',
      );
      $validator = Validator::make($request->all(), $rules);

      // process the login
      if ($validator->fails()) {

        return response()->json([
          'status' => 'failed',
          'code' => 'validation-failed',
          'message' => 'Validation failed',
          //'object' => $validator->errors()
        ], 400);

      } else {

        // Validated, create/locate student object

        // Log the Workshop Student Navigating through the curriculum
        $logInAction = new Activity;
        $logInAction->activity_type = $request->input('activity_type');
        $logInAction->actor_type = "student";
        $logInAction->actor_id = $request->input('student_name_id');
        $logInAction->activity_data = json_encode(['initiating_url' => $request->input('initiating_url')]);
        $logInAction->user_agent = $request->header('User-Agent');
        $logInAction->actor_ip = $request->ip();
        $logInAction->save();

        return response()->json([
          'status' => 'success',
        ], 200);

      }

    }

    // Handle "Login" Function
    public function handleLogin(Request $request) {

      // Call this API @ /api/v1/student-login

      // validate
      // read more on validation at http://laravel.com/docs/validation
      $rules = array(
        'student_name'       => 'required',
        'student_email'      => 'required|email',
        'initiating_url' => 'required',
      );
      $validator = Validator::make($request->all(), $rules);

      // process the login
      if ($validator->fails()) {
        return response()->json([
          'status' => 'failed',
          'code' => 'validation-failed',
          'message' => 'Validation failed',
          //'object' => $validator->errors()
        ], 400);
      } else {

        // Validated, create/locate student object
        $student = Student::firstOrCreate([
          'email' => $request->input('student_email')
        ]);

        // Create/locate student name object
        $student_name = StudentName::firstOrCreate([
          'student_id' => $student->id,
          'name' => $request->input('student_name')
        ]);

        // Log the Login Activity
        $logInAction = new Activity;
        $logInAction->activity_type = "login";
        $logInAction->actor_type = "student";
        $logInAction->actor_id = $student_name->id;
        $logInAction->activity_data = json_encode(['initiating_url' => $request->input('initiating_url')]);
        $logInAction->user_agent = json_encode($request->header('User-Agent'));
        $logInAction->actor_ip = $request->ip();
        $logInAction->save();

        return response()->json([
          'status' => 'success',
          'code' => 'student-logged-in',
          'message' => 'Student successfully logged in',
          'data' => [
            'student_email' => $student->email,
            'student_id' => $student->id,
            'student_name' => $student_name->name,
            'student_name_id' => $student_name->id,
          ]
        ], 200);
      }
    }

    // Handle Workshop Event ID Matching 
    public function handleEventID(Request $request) {

      // Access this API endpoint via /api/v1/access-workshop-event/

      // validate
      // read more on validation at http://laravel.com/docs/validation
      $rules = array(
        'student_name_id'     => 'required|numeric',
        'event_id'       => 'required',
        'initiating_url' => 'required',
      );
      $validator = Validator::make($request->all(), $rules);

      // process the login
      if ($validator->fails()) {
        return response()->json([
          'status' => 'failed',
          'code' => 'validation-failed',
          'message' => 'Validation failed',
          'object' => $validator->errors()
        ], 200);
      } else {


        // Look up EID
        // TODO: Add more robust time range look ups, add orderBy
        $now = Carbon::now();
        $event_obj = Event::where('event_id', $request->input('event_id'))->where('start_time', '<=', $now)->where('end_time', '>=', $now)->orderBy('created_at', 'asc')->get();
        
        // ...we could return a list of events...but why overcompensate for human stupidity...
        $event = $event_obj->first();

        if ($event) {

          // Find the first available seat and claim
          $findAttendee = Attendee::where(['seat_state' => 1, 'event_id' => $event->id, 'student_name_id' => $request->input('student_name_id')])->first();
          if (!$findAttendee) {
            $attendee = Attendee::where(['seat_state' => 0, 'event_id' => $event->id])->orderBy('seat_number', 'asc')->first();
            $attendee->student_name_id = $request->input('student_name_id');
            $attendee->seat_state = 1;
            $attendee->save();
          }
          else {
            $attendee = $findAttendee;
          }
          // Load event assets from DB
          $assets = json_decode($event->effective_asset_data, true);
          $assets['cookies']['seat_number-cookie'] = [
            'cookie_key' => 'seat_number',
            'cookie_value' => $attendee->seat_number,
            'cookie_domain' => $assets['cookies']['domain-cookie']['cookie_domain'],
            'cookie_path' => $assets['cookies']['domain-cookie']['cookie_path'],
            'cookie_expiration' => $assets['cookies']['domain-cookie']['cookie_expiration'],
            'cookie_name' => 'Student Seat Number'
          ];
          
          // Process variables in assets
          //nope nvm, do it client side with cookies and HTML data lol

          // Log the Workshop EID Activity workshopInit
          $logInAction = new Activity;
          $logInAction->activity_type = "workshopInit";
          $logInAction->actor_type = "student";
          $logInAction->actor_id = $request->input('student_name_id');
          $logInAction->activity_data = json_encode(['initiating_url' => $request->input('initiating_url'), 'event_id' => $request->input('event_id'), 'attendee_id' => $attendee->id]);
          $logInAction->user_agent = json_encode($request->header('User-Agent'));
          $logInAction->actor_ip = $request->ip();
          $logInAction->save();

          // Return data to user
          return response()->json([
            'status' => 'success',
            'code' => 'workshop-event-initialized',
            'message' => 'Event found!  Workshop initializing...',
            'data' => [
              'event' => $event,
              'attendee' => $attendee,
              'assets' => $assets,
              'student_seat_number' => $attendee->seat_number,
            ]
          ], 200);
        }
        else {

          // No event found
          return response()->json([
            'status' => 'failed',
            'code' => 'invalid-event-id',
            'message' => 'Invalid Event ID'
          ], 200);

        }
      }
    }

    public function findAvailableEvents() {
      // Access this API endpoint via /api/v1/find-available-events/

      $now = Carbon::now();
      $events = Event::where('start_time', '<=', $now)->where('end_time', '>=', $now)->where('privacy_level', '<=', 1)->orderBy('created_at', 'asc')->with(['workshop'])->get();
      

      if (count($events)) {
        $eventArray = [];
        foreach($events as $event) {
          $eventArray[] = [
            'event_id' => $event['id'],
            'event_eid' => $event['event_id'],
            'event_title' => $event['event_title'],
            'start_time' => $event['start_time'],
            'end_time' => $event['end_time'],
            'seat_count' => $event['seat_count'],
            'seats_available' => count(Attendee::where(['seat_state' => 0, 'event_id' => $event['id']])->get()),
            'workshop_title' => $event->workshop()->first()->name,
            'privacy_level' => $event['privacy_level']
          ];
        }
        return response()->json([
          'status' => 'success',
          'code' => 'available-events-found',
          'message' => 'Available events found!',
          'events' => $eventArray,
        ], 200);
      }
      else {

        // No events found
        return response()->json([
          'status' => 'failed',
          'code' => 'no-available-events',
          'message' => 'No active and available events found.'
        ], 200);

      }
    }
}
