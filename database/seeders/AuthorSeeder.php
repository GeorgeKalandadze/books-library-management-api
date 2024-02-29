<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        DB::table('authors')->insert([
            [
                'first_name' => 'Stephen',
                'last_name' => 'King',
                'birthdate' => '1947-09-21',
            ],
            [
                'first_name' => 'J.K.',
                'last_name' => 'Rowling',
                'birthdate' => '1965-07-31',
            ],
            [
                'first_name' => 'J.R.R.',
                'last_name' => 'Tolkien',
                'birthdate' => '1892-01-03',
            ],
            [
                'first_name' => 'Agatha',
                'last_name' => 'Christie',
                'birthdate' => '1890-09-15',
            ],
            [
                'first_name' => 'George',
                'last_name' => 'Orwell',
                'birthdate' => '1903-06-25',
            ],
        ]);
    }
}
