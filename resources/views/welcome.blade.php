<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
</head>
<body style="padding-top: 50px">
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Articles
                        <small>{{ $articles->count() }}</small>
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="{{ url('/search') }}" method="get">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="q" name="q"
                                           placeholder="Your Search Here..." value="{{ request('q') }}">
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            @forelse ($articles as $article)
                                <article>
                                    <h2>{{ $article->title }}</h2>

                                    <p>{{ $article->body }}</p>

                                    <p class="well">{{ $article->tags }}</p>
                                </article>
                            @empty
                                <p>No articles found</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
