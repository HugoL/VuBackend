<?php
/* @var $this UsuariorolController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Usuariorols',
);

$this->menu=array(
	array('label'=>'Create Usuariorol', 'url'=>array('create')),
	array('label'=>'Manage Usuariorol', 'url'=>array('admin')),
);
?>

<h1>Usuariorols</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
