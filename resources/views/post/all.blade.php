<?php

use Carbon\carbon;
?>

@include('layout.admin_header')
@include('layout.admin_top_navigation')
@include('layout.admin_navigation')
<div id="main">
    <div class="container mt-5">
        <div class="row p-3">
            <div class="col-md-8">
                <h1>All Reviews</h1>
            </div>
        </div>
    </div>

    @include('components.messages')
    <style>
        a.active {
            color: black;
        }
    </style>

    <div class="container mt-2">
        <form method="post" action="{{route('posts.allfilter')}}">
            <div class="row">

                @csrf
                <div class="col-md-10">
                    <input type="text" class="form-control mb-3" id="search_query" name="search_query" value="{{$search_query}}" placeholder="Search...">
                </div>
                <div class="col-md-2">
                    <button type="submit" value="filter_submit" class="btn btn-outline-primary"><i class="fas fa-hamburger mr-2"></i>Search</button>

                </div>
            </div>
            <div class="row">
                <div class="col-md-12">

                    {{-- Actual Results --}}
                    @if(count($reviews)==0)
                    <p>We did not find any reviews 😔</p>
                    @endif
                    <p>There are {{count($reviews)}} Reviews.</p>
                    <div class="list-group">
                        @foreach($reviews as $review)
                        <div class="list-group-item list-group-item-action mb-1 shadow-sm">
                            <div class="row">
                                <div class="col-3 col-md-2">
                                    <img src="{{ asset('images/restaurants/food.jpg')}}" class="img-fluid" />
                                </div>
                                <div class="col-6 col-md-7">
                                    <h5>{{$review->post->restaurant_name}}</h5>
                                    <p class="font-weight-lighter m-0">Created: {{Carbon::parse($review->post->created_at)->format('d.m.y')}}</p>
                                    <p class="font-weight-lighter m-0">Author: {{$review->post->author->firstname.' '.$review->post->author->lastname}}</p>
                                </div>
                                <div class="col-3 col-md-3">
                                    <p><a href="{{route('posts.show',$review->post)}}" title="View" role="button" class="btn btn-outline-primary btn-sm mb-1" target="_blank"><i class="far fa-eye mr-2"></i>View Latest Version</a></p>

                                    <p><a href="{{route('posts.explorer',$review->post)}}" title="Explore" role="button" class="btn btn-outline-primary btn-sm mb-1" target="_blank">View History</a></p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p>{{ $reviews->links() }}</p>
                </div>
            </div>
        </form>
    </div>

</div> {{-- End of Main Container --}}

@include('layout.footer')
@include('layout.end')