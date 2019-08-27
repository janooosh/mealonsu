@include('layout.admin_header')
@include('layout.admin_top_navigation')
@include('layout.admin_navigation')
<div id="main">
    <div class="container mt-5">
        <div class="row p-3">
            <div class="col-md-12">
                <h1>New Review</h1>
            </div>
        </div>
    </div>
    @include('components.messages')

    <form method="POST" action="{{route('posts.store')}}">
        @csrf

        {{-- <div class="container">
            <div class="row">
                <div class="col-md-6"> --}}
        {{-- Section General --}}
        <div class="container mt-1">
            <h4 class="pl-3">Genearal</h4>
            <div class="row p-3" id="general_restaurant">

                <div class="col-md-3">
                    <div class="@error('restaurant_name') is-invalid @enderror">
                        Restaurant Name *
                    </div>
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control @error('restaurant_name') is-invalid @enderror" name="restaurant_name" value="{{old('restaurant_name')}}" placeholder="Restaurant Name" required />
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
                    <input type="text" class="form-control @error('subtitle') is-invalid @enderror" name="subtitle" value="{{old('subtitle')}}" placeholder="Subtitle" />
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
        <input type="text" class="form-control @error('url_homepage') is-invalid @enderror" name="url_homepage" value="{{old('url_homepage')}}" placeholder="Homepage URL" />
        @error('url_homepage')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>
    {{-- </div>
            </div>
        </div> --}}
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                @include('components.map.create')
                <input type="hidden" class="form-control" id="place_location" name="place_location" value="">
                <input type="hidden" class="form-control" id="place_adress" name="place_adress" value="">
                <input type="hidden" class="form-control" id="place_name" name="place_name" value="">
                <input type="hidden" class="form-control" id="place_icon" name="place_icon" value="">


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
                            <input type="time" name="mo_from" class="form-control @error('mo_from') is-invalid @enderror" min="00:00" max="24:00" value="{{old('mo_from')}}" placeholder="hh:mm" />
                            @error('mo_from')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </td>
                        <td>
                            <input type="time" name="mo_to" class="form-control @error('mo_to') is-invalid @enderror" min="00:00" max="24:00" value="{{old('mo_to')}}" placeholder="hh:mm" />
                            @error('mo_to')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </td>
                        <td>
                            <input type="checkbox" name="mo_closed" class="form-control-input @error('mo_closed') is-invalid @enderror" value="1" {{old('mo_closed')==1?'checked':''}}>
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
                            <input type="time" name="tu_from" class="form-control @error('tu_from') is-invalid @enderror" min="00:00" max="24:00" value="{{old('tu_from')}}" placeholder="hh:mm" />
                            @error('tu_from')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </td>
                        <td>
                            <input type="time" name="tu_to" class="form-control @error('tu_to') is-invalid @enderror" min="00:00" max="24:00" value="{{old('tu_to')}}" placeholder="hh:mm" />
                            @error('tu_to')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </td>
                        <td>
                            <input type="checkbox" name="tu_closed" class="form-control-input @error('tu_closed') is-invalid @enderror" value="1" {{old('tu_closed')==1?'checked':''}}>
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
                            <input type="time" name="we_from" class="form-control @error('we_from') is-invalid @enderror" min="00:00" max="24:00" value="{{old('we_from')}}" placeholder="hh:mm" />
                            @error('we_from')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </td>
                        <td>
                            <input type="time" name="we_to" class="form-control @error('we_to') is-invalid @enderror" min="00:00" max="24:00" value="{{old('we_to')}}" placeholder="hh:mm" />
                            @error('we_to')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </td>
                        <td>
                            <input type="checkbox" name="we_closed" class="form-control-input @error('we_closed') is-invalid @enderror" value="1" {{old('we_closed')==1?'checked':''}}>
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
                            <input type="time" name="th_from" class="form-control @error('th_from') is-invalid @enderror" min="00:00" max="24:00" value="{{old('th_from')}}" placeholder="hh:mm" />
                            @error('th_from')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </td>
                        <td>
                            <input type="time" name="th_to" class="form-control @error('th_to') is-invalid @enderror" min="00:00" max="24:00" value="{{old('th_to')}}" placeholder="hh:mm" />
                            @error('th_to')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </td>
                        <td>
                            <input type="checkbox" name="th_closed" class="form-control-input @error('th_closed') is-invalid @enderror" value="1" {{old('th_closed')==1?'checked':''}}>
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
                            <input type="time" name="fr_from" class="form-control @error('fr_from') is-invalid @enderror" min="00:00" max="24:00" value="{{old('fr_from')}}" placeholder="hh:mm" />
                            @error('fr_from')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </td>
                        <td>
                            <input type="time" name="fr_to" class="form-control @error('fr_to') is-invalid @enderror" min="00:00" max="24:00" value="{{old('fr_to')}}" placeholder="hh:mm" />
                            @error('fr_to')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </td>
                        <td>
                            <input type="checkbox" name="fr_closed" class="form-control-input @error('fr_closed') is-invalid @enderror" value="1" {{old('fr_closed')==1?'checked':''}}>
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
                            <input type="time" name="sa_from" class="form-control @error('sa_from') is-invalid @enderror" min="00:00" max="24:00" value="{{old('sa_from')}}" placeholder="hh:mm" />
                            @error('sa_from')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </td>
                        <td>
                            <input type="time" name="sa_to" class="form-control @error('sa_to') is-invalid @enderror" min="00:00" max="24:00" value="{{old('sa_to')}}" placeholder="hh:mm" />
                            @error('sa_to')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </td>
                        <td>
                            <input type="checkbox" name="sa_closed" class="form-control-input @error('sa_closed') is-invalid @enderror" value="1" {{old('sa_closed')==1?'checked':''}}>
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
                            <input type="time" name="so_from" class="form-control @error('so_from') is-invalid @enderror" min="00:00" max="24:00" value="{{old('so_from')}}" placeholder="hh:mm" />
                            @error('so_from')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </td>
                        <td>
                            <input type="time" name="so_to" class="form-control @error('so_to') is-invalid @enderror" min="00:00" max="24:00" value="{{old('so_to')}}" placeholder="hh:mm" />
                            @error('so_to')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </td>
                        <td>
                            <input type="checkbox" name="so_closed" class="form-control-input @error('so_closed') is-invalid @enderror" value="1" {{old('so_closed')==1?'checked':''}}>
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

{{-- Pricerange --}}
<div class="container">
<div class="row">
    <div class="col-md-12 pl-3">
    <h4>Price for one meal</h4>
        <div class="form-check form-check-inline">
            <input class="form-check-input" id="price1" type="checkbox" name="price[]" value="1">
            <label class="form-check-label" for="price1"> < 50 DKK</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" id="price2" type="checkbox" name="price[]" value="2">
            <label class="form-check-label" for="price2"> 50 - 100 DKK</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" id="price3" type="checkbox" name="price[]" value="3">
            <label class="form-check-label" for="price3"> 100 - 150 DKK</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" id="price4" type="checkbox" name="price[]" value="4">
            <label class="form-check-label" for="price4"> > 150 DKK</label>
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
                <input class="form-check-input" id="c{{$cuisine->id}}" type="checkbox" name="cuisine[]" value="{{$cuisine->id}}">
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
    <div class="row">
        <div class="col-md-6">

            {{-- <div class="row p-3" id="options_price">
                <div class="col-md-3">
                    Price Range *
                </div>
                <div class="col-md-9">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input @error('pricerange') is-invalid @enderror" type="radio" name="pricerange" value="1" id="pricerange_1" {{old('pricerange')==1?'checked':''}}>
            <label class="form-check-label" for="exampleRadios2">
                €
            </label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input @error('pricerange') is-invalid @enderror" type="radio" name="pricerange" id="pricerange_2" value="2" {{old('pricerange')==2?'checked':''}}>
            <label class="form-check-label" for="exampleRadios2">
                €€
            </label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input @error('pricerange') is-invalid @enderror" type="radio" name="pricerange" id="pricerange_3" value="3" {{old('pricerange')==3?'checked':''}}>
            <label class="form-check-label" for="exampleRadios2">
                €€€
            </label>
        </div>
        @error('pricerange')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>
</div> --}}

<div class="row p-3" id="options_vegetarian">
    <div class="col-md-3">
        Vegetarian-Friendly
    </div>
    <div class="col-md-9">
        <div class="form-check form-check-inline">
            <input class="form-check-input @error('is_vegetarian') is-invalid @enderror" type="checkbox" name="is_vegetarian" value="1" {{old('is_vegetarian')==1?'checked':''}}>
            @error('is_vegetarian')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
    </div>
</div>
<div class="row p-3" id="options_vegan">
    <div class="col-md-3">
        Vegan-Friendly
    </div>
    <div class="col-md-9">
        <div class="form-check form-check-inline">
            <input class="form-check-input @error('is_vegan') is-invalid @enderror" type="checkbox" name="is_vegan" value="1" {{old('is_vegan')==1?'checked':''}}>
            @error('is_vegan')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
    </div>
</div>
<div class="row p-3" id="options_date">
    <div class="col-md-3">
        Suited For Dates
    </div>
    <div class="col-md-9">
        <div class="form-check form-check-inline">
            <input class="form-check-input @error('is_date') is-invalid @enderror" type="checkbox" name="is_date" value="1" {{old('is_date')==1?'checked':''}}">
            @error('is_date')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
    </div>
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
            <input type="text" name="social_facebook" class="form-control @error('social_facebook') is-invalid @enderror" placeholder="Facebook Page URL" value="{{old('social_facebook')}}" />
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
            <input type="text" name="social_instagram" class="form-control @error('social_instagram') is-invalid @enderror" placeholder="Instagram Profile URL" value="{{old('social_instagram')}}" />
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
            <input type="text" name="social_twitter" class="form-control @error('social_twitter') is-invalid @enderror" placeholder="Twitter Feed URL" value="{{old('social_twitter')}}" />
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
            <textarea class="@error('summary') is-invalid @enderror" name="summary">{{old('summary')}}</textarea>
            @error('summary')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
    </div>

    {{-- Section Food Review --}}
    <h4 class="pl-3">Food Quality</h4>
    <div class="row p-3" id="review_food">
        <div class="col-md-12">
            <textarea class="@error('review_food') is-invalid @enderror" name="review_food">{{old('review_food')}}</textarea>
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
            <textarea class="@error('review_style') is-invalid @enderror" name="review_style">{{old('review_style')}}</textarea>
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
            <textarea class="@error('review_service') is-invalid @enderror" name="review_service">{{old('review_service')}}</textarea>
            @error('review_service')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
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

</div> {{-- End Div Main --}}



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