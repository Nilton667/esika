<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $fillable = ['nome','email','telefone','unidade_id'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
 
    /**
     * Obter os documentos pertecentes ao departamento
    */

    public function documentos()
    {
        return $this->hasMany(Documento::class);
    }

    /**
     * Obter a Unidade
     */
    
    public function unidade()
    {
        return $this->belongsTo(Unidade::class);
    }


    

}
