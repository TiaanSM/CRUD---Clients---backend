<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ClientController;

// Redirect root URL to login
Route::redirect('/', '/login');

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.perform');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout.perform');


// Grouped Routes requiring Authentication
Route::group(['middleware' => 'auth'], function () {

    // Client Data for Ajax
    Route::get('/clients/data', [ClientController::class, 'getClientsAjax'])->name('clients.data');

    // Client Management Resource Route
    Route::resource('clients', ClientController::class);

    // Restore Deleted Client
    Route::post('clients/restore/{uuid}', [ClientController::class, 'restore'])->name('clients.restore');
});

/* 
TODOS:
    Make resource route.
    Match validation backend & frontend
    Add role to auth attempt Admin login
*/

/*
Changes made:
    1. Added reusable validation function for client controller.
    2. Fixed bug where created client displays when creating a new client after completing the creation of a prev client.
    3. Updated validation for backend and frontend & update forms to match backend validation.
    4. Add check for user role to ensure only admin can access the page.
    5. Updated Routes to use a Resource route.
    6. Added ability to see and restore deleted clients.

*/