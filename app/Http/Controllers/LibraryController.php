<?php

namespace App\Http\Controllers;

use App\Http\Resources\LibraryResource;
use App\Models\Library;
use App\Http\Requests\StoreLibraryRequest;
use App\Http\Requests\UpdateLibraryRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class LibraryController extends Controller
{
    public function getDownloadBooks()
    {
        $library = Library::where([['user_id', '=', Auth::id()], ['is_download', '=', 1]])->get();
//        dd($library);
        return response()->json([
            'message' => 'Done',
            'data' => [
                'books ' => LibraryResource::collection($library),
            ],
        ], 200);
    }

    public function getCompletedBooks($id)
    {
        $library = Library::where([['user_id', '=', Auth::id()], ['is_completed', '=', $id]])->get();
//        dd($library);
        return response()->json([
            'message' => 'Done',
            'data' => [
                'books ' => LibraryResource::collection($library),
            ],
        ], 200);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreLibraryRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreLibraryRequest $request)
    {
        $validatedData = $request->validate([
            'user_id' => [
                Rule::unique('libraries')->where(function ($query) use ($request) {
                    return $query->where('book_id', $request->book_id);
                })
            ],
            'book_id' => [
                'required',
                Rule::unique('libraries')->where(function ($query) use ($request) {
                    return $query->where('user_id',Auth::id());
                })
            ]
        ]);

        $lib = Library::create([
            'book_id' => $request->book_id,
            'user_id' => Auth::id(),
            'is_completed' => $request->is_completed,
            'is_download' => $request->is_download,

        ]);

        return response()->json(
            [
                'message' => 'added Successfully',
                    'data' => [LibraryResource::make($lib)],                ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Library $library
     * @return \Illuminate\Http\Response
     */
    public function show(Library $library)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateLibraryRequest $request
     * @param \App\Models\Library $library
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLibraryRequest $request, Library $library)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Library $library
     * @return \Illuminate\Http\Response
     */
    public function destroy(Library $library)
    {
        //
    }
}
