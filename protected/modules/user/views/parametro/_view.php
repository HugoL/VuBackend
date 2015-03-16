<?php
/* @var $this ParametroController */
/* @var $data Parametro */
?>

<tr>
	<td>
	<?php echo CHtml::encode($data->parametro); ?>
	</td>

	<td>
	<?php echo CHtml::encode($data->valor); ?>
	</td>
	<td>
		<?php echo CHtml::link('Modificar',array('update', 'id'=>$data->id),array('class' => 'btn btn-danger btn-sm'));  ?>
	</td>
</tr>