<?php

Route::get('/api/listUser', function() {
    return Datatables::queryBuilder(
                    DB::table("users")
                            ->select("users.id", "users.name", "users.email", DB::raw("coalesce(users.document::text,'') as document"), "roles.description as role", "stakeholder.business_name as stakeholder", "cities.description as city", "parameters.description as status")
                            ->leftjoin("roles", "roles.id", "users.role_id")
                            ->leftjoin("stakeholder", "stakeholder.id", "users.stakeholder_id")
                            ->leftjoin("cities", "cities.id", "users.city_id")
                            ->leftjoin("parameters", "parameters.code", DB::raw("users.status_id and parameters.group='generic'"))
            )->make(true);
});

Route::get('/users', 'Security\UsersController@index');
Route::get('/user/savePermission/{id}', 'Security\UserController@savePermission');
Route::post('/user/uploadExcel', 'Security\UserController@storeExcel');
Route::put('/user', 'Security\UserController@store');

Route::resource('/characteristic', 'Administration\CharacteristicController');

Route::resource('/user', 'Security\UsersController');
Route::get('/user/getListPermission/{id}', 'Security\UsersController@getPermission');
Route::put('/user/savePermission/{id}', 'Security\UsersController@savePermission');


Route::resource('/role', 'Security\RoleController');
Route::put('/role/savePermission/{id}', 'Security\RoleController@savePermissionRole');

Route::get('/getPermissionRole/{id}', 'Security\RoleController@getPermissionRole');

Route::get('/api/listRole', function() {
    return Datatables::eloquent(App\Models\Security\Roles::query())->make(true);
});

Route::resource('/permission', 'Security\PermissionController');
Route::get('/api/listPermission', 'Security\PermissionController@getPermission');
Route::get('/permission/{id}/getMenu', ['uses' => 'Security\PermissionController@getMenu']);