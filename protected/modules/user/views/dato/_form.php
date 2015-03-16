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
		<?php echo $form->labelEx($model,'clave'); ?>
		<?php echo $form->textField($model,'clave',array('size'=>60,'maxlength'=>128,'class'=>'form-control input')); ?>
		<?php echo $form->error($model,'clave'); ?>
	</div>

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