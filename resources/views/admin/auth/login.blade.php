@extends('admin.layouts.master')

@section('title', 'Connexion')

@section('content')

    <div class="row">
        <div class="col-md-12 center login-header">
            <h2>Bienvenue sur MISE <br> <small>Panneau d'Administration</small></h2>
        </div>
        <!--/span-->
    </div><!--/row-->

    <div class="row">
        <div class="well col-md-5 center login-box">
            <div class="alert alert-info">
                Veuillez vous connecter avec votre email et votre mot de passe
            </div>
            <form class="form-horizontal" action="{{ route('admin.login') }}" method="post">
                {{ csrf_field() }}

                <fieldset>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
                        <input type="text" name="email" class="form-control" placeholder="Adresse Email">
                    </div>
                    {!! $errors->first('email', '<span class="help-block text-danger">:message</span>') !!}
                    <div class="clearfix"></div><br>

                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                        <input type="password" name="password" class="form-control" placeholder="Mot de passe">
                    </div>
                    {!! $errors->first('password', '<span class="help-block text-danger">:message</span>') !!}

                    <div class="clearfix"></div>

                    <div class="input-prepend">
                        <label class="remember" for="remember"><input type="checkbox" id="remember"> Se souvenir de moi</label>
                    </div>
                    <div class="clearfix"></div>

                    <p class="center col-md-5">
                        <button type="submit" class="btn btn-primary">Se Connecter</button>
                    </p>
                </fieldset>
            </form>
        </div>
        <!--/span-->
    </div><!--/row-->

@endsection
