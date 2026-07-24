<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GlobalSearchController;
use App\Http\Controllers\PostInteractionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrientationStartController;
use App\Http\Controllers\StudentProfileController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SecurityReportController;
use App\Http\Controllers\AttachmentController;
use App\Models\Post;




/* Route::get('/purchases/{purchase}/pdf', [PurchasePdfController::class, 'download'])
    ->name('purchases.pdf.download')
    ->middleware(['auth']); // ajustez les middlewares selon besoins (ex : filament auth / policies)

 */

Route::get('/', [HomeController::class, 'index'])->name('home');

// ABOULCODE Pages
Route::get('/projets', [ProjectsController::class, 'index'])->name('projects.index');
Route::get('/services', [ServicesController::class, 'index'])->name('services.index');
Route::get('/a-propos', [AboutController::class, 'index'])->name('about.index');

Route::get('/recherche', GlobalSearchController::class)->name('search');

Route::get('/commencer-orientation', OrientationStartController::class)->name('orientation.start');




// Pages légales
Route::view('/mentions-legales', 'pages.legal')->name('legal');
Route::view('/politique-de-confidentialite', 'pages.privacy')->name('privacy');
// Page Pourquoi ABOULCODE
Route::view('/pourquoi-ABOULCODE', 'pages.pourquoi')->name('pourquoi');

// Page Nos Services
Route::view('/noservices', 'pages.noservices')->name('noservices');

/* Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
 */
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Student profile configuration routes
    Route::get('/student-profile/config', [StudentProfileController::class, 'show'])->name('student-profile.show');
    Route::post('/student-profile/config', [StudentProfileController::class, 'store'])->name('student-profile.store');
});

// Changer la langue (FR/EN) et revenir sur la page précédente — public
Route::get('/locale/{locale}', function (string $locale) {
    if (! array_key_exists($locale, config('ABOULCODE.supported_locales', []))) {
        $locale = config('app.fallback_locale');
    }
    session(['locale' => $locale]);
    return Redirect::back();
})->name('locale.set');



Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact/submit', [ContactController::class, 'submit'])
    ->middleware('throttle:contact-submissions')
    ->name('contact.submit');

Route::get('/blog', [PostController::class, 'index'])->name('pages.blog.index');
Route::get('/blog/{post:slug}', [PostController::class, 'show'])->name('pages.blog.show'); // liaison par slug

Route::middleware('auth')->group(function () {
    Route::post('/blog/{post:slug}/like', [PostInteractionController::class, 'toggleLike'])->name('pages.blog.like');
    Route::post('/blog/{post:slug}/favorite', [PostInteractionController::class, 'toggleFavorite'])->name('pages.blog.favorite');
    Route::post('/blog/{post:slug}/comments', [PostInteractionController::class, 'storeComment'])->name('pages.blog.comments.store');
    Route::patch('/blog/comments/{comment}', [PostInteractionController::class, 'updateComment'])->name('pages.blog.comments.update');
    Route::delete('/blog/comments/{comment}', [PostInteractionController::class, 'deleteComment'])->name('pages.blog.comments.delete');
    Route::post('/blog/comments/{comment}/report', [PostInteractionController::class, 'reportComment'])->name('pages.blog.comments.report');
});






require __DIR__.'/auth.php';


// CSP report-only endpoint (no CSRF)
Route::post('/.well-known/csp-report', [SecurityReportController::class, 'csp'])
    ->withoutMiddleware(['web'])
    ->name('security.csp.report');

// Client Support submission (in-panel, authenticated)
Route::post('/client/support', function (\Illuminate\Http\Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:191',
        'email' => 'required|email',
        'phone' => 'nullable|string|max:191',
        'message' => 'required|string',
    ]);

    $contact = \App\Models\Contact::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'phone' => $validated['phone'] ?? null,
        'user_type' => 'client',
        'user_other' => null,
        'message' => $validated['message'],
    ]);

    // Keep the first support request available in the threaded conversation.
    try {
        \App\Models\SupportMessage::create([
            'contact_id' => $contact->id,
            'user_id' => $request->user()?->id,
            'body' => $contact->message,
            'sender_type' => 'client',
        ]);
    } catch (\Throwable $e) {
        \Illuminate\Support\Facades\Log::warning('Initial in-panel support message not created: '.$e->getMessage(), [
            'contact_id' => $contact->id,
        ]);
    }

    app(\App\Services\Notifications\PlatformNotificationService::class)->notifyContactMessage($contact);

    try {
        \Illuminate\Support\Facades\Mail::to(config('mail.from.address'))
            ->queue(new \App\Mail\ContactMessageMail($contact));
    } catch (\Throwable $e) {
        // ignore mail errors
    }

    return back()->with('status', 'Message envoyé');
})->name('client.support.submit')->middleware(['web', 'auth']);




Route::get('/files/public/view/{path}', [AttachmentController::class, 'viewPublic'])
    ->where('path', '.*')
    ->name('attachments.public.view');

Route::fallback(function () {
    return response()->view('pages.404', [], 404);
});
