<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

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

        protected function credentials(Request $request)
    {

        return $request->only(
            'EMAIL'
        );
    }
    
    protected function validateEmail(Request $request)
    {
   

        $request->validate(['EMAIL' => 'required|email']);
    }
    
       public function sendResetLinkEmail(Request $request)
    {
   
        $this->validateEmail($request);
        
        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we

        $arr = [
        "EMAIL" => $request->EMAIL
        ];
        
        // dd($this->credentials($request));
        // dd($arr);


        $response = $this->broker()->sendResetLink(
            $arr
            // $this->credentials($request)

        );

        dd($response);
        return $response == Password::RESET_LINK_SENT
                    ? $this->sendResetLinkResponse($request, $response)
                    : $this->sendResetLinkFailedResponse($request, $response);
    }
}
