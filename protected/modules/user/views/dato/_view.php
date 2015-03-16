<?php
/* @var $this DatoController */
/* @var $data Dato */
?>
<tr>
	<td>
	<?php echo CHtml::encode($data->clave); ?>
	</td>

	<td>
	<?php echo CHtml::encode($data->valor); ?>
	</td>
	<td>
		<?php echo CHtml::link('Modificar',array('update', 'id'=>$data->id),array('class' => 'btn btn-danger btn-sm'));  ?>
	</td>
</tr>