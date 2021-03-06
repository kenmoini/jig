<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
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

    public function groups() {
        return $this->belongsToMany(Group::class);
    }

    public function users() {
        return $this->belongsToMany(User::class);
    }

    public function capabilities() {
        return $this->belongsToMany(Capability::class);
    }

    public function capabilitiesList() {
        $caps = [];
        foreach ($this->capabilities()->get() as $capability) {
            $caps[] = $capability->key;
        }
        return array_unique($caps);
    }
}
