<?php

namespace App\Http\Controllers;

use App\Models\CMSS;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    

    public function getPensionnes(Request $request){
        $pensionnes = CMSS::limit(100)->get();
        return $pensionnes->toJson();
    }
}
