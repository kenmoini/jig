<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{

  protected $table = 'activity';
  
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */

  protected $fillable = [
    'activity_type', 'actor_id', 'actor_type', 'activity_data', 'user_agent', 'actor_ip', 'created_at', 'updated_at'
  ];
}
