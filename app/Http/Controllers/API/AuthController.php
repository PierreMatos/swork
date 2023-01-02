<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTFactory;
use Tymon\JWTAuth\PayloadFactory;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Response;
use App\Repositories\UserRepository;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Hash;




class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */

     private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;

        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request, Guard $auth_guard)
    {

        // $pw = Hash::make($request->input('PASS_UTILIZADOR'));

        // $request->request->set('PASS_UTILIZADOR', $pw);

        //     dd ($request->input());

        $validator = Validator::make($request->all(), [
            'NIF_UTILIZADOR' => 'required|exists:EMPREGADOS_UTILIZADORES_PORTAL',
            'PASS_UTILIZADOR' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // $user = User::where('NIF_UTILIZADOR', '=', $request->NIF_UTILIZADOR)->first();
        $user = User::find($request->NIF_UTILIZADOR);
        // $user = $this->userRepository->userGetTable($request->NIF_UTILIZADOR)[0];
        // $user = $this->userRepository->userGet($request->NIF_UTILIZADOR)[0];

        // if (($request->PASS_UTILIZADOR == $user->PASS_UTILIZADOR)){
            if(Hash::check($request->PASS_UTILIZADOR, $user->PASS_UTILIZADOR)){
            if ($token = JWTAuth::fromUser($user)) {
                return response()->json(compact('user', 'token'), 201);
                return response()->json([
                    'success' => true,
                    'data' => $user
                ]);
            }
        }else{

            return response()->json([
                'success' => false,
                'message' => 'Invalid NIF or Password',
            ], 422);
        }
       
        
    }



    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me(Request $request)
    {
        // dd('oi');
        $payload = $request->token->get();
        $user = JWTAuth::decode($payload);
        return $user;
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    protected function guard()
    {
        // dd(Auth::guard());
        
        return Auth::guard();

    }//end guard()

      /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => 10000,
            'user' => auth()->user()
        ]);
    }

    public function convertUTF8($data) {
        if(!empty($data)) {    
          $encodeType = mb_detect_encoding($data , array('UTF-8','GBK','LATIN1','BIG5'));   
          if( $encodeType != 'UTF-8'){   
          
            $data = mb_convert_encoding($data ,'utf-8' , 'ISO-8859-1'); 
          //   $data = mb_convert_encoding($data, "ISO-8859-1", "UTF-8" );
          }   
        }   
        return $data;    
      }
}