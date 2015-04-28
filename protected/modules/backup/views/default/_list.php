<tr>
		<th><?php echo CHtml::link($data["name"],Yii::app()->createUrl("backup/default/download", array("file"=>$data["name"]))); ?></th>
		<th><?php echo $data["size"]; ?></th>
		<th><?php echo $data["create_time"]; ?></th>
		<th><?php echo CHtml::link('<i class="fa fa-icon fa-download"></i>',Yii::app()->createUrl("backup/default/download", array("file"=>$data["name"])),array('class' => 'btn btn-xs btn-success','title' => 'Descargar')); ?>&nbsp;&nbsp;
			<?php echo CHtml::link('<i class="fa fa-icon fa-remove"></i>',Yii::app()->createUrl("backup/default/delete", array("file"=>$data["name"])),array('class' => 'btn btn-xs btn-danger','title' => 'Eliminar','confirm' => '¿Estás seguro?')); ?>
		</th>
	</tr>