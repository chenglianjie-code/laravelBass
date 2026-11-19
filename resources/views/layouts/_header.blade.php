<nav class="navbar" aria-label="主导航">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">LaraBBS</a>

    <div class="navbar-collapse" id="navbarSupportedContent">
      {{-- // @guest 是 Laravel Blade 的身份判断指令，表示“当前访客还没有登录”。 --}}
      @guest
        <ul class="navbar-nav navbar-right">
          <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">登录</a></li>
          <li class="nav-item"><a class="nav-link nav-register" href="{{ route('register') }}">注册</a></li>
        </ul>
      @else
        <ul class="navbar-nav navbar-right">
          <li class="nav-item">
            <details class="nav-user dropdown">
              <summary class="nav-link dropdown-toggle" id="navbarDropdown">
                @if (Auth::user()->avatar_url)
                  <img class="nav-avatar-image" src="{{ Auth::user()->avatar_url }}" alt="">
                @else
                  <span class="nav-avatar" aria-hidden="true">{{ mb_substr(Auth::user()->name, 0, 1) }}</span>
                @endif
                <span class="nav-user-name">{{ Auth::user()->name }}</span>
                <span class="nav-user-chevron" aria-hidden="true"></span>
              </summary>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{route('users.show',Auth::user())}}">个人中心</a>
                <a class="dropdown-item" href="{{route('users.edit',Auth::id())}}">编辑资料</a>
                <div class="dropdown-divider"></div>
                <form class="dropdown-logout" action="{{ route('logout') }}" method="POST">
                  @csrf
                  <button class="dropdown-item nav-logout" id="logout" type="submit">退出登录</button>
                </form>
              </div>
            </details>
          </li>
        </ul>
      @endguest
    </div>
  </div>
</nav>
