<nav class="navbar" aria-label="主导航">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">LaraBBS</a>

    <div class="navbar-collapse" id="navbarSupportedContent">
      @php
        $isTopicsSection = request()->routeIs('topics.*');
        $activeCategoryId = request()->routeIs('categories.show') ? ($category->id ?? null) : null;
        $navCategories = [1 => '分享', 2 => '教程', 3 => '问答', 4 => '公告'];
      @endphp

      <ul class="navbar-nav navbar-main-nav">
        <li class="nav-item">
          <a
            class="nav-link"
            href="{{ route('topics.index') }}"
            @if ($isTopicsSection)
              aria-current="{{ request()->routeIs('topics.index') ? 'page' : 'true' }}"
            @endif
          >话题</a>
        </li>
        @foreach ($navCategories as $categoryId => $label)
          <li class="nav-item">
            <a
              class="nav-link"
              href="{{ route('categories.show', $categoryId) }}"
              @if ($activeCategoryId === $categoryId) aria-current="page" @endif
            >{{ $label }}</a>
          </li>
        @endforeach
      </ul>

      @guest
        <ul class="navbar-nav navbar-right">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">登录</a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-register" href="{{ route('register') }}">注册</a>
          </li>
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
                <a class="dropdown-item" href="{{ route('users.show', Auth::user()) }}">个人中心</a>
                <a class="dropdown-item" href="{{ route('users.edit', Auth::id()) }}">编辑资料</a>
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
