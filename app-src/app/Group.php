<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'description', 'created_at', 'updated_at'
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

    public function users() {
        return $this->belongsToMany(User::class);
    }

    public function roles() {
        return $this->belongsToMany(Role::class);
    }

    public function capabilities() {
        return $this->belongsToMany(Capability::class);
    }
}
