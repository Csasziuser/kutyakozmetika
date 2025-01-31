<?php

namespace App\Http\Controllers;

use App\Models\Foglalasok;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class FoglalasController extends Controller
{
    function getFoglalas($datum){
        $foglalasok = Foglalasok::where('nap', $datum)->get();
        return response()->json($foglalasok, 200);
    }

    function store(Request $request){
        $request->validate([
            "date"=>"required|date",
            "name"=>"required|string",
            "time"=>"required|string"
        ]);

        $foglalas = Foglalasok::create([
            "nap"=>$request->date,
            "foglalo_neve"=>$request->name,
            "ora"=>$request->time
        ]);

        return response()->json("K", 200);
    }

    function destroy($id){
        $foglalas=Foglalasok::find($id);
        $foglalas->delete();
    }
}
