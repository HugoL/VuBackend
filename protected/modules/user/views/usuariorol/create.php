<?php
/* @var $this UsuariorolController */
/* @var $model Usuariorol */

$this->breadcrumbs=array(
	'Usuariorols'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Usuariorol', 'url'=>array('index')),
	array('label'=>'Manage Usuariorol', 'url'=>array('admin')),
);
?>

<h1>Create Usuariorol</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>