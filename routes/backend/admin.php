<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\SalesCompanyAdminController;
use App\Http\Controllers\Backend\SalesCompanyController;
use Tabuna\Breadcrumbs\Trail;

// All route names are prefixed with 'admin.'.
Route::redirect('/', '/admin/dashboard', 301);
Route::get('dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'));
    });


Route::resource('sales-companies',SalesCompanyController::class);
Route::resource('sales-companies-admin', SalesCompanyAdminController::class);
