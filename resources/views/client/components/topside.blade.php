<header class="header header_shadow" style="background: white">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-xs-12 col-sm-3">
                <div class="header__wrap">
                    <a href="{{ route('home') }}" class="header__logo">
                        <img src="{{ asset('img/logo.png') }}" alt="{{ config('app.name') }}">
                    </a>
                </div>
                <div class="header__wrap">
                    <h1 class="header__title">pray<br>for<br>orphan</h1>
                </div>
            </div>
            <div class="col-md-3 col-xs-12 col-sm-3">
                <div class="header__wrap">
                    <form action="{{ route('find') }}" method="GET" class="header__form">
                        <input type="text" class="header__search" name="search" placeholder="@lang('client/menu.search')..." value="{{ request('search') }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>