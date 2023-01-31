<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Repositories\OfferRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class OfferAPIController extends BaseController
{
    private $offerRepository;

    public function __construct(OfferRepository $offerRepo)
    {
        $this->offerRepository = $offerRepo;
    }

    public function index(Request $request)
    {

        $date = $request->date ?? 'NULL';
        $offerJob = $request->OFFER_JOB ?? NULL;
        $recruitmentGroup = $request->RECRUITMENT_GROUP ?? NULL;
        $offerJobId = $request->OFFER_JOB_ID ?? NULL;

        $offers = $this->offerRepository->offersList($date, $offerJob, $recruitmentGroup, $offerJobId);
                 
        // $allOffers = collect();

        $input = $request->collect();
       $offersArray = collect([]);


        foreach ($offers as $offer){

            $allOffers = collect( [
                'OFFER_ID' => $offer->OFFER_ID,
                'RECRUITMENT_REFERENCE' => $offer->RECRUITMENT_REFERENCE,
                'RECRUITMENT_YEAR' => $offer->RECRUITMENT_YEAR,
                'RECRUITMENT_NUMBER' => $offer->RECRUITMENT_NUMBER,
                'RECRUITMENT_GROUP' => $offer->RECRUITMENT_GROUP,
                'OFFER_JOB_GROUP' => $this->convertUTF8($offer->OFFER_JOB_GROUP),
                'CREATED_DATE' => $offer->CREATED_DATE,
                'WORKING_HOURS' => $offer->WORKING_HOURS,
                'OFFER_JOB' => $this->convertUTF8($offer->OFFER_JOB),
                'OFFER_JOB_ID' => ($offer->OFFER_JOB_ID),
                'OFFER_AD_TITLE' => $this->convertUTF8($offer->OFFER_AD_TITLE),
                'OFFER_AD_TEXT' => $this->convertUTF8($offer->OFFER_AD_TEXT), // charset convert
                'OFFER_AD_TEXT_TASKS' => $this->convertUTF8($offer->OFFER_AD_TEXT_TASKS), // charset convert
                'OFFER_AD_TEXT_PROFILE' => $this->convertUTF8($offer->OFFER_AD_TEXT_PROFILE), // charset convert
                'OFFER_AD_TEXT_INFO' => $this->convertUTF8($offer->OFFER_AD_TEXT_INFO), // charset convert
                'OFFER_AD_TEXT_BENEFITS' => $this->convertUTF8($offer->OFFER_AD_TEXT_BENEFITS), // charset convert
                'OFFER_AD_DISTRITO' => $this->convertUTF8($offer->OFFER_AD_DISTRITO), // charset convert
                'OFFER_AD_CONCELHO' => $this->convertUTF8($offer->OFFER_AD_CONCELHO), // charset convert
                'OFFER_AD_FREGUESIA' => $this->convertUTF8($offer->OFFER_AD_FREGUESIA), // charset convert
                'OFFER_AD_LOCAL' => $this->convertUTF8($offer->OFFER_AD_LOCAL), // charset convert
            ]);

            $offersArray->push($allOffers);
            
        }

        return ($offersArray);
        

    }
    
    
        public function show($id)
    {


        $offer = $this->offerRepository->offerShow($id);

        dd($offer);
        // $input = $request->collect();
       $offersArray = collect([]);


            $allOffer = collect( [
                'OFFER_ID' => $offer->OFFER_ID,
                'RECRUITMENT_REFERENCE' => $offer->RECRUITMENT_REFERENCE,
                'RECRUITMENT_YEAR' => $offer->RECRUITMENT_YEAR,
                'RECRUITMENT_NUMBER' => $offer->RECRUITMENT_NUMBER,
                'RECRUITMENT_GROUP' => $offer->RECRUITMENT_GROUP,
                'OFFER_JOB_GROUP' => $this->convertUTF8($offer->OFFER_JOB_GROUP),
                'CREATED_DATE' => $offer->CREATED_DATE,
                'WORKING_HOURS' => $offer->WORKING_HOURS,
                'OFFER_AD_DISTRITO' => $offer->OFFER_AD_DISTRITO,
                'OFFER_AD_CONCELHO' => $offer->OFFER_AD_CONCELHO,
                'OFFER_AD_FREGUESIA' => $offer->OFFER_AD_FREGUESIA,
                'OFFER_AD_LOCAL' => $offer->OFFER_AD_LOCAL,
                'OFFER_JOB' => $this->convertUTF8($offer->OFFER_JOB),
                'OFFER_AD_TITLE' => $this->convertUTF8($offer->OFFER_AD_TITLE),
                'OFFER_AD_TEXT' => $this->convertUTF8($offer->OFFER_AD_TEXT), // charset convert
                'OFFER_AD_TEXT_TASKS' => $this->convertUTF8($offer->OFFER_AD_TEXT_TASKS), // charset convert
                'OFFER_AD_TEXT_PROFILE' => $this->convertUTF8($offer->OFFER_AD_TEXT_PROFILE), // charset convert
                'OFFER_AD_TEXT_INFO' => $this->convertUTF8($offer->OFFER_AD_TEXT_INFO), // charset convert
                'OFFER_AD_TEXT_BENEFITS' => $this->convertUTF8($offer->OFFER_AD_TEXT_BENEFITS), // charset convert
                'OFFER_AD_DISTRITO' => $this->convertUTF8($offer->OFFER_AD_DISTRITO), // charset convert
                'OFFER_AD_CONCELHO' => $this->convertUTF8($offer->OFFER_AD_CONCELHO), // charset convert
                'OFFER_AD_FREGUESIA' => $this->convertUTF8($offer->OFFER_AD_FREGUESIA), // charset convert
            ]);

        return ($allOffer);
        

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
