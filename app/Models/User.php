<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function notice()
    {
      return $this->hasMany('App\Models\Notice');
    }

    public function roles()
    {
       return $this->belongsToMany('App\Models\Role');
    }

}
