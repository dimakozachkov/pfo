@extends('client.master')

@section('content')
    <main class="main">
        <section class="section section_profile">
            <div class="row">
                <div class="col-md-3 col-xs-12">
                    <div class="col-md-12">
                        <div class="mobile__center">
                            <div class="section__avatar" id="edit-avatar"
                                 style="background-image:url(/storage/photos/{{ $orphan->main_photo }});"></div>
                        </div>
                    </div>
                    <div class="col-md-7"></div>
                </div>
                <div class="col-md-7 col-xs-12">

                    <div class="mobile__center">
                        <div class="section-profile__information">

                            <p class="section-profile__title"><span
                                        class="section-profile__title-inner float-left">{{ $orphan->first_name }} {{ $orphan->last_name }}</span>
                                @can('update', $orphan)
                                    <span class="section-profile__editor float-right" id="edit-name"><img
                                                src="{{ asset('img/change.png') }}" alt=""
                                                class="section-profile__img"></span>
                                @endcan
                                <span class="section-profile__title-inner"></span></p>
                            <br>
                            <p class="section-profile__office">{{ $orphan->orphan_code }}</p>

                            <div class="section-profile__box" style="cursor: pointer;">
                                <img src="{{ asset('/storage/photos/') }}/{{ $country->icon }}"
                                     class="flag flag-ua section-profile__img"
                                     alt="{{ $country->title }}" title="{{ $country->title }}"
                                     style="border: 1px solid #000">
                            </div>
                            <div class="section-profile__box" id="edit-company" style="cursor: pointer;">
                                <img src="{{ asset('img/download.png') }}" alt="" class="section-profile__img">
                            </div>
                            @can('view-statistic', $orphan)
                                <a href="{{ route('orphans.statistic', $orphan) }}" class="section-profile__box"
                                   id="edit-company" style="cursor: pointer;">
                                    <img src="{{ asset('img/statistic.png') }}" alt="Show statistic"
                                         class="section-profile__img">
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="section__list section__list_company">
                        @if (isset($orphan->residence))
                            <div class="section__item">
                                <img src="/img/companies-red.png">
                                {{ optional($orphan->residence)->title }}
                            </div>
                        @endif
                        @if (isset($orphan->birthday))
                            <div class="section__item">
                                <img src="/img/birthday.png">
                                {{ $orphan->birthday ? $orphan->birthday->format('d/m/Y') : '' }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        @isset($orphan->about)
            <section class="section">
                <div class="section__padding">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="section__title section__title_margin">About</h3>
                        </div>
                        <div class="col-12 section__item">
                            <p style="text-indent: 1.5em; margin-top: 0">{{ $orphan->about }}</p>
                        </div>
                    </div>
                </div>
            </section>
        @endisset

        @isset($orphan->contact)
            <section class="section">
                <div class="section__padding">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="section__title section__title_margin">Contacts</h3>
                        </div>
                        <div class="col-12 section__item">
                            <p style="text-indent: 1.5em; margin-top: 0">{{ $orphan->contact }}</p>
                        </div>
                    </div>
                </div>
            </section>
        @endisset

        <br>
        <!-- -PHOTO SECTION  -->
        <section class="section">
            <div class="section__padding">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="section__title section__title_margin"> @lang('client/profile.archive')</h3>
                    </div>
                    @foreach($photos->chunk(3) as $photoPart)
                        @foreach($photoPart as $photo)
                            <a href="#"
                               class="col-md-4 col-sm-4 open_window" style="padding: 5px">
                                <div style="background-image:url(/storage/photos/{{ $photo->url }});"
                                     class="gallery__img">
                                    @can('update', $orphan)
                                        <form action="{{ route('photo.destroy', $photo) }}" method="post">
                                            {{ csrf_field() }}
                                            {{ method_field('delete') }}
                                            <button style="background-color: rgba(0, 0, 0, 0); border: 0" type="submit">
                                                <img src="{{ asset('img/delete.png') }}">
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </a>
                        @endforeach
                        <div class="row">
                            <div class="col-md-12">
                                <div class="clearfix"></div>
                                <div class="section__more">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <div style="position: static"></div>
        <div class="modal-edit" id="modal-name">
            <div class="modal-edit__content">
                <div class="modal-edit__header">
                    <div class="modal-edit__left">
                        <p class="modal-edit__header-text">@lang('client/profile.edit')</p>
                    </div>
                    <div class="modal-edit__right">
                        <div class="modal-edit__close">✖</div>
                    </div>
                </div>
                <div class="modal-edit__body">
                    <form class="modal-edit__form" action="{{ route('orphans.update', $orphan) }}" method="POST">
                        @csrf
                        @method("PUT")
                        <p class="modal-edit__name">@lang('client/profile.place')</p>
                        <select class="form-control" id="ResidenceId" name="residence_id">
                            <option>-@lang('client/profile.select')-</option>
                            @foreach($residences as $residence)
                                <option value="{{ $residence->id }}"
                                        @if(optional($orphan->residence)->id === $residence->id) selected @endif>{{ $residence->title }}</option>
                            @endforeach
                        </select>

                        <p class="modal-edit__name">@lang('client/profile.personal-data')</p>

                        <input type="text" placeholder="@lang('client/profile.name')" class="modal-edit__field"
                               id="first_name"
                               name="first_name" value="{{ $orphan->first_name }}">
                        <input type="text" placeholder="@lang('client/profile.surname')" class="modal-edit__field" id="last_name"
                               name="last_name" value="{{ $orphan->last_name }}">

                        <input type="text" class="modal-edit__field input-group date"
                               placeholder="@lang('client/profile.birthday')"
                               id="datetimepicker"
                               name="birthday"
                               value="{{ $orphan->birthday ? $orphan->birthday->format('d/m/Y') : '' }}">

                        <p class="modal-edit__name">@lang('client/profile.other')</p>
                        <textarea class="modal-edit__field" placeholder="@lang('client/profile.other')"
                                  style="height: 100px; resize: none" id="about"
                                  name="about">{{ $orphan->about }}</textarea>

                        <p class="modal-edit__name">Contacts</p>
                        <textarea class="modal-edit__field" placeholder="Contacts"
                                  style="height: 100px; resize: none" id="contact"
                                  name="contact">{{ $orphan->contact }}</textarea>

                        <div class="form-group save-changes">
                            <input id="Done" class="btn btn-primary" type="submit"
                                   value="@lang('client/profile.save')">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal-edit" id="modal-avatar">

            <div class="modal-edit__content modal-edit__content_avatar">
                <div class="modal-edit__header">
                    <div class="modal-edit__left">
                        <p class="modal-edit__header-text">@lang('client/profile.portrait')</p>
                    </div>
                    <div class="modal-edit__right">
                        <div class="modal-edit__close">✖</div>
                    </div>
                </div>
                <div class="modal-edit__body modal-edit__body_avatar">
                    <div class="modal-edit__form modal-edit__form_avatar">
                        <form action="{{ route('orphans.update', $orphan) }}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input name="photo" type="FILE" size="50">
                            <input type="submit" class="section-form__btn" id="modal-avatar_btn"
                                   value="@lang('client/profile.save')">
                            <button class="modal-edit__close-text" type="reset">@lang('client/profile.cancel')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-edit" id="modal-company">
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
                            <a target="_blank" download
                               href="{{ route('download', ['orphan' => $orphan, 'template' => $template]) }}">{{ $template->title }}</a>
                            <br>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="popup">
            <div class="close_window">
            </div>

            <div class="swiper-container swiper-container-horizontal swiper-container-3d swiper-container-coverflow"
                 style="cursor: grab;">
                <div class="swiper-wrapper"
                     style="transform: translate3d(446.5px, 0px, 0px); transition-duration: 0ms;">

                    @foreach($photos as $photo)
                        <div class="swiper-slide" style="background-image:url(/storage/photos/{{ $photo->url }})"></div>
                    @endforeach
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination swiper-pagination-bullets"><span
                            class="swiper-pagination-bullet swiper-pagination-bullet-active"></span></div>

            </div>
        </div>
        <div class="close-wrap"></div>
    </main>

    @push('scripts')
        <script src="/js/JsHttpRequest.js"></script>
        <script src="/js/Registration.js"></script>
        <script src="/js/ReqObj.js"></script>
    @endpush
@endsection
