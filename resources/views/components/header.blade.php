<header>
    <div class="logo">
        @php
            $logoUrl = (($showNavBtns ?? 'main') === 'main') ? '#hero' : route('home');
        @endphp
        
        <a href='{{ $logoUrl }}'>
            <img src="{{ Vite::asset('resources/images/logo-dark.webp') }}" alt="شعار المنصة" id="logo-img">
            <span>{{ $settings->platform_name }}</span>
        </a>
        
    </div>

    <div class="nav-buttons">
        {{-- أزرار الصفحة الرئيسية --}}
        @if(($showNavBtns ?? 'main') === 'main')
            @auth
                <button class="nav-btn" onclick="location.href='{{ route('account') }}'">
                    <i class="fas fa-user-cog"></i>
                    <span>إدارة الحساب</span>
                </button>

                <form action="{{ route('logout') }}" method="POST" style="display:inline">
                    @csrf
                    <button class="nav-btn logout">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>تسجيل الخروج</span>
                    </button>
                </form>
            @endauth
            @guest
                <button class="nav-btn" onclick="location.href='{{ route('login') }}'">
                    <i class="fas fa-sign-in-alt"></i>
                    <span>سجل الدخول</span>
                </button>

                <button class="nav-btn" onclick="location.href='{{ route('signup.showForm') }}'">
                    <i class="fas fa-user-plus"></i>
                    <span>إعمل حساب</span>
                </button>
            @endguest
        {{-- أزرار صفحة الحساب --}}
        @elseif(($showNavBtns ?? '') === 'account')
            <form action="{{ route('logout') }}" method="POST" style="display:inline">
                @csrf
                <button class="nav-btn logout">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>تسجيل الخروج</span>
                </button>
            </form>
        @endif

        {{-- Dark / Light Switch --}}
        <div class="light-switch">
            <label for="switch" class="switch">
                <input id="switch" type="checkbox" class="switch" {{ $darkMode ? 'checked' : '' }}/>
                <span class="slider"></span>
                <span class="decoration"></span>
            </label>
        </div>
    </div>
    {{-- Progress Bar --}}
    <div class="progress-container">
        <div class="progress-bar" id="progressBar"></div>
    </div>
</header>
