<?php
/* @var $this ComunicacionController */
/* @var $model Comunicacion */

$this->breadcrumbs=array(
	'Comunicacions'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Comunicacion', 'url'=>array('index')),
	array('label'=>'Create Comunicacion', 'url'=>array('create')),
	array('label'=>'Update Comunicacion', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Comunicacion', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Comunicacion', 'url'=>array('admin')),
);
?>
<?php 
if( !empty($_GET['Comunicacion_page']) )
  $volver = array('comunicacion/index/Comunicacion_page/'.$_GET['Comunicacion_page']);
else
  $volver = array('comunicacion/index');
 ?>
<center><?php echo CHtml::link('<i class="fa fa-arrow-left"></i> Volver',$volver,array('class' => 'btn btn-danger')); ?></center>

<h1><?php echo $model->titulo; ?></h1>

<table class="table table-bordered table-hover table-striped">
<?php $this->renderPartial('_detalle', array('data' => $model)); ?>
</table>

<?php if( !empty($model->inscritoComunicacion )): ?>
	<?php $_POST['returnUrl'] = Yii::app()->request->url; ?>
  <div class="panel panel-default">
   <div class="panel-heading">Participantes en la comunicación</div>
   <div class="panel-body">
  <dl class="dl-horizontal">
  <?php foreach( $model->inscritoComunicacion as $key => $comunicador ): ?>
    <dt><?php echo $comunicador->usuario->email; ?></dt>
    <dd><?php 
        echo $comunicador->usuario->nombre." ".$comunicador->usuario->apellido1;
        if(Yii::app()->user->rol == 1 || Yii::app()->user->rol == 2)
        	echo " ".CHtml::link('<i class="fa fa-icon fa-trash-o"> </i>',array('inscrito/borrarParticipacion', 'id' => $comunicador->id),array('class' => 'label label-danger','alt' => 'Borrar','confirm'=>'El inscrito dejará de ser participante de la comunicación'));
      ?></dd>    
  <?php endforeach; ?>
    </div>
  </div>
<?php endif; ?>
<div class="clearfix">&nbsp;</div>
<center><?php echo CHtml::link('<i class="fa fa-arrow-left"></i> Volver',$volver,array('class' => 'btn btn-danger')); ?></center>