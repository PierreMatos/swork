<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserRepository
{

  
    // lista de informações de utilizador

    public function userNew($NIF, $PASS, $EMAIL, $USER_NAME, $USER_ADDRESS_1, $USER_ADDRESS_2, $USER_POSTAL_CODE, $USER_TELEPHONE, $USER_BIRTHDATE,
    $USER_SOCIAL_SECURITY_NUMBER, $USER_COUNTRY_ID, $USER_QUALIFICATION_ID, $USER_DISTRICT_ID, $USER_COUNTY_ID, $USER_LOCAL_ID, $TEM_VIATURA, $TEM_CARTA_CONDUCAO,
    $USER_TIPO_COMUNICACAO, $USER_RECEBE_NOTICIAS, $USER_ACEITA_CONDICOES) 
    {

        DB::beginTransaction();

        $user = DB::select("SELECT * FROM API_USER_NEW('$NIF', '$PASS', '$EMAIL', '$USER_NAME', '$USER_ADDRESS_1', '$USER_ADDRESS_2',
        '$USER_POSTAL_CODE', '$USER_TELEPHONE', '$USER_BIRTHDATE', '$USER_SOCIAL_SECURITY_NUMBER', '$USER_COUNTRY_ID', '$USER_QUALIFICATION_ID',
        '$USER_DISTRICT_ID', '$USER_COUNTY_ID', '$USER_LOCAL_ID', '$TEM_VIATURA', '$TEM_CARTA_CONDUCAO',
        '$USER_TIPO_COMUNICACAO', '$USER_RECEBE_NOTICIAS', '$USER_ACEITA_CONDICOES')");

        DB::commit();

        return $user;

    }
  
    
     // lista de informações de utilizador ATIVO por NIF

    public function userGet($NIF) 
    {

        DB::beginTransaction();

        $user = DB::select("SELECT * FROM API_USER_GET('$NIF')");

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

    public function userUpdate($USER_NIF, $USER_PASS, $USER_EMAIL, $USER_NAME, $USER_ADDRESS_1, $USER_ADDRESS_2,
    $USER_POSTAL_CODE, $USER_TELEPHONE, $USER_BIRTHDATE, $USER_SOCIAL_SECURITY_NUMBER, $USER_COUNTRY_ID, $USER_QUALIFICATION_ID,
    $USER_DISTRICT_ID, $USER_COUNTY_ID, $USER_LOCAL_ID, $TEM_VIATURA, $TEM_CARTA_CONDUCAO, $USER_TIPO_COMUNICACAO, $USER_RECEBE_NOTICIAS,
     $USER_ACEITA_CONDICOES) 
    {

        DB::beginTransaction();

        $user = DB::select("SELECT * FROM API_USER_UPDATE('$USER_NIF', '$USER_PASS', '$USER_EMAIL', '$USER_NAME', '$USER_ADDRESS_1', '$USER_ADDRESS_2', '$USER_POSTAL_CODE', '$USER_TELEPHONE',
        '$USER_BIRTHDATE', '$USER_SOCIAL_SECURITY_NUMBER', '$USER_COUNTRY_ID', '$USER_QUALIFICATION_ID', '$USER_DISTRICT_ID', '$USER_COUNTY_ID', '$USER_LOCAL_ID', '$TEM_VIATURA',
        '$TEM_CARTA_CONDUCAO', '$USER_TIPO_COMUNICACAO', '$USER_RECEBE_NOTICIAS', '$USER_ACEITA_CONDICOES' )");
       
        DB::commit();

        return $user;

    }
    
    public function delete($USER_NIF, $USER_PASS, $USER_EMAIL) {
        
        DB::beginTransaction();
         
        $user = DB::select("SELECT * FROM API_USER_DELETE($USER_NIF, '$USER_PASS', '$USER_EMAIL')");
       
        DB::commit();

        return $user;
    }



    // Job Experience
    
    public function addJobExperience($USER_NIF, $USER_PASS, $USER_EMAIL, $COMPANY, $JOB, $START_DATE, $END_DATE) 
    {

        DB::beginTransaction();

        $user = DB::select("SELECT * FROM API_USER_JOB_EXPERIENCE_NEW($USER_NIF, '$USER_PASS', '$USER_EMAIL', '$COMPANY', '$JOB', '$START_DATE', '$END_DATE')");

        DB::commit();

        return $user;

    }
    
    public function getJobExperience($USER_NIF, $USER_PASS, $USER_EMAIL) 
    {

        DB::beginTransaction();

        $user = DB::select("SELECT * FROM API_USER_JOB_EXPERIENCE_GET($USER_NIF, '$USER_PASS', '$USER_EMAIL')");

        DB::commit();

        return $user;

    }

    public function updateJobExperience($USER_NIF, $USER_PASS, $USER_EMAIL, $JOB_EXPERIENCE_ID, $COMPANY, $JOB, $START_DATE, $END_DATE) 
    {

        DB::beginTransaction();

        $user = DB::select("SELECT * FROM API_USER_JOB_EXPERIENCE_UPDATE($USER_NIF, '$USER_PASS', '$USER_EMAIL', '$JOB_EXPERIENCE_ID', '$COMPANY', '$JOB', '$START_DATE', '$END_DATE')"); 

        DB::commit();
        
        return $user;

    }

    public function deleteJobExperience($USER_NIF, $USER_PASS, $USER_EMAIL, $JOB_EXPERIENCE_ID) 
    {

        DB::beginTransaction();

        $user = DB::select("SELECT * FROM API_USER_JOB_EXPERIENCE_DELETE($USER_NIF, '$USER_PASS', '$USER_EMAIL', '$JOB_EXPERIENCE_ID')"); 

        DB::commit();
        
        return $user;

    }
    
    // Horários de prefência

    public function getWorkingHours($USER_NIF, $USER_PASS, $USER_EMAIL)
    {

        DB::beginTransaction();

        $abilities = DB::select("SELECT * FROM API_USER_WORKING_HOURS_GET ($USER_NIF, '$USER_PASS', '$USER_EMAIL')");
       
        DB::commit();

        return $abilities;

    }

    public function updateWorkingHours($USER_NIF, $USER_PASS, $USER_EMAIL, $USER_WORKING_HOURS_ID, $USER_WORKING_HOURS_SELECTED)
    {

        DB::beginTransaction();

        $abilities = DB::select("SELECT * FROM API_USER_WORKING_HOURS_UPDATE ($USER_NIF, '$USER_PASS', '$USER_EMAIL', $USER_WORKING_HOURS_ID, $USER_WORKING_HOURS_SELECTED)");
       
        DB::commit();

        return $abilities;

    }

    // Zonas de prefência

    public function getWorkingAreas($USER_NIF, $USER_PASS, $USER_EMAIL)
    {

        DB::beginTransaction();

        $abilities = DB::select("SELECT * FROM API_USER_WORKING_AREAS_GET ($USER_NIF, '$USER_PASS', '$USER_EMAIL')");
       
        DB::commit();

        return $abilities;

    }

    public function updateWorkingAreas($USER_NIF, $USER_PASS, $USER_EMAIL, $USER_WORKING_AREAS_ID, $USER_WORKING_AREAS_SELECTED)
    {

        DB::beginTransaction();

        $abilities = DB::select("SELECT * FROM API_USER_WORKING_AREAS_UPDATE ($USER_NIF, '$USER_PASS', '$USER_EMAIL', $USER_WORKING_AREAS_ID, $USER_WORKING_AREAS_SELECTED )");
       
        DB::commit();

        return $abilities;

    }
    
    // Login de utilizador 

    public function login($NIF, $PASS) 
    {

        DB::beginTransaction();

        $user = DB::select("SELECT * FROM API_USER_LOGIN($NIF, $PASS)");

        DB::commit();

        return $user;

    }
    
    // Lista de países 

    public function countriesList() 
    {

        DB::beginTransaction();

        $countries = DB::select("SELECT * FROM PAISES ");
       
        DB::commit();

        return $countries;

    }
    
    // Lista de distritos 

    public function districtsList()
    {

        DB::beginTransaction();

        $districts = DB::select("SELECT * FROM DISTRITOS ");
       
        DB::commit();

        return $districts;

    }
    
    // Lista de concelhos 

    public function countiesList($CODIGO_DISTRITO)
    {

        $whereClause = '';
        
        if ($CODIGO_DISTRITO != NULL){
            
            $whereClause = "WHERE CODIGO_DISTRITO =" . $CODIGO_DISTRITO;
            
        }
        
        DB::beginTransaction();

        $counties = DB::select("SELECT * FROM CONCELHOS $whereClause ");
       
        DB::commit();

        return $counties;

    }
    
        // Lista de freguesias 

    public function localList($CODIGO_DISTRITO, $CODIGO_CONCELHO)
    {

        $whereClause = '';
        
        if ($CODIGO_DISTRITO != NULL){
            
            $whereClause = "WHERE CODIGO_DISTRITO = " . $CODIGO_DISTRITO . " AND CODIGO_CONCELHO = " . $CODIGO_CONCELHO;
            
        }
        
        DB::beginTransaction();

        $locations = DB::select("SELECT * FROM LOCAIS $whereClause ");
       
        DB::commit();

        return $locations;

    }
    
    // Lista de skills 

    public function skillsList()
    {

        DB::beginTransaction();

        $skills = DB::select("SELECT * FROM EMPREGADOS_HABILITACOES");
       
        DB::commit();

        return $skills;

    }
    
    // Lista de abilities 

    public function abilitiesList()
    {

        DB::beginTransaction();

        $abilities = DB::select("SELECT * FROM EMPREGADOS_CONHECIMENTOS_TPS WHERE CODIGO_GRUPO_TIPO_CONHECIMENTO = 1");
       
        DB::commit();

        return $abilities;

    }

    // Lista de abilities do user

    public function listUserAbilities($USER_NIF, $USER_PASS, $USER_EMAIL)
    {

        DB::beginTransaction();

        $abilities = DB::select("SELECT * FROM API_USER_LANGUAGES_GET($USER_NIF, '$USER_PASS', '$USER_EMAIL')");
       
        DB::commit();

        return $abilities;

    }

    // Lista de abilities do user

    public function addUserAbilities($USER_NIF, $USER_PASS, $USER_EMAIL, $ABILITY_ID)
    {

        DB::beginTransaction();

        $abilities = DB::select("SELECT * FROM API_USER_LANGUAGES_NEW($USER_NIF, '$USER_PASS', '$USER_EMAIL', '$ABILITY_ID')");
       
        DB::commit();

        return $abilities;

    }

    // Apagar de abilities do user

    public function deleteUserAbilities($USER_NIF, $USER_PASS, $USER_EMAIL)
    {

        DB::beginTransaction();

        $abilities = DB::select("SELECT * FROM API_USER_LANGUAGES_DELETE($USER_NIF, '$USER_PASS', '$USER_EMAIL')");
       
        DB::commit();

        return $abilities;

    }


        // Lista areas de interesse

        public function listJobCategories($USER_NIF, $USER_PASS, $USER_EMAIL)
        {

            DB::beginTransaction();
    
            $abilities = DB::select("SELECT * FROM API_USER_JOB_CATEGORIES_GET ($USER_NIF, '$USER_PASS', '$USER_EMAIL')");
           
            DB::commit();
    
            return $abilities;
    
        }


    // Lista de tipos de documentos 

    public function documentTypesList()
    {

        DB::beginTransaction();

        $documentTypes = DB::select("SELECT * FROM ARQUIVO_TIPOS_CLASSIFICACAO WHERE MOSTRAR_EM_RECRUTAMENTO = 'S'");
       
        DB::commit();

        return $documentTypes;

    }
    
        //LOAD FROM FILE
        public function uploadFile($NIF, $PASS, $EMAIL, $FILENAME, $CODIGO_CLASSIFICACAO, $FILE) 
    {

        $fileContent = file_get_contents($FILE);
        
        $offers = DB::select("SELECT * FROM API_USER_ATTACHMENTS_NEW('$NIF', '$PASS', '$EMAIL', '$FILENAME', '$CODIGO_CLASSIFICACAO', '$fileContent' ");
        //ORDER BY RECRUITMENT_GROUP
        return $offers;

    }

   
}