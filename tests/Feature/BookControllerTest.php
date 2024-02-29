<?php

use App\Models\Author;
use App\Models\Book;
use App\Models\Role;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

beforeEach(function () {
    $adminRole = Role::where('name', 'admin')->first();

    if (!$adminRole) {
        $adminRole = Role::create(['name' => 'admin']);
    }

    $user = User::factory()->create();

    $user->role()->associate($adminRole);
    $user->save();

    Sanctum::actingAs($user);
});

it('can list books', function () {
    $books = Book::factory()->count(3)->create();

    $response = $this->get(route('books.index'));

    $response
        ->assertStatus(200)
        ->assertJsonCount(3, 'data')
        ->assertJsonStructure(['data' => [['id', 'title', 'status', 'publish_date', 'authors', 'created_at', 'updated_at']]]);
});

it('can create a book', function () {
    $author = Author::factory()->create();

    $bookData = Book::factory()->make(['authors' => [$author->id]])->toArray();

    $response = $this->post(route('books.store'), $bookData);
    $response
        ->assertStatus(201);
});

it('can show a book', function () {
    $book = Book::factory()->create();

    $response = $this->get(route('books.show', $book));

    $response
        ->assertStatus(200);

});

it('can update a book', function () {
    $book = Book::factory()->create();
    $author = Author::factory()->create();

    $updatedBookData = Book::factory()->make(['authors' => [$author->id]])->toArray();

    $response = $this->put(route('books.update', $book), $updatedBookData);

    $response
        ->assertStatus(200);
});

it('can delete a book', function () {
    $book = Book::factory()->create();

    $response = $this->delete(route('books.destroy', $book));

    $response
        ->assertStatus(200)
        ->assertJson(['message' => 'Book deleted successfully']);

    $this->assertDatabaseMissing('books', ['id' => $book->id]);
});
