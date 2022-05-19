<?php

namespace App;

use ChristianKuri\LaravelFavorite\Traits\Favoriteable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes,Favoriteable;

    protected $fillable = [
        'name',
        'description',
        'writer',
        'image',
        'audio',
    ];

    public function favorite()
    {
        return $this->belongsTo(favorite::class);
    }

    public function library()
    {
        return $this->belongsTo(Library::class);
    }

    public function downloded()
    {
        return $this->belongsTo(Download::class);
    }

}
