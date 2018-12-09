@extends('client.master')

@section('content')
    <main class="main">
        <section class="section gallery">
            <!-- GALLERY HEADER -->
            <div class="gallery-top">
                <div class="row">
                    <div class="col-md-12">
                        <div class="gallery-top__center">
                            <h2 class="gallery-top__title">{{ $country->title }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <!-- GALLERY BODY -->
            <div class="gallery-bot">
                <div class="row">

                    @foreach($orphans as $orphan)
                        <div class="col-md-4">
                            <div class="gallery-bot__box">
                                <div class="gallery-bot__hover">
                                    <a href="{{ route('orphans.show', $orphan) }}" class="gallery-bot__hover-text">
                                        @lang('client/list.show')
                                    </a>
                                </div>
                                <a href="{{ route('orphans.show', $orphan) }}" class="gallery-bot__album">
                                    <div class="gallery-bot__img" style="background-image: url(/storage/photos/{{ $orphan->main_photo }});"></div>
                                </a>
                                <p class="gallery-bot__name">{{ $orphan->first_name }} {{ $orphan->last_name }}</p>
                                <p class="gallery-bot__name gallery-bot__name_date">{{ $orphan->orphan_code }}</p>
                            </div>
                        </div>
                    @endforeach

                </div>
                {{ $orphans->render() }}
            </div>

        </section>
    </main>
@endsection