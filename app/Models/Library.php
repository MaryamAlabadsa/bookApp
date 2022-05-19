<?php

namespace App\Models;

use ChristianKuri\LaravelFavorite\Test\Models\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Library extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'user_id',
        'is_completed',
        'is_download'
    ];
 
    public function getbooksAttribute()
    {
        return $this->book ? $this->book : null;
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'saved' => Library::class,
        'deleted' => UserDeleted::class,
    ];
}
