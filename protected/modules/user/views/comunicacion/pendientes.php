<?php
/* @var $this ComunicacionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Comunicaciones',
);

$this->menu=array(
	array('label'=>'Create Comunicacion', 'url'=>array('create')),
	array('label'=>'Manage Comunicacion', 'url'=>array('admin')),
);
?>
<h3>Pendientes de revisar</h3>
<div class="table-responsive">
<table class="table table-striped">
	<tr>
		<th>Código</th>
		<th>Título</th>
		<th>Observaciones</th>
		<th>Autores</th>
		<th>Me lo pido</th>
		<th>Tipo</th>
		<th>Aprobado</th>
		<th></th>
	</tr>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_pendiente',
)); ?>
</table>
</div>  