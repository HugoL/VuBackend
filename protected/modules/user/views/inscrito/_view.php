<?php
/* @var $this InscritoController */
/* @var $data Inscrito */
?>

<tr>

	<td>
		<a name="<?=$data->id?>"></a>
	<?php echo CHtml::encode($data->nombre); ?>
	</td>

	<td>
	<?php echo CHtml::encode($data->apellido1)." ".CHtml::encode($data->apellido2); ?>
	</td>

	<td>
	<?php echo CHtml::encode($data->email); ?>
	</td>

	<td>
	<?php if( Yii::app()->user->rol != 4 ): 
			echo CHtml::encode($data->pagado) == 0 ? "No" : "Sí"; 
		  else: ?>
			<!-- casilla para marcar como pagado -->
			<label class="checkbox-inline" for="pagado">
                    <input type="checkbox" name="pagado[]" id="pagado<?= $data->id ?>" value="<?= $data->id; ?>" <?php if ($data->pagado == 1 ) echo "checked='checked' disabled='disabled'"; ?> >
                    <?php 
        			$url = $this->createUrl('inscrito/marcarPagado');
        			$js = '
        			 $("input[name=\'pagado[]\']").change(function(){
        			 	var id;
        			 	id = $(this).val();
        			    $.post("'.$url.'/id/"+id, function(data) {
        			        $(this).attr("disabled", true);
        			    });
        			});
        			';
        			Yii::app()->clientScript->registerScript('chk', $js);
					?>
                    </label>
			<?php endif; ?>
	</td>
	
	<td>
	<?php
        switch ( $data->id_rol ) {
          case 1:
            echo "Asistente<br/>";
            break;
          case 2:
            echo "Comunica<br/>";
            break;
          case 3:
            echo "Gratis<br/>";
            break;
          default:
            echo "No identificado<br/>";
            break;
        }

        //Mostrar los talleres a los que está inscrito (si lo está)
	?>
	<?php echo "Talleres: "; echo $data->talleres == 1 ? "Sí" : "No"; ?>
	</td>

	<td>
	<?php 
		$pagar = 0;
		foreach ($data->pago as $key => $pago) {
			$pagar = $pagar+$pago->cantidad_pagar;
		}
		echo CHtml::encode($pagar); ?>
	</td>

	<td>
	<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'inscrito-form',
	'enableAjaxValidation'=>false,
	'action'=>array('inscrito/updateObservaciones/id/'.$data->id),
)); ?>

	<?php echo $form->errorSummary($data); ?>
	<?php echo $form->hiddenField($data,'id'); ?>
	<div class="row col-md-10 col-lg-10">
		<?php if( Yii::app()->user->rol == 4 ): ?>
			<?php echo $form->textArea($data,'observaciones',array('class'=>'form-control')); ?>
			<?php echo $form->error($data,'observaciones'); ?>
		<?php else: ?>
			<?php echo $form->textArea($data,'observaciones2',array('class'=>'form-control')); ?>
			<?php echo $form->error($data,'observaciones2'); ?>
		<?php endif; ?>
	</div>
	<div class="row col-md-2 col-lg-2 guardar">
		<?php echo CHtml::tag('button', array(
        'name'=>'btnSubmit',
        'type'=>'submit',
        'class'=>'btn btn-warning btn-xs',
      ), 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>
	</td>

	<td><?php echo CHtml::link('<i class="fa fa-icon fa-eye"> </i>',array('view', 'id' => $data->id),array('class' => 'btn btn-success','alt' => 'Ver detalles')); ?>&nbsp;
	<?php if( Yii::app()->user->rol == 1 || Yii::app()->user->rol == 2 )
		echo CHtml::link('<i class="fa fa-icon fa-trash-o"> </i>', array('inscrito/delete', 'id'=>$data->id),
  		array(
    		'submit'=>array('inscrito/delete', 'id'=>$data->id),
    		'class' => 'btn btn-danger','confirm'=>'Se eliminará el inscrito'
  			)
		); ?>
	</td>
</tr>