<!-- start header -->
<div class="header text-center py-3">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1">
                <a href="/home"><img src="{{ asset('app-assets/images/logo8.png') }}"></a>

            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-5">
                {{-- <form class="form-inline">
                    <input class="form-control mr-sm-2" type="search" placeholder="ابحث هنا"
                        aria-label="Search">
                    <button class="btn  my-2 my-sm-0" type="submit">بحث</button>
                </form> --}}

                <form action="{{ route('/home/pops_search') }}" method="get" class="form-inline">
                    {{ method_field('patch') }}
                    @csrf
                    <input type="text" name="keyword" class="form-control mr-sm-2 search1" placeholder="ابحث هنا"
                        aria-label="Search">

                    <button type="submit" class="btn  my-2 my-sm-0  search2">{{ __('بــحــث') }}</button>
                </form>





            </div>
            <div class="col-xs-12 col-sm-12 col-md-5 col-lg-6">
                <div class="row">
                    <div class="col-6">
                        @auth
                            <a href="{{ route('logout') }}" style="color: black"
                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                {{ __('Sidebar_trans.Logoff') }} <i class="fas fa-sign-out-alt"></i></a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        @endauth

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                                <ul>
                                    <li>
                                        @guest
                                            <a href="" data-toggle="modal" data-target="#sign_in"
                                                title="{{ trans('تسجيل دخول') }}"><i class="far fa-user"></i> تسجيل الدخول
                                            </a>
                                        @endguest

                                        <!-- تـسـجـيـل الـدخـول -->
                                        <div class="modal fade" id="sign_in" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="display: unset !important">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close" style="float: left">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <h5 style="font-family: 'Cairo', sans-serif; margin-top=50px"
                                                            class="modal-title text-right" id="exampleModalLabel">
                                                            {{ trans('تـسـجـيـل دخـول') }}
                                                        </h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- add_form -->
                                                        <form method="POST" action="{{ route('login') }}">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-md-12 make-space">
                                                                    <input id="email" type="email"
                                                                        style=" width: 100%; height: calc(1.5em + 1.75rem + 2px);  margin-top: 25px;"
                                                                        class="form-control @error('email') is-invalid @enderror"
                                                                        name="email" placeholder="الـبـريـد الالـكـتـرونـي"
                                                                        value="{{ old('email') }}" required
                                                                        autocomplete="email" autofocus
                                                                        style=" height: calc(1.5em + 1.75rem + 2px); margin-top: 25px;">
                                                                    @error('email')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>

                                                                <div class="col-md-12 make-space">
                                                                    <input id="password" type="password"
                                                                        style=" width: 100%; height: calc(1.5em + 1.75rem + 2px);  margin-top: 25px;"
                                                                        class="form-control @error('password') is-invalid @enderror"
                                                                        name="password" placeholder="كـلـمـة الـمـرور" required
                                                                        autocomplete="current-password"
                                                                        style=" height: calc(1.5em + 1.75rem + 2px); margin-top: 25px;">
                                                                    @error('password')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <button type="submit" class="text-center"
                                                                style="padding: 10px 40px;margin-top: 33px;color: white;background-color: orange;border-style: none;">
                                                                {{ trans('تـسـجـيـل') }}
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                                @guest
                                   <a href="" data-toggle="modal" data-target="#sign_up" style="color: black"
                                        title="{{ trans('تسجيل') }}"> <i class="fas fa-user-plus"></i> تسجيل
                                    </a>
                                @endguest

                                <!-- تـسـجـيـل الـدخـول -->
                                <div class="modal fade" id="sign_up" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header" style="display: unset !important">
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close" style="float: left">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <h5 style="font-family: 'Cairo', sans-serif; margin-top=50px"
                                                    class="modal-title text-right" id="exampleModalLabel">
                                                    {{ trans('تـسـجـيـل ') }}
                                                </h5>
                                            </div>
                                            <div class="modal-body">
                                                <!-- add_form -->
                                                <form method="POST" action="{{ route('register') }}"
                                                    enctype="multipart/form-data" autocomplete="off">
                                                    @csrf
                                                    <input id="name" type="text"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        name="name" value="{{ old('name') }}" required
                                                        autocomplete="name" autofocus placeholder="اســم الـمـسـتـخـدم"
                                                        style=" width: 100%; height: calc(1.5em + 1.75rem + 2px);  margin-top: 25px;">
                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror

                                                    <input id="email" type="email"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        name="email" value="{{ old('email') }}" required
                                                        autocomplete="email" placeholder="الـبـريـد الالـكـتـرونـي"
                                                        style=" width: 100%; height: calc(1.5em + 1.75rem + 2px);  margin-top: 25px;">
                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror

                                                    <input id="password" type="password"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        name="password" required autocomplete="new-password"
                                                        placeholder="كـلـمـة الـمـرور"
                                                        style=" width: 100%; height: calc(1.5em + 1.75rem + 2px);  margin-top: 25px;">
                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror

                                                    <input id="password-confirm" type="password" class="form-control"
                                                        name="password_confirmation" required
                                                        autocomplete="new-password"
                                                        placeholder="تـأكـيـد كـلـمـة الـمـرور"
                                                        style=" width: 100%; height: calc(1.5em + 1.75rem + 2px);  margin-top: 25px;">

                                                    <input id="image" type="file"
                                                        class="form-control @error('image') is-invalid @enderror"
                                                        name="image"
                                                        style=" width: 100%; height: calc(1.5em + 1.75rem + 2px);  margin-top: 25px;">
                                                    @error('image')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror

                                                    <div class="text-center">
                                                        <button class="text-center"
                                                            style="padding: 10px 40px;margin-top: 33px;color: white;background-color: orange;border-style: none;"
                                                            type="submit">{{ __('تـسـجـيـل') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <ul>
                            {{-- <li>
                                <a href="/home/shopping_basket_empty">فارفة <i class="fas fa-shopping-cart"></i></a>
                            </li> --}}
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="    background-color: #fec111; color:black;">
                                    عربة تسوق
                                </button >
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="/home/show_shopping_basket">عربة مشترياتي</a>
                                    <a class="dropdown-item" href="/home/shopping_basket/check_my_order">متابعة طلباتي</a>
                                </div>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
<!-- end header -->


<!-- start menu -->
<div class="menu ">

    <nav class="navbar navbar-expand-lg navbar-light bg-light">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse text-right" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        اسم الفئات
                    </a>
                    <?php $categories = \App\Models\Category::where('status', '0')->get(); ?>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @foreach ($categories as $category)
                            <a class="dropdown-item"
                                href="/home/category/{{ $category->id }}">{{ $category->name }}</a>
                        @endforeach
                    </div>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="/home">الرئيسية <span class="sr-only">(current)</span></a>
                </li>

                @foreach ($categories as $category)
                    <li class="nav-item">
                        <a class="nav-link" href="/home/category/{{ $category->id }}">{{ $category->name }}</a>
                    </li>
                @endforeach

                <li class="nav-item">
                    <a class="nav-link" href="/home/contactus">تواصل معنا</a>
                </li>
            </ul>
        </div>
    </nav>
</div>
<!-- end menu -->


<!-- User Sign In -->
<div class="modal fade" id="sign_in" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <h5 style="font-family: 'Cairo', sans-serif; margin-top=50px" class="modal-title make_right_ar"
                        id="exampleModalLabel">
                        {{ trans('front_trans.Sign In') }}
                    </h5>
                    <div class="col-md-12 make-space">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" placeholder="{{ trans('contactus_trans.email') }}"
                            value="{{ old('email') }}" required autocomplete="email" autofocus
                            style=" height: calc(1.5em + 1.75rem + 2px); margin-top: 25px;">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-md-12 make-space">
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password"
                            placeholder="{{ trans('contactus_trans.password') }}" required
                            autocomplete="current-password"
                            style=" height: calc(1.5em + 1.75rem + 2px); margin-top: 25px;">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="text-center"
                        style="margin-left: 170px;padding: 10px 40px;margin-top: 33px;color: white;background-color: orange;border-style: none;">
                        {{ trans('front_trans.Sign In') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
