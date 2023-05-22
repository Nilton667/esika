@extends('layouts.app')

@section('content')
 <!-- start: page toolbar -->
 <div class="page-toolbar px-xl-4 px-sm-2 px-0 py-3">
      <div class="container-fluid">
       
        <div class="row g-3 mb-3 align-items-center">
          <div class="col">
            <ol class="breadcrumb bg-transparent mb-0">
              <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
          </div>
        </div> 
        
        <!-- .row end -->
        <div class="row align-items-center">
          <div class="col">
            <h1 class="fs-5 color-900 mt-1 mb-0">Seja Benvindo, {{Auth::user()->name}} !</h1>
            <!--small class="text-muted">You have 12 new messages and 7 new notifications.</small-->
          </div>
          <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-7 col-sm-12 mt-2 mt-md-0">
            <!-- daterange picker -->
            <div class="input-group">
              <input class="form-control" type="text" name="daterange">
              <button class="btn btn-secondary" type="button" data-bs-toggle="tooltip" title="Send Report"><i class="fa fa-envelope"></i></button>
              <button class="btn btn-secondary" type="button" data-bs-toggle="tooltip" title="Download Reports"><i class="fa fa-download"></i></button>
              <button class="btn btn-secondary" type="button" data-bs-toggle="tooltip" title="Generate PDF"><i class="fa fa-file-pdf-o"></i></button>
              <button class="btn btn-secondary" type="button" data-bs-toggle="tooltip" title="Share Dashboard"><i class="fa fa-share-alt"></i></button>
            </div>
            <!-- Plugin Js -->
           
          </div>
        </div> <!-- .row end -->
      </div>
    </div>
    <!-- start: page body -->
    <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
      <div class="container-fluid">
        <div class="row g-3 row-deck">
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card overflow-hidden">
              <div class="card-body">
                <svg class="position-absolute top-0 end-0 mt-4 me-3" xmlns="http://www.w3.org/2000/svg" width="26" fill="currentColor" viewBox="0 0 16 16">
                  <path class="fill-muted" d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5z" />
                  <path class="fill-primary" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                </svg>
                <div class="mb-2 text-uppercase">Funcionários</div>
                <div><span class="h4">{{$contUsers}}</span> <span class="small text-muted"><i class="fa fa-level-up"></i></span></div>
                <small class="text-muted">Todos os funcionários</small>
              </div>
              <div class="progress" style="height: 4px;">
                <div class="progress-bar bg-secondary" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card overflow-hidden">
              <div class="card-body">
                <svg class="position-absolute top-0 end-0 mt-4 me-3" xmlns="http://www.w3.org/2000/svg" width="26" fill="currentColor" viewBox="0 0 16 16">
                  <path class="fill-muted" d="M14 3a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h12zM2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2z" />
                  <path class="fill-primary" d="M2 5.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5z" />
                </svg>
                <div class="mb-2 text-uppercase">Documentos</div>
                <div><span class="h4">{{$contDocumento}}</span> <span class="small text-muted"><i class="fa fa-level-up"></i></span></div>
                <small class="text-muted">Todos os documentos</small>
              </div>
              <div class="progress" style="height: 4px;">
                <div class="progress-bar bg-danger" role="progressbar" style="width: 13%" aria-valuenow="13" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card overflow-hidden">
              <div class="card-body">
                <svg class="position-absolute top-0 end-0 mt-4 me-3" xmlns="http://www.w3.org/2000/svg" width="26" fill="currentColor" viewBox="0 0 16 16">
                  <path class="fill-primary" fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z" />
                  <path class="fill-primary" d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z" />
                  <path class="fill-muted" d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1H1z" />
                  <path class="fill-muted" d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z" />
                </svg>
                <div class="mb-2 text-uppercase">Permissões</div>
                <div><span class="h4">{{$contPermissao}}</span> <span class="small text-muted"><i class="fa fa-level-up"></i></span></div>
                <small class="text-muted">Todas as permissões do sistema</small>
              </div>
              <div class="progress" style="height: 4px;">
                <div class="progress-bar bg-secondary" role="progressbar" style="width: 78%" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card overflow-hidden">
              <div class="card-body">
                <svg class="position-absolute top-0 end-0 mt-4 me-3" xmlns="http://www.w3.org/2000/svg" width="26" fill="currentColor" viewBox="0 0 16 16">
                  <path class="fill-muted" d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v1.384l7.614 2.03a1.5 1.5 0 0 0 .772 0L16 5.884V4.5A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1h-3zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5z" />
                  <path class="fill-primary" d="M0 12.5A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5V6.85L8.129 8.947a.5.5 0 0 1-.258 0L0 6.85v5.65z" />
                </svg>
                <div class="mb-2 text-uppercase">Departamentos</div>
                <div><span class="h4">{{$contDepartamentos}}</span> <span class="small text-muted"><i class="fa fa-level-up"></i></span></div>
                <small class="text-muted">Todos os depatamentos</small>
              </div>
              <div class="progress" style="height: 4px;">
                <div class="progress-bar bg-warning" role="progressbar" style="width: 55%" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
          <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-12">
            <div class="card text-center bg-primary-gradient">
              <div class="card-body d-flex align-items-center justify-content-center">
                <div>
                  <h4 class="mt-4">Benvindo {{Auth::user()->name}}</h4>
                  <p class="card-text fs-6 mb-5"><strong>Precisa de ajuda? </strong>Veja toda a documentação do sistema de gestão de documentos para melhor <strong>entender os</strong>, <strong>componentes</strong>, e toda regra de negócio <strong> é facil visita a </strong>documentação</p>
                  <a class="btn btn-lg bg-white text-uppercase px-4 lift" href="#" title="">Visita a Documentação</a>
                </div>
              </div>
            </div>
          </div>
         
         
    
        </div>   
      </div>    
    </div>   

@endsection