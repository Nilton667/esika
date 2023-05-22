<?php

namespace App\Providers;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use App\Models\{
    Permissao,
    User,
};
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     *Verificar várias permissões da função.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);
      
        $permissaos=Permissao::with('funcaos')->get();

        foreach($permissaos as $permissao)
        {
              $gate->define($permissao->nome,function(User $user) use ($permissao){
                    return !! $user->hasPermissao($permissao);
              });

              $gate->before(function(User $user,$ability){
                if($user->hasAnyRoles('Super')){
                    return true; 
                }    
              });
                 
        }
}

}
