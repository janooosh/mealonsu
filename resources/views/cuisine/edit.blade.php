@include('layout.admin_header')
@include('layout.admin_top_navigation')
@include('layout.admin_navigation')

<div id="main">

    <div class="container mt-5">
        <div class="row p-3">
            <div class="col-md-8">
                <h1>Edit Cuisine</h1>
                <a href="{{route('cuisines.index')}}" role="button" class="btn btn-outline-dark btn-sm"><i class="fas fa-arrow-left mr-2"></i>Go Back</a>
            </div>
        </div>
    </div>
    @include('components.messages')

    <div class="container">
        <div class="row p-3">
            <div class="col-md-12">
                <p>Please enter a new name for your cuisine.</p>
            </div>
        </div>
        <form  method="post" action="{{route('cuisines.update',$cuisine)}}">
            @csrf
            <input type="hidden" name="_method" value="put" />
            <div class="row p-3">
                <div class="col-md-12">
                    <label for="cuisine_name">Name*</label>
                    <input type="text" name="cuisine_name" class="form-control mb-2" value="{{$cuisine->name}}" placeholder="e.g. Burgers" required />
                </div>
            </div>

            <div class="row p-3">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-outline-success"><i class="fas fa-save mr-2"></i>Save Cuisine</button>
                </div>
            </div>
        </form>
    </div>



</div> {{-- End Main Div --}}


@include('layout.footer')
@include('layout.end')