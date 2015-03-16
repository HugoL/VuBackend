<?php
/* @var $this DatoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Datos',
);

$this->menu=array(
	array('label'=>'Create Dato', 'url'=>array('create')),
	array('label'=>'Manage Dato', 'url'=>array('admin')),
);
?>

<legend><h1>Configuración</h1></legend>

<div class="clearfix"><?php echo CHtml::link('Añadir parámetro',array('create'),array('class' => 'btn btn-danger')); ?></div><br/>

<table class="table">
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
</table>