<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/**
 * HIDRO-PROJEKT Routes
 * All the routes related to HIDRO-PROJEKT company
 */
Route::prefix('/')
    ->group(Function(){
        // Route::get('/', function () {
        //     return "HIDRO-PROJEKT";
        // });

        Route::controller(HumanResourcesController::class)
            ->group(function(){
                Route::get('/hr', 'index');

                Route::get('/hr/workers', 'allWorkers')->name('hp_allWorkers');

                //PDF routes
                Route::get('payroll_labels_pdf','payrollLabels')->name('hp_payrollLabels');
            });

        
    });
