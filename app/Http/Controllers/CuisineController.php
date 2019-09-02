<?php

namespace App\Http\Controllers;

use App\cuisine;
use App\post;
use Illuminate\Http\Request;

class CuisineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cuisines = Cuisine::all();
        return view('cuisine.index',compact('cuisines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'cuisine_name'=>'required|max:100'
        ]);
        $cuisine = new Cuisine();
        $cuisine->name = $request->get('cuisine_name');
        $cuisine->save();

        return redirect()->route('cuisines.index')->with('success','Cuisine Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\cuisine  $cuisine
     * @return \Illuminate\Http\Response
     */
    public function show(cuisine $cuisine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\cuisine  $cuisine
     * @return \Illuminate\Http\Response
     */
    public function edit(cuisine $cuisine)
    {
        return view('cuisine.edit',compact('cuisine'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\cuisine  $cuisine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cuisine $cuisine)
    {
        $request->validate([
            'cuisine_name'=>'required|max:100'
        ]);

        $cuisine->name = $request->cuisine_name;
        $cuisine->save();

        return redirect()->route('cuisines.index')->with('success','Cuisine has been updated.');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\cuisine  $cuisine
     * @return \Illuminate\Http\Response
     */
    public function destroy(cuisine $cuisine)
    {
        //
    }

    public static function review_count(cuisine $cuisine) {
        $cuisine_ids = [$cuisine->id];

        $posts = post::where('is_draft',false)
        ->where('is_declined',false)
        ->whereHas('isLive')
        ->whereHas('cuisines',function ($query) use ($cuisine_ids) {
            return $query->whereIn('cuisine_id',$cuisine_ids);
        })
        ->get();

        if(empty($posts)) {
            return 0;
        }
        return count($posts);
    }
}
