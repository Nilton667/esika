@extends('layouts.app')

@section('content')
  <!-- Admin Dashboard -->
  <div class="container">
    <div class="row">
      <div class="col s12">
        
        <div class="divider"></div>
      </div>
      <div class="section">
     
       <h4>O sr(a) <strong>{{auth()->user()->name}}</strong> não tem permissão para acessar aqui por favor contactar o Administrador do sistema obrigado</h4>
       
      </div>
    </div>
  </div>
@endsection
