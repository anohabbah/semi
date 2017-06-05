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

<header class="navbar navbar-default navbar-static-top" role="navigation">
    <a class="navbar-brand logo-id attente" style="background-size:80px 40px;height:40px;width:80px"></a>

    <div class="col-md-10 attente">
        <form action="{{ route('search') }}" method="get" id="nav-form">
            <div class="input-group" style="margin-top: 8px">
                <input type="text" id="search" class="form-control" placeholder="Search for..." name="query"/>
                <span class="input-group-btn">
                         <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
                        </span>
                <div class="form-group">

                    <div class="col-md-8">
                        <div class="radio-inline">
                            <label>
                                <input type="radio" name="field" checked value="all"> Article
                            </label>
                        </div>
                        <div class="radio-inline">
                            <label>
                                <input value="si" type="radio" name="field"> SI
                            </label>
                        </div>
                        <div class="radio-inline">
                            <label>
                                <input type="radio" value="spi" name="field"> SPI
                            </label>
                        </div>
                        <div class="radio-inline">
                            <label>
                                <input type="radio" name="field" value="sm"> SM
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <ul class="nav navbar-nav navbar-right">
        <li class="active">
            <a href="#">Home</a>
        </li>
        <li>
            <a href="#">Link</a>
        </li>
    </ul>
</header>
<main class="container mi" style="margin-top: 10%">
    <div class="row logo" style="background-size:400px 160px;height:160px;width:400px">

    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <form action="">
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control input-lg essai" placeholder="Search for..."
                               name="query"/>
                        <span class="input-group-btn">
                            <button class="btn btn-default btn-lg" type="button">
                                <i class="glyphicon glyphicon-search"></i>
                            </button>
                        </span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-4">Champs de recherche: </label>
                    <div class="col-sm-8">
                        <div class="radio-inline">
                            <label>
                                <input type="radio" name="field" checked value="all"> Article
                            </label>
                        </div>
                        <div class="radio-inline">
                            <label>
                                <input type="radio" name="field" value="si"> SI
                            </label>
                        </div>
                        <div class="radio-inline">
                            <label>
                                <input type="radio" name="field" value="spi"> SPI
                            </label>
                        </div>
                        <div class="radio-inline">
                            <label>
                                <input type="radio" name="field" value="sm"> SM
                            </label>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>


</main>

<!-- jQuery -->
<script src="//code.jquery.com/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="{{ asset('js/masque.js') }}"></script>

<script>
</script>
</body>
</html>