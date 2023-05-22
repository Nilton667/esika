@extends('layouts.app')

@section('content')
<div class="row">
  <div class="section">
    
    <div class="col m11 s12">
      <div class="row">
        <h3 class="flow-text"><i class="material-icons">folder</i> Meus Documentos
        @can('carregar_documentos')
          <a href="/documentos/create" class="btn waves-effect waves-light right tooltipped" data-position="left" data-delay="50" data-tooltip="Carregar Novo Documento"><i class="material-icons">arquivo_upload</i>Carregar Novo Documento</a>
        @endcan
        </h3>
        <div class="divider"></div>
      </div>
      <div class="card">
        <div class="card-content">
          <table class="bordered centered highlight responsive-table" id="myDataTable">
            <thead>
              <tr>
                  <th>Nome do Ficheiro</th>
                  <th>Tipo</th>
                  <th>Tamanho</th>
                  <th>Carregado em</th>
                  <th>Acções</th>
              </tr>
            </thead>
            <tbody>
              @if(count($docs) > 0)
                @foreach($docs as $doc)
                <tr>
                  <td>{{ $doc->nome }}</td>
                  <td>{{ $doc->tipoficheiro }}</td>
                  <td>{{ $doc->tamanho }}</td>
                  <td>{{ $doc->created_at->toDayDateTimeString() }}</td>
                  <td>
                    @can('visualizar_documentos')                 
                    <a href="/documents/{{ $doc->id }}" class="tooltipped" data-position="left" data-delay="50" data-tooltip="Detalhes"><i class="material-icons">visibilidade</i></a>
                    <a href="/documentos/open/{{ $doc->id }}" class="tooltipped" data-position="left" data-delay="50" data-tooltip="Abrir Com"><i class="material-icons">open_with</i></a>
                    @endcan
                    @can('baixar_documentos')
                    <a href="/documentos/download/{{ $doc->id }}" class="tooltipped" data-position="left" data-delay="50" data-tooltip="Baixar"><i class="material-icons">file_download</i></a>
                    @endcan
                    @can('partilhar_documentos')
                    <a href="{{ route('documents.users', $doc->id) }}" class="tooltipped" data-position="left" data-delay="50" data-tooltip="Partilhar"><i class="material-icons">share</i></a>
                    @endcan
                    @can('editar_documentos')
                    <a href="/documents/{{ $doc->id }}/edit" class="tooltipped" data-position="left" data-delay="50" data-tooltip="Editar"><i class="material-icons">mode_edit</i></a>
                    @endcan
                  </td>
                </tr>
                @endforeach
              @else
                <tr>
                  <td colspan="6"><h5 class="teal-text">Nenhum documento guardado</h5></td>
                </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
