<?php

Route::resource('/routes', 'Operations\RoutesController');

Route::get('/api/listRoutes', function() {
    return Datatables::queryBuilder(
                    DB::table('routes')->orderBy("id", "asc")
            )->make(true);
});
