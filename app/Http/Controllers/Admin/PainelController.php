<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Departamento;
use App\Models\Documento;
use App\Models\Permissao;
use App\Models\User;
use Illuminate\Http\Request;

class PainelController extends Controller
{
    public function __construct() {
        return $this->middleware(['auth']);
     }
 

    public function index(){

       
        
       if(auth()->user()){
        $d = auth()->user()->departamento_id;
        $users = User::where('estado',true)->where('email','!=','super@gmail.com')->where('departamento_id',$d)->where('id','!=',auth()->user()->id)->get();
        $contUsers   = User::where('estado',true)->where('email','!=','super@gmail.com')->count();
        $contDocumento= Documento::count();
        $contDepartamentos= Departamento::count();
        $contPermissao=Permissao::count();
        return view('painel',compact('contUsers','contDocumento','contDepartamentos','contPermissao'));

    }else{
        return redirect('login');
    }

    }




    public function error(){
       
        return view('pages.error');
    }

}
