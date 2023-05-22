<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $table = 'documentos';
    
    protected $fillable = ['nome','referencia','origem','armario_id','ficheiro','tamanho','tipoficheiro','estado','visualizacao','departamento_id'];
  
  
    /**
     * Obter todos os Funcionários
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

     /**
     * Armários
     */
    public function armario()
    {
        return $this->belongsTo(Armario::class);
    }

    public function usersAvailable($filter = null)
    {
        $users = User::where('departamento_id',auth()->user()->departamento_id)->whereNotIn('users.id', function($query) {
            $query->select('documento_user.user_id');
            $query->from('documento_user');
            $query->whereRaw("documento_user.documento_id={$this->id}");
        })
        ->where(function ($queryFilter) use ($filter) {
            if ($filter)
                $queryFilter->where('users.name', 'LIKE', "%{$filter}%");
        })
        ->get();

        return $users;
    }

    public function usersAvailabled($filter = null)
    {
        $users = User::where('departamento_id',auth()->user()->departamento_id)->whereNotIn('users.id', function($query) {
            $query->select('documento_user.user_id');
            $query->from('documento_user');
            $query->whereRaw("documento_user.documento_id={$this->id}");
        })
        ->where(function ($queryFilter) use ($filter) {
            if ($filter)
                $queryFilter->where('users.name', 'LIKE', "%{$filter}%");
        })
        ->get();

        return $users;
    }
}

