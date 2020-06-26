<?php

namespace App\Http\Controllers\API;

use App\Activity;
use App\Attendee;
use App\Event;
use App\Student;
use App\StudentName;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentLoginController extends Controller
{
    // Log student activity through workshop pageLoads
    public function handleFrontendActivity(Request $request) {

      // validate
      // read more on validation at http://laravel.com/docs/validation
      $rules = array(
        'student_name_id'       => 'required|numeric',
        'page_loaded' => 'required',
      );
      $validator = Validator::make($request->all(), $rules);

      // process the login
      if ($validator->fails()) {

        return response()->json([
          'status' => 'failed',
          'code' => 'validation-failed',
          'message' => 'Validation failed'
        ]);

      } else {

        // Validated, create/locate student object

        // Log the Workshop Student Navigating through the curriculum
        $logInAction = new Activity;
        $logInAction->activity_type = "pageLoad";
        $logInAction->actor_type = "student";
        $logInAction->actor_id = $request->input('student_name_id');
        $logInAction->activity_data = ['page_loaded' => $request->input('initiating_url')];
        $logInAction->user_agent = $request->header('User-Agent');
        $logInAction->actor_ip = $request->ip();
        $logInAction->save();

        return response()->json([
          'status' => 'success',
        ]);

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
          'message' => 'Validation failed'
        ]);
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
            'student_id' => $student_name->id,
            'student_email' => $student->email,
            'student_name' => $student_name->name,
          ]
        ]);
      }
    }

    // Handle Workshop Event ID Matching 
    public function handleEventID(Request $request) {

      // Access this API endpoint via /api/v1/access-workshop-event/

      // validate
      // read more on validation at http://laravel.com/docs/validation
      $rules = array(
        'student_id'     => 'required|numeric',
        'event_id'       => 'required',
        'initiating_url' => 'required',
      );
      $validator = Validator::make($request->all(), $rules);

      // process the login
      if ($validator->fails()) {
        return response()->json([
          'status' => 'failed',
          'code' => 'validation-failed',
          'message' => 'Validation failed'
        ]);
      } else {

        // Look up EID
        // TODO: Add more robust time range look ups, add orderBy
        $event = Event::where('event_id', $request->input('event_id'))->orderBy('created_at', 'asc')->first();

        if ($event) {

          // Find the first available seat and claim
          $attendee = Attendee::where(['seat_state' => 0, 'event_id' => $event->id])->orderBy('seat_number', 'asc')->first();
          $attendee->student_name_id = $request->input('student_name_id');
          $attendee->seat_state = 1;
          $attendee->save();

          // Load event assets from DB
          $assets = json_decode($event->effective_asset_data);
          $assets['cookies']['seat_number-cookie'] = ['cookie-key' => 'seat_number', 'cookie-value' => $attendee->seat_number, 'cookie-domain' => $assets['cookies'][0]['cookie-domain'], 'cookie-path' => $assets['cookies'][0]['cookie-path'], 'cookie-expiration' => $assets['cookies'][0]['cookie-expiration'], 'cookie-name' => 'Student Seat Number'];
          
          // Process variables in assets
          //nope nvm, do it client side with cookies and HTML data lol

          // Log the Workshop EID Activity workshopInit
          $logInAction = new Activity;
          $logInAction->activity_type = "workshopInit";
          $logInAction->actor_type = "student";
          $logInAction->actor_id = $request->input('student_name_id');
          $logInAction->activity_data = ['initiating_url' => $request->input('initiating_url'), 'event_id' => $request->input('event_id'), 'attendee_id' => $attendee->id];
          $logInAction->user_agent = $request->header('User-Agent');
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
          ]);
        }
        else {

          // No event found
          return response()->json([
            'status' => 'failed',
            'code' => 'invalid-event-id',
            'message' => 'Invalid Event ID'
          ]);

        }
      }
    }
}
