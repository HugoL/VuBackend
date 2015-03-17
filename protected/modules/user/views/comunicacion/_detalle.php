<?php
/* @var $this ComunicacionController */
/* @var $data Comunicacion */
?>

<tr>
	<td>Identificador</td>
	<td>
	<a name="<?php echo $data->id ?>"></a><?php echo CHtml::encode($data->identificador); ?>
	</td>
	</tr>

	<tr>
	<td>Título</td>
	<td>
	<?php echo CHtml::link($data->titulo,$data->url); ?>
	</td>
	</tr>

	<tr>
	<td>Observaciones</td>
	<td>
	<?php echo CHtml::encode($data->observaciones); ?>
	</td></tr>

	<tr>
	<td>Autores</td>
	<td>
	<?php echo CHtml::encode($data->autores); ?>
	</td></tr>

	<tr>
	<td>Revisado</td>
	<td>
		<?php if( !empty($data->revisado) && $data->revisado > 0 ): ?>
			<span class="label label-warning"><?php echo $data->revisadopor->username; ?></span>
			<?php if( $data->revisado == Yii::app()->user->id ): ?>
				<?php echo CHtml::link('No me lo pido',array('comunicacion/nomelopido', 'idComunicacion' => $data->id),array('class' => 'btn btn-default btn-sm')); ?>
			<?php endif; ?>
		<?php else: ?>
			<?php echo CHtml::link("Me lo pido",array('comunicacion/melopido', 'idComunicacion' => $data->id),array('class' => 'btn btn-default btn-sm')); ?>
		<?php endif; ?>
	</td></tr>

	<tr>
	<td>Tipo</td>
	<td>
	<?php echo CHtml::encode($data->tipo) == 0 ? "Comunicación" : "Póster"; ?>
	</td></tr>

	<tr>
	<td>Aprobado</td>
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
	</td></tr>

	<tr>
	<td>Operaciones</td>
	<td>
		<?php echo CHtml::link('<i class="fa fa-user-plus"></i>',array('anadirAutor', 'id' => $data->id),array('class' => 'btn btn-warning btn-sm')); ?>&nbsp;
		<?php echo CHtml::link('<i class="fa fa-trash-o"></i>',array('delete', 'id' => $data->id),array('class' => 'btn btn-danger btn-sm','confirm'=>'¿Quieres borrar la comunicación?')); ?>
	</td>
	</tr>
	<?php /*
	

	<td><?php echo CHtml::encode($data->getAttributeLabel('revisado')); ?>:</b>
	<?php echo CHtml::encode($data->revisado); ?>
	</td></tr><tr>

	<td><?php echo CHtml::encode($data->getAttributeLabel('id_area')); ?>:</b>
	<?php echo CHtml::encode($data->id_area); ?>
	</td></tr><tr>

	*/ ?>