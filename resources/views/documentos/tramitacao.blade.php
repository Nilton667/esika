@extends('layouts.app')

@section('content')

    <!-- start: page body -->
    <div class="page-body">
      <div class="inbox">
        <div class="d-flex flex-nowrap">
          <div class="order-1 custom_scroll">
            <ul class="menu-list list-unstyled mb-0">
              <!--li>   <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_customers" type="button">Novo Documento</button></li-->
              <li><a class="m-link active" href="/pendentes"><i class="fa fa-inbox"></i><span>Pendentes</span></a></li>
              <li><a class="m-link" href="/execucao"><i class="fa fa-clock-o"></i><span>Em Execução</span></a></li>
              <li><a class="m-link" href="/concluidos"><i class="fa fa-clock-o"></i><span>Finalizados</span></a></li>
            </ul>
          </div>
          <div class="order-2 flex-grow-1 px-lg-3 px-0 custom_scroll">
            <div class="container-fluid">
            <div class="row g-3">
              
            <div class="row g-3 mb-3 align-items-center">
          <div class="col">
            <ol class="breadcrumb bg-transparent mb-0">
              <li class="breadcrumb-item" aria-current="page"><a href="/painel">Dashboard</a></li>
              @if($v==1)
              <li class="breadcrumb-item active" aria-current="page"><a href="#">Pendentes</a></li>
              @endif

              @if($v==2)
              <li class="breadcrumb-item active" aria-current="page"><a href="#">Em Execução</a></li>
              @endif

              @if($v==3)
              <li class="breadcrumb-item active" aria-current="page"><a href="#">Finalizados</a></li>
              @endif
            </ol>
          </div>
        </div> 
              <div class="row g-3">
                <div class="col-12">
                  <div class="d-flex justify-content-between align-items-center px-lg-3 py-2 mt-2">
                    <div class="d-flex flex-wrap flex-grow-1 align-items-center">
                      <div class="form-check mb-0 me-lg-3 me-2">
                        <input class="form-check-input" type="checkbox" value="" id="checkall">
                        <label class="form-check-label" for="checkall">All</label>
                      </div>
                      <button class="btn btn-sm btn-outline-secondary" type="button"><i class="fa fa-refresh"></i></button>
                      <div class="dropdown morphing scale-right mx-1">
                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">More</button>
                        <ul class="dropdown-menu border-0 shadow p-2">
                          <li><a class="dropdown-item py-2 rounded" href="#">Action</a></li>
                          <li><a class="dropdown-item py-2 rounded" href="#">Another action</a></li>
                          <li><a class="dropdown-item py-2 rounded" href="#">Something else here</a></li>
                        </ul>
                      </div>
                      <div class="dropdown morphing scale-right d-none d-md-block">
                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Move to</button>
                        <ul class="dropdown-menu border-0 shadow p-2">
                          <li><a class="dropdown-item py-2 rounded" href="#">Action</a></li>
                          <li><a class="dropdown-item py-2 rounded" href="#">Another action</a></li>
                          <li><a class="dropdown-item py-2 rounded" href="#">Something else here</a></li>
                        </ul>
                      </div>
                    </div>
                    <div class="d-flex align-items-center">
                      <span class="text-muted me-2">1-50 of 234</span>
                      <button class="btn btn-sm btn-outline-secondary" type="button"><i class="fa fa-angle-left"></i></button>
                      <button class="btn btn-sm btn-outline-secondary" type="button"><i class="fa fa-angle-right"></i></button>
                      <button class="btn btn-sm d-block d-lg-none btn-primary inbox-list-toggle ms-3" type="button"><i class="fa fa-bars"></i></button>
                    </div>
                  </div>
                </div>


                <div class="col-12">
                  <ul class="list-group list-group-flush list-group-custom card">
                   
                  @if(count($docs) > 0)
                       @foreach($docs as $doc)
                    <li class="row g-0 list-group-item d-flex align-items-start py-3">
                      <div class="hover-actions end-0 me-3 bg-light rounded">
                        <a href="/documentos/tram/{{ $doc->id }}" class="btn btn-link btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Abrir"><i class="fa fa-inbox"></i></a>
                        <a href="{{ route('documentos.users', $doc->id) }}" class="btn btn-link btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Despachar"><i class="fa fa-inbox"></i></a>
                        @if($doc->estado=="Em Execução")
                          <a href="#" class="btn btn-link btn-sm" data-bs-toggle="modal" data-bs-target="#edit_customers{{$doc->id}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Concluir"><i class="fa fa-clock-o"></i></a>
                        @endif
                        </div>
                      <div class="col-auto d-none d-sm-block">
                        <div class="d-flex align-items-center">
                          <div class="form-check mb-0">
                            <input class="form-check-input" type="checkbox" value="">
                          </div>
                          <a href="#" class="ms-2 me-3"><i class="fa fa-star active"></i></a>
                        </div>
                      </div>
                      <div class="col col-md-9 col-xxl-10">
                        <div class="row">
                          <div class="col-md-4 col-xl-4 col-xxl-3 mb-1 mb-md-0">
                            <a href="/documentos/tram/{{ $doc->id }}" class="d-flex text-primary text-truncate" title="Detalhes">
                              <div class="ms-2 mb-0">{{ $doc->nome }}</div>
                            </a>
                          </div>
                          <div class="col">
                            <p class="i-msg mb-0 text-muted">{{ $doc->origem }}</p>
                            <!--a href="#" class="d-inline-flex align-items-center border rounded-pill px-3 py-1 me-2 mt-1 text-success small"><i class="fa fa-file-excel me-2"></i>{{ $doc->nome }}.pdf</a>
                            <a href="#" class="d-inline-flex align-items-center border rounded-pill px-3 py-1 me-2 mt-1 text-danger small"><i class="fa fa-file-pdf-o me-2"></i>established.pdf</a-->
                          </div>

                          <div class="col">
                            <p class="i-msg mb-0 text-muted">{{ $doc->estado }}</p>
                            <!--a href="#" class="d-inline-flex align-items-center border rounded-pill px-3 py-1 me-2 mt-1 text-success small"><i class="fa fa-file-excel me-2"></i>{{ $doc->nome }}.pdf</a>
                            <a href="#" class="d-inline-flex align-items-center border rounded-pill px-3 py-1 me-2 mt-1 text-danger small"><i class="fa fa-file-pdf-o me-2"></i>established.pdf</a-->
                          </div>
                          <div class="col">
                            <p class="i-msg mb-0 text-muted">{{ $doc->visualizacao }} Visualização</p>
                            <!--a href="#" class="d-inline-flex align-items-center border rounded-pill px-3 py-1 me-2 mt-1 text-success small"><i class="fa fa-file-excel me-2"></i>{{ $doc->nome }}.pdf</a>
                            <a href="#" class="d-inline-flex align-items-center border rounded-pill px-3 py-1 me-2 mt-1 text-danger small"><i class="fa fa-file-pdf-o me-2"></i>established.pdf</a-->
                          </div>
                        </div>
                      </div>

                      
                    </li>


                     <!-- Modal: Add new Customers -->
                <!-- <button class="btn btn-primary px-4 text-uppercase" data-bs-toggle="modal" data-bs-target="#add_customers" type="button">Add new Customers</button> -->
                <div class="modal fade" id="edit_customers{{ $doc->id }}" tabindex="-1" aria-labelledby="edit_customers" aria-hidden="true">
                <form action="{{ route('concluir.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="documento_id" value="{{$doc->id}}">

                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Finalizar Documento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>

                      <div class="modal-body">
                      <div class="col-lg-12">
                            <label for="formFile" class="form-label">Documento final</label>
                            <input class="form-control" name="ficheiro_final" type="file" id="formFile">
                          </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
                        <button type="submit" class="btn btn-primary">Sim</button>
                      </div>
                    </div>
                  </div>
                </form>
                </div>
                @endforeach
                @else
                @if($v==1)
                    <li><h5>Nenhum documento está pendente ainda</h5></li>
                 @endif

                 @if($v==2)
                    <li><h5>Nenhum documento está em execução ainda</h5></li>
                 @endif

                 @if($v==3)
                    <li><h5>Nenhum documento foi finalizados ainda</h5></li>
                 @endif
                 
                @endif
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
    </div> 
                <!-- Modal: Add new Customers -->
                <!-- <button class="btn btn-primary px-4 text-uppercase" data-bs-toggle="modal" data-bs-target="#add_customers" type="button">Add new Customers</button> -->
                <div class="modal fade" id="add_customers" tabindex="-1" aria-labelledby="add_customers" aria-hidden="true">
                <form action="{{ route('documentos.store') }}" method="POST" enctype="multipart/form-data">
                   @csrf  
                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Adicionar novo Documento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>

                      <div class="modal-body">
                        <h6 class="fw-bold">Informações do documento</h6>
                        <div class="row g-3">
                          <div class="col-lg-6 col-md-12">
                            <div class="form-floating">
                              <input type="text" name="nome"class="form-control" placeholder="Nome do documento">
                              <label>Nome do documento</label>
                            </div>
                          </div>
                          <div class="col-lg-6 col-md-12">
                            <div class="form-floating">
                              <input type="text" name="origem" class="form-control" placeholder="Origem do documento">
                              <label>Origem do documento</label>
                            </div>
                          </div>
                
                          <div class="col-lg-6 col-md-12">
                            <div class="form-floating">
                              <input type="text" name="referencia" class="form-control" placeholder="Referência">
                              <label>Referência</label>
                            </div>
                          </div>
                         
                          <div class="col-lg-12">
                            <label for="formFile" class="form-label">Anexo</label>
                            <input class="form-control" name="ficheiro" type="file" id="formFile">
                          </div>
                        </div> 
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                      </div>
                    </div>
                  </div>
                </form>
                </div>
    @endsection
