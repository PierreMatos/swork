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

        return($offers[0]->OFFER_AD_TITLE);
        
        return json_encode($offers);

    }

}
