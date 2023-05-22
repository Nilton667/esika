@extends('layouts.app')

@section('content')
   <!-- start: page body -->
   <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
      <div class="container-fluid">
        <div class="row g-3">
          <div class="col-xxl-3 col-lg-4 col-md-4">
            <div class="list-group list-group-custom sticky-top me-xl-4" style="top: 100px;">
              <a class="list-group-item list-group-item-action" href="#list-item-1">Meu Perfil</a>
              <a class="list-group-item list-group-item-action" href="#list-item-2">Actualizar Senha</a>
            </div>
          </div>
          <div class="col-xxl-8 col-lg-8 col-md-8">
            <div id="list-item-1" class="card fieldset border border-muted mt-0">
              <!-- form: profile details -->
              <span class="fieldset-tile text-muted bg-body">Meu Perfil:</span>
              <div class="card">
                <div class="card-body">
                  <form action="{{ route('perfil.update',$acc->id) }}" method="POST">
                  @csrf
                   @method('PUT')
                    <div class="row mb-3">
                      <label class="col-md-3 col-sm-4 col-form-label">Foto</label>
                      <div class="col-md-9 col-sm-8">
                        <div class="image-input avatar xxl rounded-4" style="background-image: url(assets/img/avatar.png)">
                          <div class="avatar-wrapper rounded-4" style="background-image: url(images/user.jpg)"></div>
                          <div class="file-input">
                            <input type="file" class="form-control" name="imagem" id="file-input">
                            <label for="file-input" class="fa fa-pencil shadow text-muted"></label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-md-3 col-sm-4 col-form-label">Nome*</label>
                      <div class="col-md-9 col-sm-8">
                        <input type="text" class="form-control form-control-lg" name="name" value="{{$acc->name}}">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-md-3 col-sm-4 col-form-label">Email*</label>
                      <div class="col-md-9 col-sm-8">
                        <input type="text" class="form-control form-control-lg" name="email" value="{{$acc->email}}">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-md-3 col-sm-4 col-form-label">Telefone *</label>
                      <div class="col-md-9 col-sm-8">
                        <input type="text" class="form-control form-control-lg" name="telefone" value="{{$acc->telefone}}">
                      </div>
                    </div>
                 
                </div>
                <div class="card-footer text-end">
                  <button class="btn btn-lg btn-light me-2" type="reset">Discartar</button>
                  <button class="btn btn-lg btn-primary" type="submit">Actualizar</button>
                </div>
              </div>
              </form>
            </div>

            <div id="list-item-2" class="card fieldset border border-muted mt-5">
              <!-- form: Change Password -->
              <span class="fieldset-tile text-muted bg-body">Actualizar Senha</span>
              <form action="/perfil" class="form" method="POST">
              @csrf
              @method('patch')
              <div class="card">
                <div class="card-body">
                  <div class="row g-3">
                    <div class="col-lg-4 col-md-12">
                      <div class="form-group">
                        <input type="text" class="form-control" value="{{$acc->name}}" disabled="" placeholder="Username">
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                      <div class="form-group">
                        <input type="email" class="form-control" value="{{$acc->email}}" disabled="" placeholder="Email">
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                      <div class="form-group">
                        <input type="number" class="form-control" value="{{$acc->telefone}}" disabled="" placeholder="Telefone">
                      </div>
                    </div>
                    <div class="col-12">
                      <h6 class="border-top pt-2 mt-2 mb-3">Actualizar Senha</h6>
                      <div class="mb-3">
                        <input type="text" name="current_password" class="form-control form-control-lg" placeholder="Senha Actual">
                      </div>
                      <div class="mb-1">
                        <input type="password" name="new_password" class="form-control form-control-lg" placeholder="Nova Senha">
                      </div>
                      <div>
                        <input type="password" name="new_password_confirmation" class="form-control form-control-lg" placeholder="Confirmar Nova Senha">
                        <span class="text-muted small">Mínimo 8 caracteres</span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer text-end">
                  <button class="btn btn-lg btn-light me-2" type="reset">Discartar</button>
                  <button class="btn btn-lg btn-primary" type="submit">Actualizar</button>
                </div>
              </div>
              </form>
            </div>
        
          </div>
        </div>
      </div>
    </div>
@endsection
