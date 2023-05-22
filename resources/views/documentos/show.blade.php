@extends('layouts.app')

@section('content')
<style media="screen">
  .btn-icons {
    display: flex;
    justify-content: center;
  }
  .btn-circle {
    width: 56px;
    height: 56px;
    border-radius: 50%;
    color: #fff;
    padding-left: 16px;
    padding-top: 16px;
    margin: auto 5px;
  }
  .btn-circle i:hover {
    color: #000;
    transition: 0.5s all;
  }
</style>
<div class="row">
  <div class="section">
    <div class="col m11 s12">
      <div class="row">
        <h3 class="flow-text"><i class="material-icons">info</i>Informações do Documento</h3>
        <div class="btn-icons">
      
          <a href="/documentos/{{ $doc->id }}/edit" class="btn-circle teal waves-effect waves-light tooltipped" data-position="left" data-delay="50" data-tooltip="Editar este ficheiro"><i class="material-icons">mode_edit</i></a>
          <a href="/documentos/open/{{ $doc->id }}" class="btn-circle blue darken-3 waves-effect waves-light tooltipped" data-position="top" data-delay="50" data-tooltip="Abrir este ficheiro"><i class="material-icons">open_with</i></a>
          <!-- SHARE using link --> 
          <a href="{{ route('documentos.users', $doc->id) }}" class="btn-circle purple waves-effect waves-light tooltipped" data-position="top" data-delay="50" data-tooltip="Partilhar este ficheiro"><i class="material-icons">share</i></a>
      
          <!-- Voltar using link -->
          <!--a href="#" class="btn-circle red waves-effect waves-light data-delete tooltipped" data-position="right" data-delay="50" data-tooltip="Eliminar este ficheiro" data-form="documents-{{ $doc->id }}"><i class="material-icons">delete</i></a-->
  
        </div>
      </div>
      <div class="col s12 m11">
        <div class="card horizontal hoverable">
          <div class="card-image hide-on-med-and-down">
            <!--img src="/storage/images/sideytu1.jpg" height="650px"-->
          </div>
          <div class="card-stacked">
            <div class="card-content">
             
              <ul class="collapsible" data-collapsible="accordion">
                <li>
                  <div class="collapsible-header active"><i class="material-icons">folder</i>Nome do Documento</div>
                  <div class="collapsible-body"><span class="teal-text">{{ $doc->nome }}</span></div>
                </li>
                <li>
                  <div class="collapsible-header"><i class="material-icons">description</i>Descrição</div>
                  <div class="collapsible-body"><span class="teal-text">{{ $doc->descricao }}</span></div>
                </li>
              
                
                <li>
                  <div class="collapsible-header"><i class="material-icons">class</i>Armário</div>
                  <div class="collapsible-body">
                    <span class="teal-text">
                      <ul>
                        <li>{{ $doc->armario_id }}</li>
                      </ul>
                    </span>
                  </div>
                </li>

                <li>
                <div class="collapsible-header active"><i class="material-icons">folder</i>Tipo de Documento</div>
                  <div class="collapsible-body"><span class="teal-text">{{ $doc->tipo }}</span></div>
                </li>
              
                <li>
                  <div class="collapsible-header"><i class="material-icons">date_range</i>Carregado em</div>
                  <div class="collapsible-body"><span class="teal-text">{{ $doc->created_at->toDayDateTimeString() }}</span></div>
                </li>
                <li>
                  <div class="collapsible-header"><i class="material-icons">date_range</i>Atualizado em</div>
                  <div class="collapsible-body"><span class="teal-text">{{ $doc->updated_at->toDayDateTimeString() }}</span></div>
                </li>
                <li>
                  <div class="collapsible-header"><i class="material-icons">info_outline</i>Tamanho do ficheiro</div>
                  <div class="collapsible-body">
                    <span class="teal-text">
                      <ul>
                        <li>Tamanho : {{ $doc->tamanho }} </li>
                        <li>Tipo : {{ $doc->tipoficheiro }}</li>
                        <li>Última modificação : {{ \Carbon\Carbon::createFromTimeStamp(Storage::lastModified($doc->ficheiro))->formatLocalized('%d %B %Y, %H:%M') }}</li>
                      </ul>
                    </span>
                  </div>
                </li>
              </ul>
            </div>
            <div class="card-action">
              <a href="/documentos" class="teal-text">Voltar</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
