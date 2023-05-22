
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
                <div class="col-12">
                  <nav class="navbar navbar-expand-md mt-2">
                    <!-- menu toggler -->
                    <button class="navbar-toggler p-0 border-0" type="button" data-bs-toggle="collapse" data-bs-target="#inbox_page_header">
                      <span class="fa fa-bars"></span>
                    </button>
                    <!-- main menu -->
                    <div class="collapse navbar-collapse order-0" id="inbox_page_header">
                      <ul class="navbar-nav flex-row me-auto">
                        <!--li class="nav-item me-2"><a class="nav-link color-600" href="#"><i class="fa fa-archive"></i></a></li>
                        <li class="nav-item me-2"><a class="nav-link color-600" href="#"><i class="fa fa-trash"></i></a></li>
                        <li class="nav-item me-2"><a class="nav-link color-600" href="#"><i class="fa fa-exclamation-circle"></i></a></li-->
                        <!--li class="nav-item me-2"><a class="nav-link color-600" href="{{ route('documentos.users', $doc->id) }}"><i class="fa fa-arrow-circle-right"></i><span class="ms-2 d-none d-md-inline-block">Distribuir</span></a></li-->
                        <!--li class="nav-item me-2"><a class="nav-link color-600" href="#"><i class="fa fa-tags"></i><span class="ms-2 d-none d-md-inline-block">Labels</span></a></li-->
                      </ul>
                    </div>
                  </nav>
                </div>
                <div class="col-12">
                  <div class="card mb-3">
                    <div class="card-body">
                      <h5 class="mb-0"><a href=""><i class="fa fa-arrow-left me-3"></i></a>{{$doc->nome}}</h5>
                    </div>
                    <div class="bg-light px-4 py-3">
                      <div class="row align-items-center">
                      </div>
                    </div>
        <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h6 class="card-title mb-0">Detalhes do Documento</h6>
                <div class="dropdown morphing scale-left">
                  <a href="#" class="card-fullscreen" data-bs-toggle="tooltip" title="Card Full-Screen"><i class="icon-size-fullscreen"></i></a>
                  <a href="#" class="more-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></a>
                  <!--ul class="dropdown-menu shadow border-0 p-2">
                    <li><a class="dropdown-item" href="{{ route('documentos.users', $doc->id) }}">Distribuir</a></li>
                  </ul-->
                </div>
              </div>
              <ul class="nav nav-tabs tab-card" role="tablist">
                <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#nav4-home-icon" role="tab"><i class="fa fa-home me-2"></i>Descrição</a></li>
                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#nav4-contact-icon" role="tab"><i class="fa fa-address-card-o me-2"></i>Ficheiro</a></li>
                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#nav4-profile-icon" role="tab"><i class="fa fa-user me-2"></i>Funcionários que visualizaram</a></li>
              </ul>
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane fade show active" id="nav4-home-icon" role="tabpanel">
                    <div class="mb-0">
                      <h6><a href="#">Título:</a> {{$doc->nome}}</h6>
                  <h6><a href="#">Origem:</a> {{$doc->origem}}</h6>
                  <h6><a href="#">Número de Série:</a> {{$doc->armario['nome']}}</h6>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="nav4-contact-icon" role="tabpanel">
                 
                       <embed src="https://www.esika.ao/storage/app/public/{{$doc->ficheiro}}" type="application/pdf" height="700px" width="100%" >
          
                  </div>
                  <div class="tab-pane fade" id="nav4-profile-icon" role="tabpanel">
                  <div class="mb-0">
                      @foreach($doc->users as $user)
                    <h2>{{$user->name}}</h2>
                      @endforeach
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
          </div>

        </div>
      </div>
    
    </div> 
         


    @endsection
              