@extends('client.master')

@section('content')
    <main class="main">
        <section class="section section_profile" style="padding-top: 0; padding-bottom: 15px;">
            <div class="row">
                <div class="title">
                    <h1>Add an orphan</h1>
                </div>
                <div class="content-block">
                    <form method="post" action="{{ route('orphans.store') }}">
                        @csrf
                        <label for="residenceId">Place of residence</label>
                        <select class="form-control" id="residenceId" name="residence_id">
                            <option>----</option>
                            @foreach($residences as $residence)
                                <option value="{{ $residence->id }}">{{ $residence->title }}</option>
                            @endforeach
                        </select>

                        <br>

                        <label for="personal-data" class="change-password">Personal data</label>

                        <div id="personal-data">
                            <input type="text" placeholder="Name" class="form-control" id="ChildName" name="first_name"
                                   style="margin-bottom: 5px;">
                            <input type="text" placeholder="Surname" class="form-control" id="ChildLastname"
                                   name="last_name" style="margin-bottom: 5px;">

                            <input type="text" class="modal-edit__field input-group date" placeholder="Birthday"
                                   id="datetimepicker" name="birthday" style="margin-bottom: 5px;">
                            <textarea class="form-control" placeholder="Other important notes"
                                      id="ChildNote" name="about"></textarea>

                            <br>
                        </div>

                        <div class="form-group save-changes" style="margin-bottom: 0;">
                            <input id="Done" class="btn btn-primary" type="submit"
                                   value="Save">
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