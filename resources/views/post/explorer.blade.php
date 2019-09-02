@include('layout.admin_header')
@include('layout.admin_top_navigation')
@include('layout.admin_navigation')
<div id="main">
    <div class="container mt-5">
        <div class="row p-3">
            <div class="col-md-8">
                <h1>Explorer</h1>
                
            </div>
            <div class="col-md-4 text-right">
                {{-- <a href="{{route('posts.show')}}" role="button" class="btn btn-dark"><i class="fas fa-plus-circle mr-2"></i>View Live Version</a> --}}
            </div>
        </div>
    </div>

    @include('components.messages')
    <style>
        a.active{
            color:black;
        }
    </style>

    <div class="container mt-2">
        <div class="row">
            <div class="col-md-12">
                <div class="container" id="restaurant_results">

                    {{-- Actual Results --}}
                    @if(count($posts)==0)
                    <p>We did not find any posts 😔</p>
                    @endif
                    <p>This review has {{count($posts)}} posts.</p>
                    <div class="list-group">
                        @foreach($posts as $post)
                        <div class="list-group-item list-group-item-action mb-1 shadow-sm" style="{{$post->isLive?'background-color:rgba(50,205,50,0.2);':''}}">
                            <div class="row">
                                <div class="col-3 col-md-2">
                                    <img src="{{ asset('images/restaurants/food.jpg')}}" class="img-fluid" />
                                </div>
                                <div class="col-3 col-md-5">
                                    <h5>{{$post->restaurant_name}}</h5>
                                    <p class="font-weight-lighter m-0">Created: {{$post->created}}</p>
                                    <p class="font-weight-lighter m-0">Last Update: {{$post->updated}}</p>
                                </div>
                                {{-- Status Determination --}}
                                <div class="col-3 col-md-2">
                                    <p>Editor: {{is_null($post->editor)?'-':$post->editor->firstname.' '.$post->editor->lastname}}</p>
                                    <p><b>{{$post->status}}</b></p>
                                </div>
                                <div class="col-3 col-md-3">
                                    @if($post->status == 'Published' || $post->status == 'Draft')
                                    <a href="{{route('posts.edit',$post)}}" title="Edit" role="button" class="btn btn-outline-primary btn-sm mb-1"><i class="fas fa-edit mr-2"></i>Edit</a>
                                    @endif
                                    <a href="{{route('posts.show',$post)}}" title="View" role="button" class="btn btn-outline-primary btn-sm mb-1"><i class="far fa-eye mr-2"></i>View</a>
                                </div>
                                </div>
                            </div>
                        @endforeach
                        <p>Review Id: {{$current_post->review_id}}</p>

                    </div>

                </div>
            </div>
        </div>
    </div>

</div> {{-- End of Main Container --}}

@include('layout.footer')
@include('layout.end')