<?php
namespace App\Services;
use Carbon\Carbon;
use App\Models\Campaign;

class LeftSideBarService
{
  
   
    public static function getSideBarData()
    {
        $clientId = auth()->user()->id;
        return Campaign::whereClientId($clientId)->get();
        
    }
   

}