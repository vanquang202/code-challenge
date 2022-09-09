<?php

namespace Database\Seeders;

use App\Models\CodeLanguage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $dataCreate = [
            // [
            //     "name" => "PHP",
            //     "type" => "php",
            //     "ex" => "php",
            // ],
            // [
            //     "name" => "Javascript",
            //     "type" => "node",
            //     "ex" => "js",
            // ],
            // [
            //     "name" => "Python",
            //     "type" => "py",
            //     "ex" => "py",
            // ],
            // [
            //     "name" => "Java",
            //     "type" => "java",
            //     "ex" => "java",
            // ]
            [
                "name" => "C++",
                "type" => "gcc",
                "ex" => "cpp"
            ],
            [
                "name" => "C",
                "type" => "gcc",
                "ex" => "c"
            ]
        ];
        DB::table("code_language")->insert($dataCreate);
    }
}