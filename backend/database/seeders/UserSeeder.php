<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@email.com',
            'photo' => '',
            'role_id' => Role::firstWhere('slug', 'admin')->id,
            'password' => bcrypt('admin'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'name' => 'Vinicius',
            'email' => 'vinicius@email.com',
            'photo' => '',
            'role_id' => Role::firstWhere('slug', 'employee')->id,
            'password' => bcrypt('vinicius'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('users')->insert([
            'name' => 'João da Silva',
            'email' => 'joao@email.com',
            'photo' => '',
            'role_id' => Role::firstWhere('slug', 'employee')->id,
            'password' => bcrypt('joao'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
