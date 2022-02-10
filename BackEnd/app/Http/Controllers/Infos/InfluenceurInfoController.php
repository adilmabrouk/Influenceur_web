<?php

namespace App\Http\Controllers\Infos;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use App\Models\Langue;
use App\Models\Situation_familiale;
use Illuminate\Http\Request;

class InfluenceurInfoController extends Controller
{
    public  function  getGenres()
    {
        $genres = Genre::all();
        return response()->json($genres,200);
    }

    public  function  getLangues()
    {
        $langues = Langue::all();
        return response()->json($langues,200);
    }

    public  function situationFamiliale()
    {
        $situation_familiale = Situation_familiale::all();
        return response()->json($situation_familiale,200);
    }
}
