@extends('client.master')

@section('content')
    <main class="main">

        <section class="section gallery">
            <div class="gallery-top">
                <div class="row">
                    <div class="col-md-12">
                        <div class="gallery-top__center">
                            <h2 class="gallery-top__title">@lang('client/index.orphans')</h2>
                        </div>
                    </div>

                </div>
            </div>
            <div class="gallery-bot">
                <div class="row">

                    @foreach($countries as $country)
                        @php
                            $orphan = $country->randomOrphan();
                        @endphp
                        <div class="col-md-4">
                            <div class="gallery-bot__box">
                                <div class="gallery-bot__hover">

                                    <a href="{{ route('country', $country) }}"
                                       class="gallery-bot__hover-text">@lang('client/index.show')</a>
                                </div>
                                <a href="{{ route('country', $country) }}"
                                   class="gallery-bot__album">
                                    <div class="gallery-bot__img"
                                         style="background-image: url(/storage/photos/{{ optional($orphan)->main_photo }});"></div>
                                </a>
                                <p class="gallery-bot__name">{{ $country->title }}</p>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>
    </main>
@endsection