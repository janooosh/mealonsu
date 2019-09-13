@include('layout.admin_header')
@include('layout.admin_top_navigation')
@include('layout.admin_navigation')
<div id="main">
    <div class="container mt-5">
        <div class="row p-3">
            <div class="col-md-12">
                <h1>Edit Review</h1>
            </div>
        </div>
    </div>
    @include('components.messages')

    <form method="POST" action="{{route('posts.update',$post)}}" enctype="multipart/form-data">

        @csrf
        <input type="hidden" name="_method" value="put" />
        {{-- Section General --}}
        <div class="container mt-1">
            <h4 class="pl-3">General</h4>
            <div class="row p-3" id="general_restaurant">

                <div class="col-md-3">
                    <div class="@error('restaurant_name') is-invalid @enderror">
                        Restaurant *
                    </div>
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control @error('restaurant_name') is-invalid @enderror" name="restaurant_name" value="{{old('restaurant_name', $post->restaurant_name)}}" placeholder="Restaurant Name" required />
                    @error('restaurant_name')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="row p-3" id="general_subtitle">
                <div class="col-md-3">
                    Subtitle
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control @error('subtitle') is-invalid @enderror" name="subtitle" value="{{old('subtitle', $post->subtitle)}}" placeholder="Subtitle" />
                    @error('subtitle')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>

            {{-- <div class="row p-3" id="general_seo">
                <div class="col-md-3">
                    SEO-friendly URL
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control @error('seo') is-invalid @enderror" name="seo" value="{{old('seo')}}" placeholder="/for-example-like-this" />
            @error('seo')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
</div> --}}

<div class="row p-3" id="general_homepage">
    <div class="col-md-3">
        Homepage URL
    </div>
    <div class="col-md-9">
        <input type="text" class="form-control @error('url_homepage') is-invalid @enderror" name="url_homepage" value="{{old('url_homepage', $post->url_homepage)}}" placeholder="Homepage URL" />
        @error('url_homepage')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>
</div>
<div class="row p-3" id="general_district">
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-3">
                District
            </div>
            <div class="col-md-9">
                <select name="district" class="browser-default custom-select">
                    <option>Choose An Option</option>
                    <option value="Amager" {{$post->district=='Amager'?'selected':''}}>Amager</option>
                    <option value="Frederiksberg" {{$post->district=='Frederiksberg'?'selected':''}}>Frederiksberg</option>
                    <option value="Indre By" {{$post->district=='Indre By'?'selected':''}}>Indre By</option>
                    <option value="Nordvest" {{$post->district=='Nordvest'?'selected':''}}>Nordvest</option>
                    <option value="Nørrebro" {{$post->district=='Nørrebro'?'selected':''}}>Nørrebro</option>
                    <option value="Østerbro" {{$post->district=='Østerbro'?'selected':''}}>Østerbro</option>
                    <option value="Sydhavn" {{$post->district=='Sydhavn'?'selected':''}}>Sydhavn</option>
                    <option value="Valby" {{$post->district=='Valby'?'selected':''}}>Valby</option>
                    <option value="Valby" {{$post->district=='Vanløse'?'selected':''}}>Vanløse</option>
                    <option value="Vesterbro" {{$post->district=='Vesterbro'?'selected':''}}>Vesterbro</option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-3">
                Noise Level
            </div>
            <div class="col-md-9">
                <select name="noise" class="browser-default custom-select">
                    <option value="0">Choose An Option</option>
                    <option value="1" {{$post->noise=='1'?'selected':''}}>Low</option>
                    <option value="2" {{$post->noise=='2'?'selected':''}}>Medium</option>
                    <option value="3" {{$post->noise=='3'?'selected':''}}>High</option>
                </select>
            </div>
        </div>
    </div>
</div>
</div>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                <h4 class="pl-3">Edit Location</h4>
                <p>The following location is currently selected. </p>
                <h5 class="font-weight-600 text-xl-left">{{$post->place_name}}, {{$post->place_adress}}</b></h5>
                <p>To change it, please enter a new location. </p>
                @include('components.map.create')
                <input type="hidden" class="form-control" id="place_location" name="place_location" value="{{$post->place_location}}">
                <input type="hidden" class="form-control" id="place_adress" name="place_adress" value="{{$post->place_adress}}">
                <input type="hidden" class="form-control" id="place_name" name="place_name" value="{{$post->place_name}}">
                <input type="hidden" class="form-control" id="place_icon" name="place_icon" value="{{$post->place_icon}}">
            </div>
        </div>
    </div>
</div>
</div>
<hr />
{{-- Opening Hours --}}
<div class="container mt-1 p-3">
    <div class="row">
        <div class="col-md-12">
            <h4 class="pl-3">Opening Hours</h4>
            <table class="table table-sm m-3">
                <thead>
                    <tr>
                        <th scope="col">Day</th>
                        <th scope="col">From</th>
                        <th scope="col">To</th>
                        <th scope="col">Closed</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Monday</th>
                        <td>
                            <input type="time" name="mo_from" class="form-control @error('mo_from') is-invalid @enderror" min="00:00" max="24:00" value="{{old('mo_from', $post->mo_from)}}" placeholder="hh:mm" />
                            @error('mo_from')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </td>
                        <td>
                            <input type="time" name="mo_to" class="form-control @error('mo_to') is-invalid @enderror" min="00:00" max="24:00" value="{{old('mo_to', $post->mo_to)}}" placeholder="hh:mm" />
                            @error('mo_to')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </td>
                        <td>
                            <input type="checkbox" name="mo_closed" class="form-control-input @error('mo_closed') is-invalid @enderror" value="1" {{ old('mo_closed', $post->mo_closed) != '0' ? 'checked' : '' }}>
                            @error('mo_closed')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Tuesday</th>
                        <td>
                            <input type="time" name="tu_from" class="form-control @error('tu_from') is-invalid @enderror" min="00:00" max="24:00" value="{{old('tu_from', $post->tu_from)}}" placeholder="hh:mm" />
                            @error('tu_from')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </td>
                        <td>
                            <input type="time" name="tu_to" class="form-control @error('tu_to') is-invalid @enderror" min="00:00" max="24:00" value="{{old('tu_to', $post->tu_to)}}" placeholder="hh:mm" />
                            @error('tu_to')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </td>
                        <td>
                            <input type="checkbox" name="tu_closed" class="form-control-input @error('tu_closed') is-invalid @enderror" value="1" {{ old('tu_closed', $post->tu_closed) != '0' ? 'checked' : '' }}>
                            @error('tu_closed')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Wednesday</th>
                        <td>
                            <input type="time" name="we_from" class="form-control @error('we_from') is-invalid @enderror" min="00:00" max="24:00" value="{{old('we_from', $post->we_from)}}" placeholder="hh:mm" />
                            @error('we_from')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </td>
                        <td>
                            <input type="time" name="we_to" class="form-control @error('we_to') is-invalid @enderror" min="00:00" max="24:00" value="{{old('we_to', $post->we_to)}}" placeholder="hh:mm" />
                            @error('we_to')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </td>
                        <td>
                            <input type="checkbox" name="we_closed" class="form-control-input @error('we_closed') is-invalid @enderror" value="1" {{ old('we_closed', $post->we_closed) != '0' ? 'checked' : '' }}>
                            @error('we_closed')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Thursday</th>
                        <td>
                            <input type="time" name="th_from" class="form-control @error('th_from') is-invalid @enderror" min="00:00" max="24:00" value="{{old('th_from', $post->th_from)}}" placeholder="hh:mm" />
                            @error('th_from')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </td>
                        <td>
                            <input type="time" name="th_to" class="form-control @error('th_to') is-invalid @enderror" min="00:00" max="24:00" value="{{old('th_to', $post->th_to)}}" placeholder="hh:mm" />
                            @error('th_to')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </td>
                        <td>
                            <input type="checkbox" name="th_closed" class="form-control-input @error('th_closed') is-invalid @enderror" value="1" {{ old('th_closed', $post->th_closed) != '0' ? 'checked' : '' }}>
                            @error('th_closed')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Friday</th>
                        <td>
                            <input type="time" name="fr_from" class="form-control @error('fr_from') is-invalid @enderror" min="00:00" max="24:00" value="{{old('fr_from', $post->fr_from)}}" placeholder="hh:mm" />
                            @error('fr_from')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </td>
                        <td>
                            <input type="time" name="fr_to" class="form-control @error('fr_to') is-invalid @enderror" min="00:00" max="24:00" value="{{old('fr_to', $post->fr_to)}}" placeholder="hh:mm" />
                            @error('fr_to')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </td>
                        <td>
                            <input type="checkbox" name="fr_closed" class="form-control-input @error('fr_closed') is-invalid @enderror" value="1" {{ old('fr_closed', $post->fr_closed) != '0' ? 'checked' : '' }}>
                            @error('fr_closed')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Saturday</th>
                        <td>
                            <input type="time" name="sa_from" class="form-control @error('sa_from') is-invalid @enderror" min="00:00" max="24:00" value="{{old('sa_from', $post->sa_from)}}" placeholder="hh:mm" />
                            @error('sa_from')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </td>
                        <td>
                            <input type="time" name="sa_to" class="form-control @error('sa_to') is-invalid @enderror" min="00:00" max="24:00" value="{{old('sa_to', $post->sa_to)}}" placeholder="hh:mm" />
                            @error('sa_to')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </td>
                        <td>
                            <input type="checkbox" name="sa_closed" class="form-control-input @error('sa_closed') is-invalid @enderror" value="1" {{ old('sa_closed', $post->sa_closed) != '0' ? 'checked' : '' }}>
                            @error('sa_closed')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Sunday</th>
                        <td>
                            <input type="time" name="so_from" class="form-control @error('so_from') is-invalid @enderror" min="00:00" max="24:00" value="{{old('so_from', $post->so_from)}}" placeholder="hh:mm" />
                            @error('so_from')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </td>
                        <td>
                            <input type="time" name="so_to" class="form-control @error('so_to') is-invalid @enderror" min="00:00" max="24:00" value="{{old('so_to', $post->so_to)}}" placeholder="hh:mm" />
                            @error('so_to')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </td>
                        <td>
                            <input type="checkbox" name="so_closed" class="form-control-input @error('so_closed') is-invalid @enderror" value="1" {{ old('so_closed', $post->so_closed) != '0' ? 'checked' : '' }}>
                            @error('so_closed')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<hr />
{{-- Price --}}
<div class="container">
    <div class="row">
        <div class="col-md-12 pl-3">
            <h4>Price for one meal</h4>
            <div class="form-check form-check-inline">
                    <input class="form-check-input" id="price1" type="radio" name="price" value="1" {{$post->pricerange=='1'?'checked':''}}>
                    <label class="form-check-label" for="price1">< 50 DKK</label> 
                </div> 
                <div class="form-check form-check-inline">
                    <input class="form-check-input" id="price2" type="radio" name="price" value="2" {{$post->pricerange=='2'?'checked':''}}>
                    <label class="form-check-label" for="price2"> 50 - 100 DKK</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" id="price3" type="radio" name="price" value="3" {{$post->pricerange=='3'?'checked':''}}>
                <label class="form-check-label" for="price3"> 100 - 150 DKK</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" id="price4" type="radio" name="price" value="4" {{$post->pricerange=='4'?'checked':''}}>
                <label class="form-check-label" for="price4"> 150 - 200 DKK</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" id="price5" type="radio" name="price" value="5" {{$post->pricerange=='5'?'checked':''}}>
                <label class="form-check-label" for="price5"> 200 - 250 DKK</label>
            </div>
        </div>
    </div>
</div>
<hr />
<div class="container mt-1 mb-3">
    {{-- Section Cuisines --}}
    <div class="row">
        <div class="col-md-12">
            <h4 class="pl-3">Cuisines</h4>
            <p>Please select at least one cuisine</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @foreach($cuisines as $cuisine)
            <div class="form-check form-check-inline">
                <input class="form-check-input" id="c{{$cuisine->id}}" type="checkbox" name="cuisine[]" value="{{$cuisine->id}}" @if(!old('cuisine') && in_array($cuisine->id,$cuisine_ids))
                checked
                @elseif(old('cuisine') && in_array($cuisine->id,old('cuisine')))
                checked
                @endif
                }}>
                <label class="form-check-label" for="c{{$cuisine->id}}">{{$cuisine->name}}</label>
            </div>
            @endforeach
        </div>
    </div>

</div>
<div class="container mt-1">
    {{-- Section Options --}}
    <div class="row">
        <div class="col-md-12">
            <h4 class="pl-3">Options</h4>
        </div>
    </div>
    <div class="row p-3">
        <div class="col-md-3">
            <div class="row p-3" id="options_vegetarian">
                <input class="form-check-input @error('is_vegetarian') is-invalid @enderror" type="checkbox" id="is_vegetarian" name="is_vegetarian" value="1" {{ old('is_vegetarian', $post->is_vegetarian) == '1' ? 'checked' : '' }}>
                <label class="form-check-label" for="is_vegetarian">Vegetarian Options</label>
                @error('is_vegetarian')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>

            <div class="row p-3" id="options_vegan">
                <input class="form-check-input @error('is_vegan') is-invalid @enderror" type="checkbox" id="is_vegan" name="is_vegan" value="1" {{ old('is_vegan', $post->is_vegan) == '1' ? 'checked' : '' }}>
                <label class="form-check-label" for="is_vegan">Vegan Options</label>
                @error('is_vegan')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>

            <div class="row p-3" id="options_takeawayonly">
                <input class="form-check-input @error('is_takeawayonly') is-invalid @enderror" type="checkbox" name="is_takeawayonly" value="1" {{ old('is_takeawayonly', $post->is_takeawayonly) == '1' ? 'checked' : '' }}>
                <label class="form-check-label" for="is_takeawayonly">Takeaway Only</label>
                @error('is_takeawayonly')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>

            <div class="row p-3" id="options_outside">
                <input class="form-check-input @error('is_outside') is-invalid @enderror" type="checkbox" id="is_outside" name="is_outside" value="1" {{ old('is_outside', $post->is_outside) == '1' ? 'checked' : '' }}>
                <label class="form-check-label" for="is_outside">Outside Area</label>
                @error('is_takeawayonly')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>
        {{-- Second Column --}}
        <div class="col-md-3">
            <div class="row p-3" id="options_date">
                <input class="form-check-input @error('is_date') is-invalid @enderror" type="checkbox" id="is_date" name="is_date" value="1" {{ old('is_date', $post->is_date) == '1' ? 'checked' : '' }}>
                <label class="form-check-label" for="is_date">Suited For Dates</label>

                @error('is_date')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>

            <div class="row p-3" id="options_transport">
                <input class="form-check-input @error('is_transport') is-invalid @enderror" type="checkbox" id="is_transport" name="is_transport" value="1" {{ old('is_transport', $post->is_transport) == '1' ? 'checked' : '' }}>
                <label class="form-check-label" for="is_transport">Public Transportation</label>
                @error('is_transport')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>

            <div class="row p-3" id="options_groups">
                <input class="form-check-input @error('is_groups') is-invalid @enderror" type="checkbox" id="is_groups" name="is_groups" value="1" {{ old('is_groups', $post->is_groups) == '1' ? 'checked' : '' }}>
                <label class="form-check-label" for="is_groups">Suited For Groups</label>

                @error('is_groups')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>

            <div class="row p-3" id="options_studying">
                <input class="form-check-input @error('is_studying') is-invalid @enderror" type="checkbox" id="is_studying" name="is_studying" value="1" {{ old('is_studying', $post->is_studying) == '1' ? 'checked' : '' }}>
                <label class="form-check-label" for="is_studying">Suited For Studying</label>

                @error('is_studying')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <div class="row p-3" id="options_menu">
                <div class="col-md-3">
                    Online Menu
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control @error('url_menu') is-invalid @enderror" name="url_menu" placeholder="Menu URL" value="{{old('url_menu')}}" />
                    @error('url_menu')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="row p-3" id="options_reservation">
                <div class="col-md-3">
                    Reservation Link
                </div>
                <div class="col-md-9">
                    <input type="text" name="url_reservation" class="form-control @error('url_reservation') is-invalid @enderror" placeholder="Reservation URL" value="{{old('url_reservation')}}" />
                    @error('url_reservation')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>

            <div class="row p-3" id="options_delivery">
                <div class="col-md-3">
                    Delivery Link
                </div>
                <div class="col-md-9">
                    <input type="text" name="url_delivery" class="form-control @error('url_delivery') is-invalid @enderror" placeholder="Delivery URL" value="{{old('url_delivery')}}" />
                    @error('url_delivery')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>

        </div>
    </div>
</div>

<hr />
{{-- Section Social --}}
<div class="container">
    <h4 class="pl-3">Social</h4>
    <div class="row p-3" id="social_facebook">

        <div class="col-md-3">
            Facebook
        </div>
        <div class="col-md-9">
            <input type="text" name="social_facebook" class="form-control @error('social_facebook') is-invalid @enderror" placeholder="Facebook Page URL" value="{{old('social_facebook', $post->social_facebook)}}" />
            @error('social_facebook')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
    </div>

    <div class="row p-3" id="social_instagram">
        <div class="col-md-3">
            Instagram
        </div>
        <div class="col-md-9">
            <input type="text" name="social_instagram" class="form-control @error('social_instagram') is-invalid @enderror" placeholder="Instagram Profile URL" value="{{old('social_instagram', $post->social_instagram)}}" />
            @error('social_instagram')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
    </div>

    <div class="row p-3" id="social_twitter">
        <div class="col-md-3">
            Twitter
        </div>
        <div class="col-md-9">
            <input type="text" name="social_twitter" class="form-control @error('social_twitter') is-invalid @enderror" placeholder="Twitter Feed URL" value="{{old('social_twitter', $post->social_twitter)}}" />
            @error('social_twitter')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
    </div>
</div>
<hr />
{{-- Section Reviews --}}
<div class="container">

    {{-- Section Short Sumnmary --}}
    <h4 class="pl-3">Short Summary</h4>
    <div class="row p-3" id="summary">
        <div class="col-md-12">
            <textarea class="@error('summary') is-invalid @enderror" name="summary">{{old('summary', $post->summary)}}</textarea>
            @error('summary')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
    </div>

    {{-- Section Food Review --}}
    <h4 class="pl-3">Food</h4>
    <div class="row p-3" id="review_food">
        <div class="col-md-12">
            <textarea class="@error('review_food') is-invalid @enderror" name="review_food">{{old('review_food', $post->review_food)}}</textarea>
            @error('review_food')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
    </div>

    {{-- Section Food Review --}}
    <h4 class="pl-3">Style, Location & Interior</h4>
    <div class="row p-3" id="review_style">
        <div class="col-md-12">
            <textarea class="@error('review_style') is-invalid @enderror" name="review_style">{{old('review_style', $post->review_style)}}</textarea>
            @error('review_style')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
    </div>

    {{-- Section Service --}}
    <h4 class="pl-3">Service</h4>
    <div class="row p-3" id="review_service">
        <div class="col-md-12">
            <textarea class="@error('review_service') is-invalid @enderror" name="review_service">{{old('review_service', $post->review_service)}}</textarea>
            @error('review_service')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
    </div>
</div>

{{-- Gallery --}}
<div class="container">
    {{-- Preview existing images --}}
    <div class="row mb-5 equal-height">
        <div class="col-md-8">
            Title Image
            @if($post->img_title)
            <div class="thumbnail">
                <img src="{{url('/images/'.$post->img_title)}}" class="img-fullsize" alt="Responsive image" data-gallery-src="{{url('images/'.$post->img_title)}}">
            </div>
            @endif
        </div>
        <div class="col-md-4">
            Logo / Index Image
            @if($post->img_logo)
            <div class="thumbnail">
                <img src="{{url('/images/'.$post->img_logo)}}" class="img-fullsize" alt="Responsive image" data-gallery-src="{{url('images/'.$post->img_logo)}}">
            </div>
            @endif
        </div>
    </div>
    <div class="row mb-5 equal-height">
        <div class="col-md-2">
            Image 1
            @if($post->img_1)
            <div class="thumbnail">
                <img src="{{url('/images/'.$post->img_1)}}" class="img-fullsize" alt="Responsive image" data-gallery-src="{{url('images/'.$post->img_1)}}">
            </div>
            @endif
        </div>
        <div class="col-md-2">
            Image 2
            @if($post->img_2)
            <div class="thumbnail">
                <img src="{{url('/images/'.$post->img_2)}}" class="img-fullsize" alt="Responsive image" data-gallery-src="{{url('images/'.$post->img_2)}}">
            </div>
            @endif
        </div>
        <div class="col-md-2">
            Image 3
            @if($post->img_3)
            <div class="thumbnail">
                <img src="{{url('/images/'.$post->img_3)}}" class="img-fullsize" alt="Responsive image" data-gallery-src="{{url('images/'.$post->img_3)}}">
            </div>
            @endif
        </div>
        <div class="col-md-2">
            Image 4
            @if($post->img_4)
            <div class="thumbnail">
                <img src="{{url('/images/'.$post->img_4)}}" class="img-fullsize" alt="Responsive image" data-gallery-src="{{url('images/'.$post->img_4)}}">
            </div>
            @endif
        </div>
        <div class="col-md-2">
            Image 5
            @if($post->img_5)
            <div class="thumbnail">
                <img src="{{url('/images/'.$post->img_5)}}" class="img-fullsize" alt="Responsive image" data-gallery-src="{{url('images/'.$post->img_5)}}">
            </div>
            @endif
        </div>
        <div class="col-md-2">
            Image 6
            @if($post->img_6)
            <div class="thumbnail">
                <img src="{{url('/images/'.$post->img_6)}}" class="img-fullsize" alt="Responsive image" data-gallery-src="{{url('images/'.$post->img_6)}}">
            </div>
            @endif
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-12">
            <p>To replace the above images, please upload new images in the according slots.</p>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4">
            <label class="form-check-label" for="img_1">Image 1</label>
            <input type="file" class="form-control-file" id="img_1" name="img_1">
        </div>
        <div class="col-md-4">
            <label class="form-check-label" for="img_2">Image 2</label>
            <input type="file" class="form-control-file" id="img_2" name="img_2">
        </div>
        <div class="col-md-4">
            <label class="form-check-label" for="img_3">Image 3</label>
            <input type="file" class="form-control-file" id="img_3" name="img_3">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label class="form-check-label" for="img_4">Image 4</label>
            <input type="file" class="form-control-file" id="img_4" name="img_4">
        </div>
        <div class="col-md-4">
            <label class="form-check-label" for="img_5">Image 5</label>
            <input type="file" class="form-control-file" id="img_5" name="img_5">
        </div>
        <div class="col-md-4">
            <label class="form-check-label" for="img_5">Image 6</label>
            <input type="file" class="form-control-file" id="img_6" name="img_6">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label class="form-check-label" for="img_title">Title Image</label>
            <input type="file" class="form-control-file" id="img_title" name="img_title">
        </div>
        <div class="col-md-4">
            <label class="form-check-label" for="img_title">Logo / Index Image</label>
            <input type="file" class="form-control-file" id="img_logo" name="img_logo">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <p>Pictures may not exceed 5 MB. The following file types are accepted: .jpeg, .jpg, .png, .svg.
        </div>
    </div>
</div>

<div class="container">
    <div class="row p-3">
        <div class="col-sm-2">
            <input type="submit" name="action" class="btn btn-outline-secondary" value="Draft" />
        </div>
        <div class="col-sm-2">
            <input type="submit" name="action" class="btn btn-outline-success" value="Publish" />
        </div>
    </div>
    @error('action')
    <div class="row">
        <div class="col-md-12">
            <div class="invalid-feedback">
                {{$message}}
            </div>
        </div>
    </div>
    @enderror


</div>

</form>

</div>

{{--
NOTES

What do we need here?

/Section: General
- Title                                     Textfield
- Subtitle                                  Textfield
- URL                                       Textfield [UNIQUE]
- *Adress                                    s. Google Maps 
- *Google Maps                               Google Maps Input [tba] 

/Section: Opening Hours
- Opening Hours                             Table

/Section: Options
- Cuisine[s]                                MODAL
- Price Range                               DropDown
- Vegan Friendly                            Y/N [6]
- Vegetarian Friendly                       Y/N [6]

/Section: Links
- Social Links: Homepage                    Textfield [12]
- Social Links: FB                          Textfield [12]
- Social Links: IG                          Textfield [12]
- Social Links: Twitter                     Textfield [12]
- Menu Link                                 Textfield [12]
- Reservation Link                          Textfield [12]
- Delivery Link                             Textfield [12]

/Section: Text Input
- First Paragraph                           Paragraph Input [12]
- Review: Quality                           Paragraph Input [12]
- Review: Style, Location & Interior        Paragraph Input [12]
- Review: Service                           Paragraph Input [12]

/Section: Images
- Header Picture                            Img Upload
- Gallery Pictures                          Img Upload(s)

--}}

@include('layout.footer')
@include('layout.end')