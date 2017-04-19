<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(App\Table::class, 5)->create();
      //factory(App\Guest::class, 3)->create();
      factory(App\Reservation::class, 8)->create();
      factory(App\Hours::class, 7)->create();
    }
}
