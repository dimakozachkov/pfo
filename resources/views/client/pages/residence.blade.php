@extends('client.master')

@section('content')
    <main class="main">
        <section class="section" style="padding-left: 40px; padding-top: 15px; padding-bottom: 50px; padding-right: 0;">
            <div class="title">
                <div class="col-md-12">
                    <h1>Add Place of residence</h1>
                </div>
                <div class="col-md-6">
                    <div class="pull-right">

                    </div>
                </div>
            </div>
            <div class="content-block">

                <form class="form-inline" method="post" action="{{ route('residences.store') }}">
                    @csrf
                    <input type="text" value="" name="title" placeholder="Add a New PLACE" class="form-control"
                           style="border: 1px solid #f00; width: 70%">
                    <input class="btn btn-primary" type="submit" value="Add information">
                </form>

                @foreach($residences as $residence)
                    <br>

                    <form class="form-inline" method="post" action="{{ route('residences.update', $residence) }}">
                        @csrf
                        @method('PUT')
                        <input type="text" value="{{ $residence->title }}" name="title" class="form-control"
                               style="width: 70%">
                        <input class="btn btn-info" type="submit" value="Edit information"></form>
                @endforeach
            </div>
        </section>
    </main>
@endsection