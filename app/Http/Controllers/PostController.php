<?php

namespace App\Http\Controllers;

use App\post;
use App\cuisine;
use App\review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        if ($user = Auth::user()) {
            if (!Auth::user()->email_verified_at) {
                return redirect()->to('/email/verify');
            }
            return $this->index_published();
        }
        return redirect()->route('login');
        //return PostController::IsOpen();
    }

    public function index_show($posts, $status)
    {
        if (!Auth::user()->email_verified_at) {
            return redirect()->to('/email/verify');
        }
        $stats = PostController::stats();
        return view('post.index', compact('posts', 'stats', 'status'));
    }

    public function index_published()
    {
        if (!Auth::user()->email_verified_at) {
            return redirect()->to('/email/verify');
        }
        //return Post::where('id',1)->first();
        /*$posts = collect();
        //Current User must be the author of this review (note, not necessarily of the live post as this can be the editor)
        $reviews = Review::where('user_id',auth()->user()->id)->get();
        foreach($reviews as $review) {
            //Get the current post
            $post = $review->current_post()->first();
            //Make sure that this is a live post
            if($post->is_approved) {
                $posts->add($review->current_post);
            }
        } */

        /**
         * Determine published
         * (A) is_approved == true
         * (B) there is a review that has this post as current post
         */

        $posts = Post::where('user_id', auth()->user()->id)
            ->where('is_approved', true)
            ->whereHas('isLive')
            ->get();

        foreach ($posts as $post) {
            $post->published = Carbon::parse($post->review->created_at)->format('d.m.y, h:m');
            $post->updated = Carbon::parse($post->updated_at)->format('d.m.y, h:m');
            $post->editor = $post->author->firstname . ' ' . $post->author->lastname;
            $post->status = 'Published';
        }
        return $this->index_show($posts, 'published');
    }

    public function index_draft()
    {
        if (!Auth::user()->email_verified_at) {
            return redirect()->to('/email/verify');
        }
        //User must be associated to this post AND is_draft must be true
        $filter = ['user_id' => auth()->user()->id, 'is_draft' => true];
        $posts = Post::where($filter)->get();
        foreach ($posts as $post) {
            $post->published = '-';
            $post->updated = Carbon::parse($post->updated_at)->format('d.m.y, h:m');
            $post->editor = $post->author->firstname . ' ' . $post->author->lastname;
            $post->status = 'Draft';
        }
        return $this->index_show($posts, 'draft');
    }

    public function index_review()
    {
        if (!Auth::user()->email_verified_at) {
            return redirect()->to('/email/verify');
        }
        /**
         * Criteria
         * (1) User must be user of this post
         * (2) is_draft = false
         * (3) is_approved = true
         * (4) No correction_id supplied
         */
        $filter = ['user_id' => auth()->user()->id, 'is_draft' => false, 'is_approved' => false, 'is_declined' => false, 'correction_id' => null];
        $posts = Post::where($filter)->get();
        foreach ($posts as $post) {
            $post->published = Carbon::parse($post->review->created_at)->format('d.m.y, h:m');
            $post->updated = Carbon::parse($post->updated_at)->format('d.m.y, h:m');
            $post->editor = 'tba';
            $post->status = 'Review';
        }
        return $this->index_show($posts, 'review');
    }

    //Declined -> specifically declined, NOT when just updated.
    public function index_declined()
    {
        if (!Auth::user()->email_verified_at) {
            return redirect()->to('/email/verify');
        }
        /**
         * Criteria
         * (1) User must be user of this post
         * (2) is_declined = true
         */
        $filter = ['user_id' => auth()->user()->id, 'is_declined' => true];
        $posts = Post::where($filter)->get();
        foreach ($posts as $post) {
            $post->published = '-';
            $post->updated = Carbon::parse($post->updated_at)->format('d.m.y, h:m');
            $post->editor = $post->author->firstname . ' ' . $post->author->lastname;
            $post->status = 'Declined';
        }
        return $this->index_show($posts, 'declined');
    }

    /**
     * status_filter
     * 
     * Returns post index with status filter about the posts (e.g. all, drafts, in review...)
     */
    public function status_filter($status)
    {
        /**
         * Only show posts where i (current user) am the author
         * Filter for posts according to status
         */


        $posts = Post::where('user_id', auth()->user()->id)
            ->when($status == 'draft', function ($query) use ($filter_draft) {
                $query->where($filter_draft);
            })
            ->when($status == 'published', function ($query) use ($filter_published) {
                $query->where($filter_published)
                    ->whereHas('isLive');
            })
            ->when($status == 'review_pending', function ($query) use ($filter_review) {
                $query->where($filter_review);
            })
            ->get();

        //Adapt certain views
        foreach ($posts as $post) {
            //Determine published date
            $published = null;
            if ($post->review) {
                $published = $post->review->created_at;
            } else {
                $published = $post->updated_at;
            }
            $post->published = Carbon::parse($published)->format('d.m.y h:m');
            $post->updated = Carbon::parse($post->updated_at)->format('d.m.y h:m');
        }

        $stats = PostController::stats();
        return view('post.index', compact('posts', 'stats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->email_verified_at) {
            return redirect()->to('/email/verify');
        }
        $cuisines = Cuisine::all();
        return view('post.create', compact('cuisines'))->with('info', 'Lets go');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Auth::user()->email_verified_at) {
            return redirect()->to('/email/verify');
        }
        //Validate, but only non-drafts
        $validation_errors = PostController::PostValidate($request);
        if (count($validation_errors) > 0) {
            return back()->withInput()->withErrors($validation_errors);
        }

        //Cuisines empty?
        if (!$request->cuisine && $request->action == 'Publish') {
            return back()->withInput()->withErrors("Please select at least one cuisine");
        }


        //Create A New Post Object, assume Draft
        $newPost = new Post();
        $newPost = PostController::PostAssigner($request, $newPost);
        //$newPost->user_id = Auth::user()->id; //Editor of this version

        //Set Maps
        $newPost->place_location = $request->place_location;
        $newPost->place_name = $request->place_name;
        $newPost->place_icon = $request->place_icon;
        $newPost->place_adress = $request->place_adress;
        $newPost->save();

        //Store Cuisines
        PostController::updateCuisines($request, $newPost);

        //Generate opening hours, if any
        OpeningController::new($request, $newPost->id);

        //Images
        PostController::updateImages($request, $newPost);

        //Publish
        if ($request->action == 'Publish') {
            $newPost->is_draft = false;
            $review = ReviewController::new($newPost);
            $newPost->review_id = $review->id;
            $newPost->save();

            return redirect()->route('posts.review')->with('success', 'Post successfully stored and is now under review.');
        }
        //Draft
        else {
            return redirect()->route('posts.draft')->with('success', 'Draft successfully saved.');
        }
        return back()->withInput()->withErrors('Unexpected Error, while ' . $request->action . '/post ' . $newPost->id . '.');

        /**
         * THIS SHULD NOT BE EXECUTED ANYMORE!
         */



        //Publish?
        if ($request->action == 'Publish') {
            $newPost->is_draft = 0;
            //Create and assign review
            $review = ReviewController::new($newPost);
            $newPost->review_id = $review->id;
            $newPost->save();
        }
        //Draft
        else {
            $newPost->is_draft = 1;
            $newPost->save();
        }
        return redirect()->route('posts.index')->with('success', 'Post Saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(post $post)
    {
        $post->openings = OpeningController::readable($post);
        //return $post->place_location;
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(post $post)
    {
        if (!Auth::user()->email_verified_at) {
            return redirect()->to('/email/verify');
        }
        //Checks, if there is already a draft for this post
        $has_active_draft = false;

        //To check this, the post must have a review_id and there must be a post with a higher id than the current post
        if (!is_null($post->review_id)) {
            $newer_post = Post::where('review_id', $post->review_id) //So it belongs to the same review
                ->where('id', '>', $post->id) //To make sure it's newer
                ->where('is_draft', true) //To make sure it's a draft
                ->first();
            if (!is_null($newer_post)) {
                //Set has_active_draft true, so that we can show a message
                $has_active_draft = true;
                //Replace "current" post with newer_post
                return redirect()->route('posts.edit', $newer_post)->with('warning', 'There is already an active draft for this post. It has been opened for you.');
                //return $this->edit($newer_post)->withError('gibts scho');
            }
        }

        //Can this post be edited?
        /**
         * It cannot be edited, when:
         * - is_declined = true
         * - is_draft = false && is_approved = false (then it is in review)
         */
        //Declined?
        if ($post->is_declined) {
            return back()->withErrors('The post can not be edited, as it has been declined.');
        }
        //Old Version
        //No draft, is approved, not live (old version)
        if (!$post->is_draft && $post->is_approved && !$post->isLive) {
            return back()->withErrors('The post can not be edited, as it is not the current version.');
        }
        //In Review
        //No draft, not approved, correction_id null
        if (!$post->is_draft && !$post->is_declined && !$post->is_approved) {
            return back()->withErrors('The post can not be edited, as it is being reviewed.');
        }
        //Another post belonging to this review is being reviewed
        $other_posts = Post::where('review_id', $post->review_id)
            ->where('is_draft', false)
            ->where('is_declined', false)
            ->where('is_approved', false)
            ->where('correction_id', null)
            ->get();
        if (count($other_posts) > 0) {
            return back()->withErrors('The post can not be edited. An updated version of this post is being reviewed.');
        }

        //Has a correction (not qsure)
        if (!is_null($post->correction_id)) {
            return back()->withErrors('The post can not be edited, as it has been corrected by an editor.');
        }

        $post = OpeningController::toEdit($post);
        $cuisines = cuisine::all();
        $cuisine_ids = array();
        foreach ($post->cuisines as $cuisine) {
            $cuisine_ids[] = $cuisine->id;
        }
        return view('post.edit', compact('post', 'cuisines', 'cuisine_ids'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, post $post)
    {
        $action = $request->get('action');

        if (!Auth::user()->email_verified_at) {
            return redirect()->to('/email/verify');
        }

        //Validate, but only non-drafts
        $validation_errors = PostController::PostValidate($request);
        if (count($validation_errors) > 0) {
            return back()->withInput()->withErrors($validation_errors);
        }
        //Cuisines empty?
        if (!$request->cuisine && $action == 'Publish') {
            return back()->withInput()->withErrors("Please select at least one cuisine");
        }

        //Check Post
        $post = Post::find($post->id);
        if (is_Null($post)) {
            return back()->withInput()->withErrors('Action blocked, unrecognized post object.');
        }

        /**
         * 1: IF DRAFT (NEW POST)
         * -> no connection to review yet
         * -> it's just an update of the draft
         * 
         * (A) Update entries
         * 
         * 2: IF DRAFT (EXISTING LIVE POST)
         * -> we assume that edit is on the live version
         * 
         * (A) Check if post is currently live
         *     -- if not, return with an error
         * (B) Create new post
         *     -- Store entries
         *     -- is_draft = true
         *     -- review_id = review_id of old post
         * 
         * (X)  Show in Draft View A Link to the published version
         * 
         * 3: IF PUBLISHED (NEW POST)
         * -> has been a draft so far, no review connected
         * 
         * (A) Update entries
         * (B) Associate new Review
         * (C) is_draft = 0
         * 
         * 4: IF PUBLISHED (EXISTING POST)
         * -> has been a live post so far
         * 
         * (A) Check if post is currently live
         *      -- if not, return with an error
         * 
         * (B) Create A new post
         *      -- Store entries
         *      -- is_draft = false
         *      -- review_id = review_id of old
         * 
         */



        //For (1) and (2)
        if ($action == 'Draft') {
            //(1) IF DRAFT (NOT LIVE)
            if ($post->is_draft && is_Null($post->isLive)) {

                //Save Entries
                $post = PostController::PostAssigner($request, $post);
                //Location
                $post->place_name = $request->place_name;
                $post->place_location = $request->place_location;
                $post->place_adress = $request->place_adress;
                $post->place_icon = $request->place_icon;
                $post->save();
                //Update Cuisines
                PostController::updateCuisines($request, $post);
                //Update Opening Hours
                OpeningController::new($request, $post->id);

                //Update Images
                PostController::updateImages($request, $post);
            }

            //(2) IF DRAFT (LIVE)
            elseif ($post->isLive && $post->is_approved) {
                $newPost = new Post();
                $newPost = PostController::PostAssigner($request, $newPost);
                $newPost->is_draft = true;
                $newPost->review_id = $post->review_id;
                //Location
                $newPost->place_name = $request->place_name;
                $newPost->place_location = $request->place_location;
                $newPost->place_adress = $request->place_adress;
                $newPost->place_icon = $request->place_icon;

                //Images
                $newPost->img_1 = $post->img_1;
                $newPost->img_2 = $post->img_2;
                $newPost->img_3 = $post->img_3;
                $newPost->img_4 = $post->img_4;
                $newPost->img_5 = $post->img_5;
                $newPost->img_6 = $post->img_6;
                $newPost->img_title = $post->img_title;
                $newPost->img_logo = $post->img_logo;

                $newPost->save();
                //Update Cuisines
                PostController::updateCuisines($request, $newPost);
                //Update Opening Hours
                OpeningController::new($request, $newPost->id);

                //Update Images
                PostController::updateImages($request, $newPost);
            }
            //Action is 'draft', but something is wrong with the post
            else {
                return back()->withInput()->withErrors('An error occured. The action could not be performed: Update/Draft on post_id ' . $post->id . '. Please contact us, if this error occurs again.');
            }
            return redirect()->route('posts.draft')->with('success', 'The Draft has been updated.');
        } //End Draft (1) and (2)
        //For (3) and (4)
        elseif ($action == 'Publish') {

            //(3) IF PUBLISH (NEW POST)
            if ($post->is_draft && is_null($post->review_id)) {
                //Update Entries
                $post = PostController::PostAssigner($request, $post);
                $post->is_draft = false;
                //Associate new review (saving post before not required, as it is already in the db)
                $review = ReviewController::new($post);
                $post->review_id = $review->id;
                $post->save();

                //Update Cuisines
                PostController::updateCuisines($request, $post);
                //Update Opening Hours
                OpeningController::new($request, $post->id);
                //Update Images
                PostController::updateImages($request, $post);
            }

            //(5) IF THIS IS A PUBLISH OF A DRAFT OF A LIVE
            elseif ($post->is_draft && $post->review_id) {
                $post = PostController::PostAssigner($request, $post);
                $post->is_draft = false;
                $post->save();

                //Update Cuisines
                PostController::updateCuisines($request, $post);
                //Update Opening Hours
                OpeningController::new($request, $post->id);
                //Update Pictures
                PostController::updateImages($request, $post);
            }


            //(4) IF PUBLISHED (EXISTING POST)
            elseif ($post->isLive && $post->is_approved) {
                $newPost = new Post();
                $newPost = PostController::PostAssigner($request, $newPost);
                $newPost->review_id = $post->review_id;
                $newPost->is_draft = false;
                $newPost->save();
                //Location
                $newPost->place_name = $request->place_name;
                $newPost->place_location = $request->place_location;
                $newPost->place_adress = $request->place_adress;
                $newPost->place_icon = $request->place_icon;

                //Images
                $newPost->img_1 = $post->img_1;
                $newPost->img_2 = $post->img_2;
                $newPost->img_3 = $post->img_3;
                $newPost->img_4 = $post->img_4;
                $newPost->img_5 = $post->img_5;
                $newPost->img_6 = $post->img_6;
                $newPost->img_title = $post->img_title;
                $newPost->img_logo = $post->img_logo;
                //Update Cuisines
                PostController::updateCuisines($request, $newPost);
                //Update Opening Hours
                OpeningController::new($request, $newPost->id);
                //Update Images
                PostController::updateImages($request, $newPost);
            }
            //Action is 'publish', but something is wrong with the post
            else {
                return back()->withInput()->withErrors('An error occured. The action could not be performed: Update/Publish on post_id ' . $post->id . '. Please contact us, if this error occurs again.');
            }
            return redirect()->route('posts.review')->with('success', 'Post successfully updated. It is now being reviewed.');
        } else {
            return back()->withInput()->withError('Error, The submitted action is not Publish or Draft. Please contact us, if this keeps happening.');
        }
        /*
        //Create A New Post Object, Assume Draft
        $editedPost = new Post();
        $editedPost = PostController::PostAssigner($request, $editedPost);
        $editedPost->user_id = auth()->user()->id;
        $editedPost->save();

        //Update Cuisines
        PostController::updateCuisines($request, $editedPost);

        //Generate opening hours, if any
        $opening_test = OpeningController::new($request, $editedPost->id);

        //Publish?
        if ($request->action == 'Publish') {
            //Does this post already belong to a review?
            if (!$post->review) {
                /**Post does not (yet) belong to a review
                 *->still a newbie
                 *->create Review 
                 *
                $review = ReviewController::new($post);
                $post->review_id = $review->id;
            } else {
                $editedPost->review_id = $post->review->id;
            }
            $editedPost->is_draft = 0;
            $editedPost->save();
        }
        return redirect()->route('posts.index')->with('success', 'Post Saved');
        */
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function deletePost(post $post)
    {
        if ($post->isLive) {
            return "bin live";
        }
    }

    /**
     * Editors can unpublish published posts and send them back to be a draft.
     */
    public function unpublish(post $post)
    {
        //Is Editor?
        if (!UserController::isRole(auth()->user(), 2)) {
            return back()->withErrors('You are not allowed to unpublish this post.');
        }

        $post->is_approved = 0;
        $post->is_draft = 1;
        $post->save();

        return redirect('/posts')->with('success', 'Post successfully unpublished, it is now a draft for the author.');
    }

    //Show & prepare version history
    public function explorer(post $current_post)
    {

        //No review yet (just a draft)
        if (!$current_post->review_id) {
            return back()->with('warning', 'This is just an unassociated draft so far. It has not been assigned a review. No history can be displayed. Publish it first.');
        }
        $posts = Post::where('review_id', $current_post->review_id)->orderBy('id', 'desc')->get();
        foreach ($posts as $post) {
            //Published
            if ($post->isLive && $post->is_approved) {
                $post->status = 'Published';
                $post->editor = $post->author;
            }
            //Draft
            elseif ($post->is_draft) {
                $post->status = 'Draft';
                $post->editor = null;
            }
            //Revision
            elseif (!$post->is_draft && !$post->is_declined && !$post->is_approved && !$post->correction_id) {
                $post->status = 'In Review';
                $post->editor = null;
            }
            //Declined
            elseif ($post->is_declined) {
                $post->status = 'Declined';
                $post->editor = $post->author;
            } elseif ($post->correction_id) {
                $post->status = 'Corrected';
                $post->editor = $post->author;
            }
            //Archiv
            else {
                $post->status = 'Archive';
                $post->editor = $post->author;
            }
            $post->created = Carbon::parse($post->created_at)->format('d.m.y, H:i');
            $post->updated = Carbon::parse($post->updated_at)->format('d.m.y, H:i');
        }

        if (UserController::isAdmin()) {
            $can_delete = true;
        }

        return view('post.explorer', compact('posts', 'current_post', 'can_delete'));
    }

    //Editor View
    public function all()
    {
        //Only Editors allowed, Editor = 2
        if (!auth()->user()->roles->contains(2)) {
            return redirect()->route('posts.index')->withErrors('Editor Permissions are required to access this resource.');
        }
        //Show an overview of all published reviews
        $reviews = Review::paginate(5);
        $search_query = "";

        //Return View
        return view('post.all', compact('reviews', 'search_query'));
    }

    public function all_filtered(Request $request)
    {
        //Only Editors allowed, Editor = 2
        if (!auth()->user()->roles->contains(2)) {
            return redirect()->route('posts.index')->withErrors('Editor Permissions are required to access this resource.');
        }
        $search_query = $request->search_query;

        $reviews = Review::whereHas('post', function ($query) use ($search_query) {
            return $query->where('restaurant_name', 'LIKE', '%' . $search_query . '%');
        })->paginate(5);

        return view('post.all', compact('reviews', 'search_query'));
    }

    public function needs_review_errors()
    {
        /**
         * Wann soll es Editoren möglich sein, einen Post zu reviewen?
         * -> (A) kein Draft
         * -> (B) Nicht bereits live (diese version)
         * -> (C) Es gibt keine Future Version dieses Posts, die bereits live ist (ie ich editiere gerade die "aktuellste")
         * -> (D) nicht declined
         */

        $errors = collect();

        //(A) Make sure that this post actually needs to be reviewed, otherwise return with message.
        if ($this->is_draft) {
            $errors->add('Action blocked, Post is in Draft.');
        }
        //(B) Post is already live
        if ($this->isLive) {
            $errors->add('Action blocked, this post is already published by another editor.');
        }
        // (c) A newer version or revision of this post is already live
        if (PostController::has_greater_live_version($this)) {
            $errors->add('Action blocked, there is already an updated published version.');
        }
        //(D) This post is declined
        if ($this->is_declined) {
            $errors->add('Action blocked, Post has been declined by somebody else.');
        }
        if ($this->is_approved) {
            $errors->add('Action blocked, Post has already been approved.');
        }

        return $errors;
    }

    //Returns all successed posts, disregarding status
    public static function has_successor(post $post, $filter)
    {
        $review = $post->review;
        $successors = Post::where('review_id', $review->id)
            ->where('id', '>', $post->id)
            ->whereHas('')
            ->where($filter)
            ->get();
        if (count($successors) > 0) {
            return true;
        }
        return false;
    }

    public static function has_greater_live_version($post)
    {
        $posts = Post::where('review_id', $post->review_id)
            ->where('id', '>', $post->id)
            ->get();

        foreach ($posts as $post) {
            if ($post->isLive()) {
                return true;
            }
        }
        return false;
    }



    /**
     * Validation Function
     */
    public static function PostValidate($request)
    {
        //Validate Inputs
        $request->validate([
            //'place_location' => 'required',
            'restaurant_name' => 'required|max:30',
            'subtitle' => 'max:60',
            'seo' => 'max:60',
            'price' => 'required|min:0|max:5', //not required due to publish/draft difference, but we need to theck it before publishing (filter)
            'is_vegan' => 'boolean',
            'is_vegetarian' => 'boolean',
            'is_date' => 'boolean',
            'url_homepage' => 'nullable|url',
            'url_menu' => 'nullable|url',
            'url_reservation' => 'nullable|url',
            'url_delivery' => 'nullable|url',
            'social_facebook' => 'nullable|url',
            'social_instagram' => 'nullable|url',
            'social_twitter' => 'nullable|url',
            'summary' => 'max:50000',
            'review_food' => 'max:50000',
            'review_style' => 'max:50000',
            'review_service' => 'max:50000',
            'mo_from' => 'nullable|date_format:H:i',
            'mo_to' => 'nullable|date_format:H:i',
            'tu_from' => 'nullable|date_format:H:i',
            'tu_to' => 'nullable|date_format:H:i',
            'we_from' => 'nullable|date_format:H:i',
            'we_to' => 'nullable|date_format:H:i',
            'th_from' => 'nullable|date_format:H:i',
            'th_to' => 'nullable|date_format:H:i',
            'fr_from' => 'nullable|date_format:H:i',
            'fr_to' => 'nullable|date_format:H:i',
            'sa_from' => 'nullable|date_format:H:i',
            'sa_to' => 'nullable|date_format:H:i',
            'so_from' => 'nullable|date_format:H:i',
            'so_to' => 'nullable|date_format:H:i',
            'mo_closed' => 'boolean',
            'tu_closed' => 'boolean',
            'we_closed' => 'boolean',
            'th_closed' => 'boolean',
            'fr_closed' => 'boolean',
            'sa_closed' => 'boolean',
            'su_closed' => 'boolean',
            'is_transport' => 'boolean',
            'is_groups' => 'boolean',
            'is_outside' => 'boolean',
            'is_takeawayonly' => 'boolean',
            'is_studying' => 'boolean',
            'social_tripadvisor' => 'nullable|url',
            'cuisine.*' => 'exists:cuisines,id', //Validates cuisine, .* as there are multiple inputs (name = "cuisine[]" in the views)
            'img_1' => 'image|mimes:jpeg,png,jpg,svg|max:5200',
            'img_2' => 'image|mimes:jpeg,png,jpg,svg|max:5200',
            'img_3' => 'image|mimes:jpeg,png,jpg,svg|max:5200',
            'img_4' => 'image|mimes:jpeg,png,jpg,svg|max:5200',
            'img_5' => 'image|mimes:jpeg,png,jpg,svg|max:5200',
            'img_6' => 'image|mimes:jpeg,png,jpg,svg|max:5200',
            'img_title' => 'image|mimes:jpeg,png,jpg,svg|max:5200',
            'img_logo' => 'image|mimes:jpeg,png,jpg,svg|max:5200',
            'noise' => 'integer|max:3',
            'district' => '',
        ]);

        //Custom Validation, save errors in $errors []
        $errors = [];

        /**
         * (1) Date Validation
         * Each row (Mo, Tu, We... So) must either be closed or have a from and to value
         */
        if (!$request->mo_closed) {
            if (!$request->mo_from || !$request->mo_to) {
                $errors[] = "Please update your opening hours for Monday. No opening hours have been provided, thus Monday has been set as closed. Please re-submit.";
            }
        }
        if (!$request->tu_closed) {
            if (!$request->tu_from || !$request->tu_to) {
                $errors[] = "Please update your opening hours for Tuesday.  No opening hours have been provided, thus Tuesday has been set as closed. Please re-submit.";
            }
        }
        if (!$request->we_closed) {
            if (!$request->we_from || !$request->we_to) {
                $errors[] = "Please update your opening hours for Wednesday. No opening hours have been provided, thus Wednesday has been set as closed. Please re-submit.";
            }
        }
        if (!$request->th_closed) {
            if (!$request->th_from || !$request->th_to) {
                $errors[] = "Please update your opening hours for Thursday. No opening hours have been provided, thus Thursday has been set as closed. Please re-submit.";
            }
        }
        if (!$request->fr_closed) {
            if (!$request->fr_from || !$request->fr_to) {
                $errors[] = "Please update your opening hours for Friday. No opening hours have been provided, thus Friday has been set as closed. Please re-submit.";
            }
        }
        if (!$request->sa_closed) {
            if (!$request->sa_from || !$request->sa_to) {
                $errors[] = "Please update your opening hours for Saturday. No opening hours have been provided, thus Saturday has been set as closed. Please re-submit.";
            }
        }
        if (!$request->so_closed) {
            if (!$request->so_from || !$request->so_to) {
                $errors[] = "Please update your opening hours for Sunday. No opening hours have been provided, thus Sunday has been set as closed. Please re-submit.";
            }
        }

        //Return
        return $errors;
    }

    public static function PostAssigner($request, $target)
    {
        //Create new entry
        $target->restaurant_name = $request->restaurant_name;
        $target->subtitle = $request->subtitle;
        $target->pricerange = $request->price;
        $target->is_vegan = $request->is_vegan;
        $target->is_vegetarian = $request->is_vegetarian;
        $target->is_date = $request->is_date;
        $target->url_homepage = $request->url_homepage;
        $target->url_menu = $request->url_menu;
        $target->url_reservation = $request->url_reservation;
        $target->social_facebook = $request->social_facebook;
        $target->social_instagram = $request->social_instagram;
        $target->social_twitter = $request->social_twitter;
        $target->summary = $request->summary;
        $target->review_food = $request->review_food;
        $target->review_style = $request->review_style;
        $target->review_service = $request->review_service;
        $target->user_id = auth()->user()->id;
        $target->is_transport = $request->is_transport;
        $target->is_groups = $request->is_groups;
        $target->is_outside = $request->is_outside;
        $target->is_takeawayonly = $request->is_takeawayonly;
        $target->is_studying = $request->is_studying;
        $target->social_tripadvisor = $request->social_tripadvisor;
        $target->noise = $request->noise;
        $target->district = $request->district;
        return $target;
    }

    public static function updateCuisines(request $request, Post $post)
    {
        //Assign cuisines
        $cuisines = $request->get('cuisine');
        /**
         * The following line is pretty important, but maybe not so straightforward.
         * The relation between posts and cuisines is a many-to-many relationship.
         * Thus, there exists the cuisine_post table (with a cuisine_id and a post_id).
         * The "sync" makes sure that entries in this "pivot" table are kept up to date, only the values provided within the sync argument are kept.
         * See the following tutorial about many-to-many relations: https://appdividend.com/2018/05/17/laravel-many-to-many-relationship-example/#Step_2_Create_a_model_and_migration
         * See the following tutorial about sync() (the above tutorial uses attach): https://laravel.com/docs/5.8/eloquent-relationships#updating-many-to-many-relationships
         */
        $post->cuisines()->sync($cuisines);
    }

    public static function updateImages(request $request, Post $post)
    {

        //Generate filenames
        $img_1 = null;
        $img_2 = null;
        $img_3 = null;
        $img_4 = null;
        $img_5 = null;
        $img_title = null;
        //return $request->img_1;

        if ($request->hasFile('img_1')) {
            $img_1 = time() . '.1.' . $request->img_1->getClientOriginalExtension();
            $request->img_1->move(public_path('images'), $img_1);
            $post->img_1 = $img_1;
        }
        if ($request->hasFile('img_2')) {
            $img_2 = time() . '.2.' . $request->img_2->getClientOriginalExtension();
            $request->img_2->move(public_path('images'), $img_2);
            $post->img_2 = $img_2;
        }
        if ($request->hasFile('img_3')) {
            $img_3 = time() . '.3.' . $request->img_3->getClientOriginalExtension();
            $request->img_3->move(public_path('images'), $img_3);
            $post->img_3 = $img_3;
        }
        if ($request->hasFile('img_4')) {
            $img_4 = time() . '.4.' . $request->img_4->getClientOriginalExtension();
            $request->img_4->move(public_path('images'), $img_4);
            $post->img_4 = $img_4;
        }
        if ($request->hasFile('img_5')) {
            $img_5 = time() . '.5.' . $request->img_5->getClientOriginalExtension();
            $request->img_5->move(public_path('images'), $img_5);
            $post->img_5 = $img_5;
        }
        if ($request->hasFile('img_6')) {
            $img_6 = time() . '.6.' . $request->img_6->getClientOriginalExtension();
            $request->img_6->move(public_path('images'), $img_6);
            $post->img_6 = $img_6;
        }
        if ($request->hasFile('img_title')) {
            $img_title = time() . '.t.' . $request->img_title->getClientOriginalExtension();
            $request->img_title->move(public_path('images'), $img_title);
            $post->img_title = $img_title;
        }
        if ($request->hasFile('img_logo')) {
            $img_logo = time() . '.l.' . $request->img_logo->getClientOriginalExtension();
            $request->img_logo->move(public_path('images'), $img_logo);
            $post->img_logo = $img_logo;
        }

        /*
        try{
        $img_1 = time().'.1.'.$request->img_1->getClientOriginalExtension();
        $img_2 = time().'.2.'.$request->img_2->getClientOriginalExtension();
        $img_3 = time().'.3.'.$request->img_3->getClientOriginalExtension();
        $img_4 = time().'.4.'.$request->img_4->getClientOriginalExtension();
        $img_5 = time().'.5.'.$request->img_5->getClientOriginalExtension();
        $img_title = time().'.t.'.$request->img_title->getClientOriginalExtension();
        
        //Move Images
        $request->img_1->move(public_path('images'), $img_1);
        $request->img_2->move(public_path('images'), $img_2);
        $request->img_3->move(public_path('images'), $img_3);
        $request->img_4->move(public_path('images'), $img_4);
        $request->img_5->move(public_path('images'), $img_5);
        $request->img_title->move(public_path('images'), $img_title);
        }
        catch (error $e) {}
        
        //Store names to db
        $post->img_1 = $img_1;
        $post->img_2 = $img_2;
        $post->img_3 = $img_3;
        $post->img_4 = $img_4;
        $post->img_title = $img_title;
        */
        $post->save();
    }

    /**
     * returns an array of statistics to be used in the posts admin view
     */
    public static function stats()
    {
        $filter_published = ['is_draft' => false, 'is_approved' => true, 'is_declined' => false, 'correction_id' => null];
        $filter_draft = ['user_id' => auth()->user()->id, 'is_draft' => true];
        $filter_review = ['user_id' => auth()->user()->id, 'is_draft' => false, 'is_approved' => false, 'is_declined' => false, 'correction_id' => null];
        $filter_declined = ['is_declined' => true];
        $filter_corrected = ['is_approved' => false, 'correction_id' > 0];

        //For counters
        $stats = array();
        $stats['all'] = Post::all()->count();
        $stats['published'] = Post::where('user_id', auth()->user()->id)->where($filter_published)->whereHas('isLive')->count(); //More stuff to do here!"
        $stats['draft'] = Post::where('user_id', auth()->user()->id)->where($filter_draft)->count();
        $stats['review'] = Post::where('user_id', auth()->user()->id)->where($filter_review)->count();
        $stats['declined'] = Post::where('user_id', auth()->user()->id)->where($filter_declined)->count();
        return $stats;
    }


    /**
     * IsOpen
     * Evaluates wether a restaurant (post) is open now.
     * Returns true or false
     * Input: object post
     */
    public static function IsOpen()
    {
        //Get current time & convert it to "mo, tu, we..." string

        //Array of Dates
        // [[Mo,null,null],[Tu,08:00,20:00],...]



        return Carbon::now()->format('d');
    }
}
