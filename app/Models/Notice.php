<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
  
  protected $fillable=['title','content','expire_at','priority','published_on','user_id',];
  protected $dates=['expire_at','created_at','updated_at',];
  public function users()
  {
    return  $this->belongsTo('App\Models\User');
  }
}
