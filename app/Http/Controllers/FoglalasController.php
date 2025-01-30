<?php

namespace App\Http\Controllers;

use App\Models\Foglalasok;
use Illuminate\Http\Request;

class FoglalasController extends Controller
{
    function getFoglalas($datum){
        $foglalasok = Foglalasok::where('nap', $datum)->get();
        return response()->json($foglalasok, 200);
    }
}
