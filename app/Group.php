<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
  public function permissions()
  {
      return $this->hasMany('App\GroupPermission');
  }
}
