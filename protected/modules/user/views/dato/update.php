<?php
/* @var $this DatoController */
/* @var $model Dato */

$this->breadcrumbs=array(
	'Datos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Dato', 'url'=>array('index')),
	array('label'=>'Create Dato', 'url'=>array('create')),
	array('label'=>'View Dato', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Dato', 'url'=>array('admin')),
);
?>

<legend><h1>Actualizar Parámetro</h1></legend>
<div class="container-fluid">
<?php echo $this->renderPartial('_formupdate', array('model'=>$model)); ?>
</div>