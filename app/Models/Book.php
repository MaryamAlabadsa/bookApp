<?php

namespace App\Models;

use ChristianKuri\LaravelFavorite\Traits\Favoriteable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory,Favoriteable;

    protected $fillable = [
        'name',
        'description',
        'writer',
        'image',
        'audio',
        'listening_times',

    ];

    function isFavoritedByUser()
    {
        if (auth()->check()) {
            return  auth()->user()->hasFavorited($this);
        } else {
            return false;
        }
    }

    public function getBookImageLinkAttribute()
    {
        return url('/storage/' . $this->image);
    }

    public function getBookAudioLinkAttribute()
    {
        return url('/storage/' . $this->audio);
    }

    //one book has many records
    public function book_library()
    {
        return $this->hasMany(Library::class);
    }

    public static function boot()
    {
        parent::boot();
//        static::creating(function ($item) {
//            dd('from model class  item creating Successfully ' . $item);
//        });
        static::created(function ($item) {
//            dd('from model class item created Successfully' . $item);
        });
    }
}
