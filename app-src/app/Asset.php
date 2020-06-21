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

    public function user() {
      return $this->belongsTo('App\User', 'user_id');
    }

    public function workshop() {
      return $this->belongsTo('App\Workshop', 'workshop_id');
    }

    public function getImportantFactsAttribute() {
      $asset_data = json_decode($this->asset_data, true);

      switch ($this->asset_type) {
        case "cookie":
          return $asset_data['key'] . ' = ' . $asset_data['default_value'];
        break;
        case "credentials":
          return '<a href="' . $asset_data['url'] . '">' . $asset_data['title'] . '</a><br /><span>' . $asset_data['username'] . ' / ' . $asset_data['password'] . '</span>';
        break;
        case "link":
          return '<a href="' . $asset_data['url'] . '">' . $asset_data['title'] . '</a>';
        break;
      }
    }
}
