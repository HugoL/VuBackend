<?php
/* @var $this ComunicacionController */
/* @var $model Comunicacion */

$this->breadcrumbs=array(
	'Comunicaciones'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'List Comunicacion', 'url'=>array('index')),
	array('label'=>'Manage Comunicacion', 'url'=>array('admin')),
);
?>
<legend><h1>Nueva Comunicacion o Póster</h1></legend>
<?php if(Yii::app()->user->hasFlash('success')):?>
    <div class="alert alert-success">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php endif; ?>
<?php if(Yii::app()->user->hasFlash('error')):?>
    <div class="alert alert-danger">
        <?php echo Yii::app()->user->getFlash('error'); ?>
    </div>
<?php endif; ?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>