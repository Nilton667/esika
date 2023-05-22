@extends('layouts.app')

@section('content')
<div class="row">
	<div class="section">
		
		<div class="col m11 s12">
			<div class="row">
				<h3 class="flow-text"><i class="material-icons">editar</i> Permissões disponíveis para a função {{ $funcao->name }}</h3>
				<div class="divider"></div>
			</div>
			<div class="row">
				
				<div class="col m7 offset-m2">
					
				<form action="{{ route('funcaos.permissaos.attach', $funcao->id) }}" method="POST">
                        @csrf
						<div class="card z-depth-2 hoverable">
						<div class="card-content">

                        @foreach ($permissaos as $permissao)
						<div class="input-field">
                                     <input type="checkbox" name="permissaos[]" value="{{ $permissao->id }}" id="chk_{{ $permissao->id }}" class="filled-in">
									<label for="chk_{{ $permissao->id }}">{{ $permissao->nome }}</label>
									
                        </div>
                        @endforeach
                       </div>
					   <div class="input-field">
								<p class="center"><button type="submit" class="btn btn-success">Vincular</button></p>
							</div>
					   </div>
                        
                                
					
                    </form>	
				</div>
			</div>
		</div>
	</div>
</div>
@endsection














