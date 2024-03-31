<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;


// admin routes
Route::get('dashboard', [AdminController::class, 'dashboard'])->middleware(['auth', 'role:admin'])->name('dashboard');

?>
