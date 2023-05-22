@extends('layouts.app')

@section('content')
<form action="{{ route('documentos.store') }}" method="POST" enctype="multipart/form-data">
                   @csrf  
                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Adicionar novo Documento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>

                      <div class="modal-body">
                        <h6 class="fw-bold">Informações do documento</h6>
                        <div class="row g-3">
                          <div class="col-lg-6 col-md-12">
                            <div class="form-floating">
                              <input type="text" name="nome"class="form-control" placeholder="Nome do documento">
                              <label>Nome do documento</label>
                            </div>
                          </div>
                          <div class="col-lg-6 col-md-12">
                            <div class="form-floating">
                              <input type="text" name="origem" class="form-control" placeholder="Origem do documento">
                              <label>Origem do documento</label>
                            </div>
                          </div>
                
                          <div class="col-lg-6 col-md-12">
                            <div class="form-floating">
                              <input type="text" name="referencia" class="form-control" placeholder="Referência">
                              <label>Referência</label>
                            </div>
                          </div>
                          <div class="col-lg-6 col-md-12">
                            <div class="form-floating">
                              <select name="armario_id" class="form-select form-control">
                              @foreach($armarios as $armario)
                              <option value="{{$armario->id}}">{{$armario->nome}}</option>
                              @endforeach
                              </select>
                              <label for="floatingSelect">Número de série</label>
                            </div>
                          </div>
                          <div class="col-lg-12">
                            <label for="formFile" class="form-label">Anexo</label>
                            <input class="form-control" name="ficheiro" type="file" id="formFile">
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                      </div>
                    </div>
                  </div>
                </form>
                @endsection
