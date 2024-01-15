<?php

use App\Http\Controllers\HidroProjekt\AdminController;
use App\Http\Controllers\HidroProjekt\AssetsController;
use App\Http\Controllers\HidroProjekt\HumanResourcesController;
use App\Http\Controllers\HidroProjekt\WorkDayRecordController;
use App\Http\Controllers\HidroProjekt\WorkPlanningController;
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
 * BDE(betriebsdatenerfassung): DE --> operational data collection
 * All routes related to onside data
 */
 Route::prefix('/bde')
    ->middleware(['auth','emptyWorkingDay'])
    ->group(Function(){
        Route::controller(WorkDayRecordController::class)
            ->group(function(){
                Route::get('/','index')->name('hp_bdeHome');
                Route::get('/newEntry','newWorkingDayEntry')->name('hp_newWorkingDayEntry');
                Route::get('/wd_record/{id}','workingDayEntry')->name('hp_workingDayEntry');
            });

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
                Route::get('/workers/new', 'newWorkerForm')->name('hp_newWorkerForm');
                Route::post('/workers/new', 'addNewWorker')->name('hp_addNewWorker');
                Route::get('/workers/{id}', 'showWorker')->name('hp_showWorker');
                Route::put('/workers/{id}', 'updateWorker')->name('hp_updateWorker');
                Route::delete('/workers/{id}', 'deleteWorker')->name('hp_deleteWorker');

                //PDF routes
                Route::get('payroll_labels_pdf','payrollLabels')->name('hp_payrollLabels');
            });

        Route::get('test',function(){
            AdminModuleMenuItemsService::getModuleInfo();
        });

        Route::controller(AssetsController::class)
            ->prefix('/assets')
            ->group(function(){

                Route::get('/fleet', 'companyCars')->name('hp_companyCars');
                Route::get('/fleet/{plates}', 'showCompanyCar')->name('hp_showCompanyCar');
                Route::post('/fleet', 'addCompanyCars')->name('hp_addCompanyCars');
                Route::post('/fleet/carAvatar','uploadCarAvatarImage')->name('hp_uploadCarAvatarImage');

            });

        Route::controller(WorkPlanningController::class)
            ->prefix('/wp')
            ->group(function(){

                Route::get('/construction_sites', 'constructionSites')->name('hp_constructionSites');
                Route::post('/construction_sites', 'addNewConstructionSites')->name('hp_addNewConstructionSites');


            });
        
    });
