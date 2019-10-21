<?php

use Carbon\carbon;

?>

@include('layout.header')
@include('layout.navigation')
{{-- Header --}}
<style>
    @media (max-width: 767px) {
        .hide-mobile {
            display: none;
        }
    }

    @media (min-width: 768px) {
        .hide-desktop {
            display: none;
        }
    }
</style>
<div class="jumbotron shadow-sm" @if($post->img_title)
    style="background: linear-gradient(rgba(0,0,0,.5), rgba(0,0,0,.2)), url('{{url('images/'.$post->img_title)}}'); background-size:cover; background-attachment:fixed;"
    @else
    style="background: linear-gradient(rgba(0,0,0,.5), rgba(0,0,0,.2)), url('{{asset('images/restaurants/food.jpg')}}'); background-size:cover; background-attachment:fixed;"
    @endif
    >
    <div class="container text-white">
        <h1 class="display-3">{{$post->restaurant_name}}</h1>
        <p>{{$post->subtitle}}</p>
        @if($post->social_facebook)
        <h2><a href="{{$post->social_facebook}}" title="Facebook Page of {{$post->restaurant_name}}" target="_blank" rel="nofollow"><i class="fab fa-facebook"></i></a></h2>
        @endif
        @if($post->social_instagram)
        <h2><a href="{{$post->social_instagram}}" title="Instagram Profile of {{$post->restaurant_name}}" target="_blank" rel="nofollow"><i class="fab fa-instagram"></i></a></h2>
        @endif
        @if($post->social_twitter)
        <h2><a href="{{$post->social_twitter}}" title="Twitter Feed of {{$post->restaurant_name}}" target="_blank" rel="nofollow"><i class="fab fa-twitter"></i></a></h2>
        @endif
    </div>
</div>
@include('components.messages')

<div class="container-fluid" id="review_section">
    <div class="alert alert-info text-center" role="alert">
        <span>
            <p>You are reviewing this post. </p>
        </span>
        <a href="{{route('revisions.decline',$post)}}" role="button" style="color:white;" class="btn btn-danger">Decline</a>
        <a href="{{route('revisions.edit',$post)}}" role="button" class="btn btn-light">Edit</a>
        <a href="{{route('revisions.approve',$post)}}" role="button" style="color:white;" class="btn btn-success">Approve</a>
    </div>
</div>

<div class="container mb-3">

    {{-- Main --}}
    <div class="row">
        <div class="col-md-12">
            @foreach($post->cuisines as $cuisine)
            <span class="border border-info rounded-lg pl-1 pr-1">{{$cuisine->name}}</span>
            @endforeach
        </div>
    </div>
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

            <div class="row">
                    <div class="col-md-6">
                        {{-- Vegetarian --}}
                        @if($post->is_vegetarian)
                        <div class="row" style="color:green;">
                            <div class="col-1">
                                <i class="fas fa-seedling"></i>
                            </div>
                            <div class="col-11">
                                <p>
                                    Vegetarian Options
                                </p>
                            </div>
                        </div>
                        @endif

                        {{-- Vegan --}}
                        @if($post->is_vegan)
                        <div class="row" style="color:green;">
                            <div class="col-1">
                                <i class="fas fa-seedling"></i>
                            </div>
                            <div class="col-11">
                                <p>
                                    Vegan Options
                                </p>
                            </div>
                        </div>
                        @endif

                        {{-- Date --}}
                        @if($post->is_date)
                        <div class="row" style="color:{{$post->is_date?'green':'red'}};">
                            <div class="col-1">
                                <i class="fas fa-heart"></i>
                            </div>
                            <div class="col-11">
                                <p>     
                                    Suited for dates
                                </p>
                            </div>
                        </div>
                        @endif

                        {{-- Publit Transport --}}
                        @if($post->is_transport)
                        <div class="row" style="color:green;">
                            <div class="col-1">
                                <i class="fas fa-bus"></i>
                            </div>
                            <div class="col-11">
                                <p>
                                    Close to public transportation
                                </p>
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="col-md-6">

                        {{-- Groups --}}
                        @if($post->is_groups)
                        <div class="row" style="color:green;">
                            <div class="col-1">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="col-11">
                                <p>        
                                    Suited for Groups
                                </p>
                            </div>
                        </div>
                        @endif

                        {{-- Outdoor --}}
                        @if($post->is_outside)
                        <div class="row" style="color:green;">
                            <div class="col-1">
                                <i class="fas fa-sun"></i>
                            </div>
                            <div class="col-11">
                                <p>      
                                    Outdoor Area
                                </p>
                            </div>
                        </div>
                        @endif

                        {{-- Takeaway Only --}}
                        @if($post->is_takeawayonly)
                        <div class="row" style="color:green;">
                            <div class="col-1">
                                <i class="fas fa-shopping-bag"></i>
                            </div>
                            <div class="col-11">
                                <p>
                                    Takeaway Only
                                </p>
                            </div>
                        </div>
                        @endif

                        {{-- Studying  --}}
                        @if($post->is_studying)
                        <div class="row" style="color:green;">
                            <div class="col-1">
                                <i class="fas fa-book-reader"></i>
                            </div>
                            <div class="col-11">
                                <p>
                                    Suited for studying
                                </p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Pricerange --}}
                <div class="row">
                    <div class="col-11">
                        <p>
                            $
                            <b>
                                    @if($post->pricerange==2)
                                    < 100 
                                    @elseif($post->pricerange==3)
                                    100 - 150
                                    @elseif($post->pricerange==4)
                                    150 - 200
                                    @else
                                    200 - 250
                                    @endif
                            </b>
                            DKK.
                        </p>
                    </div>
                </div>
                {{-- Noise --}}
                <div class="row">
                    <div class="col-11">
                        <p>
                            Noise Level: 
                            <b>
                                @if($post->noise==1)
                                Low
                                @elseif($post->noise==2)
                                Medium
                                @elseif($post->noise==3)
                                High
                                @endif
                            </b>
                            
                        </p>
                    </div>
                </div>
                

            </div>

            {{-- Buttons --}}
            <div id="restaurant_buttons">
             @if($post->url_homepage)
                <a href="{{$post->url_homepage}}" target="_blank" role="button" class="btn btn-outline-dark mr-4"><i class="fa fa-home mr-2"></i>Homepage</a>
                @endif
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
            <p class="mt-2 text-left">{{$post->place_name}}, {{$post->place_adress}}</p>
            @if($post->district)
            <p>District: {{$post->district}}</p>
            @endif
            {{--<div class="embed-responsive embed-responsive-16by9">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2249.5505644667724!2d12.531604716109225!3d55.679415205116946!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x465253bc8f589777%3A0x1e7e22f569fd25c2!2sShakedown+Burger+%26+Shakes!5e0!3m2!1sde!2sdk!4v1562746098919!5m2!1sde!2sdk" width="600" height="450" style="border:0" allowfullscreen></iframe>
            </div> --}}
        </div>
    </div>
</div> {{-- Ende dieses Containers --}}

<div class="container-fluid mb-3 p-3 " style="background-color:inherit;">
    <div class="container">
        {{-- Headline --}}
        <div class="row pb-3">
            <div class="col-md-12">
                <h5><p class="font-weight-bold">{!!$post->summary!!}</p></h5>
            </div>
        </div>
    </div>
</div>

{{-- Mobile Gallery --}}
<div class="container hide-desktop">

    <div class="row text-center text-lg-left">

        @if($post->img_1)
        <div class="col-lg-3 col-md-4 col-6">
            <div class="d-block mb-4 h-100">
                <img class="img-fluid img-thumbnail" src="{{url('images/'.$post->img_1)}}" alt="">
            </div>
        </div>
        @endif
        @if($post->img_2)
        <div class="col-lg-3 col-md-4 col-6">
            <div class="d-block mb-4 h-100">
                <img class="img-fluid img-thumbnail" src="{{url('images/'.$post->img_2)}}" alt="">
            </div>
        </div>
        @endif
        @if($post->img_3)
        <div class="col-lg-3 col-md-4 col-6">
            <div class="d-block mb-4 h-100">
                <img class="img-fluid img-thumbnail" src="{{url('images/'.$post->img_3)}}" alt="">
            </div>
        </div>
        @endif
        @if($post->img_4)
        <div class="col-lg-3 col-md-4 col-6">
            <div class="d-block mb-4 h-100">
                <img class="img-fluid img-thumbnail" src="{{url('images/'.$post->img_4)}}" alt="">
            </div>
        </div>
        @endif
        @if($post->img_5)
        <div class="col-lg-3 col-md-4 col-6">
            <div class="d-block mb-4 h-100">
                <img class="img-fluid img-thumbnail" src="{{url('images/'.$post->img_5)}}" alt="">
            </div>
        </div>
        @endif
        @if($post->img_6)
        <div class="col-lg-3 col-md-4 col-6">
            <div class="d-block mb-4 h-100">
                <img class="img-fluid img-thumbnail" src="{{url('images/'.$post->img_6)}}" alt="">
            </div>
        </div>
        @endif

    </div>

</div>
<!-- /.container -->


{{-- Gallery --}}
<div class="container hide-mobile">
    <div class="row pb-5 equal-height">
        @if($post->img_1)
        <div class="col-xs-4 col-md-2">
            <div class="thumbnail">
                <img src="{{url('/images/'.$post->img_1)}}" class="img-fullsize" alt="Responsive image" data-gallery-src="{{url('images/'.$post->img_1)}}">
            </div>
        </div>
        @endif
        @if($post->img_2)
        <div class="col-xs-4 col-md-2">
            <div class="thumbnail">
                <img src="{{url('/images/'.$post->img_2)}}" class="img-fullsize" alt="Responsive image" data-gallery-src="{{url('images/'.$post->img_2)}}">
            </div>
        </div>
        @endif
        @if($post->img_3)
        <div class="col-xs-4 col-md-2">
            <div class="thumbnail">
                <img src="{{url('/images/'.$post->img_3)}}" class="img-fullsize" alt="Responsive image" data-gallery-src="{{url('images/'.$post->img_3)}}">
            </div>
        </div>
        @endif
        @if($post->img_4)
        <div class="col-xs-4 col-md-2">
            <div class="thumbnail">
                <img src="{{url('/images/'.$post->img_4)}}" class="img-fullsize" alt="Responsive image" data-gallery-src="{{url('images/'.$post->img_4)}}">
            </div>
        </div>
        @endif
        @if($post->img_5)
        <div class="col-xs-4 col-md-2">
            <div class="thumbnail">
                <img src="{{url('/images/'.$post->img_5)}}" class="img-fullsize" alt="Responsive image" data-gallery-src="{{url('images/'.$post->img_5)}}">
            </div>
        </div>
        @endif
        @if($post->img_6)
        <div class="col-xs-4 col-md-2">
            <div class="thumbnail">
                <img src="{{url('/images/'.$post->img_6)}}" class="img-fullsize" alt="Responsive image" data-gallery-src="{{url('images/'.$post->img_6)}}">
            </div>
        </div>
        @endif
    </div>
</div>

<div class="container">

    {{-- Review / Categories --}}
    <div class="row">
        <div class="col-md-12">
            <h3>Food</h3>
                {!! $post->review_food !!}
            <hr />
            <h3>Style, Location & Interior</h3>
                {!! $post->review_style !!}
            <hr />
            <h3>Service</h3>
                {!! $post->review_service !!}
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
                <h5>{{$post->author->firstname}}</h5>
                <p>Published on {{Carbon::parse($post->created_at)->format('d.m.y')}}</p>
            </div>
        </div>

    </div>
</div> {{-- End of Container --}}
@include('components.newsletter')
@include('layout.footer')
@include('layout.end')