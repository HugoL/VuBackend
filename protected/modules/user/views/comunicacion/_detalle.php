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
<?php if( Yii::app()->getModule('user')->esAdministrador() ): ?>
	<tr>
	<td>Operaciones</td>
	<td>
		<?php echo CHtml::link('<i class="fa fa-user-plus"></i>',array('anadirAutor', 'id' => $data->id),array('class' => 'btn btn-warning btn-sm')); ?>&nbsp;	
		<?php
				echo CHtml::link('<i class="fa fa-icon fa-trash-o"> </i>', $this->createUrl('comunicacion/delete', array('id' => $data->id)), 
				    array(
				       // for htmlOptions
				       'onclick' => ' {' . CHtml::ajax(array(
				       	'type'=>'POST',
				  		'url'=>$this->createUrl('comunicacion/delete', array('id' => $data->id,'ajax'=>'delete')),// copy from point 1 above
				  		'complete'=>'js:function(jqXHR, textStatus){
				  			$.fn.yiiListView.update("ajaxListView");}',
				       'beforeSend' => 'js:function(){if(confirm("Estas seguro que quieres eliminar?"))return true;else return false;}',
				       'success' => "js:function(html){ window.location.reload() }"
				       )) .
				       'return false;}', // returning false prevents the default navigation to another url on a new page 
				       'class' => 'btn btn-danger',
				       'id' => 'x' . $data->id)
				); ?>
	</td>
	</tr>
<?php endif; ?>
	<?php /*
	

	<td><?php echo CHtml::encode($data->getAttributeLabel('revisado')); ?>:</b>
	<?php echo CHtml::encode($data->revisado); ?>
	</td></tr><tr>

	<td><?php echo CHtml::encode($data->getAttributeLabel('id_area')); ?>:</b>
	<?php echo CHtml::encode($data->id_area); ?>
	</td></tr><tr>

	*/ ?>