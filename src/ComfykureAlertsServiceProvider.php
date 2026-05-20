<?php

namespace AhmadIshtiaq\ComfykureAlerts;

use AhmadIshtiaq\ComfykureAlerts\Models\AlertEmail;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\ServiceProvider;
use Throwable;

class ComfykureAlertsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // 1. Package ke baqi components load karwao
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'comfykure');

        if ($this->app->runningInConsole()) {
        $this->publishes([
            __DIR__.'/../database/migrations/' => database_path('migrations')
        ], 'comfykure-migrations');
    }

        // 2. 💡 SOLID CRASH ENGINE: Direct Laravel Exception Handler se detail pakrein
        $this->app->resolving(ExceptionHandler::class, function (ExceptionHandler $handler) {

            $handler->reportable(function (Throwable $e) {

                // Safety: Agar mail system ready nahi hai, toh ruk jao
                if (! app()->bound('mail.manager')) {
                    return;
                }

                // Favicon background requests ko block karo
                if (request()->is('favicon.ico') || request()->is('*/favicon.ico')) {
                    return;
                }

                // 👉 AAPKA TRACKER: Static variable jo 1 hit par sirf 1 mail bhejney dega
                static $mailSent = false;
                if ($mailSent) {
                    return;
                }
                $mailSent = true;

                try {
                    // Database se active emails uthao
                    $recipients = AlertEmail::where('is_active', true)->pluck('email')->toArray();

                    if (empty($recipients)) {
                        return;
                    }

                    // 🔥 EXACT DETAILS: Ab file, line, aur message sab perfectly milega!
                    $errorMessage = "🚨 Alert: Live System Error Occurred!\n\n".
                        '🔴 Message: '.$e->getMessage()."\n".
                        '📂 File Path: '.$e->getFile()."\n".
                        '📍 Line Number: '.$e->getLine()."\n".
                        '🌐 Request URL: '.request()->fullUrl()."\n".
                        '🤙 Method: '.request()->method()."\n\n".
                        "--- 📜 Stack Trace ---\n".
                        $e->getTraceAsString();

                    $subjectText = '⚠️ Crash: '.substr($logged->message ?? $e->getMessage(), 0, 30).'...';

                    Mail::raw($errorMessage, function ($message) use ($recipients, $subjectText) {
                        $message->to($recipients)
                            ->subject($subjectText.' - ComfyKure Store');
                    });

                } catch (Throwable $mailError) {
                    // Prevent infinite loops if mailer fails
                }
            });
        });
    }

    public function register(): void
    {
        //
    }
}
