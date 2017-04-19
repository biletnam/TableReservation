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
      //factory(App\Hours::class, 7)->create();
      App\Hours::create(['day'=>'0', 'open'=>'09:00:00', 'close'=>'21:00:00']);
      App\Hours::create(['day'=>'2', 'open'=>'09:00:00', 'close'=>'21:00:00']);
      App\Hours::create(['day'=>'1', 'open'=>'00:00:00', 'close'=>'00:00:00', 'opened'=>false]);
      App\Hours::create(['day'=>'3', 'open'=>'09:00:00', 'close'=>'21:00:00']);
      App\Hours::create(['day'=>'4', 'open'=>'09:00:00', 'close'=>'21:00:00']);
      App\Hours::create(['day'=>'5', 'open'=>'09:00:00', 'close'=>'21:00:00']);
      App\Hours::create(['day'=>'6', 'open'=>'09:00:00', 'close'=>'21:00:00']);

    }
}
