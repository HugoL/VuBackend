<div class="container-fluid">
<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <div class="row">
        <?php echo $form->label($model,'id'); ?>
        <?php echo $form->textField($model,'id',array('class'=>'form-control')); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'username'); ?>
        <?php echo $form->textField($model,'username',array('size'=>20,'maxlength'=>20,'class'=>'form-control')); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'email'); ?>
        <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128,'class'=>'form-control')); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'activkey'); ?>
        <?php echo $form->textField($model,'activkey',array('size'=>60,'maxlength'=>128,'class'=>'form-control')); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'create_at'); ?>
        <?php echo $form->textField($model,'create_at',array('class'=>'form-control')); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'lastvisit_at'); ?>
        <?php echo $form->textField($model,'lastvisit_at',array('class'=>'form-control')); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'superuser'); ?>
        <?php echo $form->dropDownList($model,'superuser',$model->itemAlias('AdminStatus'),array('class'=>'form-control')); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'status'); ?>
        <?php echo $form->dropDownList($model,'status',$model->itemAlias('UserStatus'),array('class'=>'form-control')); ?>
    </div>
    <div class="clearfix">&nbsp;</div>
    <div class="row buttons">
        <?php echo CHtml::submitButton('Buscar',array('class'=>'btn btn-danger')); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
</div>