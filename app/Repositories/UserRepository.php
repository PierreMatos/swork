<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserRepository
{
    public function all() 
    {

        $users = DB::table('API_USER_NEW')->get();
        return $users;
    }

   
}