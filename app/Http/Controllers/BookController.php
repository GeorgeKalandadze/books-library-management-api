<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function store(BookRequest $request): JsonResponse
    {
        $book = Book::create($request->validated());
        $book->authors()->attach($request->validated('authors'));
        $book->load('authors');

        return response()->json([
            'message' => 'Book created successfully',
        ]);
    }

    public function update(BookRequest $request, Book $book): JsonResponse
    {

        $book->update($request->validated());
        $book->authors()->sync($request->validated('authors'));
        $book->load('authors');

        return response()->json([
            'message' => 'Book updated successfully',
        ]);
    }

    public function destroy(Book $book): JsonResponse
    {
        $book->authors()->detach();
        $book->delete();

        return response()->json([
            'message' => 'Book deleted successfully',
        ]);
    }
}
