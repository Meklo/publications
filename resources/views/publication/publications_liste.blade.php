@extends('template_base')

@section('titre')

Publications

@stop

@section('head')
<link rel="stylesheet" href="./css/base.css">
<script type="text/javascript">
    $(document).ready(function() {
        $("#searchCat").hide();
        
        $("#button_searchCat").click(function(){
            $("#searchCat").slideToggle();
        });
        
    });
</script>
@stop

@section('blocgauche')

@stop



@section('contenu')
<br>
<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))

      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
      @endif
    @endforeach
  </div> <!-- end .flash-message -->

<div class="container">
  <div class="col-md-11">
    <div class="panel panel-default">
      <div class="panel-heading"><h4>{{ $tabName }}</h4></div>

      @if (count($publications) > 0)
        <table class="table">
          <tr>
            <th>Titre</th>
            <th>Auteurs</th>
            <th>Catégorie</th>
            <th>Année</th>
            <th></th>
            <th></th>
          </tr>
        @foreach ($publications as $publication)
          <tr>
            <td><strong>{{$publication->title}}</strong></td>
            <td><?php $ordre_user=array();
                $id_users = array();
            ?>
                @foreach ($publication->users as $user)
                  <?php
                    // mettre les users dans l'ordre
                      $ordre_user[$user->pivot->ordre] = $user->first_name.' '.$user->name;
                      $id_users[$user->pivot->ordre] = $user->id;
                  ?>
                @endforeach
                <?php
                  ksort($ordre_user);
                  ksort($id_users);

                  $auteurs_tab = array();

                  $iterator = new MultipleIterator;
                  $iterator->attachIterator(new ArrayIterator($ordre_user));
                  $iterator->attachIterator(new ArrayIterator($id_users));

                  foreach ($iterator as $keys => $values) {
                    $auteurs_tab[]= array($values[0], $values[1] ) ;
                  }

                ?>
                @foreach($auteurs_tab as $lien_auteur)
                    {!! link_to_route('user.publications', $lien_auteur[0], ['id' => $lien_auteur[1]]) !!}
                    <br>
                @endforeach
            </td>
            <td>{{$categories_tab[$publication->type]}}</td>
            <td>{{$publication->year}}</td>
            @if (Auth::check() and Auth::user()['relations']['equipe']['relations']['organisation']['attributes']['name'] == 'UTT')
                @if(in_array(Auth::user()->id, $id_users))
                    <td>{!! link_to_route('publication.show', 'Voir', ['id' => $publication->id], ['class' => 'btn btn-default'])!!}</td>
                    <td>{!! link_to_route('publication.edit', 'Modifier', [$publication->id], ['class' => 'btn btn-primary'])!!}</td>
                @else
                    <td colspan="2">{!! link_to_route('publication.show', 'Voir', ['id' => $publication->id], ['class' => 'btn btn-default'])!!}</td>
                @endif
            @else
              <td colspan="2">{!! link_to_route('publication.show', 'Voir', ['id' => $publication->id], ['class' => 'btn btn-default'])!!}</td>
            @endif
          </tr>
        @endforeach
      </table>

      @else

      <div class="panel-body">

          Aucun résultat n'a été retourné
      </div>

      @endif


    </div>
  </div>
</div>
@stop


@section('pied')
<div class="col-sm-8  col-sm-offset-1 text-left">
<div class="row">
    
        <div class="panel panel-default">
      <!-- Default panel contents -->
      <div class="panel-heading">Fonctions de recherche</div>
      <div class="panel-body">
        <p>A partir de cette interface vous pouvez filter l'affichage des publications via différentes fonctions de recherche</p>
      </div>

      <!-- List group -->
      <ul class="list-group">
        
          <li class="list-group-item"><div id='button_searchCat'><h5>FILTRER CATEGORIE<span class="caret pull-right"/></h5></div>
              <div id='searchCat' style="display:none;">
                  
            {!! Form::open(array('route' => ['publication.searchCat'], 'class' => 'form-inline')) !!}
        
            <div class="well well-lg">
            <div class="form-group">
              {!! Form::select('type', $categories_tab,  array('id' => 'type', 'class' => 'form-control')) !!}
            </div>

            <div class="form-group pull-right">
              {!! Form::submit('Rechercher', array('class' => 'btn btn-primary', 'id' => 'btn_submit')) !!}
            </div>
               </div>
          
        </div>
            
            {!! Form::close() !!}
        </li>
        
<!--         <li class="list-group-item"><h5>FILTRER PUBLICATIONS EQUIPES</h5>
            {!! Form::open(array('action' => 'EquipesController@postPublicationsForm', 'class' => 'form-inline')) !!}
        
            <div class="well well-lg">
            <div class="form-group">
              {!! Form::select('type', $categories_tab) !!}
            </div>

            <div class="form-group pull-right">
              {!! Form::submit('Rechercher', array('class' => 'btn btn-primary', 'id' => 'btn_submit')) !!}
            </div>
        </div>
            
            {!! Form::close() !!}
        </li>-->

      </ul>
    </div>
</div>
</div>
@stop

