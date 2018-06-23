<?php

Route::get('/login', '\Modulos\Seguranca\Http\Controllers\Auth\AuthController@getLogin')->name('auth.login');
Route::post('/login', '\Modulos\Seguranca\Http\Controllers\Auth\AuthController@postLogin')->name('auth.login');
Route::get('/logout', '\Modulos\Seguranca\Http\Controllers\Auth\AuthController@logout')->name('auth.logout');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', '\Modulos\Seguranca\Http\Controllers\SelecionaModuloController@index')->name('index');

    Route::group(['prefix' => 'seguranca'], function () {

        Route::get('/', '\Modulos\Seguranca\Http\Controllers\DashboardController@index')->name('seguranca.index.index');

        Route::group(['prefix' => 'modulos'], function () {
            Route::get('/', '\Modulos\Seguranca\Http\Controllers\ModulosController@index')->name('seguranca.modulos.index');
        });

        Route::group(['prefix' => 'perfis'], function () {
            Route::get('/', '\Modulos\Seguranca\Http\Controllers\PerfisController@index')->name('seguranca.perfis.index');
            Route::get('/create', '\Modulos\Seguranca\Http\Controllers\PerfisController@getCreate')->name('seguranca.perfis.create');
            Route::post('/create', '\Modulos\Seguranca\Http\Controllers\PerfisController@postCreate')->name('seguranca.perfis.create');
            Route::get('/edit/{id}', '\Modulos\Seguranca\Http\Controllers\PerfisController@getEdit')->name('seguranca.perfis.edit');
            Route::put('/edit/{id}', '\Modulos\Seguranca\Http\Controllers\PerfisController@putEdit')->name('seguranca.perfis.edit');
            Route::post('/delete', '\Modulos\Seguranca\Http\Controllers\PerfisController@postDelete')->name('seguranca.perfis.delete');
            Route::get('/atribuirpermissoes/{id}', '\Modulos\Seguranca\Http\Controllers\PerfisController@getAtribuirpermissoes')->name('seguranca.perfis.atribuirpermissoes');
            Route::post('/atribuirpermissoes/{id}', '\Modulos\Seguranca\Http\Controllers\PerfisController@postAtribuirpermissoes')->name('seguranca.perfis.atribuirpermissoes');
        });

        Route::group(['prefix' => 'itens'], function () {
            Route::get('/', '\Modulos\Seguranca\Http\Controllers\ModulosController@index')->name('seguranca.itens.index');
        });
    });


});
