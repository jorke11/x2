<?php

Route::resource('/routes', 'Operations\RoutesController');
Route::resource('/dinamic', 'Operations\DinamicController');

Route::post('/dinamic/detail', 'Operations\DinamicController@storeDetail');
Route::put('/dinamic/detail/{id}', 'Operations\DinamicController@updateDetail');
Route::get('/dinamic/detail/{id}/edit', 'Operations\DinamicController@editDetail');
Route::delete('/dinamic/detail/{id}', 'Operations\DinamicController@destroyDetail');

Route::get('/api/listRoutes', function() {
    return Datatables::queryBuilder(
                    DB::table('routes')->orderBy("id", "asc")
            )->make(true);
});
Route::get('/api/listDinamic', function() {
    return Datatables::queryBuilder(
                    DB::table('dinamics')->orderBy("id", "asc")
            )->make(true);
});
