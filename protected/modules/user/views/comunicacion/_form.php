<?php
/* @var $this ComunicacionController */
/* @var $model Comunicacion */
/* @var $form CActiveForm */
?>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'comunicacion-form',
	'enableAjaxValidation'=>false,
)); ?>

	
<form class="form-horizontal">
<fieldset>

<!-- Text input-->
<div class="form-group clearfix">
  <label class="col-md-2 col-lg-2 control-label" for="textinput">Título</label>  
  <div class="col-md-4 col-lg-4">
  <?php echo $form->textField($model,'titulo',array('size'=>60,'maxlength'=>256,'class' => 'form-control')); ?>
		<?php echo $form->error($model,'titulo'); ?>
    
  </div>
</div>

<div class="form-group clearfix">
  <label class="col-md-2 col-lg-2 control-label" for="textinput">Identificador</label>  
  <div class="col-md-4 col-lg-4">
  <?php echo $form->textField($model,'identificador',array('size'=>60,'maxlength'=>128,'class' => 'form-control')); ?>
		<?php echo $form->error($model,'identificador'); ?>
    
  </div>
</div>

<!-- Text input-->
<div class="form-group clearfix">
  <label class="col-md-2 col-lg-2 control-label" for="Autores">Autores</label>  
  <div class="col-md-4 col-lg-4">
  <?php echo $form->textArea($model,'autores',array('rows'=>6, 'cols'=>50,'class' => 'form-control')); ?>
		<?php echo $form->error($model,'autores'); ?>
    
  </div>
</div>

<!-- Text input-->
<div class="form-group clearfix">
  <label class="col-md-2 col-lg-2 control-label" for="Autores">Url</label>  
  <div class="col-md-4 col-lg-4">
  <?php echo $form->textField($model,'url',array('size'=>60, 'maxlength'=>256,'class' => 'form-control')); ?>
		<?php echo $form->error($model,'url'); ?>
    
  </div>
</div>

<!-- Select Basic -->
<div class="form-group clearfix">
  <label class="col-md-2 col-lg-2 control-label" for="Tipo">Tipo</label>
  <div class="col-md-4 col-lg-4">
     <?php echo $form->dropDownList($model,'tipo',array('0'=>'Comunicación', '1'=>'Póster'),array('class' => 'form-control')); ?>
  </div>
  <?php echo $form->error($model,'tipo'); ?>
</div>

<!-- Select Basic -->
<div class="form-group clearfix">
  <label class="col-md-2 col-lg-2 control-label" for="areatematica">Área Temática</label>
  <div class="col-md-4 col-lg-4">
    <?php echo $form->dropDownList($model, 
                 'id_area', 
                  CHtml::listData(Area::model()->findAll(), 'id', 'nombre'),array('class' => 'form-control'));?>
    <?php echo $form->error($model,'id_area'); ?>
  </div>
</div>

<!-- Textarea -->
<div class="form-group clearfix">
  <label class="col-md-2 col-lg-2 control-label" for="observaciones">Observaciones</label>
  <div class="col-md-4 col-lg-4">                     
    <?php echo $form->textArea($model,'observaciones',array('rows'=>6, 'cols'=>50,'class' => 'form-control')); ?>
		<?php echo $form->error($model,'observaciones'); ?>
  </div>
</div>
<div class="row buttons col-md-6 col-lg-6">
		<center><?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar',array('class' => 'btn btn-danger btn-lg')); ?></center>
</div>
</fieldset>
</form>
<?php $this->endWidget(); ?>
</div><!-- form -->
