<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Armario extends Model
{
    protected $fillable = ['nome', 'descricao','departamento_id'];


     /**
     * Obter os documentos pertecentes ao departamento
    */

    public function documentos()
    {
        return $this->hasMany(Documento::class);
    }

    
}
