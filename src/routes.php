<?php


/*
|--------------------------------------------------------------------------
| Mass Importer Interface
|--------------------------------------------------------------------------
|
| Routes specific to the package
|
*/

Route::group(['middleware' => ['web','auth']], function(){
    Route::get('/importer', '\Weblid\Massdbinterface\Controllers\ImporterController@index');
    Route::post('/importer/import', '\Weblid\Massdbinterface\Controllers\ImporterController@import');
});

    

