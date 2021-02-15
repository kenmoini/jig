<?php

namespace App;

use App\Activity;
use Illuminate\Foundation\Auth\User as Authenticatable;

//use Illuminate\Contracts\Auth\MustVerifyEmail;
//use Illuminate\Notifications\Notifiable;

//class User extends Authenticatable implements MustVerifyEmail {
class User extends Authenticatable {
  //use Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'name', 'email', 'password', 'provider', 'provider_id', 'provider_avatar'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
      'password', 'remember_token',
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
      'email_verified_at' => 'datetime',
  ];

  public function getLastLoginAttribute() {
    return Activity::where(['activity_type' => 'login', 'actor_id' => $this->id])->orderBy('created_at', 'desc')->first();
  }

  public function groups() {
      return $this->belongsToMany(Group::class);
  }
}