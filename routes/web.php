<?php

use App\Http\Controllers\HidroProjekt\AdminController;
use App\Http\Controllers\HidroProjekt\HumanResourcesController;
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

Route::prefix('/')
    ->middleware(['auth','userRights'])
    ->group(Function(){

        Route::controller(AdminController::class)
            ->group(function(){
                Route::get('/admin/users', 'users')->name('hp_users');
            });

        Route::controller(HumanResourcesController::class)
            ->group(function(){
                Route::get('/hr', 'index');

                Route::get('/hr/workers', 'allWorkers')->name('hp_allWorkers');

                //PDF routes
                Route::get('payroll_labels_pdf','payrollLabels')->name('hp_payrollLabels');
            });

        
    });
