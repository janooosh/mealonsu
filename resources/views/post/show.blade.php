<?php
use Carbon\Carbon;
?>
@include('layout.header')
@include('layout.navigation')
{{-- Header --}}
<div class="jumbotron shadow-sm" style="background: linear-gradient(rgba(0,0,0,.5), rgba(0,0,0,.2)), url('{{asset('images/restaurants/food.jpg')}}'); background-size:cover; background-attachment:fixed;">
    <div class="container text-white">
        <h1 class="display-3">{{$post->restaurant_name}}</h1>
        <p>{{$post->subtitle}}</p>
        @if($post->social_facebook)
            <a href="{{$post->social_facebook}}" title="Facebook Page of {{$post->restaurant_name}}" target="_blank"><i class="fab fa-facebook"></i></a>
        @endif
        @if($post->social_instagram)
            <a href="{{$post->social_instagram}}" title="Instagram Profile of {{$post->restaurant_name}}" target="_blank"><i class="fab fa-instagram"></i></a>
        @endif
        @if($post->social_twitter)
            <a href="{{$post->social_twitter}}" title="Twitter Feed of {{$post->restaurant_name}}" target="_blank"><i class="fab fa-twitter"></i></a>
        @endif
    </div>
</div>
@include('components.messages')

<div class="container mb-3">

    {{-- Main --}}
    <div class="row">
        {{-- Left Column --}}
        <div class="col-md-6">
            @foreach($post->cuisines as $cuisine) 
                <span class="border border-info rounded-lg pl-1 pr-1">{{$cuisine->name}}</span>
            @endforeach
            {{-- Opening Hours --}}
            <table class="table table-borderless table-sm">
                <thead>
                    <th scope="col">Opening Hours</th>
                    <th scope="col">from</th>
                    <th scope="col">to</th>
                </thead>
                <tbody>
                    @foreach($post->openings as $opening)
                    <tr>
                        <td>{{$opening['day']}}</td>
                        <td>{{$opening['from']}}</td>
                        <td>{{$opening['to']}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Infos --}}
            <div id="restaurant_infos">
                {{-- Vegan --}}
                <div class="row" style="color:{{$post->is_vegan?'green':'red'}};">
                    <div class="col-1" >
                        <i class="fas fa-seedling"></i>
                    </div>
                    <div class="col-11">
                        <p>
                        @if($post->is_vegan)
                            Offers vegan food
                        @else
                            Does not offer vegan food
                        @endif
                        </p>
                    </div>
                </div>

                {{-- Date --}}
                <div class="row" style="color:{{$post->is_date?'green':'red'}};">
                    <div class="col-1" >
                        <i class="fas fa-heart"></i>
                    </div>
                    <div class="col-11">
                        <p>
                        @if($post->is_date)
                            Suited for dates
                        @else
                            Not very suited for dates
                        @endif
                        </p>
                    </div>
                </div>
                {{-- Pricerange --}}
                <div class="row">
                    <div class="col-11">
                        <p>
                        A menu costs around 
                        <b>
                        @if($post->pricerange==1)
                        < 50
                        @elseif($post->pricerange==2)
                        50 - 100
                        @elseif($post->pricerange==3)
                        100 - 150
                        @else
                        > 150
                        @endif
                        </b>
                        DKK.
                        </p>
                    </div>
                </div>

            </div>

            {{-- Buttons --}}
            <div id="restaurant_buttons">
                @if($post->url_menu)
                    <a href="{{$post->url_menu}}" target="_blank" role="button" class="btn btn-outline-dark mr-4"><i class="fa fa-utensils mr-2"></i>Menu</a>
                @endif
                @if($post->url_reservation)
                    <a href="{{$post->url_reservation}}" target="_blank" role="button" class="btn btn-outline-dark mr-4"><i class="fa fa-ticket-alt mr-2"></i>Reservation</a>
                @endif
                @if($post->url_delivery)
                    <a href="{{$post->url_delivery}}" target="_blank" role="button" class="btn btn-outline-dark"><i class="fa fa-biking mr-2"></i>Delivery</a>
                @endif
            </div>

        </div>
        {{-- Map --}}
        <div class="col-md-6">

                @include('components.map.show')
                {{--<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2249.5505644667724!2d12.531604716109225!3d55.679415205116946!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x465253bc8f589777%3A0x1e7e22f569fd25c2!2sShakedown+Burger+%26+Shakes!5e0!3m2!1sde!2sdk!4v1562746098919!5m2!1sde!2sdk" width="600" height="450" style="border:0" allowfullscreen></iframe> --}}
                    <p class="mt-2 text-center" >{{$post->place_adress}}</p>
        </div>
    </div>
</div> {{-- Ende dieses Containers --}}

<div class="container-fluid mb-3 p-3 " style="background-color:inherit;">
    <div class="container">
        {{-- Headline --}}
        <div class="row pb-3">
            <div class="col-md-12">
                <blockquote class="blockquote">{!!$post->summary!!}</blockquote>
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
            {!! $post->review_food !!}
        </p>
        <hr />
        <h3>Style, Location & Interior</h3>
        <p class="pb-4 text-justify">
            {!! $post->review_style !!}
        </p>
        <hr />
        <h3>Service</h3>
        <p class="pb-4 text-justify">
            {!! $post->review_service !!}
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
            <div class="col-10">
                <h5>{{$post->author->firstname.' '.$post->author->lastname}}</h5>
                <p>Published on {{Carbon::parse($post->updated_at)->format('d.m.y, h:i')}}</p>
                
            </div>
        </div>

    </div>
</div> {{-- End of Container --}}
@include('components.newsletter')
@include('layout.footer')
@include('layout.end')