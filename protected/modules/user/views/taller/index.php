<?php
/* @var $this TallerController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tallers',
);

$this->menu=array(
	array('label'=>'Create Taller', 'url'=>array('create')),
	array('label'=>'Manage Taller', 'url'=>array('admin')),
);
?>

<h1>Talleres</h1>
<center><?php echo CHtml::link('Nuevo taller',array('create'),array('class'=>'btn btn-lg btn-danger')); ?></center><br />
<?php if( !empty($model) ):  ?>
	<table class="table table-bordered table-hover table-striped">
	<thead>
		<tr>
			<th>Identificador</th>
			<th>Nombre</th>
			<th>Observaciones</th>
			<th>Precio</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach( $model as $key => $taller ): ?>
		<tr>
			<?php $this->renderPartial('_view',array('data'=>$taller)); ?>
		</tr>
		<?php endforeach; ?>
	</tbody>
	</table>
<?php else: ?>
	<div class="alert alert-info">No hay talleres en esta edición</div>
<?php endif; ?>