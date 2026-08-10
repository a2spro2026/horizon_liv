<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/{section}', [AdminController::class, 'section'])->name('admin.section');

Route::patch('/admin/inscriptions/{inscription}/statut', [AdminController::class, 'updateInscriptionStatut'])
    ->name('admin.inscriptions.statut');
Route::post('/admin/partenaires', [AdminController::class, 'storePartenaire'])
    ->name('admin.partenaires.store');
Route::put('/admin/partenaires/{partenaire}', [AdminController::class, 'updatePartenaire'])
    ->name('admin.partenaires.update');
Route::patch('/admin/partenaires/{partenaire}/suspendre', [AdminController::class, 'suspendPartenaire'])
    ->name('admin.partenaires.suspend');
Route::delete('/admin/partenaires/{partenaire}', [AdminController::class, 'destroyPartenaire'])
    ->name('admin.partenaires.destroy');
Route::post('/admin/destinataires', [AdminController::class, 'storeDestinataire'])
    ->name('admin.destinataires.store');
Route::post('/admin/livreurs', [AdminController::class, 'storeLivreur'])
    ->name('admin.livreurs.store');
Route::put('/admin/livreurs/{livreur}', [AdminController::class, 'updateLivreur'])
    ->name('admin.livreurs.update');
Route::patch('/admin/livreurs/{livreur}/suspendre', [AdminController::class, 'suspendLivreur'])
    ->name('admin.livreurs.suspend');
Route::post('/admin/utilisateurs', [AdminController::class, 'storeUtilisateur'])
    ->name('admin.utilisateurs.store');
Route::put('/admin/utilisateurs/{utilisateur}', [AdminController::class, 'updateUtilisateur'])
    ->name('admin.utilisateurs.update');
Route::patch('/admin/utilisateurs/{utilisateur}/suspendre', [AdminController::class, 'suspendUtilisateur'])
    ->name('admin.utilisateurs.suspend');
Route::post('/api/livreur/position', [AdminController::class, 'updateLivreurPosition'])
    ->name('api.livreur.position');
Route::post('/api/destinataire/position', [AdminController::class, 'updateDestinatairePosition'])
    ->name('api.destinataire.position');
