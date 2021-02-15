<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Capability extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key', 'description', 'created_at', 'updated_at'
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

    public function roles() {
        return $this->belongsToMany(Role::class);
    }
}
