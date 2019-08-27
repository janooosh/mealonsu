@include('layout.admin_header')
@include('layout.admin_top_navigation')
@include('layout.admin_navigation')

<div id="main">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8">
                <h1>Users</h1>
            </div>
            {{-- <div class="col-md-4 text-right">
                <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#cuisine_create"><i class="fas fa-plus-circle mr-2"></i>New Cuisine</button>
            </div> --}}
        </div>
    </div>
    @include('components.messages')

    <div class="container" id="cuisines">
        @if(count($users)<1) <p>No users found</p>
            @endif
            <table class="table table-hover table-sm">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Firstname</th>
                        <th scope="col">Lastname</th>
                        <th scope="col">E-Mail</th>
                        <th scope="col">Posts</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Group</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->firstname}}</td>
                        <td>{{$user->lastname}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{count($user->posts)}}</td>
                        <td><a role="button" class="btn btn-dark btn-round" href="{{route('users.profile', $user)}}">Edit</a></td>
                        <td>
                            @if(count($user->roles)==0)
                            -
                            @endif
                            @foreach($user->roles as $role)
                                <i class="{{$role->icon}}"></i>
                            @endforeach
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
    </div>

</div> {{-- End Main Div --}}


@include('layout.footer')
@include('layout.end')