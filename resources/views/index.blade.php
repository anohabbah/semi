<!DOCTYPE html>
<html lang="fr">
<head>
    <title>{{ config('app.name') }}</title>
    <meta charset="UTF-8">
    <meta name=description content="">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"
          media="screen">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/mise.ico') }}"/>
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    <script>
        window.Semi = {!! json_encode([
            'csrfToken' => csrf_token(),
            'url' => route('search')
        ]) !!}
    </script>

    <style>
        .logo {
            height: 160px;
            width: 400px;
            background: url({{ asset("images/mise.jpg") }}) no-repeat;
            margin: auto;
        }

        .attente {
            display: none;
        }

        .logo-id {
            margin: auto;
            height: 40px;
            width: 80px;
            background: url({{ asset("images/mise.jpg") }}) no-repeat;
            margin-top: 5px;
        }

        .moya {
            display: none;
        }

    </style>


</head>
<body>

<header class="container-fluid">
    <div class="row">


        <div class="col-lg-12">
            <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
                <a class="navbar-brand logo-id attente" style="background-size:80px 40px;height:40px;width:80px"></a>

                <div class="col-md-3 attente">
                    <div class="input-group" style="margin-top: 8px">
                        <input type="text" class="form-control" placeholder="Search for..." name="search-mini"
                               id="search"/>
                        <span class="input-group-btn">
                         <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
                        </span>
                    </div>
                </div>

                <ul class="nav navbar-nav navbar-right">
                    <li class="active">
                        <a href="#">Home</a>
                    </li>
                    <li>
                        <a href="#">Link</a>
                    </li>
                </ul>
            </nav>
        </div>


    </div>
</header>

<main class="container mi" style="margin-top: 10%">
    <div class="row logo" style="background-size:400px 160px;height:160px;width:400px">

    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="input-group">
                <input type="text" class="form-control input-lg essai" placeholder="Search for..." name="search"/>
                <span class="input-group-btn">
                        <button class="btn btn-default btn-lg" type="button">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </span>

            </div>

        </div>
    </div>


</main>

<!-- jQuery -->
<script src="//code.jquery.com/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="{{ asset('js/masque.js') }}"></script>
</body>
</html>