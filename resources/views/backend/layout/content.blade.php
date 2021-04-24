<header class='mb-3'>
    <nav class="navbar navbar-expand navbar-light ">
        <div class="container-fluid">
            <a href="#" class="burger-btn d-block">
                <i class="bi bi-justify fs-3"></i>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    
                </ul>
                <div class="dropdown">
                    <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-menu d-flex">
                            <div class="user-name text-end me-3">
                                <h6 class="mb-0 text-gray-600">{{ucfirst(Auth::user()->name)}}</h6>
                                <p class="mb-0 text-sm text-gray-600">Administrator</p>
                            </div>
                            <div class="user-img d-flex align-items-center">
                                <div class="avatar avatar-md">
                                    <img src="{{asset('images/faces/1.jpg')}}">
                                </div>
                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                        <li>
                            <h6 class="dropdown-header">Hello, {{ucfirst(Auth::user()->name)}}!</h6>
                        </li>
                        @foreach(App\Menu::whereLetak(2)->get() as $menu)
                            <li>
                                <a class="dropdown-item" href="{{url($menu->link)}}">
                                    <i class="icon-mid {{$menu->icon}}"></i> {{$menu->nama_menu}}
                                </a>
                            </li>
                        @endforeach
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="icon-mid bi bi-box-arrow-left me-2"></i>Logout</a>
                        </li> 
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>
<div id="main-content">

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>@yield('title')</h3>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                @yield('isi')
            </div>
        </section>
        @yield('modal')
    </div>
</div>