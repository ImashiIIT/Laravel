<nav class="navbar navbar-expand-lg bg-body-tertiary shadow sticky-top">
    <div class="container">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="{{url('')}}">Home</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link active" href="{{url('/categories')}}">Categories</a>
                </li>
                <li class="nav-item">
                        <a class="nav-link active" href="{{url('/roles')}}">Roles</a>
                    </li>
                @guest
                    <li class="nav-item">
                        <a class="nav-link fw-bold" href="{{url('/login')}}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold" href="{{url('/register')}}">Register</a>
                    </li>
                    
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-bold" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{Auth::user()->name}}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="{{route('profile.edit')}}">Profile</a>
                            </li>
                            <li>
                                <form method="POST" action="{{route('logout')}}">
                                    @csrf
                                    <a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault(); this.closest('form').submit();">Log Out</a>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
