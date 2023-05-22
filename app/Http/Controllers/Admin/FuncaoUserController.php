<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Funcao;
use App\Models\User;
use Illuminate\Http\Request;

class FuncaoUserController extends Controller
{
    protected $user, $funcao;

    public function __construct(User $user, Funcao $funcao)
    {
        $this->user = $user;
        $this->funcao = $funcao;

    }

    public function funcaos($idUser)
    {
        $user = $this->user->find($idUser);
        // dd($user);
        if (!$user) {
            return redirect()->back();
        }
       
        $funcaos = $user->funcaos()->paginate();

        return view('users.funcaos.funcaos', compact('user', 'funcaos'));
    }


    public function users($idFuncao)
    {
        if (!$funcao = $this->funcao->find($idFuncao)) {
            return redirect()->back();
        }

        $users = $funcao->users()->paginate();

        return view('admin.pages.funcaos.users.users', compact('funcao', 'users'));
    }


    public function funcaosAvailable(Request $request, $idUser)
    {
        if (!$user = $this->user->find($idUser)) {
            return redirect()->back();
        }

        $filters = $request->except('_token');

        $funcaos = $user->funcaosAvailable($request->filter);
    
        return view('users.funcaos.available', compact('user', 'funcaos'));
    }


    public function attachFuncaosUser(Request $request, $idUser)
    {
        if (!$user = $this->user->find($idUser)) {
            return redirect()->back();
        }
        if (!$request->funcaos || count($request->funcaos) == 0) {
            return redirect()
                        ->back()
                        ->with('info', 'Precisa escolher pelo menos uma funcão');
        }

        $user->funcaos()->attach($request->funcaos);
        
        return redirect()->route('users.funcaos', $user->id);
    }

    public function detachFuncaoUser($idUser, $idFuncao)
    {
        $user = $this->user->find($idUser);
        $funcao = $this->funcao->find($idFuncao);

        if (!$user || !$funcao) {
            return redirect()->back();
        }

        $user->funcaos()->detach($funcao);

        return redirect()->route('users.funcaos', $user->id);
    }

}
