<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    $this->call([
      ProjectSeeder::class,
      ServiceSeeder::class,
      ClientSeeder::class,
    ]);

    User::create([
      "full_name" => "Rajan Dotel",
      "user_name" => "rajandotel",
      "email" => "rajan.dotel11@gmail.com",
      "password" => bcrypt('password'),
      "role" => "admin",
    ]);
    User::create([
      "full_name" => "Minesh Ratna Tamrakar",
      "user_name" => "mineshtamrakar",
      "email" => "minesh@resilientstructures.com.np",
      "password" => bcrypt('password'),
      "role" => "admin",
      // "photo_url"=>"1714983663_bipin.jpg",
    ]);
    User::create([
      "full_name" => "Rohan Napit",
      "user_name" => "rohannn",
      "email" => "rohan.napit@gmail.com",
      "password" => bcrypt('password'),
      "role" => "editor",
    ]);
  }
}
