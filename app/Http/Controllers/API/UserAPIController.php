<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;


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
        $USER_NAME = $request->USER_NAME ?? '';
        $USER_ADDRESS_1 = $request->USER_ADDRESS_1 ?? '';
        $USER_ADDRESS_2 = $request->USER_ADDRESS_2 ?? '';
        $USER_POSTAL_CODE = $request->USER_POSTAL_CODE ?? '';
        $USER_TELEPHONE = $request->USER_TELEPHONE ?? '';
        $USER_BIRTHDATE = $request->USER_BIRTHDATE ?? '';
        $USER_SOCIAL_SECURITY_NUMBER = $request->USER_SOCIAL_SECURITY_NUMBER ?? '';
        $USER_COUNTRY_ID = $request->USER_COUNTRY_ID ?? '';
        $USER_QUALIFICATION_ID = $request->USER_QUALIFICATION_ID ?? '';
        $USER_DISTRICT_ID = $request->USER_DISTRICT_ID ?? '';
        $USER_COUNTY_ID = $request->USER_COUNTY_ID ?? '';
        $USER_LOCAL_ID = $request->USER_LOCAL_ID ?? '';
        $TEM_VIATURA = $request->TEM_VIATURA ?? '';
        $TEM_CARTA_CONDUCAO = $request->TEM_CARTA_CONDUCAO ?? '';
        $USER_TIPO_COMUNICACAO = $request->USER_TIPO_COMUNICACAO ?? '';
        $USER_RECEBE_NOTICIAS = $request->USER_RECEBE_NOTICIAS ?? '';
        $USER_ACEITA_CONDICOES = $request->USER_ACEITA_CONDICOES ?? '';
        //acrescentar campos da aceitar comunicaçao, ultimos cammpos na BD
    
        $user = $this->userRepository->userNew($NIF, $PASS, $EMAIL , $USER_NAME,$USER_ADDRESS_1 ,$USER_ADDRESS_2 ,$USER_POSTAL_CODE ,
        $USER_TELEPHONE,$USER_BIRTHDATE ,$USER_SOCIAL_SECURITY_NUMBER ,$USER_COUNTRY_ID, $USER_QUALIFICATION_ID, $USER_DISTRICT_ID, 
        $USER_COUNTY_ID, $USER_LOCAL_ID, $TEM_VIATURA, $TEM_CARTA_CONDUCAO, $USER_TIPO_COMUNICACAO, $USER_RECEBE_NOTICIAS, $USER_ACEITA_CONDICOES);
        
        return json_encode($user);
    }


    public function show(Request $request)
    {

        $NIF = $request->nif ?? '';

        $user = $this->userRepository->userGet($NIF)[0];

        $collection = collect($user);

        $collection->transform(function($item, $key) {
            if ($key == 'USER_QUALIFICATION'){
                $this->convertUTF8($item);
            }else {
                return $item;
            }
        });


        return ($collection);
    }


    public function update($id, Request $request)
    {

        $USER_NIF = $request->USER_NIF ?? '';
        $NEW_PASS = $request->USER_PASS ?? '';
        $USER_EMAIL = $request->USER_EMAIL ?? '';
        $USER_NAME = $request->USER_name ?? '';
        $USER_ADRESS_1 = $request->USER_ADRESS_1 ?? '';
        $USER_ADDRESS_2 = $request->USER_ADDRESS_2 ?? '';
        $USER_POSTAL_CODE = $request->USER_POSTAL_CODE ?? '';
        $USER_TELEPHONE = $request->USER_TELEPHONE ?? '';
        $USER_BIRTHDATE = $request->USER_BIRTHDATE ?? '';
        $USER_SOCIAL_SECURITY_NUMBER = $request->USER_SOCIAL_SECURITY_NUMBER ?? '';
        $USER_COUNTRY_ID = $request->USER_COUNTRY_ID ?? '';
        $USER_QUALIFICATION_ID = $request->USER_QUALIFICATION_ID ?? '';
        $USER_DISTRICT_ID = $request->USER_DISTRICT_ID ?? '';
        $USER_COUNTY_ID = $request->USER_COUNTY_ID ?? '';
        $USER_LOCAL_ID = $request->USER_LOCAL_ID ?? '';
        $TEM_VIATURA = $request->TEM_VIATURA ?? '';
        $TEM_CARTA_CONDUCAO = $request->TEM_CARTA_CONDUCAO ?? '';
        $USER_TIPO_COMUNICACAO = $request->USER_TIPO_COMUNICACAO ?? '';
        $USER_RECEBE_NOTICIAS = $request->USER_RECEBE_NOTICIAS ?? '';
        $USER_ACEITA_CONDICOES = $request->USER_ACEITA_CONDICOES ?? '';

        $user = $this->userRepository->userUpdate($USER_NIF,$NEW_PASS, $USER_EMAIL, $USER_NAME, $USER_ADRESS_1, $USER_ADDRESS_2, $USER_POSTAL_CODE,
        $USER_TELEPHONE, $USER_BIRTHDATE, $USER_SOCIAL_SECURITY_NUMBER, $USER_COUNTRY_ID, $USER_QUALIFICATION_ID, $USER_DISTRICT_ID, $USER_COUNTY_ID,
        $USER_LOCAL_ID, $TEM_VIATURA, $TEM_CARTA_CONDUCAO, $USER_TIPO_COMUNICACAO, $USER_RECEBE_NOTICIAS, $USER_ACEITA_CONDICOES);

        return json_encode($user);
    }


 public function destroy($id, Request $request)
    {
                $input = $request->all();

        //find (id) e get '$USER_NIF', '$USER_PASS', '$USER_EMAIL'
        $user = $this->userRepository->delete($request->USER_NIF, $request->USER_PASS, $request->USER_EMAIL);
        return json_encode($user);
        
    }
    
    
    // Job Experience
    public function addJobExperience (Request $request){
        
        $user = $this->userRepository->addJobExperience($request->USER_NIF, $request->USER_PASS, $request->USER_EMAIL, $request->COMPANY, $request->JOB, $request->START_DATE, $request->END_DATE);
       
        return json_encode($user);
    }
    
    public function getJobExperience (Request $request){
        
        $user = $this->userRepository->getJobExperience($request->USER_NIF, $request->USER_PASS, $request->USER_EMAIL);
        return json_encode($user);
    }

    public function updateJobExperience (Request $request){
        
        $user = $this->userRepository->updateJobExperience($request->USER_NIF, $request->USER_PASS, $request->USER_EMAIL, $request->JOB_EXPERIENCE_ID, $request->COMPANY, $request->JOB, $request->START_DATE, $request->END_DATE);
       
        return json_encode($user);
    }

    public function destroyJobExperience (Request $request){
        
        $user = $this->userRepository->deleteJobExperience($request->USER_NIF, $request->USER_PASS, $request->USER_EMAIL, $request->JOB_EXPERIENCE_ID);
       
        return json_encode($user);
    }
    
    
    //Working Hours
    
    public function getWorkingHours(Request $request)
    {
         $user = $this->userRepository->getWorkingHours($request->USER_NIF, $request->USER_PASS, $request->USER_EMAIL);
         return json_encode($user);
    }


    public function updateWorkingHours(Request $request)
    {
         $user = $this->userRepository->updateWorkingHours($request->USER_NIF, $request->USER_PASS, $request->USER_EMAIL, $request->USER_WORKING_HOURS_ID, $request->USER_WORKING_HOURS_SELECTED);
         return json_encode($user);
    }
    
    
    // Working Areas
    
    public function getWorkingAreas(Request $request)
    {
        
        $jobs = $this->userRepository->getWorkingAreas($request->USER_NIF, $request->USER_PASS, $request->USER_EMAIL);
        
        $jobsArray = collect([]);

        foreach ($jobs as $job){

            $all = collect( [
                'USER_WORKING_AREAS_ID' => $job->USER_WORKING_AREAS_ID,
                'USER_WORKING_AREAS_DESCRIPTION' => $this->convertUTF8($job->USER_WORKING_AREAS_DESCRIPTION),
                'USER_WORKING_AREAS_SELECTED' =>($job->USER_WORKING_AREAS_SELECTED),
            ]);

            $jobsArray->push($all);
            
        }
        // dd($user);
         return json_encode($jobsArray);
    }


    public function updateWorkingAreas(Request $request)
    {
         $user = $this->userRepository->updateWorkingAreas($request->USER_NIF, $request->USER_PASS, $request->USER_EMAIL, $request->USER_WORKING_AREAS_ID, $request->USER_WORKING_AREAS_SELECTED);
         return json_encode($user);
    }
    
   
    // ESCALAS DE TRABALHO
    public function getWorkShifts(Request $request)
    {
         $user = $this->userRepository->getWorkShifts($request->USER_NIF, $request->USER_PASS, $request->USER_EMAIL, $request->CODIG_CATEGORIA, $request->CODIGO_CENTRO_CUSTO, $request->ANO, $request->MES);
         return json_encode($user);
    }

    // ESCALAS DE TRABALHO
    public function updateWorkShifts(Request $request)
    {
         $user = $this->userRepository->updateWorkShifts($request->USER_NIF, $request->USER_PASS, $request->USER_EMAIL, $request->USER_WORK_SHIFT_NUMBER, $request->USER_WORK_SHIFT_LINE_NUMBER, 
            $request->USER_WORK_SHIFT_LOCAL_ID, $request->USER_WORK_SHIFT_START_DATE, $request->USER_WORK_SHIFT_STATE, $request->USER_WORK_SHIFT_JUSTIFICATION);
         return json_encode($user);
    }

    // Job Categories

    public function getJobCategories(Request $request)
    {
        
        $jobs = $this->userRepository->listJobCategories($request->USER_NIF, $request->USER_PASS, $request->USER_EMAIL);
        
        $jobsArray = collect([]);

        foreach ($jobs as $job){

            $all = collect( [
                'USER_JOB_CATEGORY_ID' => $job->USER_JOB_CATEGORY_ID,
                'USER_JOB_CATEGORY_DESCRIPTION' => $this->convertUTF8($job->USER_JOB_CATEGORY_DESCRIPTION),
                'USER_JOB_CATEGORY_SELECTED' =>($job->USER_JOB_CATEGORY_SELECTED),
                'USER_JOB_CATEGORY_PARENT_ID' => ($job->USER_JOB_CATEGORY_PARENT_ID),
            ]);

            $jobsArray->push($all);
            
        }

        //  dd($jobs);
            return json_encode($jobsArray);
    }
    
    public function login(Request $request)
    {

        $NIF = $request->nif ?? '';
        $PASS = $request->pass ?? '';
        $user = $this->userRepository->login($NIF,$PASS);

        return json_encode($user);
    }
    
    public function countries (Request $request)
    {

        $countries = $this->userRepository->countriesList();

        $countriesArray = collect([]);
                 
        // $input = $request->collect();

        foreach ($countries as $country){

            $all = collect( [
                'CODIGO_PAIS' => $country->CODIGO_PAIS,
                'DESCRICAO' => $this->convertUTF8($country->DESCRICAO),
            ]);

            $countriesArray->push($all);
            
        }

        return ($countriesArray);
        
    }
    
    public function districts (Request $request)
    {

        $districts = $this->userRepository->districtsList();
        
        $districtsArray = collect([]);

        foreach ($districts as $district){

            $all = collect( [
                'CODIGO_DISTRITO' => $district->CODIGO_DISTRITO,
                'DESCRICAO' => $this->convertUTF8($district->DESCRICAO),
                // 'NACIONALIDADE' => $this->convertUTF8($country->NACIONALIDADE),
                
            ]);

            $districtsArray->push($all);
            
        }

        return ($districtsArray);
        
    }
    
    public function counties (Request $request)
    {

        $counties = $this->userRepository->countiesList($request->CODIGO_DISTRITO);
        
        $countiesArray = collect([]);

        foreach ($counties as $county){

            $all = collect( [
                'CODIGO_DISTRITO' => $this->convertUTF8($county->CODIGO_DISTRITO),
                'CODIGO_CONCELHO' => $this->convertUTF8($county->CODIGO_CONCELHO),
                'DESCRICAO' => $this->convertUTF8($county->DESCRICAO_API),
                // 'NACIONALIDADE' => $this->convertUTF8($country->NACIONALIDADE),
                
            ]);
            
            $countiesArray->push($all);
            
        }
        // dd($countiesArray);

        return ($countiesArray);
        
    }
    
            public function locations (Request $request)
    {

        $locations = $this->userRepository->localList($request->CODIGO_DISTRITO,$request->CODIGO_CONCELHO);
        
        $locationsArray = collect([]);

        foreach ($locations as $location){

            $all = collect( [
                'CODIGO_DISTRITO' => ($location->CODIGO_DISTRITO),
                'CODIGO_CONCELHO' => ($location->CODIGO_CONCELHO),
                'CODIGO_FREGUESIA' => ($location->CODIGO_FREGUESIA),
                'DESCRICAO' =>  $this->convertUTF8($location->DESCRICAO),
                // 'NACIONALIDADE' => $this->convertUTF8($country->NACIONALIDADE),
                
            ]);

            $locationsArray->push($all);
            
        }

        return ($locationsArray);
        
    }
    
    public function skills (Request $request)
    {

        $skills = $this->userRepository->skillsList();

        $skillsArray = collect([]);

        foreach ($skills as $skill){

            $all = collect( [
                'CODIGO_HABILITACAO' => $this->convertUTF8($skill->CODIGO_HABILITACAO),
                'DESCRICAO' => $this->convertUTF8($skill->DESCRICAO),
                'CODIGO_DETEFP' => $this->convertUTF8($skill->CODIGO_DETEFP),
                // 'NACIONALIDADE' => $this->convertUTF8($country->NACIONALIDADE),
                
            ]);

            $skillsArray->push($all);
            
        }

        return ($skillsArray);
        
    }
    
    public function abilities (Request $request)
    {

        $abilities = $this->userRepository->abilitiesList();

        $abilitiesArray = collect([]);

        foreach ($abilities as $ability){

            $all = collect( [
                'CODIGO_CONHECIMENTO' => ($ability->CODIGO_CONHECIMENTO),
                'DESCRICAO' => $this->convertUTF8($ability->DESCRICAO),
                // 'CODIGO_CONHECIMENTO' => $this->convertUTF8($ability->CODIGO_CONHECIMENTO),
                // 'CODIGO_AUTO' => $this->convertUTF8($ability->CODIGO_AUTO),
                // 'NIVEL' => $this->convertUTF8($ability->NIVEL),
                
            ]);

            $abilitiesArray->push($all);
            
        }

        return ($abilitiesArray);
        
    }

      // Job Experience
      public function addUserAbilities (Request $request){
        
        $user = $this->userRepository->addUserAbilities($request->USER_NIF, $request->USER_PASS, $request->USER_EMAIL, $request->ABILITY_ID);
       
        return json_encode($user);
    }

    public function userAbilities (Request $request)
    {

        $abilities = $this->userRepository->listUserAbilities($request->USER_NIF, $request->USER_PASS, $request->USER_EMAIL);

        // return json_encode($abilities);
        
        $abilitiesArray = collect([]);

        foreach ($abilities as $ability){

            $all = collect( [
                'CODIGO_CONHECIMENTO' => ($ability->USER_LANGUAGE_ID),
                'DESCRICAO' => $this->convertUTF8($ability->USER_LANGUAGE),
            ]);

            $abilitiesArray->push($all);
            
        }

        return ($abilitiesArray);
        
    }
    
    public function destroyAbilities (Request $request){
        
        $user = $this->userRepository->deleteUserAbilities($request->USER_NIF, $request->USER_PASS, $request->USER_EMAIL);
       
        return json_encode($user);
    }
    
    public function documentTypes (Request $request)
    {

        $documentTypes = $this->userRepository->documentTypesList();

        $documentTypesArray = collect([]);

        foreach ($documentTypes as $documentType){

            $all = collect( [
                'DESCRICAO' => $this->convertUTF8($documentType->DESCRICAO),
                'CODIGO_CLASSIFICACAO' => ($documentType->CODIGO_CLASSIFICACAO),
                // 'CODIGO_AUTO' => $this->convertUTF8($ability->CODIGO_AUTO),
                // 'NIVEL' => $this->convertUTF8($ability->NIVEL),
                
            ]);

            $documentTypesArray->push($all);
            
        }

        return ($documentTypesArray);
        
    }
    
    public function getTimesheet (Request $request){

        $timesheets = $this->userRepository->getTimeSheet($request->USER_NIF, $request->USER_PASS, $request->USER_EMAIL, $request->DATE_FROM, $request->DATE_TO);

        $timesheetArray = collect([]);

        foreach ($timesheets as $timesheet){

            $all = collect( [
                "TIMESHEET_ID" => $timesheet->TIMESHEET_ID,
                "TIMESHEET_DATE_TIME_IN" => $timesheet->TIMESHEET_DATE_TIME_IN,
                "TIMESHEET_DATE_TIME_OUT" => $timesheet->TIMESHEET_DATE_TIME_OUT,
                "TIMESHEET_CLIENT" => $this->convertUTF8($timesheet->TIMESHEET_CLIENT),
                "TIMPSHEET_CATEGORY" => $this->convertUTF8($timesheet->TIMPSHEET_CATEGORY),
                "TIMESHEET_DESCRIPTION" => $this->convertUTF8($timesheet->TIMESHEET_DESCRIPTION),
                "TIMESHEET_TOTAL_HOURS" => $timesheet->TIMESHEET_TOTAL_HOURS,
                "TIMESHEET_DAYS" => $timesheet->TIMESHEET_DAYS,
                "TIMESHEET_UNIT_VALUE" => $timesheet->TIMESHEET_UNIT_VALUE,
                "TIMESHEET_UNIT_TYPE" => $timesheet->TIMESHEET_UNIT_TYPE,
                "TIMESHEET_TOTAL_VALUE" => $timesheet->TIMESHEET_TOTAL_VALUE
                
            ]);

            $timesheetArray->push($all);
            
        }

        return json_encode($timesheetArray);

    }

    public function getPayroll (Request $request){
        
        $payroll = $this->userRepository->getPayroll($request->USER_NIF, $request->USER_PASS, $request->USER_EMAIL, $request->DATE_FROM, $request->DATE_TO);
       
        return json_encode($payroll);
    }

    public function getPayrollPDF (Request $request){
        
        $payrollPDF = $this->userRepository->getPayrollPDF($request->USER_NIF, $request->USER_PASS, $request->USER_EMAIL, $request->PAYROLL_YEAR, $request->PAYROLL_NUMBER);

        return json_encode($payrollPDF);
    }

    public function getMedicine (Request $request){
        
        $medicine = $this->userRepository->getMedicine($request->USER_NIF, $request->USER_PASS, $request->USER_EMAIL);

        return json_encode($medicine);
    }

    public function getContracts (Request $request){
        
        $contracts = $this->userRepository->getContracts($request->USER_NIF, $request->USER_PASS, $request->USER_EMAIL);

        return json_encode($contracts);
    }

    public function getRecruitments (Request $request){
        
        $recruitments = $this->userRepository->getRecruitments($request->USER_NIF, $request->USER_PASS, $request->USER_EMAIL, $request->DATE_FROM, $request->DATE_TO);

        return json_encode($recruitments);
    }

    //TODO Verificar se faz download no axios
    public function getContractPDF (Request $request){
        
        $contractPDF = $this->userRepository->getContractPDF($request->USER_NIF, $request->USER_PASS, $request->USER_EMAIL, $request->CONTRACT_YEAR, $request->CONTRACT_AGENCY, $request->CONTRACT_NUMBER);
        
        //The path and filename that you want to save the file to.
        $fileName = 'logo.png';
         
        //Save the data using file_put_contents.
        $save = file_put_contents($fileName,$contractPDF[0]);
        // $fullblob = file_get_contents($contractPDF[0]);
		
        return json_encode($contractPDF);
    }

    public function uploadFile(Request $request){
        
        // if ($request->hasFile('file')) {
        //     $logo = $request->file;
        //     $fileName = date('Y') . $logo->getClientOriginalName();
    
        // //Get the path to the folder where the image is stored 
        // //and then save the path in database
        //     $path = $request->file->storeAs('file', $fileName, 'public');
        //     $found['logo'] = $path;
        // }

        // // originalName realPath
        // $fileContent = file_get_contents($path);
        // // dd($fileContent);
        // $path = storage_path() . ($request->file)->getClientOriginalName();
        // // dd (file_get_contents($path));
        // $path = storage_path() . "/json/${filename}.json";

        // $json = json_decode(file_get_contents($path), true); 


        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        // dd($request->file);
        $FILE = file_get_contents($request->file);

        // DD($FILE);
        // ']['tmp_name']);
        // dd(($request->file('file')));
        // dd(($request->file)->getClientOriginalName());
        $documentTypes = $this->userRepository->uploadFile($request->nif,$request->pass, $request->email, $request->filename, $request->cod, $FILE );
        // dd($documentTypes);
        
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
