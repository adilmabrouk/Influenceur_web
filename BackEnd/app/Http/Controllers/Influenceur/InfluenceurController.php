<?php

namespace App\Http\Controllers\Influenceur;

use App\Http\Controllers\Controller;
use App\Models\Influenceur;
use Illuminate\Http\Request;

class InfluenceurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $influenceur = Influenceur::with('langues', 'adresse', 'instagram.posts')->get();

        return response()->json(['data' => $influenceur], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Influenceur  $influenceur
     * @return \Illuminate\Http\Response
     */
    public function show(Influenceur $influenceur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Influenceur  $influenceur
     * @return \Illuminate\Http\Response
     */
    public function edit(Influenceur $influenceur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Influenceur  $influenceur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Influenceur $influenceur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Influenceur  $influenceur
     * @return \Illuminate\Http\Response
     */
    public function destroy(Influenceur $influenceur)
    {
        //
    }
}
