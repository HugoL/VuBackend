<?php
/* @var $this ParametroController */
/* @var $model Parametro */

$this->breadcrumbs=array(
	'Parametros'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Parametro', 'url'=>array('index')),
	array('label'=>'Manage Parametro', 'url'=>array('admin')),
);
?>

<h1>Crear Parametro</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>