<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Workshop extends Model
{
  use SoftDeletes;
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'user_id', 'name', 'slug', 'curriculum_slug', 'curriculum_endpoint', 'typical_length_in_hours', 'description', 'created_at', 'updated_at'
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

  public function assets() {
    return $this->hasMany('App\Asset', 'workshop_id');
  }

  public function getBaseDomainAttribute() {
    $url = parse_url($this->curriculum_endpoint);
    return $url['host'];
  }

  public function getWorkshopPathAttribute() {
    $url = parse_url($this->curriculum_endpoint);
    $str = str_replace($url['scheme'] . '://', '', $this->curriculum_endpoint);
    $str = str_replace($url['host'], '', $str);
    if (substr($str, -1) === "/") {
      $str = $str . $this->curriculum_slug;
    }
    else {
      $str = $str . '/' . $this->curriculum_slug;
    }
    if (substr($str, -1) === "/") {
      return $str;
    }
    else {
      return $str . '/';
    }
  }
}
