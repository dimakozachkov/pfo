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
                            <p class="section-profile__office">{{ $orphan->orphan_code }}</p>

                            <div class="section-profile__box" style="cursor: pointer;">
                                <img src="{{ asset('img/blank.gif') }}" class="flag flag-ua section-profile__img"
                                     alt="Ukraine">
                            </div>
                            <div class="section-profile__box" id="edit-company" style="cursor: pointer;">
                                <img src="{{ asset('img/download.png') }}" alt="" class="section-profile__img">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="section__list section__list_company">
                        <div class="section__item"><img src="/img/companies-red.png" alt="">{{ $orphan->address }}</div>
                        <div class="section__item"><img src="/img/birthday.png"
                                                        alt="">{{ $orphan->birthday->format('d/M/Y') }}</div>
                        <div class="section__item"><img src="/img/classroom.png" alt="">{{ $orphan->class }}</div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="section__item">{{ $orphan->about }}</div>
                </div>
            </div>
        </section>
        <br>
        <!-- -PHOTO SECTION  -->
        <section class="section">
            <div class="section__padding">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="section__title section__title_margin"> archive</h3>
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
                        <p class="modal-edit__header-text">Edit name and position</p>
                    </div>
                    <div class="modal-edit__right">
                        <div class="modal-edit__close">✖</div>
                    </div>
                </div>
                <div class="modal-edit__body">
                    <form class="modal-edit__form" action="{{ route('orphans.update', $orphan) }}" method="POST">
                        @csrf
                        @method("PUT")
                        <p class="modal-edit__name">Place of residence</p>
                        <select class="form-control" id="CountryId">
                            <option>-Country of Residence-</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}"
                                        @if($orphan->country_id === $country->id) selected @endif>{{ $country->title }}</option>
                            @endforeach
                        </select>
                        <input type="text" placeholder="Address" class="modal-edit__field" id="address" name="address"
                               value="{{ $orphan->address ?? '' }}">

                        <p class="modal-edit__name">Personal data</p>

                        <input type="text" placeholder="Name" class="modal-edit__field" id="first_name"
                               name="first_name" value="{{ $orphan->first_name }}">
                        <input type="text" placeholder="Surname" class="modal-edit__field" id="last_name"
                               name="last_name" value="{{ $orphan->last_name }}">

                        <input type="text" class="modal-edit__field input-group date" placeholder="Birthday"
                               id="datetimepicker"
                               name="birthday"
                               value="{{ $orphan->birthday->format('d.m.Y') }}">

                        <input type="number" min="0" class="modal-edit__field" placeholder="class"
                               name="class"
                               value="{{ $orphan->class }}">
                        <p class="modal-edit__name">Other important notes</p>
                        <textarea class="modal-edit__field" placeholder="Other important notes"
                                  style="height: 100px; resize: none" id="about" name="about"
                                  value="{{ $orphan->about }}"></textarea>

                        <div class="form-group save-changes">
                            <input id="Done" class="btn btn-primary" type="submit"
                                   value="Save">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal-edit" id="modal-avatar">

            <div class="modal-edit__content modal-edit__content_avatar">
                <div class="modal-edit__header">
                    <div class="modal-edit__left">
                        <p class="modal-edit__header-text">Edit portrait</p>
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
                            <input type="submit" class="section-form__btn" id="modal-avatar_btn" value="Save">
                            <button class="modal-edit__close-text" type="reset">cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-edit" id="modal-company">
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

                        <a href="http://prayfororphan.info/?page=Download&amp;Makets=41&amp;ChildId=2336">BOLGARIA-wwo</a><br>
                        <a href="http://prayfororphan.info/?page=Download&amp;Makets=44&amp;ChildId=2336">DR Congo
                            (fr)</a><br>
                        <a href="http://prayfororphan.info/?page=Download&amp;Makets=30&amp;ChildId=2336">ENGLISH-WWO</a><br>
                        <a href="http://prayfororphan.info/?page=Download&amp;Makets=45&amp;ChildId=2336">EST-wwo.png</a><br>
                        <a href="http://prayfororphan.info/?page=Download&amp;Makets=28&amp;ChildId=2336">Hindi
                            BSP</a><br>
                        <a href="http://prayfororphan.info/?page=Download&amp;Makets=33&amp;ChildId=2336">HINDI
                            WWO</a><br>
                        <a href="http://prayfororphan.info/?page=Download&amp;Makets=42&amp;ChildId=2336">HU-wwo-line.png</a><br>
                        <a href="http://prayfororphan.info/?page=Download&amp;Makets=43&amp;ChildId=2336">IL-wwo-line.png</a><br>
                        <a href="http://prayfororphan.info/?page=Download&amp;Makets=46&amp;ChildId=2336">LT-wwo.png</a><br>
                        <a href="http://prayfororphan.info/?page=Download&amp;Makets=48&amp;ChildId=2336">LV-wwo</a><br>
                        <a href="http://prayfororphan.info/?page=Download&amp;Makets=34&amp;ChildId=2336">PORTU</a><br>
                        <a href="http://prayfororphan.info/?page=Download&amp;Makets=35&amp;ChildId=2336">PORTU
                            WWW</a><br>
                        <a href="http://prayfororphan.info/?page=Download&amp;Makets=36&amp;ChildId=2336">RUSSIAN</a><br>
                        <a href="http://prayfororphan.info/?page=Download&amp;Makets=37&amp;ChildId=2336">RUSSIAN-WWO</a><br>
                        <a href="http://prayfororphan.info/?page=Download&amp;Makets=31&amp;ChildId=2336">SPANISH</a><br>
                        <a href="http://prayfororphan.info/?page=Download&amp;Makets=32&amp;ChildId=2336">SPANISH-WWO</a><br>
                        <a href="http://prayfororphan.info/?page=Download&amp;Makets=39&amp;ChildId=2336">UKRAINE</a><br>
                        <a href="http://prayfororphan.info/?page=Download&amp;Makets=38&amp;ChildId=2336">UKRAINE-WWO</a><br>
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
    <script src="/js/JsHttpRequest.js"></script>
    <script src="/js/Registration.js"></script>
    <script src="/js/ReqObj.js"></script>
@endsection