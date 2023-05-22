<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Departamento;
use App\Models\Unidade;
use Illuminate\Http\Request;

class DepartamentosController extends Controller
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
         $departamentos = Departamento::all();
         $unidades = Unidade::all();
 
         return view('departamentos.index',compact('departamentos','unidades'));
     }
 
     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create()
     {
         //
     }
 
     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store(Request $request)
     {

        $this->validate($request, [
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:departamentos',
            'telefone' => 'required|string|max:14',
            'unidade_id' => 'required',
          ]);

         $dept = new Departamento;
         $dept->nome = $request->input('nome');
         $dept->email = $request->input('email');
         $dept->telefone = $request->input('telefone');
         $dept->unidade_id = $request->input('unidade_id');
 
         $dept->save();
 
          return redirect('/departamentos')->with('success','Departamento Adicionado com sucesso');
     }
 
     /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function show($id)
     {
         //
     }
 
     /**
      * Show the form for editing the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function edit($id)
     {
         $dept = Departamento::findOrFail($id);
         $unidades = Unidade::all();
         return view('departamentos.edit',compact('dept','unidades'));
     }
 
     /**
      * Update the specified resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function update(Request $request, $id)
     {
         $this->validate($request, [
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'telefone' => 'required|string|max:14',
            'unidade_id' => 'required',
         ]);
 
         $dept = Departamento::findOrFail($id);
         $dept->nome = $request->input('nome');
         $dept->email = $request->input('email');
         $dept->telefone = $request->input('telefone');
         $dept->unidade_id = $request->input('unidade_id');
         $dept->save();
 
 
         return redirect('/departamentos')->with('success','Departamento actualizado com sucesso');
     }
 
     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy($id)
     {
         $dept = Departamento::find($id);
         $dept->delete();
         return redirect('/departamentos')->with('success','Departamento eliminado com sucesso');
     }
 
}
