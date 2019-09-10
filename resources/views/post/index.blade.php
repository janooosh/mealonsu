@include('layout.admin_header')
@include('layout.admin_top_navigation')
@include('layout.admin_navigation')
<div id="main">
    <div class="container mt-5">
        <div class="row p-3">
            <div class="col-md-8">
                <h1>My Reviews</h1>
            </div>
            <div class="col-md-4 text-right">
                <a href="{{route('posts.create')}}" role="button" class="btn btn-dark"><i class="fas fa-plus-circle mr-2"></i>New Post</a>
            </div>
        </div>
    </div>

    @include('components.messages')
    <style>
        a.active{
            color:black;
        }
    </style>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="container" id="restaurant_results">
                    {{-- Status Selection --}}
                    <div class="row mb-3" style="text-align:center;">
                        <div class="col-md-3">
                        <a href="{{route('posts.index')}}" class="{{$status=='published'?'active':''}}">Published ({{$stats['published']}})</a>
                        </div>
                        <div class="col-md-3">
                        <a href="{{route('posts.draft')}}" class="{{$status=='draft'?'active':''}}">Drafts ({{$stats['draft']}})</a>
                        </div>
                        <div class="col-md-3">
                        <a href="{{route('posts.review')}}" class="{{$status=='review'?'active':''}}">In Review ({{$stats['review']}})</a>
                        </div>
                        <div class="col-md-3">
                        <a href="{{route('posts.declined')}}" class="{{$status=='declined'?'active':''}}">Declined ({{$stats['declined']}})</a>
                        </div>


                    </div>


                    {{-- Search Field --}}
                    <div class="row">
                        <div class="col-md-11">
                            <input type="text" class="form-control mb-3" id="searchRestaurant" placeholder="Search...">
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-dark" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-sort"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Cuisine</a>
                                <a class="dropdown-item" href="#">Price</a>
                                <a class="dropdown-item" href="#">Average Rating</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Reset</a>
                            </div>
                        </div>
                    </div>

                    {{-- Actual Results --}}
                    @if(count($posts)==0)
                    <p>We did not find any posts 😔</p>
                    @endif
                    <div class="list-group">
                        @foreach($posts as $post)
                        <div class="list-group-item list-group-item-action mb-1 shadow-sm">
                            <div class="row h-100">
                                <div class="col-3 col-md-2">
                                    @if($post->img_logo)
                                        <img src="{{ url('images/'.$post->img_logo)}}" style="height:100%;" class="img-fluid" />
                                    @else
                                        <img src="{{ asset('images/restaurants/food.jpg')}}"style="height:100%;" class="img-fluid" />
                                    @endif

                                </div>
                                <div class="col-3 col-md-5">
                                    <h5>{{$post->restaurant_name}}</h5>
                                    <p class="font-weight-lighter m-0">Published: {{$post->published}}</p>
                                    <p class="font-weight-lighter m-0">Last Update: {{$post->updated}}</p>
                                </div>
                                {{-- Status Determination --}}
                                <div class="col-3 col-md-2">
                                    <p>Editor: {{$post->editor}}</p>
                                </div>
                                <div class="col-3 col-md-3">
                                    <a href="{{route('posts.edit',$post)}}" title="Edit" role="button" class="btn btn-outline-primary btn-sm mb-1"><i class="fas fa-edit mr-2"></i>Edit</a>
                                    <a href="{{route('posts.show',$post)}}" title="View" role="button" class="btn btn-outline-primary btn-sm mb-1"><i class="far fa-eye mr-2"></i>View</a>
                                    @if($post->review_id)
                                    <p><a href="{{route('posts.explorer',$post)}}">View History</a></p>
                                    @else
                                    <p>No history yet.</p>
                                    @endif
                                </div>
                                </div>
                            </div>
                        @endforeach

                    </div>

                </div>
            </div>
        </div>
    </div>

</div> {{-- End of Main Container --}}

@include('layout.footer')
@include('layout.end')