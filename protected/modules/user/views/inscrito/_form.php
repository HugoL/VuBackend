<?php
/* @var $this InscritoController */
/* @var $model Inscrito */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'inscrito-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'apellido1'); ?>
		<?php echo $form->textField($model,'apellido1',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'apellido1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'apellido2'); ?>
		<?php echo $form->textField($model,'apellido2',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'apellido2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nif'); ?>
		<?php echo $form->textField($model,'nif',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'nif'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nacionalidad'); ?>
		<?php echo $form->textField($model,'nacionalidad',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'nacionalidad'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'direccion'); ?>
		<?php echo $form->textField($model,'direccion',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'direccion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cp'); ?>
		<?php echo $form->textField($model,'cp',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'cp'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'localidad'); ?>
		<?php echo $form->textField($model,'localidad',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'localidad'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'provincia'); ?>
		<?php echo $form->textField($model,'provincia',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'provincia'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'telefono'); ?>
		<?php echo $form->textField($model,'telefono',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'telefono'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sexo'); ?>
		<?php echo $form->textField($model,'sexo'); ?>
		<?php echo $form->error($model,'sexo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pais'); ?>
		<?php echo $form->textField($model,'pais',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'pais'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cargo'); ?>
		<?php echo $form->textField($model,'cargo',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'cargo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'razonSocial'); ?>
		<?php echo $form->textField($model,'razonSocial',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'razonSocial'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nifEmpresa'); ?>
		<?php echo $form->textField($model,'nifEmpresa',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'nifEmpresa'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'direccionEmpresa'); ?>
		<?php echo $form->textField($model,'direccionEmpresa',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'direccionEmpresa'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'titulacion'); ?>
		<?php echo $form->textField($model,'titulacion',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'titulacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'edicion'); ?>
		<?php echo $form->textField($model,'edicion',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'edicion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'observaciones'); ?>
		<?php echo $form->textArea($model,'observaciones',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'observaciones'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'observaciones2'); ?>
		<?php echo $form->textArea($model,'observaciones2',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'observaciones2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fecha'); ?>
		<?php echo $form->textField($model,'fecha'); ?>
		<?php echo $form->error($model,'fecha'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pagado'); ?>
		<?php echo $form->textField($model,'pagado'); ?>
		<?php echo $form->error($model,'pagado'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'talleres'); ?>
		<?php echo $form->textField($model,'talleres'); ?>
		<?php echo $form->error($model,'talleres'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'coursesites'); ?>
		<?php echo $form->textField($model,'coursesites',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'coursesites'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_rol'); ?>
		<?php echo $form->textField($model,'id_rol'); ?>
		<?php echo $form->error($model,'id_rol'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->