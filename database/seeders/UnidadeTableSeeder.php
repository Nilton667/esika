<?php

namespace Database\Seeders;

use App\Models\{
    Unidade
};
use Illuminate\Database\Seeder;

class UnidadeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    Unidade::create([
            'nome' => 'Faculdade de Ciências Naturais',
            'telefone'=>'943554433',
            'email' => 'fc@gmail.com',
            'endereco'=>'Camama,entrada do hotel futila'
        ]);
    }
}
