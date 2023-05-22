
@extends('layouts.app')

@section('content')

    <!-- start: page body -->
    <div class="page-body">
      <div class="inbox">
        <div class="d-flex flex-nowrap">
          <div class="order-1 custom_scroll">
            <ul class="menu-list list-unstyled mb-0">
            <li><a class="m-link active" href="/pendentes"><i class="fa fa-inbox"></i><span>Pendentes</span></a></li>
              <li><a class="m-link" href="/execucao"><i class="fa fa-clock-o"></i><span>Em Execução</span></a></li>
              <li><a class="m-link" href="/concluidos"><i class="fa fa-clock-o"></i><span>Concluídos</span></a></li>
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
                        <li class="nav-item me-2"><a class="nav-link color-600" data-bs-toggle="modal" data-bs-target="#add_customers" href="#"><i class="fa fa-tasks"></i><span class="ms-2 d-none d-md-inline-block">Despachar</span></a></li>
                        <li class="nav-item me-2"><a class="nav-link color-600" href="{{ route('documentos.users.available', $document->id) }}"><i class="fa fa-arrow-circle-right"></i><span class="ms-2 d-none d-md-inline-block">Selecionar mais Funcionários</span></a></li>
                        <!--li class="nav-item me-2"><a class="nav-link color-600" href="#"><i class="fa fa-tags"></i><span class="ms-2 d-none d-md-inline-block">Labels</span></a></li-->
                      </ul>
                    </div>
                  </nav>
                </div>
                <div class="col-12">
                  <div class="card mb-3">
                    <div class="card-body">
                      <h5 class="mb-0"><a href=""><i class="fa fa-arrow-left me-3"></i></a>{{ $document->nome }}</h5>
                    </div>
                    <div class="bg-light px-4 py-3">
                      <div class="row align-items-center">
                      </div>
                    </div>
                    <div class="card-body">
            <table class="striped">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th width="50">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>
                                {{ $user->name }}
                            </td>
                            <td style="width=10px;">
                                <a href="{{ route('documentos.user.detach', [$document->id, $user->id]) }}" class="btn btn-danger">DESASSOCIAR</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        <div class="card-footer">
            @if (isset($filters))
                {!! $users->appends($filters)->links() !!}
            @else
                {!! $users->links() !!}
            @endif
        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
      <script>
        $('.inbox .inbox-list-toggle').on('click', function() {
          $('.inbox .order-1').toggleClass('open');
        });
      </script>
    </div> 
      
           <!-- Modal: Add new Customers -->
                <!-- <button class="btn btn-primary px-4 text-uppercase" data-bs-toggle="modal" data-bs-target="#add_customers" type="button">Add new Customers</button> -->
                <div class="modal fade" id="add_customers" tabindex="-1" aria-labelledby="add_customers" aria-hidden="true">
                <form action="{{ route('tarefas.store') }}" method="POST" enctype="multipart/form-data">
                   @csrf  
                   <input type="hidden" name="documento_id" value="{{$document->id}}">
                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Despacho</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>

                      <div class="modal-body">
                        <div class="row g-3">
                          <div class="col-lg-6 col-md-6">
                            <div class="form-floating">
                              <select name="user_id" class="form-select form-control">
                              @foreach($users as $user)
                              <option value="{{$user->id}}">{{$user->name}}</option>
                              @endforeach
                              </select>
                              <label for="floatingSelect">Nome do Funcionário</label>
                            </div>
                          </div>

                           <div class="col-lg-6 col-md-6">
                            <div class="form-floating">
                              <input type="text" name="descricao"class="form-control" placeholder="Descrição do despacho">
                              <label>Descrição do despacho</label>
                            </div>
                          </div>

                          <div class="col-lg-6 col-md-6">
                            <div class="form-floating">
                            <select name="prioridade" class="form-select form-control">
                              <option value="Urgente">Urgente</option>
                              <option value="Normal">Normal</option>
                              </select>
                              <label for="floatingSelect">Prioridade</label>
                            </div>
                          </div>

                          <div class="col-lg-6 col-md-6">
                            <div class="form-floating">
                              <input type="date" name="data_limite"class="form-control" placeholder="Nome do documento">
                              <label>Data Limite</label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Adicionar</button>
                      </div>
                    </div>
                  </div>
                </form>
                </div>
    @endsection
              