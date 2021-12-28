<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserRepository
{
    public function all() 
    {

        dd('ola');
        $users = DB::table('API_USER_ACTIVATE')->get();
        return $users;
    }

   
}