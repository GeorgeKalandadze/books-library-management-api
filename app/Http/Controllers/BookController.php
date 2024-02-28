<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BookController extends Controller
{

    public function index(): ResourceCollection
    {
        $books = Book::with('authors')->get();
        return BookResource::collection($books);
    }

    public function show(Book $book): JsonResource
    {
        $book->load('authors');
        return new BookResource($book);
    }

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
