
@extends('layouts.app')

@section('content')
	<div class="section">
		
		<div class="col m11 s12">
			<div class="row">
				<h3 class="flow-text"> <strong> Despachar:</strong> {{ $document->nome }} </h3>
				<div class="divider"></div>
			</div>

			<div class="col-12">
            <!-- invoices: all -->
            <div class="card fieldset border border-muted">
              <span class="fieldset-tile text-muted bg-body">Despachar Para:</span>
              <form action="{{ route('documentos.users.attach', $document->id) }}" method="POST">
                        @csrf	
              <table id="invoice_list" class="table card-table align-middle mb-0">
                <thead>
                  <tr>
                    <th>
                      <div class="form-check" style="font-size: 16px;">
                        <input class="form-check-input select-all" type="checkbox" value=""> Enviar Para todos
                      </div>
					
                    </th>
                    <th>Nome</th>
                    <th>Departamento</th>                
                  </tr>
                </thead>
                <tbody>	
				
				@foreach($users as $user)
                  <tr class="row-selectable">
                    <td>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="users[]" value="{{ $user->id }}">
                      </div>
                    </td>
                 
                    <td>
                      <div class="d-flex align-items-center">
                        <img src="https://www.esika.ao/storage/app/public/{{$user->imagem}}" class="rounded-circle sm avatar" alt="">
                        <div class="ms-2 mb-0">{{ $user->name }}</div>
                      </div>
                    </td>
                    <td class="fw-bold">{{ $user->departamento['nome'] }}</td>
                   
                  </tr>
				  @endforeach

				 
                </tbody>
              </table>
              <br>
              
							<button type="submit" class="btn btn-success">Despachar</button>
				     
                  </form>
            </div>
             
          </div>

			</div>
		</div>
	
@endsection














