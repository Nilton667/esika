@extends('layouts.app')

@section('content')
<div class="row">
  <div class="section">
    <div class="col m1 hide-on-med-and-down">
    </div>
    <div class="col m11 s12">
      <div class="row">
        <h3 class="flow-text"><i class="material-icons">mode_edit</i> Funções da {{ $user->name }}</h3>
        <div class="divider"></div>
      </div>
 
    <a href="{{ route('users.funcaos.available', $user->id) }}" class="btn btn-dark">ADICIONAR NOVA FUNÇÃO</a>

 <!-- ===================================================== -->
 <div class="col m12 s12">
    <div class="card z-depth-2 hoverable">
        <div class="card-content">
            <table class="striped">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th width="50">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($funcaos as $role)
                        <tr>
                            <td>
                                {{ $role->nome }}
                            </td>
                            <td style="width=10px;">
                                <a href="{{ route('users.funcao.detach', [$user->id, $role->id]) }}" class="btn btn-danger">DESVINCULAR</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $funcaos->appends($filters)->links() !!}
            @else
                {!! $funcaos->links() !!}
            @endif
        </div>
    </div>
    </div>
    </div>
@stop
