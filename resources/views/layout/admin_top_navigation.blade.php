<?php
use \App\Http\Controllers\UserController;
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand pt-2 pb-2" href="{{route('posts.index')}}"><h3>MEALONSU</h3></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse ml-3" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="{{route('posts.index')}}">My Reviews</a>
      </li>
      @if(UserController::hasRole(2))
      <li class="nav-item">
        <a class="nav-link" href="{{route('revisions.index')}}">Revisions</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('posts.all')}}">All Reviews</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('cuisines.index')}}">Cuisines</a>
      </li>
      @endif
      <li class="nav-item">
        <a class="nav-link" href="{{route('users.profile',auth()->user())}}">My Profile</a>
      </li>
      @if(UserController::isAdmin())
      <li class="nav-item">
        <a class="nav-link" href="{{route('users.index')}}">Users</a>
      </li>
     @endif 

    </ul>
    <span class="navbar-text">
      <div class="dropdown dropleft">
      <a class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      {{auth()->user()->firstname.' '.auth()->user()->lastname}}
</a>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
      <a class="dropdown-item" href="{{route('logout')}}" style="color:black;">Log-Out</a>
  </div>
      </div>

    </span>
  </div>
</nav>