@include('layout.admin_header')
@include('layout.admin_top_navigation')
@include('layout.admin_navigation')
<div id="main">
    <div class="container mt-5">
        <div class="row p-3">
            <div class="col-md-8">
                <h1>Revisions</h1>
            </div>
        </div>
        <div class="row p-3">
            <div class="col-md-8">
                There are {{count($posts)}} posts that need your review.
            </div>
        </div>
    </div>

    @include('components.messages')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="container" id="restaurant_results">

                    {{-- Actual Results --}}
                    @if(count($posts)==0)
                    <p>All done, Good Work 😃</p>
                    @endif
                    <div class="list-group">
                        @foreach($posts as $post)
                        <div class="list-group-item list-group-item-action mb-1 shadow-sm">
                            <div class="row">
                                <div class="col-3 col-md-2">
                                    @if($post->img_logo)
                                    <img src="{{ url('images/'.$post->img_logo)}}" class="img-fluid" />
                                    @else
                                    <img src="{{ asset('images/restaurants/food.jpg')}}" class="img-fluid" />
                                    @endif
                                </div>
                                <div class="col-3 col-md-5">
                                    <h5>{{$post->restaurant_name}}</h5>
                                    <p class="font-weight-lighter m-0">Created: {{$post->created}}</p>
                                    <p class="font-weight-lighter m-0">Author: {{$post->author->firstname.' '.$post->author->lastname}}</p>
                                </div>

                                <div class="col-3 col-md-2">
                                    @if($post->is_declined)
                                    <div class="alert alert-danger text-center">
                                        Declined
                                    </div>
                                    @else
                                    <div class="alert alert-warning text-center">
                                        Needs revision
                                    </div>
                                    @endif
                                </div>
                                <div class="col-3 col-md-3">
                                    @if(!$post->is_declined)
                                    <a href="{{route('revisions.review',$post)}}" title="Review" role="button" class="btn btn-outline-success mb-1"><i class="fas fa-eye mr-2"></i>Review</a>
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