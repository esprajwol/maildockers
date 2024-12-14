<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Mail;
use App\Mail\ExceptionMail;
use Symfony\Component\ErrorHandler\ErrorRenderer\HtmlErrorRenderer;
use Throwable;
use Illuminate\Support\Facades\App;
class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            $this->sendExceptionEmail($e);
        });
    }

    /**
     * Send an email with exception details.
     *
     * @param Throwable $exception
     * @return void
     */
    protected function sendExceptionEmail(Throwable $exception)
    {
        try {
            // Generate the HTML content for the email
            $htmlContent = $this->getExceptionHtml($exception);

            if (!App::environment('local')) {
                // Send the email directly (synchronously) without using a queue except local env
                Mail::to(config('developerMail.emailIds'))->send(new ExceptionMail($htmlContent));
            }

        } catch (Throwable $e) {
            // Log the mail sending failure instead of throwing another exception
            \Log::error('Failed to send exception email: ' . $e->getMessage());
        }
    }

    /**
     * Get the HTML representation of the exception using FlattenException.
     *
     * @param Throwable $exception
     * @return string
     */
    protected function getExceptionHtml(Throwable $exception)
    {
        // Use HtmlErrorRenderer to generate the HTML for the original exception
        $renderer = new HtmlErrorRenderer(true);
        return $renderer->render($exception)->getAsString();
    }
}
