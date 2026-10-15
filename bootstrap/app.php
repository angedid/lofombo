<?php

use App\Http\Controllers\GuestController;
use App\Http\Middleware\EnsureApiUserIsAdministrator;
use App\Http\Middleware\EnsureClientIsActivated;
use App\Http\Middleware\EnsureLicenseIsActive;
use App\Http\Middleware\EnsureUserIsActivated;
use App\Http\Middleware\EnsureUserIsAdministrator;
use App\Http\Middleware\EnsureUserIsSuperAdministrator;
use App\Http\Middleware\EnsureUserOrClientAreConnected;
use App\Http\Middleware\Localization;
use App\Http\Middleware\SetLocale;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Session\TokenMismatchException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->append(SetLocale::class);
        $middleware->alias([
            'user-is-activated' => EnsureUserIsActivated::class,
            'client-is-activated' => EnsureClientIsActivated::class,
            'user-api-is-admin' => EnsureApiUserIsAdministrator::class,
            'user-is-admin' => EnsureUserIsAdministrator::class,
            'user-is-super-admin' => EnsureUserIsSuperAdministrator::class,
            'user-or-client-is-connected' => EnsureUserOrClientAreConnected::class,
            'license-is-active' => EnsureLicenseIsActive::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Intercepte l'erreur 419 (TokenMismatch)
        $exceptions->render(function (TokenMismatchException $e, Request $request) {
            // Optionnel : Ajoute un message flash pour informer l'utilisateur
            session()->flash('error', 'Votre session a expiré. Veuillez vous reconnecter.');

            // Redirige vers la route de connexion (souvent nommée 'login')
            $locale = GuestController::getApplicationLocal();
            return redirect()->route('welcome', ['locale' => $locale]); //redirect()->route('login');
        });

    })->create();
