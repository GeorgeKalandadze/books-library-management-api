<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class BookController extends Controller
{
    public function index(Request $request): ResourceCollection
    {
        $books = Book::with('authors');

        if ($request->filled('title')) {
            $title = $request->input('title');
            $books->where('title', 'like', "%$title%");
        }

        if ($request->filled('author_name')) {
            $authorName = $request->input('author_name');
            $books->whereHas('authors', function ($query) use ($authorName) {
                $query->where('first_name', 'like', "%$authorName%")
                    ->orWhere('last_name', 'like', "%$authorName%");
            });
        }

        $filteredBooks = $books->get();

        return BookResource::collection($filteredBooks);
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
        ],201);
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
