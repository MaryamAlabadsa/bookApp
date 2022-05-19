<?php

namespace App\Http\Controllers;



use App\Book;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function addToFav($id){
        $book = Book::find($id);
        $book->addFavorite(); // auth user added to favorites this post
//        $book->toggleFavorite(); // auth user toggles the favorite status from this post
    }

    public function removeFromFav($id){
        $book = Book::find($id);
        $book->removeFavorite(); // auth user removed from favorites this post
    }

    public function  userFavoriteLists(){
        $user = Auth::user();
        $user->favorite(Book::class); // returns a collection with the Posts the User marked as favorite
    }
}
