<?php
/* @var $this ParametroController */
/* @var $model Parametro */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'parametro-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group clearfix">
		<?php echo $form->labelEx($model,'parametro',array('class' => 'col-md-2 col-lg-2 control-label')); ?>
		<div class="col-md-4 col-lg-4">
		<?php echo $form->textField($model,'parametro',array('size'=>60,'maxlength'=>256, 'class' => 'form-control')); ?>
		<?php echo $form->error($model,'parametro'); ?>
		</div>
	</div>

	<div class="form-group clearfix">
		<?php echo $form->labelEx($model,'valor',array('class' => 'col-md-2 col-lg-2 control-label')); ?>
		<div class="col-md-4 col-lg-4">
		<?php echo $form->textField($model,'valor',array('size'=>60,'maxlength'=>256, 'class' => 'form-control')); ?>
		<?php echo $form->error($model,'valor'); ?>
		</div>
	</div>

	<div class="row buttons col-md-6 col-lg-6">
		<center><?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar',array('class' => 'btn btn-danger btn-lg')); ?></center>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->