<?php

namespace App\Http\Controllers;


use App\Http\Resources\BookCollection;
use App\Http\Resources\BookResource;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function getHomePage()
    {
        $categories = Category::all();
        $most_Listened = Book::orderBy('listening_times', 'desc')->take(10)->get();
        $most_published = Book::orderBy('created_at', 'desc')->take(10)->get();
        return response()->json([
            'message' => 'Done',
            'data' => [
                'categories' =>  CategoryResource::collection($categories),
                'most_Listened ' => BookResource::collection($most_Listened),
                'latest_publication' => BookResource::collection($most_published),
            ],
        ], 200);

    }

    public function getBooksByCategory($type){
        $book  = Book::orderBy($type, 'desc')->paginate(15);
        return response()->json([
            'message' => 'Done',
            'data' => [
                BookResource::collection($book),
            ],
        ], 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return BookCollection
     */
    public function index()
    {
        return new BookCollection(Book::orderBy('created_at',"desc")->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function store(StoreBookRequest $request)
    {
        $book = Book::create([
            'name' => $request->name,
            'description' => $request->description,
            'writer' => $request->writer,
            'image' => $request->image->store('public', 'public'),
            'audio' =>  $request->audio->store('public', 'public'),
        ]);

        return ['message' => 'added Successfully',
            'data' => [BookResource::make($book)],
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Book $book
     * @return array
     */
    public function show(Book $book)
    {

        $book->update(['listening_times' => $book->listening_times+1]);
        return ['message' => 'Successfully',
            'data' => BookResource::make($book),
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateBookRequest $request
     * @param \App\Models\Book $book
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Book $book
     * @return string[]
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return ['message' => ' successfully delete.',
        ];
    }
    public function addToFav($id)
    {
        $book=Book::find($id);
        if ($book){
            Auth::user()->favorite($book);
            return response()->json([
                'message' => 'book favorited successfully',
                'book'=>BookResource::make($book),
            ], 201);
        }else{
            return response()->json([
                'message' => 'book not found',
            ]);
        }

    }
    public function getFav(){
        $recipes  =   Auth::user()->getFavoriteItems(Book::class)->get();

        // return $recipes;
        return response()->json([
            'message' => 'Recipes favorited successfully',
            'data' => BookResource::collection($recipes),
        ], 200);
    }
}
