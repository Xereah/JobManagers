<?php

//JOBS
Route::get('/' , [App\Http\Controllers\Admin\JobsController::class, 'index'])->name('index')->middleware(['auth']);
Route::get('/home' , [App\Http\Controllers\Admin\JobsController::class, 'index'])->name('index')->middleware(['auth']);
Route::get('/test' , [App\Http\Controllers\Admin\JobsController::class, 'test'])->name('test')->middleware(['auth']);
Route::get('/live_search/action', [App\Http\Controllers\Admin\JobsController::class, 'action'])->name('live_search.action')->middleware(['auth']);
Route::post('/job/store/add/new', [App\Http\Controllers\Admin\JobsController::class, 'store'])->name('store');
Route::post('/job/update/{id}', [App\Http\Controllers\Admin\JobsController::class, 'update'])->name('update');
Route::get('/job/editone/{id}', [App\Http\Controllers\Admin\JobsController::class, 'editone'])->name('editone');
Route::get('/job/search', [App\Http\Controllers\Admin\JobsController::class, 'search_index'])->name('search_index');

//USER SETTINGS
Route::get('/user/settings' , [App\Http\Controllers\Admin\UsersController::class, 'settings'])->name('settings')->middleware(['auth']);
Route::post('/user/settings/update', [App\Http\Controllers\Admin\UsersController::class, 'updatesettings'])->name('updatesettings');
Auth::routes(['register' => false]);

//MAIL
Route::get('/configuration/mail' , [App\Http\Controllers\Admin\MailSettingController::class, 'index'])->name('index')->middleware(['auth']);
Route::post('/configuration/mail/update' , [App\Http\Controllers\Admin\MailSettingController::class, 'update'])->name('update')->middleware(['auth']);

//strona główna
Route::get('search', 'HomeController@search')->name('search');
Route::resource('jobs', 'JobController')->only(['index', 'show']);
Route::get('category/{category}', 'CategoryController@show')->name('categories.show');
Route::get('location/{location}', 'LocationController@show')->name('locations.show');

Route::get('print/{job}', [App\Http\Controllers\Admin\JobsController::class, 'print'])->name('print');
Route::get('/is_loan/{id}', [App\Http\Controllers\Admin\RepEquipmentController::class, 'is_loan'])->name('is_loan');
Route::get('/is_loan_delete/{id}', [App\Http\Controllers\Admin\RepEquipmentController::class, 'is_loan_delete'])->name('is_loan_delete');
Route::get('/eq_delete/{id}', [App\Http\Controllers\Admin\RepEquipmentController::class, 'delete'])->name('delete');
Route::get('/job_delete/{id}', [App\Http\Controllers\Admin\JobsController::class, 'destroy'])->name('destroy');

Route::get('/is_done/{id}', [App\Http\Controllers\Admin\TaskController::class, 'is_done'])->name('is_done');


//Inventory
Route::get('/inventory/drukarki' , [App\Http\Controllers\Admin\InventoryController::class, 'drukarki'])->name('drukarki')->middleware(['auth']);
Route::post('/inventory/drukarki/add', [App\Http\Controllers\Admin\InventoryController::class, 'store_drukarki'])->name('store_drukarki');

Route::get('/inventory/fiskalne' , [App\Http\Controllers\Admin\InventoryController::class, 'fiskalne'])->name('fiskalne')->middleware(['auth']);
Route::post('/inventory/fiskalne/add', [App\Http\Controllers\Admin\InventoryController::class, 'store_fiskalne'])->name('store_fiskalne');

Route::get('/inventory/komputery' , [App\Http\Controllers\Admin\InventoryController::class, 'komputery'])->name('komputery')->middleware(['auth']);
Route::post('/inventory/komputery/add', [App\Http\Controllers\Admin\InventoryController::class, 'store_komputery'])->name('store_komputery');
Route::get('/job/edit_pc/{id}', [App\Http\Controllers\Admin\InventoryController::class, 'edit_pc'])->name('edit_pc');

Route::get('/inventory/monitory' , [App\Http\Controllers\Admin\InventoryController::class, 'monitory'])->name('monitory')->middleware(['auth']);
Route::post('/inventory/monitory/add', [App\Http\Controllers\Admin\InventoryController::class, 'store_monitory'])->name('store_monitory');

Route::get('/inventory/notebooki' , [App\Http\Controllers\Admin\InventoryController::class, 'notebooki'])->name('notebooki')->middleware(['auth']);
Route::post('/inventory/notebooki/add', [App\Http\Controllers\Admin\InventoryController::class, 'store_notebooki'])->name('store_notebooki');

Route::get('/inventory/ups' , [App\Http\Controllers\Admin\InventoryController::class, 'ups'])->name('ups')->middleware(['auth']);
Route::post('/inventory/ups/add', [App\Http\Controllers\Admin\InventoryController::class, 'store_ups'])->name('store_ups');

Route::get('/inventory/siec' , [App\Http\Controllers\Admin\InventoryController::class, 'siec'])->name('siec')->middleware(['auth']);
Route::post('/inventory/siec/add', [App\Http\Controllers\Admin\InventoryController::class, 'store_siec'])->name('store_siec');

Route::get('/inventory/pozostale' , [App\Http\Controllers\Admin\InventoryController::class, 'pozostale'])->name('pozostale')->middleware(['auth']);
Route::post('/inventory/pozostale/add', [App\Http\Controllers\Admin\InventoryController::class, 'store_pozostale'])->name('store_pozostale');

Route::get('/getTask/{id}', [App\Http\Controllers\Admin\JobsController::class, 'getTask'])->name('getTask');

Route::post('/storeTask', [App\Http\Controllers\Admin\TypeTaskController::class, 'storeTask'])->name('storeTask');

Route::post('/fullcalenderAjax', [App\Http\Controllers\Admin\TaskController::class, 'ajax'])->name('ajax');
Route::get('/fullcalender' , [App\Http\Controllers\Admin\TaskController::class, 'calendar'])->name('calendar');
Route::get('/calendar' , [App\Http\Controllers\Admin\TaskController::class, 'calendar'])->name('calendar');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', [App\Http\Controllers\Admin\JobsController::class, 'index'])->name('index')->middleware(['auth']);
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Categories
    Route::delete('categories/destroy', 'CategoriesController@massDestroy')->name('categories.massDestroy');
    Route::resource('categories', 'CategoriesController');

    // Locations
    Route::delete('locations/destroy', 'LocationsController@massDestroy')->name('locations.massDestroy');
    Route::resource('locations', 'LocationsController');

    // Companies
    Route::delete('companies/destroy', 'CompaniesController@massDestroy')->name('companies.massDestroy');
    Route::post('companies/media', 'CompaniesController@storeMedia')->name('companies.storeMedia');
    Route::resource('companies', 'CompaniesController');

    // Jobs
    Route::delete('jobs/destroy', 'JobsController@massDestroy')->name('jobs.massDestroy');    
    Route::resource('jobs', 'JobsController');

    // Projects
    Route::delete('project/destroy', 'ProjectController@massDestroy')->name('project.massDestroy');
    Route::resource('project', 'ProjectController');

    // TaskType
    Route::delete('tasktype/destroy', 'TaskTypeController@massDestroy')->name('tasktype.massDestroy');
    Route::resource('tasktype', 'TaskTypeController');

    // TypeTask
    Route::delete('typetask/destroy', 'TypeTaskController@massDestroy')->name('typetask.massDestroy');
    Route::resource('typetask', 'TypeTaskController');

     // car
     Route::delete('car/destroy', 'CarController@massDestroy')->name('car.massDestroy');
     Route::resource('car', 'CarController');

    //RepEquipment
    Route::resource('repequipment', 'RepEquipmentController');
    // ConfirmSytem
    Route::resource('ConfirmSystem', 'ConfirmSystemController');
    Route::get('/getEmployees/{id}', [App\Http\Controllers\Admin\ConfirmSystemController::class, 'getEmployees'])->name('getEmployees');
 

     //Tasks
     Route::resource('tasks', 'TaskController');

     //Inventory
      Route::resource('inventory', 'InventoryController');

      //Miasta
      Route::resource('miasta', 'MiastaController');
});

Route::get('/test-mail',function(){

  $message = "Testing mail";

  \Mail::raw('Hi, welcome!', function ($message) {
    $message->to('patrykstruzik@onet.pl')
      ->subject('Testing mail')
      ->setBody(view('admin.ConfirmSystem.edit')); 
  });

  dd('sent');

});

Route::get('/test-mail1',function(){

    $message = "Testing mail";
  
    Mail::send([], [], function($message)
{
    $message->to('patrykstruzik@onet.pl')
        ->subject('Tytuł wiadomości')
        ->setBody(view('admin.ConfirmSystem.edit')); 
});
  
    dd('sent');
  
 });

 Route::get('/SendMail/{id}', [App\Http\Controllers\Admin\ConfirmSystemController::class, 'SendMail'])->name('SendMail');