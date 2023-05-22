<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unidade extends Model
{
    protected $fillable = [
        'nome', 'email', 'telefone', 'endereco',
    ];


    public function departamento()
    {
        return $this->hasMany(Departamento::class);
    }

}
