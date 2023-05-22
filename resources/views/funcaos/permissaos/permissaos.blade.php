@extends('layouts.app')

@section('content')
<div class="row">
  <div class="section">
    <div class="col m11 s12">
      <div class="row">
        <h3 class="flow-text"><i class="material-icons">mode_edit</i> Permissão da função {{ $funcao->nome }}</h3>
        <div class="divider"></div>
      </div>
 
    <a href="{{ route('funcaos.permissaos.available', $funcao->id) }}" class="btn btn-dark">ADICIONAR NOVA PERMISSÃO</a>

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
                    @foreach ($permissaos as $permissao)
                        <tr>
                            <td>
                                {{ $permissao->nome }}
                            </td>
                            <td style="width=10px;">
                                <a href="{{ route('funcaos.permissao.detach', [$funcao->id, $permissao->id]) }}" class="btn btn-danger">DESVINCULAR</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $permissaos->appends($filters)->links() !!}
            @else
                {!! $permissaos->links() !!}
            @endif
        </div>
    </div>
    </div>
    </div>
@stop
