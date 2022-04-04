<?php

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


Route::group(['middleware' => ['api'], 'namespace' => 'App\Http\Controllers\Api'], function() {
    /** API: Last Company ID
     * Type: GET
     */
    Route::get('/last-company-id', 'SalesCompanyApiController@lastCompanyId');


    /**
     * API: Sales Company Store
     * Type: POST
     */
    Route::post('/sales-company-store', 'SalesCompanyApiController@store');


    /**
     * API: Country List
     * Type: GET
     */
    Route::get('/country-list','CountryApiController@getCountryList');


    /**
     * API: Country List
     * Type: GET
     */
    Route::get('/language-list','LanguageApiController@getLanguageList');


    /**
     * API: Employee Registration
     * Type: POST
     */
    Route::post('/employee-registration', 'EmployeeApiController@registration');

});
