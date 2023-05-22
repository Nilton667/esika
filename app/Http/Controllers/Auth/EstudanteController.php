<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Estudante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EstudanteController extends Controller
{
    protected $repository;

    public function __construct(Estudante $author)
    {
        $this->repository = $author;

    }

    public function index(){
        return view('estudantes.index');
    }
    public function login(){
    
        $user=Auth::guard('estudante')->user();
        if($user==null)
        return view('auth.login-estudante');
    
            if (!$this->repository->find(auth()->guard('estudante')->user()->id)) {
                return view('auth.login-estudante');
            }

            return redirect('/estudante');
    
    }

    public function store(Request $request){
       $data=$request->all();
      // dd($data['password']);
        $data['password']=Hash::make($data['password']);
        $this->repository->create($data);
        
        $credencials=['email'=>$request->get('email'),'password'=>Hash::make($request->password)];
        if(auth()->guard('estudante')->attempt($credencials)){
            return redirect('/');
        } else{
            return redirect('/estudante/login')
            ->withErrors(['errors'=>'Credências inválidas'])
            ->withInput();
        }

    }

    public function postLogin(Request $request){

        $validator=Validator($request->all(),[
            'email' => 'required', 'string', 'email', 'min:3', 'max:255', 'unique:estudantes',
            'password' => 'required', 'string', 'min:6', 'max:16', 'confirmed'
        ]);
     
        if($validator->fails()){
            return redirect('/estudante/login')
                           ->withErrors($validator)
                           ->withInput();
        }
          $credencials=['email'=>$request->get('email'),'password'=>$request->get('password')];
        if(auth()->guard('estudante')->attempt($credencials)){
            return redirect('/estudante');
        } else{
            return redirect('/estudante/login')
            ->withErrors(['errors'=>'Credências inválidas'])
            ->withInput();
        }


        }

        public function logout(){
            auth()->guard('estudante')->logout();

            return redirect('/estudante/login');
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
          'name' => 'required|string|max:255',
          'email' => 'required|string|email|max:255',
        ]);

        $user = Estudante::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        return redirect('/perfil')->with('success','Perfil Actualizado com sucesso');
    }

    public function changePassword(Request $request) {
        $this->validate($request,[
            'current_password' => 'required',
            'new_password' => 'required|string|min:6|confirmed'
        ]);

        $user = Auth::getUser();
        if (Hash::check($request->get('current_password'), $user->password)) {
            $user->password =bcrypt($request->input('new_password')) ;
            $user->save();

            return redirect('/perfil')->with('success','Senha actualizado com sucesso');
        } else {
            return redirect()->back()->withErrors('Senha Actual está incorreta!');
        }
    }



}
