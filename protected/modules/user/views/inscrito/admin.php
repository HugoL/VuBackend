<?php
/* @var $this InscritoController */
/* @var $model Inscrito */

$this->breadcrumbs=array(
	'Inscritos'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Inscrito', 'url'=>array('index')),
	array('label'=>'Create Inscrito', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#inscrito-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Inscritos</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'inscrito-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'nombre',
		'apellido1',
		'apellido2',
		'email',
		'nif',
		/*
		'nacionalidad',
		'direccion',
		'cp',
		'localidad',
		'provincia',
		'telefono',
		'sexo',
		'pais',
		'cargo',
		'razonSocial',
		'nifEmpresa',
		'direccionEmpresa',
		'titulacion',
		'edicion',
		'observaciones',
		'observaciones2',
		'fecha',
		'pagado',
		'talleres',
		'coursesites',
		'id_rol',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
