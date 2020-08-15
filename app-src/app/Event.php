<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
  use SoftDeletes;
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */

  protected $fillable = [
    'user_id', 'workshop_id', 'event_title', 'description', 'private_notes', 'start_time', 'end_time', 'event_id', 'seat_count', 'effective_asset_data', 'created_at', 'updated_at', 'location', 'privacy_level', 'passcode'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [];
  protected $dates = ['start_time', 'end_time'];

  public function user() {
    return $this->belongsTo('App\User', 'user_id');
  }

  public function workshop() {
    return $this->belongsTo('App\Workshop', 'workshop_id');
  }
  public function getStatusClassAttribute() {
    $now = Carbon::now();

    if ($this->start_time < $now) {
      if ($this->end_time < $now) {
        return 'prev';
      }
      return 'ongoing';
    }
    else {
      return 'upcoming';
    }
  }
  public function getStatusDescriptionAttribute() {
    $now = Carbon::now();

    if ($this->start_time < $now) {
      if ($this->end_time < $now) {
        return 'Expired/Previous Event';
      }
      return 'Currently Ongoing Event';
    }
    else {
      return 'Upcoming Future Event';
    }
  }
  public function getPrivacyDescriptionAttribute() {
    switch($this->privacy_level) {
      case "1":
        return "Public, Passcode Protected";
      break;
      case "2":
        return "Private, Event ID entry only";
      break;
      case "0":
      default:
        return "Public";
      break;
      // 0 = Public, 1 = Passcode Protected, 2 = Private, entry by event ID only
    }
  }
  public function getStartTimeLongAttribute() {
    return $this->start_time->format('Y-m-d H:i:s');
  }
  public function getEndTimeLongAttribute() {
    return $this->end_time->format('Y-m-d H:i:s');
  }
}
