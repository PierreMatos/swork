<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserRepository
{

  
    // lista de informações de utilizador

    public function userNew($NIF, $PASS, $EMAIL, $USER_NAME, $USER_ADDRESS_1, $USER_ADDRESS_2, $USER_POSTAL_CODE, $USER_TELEPHONE, $USER_BIRTHDATE,
    $USER_SOCIAL_SECURITY_NUMBER, $USER_COUNTRY_ID, $USER_QUALIFICATION_ID, $USER_DISTRICT_ID, $USER_COUNTY_ID, $USER_LOCAL_ID, $TEM_VIATURA, $TEM_CARTA_CONDUCAO,
    $USER_TIPO_COMUNICACAO, $USER_RECEBE_NOTICIAS, $USER_ACEITA_CONDICOES, $USER_SEX, $USER_WHATSAPP) 
    {

        // DB::beginTransaction();

        // $user = DB::select("SELECT * FROM API_USER_NEW('$NIF', '$PASS', '$EMAIL', '$USER_NAME', '$USER_ADDRESS_1', '$USER_ADDRESS_2',
        // '$USER_POSTAL_CODE', '$USER_TELEPHONE', '$USER_BIRTHDATE', '$USER_SOCIAL_SECURITY_NUMBER', '$USER_COUNTRY_ID', '$USER_QUALIFICATION_ID',
        // '$USER_DISTRICT_ID', '$USER_COUNTY_ID', '$USER_LOCAL_ID', '$TEM_VIATURA', '$TEM_CARTA_CONDUCAO',
        // '$USER_TIPO_COMUNICACAO', '$USER_RECEBE_NOTICIAS', '$USER_ACEITA_CONDICOES')");

        // $user = DB::insert('INSERT into EMPREGADOS_UTILIZADORES_PORTAL () VALUES ()');

        $user = DB::table('EMPREGADOS_UTILIZADORES_PORTAL')->insert(
            ['NIF_UTILIZADOR' => $NIF, 'EMAIL_UTILIZADOR' => $EMAIL, 'PASS_UTILIZADOR' => $PASS, 'VALIDADO' => 'S']
        );

        // $user = DB::select("SELECT * FROM EMPREGADOS_UTILIZADORES_PORTAL('$NIF', '$PASS', '$EMAIL')");

        DB::commit();

        return $user;

    }
  
    
     // lista de informações de utilizador ATIVO por NIF

    public function userGet($NIF) 
    {
        // DB::beginTransaction();
        
        $user = DB::select("SELECT * FROM API_USER_GET('$NIF')");

        // $user = DB::select("select * from EMPREGADOS_UTILIZADORES_PORTAL where NIF_UTILIZADOR = ? ",[$NIF]);

        DB::commit();

        return $user;

    }

    public function userGetTable($NIF) 
    {
        
        // $user = DB::select("SELECT * FROM EMPREGADOS_UTILIZADORES_PORTAL WHERE NIF_UTILIZADOR = '$NIF'");

        $user = DB::select("select * from EMPREGADOS_UTILIZADORES_PORTAL where NIF_UTILIZADOR = ? ",[$NIF]);

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
     $USER_ACEITA_CONDICOES, $USER_SEX, $USER_WHATSAPP) 
    {

        return json_encode($USER_SOCIAL_SECURITY_NUMBER);
        // DB::beginTransaction();

        $user = DB::select("SELECT * FROM API_USER_UPDATE('$USER_NIF', '$USER_PASS', '$USER_EMAIL', '$USER_NAME', '$USER_ADDRESS_1',
         '$USER_ADDRESS_2', '$USER_POSTAL_CODE', '$USER_TELEPHONE',
        '$USER_BIRTHDATE', '$USER_SOCIAL_SECURITY_NUMBER', '$USER_COUNTRY_ID', '$USER_QUALIFICATION_ID', '$USER_DISTRICT_ID',
         '$USER_COUNTY_ID', '$USER_LOCAL_ID', '$TEM_VIATURA',
        '$TEM_CARTA_CONDUCAO', '$USER_TIPO_COMUNICACAO', '$USER_RECEBE_NOTICIAS', '$USER_ACEITA_CONDICOES', '$USER_SEX', '$USER_WHATSAPP' )");

// dd($user);
        DB::commit();

        
        return $user;
        

    }
    
    public function delete($USER_NIF, $USER_PASS, $USER_EMAIL) {
        
        // DB::beginTransaction();
         
        $user = DB::select("SELECT * FROM API_USER_DELETE($USER_NIF, '$USER_PASS', '$USER_EMAIL')");
       
        DB::commit();

        return $user;
    }



    // Job Experience
    
    public function addJobExperience($USER_NIF, $USER_PASS, $USER_EMAIL, $COMPANY, $JOB, $START_DATE, $END_DATE) 
    {

        
        // DB::commit();
        
        if($END_DATE){
            
            $user = DB::select("SELECT * FROM API_USER_JOB_EXPERIENCE_NEW($USER_NIF, '$USER_PASS', '$USER_EMAIL', '$COMPANY', '$JOB', '$START_DATE', '$END_DATE')");
        }else{
            $user = DB::select("SELECT * FROM API_USER_JOB_EXPERIENCE_NEW($USER_NIF, '$USER_PASS', '$USER_EMAIL', '$COMPANY', '$JOB', '$START_DATE', null)");
        }
        
dd($user);
        return $user;

    }

    public function addQualificatons($USER_NIF, $USER_PASS, $USER_EMAIL, $USER_QUALIFICATION_SCHOOL, $USER_QUALIFICATION_DESCRIPTION, $USER_QUALIFICATION_DURATION) 
    {

        // DB::beginTransaction();

        $user = DB::select("SELECT * FROM API_USER_QUALIFICATION_NEW($USER_NIF, '$USER_PASS', '$USER_EMAIL', '$USER_QUALIFICATION_SCHOOL', '$USER_QUALIFICATION_DESCRIPTION', '$USER_QUALIFICATION_DURATION')");

        DB::commit();

        return $user;

    }

    public function getQualificatons($USER_NIF, $USER_PASS, $USER_EMAIL) 
    {

        // DB::beginTransaction();

        $user = DB::select("SELECT * FROM API_USER_QUALIFICATION_GET($USER_NIF, '$USER_PASS', '$USER_EMAIL')");

        DB::commit();

        return $user;

    }


    public function updateQualificatons($USER_NIF, $USER_PASS, $USER_EMAIL, $USER_QUALIFICATION_ID, $USER_QUALIFICATION_SCHOOL, $USER_QUALIFICATION_DESCRIPTION, $USER_QUALIFICATION_DURATION) 
    {

        // DB::beginTransaction();

        $user = DB::select("SELECT * FROM API_USER_QUALIFICATION_UPDATE($USER_NIF, '$USER_PASS', '$USER_EMAIL', '$USER_QUALIFICATION_ID', '$USER_QUALIFICATION_SCHOOL', '$USER_QUALIFICATION_DESCRIPTION', '$USER_QUALIFICATION_DURATION' )");

        DB::commit();

        return $user;

    }

    public function deleteQualificatons($USER_NIF, $USER_PASS, $USER_EMAIL, $USER_QUALIFICATION_ID) 
    {

        // DB::beginTransaction();

        $user = DB::select("SELECT * FROM API_USER_QUALIFICATION_DELETE($USER_NIF, '$USER_PASS', '$USER_EMAIL', '$USER_QUALIFICATION_ID' )");

        DB::commit();

        return $user;

    }

    public function getJobExperience($USER_NIF, $USER_PASS, $USER_EMAIL) 
    {

        // DB::beginTransaction();

        $user = DB::select("SELECT * FROM API_USER_JOB_EXPERIENCE_GET($USER_NIF, '$USER_PASS', '$USER_EMAIL')");

        DB::commit();

        return $user;

    }

    // public function deleteJobExperience($USER_NIF, $USER_PASS, $USER_EMAIL) 
    // {

    //     // DB::beginTransaction();

    //     $user = DB::select("SELECT * FROM API_USER_JOB_EXPERIENCE_DELETE($USER_NIF, '$USER_PASS', '$USER_EMAIL')");

    //     DB::commit();

    //     return $user;

    // }

    public function updateJobExperience($USER_NIF, $USER_PASS, $USER_EMAIL, $JOB_EXPERIENCE_ID, $COMPANY, $JOB, $START_DATE, $END_DATE) 
    {


        // DB::beginTransaction();

        // $user = DB::select("SELECT * FROM API_USER_JOB_EXPERIENCE_UPDATE($USER_NIF, '$USER_PASS', '$USER_EMAIL', '$JOB_EXPERIENCE_ID', '$COMPANY', '$JOB', '$START_DATE', '$END_DATE')"); 

        if($END_DATE){

            $user = DB::select("SELECT * FROM API_USER_JOB_EXPERIENCE_UPDATE($USER_NIF, '$USER_PASS', '$USER_EMAIL', '$JOB_EXPERIENCE_ID', '$COMPANY', '$JOB', '$START_DATE', '$END_DATE')");
        }else{
            $user = DB::select("SELECT * FROM API_USER_JOB_EXPERIENCE_UPDATE($USER_NIF, '$USER_PASS', '$USER_EMAIL', '$JOB_EXPERIENCE_ID', '$COMPANY', '$JOB', '$START_DATE', null)");
        }

        DB::commit();
        
        return $user;

    }

    public function deleteJobExperience($USER_NIF, $USER_PASS, $USER_EMAIL, $USER_EXPERIENCE_ID) 
    {

        // $user = DB::executeProcedure('API_USER_JOB_EXPERIENCE_DELETE', [$USER_NIF, $USER_PASS, $USER_EMAIL, $USER_EXPERIENCE_ID]);

        $user = DB::select("SELECT * FROM API_USER_JOB_EXPERIENCE_DELETE($USER_NIF, '$USER_PASS', '$USER_EMAIL', '$USER_EXPERIENCE_ID')"); 
        // $stmt = $lokos->prepare("SELECT * FROM API_USER_JOB_EXPERIENCE_DELETE( '302755225' , 'dsdadsadasdsa' , 'ahmed@teste.pt' , 1)");
        // $stmt->execute();
        // $dados = $stmt->fetchAll(PDO::FETCH_OBJ);
        // $lokos->commit();
        // print_r($dados);
        DB::commit();
        // print_r($dados);

        // dd ("SELECT * FROM API_USER_JOB_EXPERIENCE_DELETE(". $USER_NIF . ' , ' . $USER_PASS . ' , ' . $USER_EMAIL . ' , ' . $USER_EXPERIENCE_ID);


        // DB::commit();

        return $user;

    }
    
    // Horários de prefência

    public function getWorkingHours($USER_NIF, $USER_PASS, $USER_EMAIL)
    {

        // DB::beginTransaction();

        $abilities = DB::select("SELECT * FROM API_USER_WORKING_HOURS_GET ($USER_NIF, '$USER_PASS', '$USER_EMAIL')");
       
        DB::commit();

        return $abilities;

    }

    public function updateWorkingHours($USER_NIF, $USER_PASS, $USER_EMAIL, $USER_WORKING_HOURS_ID, $USER_WORKING_HOURS_SELECTED)
    {

        $abilities = DB::select("SELECT * FROM API_USER_WORKING_HOURS_UPDATE ($USER_NIF, '$USER_PASS', '$USER_EMAIL', $USER_WORKING_HOURS_ID, $USER_WORKING_HOURS_SELECTED)");
       
        DB::commit();

        return $abilities;

    }

    // Zonas de prefência

    public function getWorkingAreas($USER_NIF, $USER_PASS, $USER_EMAIL)
    {

        // DB::beginTransaction();

        $workingAreas = DB::select("SELECT * FROM API_USER_WORKING_AREAS_GET ('$USER_NIF', '$USER_PASS', '$USER_EMAIL')");
       
        DB::commit();

        return $workingAreas;

    }

    public function updateWorkingAreas($USER_NIF, $USER_PASS, $USER_EMAIL, $USER_WORKING_AREAS_ID, $USER_WORKING_AREAS_SELECTED)
    {

        $updateWorkingAreas = DB::select("SELECT * FROM API_USER_WORKING_AREAS_UPDATE ($USER_NIF, '$USER_PASS', '$USER_EMAIL', $USER_WORKING_AREAS_ID, $USER_WORKING_AREAS_SELECTED )");
       
        DB::commit();

        return $updateWorkingAreas;

    }

    // ESCALAS DE TRABALHO
    public function getWorkShifts($USER_NIF, $USER_PASS, $USER_EMAIL, $CODIG_CATEGORIA, $CODIGO_CENTRO_CUSTO, $ANO, $MES)
    {

        // DB::beginTransaction();

        $abilities = DB::select("SELECT * FROM API_USER_WORK_SHIFT_GET ($USER_NIF, '$USER_PASS', '$USER_EMAIL', '$CODIG_CATEGORIA', '$CODIGO_CENTRO_CUSTO', '$ANO', '$MES')");
       
        DB::commit();

        return $abilities;

    }

    // ESCALAS DE TRABALHO
    public function updateWorkShifts($USER_NIF, $USER_PASS, $USER_EMAIL, $USER_WORK_SHIFT_NUMBER, $USER_WORK_SHIFT_LINE_NUMBER, $USER_WORK_SHIFT_LOCAL_ID, $USER_WORK_SHIFT_START_DATE, $USER_WORK_SHIFT_STATE, $USER_WORK_SHIFT_JUSTIFICATION)
    {

            $abilities = DB::select("SELECT * FROM API_USER_WORK_SHIFT_UPDATE ($USER_NIF, '$USER_PASS', '$USER_EMAIL', '$USER_WORK_SHIFT_NUMBER', 
            '$USER_WORK_SHIFT_LINE_NUMBER', '$USER_WORK_SHIFT_LOCAL_ID', '$USER_WORK_SHIFT_START_DATE', '$USER_WORK_SHIFT_STATE', '$USER_WORK_SHIFT_JUSTIFICATION')");
       
        DB::commit();

        return $abilities;

    }

    public function getWorkShiftLocals($USER_NIF, $USER_PASS, $USER_EMAIL)
    {

        // DB::beginTransaction();

        $wsLocals = DB::select("SELECT * FROM API_USER_WORK_SHIFT_GET_LOCAL ($USER_NIF, '$USER_PASS', '$USER_EMAIL')");
       
        DB::commit();

        return $wsLocals;

    }

    public function getWorkShiftMonths($USER_NIF, $USER_PASS, $USER_EMAIL)
    {

        // DB::beginTransaction();

        $wsMonths = DB::select("SELECT * FROM API_USER_WORK_SHIFT_GET_MONTH ($USER_NIF, '$USER_PASS', '$USER_EMAIL')");
       
        DB::commit();

        return $wsMonths;

    }

    public function getWorkShiftYears($USER_NIF, $USER_PASS, $USER_EMAIL)
    {

        // DB::beginTransaction();

        $wsYears = DB::select("SELECT * FROM API_USER_WORK_SHIFT_GET_YEAR ($USER_NIF, '$USER_PASS', '$USER_EMAIL')");
       
        DB::commit();

        return $wsYears;

    }

    // Login de utilizador 

    public function login($NIF, $PASS) 
    {

        DB::beginTransaction();

        $user = DB::select("SELECT * FROM API_USER_LIST('$NIF', '$PASS')");

        DB::commit();

        return $user;

    }

    public function verifyUser($NIF, $PASS, $EMAIL) 
    {

        // DB::beginTransaction();

        $verification = DB::select("SELECT * FROM API_USER_NEW_VERIFY('$NIF', '$PASS', '$EMAIL')");

        DB::commit();

        // dd($verification);
        // $abc = $verification[0];
        // $myArrayKey = array_keys($abc);


        // dd($myArrayKey);
        // dd ($abc == '"RESULT": "error: nif already exists"');

        // if ($verification == 'sucess'){
        //     $verification = true;
        // }

        // if ($verification == 'error: email must match the company records'){

        // }


        // return json_encode ($verification);

        return $verification;

    }
    
    // Lista de países 

    public function countriesList() 
    {

        DB::beginTransaction();

        
        // $countries = DB::select("SELECT * FROM PAISES ");
        $countries = DB::select("SELECT * from paises p ORDER BY IIF(UPPER(P.Nacionalidade) = 'PORTUGAL', '', P.Nacionalidade)");
       
        DB::commit();

        return $countries;

    }
    
    // Lista de distritos 

    public function districtsList()
    {

        DB::beginTransaction();

        $districts = DB::select("SELECT * FROM DISTRITOS ORDER BY DESCRICAO");
       
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

        $counties = DB::select("SELECT CODIGO_DISTRITO, CODIGO_CONCELHO, DESCRICAO_API FROM CONCELHOS $whereClause ORDER BY DESCRICAO");
       
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

        $locations = DB::select("SELECT * FROM LOCAIS $whereClause ORDER BY DESCRICAO");
       
        DB::commit();

        return $locations;

    }
    
    // Lista de skills 

    public function skillsList()
    {

        DB::beginTransaction();

        $skills = DB::select("SELECT * FROM EMPREGADOS_HABILITACOES WHERE ORDEM = 1");
       
        DB::commit();

        return $skills;

    }
    
    // Lista de abilities 

    public function abilitiesList()
    {

        // DB::beginTransaction();

        $abilities = DB::select("SELECT * FROM EMPREGADOS_CONHECIMENTOS_TPS WHERE CODIGO_GRUPO_TIPO_CONHECIMENTO = 1");
       
        DB::commit();

        return $abilities;

    }

    // Lista de abilities do user

    public function listUserAbilities($USER_NIF, $USER_PASS, $USER_EMAIL)
    {

        // DB::beginTransaction();

        $abilities = DB::select("SELECT * FROM API_USER_LANGUAGES_GET($USER_NIF, '$USER_PASS', '$USER_EMAIL')");
       
        DB::commit();

        return $abilities;

    }

    // Lista de abilities do user

    public function addUserAbilities($USER_NIF, $USER_PASS, $USER_EMAIL, $ABILITY_ID)
    {

            // DB::beginTransaction();

            $abilities = DB::executeProcedure('API_USER_LANGUAGES_NEW', [$USER_NIF, $USER_PASS, $USER_EMAIL, $ABILITY_ID]);
            
            // $abilities = DB::select("SELECT * FROM API_USER_LANGUAGES_NEW($USER_NIF, '$USER_PASS', '$USER_EMAIL', '$ABILITY_ID')");

            
            DB::commit();


        return $abilities;

    }

    // Apagar de abilities do user

    public function deleteUserAbilities($USER_NIF, $USER_PASS, $USER_EMAIL)
    {


        // DB::beginTransaction();

        $abilities = DB::select("SELECT * FROM API_USER_LANGUAGES_DELETE($USER_NIF, '$USER_PASS', '$USER_EMAIL')");
       
        DB::commit();

        return $abilities;

    }


        // Lista areas de interesse

        public function listJobCategories($USER_NIF, $USER_PASS, $USER_EMAIL)
        {

            // DB::beginTransaction();
    
            $abilities = DB::select("SELECT * FROM API_USER_JOB_CATEGORIES_GET ($USER_NIF, '$USER_PASS', '$USER_EMAIL')");
           
            DB::commit();
    
            return $abilities;
    
        }

        public function updateJobCategories($USER_NIF, $USER_PASS, $USER_EMAIL, $CATEGORY_ID, $SELECTED, $PUBLIC)
        {
            if ($PUBLIC){
                DB::beginTransaction();
            }

            $categories = DB::select("SELECT * FROM API_USER_JOB_CATEGORIES_UPDATE ($USER_NIF, '$USER_PASS', '$USER_EMAIL', '$CATEGORY_ID', '$SELECTED')");
           
            DB::commit();
    
            return $categories;
    
        }
        

    // Lista de tipos de documentos 

    public function documentTypesList()
    {

        DB::beginTransaction();

        $documentTypes = DB::select("SELECT * FROM ARQUIVO_TIPOS_CLASSIFICACAO WHERE MOSTRAR_EM_RECRUTAMENTO = 'S'");
       
        DB::commit();

        return $documentTypes;

    }
    
    //TODO select first 10 skip 0 from api_user_timesheet_get

    public function getTimeSheet($USER_NIF, $USER_PASS, $USER_EMAIL, $DATE_FROM, $DATE_TO)
    {

        // DB::beginTransaction();

        $timesheet = DB::select("SELECT * FROM API_USER_TIMESHEET_GET ('$USER_NIF', '$USER_PASS', '$USER_EMAIL', '$DATE_FROM', '$DATE_TO')");
       
        DB::commit();

        return $timesheet;

    }

    
    public function getPayroll($USER_NIF, $USER_PASS, $USER_EMAIL, $DATE_FROM, $DATE_TO)
    {

        $payroll = DB::select("SELECT * FROM API_USER_PAYROLL_GET ('$USER_NIF', '$USER_PASS', '$USER_EMAIL', '$DATE_FROM', '$DATE_TO')");
       
        DB::commit();

        return $payroll;

    }

    public function getPayrollPDF($USER_NIF, $USER_PASS, $USER_EMAIL, $PAYROLL_YEAR, $PAYROLL_NUMBER)
    {

        // DB::beginTransaction();

        $payrollPDF = DB::select("SELECT * FROM API_USER_PAYROLL_PDF_GET ('$USER_NIF', '$USER_PASS', '$USER_EMAIL', '$PAYROLL_YEAR', '$PAYROLL_NUMBER')");
       
        DB::commit();

        return $payrollPDF;

    }

    public function getMedicine($USER_NIF, $USER_PASS, $USER_EMAIL)
    {

        // DB::beginTransaction();

        $medicine = DB::select("SELECT * FROM API_USER_MEDICINE_GET ('$USER_NIF', '$USER_PASS', '$USER_EMAIL')");
       
        DB::commit();

        return $medicine;

    }

    public function getContracts($USER_NIF, $USER_PASS, $USER_EMAIL)
    {

        // DB::beginTransaction();

        $contracts = DB::select("SELECT * FROM API_USER_CONTRACTS_GET ('$USER_NIF', '$USER_PASS', '$USER_EMAIL')");
       
        DB::commit();

        return $contracts;

    }

    public function getRecruitments($USER_NIF, $USER_PASS, $USER_EMAIL, $DATE_FROM, $DATE_TO)
    {

        // DB::beginTransaction();

        $recruitments = DB::select("SELECT * FROM API_USER_RECRUITMENTS_GET ('$USER_NIF', '$USER_PASS', '$USER_EMAIL', '$DATE_FROM', '$DATE_TO')");
       
        DB::commit();

        return $recruitments;

    }

    public function getContractPDF($USER_NIF, $USER_PASS, $USER_EMAIL, $CONTRACT_YEAR, $CONTRACT_AGENCY, $CONTRACT_NUMBER)
    {

        DB::beginTransaction();

        $payrollPDF = DB::select("SELECT * FROM API_USER_CONTRACTS_PDF_GET ('$USER_NIF', '$USER_PASS', '$USER_EMAIL', '$CONTRACT_YEAR', '$CONTRACT_AGENCY', '$CONTRACT_NUMBER')");
       
        DB::commit();

        return $payrollPDF;

    }

    public function getIRS($USER_NIF, $USER_PASS, $USER_EMAIL)
    {

        // DB::beginTransaction();

        $irsIncome = DB::select("SELECT * FROM API_USER_IRS_INCOME_LIST ('$USER_NIF', '$USER_PASS', '$USER_EMAIL')");
       
        DB::commit();

        return $irsIncome;

    }

        //LOAD FROM FILE
        public function uploadFile($NIF, $PASS, $EMAIL, $FILENAME, $CODIGO_CLASSIFICACAO, $FILE) 
    {
        DB::beginTransaction();

        $connection = ibase_connect(env('DB_DATABASE'), env('DB_USERNAME'), env('DB_PASSWORD'), 'utf-8', '100');

        // fbird_blob_create($FILE)
        // move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $FILE);
        $abc = fbird_blob_create($FILE);
        // $nome_ficheiro = $FILE;
        // $tmpFile = $FILE->makeTmpFile();
        $fileContent = file_get_contents($FILE);
        // dd($FILE['tmp_name']);

        // $data = file_get_contents($FILE['perfil_curriculo']['tmp_name']);
        // dd('HEY');
        $blh = ibase_blob_create($connection);
        ibase_blob_add($blh, $data);
        $blobid = ibase_blob_close($blh);

        dd($FILE);
        // $target_dir = "uploads/";
        // $target_file = $target_dir . basename($_FILES["file"]["name"]);
        // $abc = move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
        
        $offers = DB::select("SELECT * FROM API_USER_ATTACHMENTS_NEW('$NIF', '$PASS', '$EMAIL', '$FILENAME', '$CODIGO_CLASSIFICACAO', '$FILE' ");
        DB::commit();

        //ORDER BY RECRUITMENT_GROUP
        return $offers;

    }


    public function attachmentNew($USER_NIF, $USER_PASS, $USER_EMAIL, $USER_ATTACHMENT_NAME, $USER_ATTACHMENT_CLASS_ID, $USER_ATTACHMENT)
    {

        // dd('hey');
        // $blob = fopen($USER_ATTACHMENT->path(), 'rb');

        // $connection =  ibase_connect('d:/one-key/swworking.gdb', 'APISW', 'SWAPI.001', 'ISO8859_1', '100');

        // $nome_ficheiro = 'NNNNNAME';
        // $data = file_get_contents($files['perfil_curriculo']['tmp_name']);
        // $blh = ibase_blob_create($connection);
        // ibase_blob_add($blh, $data);
        // $blobid = ibase_blob_close($blh);
        // dd($blob);

        // DB::beginTransaction();


        // return ($USER_ATTACHMENT_CLASS_ID);
        // $attachmentNew = DB::select("SELECT * FROM API_USER_ATTACHMENTS_NEW ('$USER_NIF', '$USER_PASS', '$USER_EMAIL', '$USER_ATTACHMENT_NAME', '$USER_ATTACHMENT_CLASS_ID', $USER_ATTACHMENT)");
        // dd($attachmentNew);
        $attachmentNew = DB::executeProcedure('API_USER_ATTACHMENTS_NEW', [$USER_NIF, $USER_PASS, $USER_EMAIL, $USER_ATTACHMENT_NAME, $USER_ATTACHMENT_CLASS_ID, $USER_ATTACHMENT]);

       
        DB::commit();

        return $attachmentNew;
        // return $this->convertUTF8($attachmentNew);

    }

    public function attachmentDestroy($USER_NIF, $USER_PASS, $USER_EMAIL, $USER_ATTACHMENT_NAME) {

        $attachmentDelete = DB::executeProcedure('API_USER_ATTACHMENTS_DELETE', [$USER_NIF, $USER_PASS, $USER_EMAIL, $USER_ATTACHMENT_NAME]);
       
        DB::commit();
    }

    public function attachmentsList($USER_NIF, $USER_PASS, $USER_EMAIL)
    {

        // DB::beginTransaction();

        $recruitments = DB::select("SELECT * FROM API_USER_ATTACHMENTS_LIST ('$USER_NIF', '$USER_PASS', '$USER_EMAIL')");
       
        DB::commit();

        return $recruitments;

    }

    public function attachmentsGet($id, $name)
    {

        // DB::beginTransaction();

        $file = DB::select("SELECT FIRST 1 ANEXO FROM EMPREGADOS_ANEXOS where codigo_empregado = '$id' and NOME_FICHEIRO_ANEXO = '$name'");
       
        DB::commit();

        return $file;

    }

    public function offersList($USER_NIF, $USER_PASS, $USER_EMAIL, $DATE)
    {

        // DB::beginTransaction();

        $offers = DB::select("SELECT * FROM API_USER_OFFERS_LIST ('$USER_NIF', '$USER_PASS', '$USER_EMAIL', '$DATE')");
       
        DB::commit();

        return $offers;

    }

    public function offerApply($USER_NIF, $USER_PASS, $USER_EMAIL, $OFFER)
    {

        // DB::beginTransaction();

        $offers = DB::select("SELECT * FROM API_USER_OFFER_APPLY ('$USER_NIF', '$USER_PASS', '$USER_EMAIL', '$OFFER')");

        DB::commit();

        return $offers;

    }

    public function messageNew($USER_NIF, $USER_PASS, $USER_EMAIL, $MESSAGE_SUBJECT, $MESSAGE_TEXT)
    {

        // DB::beginTransaction();

        $message = DB::select("SELECT * FROM API_USER_MESSAGES_NEW ('$USER_NIF', '$USER_PASS', '$USER_EMAIL', '$MESSAGE_SUBJECT', '$MESSAGE_TEXT')");
       
        DB::commit();

        return $message;

    }

    public function messageGet($USER_NIF, $USER_PASS, $USER_EMAIL)
    {

        // DB::beginTransaction();

        $message = DB::select("SELECT * FROM API_USER_MESSAGES_GET ('$USER_NIF', '$USER_PASS', '$USER_EMAIL')");
       
        DB::commit();

        return $message;

    }

    public function messagesSent($USER_NIF, $USER_PASS, $USER_EMAIL)
    {

        // DB::beginTransaction();

        $message = DB::select("SELECT * FROM API_USER_SENT_MESSAGES_GET ('$USER_NIF', '$USER_PASS', '$USER_EMAIL')");
       
        DB::commit();

        return $message;

    }

    public function messagesRecived($USER_NIF, $USER_PASS, $USER_EMAIL)
    {

        // DB::beginTransaction();

        $message = DB::select("SELECT * FROM API_USER_RECIVED_MESSAGES_GET ('$USER_NIF', '$USER_PASS', '$USER_EMAIL')");
       
        DB::commit();

        return $message;

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