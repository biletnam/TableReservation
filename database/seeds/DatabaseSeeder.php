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

      //create default roles
      $role = App\Role::create(['name'=>'admin']);
      App\Role::create(['name'=>'staff']);
      //create default admin login
      $user = App\User::create([
        'name'=>'admin',
        'email'=>'admin@localhost',
        'password'=>bcrypt('admin')
      ]);
      DB::table('role_user')->insert([
        'user_id'=>$user->id,
        'role_id'=>$role->id,
        'created_at'=>date_create('now'),
        'updated_at'=>date_create('now')
      ]);

      //create default hours of openssl_get_cert_locations
      App\Hours::create(['day'=>'0', 'open'=>'09:00:00', 'close'=>'21:00:00']);
      App\Hours::create(['day'=>'2', 'open'=>'09:00:00', 'close'=>'21:00:00']);
      App\Hours::create(['day'=>'1', 'open'=>'00:00:00', 'close'=>'00:00:00', 'opened'=>false]);
      App\Hours::create(['day'=>'3', 'open'=>'09:00:00', 'close'=>'21:00:00']);
      App\Hours::create(['day'=>'4', 'open'=>'09:00:00', 'close'=>'21:00:00']);
      App\Hours::create(['day'=>'5', 'open'=>'09:00:00', 'close'=>'21:00:00']);
      App\Hours::create(['day'=>'6', 'open'=>'09:00:00', 'close'=>'21:00:00']);

    }
}
