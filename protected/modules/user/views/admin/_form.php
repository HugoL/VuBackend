<div class="container-fluid">
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>true,
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
));
?>
<fieldset>

	<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>

	<?php echo $form->errorSummary(array($model,$profile)); ?>

	<div class="form-group clearfix">
		<div class="col-md-2 col-lg-2">
		<?php echo $form->labelEx($model,'username'); ?>
		</div>
		<div class="col-md-4 col-lg-4">
		<?php echo $form->textField($model,'username',array('size'=>20,'maxlength'=>20,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'username'); ?>
		<span class="help-block">Para que el usuario pueda loguearse con su usuario y contraseña de su correo de la universidad, introducir aquí su nombre de usuario del correo (sin @unizar.es). Si no, se debe poner un usuario y una contraseña para que acceda como usuario de Virtual USATIC</span>
		</div>
	</div>

	<div class="form-group clearfix">
		<div class="col-md-2 col-lg-2">
		<?php echo $form->labelEx($model,'password'); ?>
		</div>
		<div class="col-md-4 col-lg-4">
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>128,'class'=>'form-control','placeholder'=>'Rellenar solo si es necesario')); ?><span class="help-block">Para que el usuario tenga que loguearse con su nombre de usuario y contraseña de su correo de la universidad, se debe dejar este campo en blanco.</span>  
  </div>
		<?php echo $form->error($model,'password'); ?>
		</div>
	</div>

	<div class="form-group clearfix">
		<div class="col-md-2 col-lg-2">
		<?php echo $form->labelEx($model,'email'); ?>
		</div>
		<div class="col-md-6 col-lg-6">
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'email'); ?>
		</div>
	</div>

	<?php if( Yii::app()->getModule('user')->isAdmin() ): ?>
	<div class="form-group clearfix">
		<div class="col-md-2 col-lg-2">
		<?php echo $form->labelEx($model,'superuser'); ?>
		</div>
		<div class="col-md-2 col-lg-2">
		<?php echo $form->dropDownList($model,'superuser',User::itemAlias('AdminStatus'),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'superuser'); ?>
	</div>
	</div>
	<?php endif; ?>

	<div class="form-group clearfix">
		<div class="col-md-2 col-lg-2">
		<?php echo $form->labelEx($model,'status'); ?>
		</div>
		<div class="col-md-4 col-lg-4">
		<?php echo $form->dropDownList($model,'status',User::itemAlias('UserStatus'),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>
	</div>
<?php 
		$profileFields=$profile->getFields();
		if ($profileFields) {
			foreach($profileFields as $field) {
			?>
	<div class="form-group clearfix">
		<div class="col-md-2 col-lg-2">
		<?php echo $form->labelEx($profile,$field->varname); ?>
		</div>
		<div class="col-md-4 col-lg-4">
		<?php 
		if ($widgetEdit = $field->widgetEdit($profile)) {
			echo $widgetEdit;
		} elseif ($field->range) {
			echo $form->dropDownList($profile,$field->varname,Profile::range($field->range));
		} elseif ($field->field_type=="TEXT") {
			echo CHtml::activeTextArea($profile,$field->varname,array('rows'=>6, 'cols'=>50,'class'=>'form-control'));
		} else {
			echo $form->textField($profile,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255),'class'=>'form-control' ));
		}
		 ?>
		<?php echo $form->error($profile,$field->varname); ?>
		</div>
	</div>
			<?php
			}
		}
?>
	<?php if( Yii::app()->getModule('user')->esAdministrador() ): ?>
	<div class="form-group clearfix">
		<div class="col-md-2 col-lg-2">
		<?php echo $form->labelEx($profile,'rol'); ?>
	</div>
	<div class="col-md-4 col-lg-4">
		<?php echo $form->dropDownList($profile,'rol', CHtml::listData(Usuariorol::model()->findAll(), 'id', 'rol'),array('class'=>'form-control'),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'rol'); ?>
	</div>
	</div>
	<?php endif; ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save'),array('class' => 'btn btn-lg btn-danger')); ?>
	</div>
</fieldset>
<?php $this->endWidget(); ?>

</div><!-- form -->
</div>