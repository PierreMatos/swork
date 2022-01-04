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

        foreach ($offers as $offer){

            $allOffers = collect( [
                'id' => $offer->OFFER_ID,
                'year' => $offer->RECRUITMENT_YEAR,
                'number' => $offer->RECRUITMENT_NUMBER,
                'group' => $offer->RECRUITMENT_GROUP,
                'job' => $offer->OFFER_JOB,
                'title' => $offer->OFFER_AD_TITLE,
                'text' => $this->convertUTF8($offer->OFFER_AD_TEXT), // charset convert
            ]);
            
        }

        return json_encode($allOffers);
    }
    
    public function convertUTF8($data) {

        if(!empty($data)) {    
        $encodeType = mb_detect_encoding($data , array('UTF-8','GBK','LATIN1','BIG5'));   
            if( $encodeType != 'UTF-8'){   
                $data = mb_convert_encoding($data ,'utf-8' , $encodeType);   
            }   
        }   
        return $data;    
    }

}
