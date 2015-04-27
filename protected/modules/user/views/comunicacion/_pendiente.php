<?php
/* @var $this ComunicacionController */
/* @var $data Comunicacion */
?>

<tr>

	<td>
	<a name="<?php echo $data->id ?>"></a><?php echo CHtml::encode($data->identificador); ?>
	</td>

	<td>
	<?php echo CHtml::link($data->titulo,$data->url,array('target' => '_blank')); ?>
	</td>

	<td>
	<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'comunicacion-form',
	'enableAjaxValidation'=>false,
	'action'=>array('comunicacion/updateObservaciones/id/'.$data->id),
)); ?>

	<?php echo $form->errorSummary($data); ?>
	<?php echo $form->hiddenField($data,'id'); ?>
	<div class="row col-md-12 col-lg-12">
		<?php echo $form->textArea($data,'observaciones',array('class'=>'form-control')); ?>
		<?php echo $form->error($data,'observaciones'); ?>
	</div>
	<div class="row col-md-1 col-lg-1 guardar">
		<?php echo CHtml::tag('button', array(
        'name'=>'btnSubmit',
        'type'=>'submit',
        'class'=>'btn btn-warning btn-xs',
      ), '<i class="fa fa-icon fa-save"></i>'); ?>
	</div>

<?php $this->endWidget(); ?>
	</td>

	<td>
	<?php echo CHtml::encode($data->autores); ?>
	</td>
	<td>
		<?php if( !empty($data->revisado) && $data->revisado > 0 ): ?>
			<span class="label label-warning"><?php echo $data->revisadopor->username; ?></span>
		<?php else: ?>
			<?php echo CHtml::link("Me lo pido",array('comunicacion/melopido', 'idComunicacion' => $data->id),array('class' => 'btn btn-default btn-sm')); ?>
		<?php endif; ?>
	</td>

	<td>
	<?php echo CHtml::encode($data->tipo) == 0 ? "Comunicación" : "Póster"; ?>
	</td>
	
	<td>
	<?php 
	$listData = array(
			0 => '-',
			1 => 'Sí',
			2 => 'No'
		);
			echo CHtml::dropDownList('aprobado[]','select',$listData,array('class'=> 'form-control selaprobado', 'id' => $data->id,'options' => array($data->aprobado => array('selected'=>true))));
		
			$url = $this->createUrl('comunicacion/marcarAprobado');
			$js = '
			 $(".selaprobado").change(function(){        			 	
			 	var valor;
			 	valor = $(this).val();			 	
			    $.post("'.$url.'/id/"+this.id+"/valor/"+valor, function(data) {
			        window.location.reload()
			    });
			});
			';
			Yii::app()->clientScript->registerScript('aprobar', $js);
	?>
	</td>
	
	<td><?php echo CHtml::link('<i class="fa fa-eye"></i>',array('view', 'id' => $data->id),array('class' => 'btn btn-success btn-sm')); ?>&nbsp;
	</td>
</tr>