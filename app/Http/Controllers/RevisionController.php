<?php

namespace App\Http\Controllers;

use App\Review;
use App\Cuisine;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * Revisions
 * Editors can review posts.
 */

class RevisionController extends Controller
{
    /**
     * Show all open revisions
     * 
     * For now, let's assume that everybody is an editor
     * TO-DO: Implement functionality that these functions can only be accessed by edeitors
     */

    //Returns a collection of posts that must be reviewed
    public function to_review()
    {
        $posts = Post::
            where('is_draft', false)
            ->where('is_declined', false)
            ->where('is_approved', false)
            ->where('correction_id',null)
            ->get();

        return $posts;
    }

    public function index()
    {
        //Edit is required, when this post is not a draft, not (yet) approved and belongs to a review 
        //(as review object is being created when an author clicks on "publish")
        //return $this->status_filter('');
        $posts = $this->to_review();
        foreach ($posts as $post) {
            $post->created = Carbon::parse($post->created_at)->format('d.m.y, h:m');
            $post->updated = Carbon::parse($post->updated_at)->format('d.m.y, h:m');
        }
        return view('revisions.index', compact('posts'));
    }

    /**
     * Currently not in use!
     */
    public function status_filter($status)
    {
        //Filter
        $posts = Post::where('is_draft', false)
            ->when($status == '', function ($query) {
                $query_filter = ['is_approved' => false, 'is_declined' => false];
                return $query->where($query_filter);
            })
            ->when($status == 'declined', function ($query) {
                $query_filter = ['is_approved' => false, 'is_declined' => true];
                return $query->where($query_filter);
            })
            ->when($status == 'approved', function ($query) {
                $query_filter = ['is_approved' => true, 'is_declined' => false];
                return $query->where($query_filter);
            })
            ->whereHas('review')
            ->get();

        foreach ($posts as $post) {
            $post->created = Carbon::parse($post->created_at)->format('d.m.y, h:m');
            $post->updated = Carbon::parse($post->updated_at)->format('d.m.y, h:m');
        }

        //Return view
        return view('revisions.index', compact('posts'));
    }

    public function review(Post $post)
    {

        $errors = $post->needs_review_errors();
        if ($errors->isEmpty()) {
            return view('revisions.review', compact('post'));
        } else {
            return back()->withErrors($errors);
        }
        //TO-DO: Fetch all previous reviews and return them with it

    }

    //Checks if a post is eglible for review
    /*Should be called when: 
        -> Index View for editors (foreach) 
        -> When attempting to review it | Done
        -> When attempting to approve it | Done
        -> When attempting to decline it | Done
        -> When attempting to edit it | Done
        -> When attempting to update it (after edit)

    Returns error messages
    */

    public function decline(Post $post)
    {
        $errors = $post->needs_review_errors();
        if ($errors->isEmpty()) {
            $post->is_declined = 1;
            $post->user_id = auth()->user()->id;
            $post->save();
            return redirect()->route('revisions.index')->with('success', 'Post successfully declined.');
        }
        return redirect()->route('revisions.index')->withErrors($errors);
    }

    public function approve(Post $post)
    {
        $errors = $post->needs_review_errors();
        
        
        if ($errors->isEmpty()) {
            //Find out old review
            $review = $post->review;
            $post->is_approved = 1;
            $post->review->post_id = $post->id;
            $post->review->url = "test";
            $post->user_id = auth()->user()->id; //Set current user as editor
            $post->save();
            //Update Review
            $review->post_id = $post->id;
            $review->save();
            return redirect()->route('revisions.index')->with('success', 'Post successfully approved and published.');
        }
        return redirect()->route('revisions.index')->withErrors($errors);
    }

    public function edit(Post $post)
    {
        $errors = $post->needs_review_errors();
        if ($errors->isEmpty()) {
            $post = OpeningController::toEdit($post);
            $cuisines = cuisine::all();
            $cuisine_ids = array();
            foreach ($post->cuisines as $cuisine) {
                $cuisine_ids[] = $cuisine->id;
            }
            return view('revisions.edit', compact('post', 'cuisines', 'cuisine_ids'));
        }
        return redirect()->route('revisions.index')->withErrors($errors);
    }

    /**
     * This creates a new post object, with dependencies to the "old" one
     * Pretty much, this function is the same as PostController::store
     */
    public function new(Post $post, Request $request)
    {
        $errors = $post->needs_review_errors();
        if ($errors->isEmpty()) {
            //Validate
            $validation_errors = PostController::PostValidate($request);
            if (count($validation_errors) > 0) {
                return back()->withInput()->withErrors($validation_errors);
            }

            //New Post Object
            $newPost = new Post();
            $newPost = PostController::PostAssigner($request, $newPost);
            $newPost->review_id = $post->review->id;
            $newPost->user_id = Auth::user()->id;
            $newPost->is_draft = 0;
            $newPost->is_approved = 1;
            $newPost->save();
            $newPost->review->post_id = $newPost->id; //Sets this live
            $newPost->review->save();
            //$newPost->review->url = ...

            //Set correction id, so he doesn't show up on the revisions
            $post->correction_id = $newPost->id;
            $post->save();

            //Cuisines
            PostController::updateCuisines($request, $newPost);
            //Opening Hours
            OpeningController::new($request, $newPost->id);
            
            return redirect()->route('revisions.index')->with('success', 'Post approved and published.');
        }
        return redirect()->route('revisions.index')->withErrors($errors);
    }
}
