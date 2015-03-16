<?php
/* @var $this UsuariorolController */
/* @var $model Usuariorol */

$this->breadcrumbs=array(
	'Usuariorols'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Usuariorol', 'url'=>array('index')),
	array('label'=>'Create Usuariorol', 'url'=>array('create')),
	array('label'=>'View Usuariorol', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Usuariorol', 'url'=>array('admin')),
);
?>

<h1>Update Usuariorol <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>