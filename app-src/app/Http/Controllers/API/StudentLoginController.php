<?php

namespace App\Http\Controllers\API;

use App\Activity;
use App\Attendee;
use App\Student;
use App\StudentName;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        $logInAction->activity_data = ['initiating_url' => $request->input('initiating_url')];
        $logInAction->user_agent = $request->header('User-Agent');
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

          // Create Attendee
          $attendee = Attendee::firstOrCreate([ 'event_id' => $event->id, 'student_name_id' => $request->input('student_name_id') ]);

          // Find seat number in attendee stack
          $allCurrentAttendees = Attendee::where('event_id', $event->id)->orderBy('created_at', 'asc')->get();
          $seat_number = 0;
          foreach($allCurrentAttendees as $aTT) {
            if ($aTT->student_name_id === $request->input('student_name_id')) {
              break;
            }
            else {
              $seat_number++;
            }
          }

          // Load event assets from DB
          $assets = $event->effective_asset_data;
          
          // Process variables in assets
          // $processed_assets = $this->processAssetVariables($assets); //nope nvm, do it client side with cookies and HTML data lol

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
              'student_seat_number' => $seat_number,
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
