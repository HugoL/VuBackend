<?php
/* @var $this TallerController */
/* @var $model Taller */

$this->breadcrumbs=array(
	'Tallers'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Taller', 'url'=>array('index')),
	array('label'=>'Create Taller', 'url'=>array('create')),
	array('label'=>'Update Taller', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Taller', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Taller', 'url'=>array('admin')),
);
?>

<h1>View Taller #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nombre',
		'observaciones',
		'jornada',
		'precio',
		'abreviacion',
		'precio_detalle',
	),
)); ?>
