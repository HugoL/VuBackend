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
<center><?php echo CHtml::link('Nuevo taller',array('create'),array('class'=>'btn btn-lg btn-danger')); ?>&nbsp;
	<?php echo CHtml::link('Talleres de todas las ediciones',array('index'),array('class' => 'btn btn-primary btn-lg'));?></center><br />
<?php if( !empty($model) ):  ?>
	<div class="table-responsive">
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
			<?php $this->renderPartial('_ver',array('data'=>$taller)); ?>
		</tr>
		<?php endforeach; ?>
	</tbody>
	</table>
	</div><!-- /table-responsive -->
<?php else: ?>
	<div class="alert alert-info">No hay talleres en esta edición</div>
<?php endif; ?>