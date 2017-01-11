<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 50vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>

        <!-- Latest compiled and minified Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    What To Pick?
                </div>
                <div class="container">
                    <div class="row">
                        <form method="POST" action="{{ url('/result') }}">
                            <div class="col-md-6">
                                @for($i = 1; $i <= 5; $i++)
                                    <div class="form-group">
                                        <label for="ally-{{ $i }}"><strong>Ally</strong> pick number <b>{{ $i }}</b>:</label>
                                        <select name="ally-{{ $i }}">
                                            <option value="" selected></option>
                                            <option value="me">Me</option>
                                            @foreach($champions as $champion)
                                                <option value="{{ $champion->id }}">{{ $champion->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endfor
                            </div>
                            <div class="col-md-6">
                                @for($i = 1; $i <= 5; $i++)
                                    <div class="form-group">
                                        <label for="enemy-{{ $i }}"><strong>Enemy</strong> pick number <b>{{ $i }}</b>:</label>
                                        <select name="enemy-{{ $i }}">
                                            <option value="" selected></option>
                                            <option value="me">Me</option>
                                            @foreach($champions as $champion)
                                                <option value="{{ $champion->id }}">{{ $champion->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="radio">
                                            <label><input type="radio" name="jungler" value="{{ $i }}">Jungler?</label>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
