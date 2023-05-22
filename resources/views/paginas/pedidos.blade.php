@extends('layouts.app')

@section('content')
<!-- start: page body -->
<div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
      <div class="container-fluid">
        <div class="row g-3 row-deck">
          <!-- start: Connection Request -->
          <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12">
            <div class="card text-center p-2">
              <div class="card-body">
                    <h5>Pedidos de Registo de Conta</h5>
                <!--p class="text-muted">Click on the below buttons to launch a Connection Request example.</p-->
                <!-- Modal -->
                      <ul class="list-unstyled custom_scroll mb-0">
                      @if(count($users) > 0)
                         @foreach($users as $user)
                          <li class="card p-3 my-1 flex-row">
                            <img class="avatar rounded-circle" src="https://www.esika.ao/storage/app/public/{{$user->imagem }}" alt="">
                            <div class="flex-fill">
                              <div class="h6 mb-0">Saudações de acordo a hora do dia, eu sou <b>{{ $user->name }}</b>, meu email é <b>{{ $user->email }}</b></div>
                              <span class="text-muted small">e quero solicitar a quem de direito a permitir-me usar o sistema no departamento de <b>{{ $user->departamento['nome'] }}</b></span>
                              <div class="h6 mb-0">{{ $user->created_at->diffForHumans() }} </div>
                            </div>
                            <div class="d-flex align-items-center">
                    <form action="{{ route('pedidos.update',$user->id) }}" class="form" method="POST">
                      @csrf
                      @method('PUT')
                      <button type="submit" name="b1" class="btn mx-1 btn-light-primary"><i class="fa fa-check"></i><span class="d-none d-lg-inline-block ms-2">Aceitar</span></button>
                      </form>
                      <form action="{{ route('users.destroy',$user->id) }}" class="form" method="POST">
                    @csrf
                    @method('DELETE')
                      <button type="submit" name="b2" class="btn mx-1 btn-light-danger" data-position="top" data-delay="50" data-tooltip="Eliminar"><i class="fa fa-close"></i><span class="d-none d-lg-inline-block ms-2">Rejeitar</span></button>
                    </form>
                </div>
                    </li>
          @endforeach
          @else
          <li class="card p-3 my-1 flex-row">
              <h5 class="teal-text">Nenhum Pedido de Registo de Conta Registado</h5>
            </li>
        @endif
                     
          </ul>
              </div>
            </div>
          </div>
    @endsection
