<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\UsersController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\LogsController;
use App\Http\Controllers\MiscController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\QuotationIndexController;
use App\Http\Controllers\QuotationStatusController;
use App\Http\Controllers\QuotationItemController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ConfirmationController;

// Auth::routes();
Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/registerPost', [AuthController::class, 'registerPost'])->name('registerPost');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
    Route::get('forget-password', [AuthController::class, 'showForgetPasswordForm'])->name('forget-password.get');
    Route::post('forget-password', [AuthController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
    Route::get('reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('reset.password.get');
    Route::post('reset-password', [AuthController::class, 'submitResetPasswordForm'])->name('reset.password.post');
});
Route::group(['middleware' => 'auth'], function () {
    // Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/notification', [NotificationController::class, 'index']);
    Route::get('/notifications', [NotificationController::class, 'index2']);
    
    Route::get('/logout', function () {
        Auth::logout();
        return redirect('/');
    });
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
    Route::post('/settingStore', [App\Http\Controllers\ProfileController::class, 'updateAccount'])->name('settingStore');
    //Route::post('/changePassword', [App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('changePassword');
    Route::get('/notification/read/{id}', [NotificationController::class, 'markAsRead'])->name('notification.read');

    Route::group(['prefix' => 'quotation'], function () {
        Route::middleware(['sales'])->group(function () {
            Route::get('/settings', [App\Http\Controllers\ProfileController::class, 'settingProfileAccount'])->name('settings');
            Route::get('salesQuotation', [QuotationIndexController::class, 'salesQuotation'])->name('salesQuotation');
            Route::get('/create', [QuotationController::class, 'create']);
            Route::get('/rent_create', [QuotationController::class, 'rent_create']);
            Route::post('/store', [QuotationController::class, 'store'])->name('quotationStore');
            Route::post('/rentstore', [QuotationController::class, 'rentStore'])->name('quotationRentStore');
            Route::post('/updateQuotation', [QuotationController::class, 'updateQuotation'])->name('updateQuotation');
            Route::get('/canceledProcess', [QuotationController::class, 'canceledProcess']);
        });
        Route::middleware(['nonSales'])->group(function () {
            
            Route::post('/addDescription', [QuotationController::class, 'addDescription'])->name('addDescription');
            Route::get('/setting', [App\Http\Controllers\ProfileController::class, 'settingAccount'])->name('setting');
            Route::get('allQuotation', [QuotationIndexController::class, 'allQuotation'])->name('allQuotation');
            Route::get('adminQuotation', [QuotationIndexController::class, 'adminQuotation'])->name('adminQuotation');
            Route::get('/onProcess', [QuotationStatusController::class, 'onProcess']);
            Route::get('/doneProcess', [QuotationStatusController::class, 'doneProcess']);
            Route::get('/canceledProcess', [QuotationStatusController::class, 'canceledProcess']);
            Route::post('/changeStatus', [QuotationStatusController::class, 'changeStatus'])->name('changeStatusQ');
        });

        Route::post('/updateQuotation', [QuotationController::class, 'updateQuotation'])->name('updateQuotation');
        Route::delete('/deleteItemQuotation/{id}', [QuotationController::class, 'deleteItemQuotation'])->name('deleteItemQuotation');
        Route::get('/deleteQuotation/{id}', [QuotationController::class, 'deleteQuotation'])->name('deleteQuotation');
        Route::get('/editQuotation/{slug}', [QuotationController::class, 'editQuotation'])->name('editQuotation');
        Route::get('/viewQuotation/{slug}', [QuotationController::class, 'viewQuotation'])->name('viewQuotation');
        
        Route::get('/printQuotation/{slug}', [QuotationController::class, 'printQuotation'])->name('printQuotation');
        Route::get('/exportPdf/{slug}', [QuotationController::class, 'createPDF'])->name('createPDF');
        Route::post('/sendQuotation', [QuotationController::class, 'sendQuotation'])->name('sendQuotation');
    });
    Route::group(['prefix' => 'quotationItem'], function () {
        Route::get('/', [QuotationItemController::class, 'index']);
    });


    // ADMINISTRATOR
    Route::middleware(['superAdmin'])->group(function () {
        Route::group(['prefix' => 'users'], function () {
            Route::get('/', [UsersController::class, 'index']);
            Route::get('/getUsers', [UsersController::class, 'getUsers'])->name('getUsers');
            Route::get('/create', [UsersController::class, 'create']);
            Route::post('/store', [UsersController::class, 'store'])->name('userStore');
            Route::get('/view', [UsersController::class, 'view'])->name('viewUser');
            Route::post('/update', [UsersController::class, 'update']);
            Route::get('/delete', [UsersController::class, 'delete']);
            Route::get('/inActiveUser', [UsersController::class, 'inActiveUser']);
            Route::get('/activeUser', [UsersController::class, 'activeUser']);
            
        });

        Route::prefix('roles')->group(function () {
            Route::get('/', [RolesController::class, 'index']);
            Route::get('/create', [RolesController::class, 'create']);
            Route::post('/store', [RolesController::class, 'store']);
            Route::get('/view', [RolesController::class, 'view']);
            Route::post('/update', [RolesController::class, 'update']);
        });

        Route::prefix('company')->group(function () {
            Route::get('/', [CompanyController::class, 'index']);
            Route::get('/create', [CompanyController::class, 'create']);
            Route::post('/store', [CompanyController::class, 'store'])->name('companyStore');
            Route::get('/view', [CompanyController::class, 'view']);
            Route::post('/update', [CompanyController::class, 'update']);
            Route::get('/delete', [CompanyController::class, 'delete']);
        });
    });

    Route::group(['prefix' => 'login_logs'], function () {
        Route::get('/', [LogsController::class, 'index']);
    });
    Route::group(['prefix' => 'misc'], function () {
        Route::get('/notAuthorized', [MiscController::class, 'notAuthorized'])->name('notAuthorized');
    });
});
Route::post('/updatePassword', [UsersController::class, 'updatePassword']);
Route::get('/confirmationUser', [ConfirmationController::class, 'confirmationUser'])->name('confirmationUser');
Route::get('confirmatedUser', function () {
    return view('misc/confirmationUser', [
        'title' => 'Congratulations !',
        'subTitle' => 'You have Activated User',
        'exlude' => ['sidebar', 'navbar']
    ]);
});
Route::get('errorPage', function () {
    return view('misc/error', [
        'title' => 'Error Registration',
        'subTitle' => 'Oops! 😖 Email has Registered before in the system',
        'exlude' => ['sidebar', 'navbar']
    ]);
});
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
