<?php
/* @var $this TallerController */
/* @var $data Taller */
?>
	<td>
	<?php echo CHtml::encode($data->abreviacion); ?>
	</td>
	
	<td>
	<?php echo CHtml::encode($data->nombre); ?>
	</td>

	<td>
	<?php echo CHtml::encode($data->observaciones); ?>
	</td>

	<td>
	<?php echo CHtml::encode($data->precio); ?>
	</td>

	<td>
		<?php echo CHtml::link('<i class="fa fa-pencil"></i>',array('update','id'=>$data->id),array('class'=>'btn btn-primary')); ?> <?php echo CHtml::link('<i class="fa fa-trash"></i>',array('delete','id'=>$data->id),array('class'=>'btn btn-danger')); ?>
	</td>