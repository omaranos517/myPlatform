<header>
    <div class="logo">
        <img src="{{ asset('images/logo-dark.png') }}" alt="شعار المنصة" id="logo-img">
        @if (($showNavBtns ?? 'main') === 'main')
            <a href='#hero'>{{ $settings->platform_name }}</a>
        @else
            <a href="{{ route('home')}}">{{ $settings->platform_name }}</a>
        @endif
    </div>

    <div class="nav-buttons">
        {{-- أزرار الصفحة الرئيسية --}}
        @if(($showNavBtns ?? 'main') === 'main')
            @auth
                <button class="nav-btn" onclick="location.href='{{ route('account') }}'">
                    <i class="fas fa-user-cog"></i> إدارة الحساب
                </button>

                <form action="{{ route('logout') }}" method="POST" style="display:inline">
                    @csrf
                    <button class="nav-btn logout">
                        <i class="fas fa-sign-out-alt"></i> تسجيل الخروج
                    </button>
                </form>
            @endauth
            @guest
                <button class="nav-btn" onclick="location.href='{{ route('login') }}'">
                    <i class="fas fa-sign-in-alt"></i> تسجيل دخول
                </button>

                <button class="nav-btn" onclick="location.href='{{ route('signup.showForm') }}'">
                    <i class="fas fa-user-plus"></i> إنشاء حساب
                </button>
            @endguest
        {{-- أزرار صفحة الحساب --}}
        @elseif(($showNavBtns ?? '') === 'account')
            <form action="{{ route('logout') }}" method="POST" style="display:inline">
                @csrf
                <button class="nav-btn logout">
                    <i class="fas fa-sign-out-alt"></i> تسجيل الخروج
                </button>
            </form>
        @endif

        {{-- Dark / Light Switch --}}
        <div class="light-switch">
            <label for="switch" class="switch">
                <input id="switch" type="checkbox" class="switch"/>
                <span class="slider"></span>
                <span class="decoration"></span>
            </label>
        </div>
    </div>
</header>

{{-- Progress Bar --}}
<div class="progress-container">
    <div class="progress-bar" id="progressBar"></div>
</div>