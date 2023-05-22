<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Armario;
use App\Models\Documento;
use App\Models\User;
use Illuminate\Http\Request;

class DocumentoUserController extends Controller
{
    protected $user, $document;
   
 

    public function __construct(User $user, Documento $document)
    {
        $this->user = $user;
        $this->document = $document;
        return $this->middleware(['auth']);
    }

    public function documentos($idUser)
    {
        $user = $this->user->find($idUser);
      
      
        if (!$user) {
            return redirect()->back();
        }
        
        $documentos = $user->documentos()->paginate();
     
        return view('users.documentos.documentos', compact('user', 'documentos'));
    }

    public function documentoss($idUser)
    {
        if (!$user = $this->user->find($idUser)) {
            return redirect()->back();
        }
       
        $documentos = $user->documentos()->all();

        return view('users.documentos.documentos', compact('user', 'documentos'));
    }



    public function users($idRole)
    {
        if (!$document = $this->document->find($idRole)) {
            return redirect()->back();
        }

        $users = $document->users()->paginate();
        
        return view('documentos.users.users', compact('document', 'users'));
    }


    public function documentosAvailable(Request $request, $idUser)
    {
        
        if (!$user = $this->user->find($idUser)) {
            return redirect()->back();
        }
      
    
        $filters = $request->except('_token');

        $documentos = $user->documentosAvailable($request->filter);
    
        return view('users.documentos.available', compact('user', 'documentos'));
    }

//Função que despacha um documento para um técnico
    public function attachUsersDocument(Request $request, $idDocument)
    {
        if (!$document = $this->document->find($idDocument)) {
            return redirect()->back();
        }
     
        if (!$request->users || count($request->users) == 0) {
            return redirect()
                        ->back()
                        ->with('error', 'Precisa escolher pelo menos um funcionário');
        }

        $document->estado="Em Execução";
        $document->save();
        $document->users()->attach($request->users);

        return redirect()->route('documentos.users', $document->id)->with('success','Funcionário vinculado com sucesso');
    }

    //Função que distribui um documento para um Chefe/Director de um departamento
    public function attachUsersDocumentd(Request $request, $idDocument)
    {
        if (!$document = $this->document->find($idDocument)) {
            return redirect()->back();
        }
     
        if (!$request->users || count($request->users) == 0) {
            return redirect()
                        ->back()
                        ->with('error', 'Precisa escolher pelo menos um funcionário');
        }
           $document->estado="Pendente";
           $document->save();
        $document->users()->where('departamento_id',auth()->user()->departamento_id)->attach($request->users);

        return redirect()->route('distribuicao.users', $document->id)->with('success','Funcionário vinculado com sucesso');
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function distribuicao()
    {
    $docs = Documento::where('estado','!=','finalizado')->where('estado','!=','geral')->where('departamento_id',auth()->user()->departamento_id)->get();
    //$contDoc=$docs->count();
    $armarios = Armario::where('departamento_id',auth()->user()->departamento_id)->get();

  return view('documentos.distribuicao',compact('docs','armarios'));
    }

    public function detachDocumentUser($idDocument, $idUser)
    {
        $document = $this->document->find($idDocument);
        $user = $this->user->find($idUser);

       
     
        if (!$user || !$document) {
            return redirect()->back();
        }
       
        $document->users()->detach($user);
    
        return redirect()->route('documentos.users', $document->id);
    }

    public function detachUserDocumentd($idUser, $idDocument)
{
        $document = $this->document->find($idDocument);
        $user = $this->user->find($idUser);
      
        if (!$user || !$document) {
            return redirect()->back();
        }
       
        $user->documentos()->detach($document);
    
        return redirect()->route('users.documentos', $user->id);
    }



    public function userss($idUser)
    {
        $document = $this->document->find($idUser);

        if (!$document) {
            return redirect()->back();
        }

        $users = $document->users()->paginate();
      
        return view('documentos.users.distribuir', compact('document', 'users'));
    }

     // documentos pendentes
     public function pendentes()
     {  
        if (!$user = $this->user->find(auth()->user()->id)) {
            return redirect()->back();
        }
         $v=1;
        
         $docs = $user->documentos()->where('estado','Pendente')->where('departamento_id',auth()->user()->departamento_id)->get(); 
            
         return view('documentos.tramitacao',compact('docs','v'));
     }


public function execucao()
{
    if (!$user = $this->user->find(auth()->user()->id)) {
        return redirect()->back();
    }
       
    $docs = $user->documentos()->where('estado','Em Execução')->where('departamento_id',auth()->user()->departamento_id)->get();
    $v=2;
  return view('documentos.tramitacao',compact('docs','v'));
}

public function concluidos()
{
       
    if (!$user = $this->user->find(auth()->user()->id)) {
        return redirect()->back();
    }
       $v=3;
    $docs = $user->documentos()->where('estado','Finalizado')->where('departamento_id',auth()->user()->departamento_id)->get();

  return view('documentos.tramitacao',compact('docs','v'));
}



    public function usersAvailable(Request $request, $idDocument)
    {
        if (!$document = $this->document->find($idDocument)) {
            return redirect()->back();
        }
         
        $filters = $request->except('_token');
        $users = $document->usersAvailable($request->filter);
       return view('documentos.users.available', compact('document', 'users', 'filters'));
    }

    public function usersAvailabled(Request $request, $idDocument)
    {
        if (!$document = $this->document->find($idDocument)) {
            return redirect()->back();
        }

         
        $filters = $request->except('_token');
        $users = $document->usersAvailabled($request->filter);

       return view('documentos.users.available1', compact('document', 'users', 'filters'));
    }

   

}
