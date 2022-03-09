<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\Offer;

class OfferRepository
{

    // Este é o procedimento para lista as ofertas:
    public function offersList($date) 
    {
        $offers="";


        $offers = DB::select("SELECT * FROM API_OFFERS_LIST(NULL)");

        DB::commit();

        return( $offers);
        // dd($offers);

    }

    // Este é o procedimento para lista as ofertas:
    public function offerShow($id) 
    {
        $offer="";

        $offers = DB::select("SELECT * FROM API_OFFERS_LIST(NULL) WHERE OFFER_ID='$id' ");

        DB::commit();

        return( $offers[0]);
        // dd($offers);

    }
    
    // lista as primeiras 10 ofertas em aberto
    public function tenOffersList($date, $page) 
    {

        $offers = DB::select("SELECT FIRST 10 SKIP $page * FROM API_OFFERS_LIST($date)");
        
        return $offers;

    }


    // lista todas as ofertas em aberto para o grupo "Sul"

    public function OffersListByGroup($date, $group) 
    {

        $offers = DB::select("SELECT * FROM API_OFFERS_LIST($date) WHERE RECRUITMENT_GROUP = '$group'");
        
        return $offers;

    }

    
    // lista todas as ofertas em aberto para a profissao "Cafeteiro"

    public function OffersListByJob($date, $job) 
    {

        $offers = DB::select("SELECT * FROM API_OFFERS_LIST(NULL) WHERE OFFER_JOB = '$job'");
        //ORDER BY RECRUITMENT_GROUP
        return $offers;

    }
    
        // lista todas as ofertas em aberto para categoria profissional "Construção" 

    public function OffersListByJobGroup($date, $job) 
    {

        $offers = DB::select("SELECT * FROM API_OFFERS_LIST(NULL) WHERE OFFER_JOB_GROUP = '$job'");
        //ORDER BY RECRUITMENT_GROUP
        return $offers;

    }
    
        // lista todas  categoria profissional "Construção"

    public function OffersListByJob($date, $job) 
    {

        $offers = DB::select("SELECT DISTINCT FROM CATEGORIAS_PROFISSIONAIS");
        //ORDER BY RECRUITMENT_GROUP
        return $offers;

    }



   
}