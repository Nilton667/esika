@extends('layouts.app')

@section('content')
<div class="row">
	<div class="section">
		
		<div class="col m11 s12">
			<div class="row">
				<h3 class="flow-text"><i class="material-icons">editar</i> Funções disponíveis para <strong>{{ $user->name }}</strong></h3>
				<div class="divider"></div>
			</div>
			<div class="row">
				<div class="col m7 offset-m2">
				<form action="{{ route('users.funcaos.attach', $user->id) }}" method="POST">
                        @csrf
						<div class="card z-depth-2 hoverable">
						<div class="card-content">	
							  	@foreach($funcaos as $funcao)
								  <div class="input-field">
									<p>
									<input type="checkbox" name="funcaos[]" value="{{ $funcao->id }}" id="chf_{{ $funcao->id }}" class="filled-in">
									<label for="chf_{{ $funcao->id }}">{{ $funcao->nome }}</label>
									</p>
									</div>
							  	@endforeach
						  
						  	</div>
						  	<br>
							<div class="input-field">
							<p class="center"><button type="submit" class="btn btn-success">Vincular</button></p>
							</div>
						</div>
					</div>
                </form>
			</div>
		</div>
		</div>
	</div>
@endsection














