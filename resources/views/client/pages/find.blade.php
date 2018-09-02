@extends('client.master')

@section('content')
    <section class="section">
        <div class="section-blog">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-blog__header">
                        <div class="section-blog__padding">
                            <div class="section-blog__header-center">
                                <h2 class="section__title section__title_blog-header">@lang('client/find.find')</h2>
                                <form method="GET" action="{{ route('find') }}" class="section-blog__form">
						            <span class="section-blog__form-search">
						                <input type="text" class="header__search" name="search" id="SearchValue"
                                               placeholder="@lang('client/find.search')"
                                               value="{{ request('search') }}">
						            </span>
                                    <div class="section-form__wrap">
                                        <span class="section-form__select-arrow"></span>
                                        <select name="residence_id" id="residenceId" class="section-form__select">
                                            @foreach($residences as $residence)
                                                <option value="{{ $residence->id }}"
                                                        @if(request()->has('residence_id') === $residence->id) selected @endif>{{ $residence->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button class="section-form__btn section-form__btn_blog">@lang('client/find.submit')</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">

                    @if(request()->has('search'))
                        <h2 class="section__title section__title_blog-header"
                            style="margin:5px;">@lang('client/find.search-results'): <span
                                    style="color:#FF414D">"{{ request('search') }}"</span></h2>
                    @endif

                    <!-- GALLERY BODY -->
                    <div class="gallery-bot">
                        <div class="row">
                            @foreach($orphans as $orphan)
                                <div class="col-md-4">
                                    <div class="gallery-bot__box">
                                        <div class="gallery-bot__hover">

                                            <a href="{{ route('orphans.show', $orphan->id) }}" class="gallery-bot__hover-text">
                                                <img src="{{ asset('img/edit.png') }}" alt="">@lang('client/find.view')</a>
                                            <a href="#" class="section-profile__box" id="edit-company{{ $orphan->id }}">
                                                <img src="{{ asset('img/download.png') }}" alt=""
                                                     class="section-profile__img">
                                            </a>
                                        </div>
                                        <a href="{{ route('orphans.show', $orphan->id) }}" class="gallery-bot__album">
                                            <div class="gallery-bot__img"
                                                 style="background-image: url(/storage/photos/{{ $orphan->main_photo }});"></div>
                                        </a>
                                        <p class="gallery-bot__name">{{ $orphan->first_name }} {{ $orphan->last_name }}</p>
                                        <p class="gallery-bot__name gallery-bot__name_date">{{ $orphan->id }}</p>
                                    </div>
                                </div>
                                <div class="modal-edit" id="modal-company{{ $orphan->id }}">
                                    <div class="modal-edit__content">
                                        <div class="modal-edit__header">
                                            <div class="modal-edit__left">
                                                <p class="modal-edit__header-text">@lang('client/modals.choose-lang')</p>

                                            </div>
                                            <div class="modal-edit__right">
                                                <div class="modal-edit__close">✖</div>
                                            </div>
                                        </div>
                                        <div class="modal-edit__body">
                                            <div class="modal-edit__form">
                                                @foreach($templates as $template)
                                                    <a href="{{ route('download', ['orphan' => $orphan, 'template' => $template]) }}">{{ $template->title }}</a>
                                                    <br>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>

                    <div class="gallery-pages">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="gallery-pages__center">
                                    {{ $orphans->render() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-edit" id="modal-album">
            <div class="modal-edit__content">
                <div class="modal-edit__header">
                    <div class="modal-edit__left">
                        <p class="modal-edit__header-text">Choose which language you want to download photos</p>

                    </div>
                    <div class="modal-edit__right">
                        <div class="modal-edit__close">✖</div>
                    </div>
                </div>
                <div class="modal-edit__body">
                    <div class="modal-edit__form">

                        <a href="?page=Download&amp;Makets=41&amp;OrphansId=">BOLGARIA-wwo</a><br>
                        <a href="?page=Download&amp;Makets=44&amp;OrphansId=">DR Congo (fr)</a><br>
                        <a href="?page=Download&amp;Makets=30&amp;OrphansId=">ENGLISH-WWO</a><br>
                        <a href="?page=Download&amp;Makets=45&amp;OrphansId=">EST-wwo.png</a><br>
                        <a href="?page=Download&amp;Makets=28&amp;OrphansId=">Hindi BSP</a><br>
                        <a href="?page=Download&amp;Makets=33&amp;OrphansId=">HINDI WWO</a><br>
                        <a href="?page=Download&amp;Makets=42&amp;OrphansId=">HU-wwo-line.png</a><br>
                        <a href="?page=Download&amp;Makets=43&amp;OrphansId=">IL-wwo-line.png</a><br>
                        <a href="?page=Download&amp;Makets=46&amp;OrphansId=">LT-wwo.png</a><br>
                        <a href="?page=Download&amp;Makets=48&amp;OrphansId=">LV-wwo</a><br>
                        <a href="?page=Download&amp;Makets=34&amp;OrphansId=">PORTU</a><br>
                        <a href="?page=Download&amp;Makets=35&amp;OrphansId=">PORTU WWW</a><br>
                        <a href="?page=Download&amp;Makets=36&amp;OrphansId=">RUSSIAN</a><br>
                        <a href="?page=Download&amp;Makets=37&amp;OrphansId=">RUSSIAN-WWO</a><br>
                        <a href="?page=Download&amp;Makets=31&amp;OrphansId=">SPANISH</a><br>
                        <a href="?page=Download&amp;Makets=32&amp;OrphansId=">SPANISH-WWO</a><br>
                        <a href="?page=Download&amp;Makets=39&amp;OrphansId=">UKRAINE</a><br>
                        <a href="?page=Download&amp;Makets=38&amp;OrphansId=">UKRAINE-WWO</a><br></div>
                </div>
            </div>
        </div>
    </section>
@section('scripts')
    <script language="javascript">
        $('document').ready(function () {
            @foreach($orphans as $orphan)
            $('#edit-company{{ $orphan->id }}').click(function () {
                $("#modal-company{{ $orphan->id }}").toggle();
            });
            @endforeach
        });
    </script>
@endsection
@endsection