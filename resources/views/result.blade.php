@section('content')

    <h1>Here's a scorelist:</h1>
    <pre>{{ print_r($scoreList) }}</pre>

@stop

<a href="{{ url('/') }}">Go Back</a>