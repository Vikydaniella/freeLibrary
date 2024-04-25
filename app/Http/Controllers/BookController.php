<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Helpers\HttpStatus;
use App\Http\Requests\BookRequest;
use App\Http\Resources\BookResource;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        {
            return BookResource::collection(Book::all());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\BookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookRequest $request)
    {
        $book = Book::firstOrCreate([
            'id' => $request->id,
            'name' => $request->name,
            'description' => $request->description,
            'published_date' => $request->published_date,
            'status' => $request->status,
            'no_of_pages' => $request->no_of_pages,
            'author_id' => $request->author()->id
        ]);
        if ($book) {
            return response()->json([
                'status' => HttpStatus::SUCCESS_CREATED,
                'message' => 'Book created successfully',
                'data' => $book
            ]);
        }  
            return response()->json([
                'status' => HttpStatus::UNPROCESSABLE_ENTITY,
                'message' => 'Can not create book'
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book, $id)
    {
        $book = Book::find($id);
       if($book){
            return response()->json([
            'status' => HttpStatus::SUCCESS_CREATED,
            'message' => 'Successful',
            'data' => $book,
            ]);
        }
        return response()->json([
            'status' => HttpStatus::UNPROCESSABLE_ENTITY,
            'message' => 'Can not see the book'
        ]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBookRequest  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(BookRequest $request, $id)
    {
        $book = Book::find($id);
        if($book){
        $book->update([
            'id' => $request->id,
            'name' => $request->name,
            'description' => $request->description,
            'published_date' => $request->published_date,
            'status' => $request->status,
            'no_of_pages' => $request->no_of_pages,
            'author_id' => $request->author()->id
        ]);
            return response()->json([
                'status' => HttpStatus::SUCCESS_CREATED,
                'message' => 'Book updated successfully',
                'data' => $book
            ]);
        }  
            return response()->json([
                'status' => HttpStatus::UNPROCESSABLE_ENTITY,
                'message' => 'Can not update the book'
            ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book, $id)
    {
        $book = Book::find($id);
        if ($book){
        $book->delete();
            return response()->json([
                'status' => HttpStatus::SUCCESS_CREATED,
                'message' => 'Book deleted successfully',
                'data' => $book
            ]);
        }  
            return response()->json([
                'status' => HttpStatus::UNPROCESSABLE_ENTITY,
                'message' => 'Can not delete book'
            ]);
    }
}
