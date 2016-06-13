@extends('template_base')

@section('titre', $publication->title. ' | Modification publication')

@section('head')
{!!Html::style('css/base.css')!!}
{!!Html::style('css/bootstrap-multiselect.css')!!}
<script type="text/javascript" src="{{ URL::asset('js/bootstrap-multiselect.js') }}"></script>
<script type="text/javascript">


    $(document).ready(function() {
        var orderCount = 0;
        var first = true;
        $('#user_list').multiselect({

            onInitialized: function(){
                   // $("option[value='3']").attr('selected', 'selected');

            },

            onChange: function(option, checked) {
                if (checked) {
                    orderCount++;
                    $(option).data('order', orderCount);
                }
                else {
                    $(option).data('order', '');
                }
            },
            buttonText: function(options) {
                var result = '';

                if (options.length === 0) {
                    result= 'Aucun sélectionné';
                }else{
                    var selected = [];
                    options.each(function() {
                        selected.push([$(this).text(), $(this).data('order')]);
                    });

                    selected.sort(function(a, b) {
                        return a[1] - b[1];
                    });

                    var text = '';
                    for (var i = 0; i < selected.length; i++) {
                        text += selected[i][0] + ', ';
                    }

                    result = text.substr(0, text.length -2);
                }
                if(first){
                    result = '<?php echo $initialString; ?>';

                    first = false;
                }
                return result;
            },
        });

         $('#btn_submit').on('click', function() {

            var selected = [];
            $('#user_list option:selected').each(function() {
                selected.push([$(this).val(), $(this).data('order')]);
            });

            selected.sort(function(a, b) {
                return a[1] - b[1];
            });

            var text = '';
            for (var i = 0; i < selected.length; i++) {
                text += selected[i][0] + ', ';
            }
            text = text.substring(0, text.length - 2);

            document.getElementById('order_author').value = text;
        });

    });
 </script>
@stop

@section('blocgauche')
@stop

@section('contenu')
</br>
  <div class="container">
    <div class="col-md-11">
      <div class="panel panel-default">
        <div class="panel-heading"><h4>Modification de la publication : '{!! $publication->title !!}' </h4></div>
          <div class="panel-body">
              {!! Form::model($publication, array('route' => ['publication.update', $publication->id])) !!}

              <div class="form-group {!! $errors->has('title') ? 'has-error' : '' !!}">
                {!! Form::label('title', 'Titre :') !!}
                {!! Form::text('title', null, array('class' => 'form-control')) !!}
                {!! $errors->first('title', '<small class="help-block">:message</small>') !!}
              </div>

                @if ($publication->type == 'CI' || $publication->type == 'CF' || $publication->type == 'RI' || $publication->type == 'RF' || $publication->type == 'OS' )
                <div class="form-group {!! $errors->has('label') ? 'has-error' : '' !!}">
                  {!! Form::label('label', 'Label :') !!}
                  {!! Form::text('label', null, array('class' => 'form-control', 'required' => 'required')) !!}
                  {!! $errors->first('label', '<small class="help-block">:message</small>') !!}
                </div>
                @endif

                <div class="form-group {!! $errors->has('authors') ? 'has-error' : '' !!}">
                {!! Form::label('users_list', 'Sélection auteurs :') !!}
                {!! Form::select('user_list[]', $usersTotal , $ordreAuteurs ,array('multiple'=>'multiple','id' => 'user_list')) !!}
                {!! $errors->first('authors', '<small class="help-block">:message</small>') !!}
                <br/>
                </br>
              <div class="form-group">
                {!! Form::hidden('order_author','', array('id' => 'order_author')) !!}
                {!! Form::submit('Valider', array('class' => 'btn btn-success', 'id' => 'btn_submit')) !!}

                 <div class="form-group pull-right">
                     <a class="btn btn-danger btn-close" href="{{ route('publication.index') }}">Annuler</a>
                 </div>


              </div>


              {!! Form::close() !!}
          </div>
      </div>
    </div>
  </div>


@stop
