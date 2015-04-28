<?php
$this->breadcrumbs=array(
	'Manage'=>array('index'),
);?>
<h1>Copias de seguridad</h1>

<?php /*$this->renderPartial('_list', array(
		'dataProvider'=>$dataProvider,
));*/
?>
<div class="row-fluid">
<center><?php echo CHtml::link('<i class="fa fa-icon fa-medkit"></i> Crear copia de seguridad',array('default/create'),array('class' => 'btn btn-md btn-danger')); ?></center>
</div>
<div class="clearfix">&nbsp;</div>
<div class="table-responsive">
<table class="table table-striped">
	<tr>
		<th>Nombre</th>
		<th>Tamaño</th>
		<th>Fecha</th>
		<th>Opciones</th>
	</tr>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_list',
	'pager'=>array(
        'cssFile'=>Yii::app()->theme->baseUrl.'/css/pager.css',
        'firstPageLabel' => '<<',
        'prevPageLabel'  => '<',
        'nextPageLabel'  => '>',
        'lastPageLabel'  => '>>',
        ),
	'id'=>'ajaxListView',
)); ?>
</table>
</div>