<?php

use App\Models\Author;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
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

it('can retrieve list of authors', function () {
    $this->getJson(route('authors.index'))->assertOk();
});

it('can create a new author', function () {
    $authorData = [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'birthdate' => '1990-01-01',
        'email' => 'author@example.com',
    ];

    $this->postJson(route('authors.store'), $authorData)->assertCreated();
});
it('can retrieve an author', function () {
    $author = Author::factory()->create();

    $this->getJson(route('authors.show', ['author' => $author->id]))->assertOk();
});

it('can update an author', function () {
    $author = Author::factory()->create();

    $updatedData = [
        'first_name' => 'Updated First Name',
        'last_name' => 'Updated Last Name',
        'birthdate' => '1990-01-01',
    ];

    $this->putJson(route('authors.update', ['author' => $author->id]), $updatedData)->assertOk();
});

it('can delete an author', function () {
    $author = Author::factory()->create();

    $this->deleteJson(route('authors.destroy', ['author' => $author->id]))->assertStatus(204);
});

