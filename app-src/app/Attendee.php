<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendee extends Model
{
  protected $table = 'event_attendees';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['event_id', 'seat_number', 'seat_state', 'student_name_id', 'previous_student_name_ids', 'created_at', 'updated_at'];

  public function student() {
    return $this->belongsTo('App\StudentName', 'student_name_id');
  }

  public function event() {
    return $this->belongsTo('App\Event', 'event_id');
  }

  public function getCurrentSeatStateAttribute() {
    switch ($this->seat_state) {
      case "0":
        return "Available";
      break;
      case "1":
        return "Claimed";
      break;
      case "2":
        return "Tainted";
      break;
    }
  }
}