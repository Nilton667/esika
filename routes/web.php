<?php


//

Auth::routes();


// Página inicial
Route::get('/','Site\HomeController@index');

Route::get('/painel','Admin\PainelController@index');
Route::get('/funcaospermissao','Admin\PainelController@funcaosPermissao')->middleware('auth');
Route::get('/error','Admin\PainelController@error')->middleware('auth');

// users
Route::resource('users','Admin\UsersController');
 
    /**
     * Funcao x User
     */
    Route::get('users/{id}/funcao/{idFuncao}/detach', 'Admin\FuncaoUserController@detachFuncaoUser')->name('users.funcao.detach');
    Route::post('users/{id}/funcaos', 'Admin\FuncaoUserController@attachFuncaosUser')->name('users.funcaos.attach');
    Route::any('users/{id}/funcaos/create', 'Admin\FuncaoUserController@funcaosAvailable')->name('users.funcaos.available');
    Route::get('users/{id}/funcaos', 'Admin\FuncaoUserController@funcaos')->name('users.funcaos');
    Route::get('funcaos/{id}/users', 'Admin\FuncaoUserController@users')->name('funcaos.users');


     /**
     * Document x User
     */
    Route::get('users/{id}/documento/{idDocument}/detach', 'Admin\DocumentoUserController@detachUserDocument')->name('users.documento.detach');
    Route::post('users/{id}/documentos', 'Admin\DocumentoUserController@attachDocumentsUser')->name('users.documentos.attach');
    Route::any('users/{id}/documentos/create', 'Admin\DocumentoUserController@documentosAvailable')->name('users.documentos.available');
    Route::get('users/{id}/documentos', 'Admin\DocumentoUserController@documentos')->name('users.documentos');
   
    
    Route::get('documentos/{id}/user/{idUser}/detach', 'Admin\DocumentoUserController@detachDocumentUser')->name('documentos.user.detach');
    Route::post('documentos/{id}/users', 'Admin\DocumentoUserController@attachUsersDocument')->name('documentos.users.attach');
    Route::post('documentosd/{id}/users', 'Admin\DocumentoUserController@attachUsersDocumentd')->name('documentosd.users.attach');
    Route::any('documentos/{id}/users/create', 'Admin\DocumentoUserController@usersAvailable')->name('documentos.users.available');
    Route::any('documentosd/{id}/users/create', 'Admin\DocumentoUserController@usersAvailabled')->name('documentosd.users.available');
    Route::get('documentos/{id}/users', 'Admin\DocumentoUserController@users')->name('documentos.users');
    Route::get('distribuicao/{id}/users', 'Admin\DocumentoUserController@userss')->name('distribuicao.users');
    Route::get('users/{id}/documento', 'Admin\DocumentoUserController@documentos')->name('users.documentos');

    // Tarefas
Route::resource('tarefas','Admin\TarefaController');

    /**
     * Permissao
     */
    Route::resource('permissaos', 'Admin\PermissaoController');

    /**
     * Permissao x Funcao
     */
    Route::get('funcaos/{id}/permissao/{idPermissao}/detach', 'Admin\PermissaoFuncaoController@detachPermissaoFuncao')->name('funcaos.permissao.detach');
    Route::post('funcaos/{id}/permissaos', 'Admin\PermissaoFuncaoController@attachPermissaosFuncao')->name('funcaos.permissaos.attach');
    Route::any('funcaos/{id}/permissaos/create', 'Admin\PermissaoFuncaoController@permissaosDisponiveis')->name('funcaos.permissaos.available');
    Route::get('funcaos/{id}/permissaos', 'Admin\PermissaoFuncaoController@permissaos')->name('funcaos.permissaos');
    Route::get('permissaos/{id}/funcao', 'Admin\PermissaoFuncaoController@funcaos')->name('permissaos.funcaos');

// unidades
Route::resource('unidades','Admin\UnidadesController');
// departamentos
Route::resource('departamentos','Admin\DepartamentosController');
// categories
Route::resource('armarios','Admin\ArmarioController');
Route::get('/seriedocumental','Admin\ArmarioController@serie');
Route::get('/armario/{id}/documento','Admin\ArmarioController@open');
// documentos
Route::resource('documentos','Admin\DocumentosController');
Route::post('concluir','Admin\DocumentosController@concluir')->name('concluir.update');


Route::get('documentos/download/{id}','Admin\DocumentosController@download');
Route::get('documentos/open/{id}','Admin\DocumentosController@open');
Route::get('documentos/tram/{id}','Admin\DocumentosController@tram');
Route::get('pendentes','Admin\DocumentoUserController@pendentes');
Route::get('execucao','Admin\DocumentoUserController@execucao');
Route::get('concluidos','Admin\DocumentoUserController@concluidos');

// Distribuição
Route::get('distribuicao','Admin\DocumentoUserController@distribuicao');

// shared
Route::resource('partilhar','Admin\PartilharController');
// funcaos and permissaos
Route::resource('funcaos','Admin\FuncaoController');
// profile
Route::resource('perfil','Admin\PerfilController');
Route::patch('perfil','Admin\PerfilController@changePassword')->name('actualizarSenha');
// registeration requests
Route::resource('pedidos','Admin\PedidosController');

