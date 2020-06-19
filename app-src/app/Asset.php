<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asset extends Model
{
    use SoftDeletes;
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $fillable = [
      'workshop_id', 'user_id', 'asset_type', 'name', 'slug', 'asset_data', 'created_at', 'updated_at'
    ];
    //
}
