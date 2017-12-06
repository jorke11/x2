<?php

Route::resource('/clients', 'Clients\ClientController');
Route::post('/clients/upload', 'Clients\ClientController@uploadImage');
Route::post('/clients/uploadExcel', 'Clients\ClientController@uploadExcel');
Route::post('/clients/uploadClient', 'Clients\ClientController@uploadclient');
Route::put('/clients/checkmain/{id}', 'Clients\ClientController@checkMain');
Route::delete('/clients/deleteImage/{id}', 'Clients\ClientController@deleteImage');
Route::delete('clients/deletePrice/{id}', 'Clients\ClientController@destroyPrice');
Route::get('/clients/getImages/{id}', 'Clients\ClientController@getImages');

Route::post('/clients/StoreSpecial', 'Clients\ClientController@storeSpecial');
Route::put('/clients/updatePrice/{id}', 'Clients\ClientController@updatePrice');
Route::put('/clients/updatePriceId/{id}', 'Clients\ClientController@updatePriceId');
Route::put('/clients/UpdateContact/{id}', 'Clients\ClientController@updateContact');
Route::post('/clients/StoreContact', 'Clients\ClientController@storeContact');
Route::delete('/clients/deleteContact/{id}', 'Clients\ClientController@deleteContact');
Route::post('/clients/addChage', 'Clients\ClientController@addChanges');
Route::get('/clients/contact/{id}', 'Clients\ClientController@editContact');
Route::delete('/clients/branch/{id}', 'Clients\ClientController@destroyBranch');

Route::post('/clients/addTax', 'Clients\ClientController@storeTax');
Route::put('/clients/UpdateTax', 'Clients\ClientController@updateTax');
Route::delete('/clients/deleteTax/{id}', 'Clients\ClientController@deleteTax');
Route::post('/clients/addComment', 'Clients\ClientController@storeComment');
Route::get('/clients/{id}/getBranch', ['uses' => 'Clients\ClientController@getBranch']);
Route::get('/clients/{id}/getBranchId', ['uses' => 'Clients\ClientController@getBranchId']);
Route::get('/clients/{id}/getSpecialId', ['uses' => 'Clients\ClientController@getSpecialId']);
Route::post('/clients/uploadExcelCode', 'Clients\ClientController@storeExcelCode');

Route::get('/api/listClient', function() {

    $query = DB::table('vclient');

    if (Auth::user()->role_id != 1) {
        $query->where("responsible_id", Auth::user()->id);
    }
    return Datatables::queryBuilder($query)->make(true);
});

Route::resource('/parameter', 'Administration\ParametersController');

Route::get('/api/listParameter', function() {
    return Datatables::queryBuilder(
                    DB::table('parameters')->orderBy("id", "asc")
            )->make(true);
});

Route::resource('/city', 'Administration\CityController');
Route::post('/city/uploadExcel', 'Administration\CityController@storeExcel');


Route::get('/api/listCity', function() {
    $query = DB::table("vcities");
    return Datatables::queryBuilder($query)->make(true);
});

Route::get('/api/listDepartment', function() {
    return Datatables::eloquent(App\Models\Administration\Department::query())->make(true);
});

Route::resource('/department', 'Administration\DepartmentController');
Route::post('/department/uploadExcel', 'Administration\DepartmentController@storeExcel');

Route::get('/api/listEmail', function() {
    return Datatables::eloquent(App\Models\Administration\Emails::query())->make(true);
});

Route::resource('/email', 'Administration\EmailController');
Route::post('/email/detail', 'Administration\EmailController@storeDetail');
Route::put('/email/detail/{id}', 'Administration\EmailController@updateDetail');
Route::get('/email/detail/{id}/edit', 'Administration\EmailController@editDetail');
Route::delete('/email/detail/{id}', 'Administration\EmailController@destroyDetail');

