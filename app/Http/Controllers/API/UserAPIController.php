<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class UserAPIController extends BaseController
{
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {

    }

    public function store(Request $request)
    {

        $NIF = $request->nif ?? '';
        $PASS = $request->pass ?? '';
        $EMAIL = $request->email ?? '';

        $user = $this->userRepository->userNew($NIF, $PASS, $EMAIL);
        
        return json_encode($user);
    }


    public function show(Request $request)
    {

        $NIF = $request->nif ?? '';

        $user = $this->userRepository->userActivate($NIF);

        return json_encode($user);
    }


    public function update(Request $request)
    {

        $NIF = $request->nif ?? '';
        $NEW_PASS = $request->new_pass ?? '';
        $NEW_EMAIL = $request->new_email ?? '';

        $user = $this->userRepository->userUpdate($NIF,$NEW_PASS, $NEW_EMAIL);

        return json_encode($user);
    }


    public function login(Request $request)
    {

        $NIF = $request->nif ?? '';
        $PASS = $request->pass ?? '';

        $user = $this->userRepository->userUpdate($NIF,$PASS);

        return json_encode($user);
    }

}
