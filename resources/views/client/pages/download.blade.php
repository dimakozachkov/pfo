@extends('client.master')

@section('content')
    <section class="section">
        <div class="section-blog">
            <div class="row">
                <div class="col-md-12">

                    <!-- GALLERY BODY -->
                    <div class="gallery-bot">
                        <div class="row">
                            <style>
                                .section__btn {
                                    max-width: 100% !important;
                                    height: 38px;
                                    background: #ff414d;
                                    display: block;
                                    text-align: center;
                                    margin-top: 2px !important;
                                }
                            </style>
                            @foreach($orphans as $orphan)
                                <a href="{{ route('download', ['orphan' => $orphan, 'template' => $template]) }}" download=""><img src="/storage/photos/{{ $orphan->main_photo }}" alt="image" width="120"></a>
                            @endforeach

                            <div style="text-align:center">Photos added to archive<br>
                                <a href="{{
                                        route('download.many', [
                                            'orphans' => $orphansIds,
                                            'template' => $template,
                                            'search' => request('search'),
                                            'residence_id' => request('residence_id')
                                        ])
                                    }}" class="section__btn section__btn_margin" download>
                                    <span class="section__btn-inner">Download</span>
                                </a>
                            </div>
                        </div>
                    </div>
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