<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function showLinkRequestForm()
    {
        $data = [
            'category_name' => 'auth',
            'page_name' => 'auth_default',
            'has_scrollspy' => 0,
            'scrollspy_offset' => '',
        ];
        return view('pages.authentication.auth_pass_recovery')->with($data);
        // return view('auth.passwords.email')->with($data);
    }
}
