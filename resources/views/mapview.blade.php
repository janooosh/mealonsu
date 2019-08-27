@include('layout.header')
@include('layout.navigation')

<style>
    .list-group-item {
        height: 8em; // this is it

        img {
            object-fit: cover;
        }
    }
</style>

{{-- Header --}}
<div class="jumbotron shadow-sm" style="background: linear-gradient(rgba(0,0,0,.5), rgba(0,0,0,.2)), url('{{asset('images/header.jpg')}}'); background-size:cover; background-position: center center; background-attachment:fixed;">
    <div class="container text-white">
        <h1 class="display-3">Discover Your Taste!</h1>
    </div>
</div>

{{-- Main Container --}}
<div class="container mb-5" id="main">
    <div class="row">
        {{-- Left Column: Filter --}}
        <div class="col-md-3">
            {{-- Filter / Cuisine Section --}}
            <div class="mb-4" id="filter_cuisine">
                <h4><i class="fas fa-cookie-bite mr-2"></i> Cuisine</h4>
                <div class="container mb-1 p-3 shadow-sm" style="background-color: white;">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" checked>
                        <label class="form-check-label" for="defaultCheck1">
                            All
                        </label>
                    </div>
                    <hr />
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                        <label class="form-check-label" for="defaultCheck1">
                            American
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                        <label class="form-check-label" for="defaultCheck1">
                            Mexican
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                        <label class="form-check-label" for="defaultCheck1">
                            Italian
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                        <label class="form-check-label" for="defaultCheck1">
                            Kebab
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                        <label class="form-check-label" for="defaultCheck1">
                            Sweet
                        </label>
                    </div>
                </div>
            </div>

            {{-- Filter / Price --}}
            <div class="mb-4" id="filter_price">
                <h4><i class="fas fa-coins mr-2"></i> Price</h4>
                <div class="container mb-1 p-3 shadow-sm" style="background-color: white;">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" checked>
                        <label class="form-check-label" for="defaultCheck1">
                            All
                        </label>
                    </div>
                    <hr />
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                        <label class="form-check-label" for="defaultCheck1">
                            €
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                        <label class="form-check-label" for="defaultCheck1">
                            €€
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                        <label class="form-check-label" for="defaultCheck1">
                            €€€
                        </label>
                    </div>
                </div>
            </div>

            {{-- Filter / Options --}}
            <div class="mb-4" id="filter_options">
                <h4><i class="fas fa-sliders-h mr-2"></i> Options</h4>
                <div class="container mb-1 p-3 shadow-sm" style="background-color: white;">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="customSwitch1">
                        <label class="custom-control-label" for="customSwitch1">Open Now</label>
                    </div>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="customSwitch2">
                        <label class="custom-control-label" for="customSwitch2">Vegan Friendly</label>
                    </div>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="customSwitch3">
                        <label class="custom-control-label" for="customSwitch3">Delivery Service</label>
                    </div>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="customSwitch4">
                        <label class="custom-control-label" for="customSwitch4">Menu Available</label>
                    </div>
                </div>
            </div>


            {{-- Filter / Rating
            <div class="mb-4" id="filter_rating">
                <h4><i class="fas fa-star mr-2"></i> Ratings</h4>
                <div class="container mb-1 p-3 shadow-sm" style="background-color: white;">
                    <label for="customRange1">Food Quality</label>
                    <input type="range" class="custom-range" min="0" max="5" id="customRange1">
                    <label for="customRange2">Style, Location & Interior</label>
                    <input type="range" class="custom-range" min="0" max="5" id="customRange2">
                    <label for="customRange3">Service</label>
                    <input type="range" class="custom-range" min="0" max="5" id="customRange3">
                </div>
            </div> --}}



        </div>

        {{-- Right Column: Results view --}}
        <div class="col-md-9">
            <div class="embed-fluid">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d62242.62183154793!2d12.525284795115242!3d55.6741495101088!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sde!2sde!4v1563205671428!5m2!1sde!2sde" width="900" height="600" frameborder="0" style="border:0; width: 100%;" allowfullscreen></iframe>
            </div>
        </div> {{-- End of Main Column Right --}}
    </div> {{-- End of Row --}}
</div> {{-- End of Main Container --}}


@include('components.newsletter')
@include('layout.footer')
@include('layout.end')