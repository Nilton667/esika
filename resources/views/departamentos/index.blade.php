@extends('layouts.app')

@section('content')

    <!-- start: page body -->
    <div class="page-body">
      <div class="inbox">
        <div class="d-flex flex-nowrap">
          <div class="order-1 custom_scroll">
            <ul class="menu-list list-unstyled mb-0">
              <!--li><a class="m-link active" href="/unidades"><i class="fa fa-inbox"></i><span>Informações</span></a></li-->
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
              <li class="breadcrumb-item active" aria-current="page"><a href="#">Departamentos</a></li>
            </ol>
          </div>
        </div> 
                 <div class="col-12">
            <div class="card">
              <div class="card-body">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Pesquisar...">
                  <button class="btn btn-secondary" type="button">Pesquisar</button>
                  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_customers" type="button">Adicionar novo Departamento</button>
                </div>
                <!-- Modal: Add new Customers -->
                <!-- <button class="btn btn-primary px-4 text-uppercase" data-bs-toggle="modal" data-bs-target="#add_customers" type="button">Add new Customers</button> -->
                <div class="modal fade" id="add_customers" tabindex="-1" aria-labelledby="add_customers" aria-hidden="true">
                  <div class="modal-dialog modal-lg modal-dialog-scrollable">
                    <div class="modal-content">
                      <form action="{{ route('departamentos.store') }}" method="post">
                      @csrf
                      <div class="modal-header">
                        <h5 class="modal-title">Adicionar novo Departamento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <h6 class="fw-bold">Informações sobre o Departamento</h6>
                        <div class="row g-3">
                          <div class="col-lg-6 col-md-12">
                            <div class="form-floating">
                              <input type="text" name="nome" class="form-control" placeholder="Nome">
                              <label>Nome</label>
                            </div>
                          </div>
                          <div class="col-lg-6 col-md-12">
                            <div class="form-floating">
                              <input type="text" name="email" class="form-control" placeholder="Last Name">
                              <label>Email</label>
                            </div>
                          </div>
                          <div class="col-lg-6 col-md-12">
                            <div class="form-floating">
                              <input type="text" name="telefone" class="form-control" placeholder="Date of Birth">
                              <label>Telefone</label>
                            </div>
                          </div>

                          
                          <div class="col-lg-6 col-md-12">
                            <div class="form-floating">
                              <select name="unidade_id" class="form-select form-control">
                              @foreach($unidades as $unidade)
                              <option value="{{$unidade->id}}">{{$unidade->nome}}</option>
                              @endforeach
                              </select>
                              <label for="floatingSelect">Instituição</label>
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
                  <th>Instituição</th>
                  <th>Acções</th>
                </tr>
              </thead>
              <tbody>
              @if(count($departamentos) > 0)
                @foreach($departamentos as $departamento)
                <tr>
                  <td>{{ $departamento->id }}</td>
                  <td>{{ $departamento->nome }}</td>
                  <td>{{ $departamento->email }}</td>
                  <td>{{ $departamento->telefone }}</td>
                  <td>{{ $departamento->unidade['nome'] }}</td>
                  <td>
                      <a href="#" data-bs-toggle="modal" data-bs-target="#edit_customers{{$departamento->id}}" class="btn btn-link btn-sm text-primary" data-bs-placement="top" title="Editar"><i class="fa fa-gear"></i></a>
                    <a href="{{ route('departamentos.destroy', $departamento->id) }}" class="btn btn-link btn-sm text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar"><i class="fa fa-trash"></i></button>
                  </td>

                  <div class="modal fade" id="edit_customers{{$departamento->id}}" tabindex="-1" aria-labelledby="edit_customers" aria-hidden="true">
                  <div class="modal-dialog modal-lg modal-dialog-scrollable">
                    <div class="modal-content">
                    <form action="{{ route('departamentos.update',$departamento->id) }}" method="post">
                    @csrf
                    @method('PUT')
                      <div class="modal-header">
                        <h5 class="modal-title">Editar Departamento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <h6 class="fw-bold">Informações básicas</h6>
                        <div class="row g-3">
                          <div class="col-lg-6 col-md-12">
                            <div class="form-floating">
                              <input type="text" value="{{$departamento->nome}}" name="nome" class="form-control" placeholder="Nome">
                              <label>Nome</label>
                            </div>
                          </div>
                          <div class="col-lg-6 col-md-12">
                            <div class="form-floating">
                              <input type="email" name="email" value="{{$departamento->email}}" class="form-control" placeholder="Last Name">
                              <label>Email</label>
                            </div>
                          </div>
                          <div class="col-lg-6 col-md-12">
                            <div class="form-floating">
                              <input type="text" name="telefone" value="{{$departamento->telefone}}" class="form-control" placeholder="Date of Birth">
                              <label>Telefone</label>
                            </div>
                          </div>

                          <div class="col-lg-6 col-md-12">
                            <div class="form-floating">
                              <select name="unidade_id" class="form-select form-control">
                              @foreach($unidades as $unidade)
                              <option value="{{$unidade->id}}">{{$unidade->nome}}</option>
                              @endforeach
                              </select>
                              <label for="floatingSelect">Instituição</label>
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
                  <td><h5>Nenhum Departamento foi adicionado ainda</h5></td>
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
    @endsection
