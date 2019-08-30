<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Review;
use App\post;
use App\cuisine;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*
    public function __construct()
    {
        $this->middleware('auth');
    } */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //Get all cuisines and posts, apply pagination to display 5 results per page
        $cuisines = Cuisine::all();
        //$posts = post::paginate(5);

        $reviews = Review::with(['posts'=>function($query) {
            $query->where('is_approved',1);
        }])->get();

        $posts = Post::where('is_approved',true)
        ->whereHas('isLive')
        ->paginate(5);

        //$filter contains all the filter relevant variables, so the inputs will be adapted accordingly (e.g. switches turned on, checkboxes checked etc.)
        $display_filter = collect(); //Empty collection (no filter results initially)
        $search_title = "";
        //return view with variables
        return view('index', compact('posts', 'cuisines', 'display_filter','search_title'));
    }

    public function filter(Request $request)
    {
        //Validate inputs
        $request->validate([
            'cuisine.*' => 'exists:cuisines,id',
            'price' => 'min:1|max:4',
            'is_open' => 'boolean',
            'is_vegan' => 'boolean',
            'is_date' => 'boolean',
            'is_delivery' => 'boolean',
            'is_menu' => 'boolean',
        ]);

        //Init & Build filter collection
        $display_filter = collect();

        $post_filter = array();
        $post_boolean_filter = array();

        //Fill Cuisines
        if ($request->get('cuisine')) {
            foreach ($request->get('cuisine') as $c) {
                $display_filter->prepend(['cuisine' => $c]);
            }
        }

        //Fill Pricerange
        if ($request->get('price')>0) {
            $display_filter->prepend(['pricerange' => $request->get('price')]);
            $post_filter[] = ['pricerange','=',$request->get('price')];
            /*foreach ($request->get('pricerange') as $p) {
                $display_filter->prepend(['pricerange' => $p]);
                //$filter->prepend(['pricerange'=>$p]);
                $post_filter[] = ['pricerange','=',$p];
            } */
        }

        //Fill other options for frontend filter
        $display_filter->prepend(['is_open' => $request->get('is_open')]);
        $display_filter->prepend(['is_vegan' => $request->get('is_vegan')]);
        $display_filter->prepend(['is_date' => $request->get('is_date')]);
        $display_filter->prepend(['is_delivery' => $request->get('is_delivery')]);
        $display_filter->prepend(['is_menu' => $request->get('is_menu')]);
        $search_title=$request->get('search_title');
        
        $cuisines = Cuisine::all();
        

        //Building backend filter
        
        //return post::find(1)->matchingCuisines($request->get('cuisine'));
        $cuisine_ids = null;
        if($request->get('cuisine')) {
            $cuisine_ids = $request->get('cuisine');
        }
        else {
            foreach($cuisines as $cuisine) {
            $cuisine_ids[] = $cuisine->id; 
            }
        }
        $posts = post::where('is_draft',false)
        ->where('is_declined',false)
        ->whereHas('isLive')
        ->when($request->get('price'), function($query) use($request) {
            $query->where('pricerange',$request->get('price'));
        })
        ->when($request->get('is_vegan'), function($query) {
            $query->where('is_vegan',true);
        })
        ->when($request->get('is_date'), function($query) {
            $query->where('is_date',true);
        })
        ->when($request->get('is_delivery'), function($query) {
            $query->whereNotNull('url_delivery');
        })
        ->when($request->get('is_menu'), function($query) {
            $query->whereNotNull('url_menu');
        })
        ->whereHas('cuisines',function ($query) use ($cuisine_ids) {
            return $query->whereIn('cuisine_id',$cuisine_ids);
        })
        ->when($request->get('search_title'), function($query) use ($request) {
            return $query->where('restaurant_name','LIKE','%'.$request->get('search_title').'%');
        })
        ->when($request->has('sort_name'), function ($query) {
            $query->orderBy('restaurant_name');
        })
        ->when($request->has('sort_creation'), function ($query) {
            $query->orderBy('created_at');
        })
        ->paginate(5);

        //$posts = post::where($post_filter)->paginate(5); 
        return view('index', compact('posts', 'cuisines', 'display_filter','search_title'));
    }
}
