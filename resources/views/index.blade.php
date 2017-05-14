<!DOCTYPE html>
<html lang="fr">
<head>
    <title>{{ config('app.name') }}</title>
    <meta charset="UTF-8">
    <meta name=description content="">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"
          media="screen">
</head>
<body>

<header class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
                {{--<a class="navbar-brand" href="#">Title</a>--}}
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

<main class="container" style="margin-top: 20%">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="input-group">
                <input type="text" class="form-control input-lg" placeholder="Search for...">
                <span class="input-group-btn">
                    <button class="btn btn-default btn-lg" type="button"><span class="glyphicon glyphicon-search"></span></button>
                </span>
            </div>
        </div>
    </div>
</main>

<!-- jQuery -->
<script src="//code.jquery.com/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>