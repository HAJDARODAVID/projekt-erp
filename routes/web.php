<?php

use App\Models\MaterialMasterData;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\ParametersController;
use App\Http\Controllers\WorkDayDiaryController;
use App\Http\Controllers\HidroProjekt\AdminController;
use App\Http\Controllers\HidroProjekt\AssetsController;
use App\Http\Controllers\HidroProjekt\CalculatorController;
use App\Http\Controllers\HidroProjekt\TicketController;
use App\Http\Controllers\HidroProjekt\StorageController;
use App\Services\HidroProjekt\WP\ConstructionSiteService;
use App\Services\HidroProjekt\AdminModuleMenuItemsService;
use App\Http\Controllers\HidroProjekt\WorkDayRecordController;
use App\Http\Controllers\HidroProjekt\HumanResourcesController;
use App\Http\Controllers\HidroProjekt\ConstructionSiteController;
use App\Http\Controllers\HidroProjekt\InternalDeliveryNoteController;
use App\Http\Controllers\HidroProjekt\MainInventoryController;
use App\Http\Controllers\HidroProjekt\MaterialMasterDataController;
use App\Models\MaterialDocModel;

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
                Route::get('/my_entries','myEntries')->name('hp_myEntries');
                Route::get('/newEntry','newWorkingDayEntry')->name('hp_newWorkingDayEntry');
                Route::get('/wd_record/{id}','workingDayEntry')->name('hp_workingDayEntry');
                Route::get('/wd_record/consumption/{wd_id}','materialConsumption')->name('hp_consSiteMaterialConsumption');
                Route::delete('/wd_record/{id}','deleteWorkingDayEntry')->name('hp_deleteWorkingDayEntry');
            });
        Route::controller(ProfileController::class)
            ->group(function(){
                Route::get('/pass_reset', 'passwordChangeForm')->name('bde_passwordChangeForm');
                Route::put('/pass_reset', 'passwordChange')->name('bde_passwordChange');
            });
    });


/**
 * Administration and management routes
 * All routes related to business monitoring and planning 
 */
Route::prefix('/')
    ->middleware(['auth','userRights'])
    ->group(Function(){

        /**
         * Admin routes
         */
        Route::prefix('/adm')
            ->group(function(){
                Route::controller(AdminController::class)
                    ->group(function(){
                        Route::get('/users', 'users')->name('hp_users');
                    });
                Route::controller(TicketController::class)
                    ->group(function(){
                        Route::get('/tickets', 'tickets')->name('hp_tickets');
                        Route::get('/tickets/{id}', 'showTicket')->name('hp_showTicket');
                        Route::post('/new_tickets', 'newTicket')->name('hp_newTicket');
                    });
                Route::controller(ParametersController::class)
                    ->group(function(){
                        Route::get('/app_params', 'appParams')->name('hp_appParams');
                    });
                Route::prefix('/master_data')
                ->group(function(){
                    Route::controller(MaterialMasterDataController::class)
                    ->group(function(){
                        Route::get('master_material', 'masterMaterial')->name('hp_masterMaterial');
                        Route::get('master_material/{id}', 'showMaterial')->name('hp_showMaterial');
                        Route::get('new_material', 'createNewMaterialForm')->name('hp_createNewMaterialForm');
                    });
                    Route::controller(SuppliersController::class)
                    ->group(function(){
                        Route::get('suppliers', 'index')->name('hp_suppliers');
                        Route::get('new_supplier', 'newSupplier')->name('hp_newSupplier');
                    });
                    Route::controller(MainInventoryController::class)
                    ->group(function(){
                        Route::get('main_inventory', 'index')->name('hp_mainInventory');
                        Route::get('inventory_results/{id}', 'inventoryResults')->name('hp_inventoryResults');
                    });
                    Route::controller(CalculatorController::class)
                    ->group(function(){
                        Route::get('calculator','index')->name('hp_calculator');
                    });
                });
                
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
                Route::put('/workers/disable/{id}', 'disableWorker')->name('hp_disableWorker');

                Route::get('work_hours', 'allWorkHours')->name('hp_allWorkHours');
                Route::get('work_hours_worker/{id}', 'workerWorkHours')->name('hp_workerWorkHours');
                Route::post('work_hours_worker', 'manuelAttendanceEntry')->name('hp_manuelAttendanceEntry');
                Route::get('work_hours_co-op', 'allWorkHoursCoOp')->name('hp_allWorkHours_CoOp');

                Route::get('/cooperators', 'cooperators')->name('hp_cooperators');
                Route::post('/cooperators', 'newCooperators')->name('hp_newCooperators');
                Route::get('/cooperators/{id}', 'showCooperators')->name('hp_showCooperators');
                Route::post('/cooperators_worker', 'newCooperatorWorker')->name('hp_newCooperatorWorker');
                Route::put('/cooperators_worker/{id}', 'deactivateCooperatorWorker')->name('hp_deactivateCooperatorWorker');
                Route::put('/cooperators_update_worker/{id}', 'updateCooperatorWorker')->name('hp_updateCooperatorWorker');


                //PDF routes
                Route::get('payroll_labels_pdf','payrollLabels')->name('hp_payrollLabels');
            });

        Route::controller(AssetsController::class)
            ->prefix('/assets')
            ->group(function(){

                Route::get('/fleet', 'companyCars')->name('hp_companyCars');
                Route::get('/fleet/{plates}', 'showCompanyCar')->name('hp_showCompanyCar');
                Route::post('/fleet', 'addCompanyCars')->name('hp_addCompanyCars');
                Route::post('/fleet/carAvatar','uploadCarAvatarImage')->name('hp_uploadCarAvatarImage');
                Route::put('/fleet/deactivate/{id}','deactivateCar')->name('hp_deactivateCar');

            });

        Route::prefix('/wp')
            ->group(function(){
                Route::controller(ConstructionSiteController::class)
                    ->group(function(){
                        Route::get('/construction_sites', 'constructionSites')->name('hp_constructionSites');
                        Route::get('/construction_sites/{id}', 'showConstructionSite')->name('hp_showConstructionSite');
                        Route::get('/construction_sites/materials/{id}', 'showConstructionSiteMaterials')->name('hp_showConstructionSiteMaterials');
                        Route::get('/construction_sites/consumption/{id}', 'showConstructionSiteConsumption')->name('hp_showConstructionSiteConsumption');
                        Route::post('/construction_sites', 'addNewConstructionSites')->name('hp_addNewConstructionSites');
                    });
                Route::controller(WorkDayDiaryController::class)
                    ->group(function(){
                        Route::get('work_day_diaries', 'workDayDiaries')->name('hp_workDayDiaries');
                        Route::get('work_day_diaries/{id}', 'showWorkDayDiary')->name('hp_showWorkDayDiary');
                    });
                Route::controller(InternalDeliveryNoteController::class)
                    ->group(function(){
                        Route::get('internal_delivery_note','index')->name('hp_internalDeliveryNote');
                    });
            });
        
        Route::prefix('/stg')
            ->group(function(){
                Route::controller(StorageController::class)
                    ->group(function(){
                        Route::get('stock_items','storageStockItems')->name('hp_storageStockItems');  
                        Route::get('construction_stock_items','constructionStockItems')->name('hp_constructionStockItems');    
                    });
            });
        
    });

Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('route:cache');
    Artisan::call('view:clear');
    Artisan::call('config:cache');
    echo  "all cleared ...";
    return;

});

Route::get('test',function(){
    dd(MaterialDocModel::first()->fullName);
    return view('test', [
        'data' => MaterialMasterData::get()
    ]);
});
