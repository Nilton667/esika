<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name', 'email','genero','password','estado', 'departamento_id','telefone','imagem'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    

    /**
     * Departamento
     */
    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }

    /**
     * Get Roles
     */
    public function documentos()
    {
        return $this->belongsToMany(Documento::class);
    }

    /**
     * Obter Funcaos
     */
    public function funcaos()
    {
        return $this->belongsToMany(Funcao::class);
    }

     /**
     * Obter as permissões
     */ 

     Public function hasPermissao(Permissao $permissao)
     {
        return $this->hasAnyRoles($permissao->funcaos);
     }

     /**
     * Obter a funcao do funcionário
     */ 

     Public function hasAnyRoles($funcaos)
     {
        if(is_array($funcaos) || is_object($funcaos)){
           
                   return $funcaos->intersect($this->funcaos)->count();
        }
         return $this->funcaos->contains('nome',$funcaos);;
        
     }

    /**
     * Funcaos not linked with this user
     */
    public function funcaosAvailable($filter = null)
    {
        $funcaos = Funcao::whereNotIn('funcaos.id', function($query) {
            $query->select('funcao_user.funcao_id');
            $query->from('funcao_user');
            $query->whereRaw("funcao_user.user_id={$this->id}");
        })
        ->where(function ($queryFilter) use ($filter) {
            if ($filter)
                $queryFilter->where('funcaos.nome', 'LIKE', "%{$filter}%");
        })
        ->paginate();

        return $funcaos;
    }

         /**
     * Documents not linked with this user
     */
    public function documentosAvailable($filter = null)
    {
        $documents = Documento::whereNotIn('documentos.id', function($query) {
            $query->select('documento_user.documento_id');
            $query->from('documento_user');
            $query->whereRaw("documento_user.user_id={$this->id}");
        })
        ->where(function ($queryFilter) use ($filter) {
            if ($filter)
                $queryFilter->where('documento.nome', 'LIKE', "%{$filter}%");
        })
        ->paginate();

        return $documents;
    }

    
}
