<?php
/* @var $this InscritoController */
/* @var $model Inscrito */

$this->breadcrumbs=array(
	'Inscritos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Inscrito', 'url'=>array('index')),
	array('label'=>'Create Inscrito', 'url'=>array('create')),
	array('label'=>'Update Inscrito', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Inscrito', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Inscrito', 'url'=>array('admin')),
);
?>
<?php if( Yii::app()->user->hasFlash('success') ): ?>
	<div class="alert alert-success"><?php echo Yii::app()->user->getFlash('success'); ?></div>
<?php endif; ?>

<?php if( Yii::app()->user->hasFlash('error') ): ?>
	<div class="alert alert-danger"><?php echo Yii::app()->user->getFlash('error'); ?></div>
<?php endif; ?>

<?php if( Yii::app()->user->hasFlash('info') ): ?>
	<div class="alert alert-info"><?php echo Yii::app()->user->getFlash('info'); ?></div>
<?php endif; ?>

<center><?php echo CHtml::link('<i class="fa fa-arrow-left"></i> Volver',CHttpRequest::getUrlReferrer(),array('class' => 'btn btn-danger btn-lg')); ?></center>
<h1><?php echo $model->nombre. " ".$model->apellido1." ".$model->apellido2; ?></h1>
  

<?php // LISTO LAS COMUNICACIONES ASOCIADAS AL INSCRITO ?>
<?php if( !empty($model->inscritoComunicacion )): ?>
	<div class="panel panel-default">
 	 <div class="panel-heading">Comunicaciones en las que participa</div>
 	 <div class="panel-body">
	<dl class="dl-horizontal">
  <?php foreach ($model->inscritoComunicacion as $key => $comunicacion): ?>

  <dt><?php echo $comunicacion->comunicacion->identificador; ?></dt>
  <dd><?php 
  		echo $comunicacion->comunicacion->titulo;
  		if(Yii::app()->user->rol == 1 || Yii::app()->user->rol == 2)
  			echo " ".CHtml::link('<i class="fa fa-icon fa-trash-o"> </i>',array('inscrito/borrarParticipacion', 'id' => $comunicacion->id),array('class' => 'label label-danger','alt' => 'Borrar','confirm'=>'El inscrito dejará de ser participante de la comunicación'));
   ?></dd>
  <?php endforeach; ?>
  </dl>
  </div>
</div>
<?php endif; ?>

<?php if( $model->id_rol == 2 && (Yii::app()->user->rol == 1 || Yii::app()->user->rol == 2) ): ?>
	<div class="well">
		<h4>Indicar comunicación en la que participa el inscrito:</h4>
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'inscritocomunicacion-form',
			'enableAjaxValidation'=>false,
			)); ?>
			<form class="form-inline">
				<fieldset>

					<!-- Text input-->
					<div class="form-group clearfix">
						<label class="control-label" for="id_comunicacion"></label>  
						<div class="col-md-4 col-lg-4">
							<?php echo $form->hiddenField($inscritoComunicacion,'id_comunicacion'); ?>
							<?php echo $form->error($inscritoComunicacion,'id_comunicacion'); ?>  
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
	'attribute'=>'id_comunicacion',


	'sourceUrl'=>array('/user/comunicacion/comunicacionAutocomplete'),
	'name'=>'InscritoComunicacion_id_comunicacion_autocompletar',
	'options'=>array(
		'minLength'=>'0',
		'select'=>"js:function(event, ui) { jQuery('#InscritoComunicacion_id_comunicacion').val(ui.item.id);}"
		),
	'htmlOptions'=>array(
		'size'=>45,
		'maxlength'=>45,
		'class'=>'form-control',
		'placeholder'=>'Buscar comunicación...',
		),
		)); ?>  
	</div>

	<div class="row buttons col-md-2 col-lg-2">
		<center><?php echo CHtml::submitButton('Guardar',array('class' => 'btn btn-danger')); ?></center>
	</div>
</div>
</fieldset>
</form>
</div><!-- /form -->
<?php $this->endWidget(); ?>
<?php endif; ?>
<table class="table table-bordered table-hover table-striped">
<?php $this->renderPartial('_detalle', array('data' => $model)); ?>
</table>
<?php /*$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nombre',
		'apellido1',
		'apellido2',
		'email',
		'nif',
		'nacionalidad',
		'direccion',
		'cp',
		'localidad',
		'provincia',
		'telefono',
		'sexo',
		'pais',
		'cargo',
		'razonSocial',
		'nifEmpresa',
		'direccionEmpresa',
		'titulacion',
		'edicion',
		'observaciones',
		'observaciones2',
		'fecha',
		'pagado',
		'talleres',
		'coursesites',
		'id_rol',
	),
)); */ ?>

<center><?php echo CHtml::link('<i class="fa fa-arrow-left"></i> Volver',CHttpRequest::getUrlReferrer(),array('class' => 'btn btn-danger btn-lg')); ?></center>