<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
     protected $fillable = [
        'title',
    ];
    
    public function user()
    {
        return $this->belongsToMany('App\Models\User');
    }

    public function permission()
    {
      return  $this->belongsToMany('App\Models\Permission');
    }
}
