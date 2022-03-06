<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class downloded extends Model
{

    public function  book(){
        return $this->hasMany(book::class);
    }
    public function  user(){
        return $this->hasMany(user::class);
    }
}
