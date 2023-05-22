<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreUpdate;
use App\Models\Departamento;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct() {
        $this->middleware(['auth']);
     }

    public function index()
    {
        if (auth()->user()->hasAnyRoles('Super'))
        {
            $users = User::where('estado',true)->where('email','!=','super@gmail.com')->get();
        }
        else
        {
            
            $users = User::where('estado',true)->where('email','!=','super@gmail.com')->where('departamento_id',auth()->user()->departamento_id)->get();
        }   
        
         
          

        $departamentos = Departamento::all();

        return view('users.index',compact('users','departamentos'));
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
          'name' => 'required|string|max:255',
          'email' => 'required|string|email|max:255|unique:users',
          'departamento_id' => 'required',
          'imagem' => 'required',
        ]);
        
       // dd($request->all());
        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->genero = $request->input('genero');
        $user->password =bcrypt('12345678');
        $user->telefone =$request->input('telefone');
        $user->departamento_id = $request->input('departamento_id');

        if ($request->hasFile('imagem') && $request->imagem->isValid()) {
            $user->imagem = $request->imagem->store("funcionarios");
        }
        
        $user->estado = false; 
        
       
        $user->save();


        return redirect('/users')->with('success','Funcionário adicionado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show')->with('user',$user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $depts = Departamento::all();

        return view('users.edit',compact('user','depts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserStoreUpdate $request, $id)
    {
       //dd($request->estado);
        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->genero = $request->input('genero');
        $user->telefone =$request->input('telefone');
        $user->departamento_id = $request->input('departamento_id');
        
        if ($request->hasFile('imagem') && $request->imagem->isValid()) {

            if (Storage::exists($user->imagem)) {
                Storage::delete($user->imagem);
            }

            $user->imagem = $request->imagem->store("funcionarios");
        }

        $user->save();
        

        return redirect('/users')->with('success','Editado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('/users')->with('success', 'Funcionário eliminado');
    }

}
