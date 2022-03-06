<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class book extends Model
{

    public function favorite(){
        return $this ->belongsTo(favorite::class);
    }

    public function library(){
        return $this ->belongsTo(library::class);
    }

    public function downloded(){
        return $this ->belongsTo(downloded::class);
    }


}
