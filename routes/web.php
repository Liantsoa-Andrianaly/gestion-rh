<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\ProjectController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

/*route pour le tableau de bord*/
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AppController::class, 'index'])->name('dashboard');
});

/*Route pour le departement */



/* route pour employé */
Route::middleware('auth')->group(function () {
    Route::get('/employe', [EmployeController::class, 'liste_employe']);
    Route::get('/ajouter', [EmployeController::class, 'ajouter_employe']);
    Route::post('/ajouter/traitement', [EmployeController::class, 'ajouter_employe_traitement']);
    Route::get('/update-employe/{id}', [EmployeController::class, 'update_employe']);
    Route::post('/update/traitement', [EmployeController::class, 'update_employe_traitement']);
    Route::get('/delete-employe/{id}', [EmployeController::class, 'delete_employe']);

});


/*Route pour la configuraion*/

    Route::middleware('auth')->group(function(){
    Route::get('/configurations', [ConfigurationController::class, 'index'])->name('configurations');
    Route::get('configurations/create', [ConfigurationController::class, 'create'])->name('configurations.create');
    Route::post('configurations/store', [ConfigurationController::class, 'store'])->name('configurations.store');
    Route::get('configurations/delete/{configuration}', [ConfigurationController::class, 'delete'])->name('configurations.delete');

}) ;

/*Route pour la paiements*/

Route::middleware('auth')->group(function () {
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('/create', [PaymentController::class, 'create'])->name('payments.create');
    Route::post('/store', [PaymentController::class, 'store'])->name('payments.store');
    /*Route pour télécharger le pdf*/
    //Route::get('/download-invoice/{payment}', [PaymentController::class, 'downloadInvoice' ])->name('payment.download');

Route::get('payments/{id}/show', [PaymentController::class, 'show'])->name('invoice.show');
Route::get('payments/{id}/download', [PaymentController::class, 'downloadInvoice'])->name('invoice.download');
Route::post('payments/{id}/verify', [PaymentController::class, 'verifyInvoice'])->name('payments.verify');
Route::get('payments/{id}/verify', [PaymentController::class, 'verifyInvoice'])->name('payments.verify');
Route::put('payments/{id}', [PaymentController::class, 'update'])->name('payments.update');
Route::get('payments/{id}/edit', [PaymentController::class, 'edit'])->name('payments.edit');


});


/*Route pour la  presence*/ 
Route::middleware('auth')->group(function () {
    Route::get('/presence', [PresenceController::class, 'fiche_presence_du_jour'])->name('presences.fiche_du_jour');
    Route::post('/presence/enregistrer', [PresenceController::class, 'enregistrer_presence'])->name('presences.enregistrer');
    Route::get('/presences/liste', [PresenceController::class, 'liste_presences'])->name('presences.liste');
    Route::post('/presences/update-motif-ajax', [PresenceController::class, 'update_motif_ajax'])->name('presences.update_motif_ajax');
    Route::get('/absences', [PresenceController::class, 'liste_absences'])->name('presences.liste_absences');
});

Route::resource('projects', ProjectController::class);
Route::post('projects/{id}/complete', [ProjectController::class, 'markAsCompleted'])->name('projects.complete'); // Route pour marquer un projet comme terminé
