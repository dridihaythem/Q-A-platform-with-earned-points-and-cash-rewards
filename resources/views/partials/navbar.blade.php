<nav class="navbar navbar-expand-md bg-light py-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('questions.index') }}">
            إجابات
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa-solid fa-bars text-white"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-list"></i>
                        التصنيفات
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @foreach (\App\Models\Category::all() as $category)
                        <li>
                            <a class="dropdown-item" href="{{ route('category',$category->slug) }}">
                                {{ $category->title }}
                            </a>
                        </li>
                        @if(!$loop->last)
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </li>
                @auth
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('questions.create') }}">
                        <i class="fa-solid fa-circle-plus"></i>
                        إضافة سؤال
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('withdraw.index') }}">
                        <i class="fa-brands fa-paypal"></i>
                        طلبات سحب الرصيد
                    </a>
                </li>
                @endauth
            </ul>
            <form class="d-flex" method="get" action="{{ route('questions.index') }}" role="search">
                <input name="search" class="form-control" type="search" placeholder="أكتب ما تبحث عنه ..."
                    aria-label="Search" value="{{ request('search') }}">
                {{-- <button class="btn btn-outline-success" type="submit"><i class="fa-solid fa-magnifying-glass"></i>
                    البحث</button> --}}
            </form>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                @guest
                <li class="nav-item me-1 my-2 my-md-0">
                    <a class="nav-link btn btn-primary text-white rounded-4 px-3" href="{{ route('login') }}">
                        <i class="fa-solid fa-right-to-bracket"></i>
                        الدخول إلى حسابك
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-success text-white rounded-4 px-3" href="{{ route('register') }}">
                        <i class="fa-solid fa-user-plus"></i>
                        تسجيل حساب جديد
                    </a>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('notifications') }}">
                        <span class="position-relative">
                            <i class="fa-regular fa-bell fa-2x"></i>
                            @if(Auth::user()->notifications->where('seen',false)->count() > 0)
                            <span
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ Auth::user()->notifications->where('seen',false)->count() }}
                            </span>
                            @endif
                        </span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="badge text-bg-secondary">
                            {{ Auth::user()->points }} نقطة
                        </span>
                        <img class="rounded-circle" style="height:37px" src="{{ asset(Auth::user()->avatar) }}" alt="">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('profile') }}"><i
                                    class="fa-solid fa-circle-user"></i> الحساب</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        @if(Auth::user()->type == 'admin' || Auth::user()->type == 'moderator' )
                        <li><a class="dropdown-item" href="{{ route('admin.index') }}"><i
                                    class="fa-solid fa-circle-user"></i> لوحة التحكم</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        @endif
                        <li><a class="dropdown-item" href="{{ route('logout')}}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="nav-icon fa-solid fa-arrow-right-from-bracket"></i>
                                تسجيل الخروج</a></li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </ul>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
