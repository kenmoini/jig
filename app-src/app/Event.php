<?php

namespace App;

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
    'user_id', 'workshop_id', 'event_title', 'description', 'private_notes', 'start_time', 'end_time', 'event_id', 'seat_count', 'effective_asset_data', 'created_at', 'updated_at'
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

  public function user() {
    return $this->belongsTo('App\User', 'user_id');
  }

  public function workshop() {
    return $this->belongsTo('App\Workshop', 'workshop_id');
  }
}
