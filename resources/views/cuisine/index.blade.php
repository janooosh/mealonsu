@include('layout.admin_header')
@include('layout.admin_top_navigation')
@include('layout.admin_navigation')

<div id="main">

    <div class="container mt-5">
        <div class="row p-3">
            <div class="col-md-8">
                <h1>Cuisines</h1>
            </div>
            <div class="col-md-4 text-right">
                <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#cuisine_create"><i class="fas fa-plus-circle mr-2"></i>New Cuisine</button>
            </div>
        </div>
    </div>
    @include('components.messages')

    <div class="container" id="cuisines">
        @if(count($cuisines)<1) <p>No cuisines found</p>
            @endif
            <table class="table table-hover table-sm">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Overview</th>
                        <th scope="col">Edit</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($cuisines as $cuisine)
                    <tr>
                        <td>{{$cuisine->id}}</td>
                        <td>{{$cuisine->name}}</td>
                        <td>{{count($cuisine->posts)}} posts</td>
                        <td><a href="{{route('cuisines.edit',$cuisine)}}" role="button" class="btn btn-outline-dark btn-sm"><i class="fas fa-pen-square mr-2"></i>Edit</button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
    </div>

</div> {{-- End Main Div --}}

{{-- MODALS --}}

{{-- Create Modal --}}
<div class="modal fade" id="cuisine_create" tabindex="-1" role="dialog" aria-labelledby="cuisine_create" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{route('cuisines.store')}}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="cuisine_create">Create Cuisine</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Please specify the name of your new cuisine.</p>
                    <label for="cuisine_name">Name *</label>
                    <input class="form-control" type="text" id="cuisine_name" name="cuisine_name" value="" placeholder="e.g. Burgers" required />

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-success"><i class="fas fa-save mr-2"></i>Create Cuisine</button>
                </div>
            </form>
        </div>
    </div>
</div>


@include('layout.footer')
@include('layout.end')