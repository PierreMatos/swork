<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    public function rules(){
        $rules = 
        ['EMAIL' => 'required',
        'token' => 'required'];
        
        return $rules;
        
    }
    
    protected function validateEmail(Request $request)
    {
   

        $request->validate(['EMAIL' => 'required|email']);
    }
    
        protected function credentials(Request $request)
    {
        // dd($request);
          return $request->only(
            'EMAIL',
            'token',
            'password'
            
        );
    }
    
    public function showResetForm(Request $request, $token = null)
    {
        // dd('dah');
        // dd($request->email);
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'EMAIL' => ($request->email)]
        );
    }
    
    // public function resetPassword(CanResetPassword $user, string $password){
    //             $PASS = Hash::make($request->PASS_UTILIZADOR) ?? '';

        
    // }
    
    protected function resetPassword($user, $password)
{
    
    dd('hey');
    $user->PASS_UTILIZADOR = Hash::make($password);
 
    $user->save();
    return redirect(env('PWA_URL').'/login');
    return redirect()->to('https://workers.swork.pt/login');

    // dd($user);
 
    // Auth::login($user);
}


}
