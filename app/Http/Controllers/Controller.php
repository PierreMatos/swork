<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }
    
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function get()
    {
        // $users = $this->userRepository->offersList();
        $users = $this->userRepository->userInfo();
        return json_encode($users);
    }
}
