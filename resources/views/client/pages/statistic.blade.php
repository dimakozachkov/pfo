@extends('client.master')

@section('content')
    <main class="main">
        <section class="section" style="padding-left: 40px; padding-top: 15px; padding-bottom: 50px; padding-right: 40px;">
            <div class="title" style="display: block; margin-bottom: 70px">
                <h1>Statistic</h1>
                <hr>
                <h3>Total statistic by the orphan</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <td><strong>Title</strong></td>
                            <td><strong>Count</strong></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($countDownloads as $key => $val)
                            <tr>
                                <td>{{ $key }}</td>
                                <td>{{ $val }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <hr>
            <div class="content-block">
                <h3>Statistic</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <td><strong>Full name</strong></td>
                            <td><strong>Template</strong></td>
                            <td><strong>Date</strong></td>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($statistics as $statistic)
                        <tr>
                            <td>{{ $statistic->user->name }}</td>
                            <td>{{ $statistic->template->title }}</td>
                            <td>{{ $statistic->created_at->format('Y-m-d') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div style="position: relative; left: -15px;">{{ $statistics->links() }}</div>
                <br>
            </div>
        </section>
    </main>
@endsection