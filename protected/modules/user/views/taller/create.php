<?php
/* @var $this TallerController */
/* @var $model Taller */

$this->breadcrumbs=array(
	'Tallers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Taller', 'url'=>array('index')),
	array('label'=>'Manage Taller', 'url'=>array('admin')),
);
?>

<h1>Nuevo taller</h1>
<div class="container-fluid">
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>