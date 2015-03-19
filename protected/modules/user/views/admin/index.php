<?php
$this->breadcrumbs=array(
	UserModule::t('Users')=>array('/user'),
	UserModule::t('Manage'),
);

$this->menu=array(
    array('label'=>UserModule::t('Create User'), 'url'=>array('create')),
    array('label'=>UserModule::t('Manage Users'), 'url'=>array('admin')),
    array('label'=>UserModule::t('Manage Profile Field'), 'url'=>array('profileField/admin')),
    array('label'=>UserModule::t('List User'), 'url'=>array('/user')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});	
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('user-grid', {
        data: $(this).serialize()
    });
    return false;
});
");

?>
<h1>Administrar usuarios</h1>

<div class="panel panel-default">
  <div class="panel-body">
		<div class="col-md-4 col-lg-4"><?php echo CHtml::link('Nuevo usuario',array('admin/create'),array('class' => 'btn btn-danger')); ?></div>
		<div class="col-md-4 col-lg-4"><?php echo CHtml::link('Administrar campos de perfil',array('profileField/admin'),array('class' => 'btn btn-default')); ?></div>
		<div class="col-md-4 col-lg-4"><?php echo CHtml::link('Crear campo de perfil',array('profileField/create'),array('class' => 'btn btn-default')); ?></div>
	</div>
</div><!-- /panel -->

<?php echo CHtml::link('Búsqueda avanzada','#',array('class'=>'search-button')); ?>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
    'model'=>$model,
)); ?>
</div><!-- search-form -->
<div class="table-responsive">
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'cssFile' => Yii::app()->theme->baseUrl.'/css/bootstrap.min.css',
	'itemsCssClass' => 'table table-striped table-hover',
	'columns'=>array(
		array(
			'name' => 'id',
			'type'=>'raw',
			'value' => 'CHtml::link(CHtml::encode($data->id),array("admin/update","id"=>$data->id))',
		),
		array(
			'name' => 'username',
			'type'=>'raw',
			'value' => 'CHtml::link(UHtml::markSearch($data,"username"),array("admin/view","id"=>$data->id))',
		),
		array(
			'name'=>'email',
			'type'=>'raw',
			'value'=>'CHtml::link(UHtml::markSearch($data,"email"), "mailto:".$data->email)',
		),
		'lastvisit_at',
		array(
			'name'=>'status',
			'value'=>'User::itemAlias("UserStatus",$data->status)',
			'filter' => User::itemAlias("UserStatus"),
		),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
</div><!-- /table-responsive -->
