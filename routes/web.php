<?php
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\TaskController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->name('login');


   
Route::post('login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout')->middleware('auth');
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');


Route::middleware(['auth', 'role:admin'])->group(function () {
 
    Route::get('/tache', [TaskController::class, 'index'])->name('tasks.index');
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
Route::post('/tasks/positions', [TaskController::class, 'updatePositions'])->name('tasks.updatePositions');
Route::post('/toggle-theme', function() {
    session(['theme' => session('theme', 'light') === 'light' ? 'dark' : 'light']);
    return back();
})->name('toggle-theme');

Route::resource('tasks', TaskController::class);

Route::post('/tasks/{task}/move', [TaskController::class, 'move'])
     ->name('tasks.move');




// Route pour déplacer une tâche entre les colonnes
Route::patch('/tasks/{task}/move', [TaskController::class, 'move'])->name('tasks.move');

// Route pour basculer le thème clair/sombre
Route::post('/theme/toggle', [TaskController::class, 'toggleTheme'])->name('theme.toggle');

 

});