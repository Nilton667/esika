@extends('layouts.app')

@section('content')

    <!-- start: page body -->
    <div class="page-body">
      <div class="inbox">
        <div class="d-flex flex-nowrap">
          <div class="order-1 custom_scroll">
            <ul class="menu-list list-unstyled mb-0">
            @if(count($armarios) > 0)
                @foreach($armarios as $armario)
              <li><a class="m-link active" href="{{ route('armarios.show',$armario->id) }}"><i class="fa fa-inbox"></i><span>{{$armario->nome}}</span></a></li>
              @endforeach
              @else
                <tr>
                  <td><h5>Nenhum Armário ainda foi adicionado</h5></td>
                </tr>
              @endif
            </ul>
          </div>
          <div class="order-2 flex-grow-1 px-lg-3 px-0 custom_scroll">
            <div class="container-fluid">
            <div class="row g-3">
            <div class="row g-3 mb-3 align-items-center">
          <div class="col">
            <ol class="breadcrumb bg-transparent mb-0">
              <li class="breadcrumb-item" aria-current="page"><a href="/painel">Dashboard</a></li>
              <li class="breadcrumb-item" aria-current="page"><a href="#">Armários</a></li>

            </ol>
          </div>
        </div> 
              <div class="row g-3">
              <div class="col-12">
            <div class="card">
              <div class="card-body">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Pesquisar...">
                  <button class="btn btn-secondary" type="button">Pesquisar</button>
                  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_customers" type="button">Adicionar novo Armário</button>
                </div>
                <!-- Modal: Add new Customers -->
                <!-- <button class="btn btn-primary px-4 text-uppercase" data-bs-toggle="modal" data-bs-target="#add_customers" type="button">Add new Customers</button> -->
                <div class="modal fade" id="add_customers" tabindex="-1" aria-labelledby="add_customers" aria-hidden="true">
                  <div class="modal-dialog modal-lg modal-dialog-scrollable">
                    <div class="modal-content">
                    <form action="{{ route('armarios.store') }}" method="POST">
                      @csrf
                      <input type="hidden" name="departamento_id" value="{{Auth()->user()->departamento_id}}">
                      <div class="modal-header">
                        <h5 class="modal-title">Adicionar novo Armário</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <h6 class="fw-bold">Informações sobre o Armário</h6>
                        <div class="row g-3">
                          <div class="col-lg-12 col-md-12">
                            <div class="form-floating">
                              <input type="text" name="nome" class="form-control" placeholder="Nome">
                              <label>Nome</label>
                            </div>
                          </div>

                          <div class="col-lg-12 col-md-12">
                            <div class="form-floating">
                              <input type="text" name="descricao" class="form-control" placeholder="Descrição">
                              <label>Descrição</label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                      </div>
                   </form>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
          <div class="col-12">
                <div class="tab-content">
                  <div class="tab-pane fade active show" id="drive_mydrive" role="tabpanel">
                    <div class="d-flex justify-content-between mb-2">
                      <h4 class="mt-1 mb-0">Meus Armários</h4>
                      <button class="btn btn-sm d-block d-lg-none btn-primary file-list-toggle" type="button"><i class="fa fa-bars"></i></button>
                    </div>
                    <div class="card fieldset border border-primary mb-5">
                      <span class="fieldset-tile text-primary bg-body">Sugestões:</span>
                      <div class="row g-2 row-deck">
            @if(count($armarios) > 0)
                @foreach($armarios as $armario)
                        <div class="col-lg-3 col-md-6 col-sm-12">
                         
                          <div class="card p-3 ribbon">
                          <a href="{{ route('armarios.show',$armario->id) }}">
                            <div class="option-9 position-absolute text-light"><i class="fa fa-star"></i></div>
                            <i class="fa fa-folder fa-2x"></i>
                            <div class="mt-3">
                              <h5>{{$armario->nome}}</h5>
                              <div class="d-flex text-muted flex-wrap justify-content-between small text-uppercase">Documentos: <span>{{$armario->documentos()->count()}}</span></div>
                              <div class="d-flex text-muted flex-wrap justify-content-between small text-uppercase">Tamanho: <span>{{$armario->documentos()->sum('tamanho')}} KB</span></div>
                            </div>
                            </a>
                          </div>
                         
                        </div>
                  @endforeach
              @else
                <tr>
                  <td><h5>Nenhum Armário ainda foi adicionado</h5></td>
                </tr>
              @endif
                      </div> <!-- .row end -->
                    </div>
                   
                 
                </div>
            </div>



              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
    </div> 
    @endsection

