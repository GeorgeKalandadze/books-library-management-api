<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorRequest;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorController extends Controller
{
    public function index(): ResourceCollection
    {
        $authors = Author::all();
        return AuthorResource::collection($authors);
    }

    public function store(AuthorRequest $request): JsonResponse
    {
        $author = Author::create($request->validated());
        return response()->json(['message' => 'Author created successfully.'], 201);
    }

    public function show(Author $author): JsonResource
    {
        return new AuthorResource($author);
    }

    public function update(AuthorRequest $request, Author $author): JsonResponse
    {
        $author->update($request->validated());
        return response()->json(['message' => 'Author updated successfully.']);
    }

    public function destroy(Author $author): JsonResponse
    {
        $author->delete();
        return response()->json(['message' => 'Author deleted successfully.'], 204);
    }
}
