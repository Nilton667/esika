@extends('layouts.app')

@section('content')

    <!-- start: page body -->
    <div class="page-body">
      <div class="inbox">
        <div class="d-flex flex-nowrap">
          <div class="order-1 custom_scroll">
            <ul class="menu-list list-unstyled mb-0">
              <li><a class="m-link active" href="/unidades"><i class="fa fa-inbox"></i><span>Configurações</span></a></li>
              <li><a class="m-link" href="/departamentos"><i class="fa fa-clock-o"></i><span>Departamentos</span></a></li>
              <li><a class="m-link" href="/users"><i class="fa fa-clock-o"></i><span>Funcionários</span></a></li>
              <li><a class="m-link" href="/funcaos"><i class="fa fa-clock-o"></i><span>Funções</span></a></li>
              <li><a class="m-link" href="/permissaos"><i class="fa fa-clock-o"></i><span>Permissões</span></a></li>
              <li><a class="m-link" href="/seriedocumental"><i class="fa fa-clock-o"></i><span>Série Documental</span></a></li>
            </ul>
          </div>
          <div class="order-2 flex-grow-1 px-lg-3 px-0 custom_scroll">
            <div class="container-fluid">
            <div class="row g-3">
            <div class="row g-3 mb-3 align-items-center">
          <div class="col">
            <ol class="breadcrumb bg-transparent mb-0">
              <li class="breadcrumb-item" aria-current="page"><a href="/painel">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page"><a href="#">Instituição</a></li>
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
                  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_customers" type="button">Adicionar nova Instituição</button>
                </div>
                <!-- Modal: Adicionar nova Unidade -->
                <!-- <button class="btn btn-primary px-4 text-uppercase" data-bs-toggle="modal" data-bs-target="#add_customers" type="button">Add new Customers</button> -->
                <div class="modal fade" id="add_customers" tabindex="-1" aria-labelledby="add_customers" aria-hidden="true">
                  <div class="modal-dialog modal-lg modal-dialog-scrollable">
                    <div class="modal-content">
                    <form action="{{ route('unidades.store') }}" method="post">
                      <div class="modal-header">
                        <h5 class="modal-title">Adicionar nova Instituição</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <h6 class="fw-bold">Informações sobre a Instituição</h6>
                        @csrf
                        <div class="row g-3">
                          <div class="col-lg-6 col-md-12">
                            <div class="form-floating">
                              <input type="text" name="nome" class="form-control" placeholder="Nome">
                              <label>Nome</label>
                            </div>
                          </div>
                          <div class="col-lg-6 col-md-12">
                            <div class="form-floating">
                              <input type="text" name="email" class="form-control" placeholder="Email">
                              <label>Email</label>
                            </div>
                          </div>
                          <div class="col-lg-6 col-md-12">
                            <div class="form-floating">
                              <input type="text" name="telefone" class="form-control" placeholder="Telefone">
                              <label>Telefone</label>
                            </div>
                          </div>

                          <div class="col-lg-6 col-md-12">
                            <div class="form-floating">
                              <input type="text" name="endereco" class="form-control" placeholder="Endereço">
                              <label>Endereço</label>
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
            <table id="myDataTable_no_filter" class="table myDataTable align-middle custom-table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nome</th>
                  <th>Email</th>
                  <th>Telefone</th>
                  <th>Endereço</th>
                  <th>Acções</th>
                </tr>
              </thead>
              <tbody>
              @if(count($unidades) > 0)
                @foreach($unidades as $unidade)
                <tr>
                  <td>{{ $unidade->id }}</td>
                  <td>{{ $unidade->nome }}</td>
                  <td>{{ $unidade->email }}</td>
                  <td>{{ $unidade->telefone }}</td>
                  <td>{{ $unidade->endereco }}</td>
                  <td>
                    <!--a href="{{ route('users.documentos', $unidade->id) }}" class="btn btn-link btn-sm text-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Partilhar"><i class="fa fa-star-o"></i></a-->
                    <a href="#" data-bs-toggle="modal" data-bs-target="#edit_customers{{$unidade->id}}" class="btn btn-link btn-sm text-primary" data-bs-placement="top" title="Editar"><i class="fa fa-gear"></i></button>
                    <a href="" data-form="users-{{ $unidade->id }}" class="btn btn-link btn-sm text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar"><i class="fa fa-trash"></i></button>
                  </td>

                  <div class="modal fade" id="edit_customers{{$unidade->id}}" tabindex="-1" aria-labelledby="edit_customers" aria-hidden="true">
                  <div class="modal-dialog modal-lg modal-dialog-scrollable">
                    <div class="modal-content">
                    <form action="{{ route('unidades.update',$unidade->id) }}" method="post">
                    @csrf
                    @method('PUT')
                      <div class="modal-header">
                        <h5 class="modal-title">Editar Instituição</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <h6 class="fw-bold">Informações sobre a Instituição</h6>
                        <div class="row g-3">
                          <div class="col-lg-6 col-md-12">
                            <div class="form-floating">
                              <input type="text" value="{{$unidade->nome}}" name="nome" class="form-control" placeholder="Nome">
                              <label>Nome</label>
                            </div>
                          </div>
                          <div class="col-lg-6 col-md-12">
                            <div class="form-floating">
                              <input type="text" name="email" value="{{$unidade->email}}" class="form-control" placeholder="Last Name">
                              <label>Email</label>
                            </div>
                          </div>
                          <div class="col-lg-6 col-md-12">
                            <div class="form-floating">
                              <input type="text" name="telefone" value="{{$unidade->telefone}}" class="form-control" placeholder="Date of Birth">
                              <label>Telefone</label>
                            </div>
                          </div>

                          <div class="col-lg-6 col-md-12">
                            <div class="form-floating">
                              <input type="text" value="{{$unidade->endereco}}" name="endereco" class="form-control" placeholder="Endereço">
                              <label>Endereço</label>
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
                </tr>
                @endforeach
              @else
                <tr>
                  <td><h5>Nenhuma Instituição ainda foi adicionado</h5></td>
                </tr>
              @endif
               </tbody>
            </table>
          </div>

              </div>
            </div>
          </div>
          </div>
        </div>
      </div>
    </div> 
    @endsection

