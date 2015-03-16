<legend><h1>Añadir autor</h1></legend>

<div class="well"><strong><?php echo CHtml::link($comunicacion->identificador.$comunicacion->titulo, $comunicacion->url,array('target'=>'_blank')); ?></strong></div>

<?php if( !empty($comunicacion->inscritoComunicacion )): ?>
  <div class="panel panel-default">
   <div class="panel-heading">Participantes en la comunicación</div>
   <div class="panel-body">
  <dl class="dl-horizontal">
  <?php foreach( $comunicacion->inscritoComunicacion as $key => $comunicador ): ?>
    <dt><?php echo $comunicador->usuario->email; ?></dt>
    <dd><?php 
        echo $comunicador->usuario->nombre." ".$comunicador->usuario->apellido1;
        if(Yii::app()->user->rol == 1 || Yii::app()->user->rol == 2)
          echo " ".CHtml::link('<i class="fa fa-icon fa-trash-o"> </i>',array('inscrito/borrarParticipacion', 'id' => $comunicador->id),array('class' => 'label label-danger','alt' => 'Borrar','confirm'=>'El inscrito dejará de ser participante de la comunicación'));
      ?></dd>    
  <?php endforeach; ?>
    </div>
  </div>
<?php endif; ?>

<h3>Nuevo Comunicador</h3>

<?php
/* @var $this ComunicacionController */
/* @var $comunicacion Comunicacion */
/* @var $form CActiveForm */
?>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
  'id'=>'inscritocomunicacion-form',
  'enableAjaxValidation'=>false,
)); ?>

  
<form class="form-inline">
<fieldset>

<!-- Text input-->
<div class="form-group clearfix">
  <label class="control-label" for="id_usuario"></label>  
  <div class="col-md-4 col-lg-4">
  <?php echo $form->hiddenField($model,'id_usuario'); ?>
    <?php echo $form->error($model,'id_usuario'); ?>
    
  </div>
</div>
<div class="form-group clearfix">
<div class="col-md-4 col-lg-4 clearfix">
<?php /*
$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
'name'=>'InscritoComunicacion_id_usuario',
'value'=>'1',
'model'=>$model,
'source'=>array('asdf','Hugo','ajsj','Hugolanga'),
)); */

  $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
        'attribute'=>'id_usuario',
        

        'sourceUrl'=>array('/user/inscrito/inscritoAutocomplete'),
        'name'=>'InscritoComunicacion_id_usuario_autocompletar',
        'options'=>array(
        'minLength'=>'0',
        'select'=>"js:function(event, ui) { jQuery('#InscritoComunicacion_id_usuario').val(ui.item.id);}"
        ),
        'htmlOptions'=>array(
          'size'=>45,
          'maxlength'=>45,
          'class'=>'form-control',
          'placeholder'=>'Buscar...',
        ),
  )); ?>
</div>

<div class="row buttons col-md-2 col-lg-2">
    <center><?php echo CHtml::submitButton($comunicacion->isNewRecord ? 'Crear' : 'Guardar',array('class' => 'btn btn-danger')); ?></center>
</div>
</div>
</fieldset>
</form>
<?php $this->endWidget(); ?>
</div><!-- form -->
