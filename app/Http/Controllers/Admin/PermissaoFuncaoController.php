<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Funcao;
use App\Models\Permissao;
use Illuminate\Http\Request;

class PermissaoFuncaoController extends Controller
{
    protected $funcao, $permissao;

    public function __construct(Funcao $funcao, Permissao $permissao)
    {
        $this->funcao = $funcao;
        $this->permissao = $permissao;

    }

    public function permissaos($idFuncao)
    {
        $funcao = $this->funcao->find($idFuncao);

        if (!$funcao) {
            return redirect()->back();
        }

        $permissaos = $funcao->permissaos()->paginate();

        return view('funcaos.permissaos.permissaos', compact('funcao', 'permissaos'));
    }


    public function funcaos($idPermissao)
    {
        if (!$permissao = $this->permissao->find($idPermissao)) {
            return redirect()->back();
        }

        $funcaos = $permissao->funcaos()->all();

        return view('permissaos.funcaos.funcaos', compact('permissao', 'funcaos'));
    }


    public function permissaosDisponiveis(Request $request, $idFuncao)
    {
        if (!$funcao = $this->funcao->find($idFuncao)) {
            return redirect()->back();
        }

        $filters = $request->except('_token');
        $permissaos = $funcao->permissaosDisponiveis($request->filter);
       // dd($permissaos);

        return view('funcaos.permissaos.available', compact('funcao', 'permissaos', 'filters'));
    }


    public function attachPermissaosFuncao(Request $request, $idFuncao)
    {
        if (!$funcao = $this->funcao->find($idFuncao)) {
            return redirect()->back();
        }

        if (!$request->permissaos || count($request->permissaos) == 0) {
            return redirect()
                        ->back()
                        ->with('error', 'Precisa escolher pelo menos uma permissão');
        }

        $funcao->permissaos()->attach($request->permissaos);

        return redirect()->route('funcaos.permissaos', $funcao->id);
    }

    public function detachPermissaoFuncao($idFuncao, $idPermissao)
    {
        $funcao = $this->funcao->find($idFuncao);
        $permissao = $this->permissao->find($idPermissao);

        if (!$funcao || !$permissao) {
            return redirect()->back();
        }

        $funcao->permissaos()->detach($permissao);

        return redirect()->route('funcaos.permissaos', $funcao->id);
    } 

}
