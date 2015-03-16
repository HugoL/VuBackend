<?php
/* @var $this DatoController */
/* @var $model Dato */
/* @var $form CActiveForm */
?>

<div class="form col-md-6 col-lg-6">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'dato-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<h2><label class="label label-default"><?php echo $model->clave; ?></label></h2>
	</div>
	<?php if( strcmp($model->clave,'edicion') == 0 ): ?>
		<div class="row">
		<div class="alert alert-info">Introducir el año de la edición (ejemplo: <strong>2015</strong>). <br/>
		<strong>Atención:</strong> Si se cambia la edición, el listado de inscritos, comunicaciones y talleres cambiará y se mostrarán los correspondientes a la edición especificada</div>
		</div>
	<?php endif; ?>
	<div class="row">
		<?php echo $form->labelEx($model,'valor'); ?>
		<?php echo $form->textField($model,'valor',array('size'=>60,'maxlength'=>128,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'valor'); ?>
	</div>

	<div class="clearfix">&nbsp;</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar',array('class' => 'btn btn-danger btn-lg')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->