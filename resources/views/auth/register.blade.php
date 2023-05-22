@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col m8 offset-m2 s12">
      <div class="card hoverable">
        <div class="card-content">
          <span class="card-title">Registar</span>
          <div class="divider"></div>
          <div class="section">
            <form action="{{ route('register') }}" method="POST">
              {{ csrf_field() }}

              <div class="input-field{{ $errors->has('name') ? ' has-error' : '' }}">
                <i class="material-icons prefix">account_circle</i>
                <input type="text" name="name" id="name" value="{{ old('name') }}" autofocus>
                <label for="name" class="active">Name</label>
                @if ($errors->has('name'))
                  <span class="red-text">
                      <strong>{{ $errors->first('name') }}</strong>
                  </span>
                @endif
              </div>
              <div class="input-field{{ $errors->has('email') ? ' has-error' : '' }}">
                <i class="material-icons prefix">email</i>
                <input type="email" name="email" id="email" value="{{ old('email') }}">
                <label for="email" class="active">Email</label>
                @if ($errors->has('email'))
                  <span class="red-text">
                    <strong>{{ $errors->first('email') }}</strong>
                  </span>
                @endif
              </div>
              <div class="input-field{{ $errors->has('department') ? ' has-error' : '' }}">
                <i class="material-icons prefix">group</i>
                 <select name="department_id" id="department_id">
                  <option value="" disabled selected>Escolher Orgão</option>
                  @if(count($depts) > 0)
                    @foreach($depts as $dept)
                      <option value="{{ $dept->id }}">{{ $dept->dptName }}</option>
                    @endforeach
                  @endif
                </select>
                <label for="department_id">Orgãos</label>
                @if ($errors->has('department'))
                  <span class="red-text">
                    <strong>{{ $errors->first('department') }}</strong>
                  </span>
                @endif
              </div>
              <div class="input-field{{ $errors->has('password') ? ' has-error' : '' }}">
                <i class="material-icons prefix">vpn_key</i>
                <input type="password" name="password" id="password">
                <label for="password" class="active">Senha</label>
                @if ($errors->has('password'))
                  <span class="red-text">
                    <strong>{{ $errors->first('password') }}</strong>
                  </span>
                @endif
              </div>
              <div class="input-field">
                <i class="material-icons prefix">vpn_key</i>
                <input type="password" name="password_confirmation" id="password-confirm" required>
                <label for="password-confirm" class="active">Confirmar senha</label>
              </div>
              <div class="input-field">
                <button type="submit" name="register" class="btn waves-effect waves-light">Registar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
