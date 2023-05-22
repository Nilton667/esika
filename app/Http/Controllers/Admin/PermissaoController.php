<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permissao;
use Illuminate\Http\Request;

class PermissaoController extends Controller
{
    protected $repository;

    public function __construct(Permissao $permissao)
    {
        $this->repository = $permissao;

        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissaos = $this->repository->all();

        return view('permissaos.index', compact('permissaos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('permissaos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdatePermissao  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nome' => 'required|string|max:255|unique:permissaos',
            'descricao' => 'required'
          ]);
  
          $permissao = new Permissao;
          $permissao->nome = $request->input('nome');
          $permissao->descricao = $request->input('descricao');
          $permissao->save();
  
          return redirect('/permissaos')->with('success','Permissão adicionado com sucesso');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$permissao = $this->repository->find($id)) {
            return redirect()->back();
        }

        return view('permissaos.show', compact('permissao'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$permissao = $this->repository->find($id)) {
            return redirect()->back();
        }

        return view('permissaos.edit', compact('permissao'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!$permissao = $this->repository->find($id)) {
            return redirect()->back();
        }

        $permissao->update($request->all());

        return redirect()->route('permissaos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$permissao = $this->repository->find($id)) {
            return redirect()->back();
        }
        $user = Permissao::findOrFail($id);
        $user->delete();

        \Log::addToLog('Permissão ID : '.$id.' Foi eliminado');

        return redirect('/permissaos')->with('success', 'Permissão eliminado');
    }

    /**
     * Search results
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $filters = $request->only('filter');

        $permissaos = $this->repository
                            ->where(function($query) use ($request) {
                                if ($request->filter) {
                                    $query->where('nome', $request->filter);
                                    $query->orWhere('descricao', 'LIKE', "%{$request->filter}%");
                                }
                            })
                            ->paginate();

        return view('permissaos.index', compact('permissaos', 'filters'));
    }

}
