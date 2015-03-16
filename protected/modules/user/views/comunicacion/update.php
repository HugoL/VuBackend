<?php
/* @var $this ComunicacionController */
/* @var $model Comunicacion */

$this->breadcrumbs=array(
	'Comunicacions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Comunicacion', 'url'=>array('index')),
	array('label'=>'Create Comunicacion', 'url'=>array('create')),
	array('label'=>'View Comunicacion', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Comunicacion', 'url'=>array('admin')),
);
?>

<h1>Update Comunicacion <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>