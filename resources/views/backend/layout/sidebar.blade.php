<div class="sidebar-wrapper active">
  <div class="sidebar-header">
      <div class="d-flex justify-content-between">
          <div class="logo">
              <a href="index.html"><img src="{{asset('images/logo/logo.png')}}" alt="Logo" srcset=""></a>
          </div>
          <div class="toggler">
              <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
          </div>
      </div>
  </div>
  <div class="sidebar-menu">
      <ul class="menu">
          <li class="sidebar-title">Menu</li>
        @foreach(App\Menu::whereLetak(1)->get() as $menu)    
          <li class="sidebar-item">
              <a href="{{url($menu->link)}}" class='sidebar-link'>
                  <i class="{{$menu->icon}}"></i>
                  <span>{{$menu->nama_menu}}</span>
              </a>
          </li>
        @endforeach
      </ul>
  </div>
  <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
</div>