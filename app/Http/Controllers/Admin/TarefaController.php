<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tarefa;
use Illuminate\Http\Request;

class TarefaController extends Controller
{
    public function index(){

    }

    public function store(Request $request){
        $this->validate($request, [
            'descricao' => 'required',
            'documento_id' => 'required',
            'user_id' => 'required',
            'data_limite' => 'required',
            'prioridade' => 'required',
          ]);

         $tarefa = new Tarefa;
         
         $tarefa->documento_id = $request->input('documento_id');
         $tarefa->user_id = $request->input('user_id');
         $tarefa->descricao = $request->input('descricao');
         $tarefa->data_limite = $request->input('data_limite');
         $tarefa->prioridade = $request->input('prioridade');
 
         $tarefa->save();
 
          return redirect()->back()->with('success','Despacho feito com sucesso!!');
    }
}
