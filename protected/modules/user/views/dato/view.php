<?php
/* @var $this DatoController */
/* @var $model Dato */

$this->breadcrumbs=array(
	'Datos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Dato', 'url'=>array('index')),
	array('label'=>'Create Dato', 'url'=>array('create')),
	array('label'=>'Update Dato', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Dato', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Dato', 'url'=>array('admin')),
);
?>

<h1>View Dato #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'clave',
		'valor',
	),
)); ?>
