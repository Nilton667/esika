<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Unidade;
use Illuminate\Http\Request;

class UnidadesController extends Controller
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
         $unidades = Unidade::all();
 
         return view('unidades.index')->with('unidades',$unidades);
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
            'email' => 'required|string|email|max:255|unique:unidades',
            'telefone' => 'required|string|max:14',
            'endereco' => 'required',
          ]);

         $unidade = new Unidade;
         $unidade->nome = $request->input('nome');
         $unidade->email = $request->input('email');
         $unidade->telefone = $request->input('telefone');
         $unidade->endereco = $request->input('endereco');
 
         $unidade->save();
 
         return redirect('/unidades')->with('success','Unidade orgânica Adicionado com sucesso');
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
         $unidade = Unidade::findOrFail($id);
 
         return view('unidades.edit',compact('unidade'));
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
            'endereco' => 'required',
         ]);
 
         $unidade = Unidade::findOrFail($id);
         $unidade->nome = $request->input('nome');
         $unidade->email = $request->input('email');
         $unidade->telefone = $request->input('telefone');
         $unidade->endereco = $request->input('endereco');
         $unidade->save();
 
         return redirect('/unidades')->with('success','Unidade actualizado com sucesso');
     }
 
     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy($id)
     {
         $unidade = Unidade::find($id);

         $unidade->delete();
 
         return redirect('/unidades')->with('success','Unidade eliminado com sucesso');
     }

}
