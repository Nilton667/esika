<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Funcao;
use App\Models\Permissao;
use Illuminate\Http\Request;

class FuncaoController extends Controller
{
    public function __construct() {
        return $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $funcaos = Funcao::where('nome','!=','Super')->get();
       
        $permissaos = Permissao::pluck('nome','id')->all();

        return view('funcaos.index',compact('funcaos','permissaos'));
    }

    /**
     * Mostrar o formulário de cadastro.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Salvar os dados na base de dados.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nome' => 'required|string|max:255|unique:funcaos',
            'descricao' => 'required'
          ]);
  
          $funcao = new Funcao;
          $funcao->nome = $request->input('nome');
          $funcao->descricao = $request->input('descricao');
          $funcao->save();
  
          return redirect('/funcaos')->with('success','Função adicionado com sucesso');
    }

    /**
     * Mostrar Função específica.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Editar uma função específica.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $funcao = Funcao::findOrFail($id);
        $permissaos = Permissao::all();

        return view('funcaos.edit',compact('funcao','permissaos'));
    }

    /**
     * Actualizar uma função específica.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nome' => 'required|max:15|unique:funcaos,nome,'.$id,
            'descricao' => 'required',

        ]);

        $funcao = Funcao::findOrFail($id);

        $input = $request->except(['permissaos']);
        $permissaos = $request['permissaos'];
        $funcao->fill($input)->save();

        return redirect('/funcaos')->with('success','Actualizado com sucesso');

    }

    /**
     * Remover da base de dados a função.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
