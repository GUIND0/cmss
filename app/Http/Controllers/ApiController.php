<?php

namespace App\Http\Controllers;

use App\Models\CMSS;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    

    public function getPensionnes(Request $request){
        $pensionnes = CMSS::take(100);
        return $pensionnes->toJson();
    }
}
