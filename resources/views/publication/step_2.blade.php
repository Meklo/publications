@extends('template_base')

@section('titre')
Inscription
@stop

@section('head')

{!!Html::style('css/base.css')!!}
{!!Html::style('css/bootstrap-multiselect.css')!!}
<script type="text/javascript" src="{{ URL::asset('js/bootstrap-multiselect.js') }}"></script>
<script type="text/javascript">


    $(document).ready(function() {
        var orderCount = 0;

        
        $('#author_select').multiselect({
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
                if (options.length === 0) {
                    return 'Aucun sélectionné';
                }
                
                else {
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
 
                    return text.substr(0, text.length -2);
                }
            },
        });
        
            $(document).ready(function() {
        $('#example-getting-started').multiselect();
    });
 
        $('#btn_submit').on('click', function() {
            var selected = [];
            $('#author_select option:selected').each(function() {
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
<br>
<div class="container">
<div class="flash-message">
    
    
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))

      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
      @endif
    @endforeach
  </div> <!-- end .flash-message -->


<div class="panel panel-default">
  <div class="panel-heading"><h4>{{ $type->sigle .': '. $type->name }}</h4></div>
  <div class="panel-body">
    {!! Form::open(array( 'url' => 'publication/create' , 'id' => 'form_publication')) !!}
      
    <div class="form-group {!! $errors->has('title') ? 'has-error' : '' !!}">
      {!! Form::label('title', 'Titre :') !!}
      {!! Form::text('title', null, array('class' => 'form-control', 'required' => 'required')) !!}
      {!! $errors->first('title', '<small class="help-block">:message</small>') !!}
    </div>
    
    @if ($type->sigle == 'CI' || $type->sigle == 'CF' || $type->sigle == 'RI' || $type->sigle == 'RF' || $type->sigle == 'OS' )
    <div class="form-group {!! $errors->has('label') ? 'has-error' : '' !!}">
      {!! Form::label('label', 'Label :') !!}
      {!! Form::text('label', null, array('class' => 'form-control', 'required' => 'required')) !!}
      {!! $errors->first('label', '<small class="help-block">:message</small>') !!}
    </div>
    @endif
    
    <div class="form-group {!! $errors->has('year') ? 'has-error' : '' !!}">
      {!! Form::label('year', 'Année de publication :') !!}
      {!! Form::number('year', null, array('class' => 'form-control', 'required' => 'required')) !!}
      {!! $errors->first('year', '<small class="help-block">:message</small>') !!}
    </div>
    
    @if ($type->sigle == 'CI' || $type->sigle == 'CF')
    <div class="form-group {!! $errors->has('place') ? 'has-error' : '' !!}">
      {!! Form::label('place', 'Lieu de conférence :') !!}
      {!! Form::text('place', null, array('class' => 'form-control', 'required' => 'required')) !!}
      {!! $errors->first('place', '<small class="help-block">:message</small>') !!}
    </div>
    @endif
    
    <div class="form-group {!! $errors->has('authors') ? 'has-error' : '' !!}">
      {!! Form::label('authors', 'Sélection auteurs :') !!}
 
      {{ Form::select('user_list[]',$users ,null,array('multiple'=>'multiple','id' => 'author_select')) }}
      {!! $errors->first('authors', '<small class="help-block">:message</small>') !!}
      <br/>
    <div class="form-group">
      {!! Form::hidden('order_author','', array('id' => 'order_author')) !!}
      {!! Form::submit('Valider', array('class' => 'btn btn-primary', 'id' => 'btn_submit')) !!}
    </div>
    {!! Form::close() !!}
  </div>
</div>
  </div>
@stop

@section('pied')
@stop