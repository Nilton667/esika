<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Funcao extends Model
{
    protected $table = 'funcaos';
    protected $fillable = ['nome', 'descricao'];


    /**
     * Obter Permissões
     */
    public function permissaos()
    {
        return $this->belongsToMany(Permissao::class);
    }

    /**
     * Obter todos funcionários
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }


    /**
     * Permissão disponiveis para o utilizador
     */
    public function permissaosDisponiveis($filter = null)
    {
        $permissoes = Permissao::whereNotIn('permissaos.id', function($query) {
            $query->select('funcao_permissao.permissao_id');
            $query->from('funcao_permissao');
            $query->whereRaw("funcao_permissao.funcao_id={$this->id}");
        })
        ->where(function ($queryFilter) use ($filter) {
            if ($filter)
                $queryFilter->where('permissaos.nome', 'LIKE', "%{$filter}%");
        })
        ->paginate();

        return $permissoes;
    }
}
