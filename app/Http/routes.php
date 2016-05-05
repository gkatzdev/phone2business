<?php

Route::group(['middleware' => ['web']], function () {
    Route::get('', array('as' => 'login', 'uses' => 'EmployeeController@index'));
    Route::get('/', array('as' => 'login', 'uses' => 'EmployeeController@index'));

    // Crud Module Routes
    Route::group(['prefix' => '/'], function() {

        //Employees
        Route::group(['prefix' => 'employee'], function() {
            Route::get('', ['as' => 'employee', 'uses' => 'EmployeeController@index']);
            Route::post('', ['as' => 'post.employee', 'uses' => 'EmployeeController@insertEmployee']);
            Route::put('', ['as' => 'update.employee', 'uses' => 'EmployeeController@updateEmployee']);
            Route::delete('', ['as' => 'delete.employee', 'uses' => 'EmployeeController@deleteEmployee']);
        });

        //Companies
        Route::group(['prefix' => 'company'], function() {
            Route::get('', ['as' => 'company', 'uses' => 'CompanyController@index']);
            Route::post('', ['as' => 'post.company', 'uses' => 'CompanyController@insertCompany']);
            Route::put('', ['as' => 'update.company', 'uses' => 'CompanyController@updateCompany']);
            Route::delete('', ['as' => 'delete.company', 'uses' => 'CompanyController@deleteCompany']);
        });

    });
});
