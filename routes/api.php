<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Categories
    Route::apiResource('categories', 'CategoriesApiController');

    // Locations
    Route::apiResource('locations', 'LocationsApiController');

    // Companies

    Route::apiResource('companies', 'CompaniesApiController');

    // Jobs
    Route::apiResource('jobs', 'JobsApiController');

    // ConfirmSystem
    Route::apiResource('ConfirmSystem', 'ConfirmSystemController');

    //RepEquipment
    Route::apiResource('repequipment', 'RepEquipmentController');

    //MailSettings
    Route::apiResource('mail', 'MailSettingController');

     //Cars
    Route::apiResource('car', 'CarController');
    
    //Task
    Route::apiResource('tasks', 'TaskController');

    //Inventory
    Route::apiResource('inventory', 'InventoryController');

    //Miasta
    Route::apiResource('miasta', 'MiastaController');
});
