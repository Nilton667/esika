<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Armario;
use App\Models\Documento;
use App\Models\User;
use App\Models\Visualizacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArmarioController extends Controller
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
         $armarios = Armario::where('departamento_id',auth()->user()->departamento_id)->get();
 
         return view('armarios.index', compact('armarios'));
     }
 
   /**
      * Display a listing of the resource.
      *
      * @return \Illuminate\Http\Response
      */
      public function serie()
      {
          $armarios = Armario::where('departamento_id',auth()->user()->departamento_id)->get();
  
          return view('armarios.serie', compact('armarios'));
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
             'nome' => 'required'
         ],
        [
           'nome'=>'O campo nome é obrigatório'
        ]
        );
 
         $armario = new Armario;
         $armario->nome = $request->input('nome');
         $armario->descricao = $request->input('descricao');
 
         $armario->save();
 
         return redirect('/armarios')->with('success','Armário adicionado com sucesso');
     }
 
     /**
      * Display the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function show($id)
     {
        $docs = Documento::where('armario_id',$id)->get();
         $armarios = Armario::where('departamento_id',$id)->get();
     return view('armarios.documentos',compact('docs','armarios'));
     }
 
     /**
      * Show the form for editing the specified resource.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function edit($id)
     {
         $armario = Armario::findOrFail($id);
 
         return view('armarios.edit',compact('armario'));
     }

     public function open($id)
     {
         $doc = Documento::findOrFail($id);
         $docs = Documento::where('armario_id',$doc->armario_id)->get();
   
         $visualizacao=Visualizacao::where('user_id',auth()->user()->id)->get()->first();
         $users=User::get();
     
 
   if($visualizacao==null and $doc->estado=="Em Execução"){
     $doc->visualizacao++;
     $ver=new Visualizacao();
     $ver->user_id=auth()->user()->id;
     $ver->documento_id=$doc->id;
     $ver->save();
   
 }
        
         
         return view('armarios.verdocumento',compact('doc','users','docs'));
   
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
             'nome' => 'string|required'
             ]);
 
         $armario = Armario::findOrFail($id);
         $armario->nome = $request->input('nome');
         $armario->descricao = $request->input('descricao');
         $armario->save();
 
         return redirect('armarios')->with('success','Armário actualizado com sucesso!');
     }
 
     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy($id)
     {
         $cate = Armario::find($id);
         $cate->delete();
 
         $cate->documentos()->detach();
 
 
         return redirect('/armarios')->with('success','Armário eliminado com sucesso');
     }
 
 
}
