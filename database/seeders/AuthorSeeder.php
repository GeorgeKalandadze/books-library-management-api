<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $authors = [
            [
                'first_name' => 'Erich Maria',
                'last_name' => 'Remarque',
                'birthdate' => '1898-06-22',
            ],
            [
                'first_name' => 'Jane',
                'last_name' => 'Austen',
                'birthdate' => '1775-12-16',
            ],
            [
                'first_name' => 'Leo',
                'last_name' => 'Tolstoy',
                'birthdate' => '1828-09-09',
            ],
            [
                'first_name' => 'Fyodor',
                'last_name' => 'Dostoevsky',
                'birthdate' => '1821-11-11',
            ],
            [
                'first_name' => 'Gabriel',
                'last_name' => 'García Márquez',
                'birthdate' => '1927-03-06',
            ],
            // Add more authors as needed
        ];

        foreach ($authors as $authorData) {
            Author::create($authorData);
        }
    }
}
