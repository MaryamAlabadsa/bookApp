<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    public function  book(){
        return $this->hasMany(Book::class);
    }
    public function  user(){
        return $this->hasMany(user::class);
    }}
