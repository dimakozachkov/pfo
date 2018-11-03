<aside class="menu">
    <nav class="menu-nav">
        <ul class="menu-nav__list">

            <li class="menu-nav__item">
                <a href="{{ route('orphans.create') }}" class="menu-nav__link" data-activity="template/pfo/img/profile.png">
                                    <span class="menu-nav__img">
                                        <img src="{{ asset('img/d3e4a69c4505a52.png') }}" alt="" class=""></span> @lang('client/menu.add-info')
                </a>
            </li>
            <li class="menu-nav__item">
                <a href="{{ route('residences.index') }}" class="menu-nav__link" data-activity="template/pfo/img/profile.png">
                                    <span class="menu-nav__img">
                                        <img src="{{ asset('img/d97db134a0e34f3.png') }}" alt="" class=""></span> @lang('client/menu.place')
                </a>
            </li>
            <li class="menu-nav__item">
                <a href="{{ route('find') }}" class="menu-nav__link" data-activity="template/pfo/img/profile.png">
                                    <span class="menu-nav__img">
                                        <img src="{{ asset('img/2ef1b7b03971f0c.png') }}" alt="" class=""></span> @lang('client/menu.search')
                </a>
            </li>
        </ul>
    </nav>
</aside>