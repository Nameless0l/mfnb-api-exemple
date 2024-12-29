<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('styliste', App\Http\Controllers\StylisteController::class);
Route::apiResource('produit', App\Http\Controllers\ProduitController::class);
Route::apiResource('commande', App\Http\Controllers\CommandeController::class);
Route::get('commande/user/{id}', [App\Http\Controllers\CommandeController::class, 'showByUser'])->name('commande.showByUser');
Route::get('produit/user/{id}', [App\Http\Controllers\ProduitController::class, 'showByUser'])->name('produit.showByStylist');
Route::apiResource('paiement', App\Http\Controllers\PaiementController::class);
Route::apiResource('avis-styliste', App\Http\Controllers\AvisStylisteController::class);
Route::apiResource('avis-client', App\Http\Controllers\AvisClientController::class);
Route::apiResource('categorie', App\Http\Controllers\CategorieController::class);
Route::apiResource('modele', App\Http\Controllers\ModeleController::class);
// Route::post('model', [App\Http\Controllers\ModeleController::class, 'store'])->name('modele.store');
Route::apiResource('mensuration', App\Http\Controllers\MensurationController::class);
Route::apiResource('ligne-commande', App\Http\Controllers\LigneCommandeController::class)->only('store', 'update', 'destroy');
Route::apiResource('photo', App\Http\Controllers\PhotoController::class)->except('store');
Route::post('photo', [App\Http\Controllers\PhotoController::class, 'store'])->name('photo.store');
Route::apiResource('user', App\Http\Controllers\UserController::class)->except('store', 'update', 'destroy');


Route::prefix('auth')->group(function () {
    Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest')
    ->name('register');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest')
    ->name('login');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.store');

Route::get('/verify-email/{id}/{hash}', VerifyEmailController::class)
    ->middleware(['auth', 'signed', 'throttle:6,1'])
    ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');
})->middleware('api');

