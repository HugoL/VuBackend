<?php
/* @var $this UsuariorolController */
/* @var $model Usuariorol */

$this->breadcrumbs=array(
	'Usuariorols'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Usuariorol', 'url'=>array('index')),
	array('label'=>'Create Usuariorol', 'url'=>array('create')),
	array('label'=>'Update Usuariorol', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Usuariorol', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Usuariorol', 'url'=>array('admin')),
);
?>

<h1>View Usuariorol #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'rol',
	),
)); ?>
