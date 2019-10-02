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
        a.active {
            color: black;
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
                                    @if($post->status == 'Published')
                                    <a href="{{route('posts.unpublish',$post)}}" title="Unpublish" role="button" class="btn btn-outline-primary btn-sm mb-1"><i class="fas fa-eye-slash mr-2"></i>Unpublish</a>
                                    @endif
                                    <a href="{{route('posts.show',$post)}}" title="View" role="button" class="btn btn-outline-primary btn-sm mb-1"><i class="far fa-eye mr-2"></i>View</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <p>Review Id: {{$current_post->review_id}}</p>
                        @if($can_delete)
                        <div class="row">
                            <div class="col-md-4">
                               <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteReview"><i class="far fa-trash-alt mr-2"></i>Delete Review</button>
                            </div>
                        </div>
                        @endif

                    </div>

                </div>
            </div>
        </div>
    </div>

</div> {{-- End of Main Container --}}

<!-- Modal -->
<div class="modal fade" id="deleteReview" tabindex="-1" role="dialog" aria-labelledby="deleteReview" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Review</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Do you really want to delete this review and all associated posts? Please note that this action can not be undone.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="{{route('review.delete',$current_post->review_id)}}" title="Delete Post" role="button" class="btn btn-danger mb-1"><i class="far fa-trash-alt mr-2"></i>Delete Review</a>
      </div>
    </div>
  </div>
</div>

@include('layout.footer')
@include('layout.end')