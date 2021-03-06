@include('layout.header')
@include('layout.navigation')
{{-- Header --}}
<div class="jumbotron shadow-sm" style="background: linear-gradient(rgba(0,0,0,.5), rgba(0,0,0,.2)), url('{{asset('images/restaurants/food.jpg')}}'); background-size:cover; background-attachment:fixed;">
    <div class="container text-white">
        <h1 class="display-3">Shakedown Burgers & Shakes</h1>
        <p>Fancy Burger Restaurant</p>
        <p>Musterstraße 23, 2033 København C</p>
        <i class="fab fa-facebook"></i>
        <i class="fab fa-instagram"></i>
        <i class="fab fa-twitter"></i>

    </div>
</div>

<div class="container mb-3">

    {{-- Main --}}
    <div class="row">
        {{-- Left Column --}}
        <div class="col-md-6">
            {{-- Opening Hours --}}
            <table class="table table-borderless table-sm">
                <thead>
                    <th scope="col">Opening Hours</th>
                    <th scope="col">from</th>
                    <th scope="col">to</th>
                </thead>
                <tbody>
                    <tr>
                        <td>Monday</td>
                        <td colspan="2">Closed</td>
                    </tr>
                    <tr>
                        <td>Tuesday - Thursday</td>
                        <td>18:00</td>
                        <td>00:00</td>
                    </tr>
                    <tr>
                        <td>Friday - Saturday</td>
                        <td>18:00</td>
                        <td>03:00</td>
                    </tr>
                    <tr>
                        <td>Sunday</td>
                        <td>18:00</td>
                        <td>23:00</td>
                    </tr>
                </tbody>
            </table>

            {{-- Infos --}}
            <div id="restaurant_infos">
                <p>More stuff to come soon!</p>
            </div>

            {{-- Buttons --}}
            <div id="restaurant_buttons">
                <button type="button" class="btn btn-outline-dark mr-4"><i class="fa fa-utensils mr-2"></i>Menu</button>
                <button type="button" class="btn btn-outline-dark mr-4"><i class="fa fa-ticket-alt mr-2"></i>Reservation</button>
                <button type="button" class="btn btn-outline-dark"><i class="fa fa-biking mr-2"></i>Delivery</button>
            </div>

        </div>
        {{-- Map --}}
        <div class="col-md-6">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2249.5505644667724!2d12.531604716109225!3d55.679415205116946!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x465253bc8f589777%3A0x1e7e22f569fd25c2!2sShakedown+Burger+%26+Shakes!5e0!3m2!1sde!2sdk!4v1562746098919!5m2!1sde!2sdk" width="600" height="450" style="border:0" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div> {{-- Ende dieses Containers --}}

<div class="container-fluid mb-3 p-3 " style="background-color:inherit;">
    <div class="container">
        {{-- Headline --}}
        <div class="row pb-3">
            <div class="col-md-12">
                <blockquote class="blockquote">We can have a great first impression paragraph here and there, it has a container, yeah!</blockquote>
            </div>
        </div>
    </div>
</div>

<div class="container">

{{-- Gallery --}}
<div class="row pb-5 equal-height">
    <div class="col-xs-4 col-md-2">
        <div class="thumbnail">
            <img src="{{ asset('images/restaurants/food.jpg')}}" class="img-fullsize" alt="Responsive image" data-gallery-src="{{asset('images/restaurants/food.jpg')}}">
        </div>
    </div>
    <div class="col-xs-4 col-md-2">
        <div class="thumbnail">
            <img src="{{ asset('images/restaurants/res-1.jpg')}}" class="img-fullsize" alt="Responsive image" data-gallery-src="{{ asset('images/restaurants/res-1.jpg')}}">
        </div>
    </div>
    <div class="col-xs-4 col-md-2">
        <div class="thumbnail">
            <img src="{{ asset('images/restaurants/res-2.jpg')}}" class="img-fullsize" alt="Responsive image" data-gallery-src="{{ asset('images/restaurants/res-2.jpg')}}">
        </div>
    </div>
    <div class="col-xs-4 col-md-2">
        <div class="thumbnail">
            <img src="{{ asset('images/restaurants/res-3.jpg')}}" class="img-fluid img-thumbnail" alt="Responsive image" data-gallery-src="{{ asset('images/restaurants/res-3.jpg')}}">
        </div>
    </div>
    <div class="col-xs-4 col-md-2">
        <div class="thumbnail">
            <img src="{{ asset('images/restaurants/res-4.jpg')}}" class="img-fluid img-thumbnail" alt="Responsive image" data-gallery-src="{{ asset('images/restaurants/res-4.jpg')}}">
        </div>
    </div>
    <div class="col-xs-4 col-md-2">
        <div class="thumbnail">
            <img src="{{ asset('images/restaurants/res-5.jpg')}}" class="img-fluid img-thumbnail" alt="Responsive image" data-gallery-src="{{ asset('images/restaurants/res-5.jpg')}}">
        </div>
    </div>
</div>

{{-- Review / Categories --}}
<div class="row">
    <div class="col-md-12">
        <h3>Food Quality</h3>
        <p class="pb-4 text-justify">
            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
        </p>
        <hr />
        <h3>Style, Location & Interior</h3>
        <p class="pb-4 text-justify">
            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
        </p>
        <hr />
        <h3>Service</h3>
        <p class="pb-4 text-justify">
            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
        </p>
    </div>
</div>

{{-- Review / Categories / accordion layout
    <div class="row">
        <div class="col-md-12">
            <div class="accordion" id="accordionExample">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Food Quality
                            </button>
                        </h2>
                    </div>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Style, Location & Interior
                            </button>
                        </h2>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Service
                            </button>
                        </h2>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                        <div class="card-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
</div> {{-- End Container --}}

{{-- Review / Author --}}
<div class="container-fluid pb-3" style="background-color:#f4f4f4;">
    <div class="container">
        <h3 class="pt-4">About the author </h3>
        <div class="row pt-3">
            <div class="col-2">
                <img src="{{ asset('images/usr/jan.jpg') }}" class="rounded-circle img-fluid">
            </div>
            <div class="col-10">
                <h5>Mark Dwain</h5>
                <p>Published on 23.06.2019 @ 11:13</p>
                <p class="font-italic">"Coffee, Code & Cookies"</p>
                <small>jan.haehl@restlix.com</small><br />
                <small>        <i class="fab fa-facebook"></i>
        <i class="fab fa-instagram"></i>
        <i class="fab fa-twitter"></i></small>
            </div>
        </div>

    </div>
</div> {{-- End of Container --}}
@include('components.newsletter')
@include('layout.footer')
@include('layout.end')