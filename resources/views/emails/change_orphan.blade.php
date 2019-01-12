<html>
<head>
    <title>{{ env('APP_NAME') }}</title>
</head>
<body>

<p>
    Information about the orphan {{ $orphan->latin_name }} has been changed
</p>
<p>
    <a href="{{ route('orphans.show', ['orphan' => $orphan]) }}">Show the orphan</a>
</p>
</body>
</html>