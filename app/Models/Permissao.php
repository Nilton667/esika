<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permissao extends Model
{
    protected $table = 'permissaos';
    protected $fillable = ['nome', 'descricao'];



    /**
     * Get Roles
     */
    public function funcaos()
    {
        return $this->belongsToMany(Funcao::class);
    }
}
