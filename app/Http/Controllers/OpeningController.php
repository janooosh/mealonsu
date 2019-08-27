<?php

namespace App\Http\Controllers;

use App\opening;
use App\post;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OpeningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request, Post $post)
    {
        try {
            $isOpen = array($request->mo_closed, $request->tu_closed, $request->we_closed, $request->th_closed, $request->fr_closed, $request->sa_closed, $request->so_closed);
            $opens = array([$request->mo_from, $request->mo_to], [$request->tu_from, $request->tu_to], [$request->we_from, $request->we_to], [$request->th_from, $request->th_to], [$request->fr_from, $request->fr_to], [$request->sa_from, $request->sa_to], [$request->so_from, $request->so_to]);
            for ($x = 0; $x < count($isOpen); $x++) {
                if ($x == 1) {
                    $newOpening = new Opening();
                    $newOpening->post_id = $post->id;
                    $newOpening->day = $x + 1; //Mo = 1, Tu = 2, ...
                    $newOpening->from = $opens[x][0];
                    $newOpening->to = $opens[x][1];
                    $newOpening->save();
                }
            }
        } catch (error $e) {
            return false;
        }
        return true;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\opening  $opening
     * @return \Illuminate\Http\Response
     */
    public function show(opening $opening)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\opening  $opening
     * @return \Illuminate\Http\Response
     */
    public function edit(opening $opening)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\opening  $opening
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, opening $opening)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\opening  $opening
     * @return \Illuminate\Http\Response
     */
    public function destroy(opening $opening)
    {
        //
    }

    /**
     * readable !! "easy": The function does not (yet^^) aggregate multiple similar opening times
     * returns array of readable opening times, to be used in a table view
     * Following output parameters:
     * array of [day(s),from,to]
     *  example: [[Mo,'20:00','02:00'],['Tu','18:00','03:00']]
     * 
     * @param $post of App\post
     */
    public static function readable($post)
    {
        //Get all associated openings, order by day
        $openings = Opening::where('post_id', $post->id)->orderBy('day', 'asc')->get();
        $weekMap = [
            0 => 'Sunday',
            1 => 'Monday',
            2 => 'Tuesday',
            3 => 'Wednesday',
            4 => 'Thursday',
            5 => 'Friday',
            6 => 'Saturday',
        ];

        $readable = array();
        foreach ($openings as $opening) {
            //Create & Fill temporary entry
            $readable_temp = array();
            $readable_temp['day'] = $weekMap[$opening->day];
            //substr (var,0,-3) removes the last three digits from the string, this is to remove the seconds
            $readable_temp['from'] = substr($opening->from, 0, -3);
            $readable_temp['to'] = substr($opening->to, 0, -3);

            //Append to readable array
            $readable[] = $readable_temp;
        }

        return $readable;
    }

    /**
     * Appends all *_closed, *_from and *_to variables to $post
     */
    public static function toEdit($post)
    {
        //Get openings associated with the given post
        $openings = $post->openings;

        //Go through all open days and translate them on the post object
        for ($x = 0; $x < count($openings); $x++) {
            switch ($openings[$x]->day) {
                case 0:
                    $post->so_closed = 0;
                    $post->so_from = substr($openings[$x]->from,0,-3);
                    $post->so_to = substr($openings[$x]->to,0,-3);
                    break;
                case 1:
                    $post->mo_closed = 0;
                    $post->mo_from = substr($openings[$x]->from,0,-3);
                    $post->mo_to = substr($openings[$x]->to,0,-3);
                    break;
                case 2:
                    $post->tu_closed = 0;
                    $post->tu_from = substr($openings[$x]->from,0,-3);
                    $post->tu_to = substr($openings[$x]->to,0,-3);
                    break;
                case 3:
                    $post->we_closed = 0;
                    $post->we_from = substr($openings[$x]->from,0,-3);
                    $post->we_to = substr($openings[$x]->to,0,-3);
                    break;
                case 4:
                    $post->th_closed = 0;
                    $post->th_from = substr($openings[$x]->from,0,-3);
                    $post->th_to = substr($openings[$x]->to,0,-3);
                    break;
                case 5:
                    $post->fr_closed = 0;
                    $post->fr_from = substr($openings[$x]->from,0,-3);
                    $post->fr_to = substr($openings[$x]->to,0,-3);
                    break;
                case 6:
                    $post->sa_closed = 0;
                    $post->sa_from = substr($openings[$x]->from,0,-3);
                    $post->sa_to = substr($openings[$x]->to,0,-3);
                    break;
                default: null;
            }
        }
        return $post;
    }

    public static function new(Request $request, $post_id)
    {
        try {
            //$post = Post::find($post_id);
            //Filling closed 1 / 0; Start with sunday as in carbon sunday is 0 in function dayOfWeek (see carbon docs)
            $isOpen = array($request->so_closed, $request->mo_closed, $request->tu_closed, $request->we_closed, $request->th_closed, $request->fr_closed, $request->sa_closed);
            $opens = array([$request->so_from, $request->so_to], [$request->mo_from, $request->mo_to], [$request->tu_from, $request->tu_to], [$request->we_from, $request->we_to], [$request->th_from, $request->th_to], [$request->fr_from, $request->fr_to], [$request->sa_from, $request->sa_to]);
            for ($x = 0; $x < count($isOpen); $x++) {
                //Day is open
                if ($isOpen[$x] == 0) {
                    $opening = Opening::updateOrCreate(
                        ['post_id' => $post_id, 'day' => $x],
                        ['from' => $opens[$x][0], 'to' => $opens[$x][1]]
                    );

                    //Already exists? -> update
                    //Check if an opening hour for combinaton of post-id and dayOfWeek ($x) already exists
                    /*
                    if ($existingOpening = opening::where(['post_id' => $post->id, 'day' => $x])) {
                        $existingOpening->from = $opens[$x][0];
                        $existingOpening->to = $opens[$x][1];
                        $existingOpening->save();
                    } 
                    else {
                        $newOpening = new Opening();
                        $newOpening->post_id = $post->id;
                        $newOpening->day = $x; //So = 0, Mo = 1, Tu = 2, ...
                        $newOpening->from = $opens[$x][0];
                        $newOpening->to = $opens[$x][1];
                        $newOpening->save();
                    }
                    */
                }
                //Day is closed
                else {
                    //Is there a record showing that this day is open, even though it is not according to now? -> "close it" (remove record)
                    if (opening::where(['post_id' => $post_id, 'day' => $x])->exists()) {
                        opening::where(['post_id' => $post_id, 'day' => $x])->delete();
                    }
                }
            }
        } catch (error $e) {
            return $e;
        }
        return true;
    }
}
