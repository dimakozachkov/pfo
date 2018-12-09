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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="section-blog__header">
                        <div class="section-blog__padding">
                            <div class="section-blog__header-center">
                                <form method="GET" action="{{ route('find') }}" class="section-blog__form">
						            <span class="section-blog__form-search">
						                <input type="text" class="header__search" name="search" id="SearchValue"
                                               placeholder="@lang('client/find.search')"
                                               value="{{ request('search') }}">
						            </span>
                                    <div class="section-form__wrap">
                                        <span class="section-form__select-arrow"></span>
                                        <select name="country_id" id="countryId" class="section-form__select">
                                            <option value="">----</option>
                                            @foreach($countries as $country)
                                                <option value="{{ $country->id }}"
                                                        @if(request()->has('country_id') === $country->id) selected @endif>
                                                    {{ $country->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="section-form__wrap">
                                        <span class="section-form__select-arrow"></span>
                                        <select name="residence_id" id="residenceId" class="section-form__select">
                                            <option value="">----</option>
                                        </select>
                                    </div>
                                    <button class="section-form__btn section-form__btn_blog"
                                            style="margin: 5px 0; padding: 0 5px;">@lang('client/find.submit')</button>

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
                            style="margin:5px;">@lang('client/find.search-results'):
                            <span style="color:#FF414D">"{{ $title }}"</span>
                        </h2>

                        @if($orphans->count() > 0)
                            <a href="#" id="edit-album" style="margin-left:20px; color:#5C2672; font-weight:bold;">
                                Download all Photos from this orphanage
                            </a>
                    @endif
                @endif

                <!-- GALLERY BODY -->
                    <div class="gallery-bot">
                        <div class="row">
                            @foreach($orphans as $orphan)
                                <div class="col-md-4">
                                    <div class="gallery-bot__box">
                                        <div class="gallery-bot__hover">

                                            <a href="{{ route('orphans.show', $orphan->id) }}"
                                               class="gallery-bot__hover-text">
                                                <img src="{{ asset('img/edit.png') }}" alt="">@lang('client/find.view')
                                            </a>
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
                                        <p class="gallery-bot__name gallery-bot__name_date">{{ $orphan->orphan_id }}</p>
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
                        @foreach($templates as $template)
                            <a
                                    href="{{
                                    route('download.photos', [
                                       'orphans' => $orphansIds,
                                       'template' => $template,
                                       'search' => request('search'),
                                       'residence_id' => request('residence_id'),
                                    ])
                                }}">
                                {{ $template->title }}
                            </a>
                            <br>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @push('scripts')
        <script>
            window.countries = {!! json_encode($countries) !!};

            $('#countryId').change(function (e) {
                var residences = $('#residenceId');

                residences.empty();
                residences.append('<option value="">----</option>');

                var country = window.countries.filter((country) => country.id == $('#countryId').val());

                country[0].residences.forEach(function (item) {
                    $('#residenceId').append(`<option value="${item.id}">${item.title}</option>`);
                })
            });
        </script>
        <script language="javascript">
            $('document').ready(function () {
                @foreach($orphans as $orphan)
                $('#edit-company{{ $orphan->id }}').click(function () {
                    $("#modal-company{{ $orphan->id }}").toggle();
                });
                @endforeach
            });
        </script>
    @endpush
@endsection