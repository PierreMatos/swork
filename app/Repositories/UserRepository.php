<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserRepository
{

  
    // lista de informações de utilizador

    public function userNew($NIF, $PASS, $EMAIL) 
    {

        DB::beginTransaction();

        $user = DB::select("SELECT * FROM API_USER_NEW('$NIF', '$PASS', '$EMAIL')");

        DB::commit();

        return $user;

    }
  
    
    // lista de informações de utilizador ATIVO por NIF

    public function userActivate($NIF) 
    {

        DB::beginTransaction();

        $user = DB::select("SELECT * FROM API_USER_ACTIVATE('$NIF')");

        DB::commit();

        return $user;

    }
    
  
    // Atualizar  informações de utilizador 

    public function userUpdate($NIF, $NEW_PASS, $NEW_EMAIL) 
    {

        DB::beginTransaction();

        $user = DB::select("SELECT * FROM API_USER_UPDATE('$NIF', '$NEW_PASS', '$NEW_EMAIL')");
       
        DB::commit();

        return $user;

    }
    
    

    // Login de utilizador 

    public function login($NIF, $PASS) 
    {

        DB::beginTransaction();

        $user = DB::select("SELECT * FROM API_USER_LOGIN($NIF, $PASS)");

        DB::commit();

        return $user;

    }
    

   
}