<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group([
    'middleware' => 'auth:api'
], function () {
    Route::get('/permissions', 'RoleManager@permissionsIndex')
        ->name('permissions.index')
        ->middleware('role:Admin');

    Route::get('/roles', 'RoleManager@rolesIndex')
        ->name('roles.index')
        ->middleware('role:Admin');

    Route::post('/role/assign', 'RoleManager@assignRoleToUser')
        ->name('roles.assignRoleToUser')
        ->middleware('role:Admin');

    Route::post('/role/unassign', 'RoleManager@unassignRoleToUser')
        ->name('roles.unassignRoleToUser')
        ->middleware('role:Admin');
});

Route::middleware(['cors', 'json.response', 'auth:api'])->get('/user', function (Request $request) {
    return $request->user();
});

// Route::group(['middleware' => ['cors', 'json.response']], function () {

    // public routes
    Route::post('/login', 'Auth\ApiAuthController@login')->name('login.api');
    Route::post('/register','Auth\ApiAuthController@register')->name('register.api');
    Route::post('/logout', 'Auth\ApiAuthController@logout')->name('logout.api');
// });
