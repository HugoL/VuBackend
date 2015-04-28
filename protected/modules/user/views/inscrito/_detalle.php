<?php
/* @var $this InscritoController */
/* @var $data Inscrito */
?>

	<tr><td>Email</td>
		<td>
			<?php echo CHtml::encode($data->email); ?>
		</td>
	</tr>

	
	<tr>
		<td>Nif</td>
		<td><?php echo CHtml::encode($data->nif); ?></td>
	</tr>
	
	<tr>
		<td>
		<?php echo CHtml::encode($data->getAttributeLabel('nacionalidad')); ?>:</b></td>
		<td>
	<?php if(  $data->nacionalidad == 0 || empty($data->nacionalidad) ){
				$pais = $data->pais;
			}else{
				$modelo_pais = Pais::model()->findByPk( $data->nacionalidad );
				$pais = $modelo_pais->nombre;
			}?>
	<?php echo CHtml::encode($pais); ?></td>
	</tr>
<tr><td>
	<?php 
	 echo CHtml::encode($data->getAttributeLabel('direccion')); ?>:</b></td>
	<td><?php echo CHtml::encode($data->direccion); ?></td>
	</tr>
<tr><td>
	<?php echo CHtml::encode($data->getAttributeLabel('cp')); ?>:</b></td>
	<td><?php echo CHtml::encode($data->cp); ?></td>
	</tr>
<tr><td>
	<?php echo CHtml::encode($data->getAttributeLabel('localidad')); ?>:</b></td>
	<td><?php echo CHtml::encode($data->localidad); ?></td>
	</tr>
<tr><td>
	<?php echo CHtml::encode($data->getAttributeLabel('provincia')); ?>:</b></td>
	<td><?php echo CHtml::encode($data->provincia); ?></td>
	</tr>
<tr><td>
	<?php echo CHtml::encode($data->getAttributeLabel('telefono')); ?>:</b></td>
	<td><?php echo CHtml::encode($data->telefono); ?></td>
	</tr>
<tr><td>
	<?php echo CHtml::encode($data->getAttributeLabel('sexo')); ?>:</b></td>
	<td><?php echo $data->sexo == 1 ? "Masculino" : "Femenino"; ?></td>
	</tr>
<tr><td>
	<?php echo CHtml::encode($data->getAttributeLabel('pais')); ?>:</b></td>
	<td><?php echo CHtml::encode($data->pais); ?></td>
	</tr>

	<?php if( !empty($data->nifEmpresa) ): ?>
		<tr><td>
		<?php echo CHtml::encode($data->getAttributeLabel('cargo')); ?>:</b></td>
		<td><?php echo CHtml::encode($data->cargo); ?></td>
		</tr>

		<tr><td><?php echo CHtml::encode($data->getAttributeLabel('razonSocial')); ?>:</b></td>
			<td>
		<?php echo CHtml::encode($data->razonSocial); ?></td>
		</tr>

		<tr><td><?php echo CHtml::encode($data->getAttributeLabel('nifEmpresa')); ?>:</b></td>

		<td><?php echo CHtml::encode($data->nifEmpresa); ?></td>
		</tr>

		<tr>
		<td>
		<?php echo CHtml::encode($data->getAttributeLabel('direccionEmpresa')); ?>:</b></td>
		<td><?php echo CHtml::encode($data->direccionEmpresa); ?></td>
		</tr>
	<?php endif; ?>
	<tr>
	<td><?php echo CHtml::encode($data->getAttributeLabel('titulacion')); ?>:</b></td>
	<td><?php echo CHtml::encode($data->titulacion); ?></td>
	</tr>
	<?php if( Yii::app()->user->rol == 4 ): ?>
<tr><td>
	<?php echo CHtml::encode($data->getAttributeLabel('observaciones')); ?>:</b></td>
	<td><?php echo CHtml::encode($data->observaciones); ?></td>
	</tr>
<?php else: ?>
	<tr><td>
	<?php echo CHtml::encode($data->getAttributeLabel('observaciones2')); ?>:</b></td>
	<td><?php echo CHtml::encode($data->observaciones2); ?></td>
	</tr>
<?php endif; ?>
	<tr>
	<td>
	<?php echo CHtml::encode($data->getAttributeLabel('fecha')); ?>:</b></td>
	<td><?php echo CHtml::encode($data->fecha); ?></td>
	</tr>
	<tr>
	<td>
	<?php echo CHtml::encode($data->getAttributeLabel('pagado')); ?>:</b></td>
	<td><?php echo $data->pagado == 1 ? "Sí" : "No"; ?></td>
	</tr>
	<tr>
	<td>
	<?php echo CHtml::encode($data->getAttributeLabel('talleres')); ?>:</b></td>
	<td><?php echo $data->talleres == 0 || $data->talleres == null ? "No" : "Sí"; ?></td>
	</tr>
	<?php if( !empty($data->inscritoTaller) ): ?>
	<tr>
		<td>Talleres</td>
		<td>
		<?php foreach ($data->inscritoTaller as $key => $installer): ?>
			<?php echo $installer->taller->abreviacion."<br/>"; ?>
		<?php endforeach; ?>
		</td>
	</tr>
	<?php endif; ?>

	<tr>
	<td>
	<?php echo CHtml::encode($data->getAttributeLabel('coursesites')); ?>:</b></td>
	<td><?php echo CHtml::encode($data->coursesites); ?></td>
	</tr>
	<tr>
		<td>
		<?php echo CHtml::encode($data->getAttributeLabel('id_rol')); ?>:</b></td>
		<td><?php echo CHtml::encode($data->rol->nombre); ?></td>
	</tr>
	<?php if( $data->rol->id != 3 ): ?>
		<tr>
			<td>
			<?php echo CHtml::encode($data->getAttributeLabel('certificado')); ?>:</b></td>
			<td><?php echo $data->certificado == 1 ? "Sí":"No"; ?></td>
		</tr>
	<?php endif; ?>