@extends('layouts.app')

@section('content')
<div class="row">
	<div class="section">

		<div class="col m11 s12">
			<div class="row">
				<h3 class="flow-text"><i class="material-icons">editar</i> Documentos a partilhar com <strong>{{ $user->name }}</strong></h3>
				<div class="divider"></div>
			</div>
			<div class="row">
				<div class="col m7 offset-m2">
				<form action="{{ route('users.documentos.attach', $user->id) }}" method="POST">
                        @csrf
						<div class="card z-depth-2 hoverable">
						<div class="card-content">
							<div class="input-field">
							  	@foreach($documentos as $documento)
									<p>
									<input type="checkbox" name="documentos[]" value="{{ $documento->id }}" id="doc{{ $documento->id }}" class="filled-in">
									<label for="doc{{ $documento->id }}">{{ $documento->nome }}</label>
									</p>
							  	@endforeach
						  	</div>
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














