<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Armario;
use App\Models\Documento;
use App\Models\Ficheiro;
use App\Models\User;
use App\Models\Visualizacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\isNull;

class DocumentosController extends Controller
{
  protected $user, $document;

  public function __construct(User $user, Documento $document)
    {
        $this->user = $user;
        $this->document = $document;
        return $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      if (auth()->user()->hasAnyRoles('Super'))
      {
         $docs = Documento::where('estado','Geral')->get();
        // $contDoc=$docs->count();
         $armarios = Armario::get();
      }
      else
      {
          
          $docs = Documento::where('estado','Geral')->where('departamento_id',auth()->user()->departamento_id)->get();
         // $contDoc=$docs->count();
          $armarios = Armario::where('departamento_id',auth()->user()->departamento_id)->get();
      }   

      return view('documentos.index',compact('docs','armarios'));
  }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $armarios = Armario::all();

        return view('documentos.create',compact('armarios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    //  dd($request->all());
      $this->validate($request, [
        'nome' => 'required|string|max:255',
        'origem' => 'required|string|max:255',
        'referencia' => 'required|string|max:255',
        'armario_id' => 'required',
        'ficheiro' => 'required|max:50000',
      ]);

        if ($request->hasFile('ficheiro') && $request->ficheiro->isValid()) {

          $fileNameWithExt = $request->file('ficheiro')->getClientOriginalName();
         
          $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        
          $extension = $request->file('ficheiro')->getClientOriginalExtension();
          $fileNameToStore = $filename.'_'.time().'.'.$extension;
        
          $path = $request->ficheiro->storeAs('documentos', $fileNameToStore);
      }

        $doc = new Documento;
        $doc->nome = $request->input('nome');
        $doc->origem = $request->input('origem');
        $doc->referencia = $request->input('referencia');
        $doc->armario_id =$request->input('armario_id');
        $doc->departamento_id =$request->input('departamento_id');
        $doc->visualizacao = 0;
        $doc->ficheiro = $path;
        $doc->estado = "Geral";
        $doc->tipoficheiro = Storage::mimeType($path);
        $size = Storage::size($path);
        if ($size >= 1000000) {
          $doc->tamanho = round($size/1000000) . 'MB';
        }elseif ($size >= 1000) {
          $doc->tamanho = round($size/1000) . 'KB';
        }else {
          $doc->tamanho = $size;
        }
       
        $doc->save();

        return redirect('/documentos')->with('success','Ficheiro carregado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $doc = Documento::find($id)->first();
       
        return view('documentos.show',compact('doc'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $doc = Documento::findOrFail($id);
        $armarios = Armario::all();

        return view('documentos.edit',compact('doc','armarios'));
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
      $actualiza=0;
      $this->validate($request, [
        'nome' => 'required|string|max:255',
        'origem' => 'required|string|max:255',
        'referencia' => 'required|string|max:255',
        'armario_id' => 'required',
        'ficheiro' => 'required|max:50000',
      ]);

    
      if ($request->hasFile('ficheiro') && $request->ficheiro->isValid()) {

        $fileNameWithExt = $request->file('ficheiro')->getClientOriginalName();
       
        $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
      
        $extension = $request->file('ficheiro')->getClientOriginalExtension();
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
      
        $path = $request->ficheiro->storeAs('documentos', $fileNameToStore);
        $actualiza=1;
    }

        $doc = Documento::findOrFail($id);
        $doc->nome = $request->input('nome');
        $doc->origem = $request->input('origem');
        $doc->referencia = $request->input('referencia');
        $doc->armario_id =$request->input('armario_id');
        $doc->departamento_id =$request->input('departamento_id');
        if($actualiza!=0){
      
        $doc->ficheiro = $path;
        $doc->tipoficheiro = Storage::mimeType($path);
        $size = Storage::size($path);
        if ($size >= 1000000) {
          $doc->tamanho = round($size/1000000) . 'MB';
        }elseif ($size >= 1000) {
          $doc->tamanho = round($size/1000) . 'KB';
        }else {
          $doc->tamanho = $size;
        }
      }
        $doc->save();


        return redirect('/documentos')->with('success','Actualizado com sucesso!');
    }

       /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function concluir(Request $request)
    {
        $ficheiro=new Ficheiro();
        $doc = Documento::findOrFail($request->documento_id);
        $doc->estado ="Finalizado";
        $doc->save();

        $ficheiro->documento_id=$request->input('documento_id');
        if ($request->hasFile('ficheiro_final') && $request->ficheiro_final->isValid()) {

          if (Storage::exists($ficheiro->ficheiro_final)) {
            Storage::delete($ficheiro->ficheiro_final);
        }

        $ficheiro->ficheiro_final = $request->ficheiro_final->store("documentos/finalizados");
      }

      $ficheiro->save();

        return redirect()->back()->with('success','Documento Finalizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $doc = Documento::findOrFail($id);
        // delete the file on disk
    //    Storage::delete($doc->file);
        // delete db record
        $doc->delete();

        return redirect('/documentos')->with('success','Eliminado!');
    }


   
    public function open($id)
    {
        $doc = Documento::findOrFail($id);
        $docs = Documento::get();
  
        $visualizacao=Visualizacao::where('user_id',auth()->user()->id)->get()->first();
        $users=User::get();
    

  if($visualizacao==null and $doc->estado=="Em Execução"){
    $doc->visualizacao++;
    $ver=new Visualizacao();
    $ver->user_id=auth()->user()->id;
    $ver->documento_id=$doc->id;
    $ver->save();
  
}
       
        
        return view('documentos.verdocumento',compact('doc','users'));
  
    }

    public function tram($id)
    {
        $doc = Documento::findOrFail($id);
        $docs = Documento::get();
        $contDoc=$docs->count();
        $visualizacao=Visualizacao::where('user_id',auth()->user()->id)->get()->first();
        $users=User::get();
    

  if($visualizacao==null and $doc->estado=="Em Execução"){
    $doc->visualizacao++;
    $ver=new Visualizacao();
    $ver->user_id=auth()->user()->id;
    $ver->documento_id=$doc->id;
    $ver->save();
  
}
       
        
        return view('documentos.verdocumento1',compact('doc','contDoc','users'));

    }



    public function search(Request $request)
    {
        $this->validate($request,[
          'search' => 'required|string'
        ]);

        $srch = strtolower($request->input('search'));
        $names = Documento::pluck('nome')->all();
        $results = [];

        for ($i=0; $i < count($names); $i++) {
          $lower = strtolower($names[$i]);
          if (strpos($lower, $srch) !== false) {
            $results[$i] = Documento::where('nome', $names[$i])->get();
          }
        }

        return view('documentos.results', compact('results'));
    }

    // sorting
    public function sort(Request $request)
    {
        $tipoficheiro = $request->input('tipoficheiro');
        
        $docs = Documento::where('tipoficheiro',$tipoficheiro)->get();
        //dd($docs);
        return view('documentos.index', compact('docs', 'tipoficheiro'));
    }

    public function trash()
    {
      $docs = Documento::withTrashed()->where('isExpire',1)->get();
      $today = Date('Y-m-d');

      foreach ($docs as $d) {
        if ($today > $d->expires_at) {
          $maketrash = Documento::findOrFail($d->id);
          $maketrash->isExpire = 2;
          $maketrash->save();
        }
      }
 
      $user = auth()->user();
        $trash = Documento::withTrashed()->where('deleted_at','!=','null')->orWhere('isExpire',2)->get();

      return view('documentos.trash', compact('trash'));
    }

    public function restore($id)
    {
      $restoreDoc = Documento::withTrashed()->findOrFail($id);
      if($restoreDoc->deleted_at!=null){
        Documento::withTrashed()->find($id)->restore();
      }else{
        $restoreDoc->isExpire = 0;
        $restoreDoc->expires_at = null;
        $restoreDoc->save();
      }

      return redirect()->back()->with('success','Restaurado com sucesso!');
    }

    



}
