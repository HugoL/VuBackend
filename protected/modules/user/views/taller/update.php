<?php
/* @var $this TallerController */
/* @var $model Taller */

$this->breadcrumbs=array(
	'Tallers'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Taller', 'url'=>array('index')),
	array('label'=>'Create Taller', 'url'=>array('create')),
	array('label'=>'View Taller', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Taller', 'url'=>array('admin')),
);
?>

<h1>Modificar taller</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>