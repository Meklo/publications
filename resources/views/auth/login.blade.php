@extends('template_base')

@section('titre')
Connexion
@stop

@section('head')
<link rel="stylesheet" href="css/base.css">
@stop

@section('blocgauche')
@stop

@section('contenu')
<br>
<div class="container">
  <div class="col-md-8 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Connexion</div>
          <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
              {!! csrf_field() !!}

              <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                  <label class="col-md-4 control-label">Adresse E-Mail</label>

                  <div class="col-md-6">
                      <input type="email" class="form-control" name="email" value="{{ old('email') }}"> @if ($errors->has('email'))
                      <span class="help-block">
                                              <strong>{{ $errors->first('email') }}</strong>
                                          </span> @endif
                  </div>
              </div>

              <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                  <label class="col-md-4 control-label">Mot de passe</label>

                  <div class="col-md-6">
                      <input type="password" class="form-control" name="password"> @if ($errors->has('password'))
                      <span class="help-block">
                                              <strong>{{ $errors->first('password') }}</strong>
                                          </span> @endif
                  </div>
              </div>

              <div class="form-group">
                  <div class="col-md-6 col-md-offset-4">
                      <div class="checkbox">
                          <label>
                                              <input type="checkbox" name="remember"> Se souvenir de moi
                                          </label>
                      </div>
                  </div>
              </div>

              <div class="form-group">
                  <div class="col-md-6 col-md-offset-4">
                    <table class="table">
                      <tr>
                        <td>
                          <button type="submit" class="btn btn-secondary">
                                              Se connecter
                                          </button>
                        </td>
                        <td>
                          <a href="register" class="btn btn-primary">S'inscrire</a>
                        </td>
                      </tr>
                    </table>
                  </div>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@stop

@section('blocdroit')
@stop

@section('pied')
@stop
