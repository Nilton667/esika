<?php

namespace Database\Seeders;

use App\Models\{
    Departamento,
    User
};
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departamento = Departamento::first();

        $departamento->users()->create([
            'name' => 'Super Admin',
            'email' => 'super@gmail.com',
            'telefone' => '932000803',
            'genero' => 'M',
            'estado' => true,
            'password' => bcrypt('123456')
        ]);
    }
}
