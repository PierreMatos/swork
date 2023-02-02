<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Auth\ConfirmAccountMail;

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

         // Save Attachment
        //  $FILE = file_get_contents($request->cvfile);
        //  return json_encode($FILE);

        // $teste = $request->input('jobs_array');

        // return json_encode($teste);

        // foreach($teste as $oi){
        //     return json_encode($oi);
        // }

        // return json_encode($request->input('jobs_array'));
        // return json_encode($request->input());


        //create user
        //if created user true ->
        //create workinghours com user nif
        //create workingareas com user nif
        //create jobcategories com user nif
        //create abilities com user nif
        //anexar ficheiro

        
        //TODO
        //validator com nif e email unique


        // $validator = Validator::make($request->all(), [
        //     'USER_NIF' => 'required|unique',
        //     'USER_EMAIL' => 'required|unique',
        // ]);
        
        // if($validator->fails()){
            
        //     return response()->json($validator->errors(), 400);
            
        //     return $validator->errors()->toJson();
        // }

        $NIF = $request->NIF_UTILIZADOR ?? '';
        $PASS = Hash::make($request->PASS_UTILIZADOR) ?? '';
        $EMAIL = $request->EMAIL_UTILIZADOR ?? '';
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
        $USER_HAS_CAR = $request->USER_HAS_CAR ?? '';
        $USER_HAS_DRIVERS_LICENCE = $request->USER_HAS_DRIVERS_LICENCE ?? '';
        $USER_COMMUNICATION_TYPE = $request->USER_COMMUNICATION_TYPE ?? '';
        $USER_NEWSLETTER = $request->USER_NEWSLETTER ?? '';
        $USER_PRIVACY_POLICY = $request->USER_PRIVACY_POLICY ?? '';
        $USER_SEX = $request->USER_SEX ?? '';
        //acrescentar campos da aceitar comunicaçao, ultimos cammpos na BD

        
        // TODO VALIDAR NIF + EMAIL
        // PROCEDIMENTO PARA VALIDAR CANDIDATO
        // SELECT CONTRIBUINTE, E_MAIL FROM empregados where contribuinte = '251161420'

        $validator = Validator::make($request->all(), [
            'NIF_UTILIZADOR' => 'required|unique:EMPREGADOS_UTILIZADORES_PORTAL',
            'EMAIL_UTILIZADOR' => 'required|unique:EMPREGADOS_UTILIZADORES_PORTAL',
        ]);
        
        if($validator->fails()){
            
            return response()->json($validator->errors(), 400);
            
            return $validator->errors()->toJson();
        }

        // $newUser = $this->userRepository->verifyUser($request->NIF_UTILIZADOR, $request->pass, $request->EMAIL_UTILIZADOR)[0];

        // $result = collect($newUser)->contains('success');

        // if ($result) {

        //     //regista user
        //     return response()->json('sucess', 200);


        // }else {

        //     //mensagem de erro
        //     return response()->json('redirect', 401);

        // }



        // $user = $this->userRepository->userNew($NIF, $PASS, $EMAIL , $USER_NAME,$USER_ADDRESS_1 ,$USER_ADDRESS_2 ,$USER_POSTAL_CODE ,
        // $USER_TELEPHONE,$USER_BIRTHDATE ,$USER_SOCIAL_SECURITY_NUMBER ,$USER_COUNTRY_ID, $USER_QUALIFICATION_ID, $USER_DISTRICT_ID, 
        // $USER_COUNTY_ID, $USER_LOCAL_ID, $TEM_VIATURA, $TEM_CARTA_CONDUCAO, $USER_TIPO_COMUNICACAO, $USER_RECEBE_NOTICIAS, $USER_ACEITA_CONDICOES);
        
        // $user = $this->userRepository->userNew($NIF, $PASS, $EMAIL);
        
        $user = User::create([
             'NIF_UTILIZADOR' => $NIF,
             'EMAIL_UTILIZADOR' => $EMAIL,
             'PASS_UTILIZADOR' => $PASS,
             'USER_NAME' => $USER_NAME,
             'VALIDADO' => 'N',
             'USER_BIRTHDATE' => $USER_BIRTHDATE,
             'USER_COUNTRY_ID' => $USER_COUNTRY_ID,
             'USER_QUALIFICATION_ID' => $USER_QUALIFICATION_ID,
             'USER_POSTAL_CODE' => $USER_POSTAL_CODE,
             'USER_DISTRICT_ID' => $USER_DISTRICT_ID,
             'USER_COUNTY_ID' => $USER_COUNTY_ID,
             'USER_LOCAL_ID' => $USER_LOCAL_ID,
             'USER_SOCIAL_SECURITY_NUMBER' => $USER_SOCIAL_SECURITY_NUMBER,
             'USER_SEX' => $USER_SEX,
             'USER_TELEPHONE' => $USER_TELEPHONE,
             'USER_DISTRICT_ID' => $USER_DISTRICT_ID,
             'USER_COUNTY_ID' => $USER_COUNTY_ID,
             'USER_HAS_CAR' => $USER_HAS_CAR,
             'USER_HAS_DRIVERS_LICENCE' => $USER_HAS_DRIVERS_LICENCE,
             'USER_COMMUNICATION_TYPE' => $USER_COMMUNICATION_TYPE,
             'USER_NEWSLETTER' => $USER_NEWSLETTER,
             'USER_PRIVACY_POLICY' => $USER_PRIVACY_POLICY,
            
            ]);
            
             $user->save();

             $newUser = $this->userRepository->userGet($NIF)[0];
            //  return json_encode($newUser);

            if ($newUser){
                
                // $resultsCollection = collect([]);
                $resultsArray = collect([]);

                //Job Categories

                //Abilities
                $abilities = $request->input('language');

                $resultsArray = collect([]);

                if($abilities){

                    foreach ($abilities as $ability){
    
                            $userAbilities = $this->userRepository->addUserAbilities(
                                $NIF, 
                                $PASS, 
                                $EMAIL,
                                $ability['CODIGO_CONHECIMENTO']
                            );
    
                            $resultsArray->push($userAbilities);
    
                        }
                }


                //Working Areas
                $workingAreas = $request->input('area');

                if($workingAreas){

                    foreach ($workingAreas as $key => $workingArea) {
    
                        $updateWorkingAreas = $this->userRepository->updateWorkingAreas(
                            $NIF, 
                            $PASS, 
                            $EMAIL,
                            $key,
                            $workingArea === true ? 1: 0);
    
                        $resultsArray->push($updateWorkingAreas);
    
                    }
                }



                //Working Hours    
                $workingHours = $request->input('hour');

                if ($workingHours){

                    foreach ($workingHours as $key => $workingHour){
    
                        $updateWorkingHours = $this->userRepository->updateWorkingHours(
                            $NIF, 
                            $PASS, 
                            $EMAIL,
                            $key,
                            $workingHour === true ? 1: 0,
                            );

                        $resultsArray->push($updateWorkingHours);
                    
                    }
                
                }


                //Job Experience
                $jobExperiences = $request->input('jobs_array');

                if(is_null($jobExperiences)){

                    foreach($jobExperiences as $jobExperience){

                        // return json_encode($jobExperience['USER_EXPERIENCE_COMPANY']);
                        
                        $queryJobExperience = $this->userRepository->addJobExperience(
                            $NIF, 
                            $PASS, 
                            $EMAIL,
                            $jobExperience['USER_EXPERIENCE_COMPANY'],
                            $jobExperience['USER_EXPERIENCE_FUNCTION'],
                            $jobExperience['USER_EXPERIENCE_FROM_DATE'],
                            $jobExperience['USER_EXPERIENCE_TO_DATE']);
    
                        $resultsArray->push($queryJobExperience);
    
                    }
                
                }

                $jobCategories = $request->input('job');

                
                if(($jobCategories)){
                    
                    // return json_encode($jobCategories);

                    foreach($jobCategories as $jobCategory){
                        
                        // return json_encode($jobExperience['USER_EXPERIENCE_COMPANY']);
                        
                        $queryjobCategory = $this->userRepository->updateJobCategories(
                            $NIF, 
                            $PASS, 
                            $EMAIL,
                            $jobCategory,
                            1, //Selected 
                            false ); //public;
    
                        $resultsArray->push($queryjobCategory);
    
                    }
                
                }

                Mail::to($EMAIL)->send(new \App\Mail\ConfirmAccountMail($EMAIL, $USER_NAME));

            }

        // $token = JWTAuth::fromUser($newUser);

        // return response()->json(compact('user', 'token'), 201);
        // return response()->json([
        //     'success' => true,
        //     'data' => $newUser
        // ]);
    
        return json_encode($resultsArray);
    }


    public function sendEmailConfirmation($user){
        
        $user = $request->input();
        $name = $request->name;
        $email = $request->email;
        $token = $request->token;

        Mail::to($email)->send(new \App\Mail\ConfirmAccountMail($email, $name, $token));

        return 'success';

    }

    public function confirmAccount(Request $request){

        // dd($request->email);
        // $account = User::find($request->email);

        $account = User::where('EMAIL_UTILIZADOR', $request->email)->first();

        if ($account){

            $account->VALIDADO = 'S';
            $account->save();

            return redirect('https://myswork.herokuapp.com/login');

            return $account;

        }else{

            return 'User not found';
        }

    }

    public function loginverify(Request $request){

        $validator = Validator::make($request->all(), [
            'NIF_UTILIZADOR' => 'required|unique:EMPREGADOS_UTILIZADORES_PORTAL',
            'EMAIL_UTILIZADOR' => 'required|unique:EMPREGADOS_UTILIZADORES_PORTAL',
        ]);
        
        if($validator->fails()){
            
            return response()->json($validator->errors(), 400);
            
            return $validator->errors()->toJson();
        }

        $newUser = $this->userRepository->verifyUser($request->NIF_UTILIZADOR, $request->pass, $request->EMAIL_UTILIZADOR)[0];

        $result = collect($newUser)->contains('success');

        if ($result) {

            //regista user
            return json_encode($result);


        }else {

            //mensagem de erro
            return json_encode($result);
        }

    }

    public function show(Request $request)
    {

        // $NIF = Auth::user()->NIF_UTILIZADOR ?? '';
        $NIF = Auth::user()->NIF_UTILIZADOR ?? '';

        $user = $this->userRepository->userGet($NIF)[0];

        $collection = collect($user);

        $collection->transform(function($item, $key) {

            if ($key == 'USER_NAME'){
                return ($this->convertUTF8($item));
            }
            if ($key == 'USER_ADDRESS_1'){
                return ($this->convertUTF8($item));
            }
            if ($key == 'USER_ADDRESS_1'){
                return ($this->convertUTF8($item));
            }
            if ($key == 'USER_ADDRESS_2'){
                return ($this->convertUTF8($item));
            
            }
            if ($key == 'USER_POSTAL_CODE'){
                return ($this->convertUTF8($item));
            
            }
            if ($key == 'EMAIL_UTILIZADOR'){
                return ($this->convertUTF8($item));
            
            }
            if ($key == 'USER_ADDRESS_2'){
                return ($this->convertUTF8($item));
            
            }
            if ($key == 'USER_ADDRESS_2'){
                return ($this->convertUTF8($item));
            }

            if ($key == 'USER_COUNTY'){
                return ($this->convertUTF8($item));
            }
            if ($key == 'USER_COUNTRY'){
                return ($this->convertUTF8($item));
            }
            if ($key == 'USER_DISTRICT'){
                return ($this->convertUTF8($item));
            }
            if ($key == 'USER_QUALIFICATION'){
                return ($this->convertUTF8($item));
            }
            if ($key == 'USER_ADDRESS_2'){
                if ($item == "")
                return null;
            }
            else {
                return $item;
            }
        });

        // DD($collection);

        return ($collection);
    }


    public function update(Request $request)
    {

        // TODO VALIDAR DADOS
        // $USER_NIF = $request->USER_NIF ?? '';
        // $NEW_PASS = Hash::make($request->USER_PASSWORD) ?? '';
        // // $NEW_PASS = bcrypt($request->USER_PASSWORD) ?? '';
        // $USER_EMAIL = $request->USER_EMAIL ?? '';
        // $USER_NAME = $request->USER_NAME ?? '';
        // $USER_ADRESS_1 = $request->USER_ADDRESS_1 ?? '';
        // $USER_ADDRESS_2 = $request->USER_ADDRESS_2 ?? '';
        // $USER_POSTAL_CODE = $request->USER_POSTAL_CODE ?? '';
        // $USER_TELEPHONE = $request->USER_TELEPHONE ?? '';
        // $USER_BIRTHDATE = $request->USER_BIRTHDATE ?? '';
        // $USER_SOCIAL_SECURITY_NUMBER = $request->USER_SOCIAL_SECURITY_NUMBER ?? null;
        // $USER_COUNTRY_ID = $request->USER_COUNTRY_ID ?? '';
        // $USER_QUALIFICATION_ID = $request->USER_QUALIFICATION_ID ?? '';
        // $USER_DISTRICT_ID = $request->USER_DISTRICT_ID ?? '';
        // $USER_COUNTY_ID = $request->USER_COUNTY_ID ?? '';
        // $USER_LOCAL_ID = $request->USER_LOCAL_ID ?? '';
        // $TEM_VIATURA = $request->USER_HAS_CAR ?? '';
        // $TEM_CARTA_CONDUCAO = $request->USER_HAS_DIVRES_LICENCE ?? '';
        // $USER_TIPO_COMUNICACAO = $request->USER_COMMUNICATION_TYPE ?? '';
        // $USER_RECEBE_NOTICIAS = $request->USER_NEWSLETTER ?? '';
        // $USER_ACEITA_CONDICOES = $request->USER_PRIVACY_POLICY ?? '';
        // $USER_SEX = $request->USER_SEX ?? '';

        // return json_encode($USER_SOCIAL_SECURITY_NUMBER);

        $userId = Auth::user()->NIF_UTILIZADOR;
        $userUpdate = User::findOrFail($userId);
        
        // return json_encode($user2);
        // dd($request->input('PASS_UTILIZADOR')) ;
        

        if (Auth::user()){

            $userAuth = Auth::user()[0];

            // if ($request->input('PASS_UTILIZADOR')) {

                // $pw = Hash::make($request->input('PASS_UTILIZADOR'));
    
                // $request->request->set('PASS_UTILIZADOR', $pw);
                // }
                
                $userUpdate->fill($request->input())->save();

            // $userUpdate->update([
            //     // 'NIF_UTILIZADOR' => $request->input('USER_NIF'),
            //     'PASS_UTILIZADOR' => Hash::make($request->input('USER_PASSWORD') ?? ''),
            //     // 'EMAIL_UTILIZADOR' => $request->input('EMAIL_UTILIZADOR'),
            //     'USER_NAME' => $request->input('USER_NAME') ?? '',
            //     'USER_ADRESS_1' => $request->input('USER_ADRESS_1'),
            //     'USER_ADDRESS_2' => $request->input('USER_ADDRESS_2'),
            //     'USER_POSTAL_CODE' => $request->input('USER_POSTAL_CODE'),
            //     'USER_TELEPHONE' => $request->input('USER_TELEPHONE'),
            //     'USER_BIRTHDATE' => $request->input('USER_BIRTHDATE'),
            //     'USER_SOCIAL_SECURITY_NUMBER' => $request->input('USER_SOCIAL_SECURITY_NUMBER'),
            //     'USER_COUNTRY_ID' => $request->input('USER_COUNTRY_ID'),
            //     'USER_QUALIFICATION_ID' => $request->input('USER_QUALIFICATION_ID'),
            //     'USER_DISTRICT_ID' => $request->input('USER_DISTRICT_ID'),
            //     'USER_COUNTY_ID' => $request->input('USER_COUNTY_ID'),
            //     'USER_LOCAL_ID' => $request->input('USER_LOCAL_ID'),

            //     'USER_HAS_CAR' => $request->input('USER_HAS_CAR'),
            //     'USER_HAS_DRIVERS_LICENCE' => $request->input('USER_HAS_DRIVERS_LICENCE'),
            //     'USER_COMMUNICATION_TYPE' => $request->input('USER_COMMUNICATION_TYPE'),
            //     'USER_NEWSLETTER' => $request->input('USER_NEWSLETTER'),
            //     'USER_PRIVACY_POLICY' => $request->input('USER_PRIVACY_POLICY'),
            //     'USER_SEX' => $request->input('USER_SEX'),
            // ]);

            // $user = $this->userRepository->userUpdate($userAuth->NIF_UTILIZADOR, 
            // $userAuth->PASS_UTILIZADOR, 
            // $userAuth->EMAIL_UTILIZADOR, 
            // $USER_NAME,
            // $USER_ADRESS_1, $USER_ADDRESS_2, $USER_POSTAL_CODE,
            // $USER_TELEPHONE, $USER_BIRTHDATE, $USER_SOCIAL_SECURITY_NUMBER,
            // $USER_COUNTRY_ID, $USER_QUALIFICATION_ID, $USER_DISTRICT_ID, $USER_COUNTY_ID,
            // $USER_LOCAL_ID, $TEM_VIATURA, $TEM_CARTA_CONDUCAO, $USER_TIPO_COMUNICACAO,
            // $USER_RECEBE_NOTICIAS, $USER_ACEITA_CONDICOES, $USER_SEX);
        }

        return json_encode($userUpdate);
    }


 public function destroy($id, Request $request)
    {
                $input = $request->all();

        //find (id) e get '$USER_NIF', '$USER_PASS', '$USER_EMAIL'
        $user = $this->userRepository->delete($request->USER_NIF, $request->USER_PASS, $request->USER_EMAIL);
        return json_encode($user);
        
    }
    
    
    // Job Experience
    public function postJobExperience (Request $request){
        
        
        $validator = Validator::make($request->all(), [
            'COMPANY' => 'required',
            'JOB' => 'required',
            'START_DATE' => 'required',
            // 'END_DATE' => 'required'
        ]);
        
        if($validator->fails()){
            
            return response()->json($validator->errors(), 400);
            
            return $validator->errors()->toJson();
        }
        
        if (Auth::user()){
            
            $jobExperience = $this->userRepository->addJobExperience(
                Auth::user()->NIF_UTILIZADOR, 
                Auth::user()->PASS_UTILIZADOR, 
                Auth::user()->EMAIL_UTILIZADOR,
                $request->COMPANY, 
                $request->JOB, 
                $request->START_DATE, 
                $request->END_DATE);
                
            }
        
        return json_encode($jobExperience);
    }
    
    public function getJobExperience (Request $request){
        
        if (Auth::user()){
            
            $jobExperiences = $this->userRepository->getJobExperience(
                Auth::user()->NIF_UTILIZADOR, 
                Auth::user()->PASS_UTILIZADOR, 
                Auth::user()->EMAIL_UTILIZADOR);

        }
            
        return json_encode($jobExperiences);
    }

    public function updateJobExperience (Request $request){
        
        
        if (Auth::user()){
            
            $jobExperiences = $request->jobs_array;


            // return json_encode($lastValue);

            $resultsArray = collect([]);
            // return json_encode($jobExperiences);
            foreach($jobExperiences as $jobExperience){

                if (is_null($jobExperience['JOB_EXPERIENCE_ID'])) {
                    
                    $queryJobExperience = $this->userRepository->addJobExperience(
                        Auth::user()->NIF_UTILIZADOR, 
                        Auth::user()->PASS_UTILIZADOR, 
                        Auth::user()->EMAIL_UTILIZADOR,
                        $jobExperience['USER_EXPERIENCE_COMPANY'],
                        $jobExperience['USER_EXPERIENCE_FUNCTION'],
                        $jobExperience['USER_EXPERIENCE_FROM_DATE'],
                        $jobExperience['USER_EXPERIENCE_TO_DATE']);

                    $resultsArray->push($queryJobExperience);

                }
                // else{

                  
                    $queryJobExperience = $this->userRepository->updateJobExperience(
                        Auth::user()->NIF_UTILIZADOR, 
                        Auth::user()->PASS_UTILIZADOR, 
                        Auth::user()->EMAIL_UTILIZADOR, 
                        $jobExperience['JOB_EXPERIENCE_ID'], 
                        $jobExperience['USER_EXPERIENCE_COMPANY'],
                        $jobExperience['USER_EXPERIENCE_FUNCTION'],
                        $jobExperience['USER_EXPERIENCE_FROM_DATE'],
                        $jobExperience['USER_EXPERIENCE_TO_DATE']);
                // }

                    $resultsArray->push($queryJobExperience);
            }

            //TODO check if this is needed
            $lastValue = last($jobExperiences);
            
            if($lastValue){


                $queryJobExperience = $this->userRepository->updateJobExperience(
                    Auth::user()->NIF_UTILIZADOR, 
                    Auth::user()->PASS_UTILIZADOR, 
                    Auth::user()->EMAIL_UTILIZADOR, 
                    $lastValue['JOB_EXPERIENCE_ID'], 
                    $lastValue['USER_EXPERIENCE_COMPANY'],
                    $lastValue['USER_EXPERIENCE_FUNCTION'],
                    $lastValue['USER_EXPERIENCE_FROM_DATE'],
                    $lastValue['USER_EXPERIENCE_TO_DATE']);

            }
            


        }
       
        return json_encode($resultsArray);
    }


    public function destroyJobExperience (Request $request){
        
        //validaçao de id 
        if (Auth::user() && $request->USER_EXPERIENCE_ID){

        $user = $this->userRepository->deleteJobExperience( 
            Auth::user()->NIF_UTILIZADOR, 
            Auth::user()->PASS_UTILIZADOR, 
            Auth::user()->EMAIL_UTILIZADOR, 
            $request->USER_EXPERIENCE_ID);

            return json_encode($user);
        }
        
        return json_encode("error");
    }
    
    
    //Working Hours
    
    public function getWorkingHours(Request $request)
    {
        if (Auth::user()){

            $workingHours = $this->userRepository->getWorkingHours(
            Auth::user()->NIF_UTILIZADOR, 
            Auth::user()->PASS_UTILIZADOR, 
            Auth::user()->EMAIL_UTILIZADOR);

        }

         $workingHoursArray = collect([]);

         foreach ($workingHours as $workingHour){
 
             $all = collect([
                 'USER_WORKING_HOURS_ID' => $workingHour->USER_WORKING_HOURS_ID,
                 'USER_WORKING_HOURS_DESCRIPTION' => $workingHour->USER_WORKING_HOURS_DESCRIPTION,
                 'USER_WORKING_HOURS_SELECTED' =>  $workingHour->USER_WORKING_HOURS_SELECTED === 1 ? true: false,
                 // 'USER_WORKING_AREAS_SELECTED' =>($job->USER_WORKING_AREAS_SELECTED),
             ]);
 
             $workingHoursArray->push($all);
             
         }

         return json_encode($workingHoursArray);

    }

    public function getWorkingHoursPublic(Request $request)
    {

            $workingHours = $this->userRepository->getWorkingHours(
                'null', 
                '',
                '', 
            );


         $workingHoursArray = collect([]);

         foreach ($workingHours as $workingHour){
 
             $all = collect([
                 'USER_WORKING_HOURS_ID' => $workingHour->USER_WORKING_HOURS_ID,
                 'USER_WORKING_HOURS_DESCRIPTION' => $workingHour->USER_WORKING_HOURS_DESCRIPTION,
                 'USER_WORKING_HOURS_SELECTED' =>  $workingHour->USER_WORKING_HOURS_SELECTED === 1 ? true: false,
                 // 'USER_WORKING_AREAS_SELECTED' =>($job->USER_WORKING_AREAS_SELECTED),
             ]);
 
             $workingHoursArray->push($all);
             
         }
         // dd($user);
          return json_encode($workingHoursArray);

    }


    public function patchWorkingHours(Request $request)
    {

        $workingHours = $request->input();

        $resultsCollection = collect([]);
        $hoursCollection = collect($workingHours);
        
        
        // return json_encode($resultsCollection->keys()->last());

        foreach ($workingHours as $key => $workingHour){

            if(!is_null($workingHour)){

                if (Auth::user()){
                    
    
                 $updateWorkingHours = $this->userRepository->updateWorkingHours(
                    Auth::user()->NIF_UTILIZADOR, 
                    Auth::user()->PASS_UTILIZADOR, 
                    Auth::user()->EMAIL_UTILIZADOR,
                    $key,
                    $workingHour === true ? 1: 0,
                    );

                    if($key == $hoursCollection->keys()->last()){

                        $updateWorkingHours = $this->userRepository->updateWorkingHours(
                            Auth::user()->NIF_UTILIZADOR, 
                            Auth::user()->PASS_UTILIZADOR, 
                            Auth::user()->EMAIL_UTILIZADOR, 
                            $key, 
                            $workingHour === true ? 1: 0);

                // $resultsCollection->push($updateWorkingHours , $key);

                    }

                    $resultsCollection->push($updateWorkingHours , $key);
        
                 }
            }

        }

        //TODO check if this is needed
        $workingHoursCollection = collect($workingHours);
        // $lastValue = $workingHoursCollection->last();
        $lastValue = last($workingHours);
        // return json_encode($lastValue);
        $id = $workingHoursCollection->keys()->last();
        
       

         return json_encode($resultsCollection);
    }
    
    
    // Working Areas
    
    public function getWorkingAreas(Request $request)
    {
        
        //TODO se nao tem user passa a vazio e lista tudo
        if (Auth::user()){

            $WorkingAreas = $this->userRepository->getWorkingAreas(
            Auth::user()->NIF_UTILIZADOR, 
            Auth::user()->PASS_UTILIZADOR, 
            Auth::user()->EMAIL_UTILIZADOR);

        }
        
        $WorkingAreasArray = collect([]);

        foreach ($WorkingAreas as $WorkingArea){

            $all = collect([
                'USER_WORKING_AREAS_ID' => $WorkingArea->USER_WORKING_AREAS_ID,
                'USER_WORKING_AREAS_DESCRIPTION' => $this->convertUTF8($WorkingArea->USER_WORKING_AREAS_DESCRIPTION),
                'USER_WORKING_AREAS_SELECTED' =>  $WorkingArea->USER_WORKING_AREAS_SELECTED === "1" ? true: false,
                // 'USER_WORKING_AREAS_SELECTED' =>($job->USER_WORKING_AREAS_SELECTED),
            ]);

            $WorkingAreasArray->push($all);
            
        }
        
         return json_encode($WorkingAreasArray);
    }
    
    public function getWorkingAreasPublic(Request $request)
    {
        $WorkingAreas = $this->userRepository->getWorkingAreas(
        null, 
        '',
        '', 
    );

        $WorkingAreasArray = collect([]);

        foreach ($WorkingAreas as $WorkingArea){

            $all = collect([
                'USER_WORKING_AREAS_ID' => $WorkingArea->USER_WORKING_AREAS_ID,
                'USER_WORKING_AREAS_DESCRIPTION' => $this->convertUTF8($WorkingArea->USER_WORKING_AREAS_DESCRIPTION),
                'USER_WORKING_AREAS_SELECTED' =>  $WorkingArea->USER_WORKING_AREAS_SELECTED === "1" ? true: false,
                // 'USER_WORKING_AREAS_SELECTED' =>($job->USER_WORKING_AREAS_SELECTED),
            ]);

            $WorkingAreasArray->push($all);
            
        }
         return json_encode($WorkingAreasArray);
    }


    public function patchWorkingAreas(Request $request)
    {

        $resultsCollection = collect([]);

        if (Auth::user() && !empty($request->input())){
        
        $workingAreas = $request->input();
        $workingAreasCollection = collect($workingAreas);

        // return json_encode($workingAreasCollection->keys()->last());
        foreach ($workingAreas as $key => $workingArea) {

            $updateWorkingAreas = $this->userRepository->updateWorkingAreas(
            Auth::user()->NIF_UTILIZADOR, 
            Auth::user()->PASS_UTILIZADOR, 
            Auth::user()->EMAIL_UTILIZADOR,
            $key,
            $workingArea === true ? 1: 0);
            // $request->USER_WORKING_AREAS_ID, $request->USER_WORKING_AREAS_SELECTED);
            $resultsCollection->push($updateWorkingAreas , $key);

                     //TODO check if this is needed
         $lastValue = last($workingAreas);
        //  return json_encode($key);
        //  $id = $workingAreasCollection->keys()->last();

          if($key == $workingAreasCollection->keys()->last()){
            // return json_encode($key);
             $updateWorkingAreas = $this->userRepository->updateWorkingAreas(
                 Auth::user()->NIF_UTILIZADOR, 
                 Auth::user()->PASS_UTILIZADOR, 
                 Auth::user()->EMAIL_UTILIZADOR, 
                 $key, 
                 $lastValue === true ? 1 : 0);
                
                }

                 $resultsCollection->push($updateWorkingAreas , $key);


        }




        }
         return json_encode($resultsCollection);
    }
    
   
    // ESCALAS DE TRABALHO
    public function getWorkShifts(Request $request)
    {
        if (Auth::user()){

            $workshifts = $this->userRepository->getWorkShifts(
            Auth::user()->NIF_UTILIZADOR, 
            Auth::user()->PASS_UTILIZADOR, 
            Auth::user()->EMAIL_UTILIZADOR, 
            $request->CODIG_CATEGORIA, $request->CODIGO_CENTRO_CUSTO, $request->ANO, $request->MES);
        }

        $workingShiftsArray = collect([]);

        foreach($workshifts as $workshift){

            $all = collect([
                'USER_WORK_SHIFT_ID' => $workshift->USER_WORK_SHIFT_ID,
                'USER_WORK_SHIFT_NUMBER' => $workshift->USER_WORK_SHIFT_NUMBER,
                'USER_WORK_SHIFT_LINE_NUMBER' => $workshift->USER_WORK_SHIFT_LINE_NUMBER,
                'USER_WORK_SHIFT_START_DATE' => $workshift->USER_WORK_SHIFT_START_DATE,
                'USER_WORK_SHIFT_START_TIME' => $workshift->USER_WORK_SHIFT_START_TIME,
                'USER_WORK_SHIFT_END_DATE' => $workshift->USER_WORK_SHIFT_END_DATE,
                'USER_WORK_SHIFT_END_TIME' => $workshift->USER_WORK_SHIFT_END_TIME,
                'USER_WORK_SHIFT_LOCAL_ID' => $workshift->USER_WORK_SHIFT_LOCAL_ID,
                'USER_WORK_SHIFT_LOCAL' => $this->convertUTF8($workshift->USER_WORK_SHIFT_LOCAL),
                'USER_WORK_SHIFT_CATEGORY' => $workshift->USER_WORK_SHIFT_CATEGORY,
                'USER_WORK_SHIFT_STATE' => $workshift->USER_WORK_SHIFT_STATE,
                'USER_WORK_SHIFT_JUSTIFICATION' => $workshift->USER_WORK_SHIFT_JUSTIFICATION,
            ]);

            $workingShiftsArray->push($all);
        }
        
         return json_encode($workingShiftsArray);
    }

    // ESCALAS DE TRABALHO
    public function updateWorkShifts(Request $request)
    {
        if (Auth::user()){

            $user = $this->userRepository->updateWorkShifts(
            Auth::user()->NIF_UTILIZADOR, 
            Auth::user()->PASS_UTILIZADOR, 
            Auth::user()->EMAIL_UTILIZADOR,  
            $request->USER_WORK_SHIFT_NUMBER, $request->USER_WORK_SHIFT_LINE_NUMBER, 
            $request->USER_WORK_SHIFT_LOCAL_ID, $request->USER_WORK_SHIFT_START_DATE, 
            $request->USER_WORK_SHIFT_STATE, $request->USER_WORK_SHIFT_JUSTIFICATION);
        }
         return json_encode($user);
    }

    public function workshiftlocals (Request $request)
    {

        $wslocals = $this->userRepository->getWorkShiftLocals(
            Auth::user()->NIF_UTILIZADOR, 
            Auth::user()->PASS_UTILIZADOR, 
            Auth::user()->EMAIL_UTILIZADOR,
        );
        
        $wslocalsArray = collect([]);

        foreach ($wslocals as $wslocal){

            $all = collect( [
                'USER_WORK_SHIFT_LOCAL_ID' => ($wslocal->USER_WORK_SHIFT_LOCAL_ID),
                'USER_WORK_SHIFT_LOCAL' => $this->convertUTF8($wslocal->USER_WORK_SHIFT_LOCAL),
                // 'CODIGO_CONHECIMENTO' => $this->convertUTF8($ability->CODIGO_CONHECIMENTO),
                // 'CODIGO_AUTO' => $this->convertUTF8($ability->CODIGO_AUTO),
                // 'NIVEL' => $this->convertUTF8($ability->NIVEL),
                
            ]);

            $wslocalsArray->push($all);
            
        }

        return ($wslocalsArray);
        
    }

    public function workshiftmonths (Request $request)
    {

        $wsmonths = $this->userRepository->getWorkShiftMonths(
            Auth::user()->NIF_UTILIZADOR, 
            Auth::user()->PASS_UTILIZADOR, 
            Auth::user()->EMAIL_UTILIZADOR,
        );

        $wsmonthsArray = collect([]);

        foreach ($wsmonths as $wsmonth){

            $all = collect( [
                'USER_WORK_SHIFT_MONTH_ID' => ($wsmonth->USER_WORK_SHIFT_MONTH_ID),
                'USER_WORK_SHIFT_MONTH' => $this->convertUTF8($wsmonth->USER_WORK_SHIFT_MONTH),
            ]);

            $wsmonthsArray->push($all);
            
        }
        return ($wsmonthsArray);
        
    }

    public function workshiftyears (Request $request)
    {

        $wsyears = $this->userRepository->getWorkShiftYears(
            Auth::user()->NIF_UTILIZADOR, 
            Auth::user()->PASS_UTILIZADOR, 
            Auth::user()->EMAIL_UTILIZADOR,
        );
        
        return ($wsyears);
        
    }

    // Job Categories

    public function getJobCategories(Request $request)
    {
        
        if (Auth::user()){

            $jobs = $this->userRepository->listJobCategories(
                Auth::user()->NIF_UTILIZADOR, 
                Auth::user()->PASS_UTILIZADOR, 
                Auth::user()->EMAIL_UTILIZADOR
            );
        }
        // dd($jobs);
        $jobsArray = collect([]);

        foreach ($jobs as $job){

            if($job->USER_JOB_CATEGORY_PARENT_ID == null){

                $arrayParent = collect([
                    'id' => $job->USER_JOB_CATEGORY_ID,
                    'label'=> $this->convertUTF8($job->USER_JOB_CATEGORY_DESCRIPTION),
                    'value' => $job->USER_JOB_CATEGORY_ID,
                    'USER_JOB_CATEGORY_PARENT_ID' => $job->USER_JOB_CATEGORY_PARENT_ID,
                    'USER_JOB_CATEGORY_SELECTED' => $job->USER_JOB_CATEGORY_SELECTED,
                    'children' => []
                ]);

                $arrayChild = collect([]);

                foreach($jobs as $children){
                    
                    if ($children->USER_JOB_CATEGORY_PARENT_ID == $job->USER_JOB_CATEGORY_ID){

                        $all = collect([
                            'id' => $children->USER_JOB_CATEGORY_ID,
                            'label' => $this->convertUTF8($children->USER_JOB_CATEGORY_DESCRIPTION),
                            'value' =>$children->USER_JOB_CATEGORY_ID,
                            'USER_JOB_CATEGORY_PARENT_ID' => $children->USER_JOB_CATEGORY_PARENT_ID,
                            'USER_JOB_CATEGORY_SELECTED' => $children->USER_JOB_CATEGORY_SELECTED,
                            
                        ]);

                        $arrayChild->push($all);
                    }
                        $arrayParent->put('children',$arrayChild);
                }
                    $jobsArray->push($arrayParent);
            }
            
        }

            return json_encode($jobsArray);
    }
 
    public function patchJobCategories(Request $request) {

        $jobCategories = $request->input('data');

        $selectedArray = collect($jobCategories['values1']);
        $notSelectedArray = $jobCategories['values0'];

        $resultsCollection = collect([]);
        // return json_encode($jobSelected['values0']);
        $jobs = $this->userRepository->listJobCategories(
            Auth::user()->NIF_UTILIZADOR, 
            Auth::user()->PASS_UTILIZADOR, 
            Auth::user()->EMAIL_UTILIZADOR
        );

        $jobsCollection = collect($jobs);
        
        // check e gravar so os 1 e ver se os 0 mudaram
        foreach($jobsCollection as $job){

                // return json_encode($selectedArray->has($job->USER_JOB_CATEGORY_ID));
            //    $obj = ($selectedArray->has($job->USER_JOB_CATEGORY_ID)->first());

            // $filtred = $selectedArray->contains($job->USER_JOB_CATEGORY_ID);

            if($selectedArray->contains($job->USER_JOB_CATEGORY_ID)){
                // return json_encode($job->USER_JOB_CATEGORY_ID);
                //ta selecionado
                // return json_encode($job->USER_JOB_CATEGORY_SELECTED != 1);

                if ($job->USER_JOB_CATEGORY_SELECTED != 1) {

                    $updateWorkingHours = $this->userRepository->updateJobCategories(
                        Auth::user()->NIF_UTILIZADOR, 
                        Auth::user()->PASS_UTILIZADOR, 
                        Auth::user()->EMAIL_UTILIZADOR,
                        $job->USER_JOB_CATEGORY_ID,
                        1,
                        false
                        );
    
                        // return json_encode($job->USER_JOB_CATEGORY_ID);
                        $resultsCollection->push(['id' => $job->USER_JOB_CATEGORY_ID , 'value'=> 1, 'result' => $updateWorkingHours]);

                }
                

            }else {
                // return json_encode($job->USER_JOB_CATEGORY_SELECTED != 0);

                if ($job->USER_JOB_CATEGORY_SELECTED != 0) {

                    $updateWorkingHours = $this->userRepository->updateJobCategories(
                        Auth::user()->NIF_UTILIZADOR, 
                        Auth::user()->PASS_UTILIZADOR, 
                        Auth::user()->EMAIL_UTILIZADOR,
                        $job->USER_JOB_CATEGORY_ID,
                        0,
                        false
                        );

                        $resultsCollection->push(['id' => $job->USER_JOB_CATEGORY_ID , 'value'=> 0, 'result' => $updateWorkingHours]);
                }

            }
        }

        // foreach ($selectedArray as $selected){
            
        //         $obj = $jobsCollection->where('USER_JOB_CATEGORY_ID', $selected)->first()->USER_JOB_CATEGORY_SELECTED;
                
        //         if($obj != 1){

        //             if (Auth::user()){
        
        //             $updateWorkingHours = $this->userRepository->updateJobCategories(
        //                 Auth::user()->NIF_UTILIZADOR, 
        //                 Auth::user()->PASS_UTILIZADOR, 
        //                 Auth::user()->EMAIL_UTILIZADOR,
        //                 $selected,
        //                 1,
        //                 );

        //                 $resultsCollection->push($selected , 1);
            
        //             }
        //     }

        // }

        // foreach ($notSelectedArray as $notSelected){
            
        //     // if(!is_null($workingHour)){

        //         // return json_encode($selected);

        //         if (Auth::user()){
    
        //          $updateWorkingHours = $this->userRepository->updateJobCategories(
        //             Auth::user()->NIF_UTILIZADOR, 
        //             Auth::user()->PASS_UTILIZADOR, 
        //             Auth::user()->EMAIL_UTILIZADOR,
        //             $notSelected,
        //             0,
        //             );

        //             $resultsCollection->push($notSelected , 0);
        
        //          }
        //     // }

        // }

         return json_encode($resultsCollection);

    }

    public function getJobCategoriesPublic(Request $request)
    {
        
            $jobs = $this->userRepository->listJobCategories(
                'null', 
                '',
                '', 
            );
        
            $jobsArray = collect([]);

            // return ($jobs);
            // foreach ($jobs as $job){
    
            //     // if($job->USER_JOB_CATEGORY_PARENT_ID == null){
    
            //         $arrayParent = collect([
            //             'id' => $job->USER_JOB_CATEGORY_ID,
            //             'label'=> $this->convertUTF8($job->USER_JOB_CATEGORY_DESCRIPTION),
            //             'value' => $job->USER_JOB_CATEGORY_ID,
            //             'USER_JOB_CATEGORY_PARENT_ID' => $job->USER_JOB_CATEGORY_PARENT_ID,
            //             'children' => []
            //         ]);
    
            //         $jobsArray->push($arrayParent);

            //     // }
            // }

            // return json_encode($jobsArray);

            //mdddddddddddddddddd
            foreach ($jobs as $job){
    
                if($job->USER_JOB_CATEGORY_PARENT_ID == null){
    
                    $arrayParent = collect([
                        'id' => $job->USER_JOB_CATEGORY_ID,
                        'label'=> $this->convertUTF8($job->USER_JOB_CATEGORY_DESCRIPTION),
                        'value' => $job->USER_JOB_CATEGORY_ID,
                        'USER_JOB_CATEGORY_PARENT_ID' => $job->USER_JOB_CATEGORY_PARENT_ID,
                        'children' => []
                    ]);
    
                    $arrayChild = collect([]);
    
                    foreach($jobs as $children){
                        
                        if ($children->USER_JOB_CATEGORY_PARENT_ID == $job->USER_JOB_CATEGORY_ID){
    
                            $all = collect([
                                'id' => $children->USER_JOB_CATEGORY_ID,
                                'label' => $this->convertUTF8($children->USER_JOB_CATEGORY_DESCRIPTION),
                                'value' =>$children->USER_JOB_CATEGORY_ID,
                                'USER_JOB_CATEGORY_PARENT_ID' => ($children->USER_JOB_CATEGORY_PARENT_ID)
                            ]);
    
                            $arrayChild->push($all);
                        }
                            $arrayParent->put('children',$arrayChild);
                    }
                        $jobsArray->push($arrayParent);
                }
                
            }

            return json_encode($jobsArray);
    }
    
   
    public function countries (Request $request)
    {


        $countries = $this->userRepository->countriesList();

        $countriesArray = collect([]);
                 

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


    public function addUserAbilities (Request $request){


        $validator = Validator::make($request->all(), [
            'abilities_array.*.CODIGO_CONHECIMENTO' => 'required',
        ]);

        if($validator->fails()){
            
            return response()->json($validator->errors(), 400);
            
            return $validator->errors()->toJson();
        }


        $abilities = $request->abilities_array ?? [];
        $abilitiesCollection = collect($abilities);


        //DELETE ALL
        $this->userRepository->deleteUserAbilities(
                        Auth::user()->NIF_UTILIZADOR, 
                        Auth::user()->PASS_UTILIZADOR, 
                        Auth::user()->EMAIL_UTILIZADOR
        );


        $resultsArray = collect([]);

        if (Auth::user()){
            
            foreach ($abilities as $ability){

                // return json_encode($ability);

                    // return json_encode( $ability['CODIGO_CONHECIMENTO']);
                    $userAbilities = $this->userRepository->addUserAbilities(
                        // $request->USER_NIF, $request->USER_PASS, $request->USER_EMAIL,
                        Auth::user()->NIF_UTILIZADOR, 
                        Auth::user()->PASS_UTILIZADOR, 
                        Auth::user()->EMAIL_UTILIZADOR,
                        $ability['CODIGO_CONHECIMENTO']
                        // $request->ABILITY_ID
                    );

                    $resultsArray->push($userAbilities, $ability['CODIGO_CONHECIMENTO']);

                }

                $userAbilities = $this->userRepository->addUserAbilities(
                    // $request->USER_NIF, $request->USER_PASS, $request->USER_EMAIL,
                    Auth::user()->NIF_UTILIZADOR, 
                    Auth::user()->PASS_UTILIZADOR, 
                    Auth::user()->EMAIL_UTILIZADOR,
                    $abilitiesCollection->last()['CODIGO_CONHECIMENTO']
                    // $request->ABILITY_ID
                );


        }


        return json_encode($resultsArray);
    }

    public function userAbilities (Request $request)
    {

        if (Auth::user()){

            $abilities = $this->userRepository->listUserAbilities(
                // $request->USER_NIF, $request->USER_PASS, $request->USER_EMAIL,
                Auth::user()->NIF_UTILIZADOR, 
                Auth::user()->PASS_UTILIZADOR, 
                Auth::user()->EMAIL_UTILIZADOR
            );
        
        }

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

        if (Auth::user()){

            $deleteAbilities = $this->userRepository->deleteUserAbilities(
                // $request->USER_NIF, $request->USER_PASS, $request->USER_EMAIL,
                Auth::user()->NIF_UTILIZADOR, 
                Auth::user()->PASS_UTILIZADOR, 
                Auth::user()->EMAIL_UTILIZADOR);
           
        }

        // $user = $this->userRepository->deleteUserAbilities($request->USER_NIF, $request->USER_PASS, $request->USER_EMAIL);
       
        return json_encode($deleteAbilities);
    }
    
    public function documentTypes (Request $request)
    {

        // if (Auth::user()){

            $documentTypes = $this->userRepository->documentTypesList();
        // }


        $documentTypesArray = collect([]);

        foreach ($documentTypes as $documentType){

            $all = collect([
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

        $validator = Validator::make($request->all(), [
            'DATE_FROM' => 'required',
            'DATE_TO' => 'required',
        ]);
        
        if($validator->fails()){
            
            return response()->json($validator->errors(), 400);
            
            return $validator->errors()->toJson();
        }

        if (Auth::user()){

            $timesheets = $this->userRepository->getTimeSheet(
                Auth::user()->NIF_UTILIZADOR, 
                Auth::user()->PASS_UTILIZADOR, 
                Auth::user()->EMAIL_UTILIZADOR, 
                $request->DATE_FROM, 
                $request->DATE_TO);
        }

        $timesheetArray = collect([]);

        foreach ($timesheets as $timesheet){

            $all = collect( [
                "TIMESHEET_ID" => $timesheet->TIMESHEET_ID,
                "TIMESHEET_DATE_TIME_IN" => $timesheet->TIMESHEET_DATE_TIME_IN,
                "TIMESHEET_CLIENT" => $this->convertUTF8($timesheet->TIMESHEET_CLIENT),
                "TIMPSHEET_CATEGORY" => $this->convertUTF8($timesheet->TIMPSHEET_CATEGORY),
                "TIMESHEET_DESCRIPTION" => $this->convertUTF8($timesheet->TIMESHEET_DESCRIPTION),
                "TIMESHEET_TOTAL_HOURS" => round($timesheet->TIMESHEET_TOTAL_HOURS,2),
                // "TIMESHEET_DATE_TIME_OUT" => $timesheet->TIMESHEET_DATE_TIME_OUT,
                // "TIMESHEET_DAYS" => round($timesheet->TIMESHEET_DAYS,2),
                // "TIMESHEET_UNIT_VALUE" => round($timesheet->TIMESHEET_UNIT_VALUE,2),
                // "TIMESHEET_UNIT_TYPE" => round($timesheet->TIMESHEET_UNIT_TYPE,2),
                // "TIMESHEET_TOTAL_VALUE" => round($timesheet->TIMESHEET_TOTAL_VALUE,2)
                
            ]);

            $timesheetArray->push($all);
            
        }

        return json_encode($timesheetArray);

    }

    public function getPayroll (Request $request){

        if(Auth::user()){

            $payrolls = $this->userRepository->getPayroll(
            Auth::user()->NIF_UTILIZADOR, 
            Auth::user()->PASS_UTILIZADOR, 
            Auth::user()->EMAIL_UTILIZADOR,
            $request->DATE_FROM, 
            $request->DATE_TO);
        }

        $paycollection = collect($payrolls);

        $payrollcollection = collect();

        foreach ($payrolls as $payroll) {

            $paycoll = collect($payroll);
            
            $paycoll->transform(function($item, $key) {
    
                if ($key == 'PAYROLL_BASE_SALARY'){
                    // dd($key);
                    return round($item, 2);
                }
                if ($key == 'PAYROLL_OTHER_SALARY'){
                    // dd($key);
                    return round($item, 2);
                }
                if ($key == 'PAYROLL_TAXES'){
                    // dd($key);
                    return round($item, 2);
                }
                if ($key == 'PAYROLL_OTHER_DEDUCTIONS'){
                    // dd($key);
                    return round($item, 2);
                }
                if ($key == 'PAYROLL_LIQUID_AMOUNT'){
                    // dd($key);
                    return round($item, 2);
                }
                else {
                    return $item;
                }
            });

            $payrollcollection->push($paycoll);
        }

       
        return json_encode($payrollcollection);
    }

    
    public function getPayrollPDF (Request $request){
        
        $payrollPDF = $this->userRepository->getPayrollPDF($request->USER_NIF, $request->USER_PASS, $request->USER_EMAIL, $request->PAYROLL_YEAR, $request->PAYROLL_NUMBER);

        return json_encode($payrollPDF);
    }

    public function offerApply (Request $request){
    
        //TODO verify Recrutiment Reference ID
        $offers = $this->userRepository->offerApply(
            Auth::user()->NIF_UTILIZADOR, 
            Auth::user()->PASS_UTILIZADOR, 
            Auth::user()->EMAIL_UTILIZADOR,
            $request->RECRUITMENT_REFERENCE);
            
        return json_encode($offers);

    }


    public function getOffersList (Request $request){
        

        $offers = $this->userRepository->offersList(
            Auth::user()->NIF_UTILIZADOR, 
            Auth::user()->PASS_UTILIZADOR, 
            Auth::user()->EMAIL_UTILIZADOR,
            Carbon::now()->format('m-d-Y'));
        
            $offersArray = collect([]);

            foreach ($offers as $offer){
    
                $allOffers = collect( [
                    'OFFER_ID' => $offer->OFFER_ID,
                    'RECRUITMENT_REFERENCE' => $offer->RECRUITMENT_REFERENCE,
                    'RECRUITMENT_YEAR' => $offer->RECRUITMENT_YEAR,
                    'RECRUITMENT_NUMBER' => $offer->RECRUITMENT_NUMBER,
                    'RECRUITMENT_GROUP' => $offer->RECRUITMENT_GROUP,
                    'OFFER_JOB_GROUP' => $this->convertUTF8($offer->OFFER_JOB_GROUP),
                    'OFFER_JOB' => $this->convertUTF8($offer->OFFER_JOB),
                    'OFFER_AD_TITLE' => $this->convertUTF8($offer->OFFER_AD_TITLE),
                    'OFFER_AD_TEXT_TASKS' => $this->convertUTF8($offer->OFFER_AD_TEXT_TASKS), // charset convert
                    'OFFER_AD_TEXT_PROFILE' => $this->convertUTF8($offer->OFFER_AD_TEXT_PROFILE), // charset convert
                    'OFFER_AD_TEXT_INFO' => $this->convertUTF8($offer->OFFER_AD_TEXT_INFO), // charset convert
                    'OFFER_AD_TEXT_BENEFITS' => $this->convertUTF8($offer->OFFER_AD_TEXT_BENEFITS), // charset convert
                    'OFFER_AD_DISTRITO' => $this->convertUTF8($offer->OFFER_AD_DISTRITO), // charset convert
                    'OFFER_AD_CONCELHO' => $this->convertUTF8($offer->OFFER_AD_CONCELHO), // charset convert
                    'OFFER_AD_FREGUESIA' => $this->convertUTF8($offer->OFFER_AD_FREGUESIA), // charset convert
                ]);
    
                $offersArray->push($allOffers);
                
            }

            // dd($offers);

        return json_encode($offersArray);
    }

    public function getMedicine (Request $request){

        if(Auth::user()){

            $medicines = $this->userRepository->getMedicine(
                Auth::user()->NIF_UTILIZADOR, 
                Auth::user()->PASS_UTILIZADOR, 
                Auth::user()->EMAIL_UTILIZADOR);
        }

        $medicineArray = collect([]);

        foreach ($medicines as $medicine){

            $all = collect( [
                'MEDICINE_ID' => ($medicine->MEDICINE_ID),
                'MEDICINE_DATE' => ($medicine->MEDICINE_DATE),
                'MEDICINE_TYPE' => $this->convertUTF8($medicine->MEDICINE_TYPE),
                'MEDICINE_RESULT' => $this->convertUTF8($medicine->MEDICINE_RESULT),
                
            ]);

            $medicineArray->push($all);
            
        }

        return json_encode($medicineArray);
    }

    public function getContracts (Request $request){
        
        if(Auth::user()){

            $contracts = $this->userRepository->getContracts(
                Auth::user()->NIF_UTILIZADOR, 
                Auth::user()->PASS_UTILIZADOR, 
                Auth::user()->EMAIL_UTILIZADOR
            );
        }

        return json_encode($contracts);
    }

    public function getRecruitments (Request $request){
        
        if(Auth::user()){

            $recruitments = $this->userRepository->getRecruitments(
                Auth::user()->NIF_UTILIZADOR, 
                Auth::user()->PASS_UTILIZADOR, 
                Auth::user()->EMAIL_UTILIZADOR, 
            $request->DATE_FROM, $request->DATE_TO);
        }

        // dd($recruitments);
        $incomeArray = collect([]);

        foreach ($recruitments as $recruitment){

            $all = collect( [
                'USER_RECRUTMENT_ID' => ($recruitment->USER_RECRUTMENT_ID),
                'USER_RECRUTMENT_DATE' => ($recruitment->USER_RECRUTMENT_DATE),
                'USER_RECRUTMENT_REF' => ($recruitment->USER_RECRUTMENT_REF),
                'USER_RECRUTMENT_CATEGORY' => $this->convertUTF8($recruitment->USER_RECRUTMENT_CATEGORY),
                'USER_RECRUTMENT_LOCAL' => $this->convertUTF8($recruitment->USER_RECRUTMENT_LOCAL),
                
            ]);

            $incomeArray->push($all);
            
        }

        return json_encode($incomeArray);
    }

    public function getMessages(Request $request) {

        $messages = $this->userRepository->messageGet(
            Auth::user()->NIF_UTILIZADOR, 
            Auth::user()->PASS_UTILIZADOR, 
            Auth::user()->EMAIL_UTILIZADOR);

        return json_encode($messages);


    }

    public function postMessages(Request $request) {

        $messages = $this->userRepository->messageNew(
            Auth::user()->NIF_UTILIZADOR, 
            Auth::user()->PASS_UTILIZADOR, 
            Auth::user()->EMAIL_UTILIZADOR,
            $request->MESSAGE_SUBJECT,
            $request->MESSAGE_TEXT,
        );

        return json_encode($messages);


    }

    public function getIRS (Request $request){
        
        if(Auth::user()){

            $irsIncomes = $this->userRepository->getIRS(
                Auth::user()->NIF_UTILIZADOR, 
                Auth::user()->PASS_UTILIZADOR, 
                Auth::user()->EMAIL_UTILIZADOR);
        }

        // $collection = collect($irsIncome);
        $incomeArray = collect([]);

        foreach ($irsIncomes as $income){

            $all = collect( [
                'RESULT' => ($income->RESULT),
                'USER_ATTACHMENT_ID' => ($income->USER_ATTACHMENT_ID),
                'USER_ATTACHMENT_NAME' => $this->convertUTF8($income->USER_ATTACHMENT_NAME),
                'USER_ATTACHMENT_LINK' => $this->convertUTF8($income->USER_ATTACHMENT_LINK),
                // RESULT, USER_ATTACHMENT_ID
                
            ]);

            $incomeArray->push($all);
            
        }

        return json_encode($incomeArray);
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
    
     public function attachmentNew (Request $request){

        $FILE = file_get_contents($request->USER_ATTACHMENT);

        // return json_encode($request->hasFile('USER_ATTACHMENT2'));

        //TODO check if file and extension is good
        $USER_ATTACHMENT_NAME = $request->USER_ATTACHMENT->getClientOriginalName();
        // .".". $request->USER_ATTACHMENT->getClientOriginalExtension();

        // return json_encode($request->USER_ATTACHMENT_CLASS_ID_);
        // return json_encode($request->input());

        $attachmentNew = $this->userRepository->attachmentNew(
            Auth::user()->NIF_UTILIZADOR, 
            Auth::user()->PASS_UTILIZADOR, 
            Auth::user()->EMAIL_UTILIZADOR,
            $USER_ATTACHMENT_NAME, 
            $request->USER_ATTACHMENT_CLASS_ID, 
            $FILE);

            
        return json_encode($this->convertUTF8($attachmentNew));

    }

    public function attachmentDestroy(Request $request) {

        $attachmentDestroy = $this->userRepository->attachmentDestroy(
            Auth::user()->NIF_UTILIZADOR, 
            Auth::user()->PASS_UTILIZADOR, 
            Auth::user()->EMAIL_UTILIZADOR,
            $request->USER_ATTACHMENT_NAME );

        return json_encode($attachmentDestroy);


    }

    public function attachmentNewPublic (Request $request){

        $FILE = file_get_contents($request->USER_ATTACHMENT);

        // return json_encode($request->hasFile('USER_ATTACHMENT2'));

        //TODO check if file and extension is good
        $USER_ATTACHMENT_NAME = $request->USER_ATTACHMENT->getClientOriginalName();
        // .".". $request->USER_ATTACHMENT->getClientOriginalExtension();

        // return json_encode($request->USER_ATTACHMENT_CLASS_ID_);
        // return json_encode($request->input());

        $attachmentNew = $this->userRepository->attachmentNew(
            $request->NIF_UTILIZADOR, 
            $request->PASS_UTILIZADOR, 
            $request->EMAIL_UTILIZADOR,
            $USER_ATTACHMENT_NAME, 
            $request->USER_ATTACHMENT_CLASS_ID, 
            $FILE);

            // dd($attachmentNew);
        return json_encode($attachmentNew);

    }
        
    // ESCALAS DE TRABALHO
    public function attachmentList(Request $request)
    {
        if (Auth::user()){

            $attachments = $this->userRepository->attachmentsList(
            Auth::user()->NIF_UTILIZADOR, 
            Auth::user()->PASS_UTILIZADOR, 
            Auth::user()->EMAIL_UTILIZADOR, 
            );
        }

        $attachmentsArray = collect([]);

        foreach ($attachments as $attachment){

            if (!is_null($attachment->USER_ATTACHMENT_CLASS_ID)){

                $all = collect([
                    'USER_ATTACHMENT_ID' => $attachment->USER_ATTACHMENT_ID,
                    'RESULT' => $attachment->RESULT,
                    'USER_ATTACHMENT_NAME' => $attachment->USER_ATTACHMENT_NAME,
                    'USER_ATTACHMENT_CLASS_ID' => $attachment->USER_ATTACHMENT_CLASS_ID,
                    'USER_ATTACHMENT_LINK' => $attachment->USER_ATTACHMENT_LINK,
                    'USER_ATTACHMENT_CAN_DELETE' => $attachment->USER_ATTACHMENT_CAN_DELETE,
                    'USER_ATTACHMENT_DATE_TIME' => $attachment->USER_ATTACHMENT_DATE_TIME,
                ]);
    
                $attachmentsArray->push($all);
            }
            
        }
            return json_encode($attachmentsArray);
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
