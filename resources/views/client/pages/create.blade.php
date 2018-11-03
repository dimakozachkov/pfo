@extends('client.master')

@section('content')
    <main class="main">
        <section class="section section_profile" style="padding-top: 0; padding-bottom: 15px;">
            <div class="row">
                <div class="title">
                    <h1>@lang('client/create.add')</h1>
                </div>
                <div class="content-block">
                    <form method="post" action="{{ route('orphans.store') }}" enctype="multipart/form-data">
                        @csrf
                        <label for="countryId">Country</label>
                        <select class="form-control" id="countryId" name="country_id">
                            <option>----</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}" @if(auth()->user()->country_id === $country->id) selected @endif>{{ $country->title }}</option>
                            @endforeach
                        </select>

                        <label for="residenceId">@lang('client/create.place')</label>
                        <select class="form-control" id="residenceId" name="residence_id">
                            <option>----</option>
                            @foreach($residences as $residence)
                                <option value="{{ $residence->id }}">{{ $residence->title }}</option>
                            @endforeach
                        </select>

                        <br>

                        <label for="personal-data" class="change-password">@lang('client/create.personal-data')</label>

                        <div id="personal-data">
                            <input type="text" placeholder="@lang('client/create.name')" class="form-control" id="ChildName" name="first_name"
                                   style="margin-bottom: 5px;">
                            <input type="text" placeholder="@lang('client/create.surname')" class="form-control" id="ChildLastname"
                                   name="last_name" style="margin-bottom: 5px;">

                            <input type="text" class="modal-edit__field input-group date" placeholder="@lang('client/create.birthday')"
                                   id="datetimepicker" name="birthday" style="margin-bottom: 5px;">
                            <textarea class="form-control" placeholder="@lang('client/create.other-important-notes')"
                                      id="ChildNote" name="about"></textarea>


                            <div class="from-group">
                                <label for="photo">@lang('client/create.upload-main-photo')</label>
                                <input type="file" name="photo" id="photo"/>
                            </div>

                            <div class="from-group">
                                <label for="photo">@lang('client/create.upload-other-photos')</label>
                                <input type="file" name="photos[]" id="photos" multiple>
                            </div>

                            <br>
                        </div>

                        <div class="form-group save-changes" style="margin-bottom: 0;">
                            <input id="Done" class="btn btn-primary" type="submit"
                                   value="@lang('client/create.save')">
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
    <script src="/js/JsHttpRequest.js"></script>
    <script src="/js/Registration.js"></script>
    <script src="/js/ReqObj.js"></script>
@endsection
