<?php
/* @var $this InscritoController */
/* @var $model Inscrito */

$this->breadcrumbs=array(
	'Inscritos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Inscrito', 'url'=>array('index')),
	array('label'=>'Manage Inscrito', 'url'=>array('admin')),
);
?>

<h1>Create Inscrito</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>