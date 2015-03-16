<?php
/* @var $this InscritoController */
/* @var $model Inscrito */

$this->breadcrumbs=array(
	'Inscritos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Inscrito', 'url'=>array('index')),
	array('label'=>'Create Inscrito', 'url'=>array('create')),
	array('label'=>'View Inscrito', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Inscrito', 'url'=>array('admin')),
);
?>

<h1>Update Inscrito <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>