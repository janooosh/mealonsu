<nav class="navbar navbar-expand-xl navbar-light bg-light">
  <a class="navbar-brand pt-2 pb-2" href="{{route('home')}}"><h3>MEALONSU</h3></a>
  {{-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button> --}}
  <div class="collapse navbar-collapse ml-3" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="{{route('home')}}">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('about-us')}}">About Us</a>
      </li>
      {{--<li class="nav-item">
        <a class="nav-link" href="#">Contact</a>
      </li> --}}
    </ul>
    {{-- <span class="navbar-text">
      <a class="nav-link" href="/login">Login</a>
    </span> --}}
  </div>
</nav>