<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class EmailVerificationPromptController extends AuthController
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|Response
    {
        return $this->user($request)->hasVerifiedEmail()
                    ? redirect()->intended(RouteServiceProvider::home())
                    : Inertia::render($this->resource('/Auth/VerifyEmail'), ['status' => session('status')]);
    }
}
