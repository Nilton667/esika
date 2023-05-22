<?php

namespace Database\Seeders;

use App\Models\{
    Unidade
};
use Illuminate\Database\Seeder;

class DepartamentoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $unidade = Unidade::first();

        $unidade->departamento()->create([
            'nome' => 'Ciências da Computação',
            'email' => 'cc@gmail.com',
            'telefone'=>'993000803'
        ]);
    }
}
