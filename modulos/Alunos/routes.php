<?php

Route::group(['middleware' => 'auth'], function () {

    Route::group(['prefix' => 'alunos'], function () {

        Route::get('/', '\Modulos\Alunos\Http\Controllers\AlunosController@index')->name('alunos.index.index');
    });
});
