<?php
/* @var $this TallerController */
/* @var $model Taller */
/* @var $form CActiveForm */
?>

<div class="form">

<fieldset>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'taller-form',
	'enableAjaxValidation'=>false,
	'method'=>'post',
)); ?>

	<p class="note">Los campos con <span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group clearfix">
		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>60,'maxlength'=>256,'class' => 'form-control')); ?>
		<?php echo $form->error($model,'nombre'); ?>
	</div>

	<div class="form-group clearfix">
		<?php echo $form->labelEx($model,'observaciones'); ?>
		<?php echo $form->textArea($model,'observaciones',array('rows'=>4, 'cols'=>30,'class' => 'form-control')); ?>
		<?php echo $form->error($model,'observaciones'); ?>
	</div>

	<div class="form-group col-md-3 col-lg-3 col-sm-6">
		<?php echo $form->labelEx($model,'precio'); ?>
		<div class="">
		<?php echo $form->textField($model,'precio',array('class' => 'form-control')); ?>
		<?php echo $form->error($model,'precio'); ?>
		</div>
	</div>
	<div class="clearfix">&nbsp;</div>
	<div class="form-group col-md-3 col-lg-3 col-sm-6">
		<?php echo $form->labelEx($model,'abreviacion',array('class' => 'contro-label')); ?>
		<div class="">
		<?php echo $form->textField($model,'abreviacion',array('size'=>10,'maxlength'=>10,'class' => 'form-control ')); ?>
		<?php echo $form->error($model,'abreviacion'); ?>
		</div>
	</div>

	<div class="clearfix">&nbsp;</div>
	<div class="form-group clearfix buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar',array('class'=>'btn btn-lg btn-danger')); ?>
	</div>

<?php $this->endWidget(); ?>
</fieldset>
</div><!-- form -->
