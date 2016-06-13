@extends('template_base')

@section('titre')

Administration

@stop

@section('head')
  <link rel="stylesheet" href="./css/base.css">
@stop

@section('blocgauche')
<br>
@stop

@section('contenu')
  <br>
  <div class="container">
    <div class="col-md-11">
      <h1>Administration</h1>
      <ul class="nav nav-tabs">
        <li role="presentation">{{link_to_route('admin.index','Accueil')}}</li>
        <li role="presentation">{{link_to_route('admin.rank','Classement')}}</li>
        <li role="presentation" class="active">{{link_to_route('admin.kink','Anomalies')}}</li>
      </ul>
      <br>
      <div class="panel panel-default">
        <div class="panel-heading"><h4>Doublons d'auteurs</h4></div>
        @if(count($list_doublons_users) > 0)
          <table class="table">
            @foreach($list_doublons_users as $doublon_user)
              <tr>
                <td><p>La publication {!! link_to_route('publication.show', $doublon_user['publication']['attributes']['title'], ['id' => $doublon_user['publication']['attributes']['id']]) !!} possède un doublon d'auteur : {{$doublon_user['user']['attributes']['first_name'].' '.$doublon_user['user']['attributes']['name']}}</p></td>
              </tr>
            @endforeach
          </table>
        @else
          <div class="panel-body">
            <p>Il n'y a aucun doublons d'auteurs dans les publications.</p>
          </div>
        @endif
      </div>
      <br>
      <div class="panel panel-default">
        <div class="panel-heading"><h4>Doublons de publications</h4></div>
        @if(count($list_doublons_publications) > 0)
          <table class="table">
            <?php $indice = 0;?>
            @while($indice < count($list_doublons_publications))
              <?php $indice_tmp = $indice;?>
              <tr>
                <td><p>Les publications :
                @while($indice_tmp+1 < count($list_doublons_publications) and $list_doublons_publications[$indice_tmp]->title == $list_doublons_publications[$indice_tmp+1]->title)
                  {!! link_to_route('publication.show', $list_doublons_publications[$indice_tmp]->title, ['id' => $list_doublons_publications[$indice_tmp]->id]) !!} et {!! link_to_route('publication.show', $list_doublons_publications[$indice_tmp+1]->title, ['id' => $list_doublons_publications[$indice_tmp+1]->id]) !!}
                  <?php $indice_tmp++;?>
                @endwhile
                sont des doublons</p></td>
              </tr>
            <?php $indice = $indice_tmp;$indice++;?>
            @endwhile
          </table>
        @else
          <div class="panel-body">
            <p>Il n'y a aucun doublons de publications.</p>
          </div>
        @endif
      </div>
    </div>
  </div>
@stop

@section('blocdroit')
@stop

@section('pied')
@stop
