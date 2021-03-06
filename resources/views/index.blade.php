<?php

use Carbon\carbon;
use App\Http\Controllers\HomeController;
?>

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
<script async src="{{asset('js/filtersubmit.js')}}"></script>

{{-- Header --}}
<div class="jumbotron shadow-sm" style="background: linear-gradient(rgba(0,0,0,.5), rgba(0,0,0,.2)), url('{{asset('images/header.jpg')}}'); background-size:cover; background-position: center center; background-attachment:fixed;">
    <div class="container text-white">
        <h1 class="display-3">Discover Your Taste!</h1>
    </div>
</div>

@include('components.messages')
{{-- Main Container --}}
<form method="post" action="{{route('filter.post')}}">
    @csrf
    <div class="container-fluid mb-5">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">

                <div class="row">
                    {{-- Left Column: Filter --}}
                    <div class="col-md-3">
                        {{-- Filter / Cuisine Section --}}
                        <div class="mb-4" id="filter_cuisine">
                            <h4><i class="fas fa-cookie-bite mr-2"></i> Cuisine</h4>
                            <div class="mb-1 p-3 shadow-sm" style="background-color: white;">

                                {{-- Top Results--}}
                                @foreach($top_cuisines as $cuisine)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{$cuisine->id}}" id="c{{$cuisine->id}}" name="cuisine[]" {{$display_filter->contains('cuisine',$cuisine->id)?'checked':''}}>
                                    <label class="form-check-label" for="c{{$cuisine->id}}">
                                        {{$cuisine->name}} ({{count($cuisine->posts)}})
                                    </label>
                                </div>
                                @endforeach
                                {{-- All the others--}}
                                <hr />
                                <a data-toggle="collapse" href="#collapseCuisines" aria-expanded="false" aria-controls="collapseCuisines">Show more <i class="fas fa-chevron-down"></i></a>

                                <div class="collapse" id="collapseCuisines">
                                    @foreach($other_cuisines as $cuisine)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="{{$cuisine->id}}" id="c{{$cuisine->id}}" name="cuisine[]" {{$display_filter->contains('cuisine',$cuisine->id)?'checked':''}}>
                                        <label class="form-check-label" for="c{{$cuisine->id}}">
                                            {{$cuisine->name}} ({{count($cuisine->posts)}})
                                        </label>
                                    </div>
                                    @endforeach
                                </div>


                            </div>
                        </div>

                        {{-- Filter / Price --}}
                        <div class="mb-4" id="filter_price">
                            <h4><i class="fas fa-coins mr-2"></i> Price</h4>

                            <div class="mb-1 p-3 shadow-sm" style="background-color: white;">
                                <select name="price" class="browser-default custom-select">
                                    <option value="0">Choose A Pricerange</option>
                                    <option value="2" {{$display_filter->contains('pricerange',2)?'selected':''}}> < 100 DKK
                                    </option>
                                    <option value="3" {{$display_filter->contains('pricerange',3)?'selected':''}}> 100 - 150 DKK</option>
                                    <option value="4" {{$display_filter->contains('pricerange',4)?'selected':''}}> 150 - 200 DKK</option>
                                    <option value="5" {{$display_filter->contains('pricerange',5)?'selected':''}}> 200 - 250 DKK</option>
                                </select>
                            </div>
                        </div>


                        {{-- Filter / Noise --}}
                        <div class="mb-4" id="filter_noise">
                            <h4><i class="fas fa-bullhorn mr-2"></i> Noise Level</h4>

                            <div class="mb-1 p-3 shadow-sm" style="background-color: white;">
                                <select name="noise" class="browser-default custom-select">
                                    <option value="0">Choose An Option</option>
                                    <option value="1" {{$display_filter->contains('noise',1)?'selected':''}}> Low</option>
                                    <option value="2" {{$display_filter->contains('noise',2)?'selected':''}}> Medium</option>
                                    <option value="3" {{$display_filter->contains('noise',3)?'selected':''}}> High</option>
                                </select>
                            </div>
                        </div>


                        {{-- Filter / District --}}
                        <div class="mb-4" id="filter_price">
                            <h4><i class="fas fa-city mr-2"></i> District</h4>

                            <div class="mb-1 p-3 shadow-sm" style="background-color: white;">
                                <select name="district" class="browser-default custom-select">
                                    <option value="">Choose An Option</option>
                                    <option value="Amager" {{$display_filter->contains('district','Amager')?'selected':''}}>Amager</option>
                                    <option value="Frederiksberg" {{$display_filter->contains('district','Frederiksberg')?'selected':''}}>Frederiksberg</option>
                                    <option value="Indre By" {{$display_filter->contains('district','Indre By')?'selected':''}}>Indre By</option>
                                    <option value="Nordvest" {{$display_filter->contains('district','Nordvest')?'selected':''}}>Nordvest</option>
                                    <option value="Nørrebro" {{$display_filter->contains('district','Nørrebro')?'selected':''}}>Nørrebro</option>
                                    <option value="Østerbro" {{$display_filter->contains('district','Østerbro')?'selected':''}}>Østerbro</option>
                                    <option value="Sydhavn" {{$display_filter->contains('district','Sydhavn')?'selected':''}}>Sydhavn</option>
                                    <option value="Valby" {{$display_filter->contains('district','Valby')?'selected':''}}>Valby</option>
                                    <option value="Vanløse" {{$display_filter->contains('district','Vanløse')?'selected':''}}>Vanløse</option>
                                    <option value="Vesterbro" {{$display_filter->contains('district','Vesterbro')?'selected':''}}>Vesterbro</option>
                                </select>
                            </div>
                        </div>


                        {{-- Filter / Options --}}
                        <div class="mb-4" id="filter_options">
                            <h4><i class="fas fa-sliders-h mr-2"></i> Options</h4>
                            <div class="mb-1 p-3 shadow-sm" style="background-color: white;">
                                @if(HomeController::filter_available('is_vegetarian'))
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="is_vegetarian" name="is_vegetarian" value="1" {{$display_filter->contains('is_vegetarian',true)?'checked':''}}>
                                    <label class="custom-control-label" for="is_vegetarian">Vegetarian Options</label>
                                </div>
                                @endif
                                @if(HomeController::filter_available('is_date'))
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="is_date" name="is_date" value="1" {{$display_filter->contains('is_date',true)?'checked':''}}>
                                    <label class="custom-control-label" for="is_date">Date Friendly</label>
                                </div>
                                @endif
                                @if(HomeController::filter_available('is_transport'))
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="is_transport" name="is_transport" value="1" {{$display_filter->contains('is_transport',true)?'checked':''}}>
                                    <label class="custom-control-label" for="is_transport">Close to public transport</label>
                                </div>
                                @endif
                                @if(HomeController::filter_available('is_groups'))
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="is_groups" name="is_groups" value="1" {{$display_filter->contains('is_groups',true)?'checked':''}}>
                                    <label class="custom-control-label" for="is_groups">Suited for groups</label>
                                </div>
                                @endif
                                @if(HomeController::filter_available('is_studying'))
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="is_studying" name="is_studying" value="1" {{$display_filter->contains('is_studying',true)?'checked':''}}>
                                    <label class="custom-control-label" for="is_studying">Suited for studying</label>
                                </div>
                                @endif
                                @if(HomeController::filter_available('is_outside'))
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="is_outside" name="is_outside" value="1" {{$display_filter->contains('is_outside',true)?'checked':''}}>
                                    <label class="custom-control-label" for="is_outside">Outside Area</label>
                                </div>
                                @endif
                                @if(HomeController::filter_available('is_takeawayonly'))
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="is_takeawayonly" name="is_takeawayonly" value="1" {{$display_filter->contains('is_takeawayonly',true)?'checked':''}}>
                                    <label class="custom-control-label" for="is_takeawayonly">Takeaway Only</label>
                                </div>
                                @endif
                                @if(HomeController::filter_available_value('url_delivery'))
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="is_delivery" name="is_delivery" value="1" {{$display_filter->contains('is_delivery',true)?'checked':''}}>
                                    <label class="custom-control-label" for="is_delivery">Delivery Service</label>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="m-2" id="reset_filter">
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="/" role="button" class="btn btn-primary">Reset Filter</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Right Column: Results view --}}
                    <div class="col-md-9">
                        {{-- Results for Restaurant --}}
                        <div id="restaurant_results">
                            {{-- Search Field --}}
                            <div class="row">
                                <div class="col-md-11">
                                    <input type="text" class="form-control mb-3" id="search_title" name="search_title" value="{{$search_title}}" placeholder="Search...">
                                </div>
                                {{-- SORTER - Still To-Do --}}
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-dark" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-sort"></i>
                                    </button>

                                    <div name="sorter" class="dropdown-menu">
                                        <button class="dropdown-item" type="submit" name="sort_name">Name</button>
                                        <button class="dropdown-item" type="submit" name="sort_creation">Creation</button>
                                        <button class="dropdown-item" type="submit" name="sort_pricerange">Pricerange</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-11">
                                    @if(count($posts)<1) <p>We are sorry, there are no restaurants matching your selection criteria.</p>
                                        @else
                                        <p>{{count($posts)}} results.
                                            @endif
                                </div>
                            </div>

                            {{-- Actual Results --}}

                            {{-- Adsense --}}
                            {{--<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                            <!-- HeaderAd_SearchResults -->
                            <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-9983146452317820" data-ad-slot="7586675356" data-ad-format="auto" data-full-width-responsive="true"></ins>
                            <script>
                                (adsbygoogle = window.adsbygoogle || []).push({});
                            </script> --}}
                            <style>
                                figure {
                                    margin: 5px !important;
                                }

                                .img-fluid {
                                    max-width: 100%;
                                    height: auto;
                                    margin: auto;
                                }

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
                            <div class="list-group">
                                @foreach($posts as $post)
                                <a href="{{route('posts.show',$post)}}" class="list-group-item list-group-item-action mb-1 shadow-sm">
                                    <div class="row">
                                        <div class="col-3 col-md-2" style="margin-top:-3px!important">
                                            <figure>
                                                @if($post->img_logo)
                                                <img src="{{ url('images/'.$post->img_logo)}}" style="max-height:100%;" class="img-fluid" />
                                                @else
                                                <img src="{{ asset('images/restaurants/food.jpg')}}" style="max-height:100%;" class="img-fluid" />
                                                @endif
                                            </figure>
                                        </div>
                                        <div class="col-6 col-md-8">
                                            <h5>{{$post->restaurant_name}}</h5>
                                            <p class="font-weight-lighter m-0">
                                                @foreach($post->cuisines as $cuisine)
                                                <span class="border border-info rounded-lg pl-1 pr-1">{{$cuisine->name}}</span>
                                                @endforeach
                                            </p>
                                            <p class="font-weight-lighter m-0 hide-mobile">{{$post->place_adress}}</p>
                                        </div>
                                        <div class="col-3 col-md-2 text-right">
                                            <span class="font-weight-lighter">
                                                {{$post->pricerange-1}} x <i class="fas fa-coins"></i>
                                            </span>

                                        </div>
                                    </div>
                                </a>
                                @endforeach
                                {{-- The following will display the pagination --}}

                                {{-- $posts->links() --}}

                            </div>




                        </div> {{-- End of Restaurant Results--}}
                    </div> {{-- End of Main Column Right --}}
                </div> {{-- End of Row --}}

            </div>
            <div class="col-md-2">
                <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- SidebarAd_OverviewAndRestaurants -->
                <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-9983146452317820" data-ad-slot="7906578860" data-ad-format="auto" data-full-width-responsive="true"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </div>
        </div>
    </div> {{-- End of Main Container --}}
</form>


@include('components.newsletter')
@include('layout.footer')
@include('layout.end')