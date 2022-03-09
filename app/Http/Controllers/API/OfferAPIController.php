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

        $offers = $this->offerRepository->offersList($date);
                 
        // $allOffers = collect();

        $input = $request->collect();
       $offersArray = collect([]);


        foreach ($offers as $offer){

            $allOffers = collect( [
                'id' => $offer->OFFER_ID,
                'year' => $offer->RECRUITMENT_YEAR,
                'number' => $offer->RECRUITMENT_NUMBER,
                'group' => $offer->RECRUITMENT_GROUP,
                'job' => $this->convertUTF8($offer->OFFER_JOB),
                'title' => $this->convertUTF8($offer->OFFER_AD_TITLE),
                'text' => $this->convertUTF8($offer->OFFER_AD_TEXT), // charset convert
            ]);

            $offersArray->push($allOffers);
            
        }

        return ($offersArray);
        

    }
    
    
        public function show($id)
    {


        $offer = $this->offerRepository->offerShow($id);

        // $input = $request->collect();
       $offersArray = collect([]);


            $allOffer = collect( [
                'id' => $offer->OFFER_ID,
                'year' => $offer->RECRUITMENT_YEAR,
                'number' => $offer->RECRUITMENT_NUMBER,
                'group' => $offer->RECRUITMENT_GROUP,
                'job' => $this->convertUTF8($offer->OFFER_JOB),
                'title' => $this->convertUTF8($offer->OFFER_AD_TITLE),
                'text' => $this->convertUTF8($offer->OFFER_AD_TEXT), // charset convert
            ]);

            


        return ($allOffer);
        

    }
    
    public function convertUTF8($data) {
          if(!empty($data)) {    
            $encodeType = mb_detect_encoding($data , array('UTF-8','GBK','LATIN1','BIG5'));   
            if( $encodeType != 'UTF-8'){   
            
              $data = mb_convert_encoding($data ,'utf-8' , $encodeType); 
            //   $data = mb_convert_encoding($data, "ISO-8859-1", "UTF-8" );
            }   
          }   
          return $data;    
        }

}
