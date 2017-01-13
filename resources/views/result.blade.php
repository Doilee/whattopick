@extends('welcome')

@section('result')
    <h1>Here's a scorelist:</h1>
    <tabLe class="table table-striped">
        <thead>
            <tr>
                <td>Name</td>
                <td>Score</td>
                <td>Passivity</td>
                <td>Activity</td>
                <td>Predatory</td>
                <td>Advice</td>
            </tr>
        </thead>
        <tbody>
            @foreach($scoreList as $item)
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['score'] }}</td>
                    <td>{{ $item['passivityScore'] }}</td>
                    <td>{{ $item['activityScore'] }}</td>
                    <td>{{ $item['predatoryScore'] }}</td>
                    <td>{{ $item['advice'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </tabLe>
@stop