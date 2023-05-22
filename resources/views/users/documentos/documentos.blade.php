@extends('layouts.app')

@section('content')
<div class="row">
  <div class="section">
    
    <div class="col m11 s12">
      <div class="row">
        <h3 class="flow-text"><i class="material-icons">mode_edit</i> Documentos partilhado para <strong>{{ $user->name }}<strong></h3>
        <div class="divider"></div>
      </div>
 
    <a href="{{ route('users.documentos.available', $user->id) }}" class="btn btn-dark">CARREGAR NOVO DOCUMENTO</a>

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
                    @foreach ($documentos as $document)
                        <tr>
                            <td>
                                {{ $document->nome }}
                            </td>
                            <td style="width=10px;">
                                <a href="{{ route('users.documento.detach', [$user->id, $document->id]) }}" class="btn btn-danger">DESVINCULAR</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $documentos->appends($filters)->links() !!}
            @else
                {!! $documentos->links() !!}
            @endif
        </div>
    </div>
    </div>
    </div>
@stop
