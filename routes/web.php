<?php

use App\Http\Controllers\HidroProjekt\AdminController;
use App\Http\Controllers\HidroProjekt\HumanResourcesController;
use App\Services\HidroProjekt\AdminModuleMenuItemsService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

/**
 * HIDRO-PROJEKT Routes
 * All the routes related to HIDRO-PROJEKT company
 */
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/**
 * BDE routes 
 * BDE(betriebsdatenerfassung): de -> operational data collection
 * All routes related to onside data
 */
 Route::prefix('/bde')
    ->middleware(['auth'])
    ->group(Function(){

    });


/**
 * Administration and management routes
 * All routes related to business monitoring and planning 
 */
Route::prefix('/')
    ->middleware(['auth','userRights'])
    ->group(Function(){

        Route::controller(AdminController::class)
            ->prefix('/adm')
            ->group(function(){
                Route::get('/users', 'users')->name('hp_users');
            });

        Route::controller(HumanResourcesController::class)
            ->prefix('/hr')
            ->group(function(){
                Route::get('/', 'index');

                Route::get('/workers', 'allWorkers')->name('hp_allWorkers');

                //PDF routes
                Route::get('payroll_labels_pdf','payrollLabels')->name('hp_payrollLabels');
            });

        Route::get('test',function(){
            AdminModuleMenuItemsService::getModuleInfo();
        });

        
    });
