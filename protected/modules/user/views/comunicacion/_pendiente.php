<?php
/* @var $this ComunicacionController */
/* @var $data Comunicacion */
?>

<tr>

	<td>
	<a name="<?php echo $data->id ?>"></a><?php echo CHtml::encode($data->identificador); ?>
	</td>

	<td>
	<?php echo CHtml::link($data->titulo,$data->url); ?>
	</td>

	<td>
	<?php echo CHtml::encode($data->observaciones); ?>
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
	switch($data->aprobado) {
		case 0 :
			echo " - ";
		break;
		case 1 :
			echo "Sí";
		break;
		case 2 :
			echo "No";
		break;
	}
	?>
	</td>
	
	<td><?php echo CHtml::link('<i class="fa fa-eye"></i>',array('view', 'id' => $data->id),array('class' => 'btn btn-success btn-sm')); ?>&nbsp;
	</td>
</tr>