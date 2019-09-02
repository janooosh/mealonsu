@include('layout.admin_header')
@include('layout.admin_top_navigation')
@include('layout.admin_navigation')

<div id="main">
    <form method="POST" action="{{route('users.update',$user)}}">
        @csrf
        <input type="hidden" name="_method" value="put" />
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-8">
                    <h1>{{$user->firstname.' '.$user->lastname}}</h1>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    Member since {{$user->created}}
                </div>
            </div>
        </div>
        @include('components.messages')
        <div class="container mt-5">
            <div class="row pb-3" id="firstname">
                <div class="col-md-3">
                    <label for="firstname">Firstname</label>
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control @error('firstname') is-invalid @enderror" id="firstname" name="firstname" value="{{old('firstname', $user->firstname)}}" placeholder="Firstname" />
                    @error('firstname')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="row pb-3" id="lastname">
                <div class="col-md-3">
                    <label for="lastname">Lastname</label>
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control @error('lastname') is-invalid @enderror" id="lastname" name="lastname" value="{{old('lastname', $user->lastname)}}" placeholder="Lastname" />
                    @error('lastname')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="row pb-3" id="lastname">
                <div class="col-md-3">
                    <label for="email">E-Mail Adress</label>
                </div>
                <div class="col-md-9">
                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{old('email', $user->email)}}" placeholder="E-Mail Adress" />
                    @error('email')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            {{-- <div class="row pb-3" id="password">
            <div class="col-md-3">
                <label for="password">Password</label>
            </div>
            <div class="col-md-9">
                <button id="password" type="button" class="btn btn-dark btn-round"><i class="fas fa-lock mr-2"></i>Reset Password</button>
            </div>
        </div> --}}
        </div>
        
        @if($user->isUserAdmin)
        <hr />
        <div class="container" id="admin_settings">
            <div class="row pb-2">
                <h3>Admin-Settings</h3>
            </div>
            <div class="row pb-3" id="lastname">
                <div class="col-md-3">
                    <label for="roles">Roles</label>
                </div>
                <div class="col-md-9">
                    @foreach($roles as $role)
                    <div id="roles" class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{$role->id}}" id="r{{$role->id}}" name="role[]" @if(!old('role') && $user->roles->contains($role))
                        checked
                        @elseif(old('role') && $user->roles->contains($role))
                        checked
                        @endif
                        >
                        <label class="form-check-label" for="r{{$role->id}}">
                            {{$role->name}}
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    Posts
                </div>
                <div class="col-md-9">
                    {{$user->firstname}} has published {{count($user->reviews)}} Reviews.
                </div>
            </div>
        </div>
        @endif

        <div class="container mt-4">
            <div class="row">
                <input type="submit" name="action" class="btn btn-success" value="Save" />
            </div>
        </div>

    </form>
</div> {{-- End Main Div --}}


@include('layout.footer')
@include('layout.end')