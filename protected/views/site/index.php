<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl."/js/formulario.js",CClientScript::POS_END); ?>
<div class="cabecera col-md-12 col-lg-12">
  <table class="table">
    <tr>
      <td><div class="logousatic hidden-xs"><img src="<?php echo Yii::app()->baseUrl ?>/images/logousatic.jpg" alt="Virtual USATIC"></div></td>
      <td><div class="texto col-xs" align="center">Inscripción Jornadas Virtual USATIC 2015</div></td>
      <!-- <span class="usatic"><font color="#6E6E6E">Virtual</font> <font color="red"><i>u</i>S</font>A<font color="red">TIC</font></span> -->
      <td><div class="logofeuz hidden-xs"><img src="<?php echo Yii::app()->baseUrl ?>/images/logoFeuz.gif" alt="Feuz"></div></td>
    </tr>
  </table>
</div>

<div class="container-fluid">
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'inscrito-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
		'class'=> 'form-horizontal',
	),
)); ?>

	<p class="note">Los campos con <span class="required">*</span> son obligatorios.</p>

	<?php echo $form->errorSummary($model); ?>
	<fieldset>
	<div class="row form-group">
		<?php echo $form->labelEx($model,'id_rol'); ?>
		<?php echo $form->dropDownList($model,'id_rol',CHtml::listData($roles,'id','nombre'),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'id_rol'); ?>
		<span id="lblgratuito" style="display:none" class="help-block informacion">
            <div class="alert alert-danger">Solo asistente sin derecho a certificados (Gratuito)</div>Recuerde que esta opción <b>SOLO</b> le permitirá el acceso a las Webconferencias y foros de las Jornadas pero <b>NO</b> obtendrá ningún tipo de certificado, <b>NO</b> podrá presentar comunicación, <b>NO</b> podrá optar a asistir a los talleres y <b>NO</b> recibirá copia de las Actas.</span>
          <span id="lblgratuito2" style="display:none" class="help-block informacion">En otro caso, si desea disponer de las opciones anteriores, debe seleccionar la modalidad de inscripción de Asistente con derecho a certificado o Asistente con contribución y abonar las correspondiente tasas.</span>

          <span id="lblasistente" style="display:none" class="help-block informacion">
            <div class="alert alert-danger"><strong>Cerrado el plazo de envío de comunicaciones.</strong> Solo se admite esta inscripción para participantes que ya han presentado o son firmantes de comunicación/póster y todavía no habían realizado la inscripción para recibir certificado.</div>
            <br/>Incluye hasta máximo 3 contribuciones</span>
          <span id="lblasistente2" style="display:none" class="help-block informacion">Todos los autores firmantes de una contribución que asistan a las Jornadas deben inscribirse en esta modalidad para recibir los correspondientes certificados.</span>
    </div>

    <div id="general">

    <div class="row">
		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>60,'maxlength'=>128,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'apellido1'); ?>
		<?php echo $form->textField($model,'apellido1',array('size'=>60,'maxlength'=>128,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'apellido1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'apellido2'); ?>
		<?php echo $form->textField($model,'apellido2',array('size'=>60,'maxlength'=>128,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'apellido2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>256,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nif'); ?>
		<?php echo $form->textField($model,'nif',array('size'=>60,'maxlength'=>128,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'nif'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nacionalidad'); ?>
		<?php echo $form->textField($model,'nacionalidad',array('size'=>60,'maxlength'=>128,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'nacionalidad'); ?>
	</div>
	
	</div><!-- general -->

	<div class="row">
		<?php echo $form->labelEx($model,'direccion'); ?>
		<?php echo $form->textField($model,'direccion',array('size'=>60,'maxlength'=>256,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'direccion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cp'); ?>
		<?php echo $form->textField($model,'cp',array('size'=>60,'maxlength'=>128,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'cp'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'localidad'); ?>
		<?php echo $form->textField($model,'localidad',array('size'=>60,'maxlength'=>128,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'localidad'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'provincia'); ?>
		<?php echo $form->textField($model,'provincia',array('size'=>60,'maxlength'=>128,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'provincia'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'telefono'); ?>
		<?php echo $form->textField($model,'telefono',array('size'=>60,'maxlength'=>128,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'telefono'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sexo'); ?>
		<?php echo $form->textField($model,'sexo'); ?>
		<?php echo $form->error($model,'sexo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pais'); ?>
		<?php echo $form->textField($model,'pais',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'pais'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cargo'); ?>
		<?php echo $form->textField($model,'cargo',array('size'=>60,'maxlength'=>256,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'cargo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'razonSocial'); ?>
		<?php echo $form->textField($model,'razonSocial',array('size'=>60,'maxlength'=>256,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'razonSocial'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nifEmpresa'); ?>
		<?php echo $form->textField($model,'nifEmpresa',array('size'=>60,'maxlength'=>128,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'nifEmpresa'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'direccionEmpresa'); ?>
		<?php echo $form->textField($model,'direccionEmpresa',array('size'=>60,'maxlength'=>256,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'direccionEmpresa'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'titulacion'); ?>
		<?php echo $form->textField($model,'titulacion',array('size'=>60,'maxlength'=>256,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'titulacion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'talleres'); ?>
		<?php echo $form->textField($model,'talleres'); ?>
		<?php echo $form->error($model,'talleres'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'coursesites'); ?>
		<?php echo $form->textField($model,'coursesites',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'coursesites'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Enviar',array('class'=>'btn btn-primary btn-lg')); ?>
	</div>
	
	</fieldset>
<?php $this->endWidget(); ?>
      

<div class="parcial">
<!-- precios -->
<div class="well">
  <h4>Datos de pago</h4>
 <br/>
 <ul>
  <li>Asistencia: <label id="precio1" ></label> <b>€</b></li>
  <li>Talleres: <label id="precio2" ></label> <b>€</b></li>
  <li>Importe total: <label class="lblpreciototal" id="preciototal" > </label> <b>€</b></li>
</ul>
<div class="datosbancarios"><b><div class="alert alert-danger">
  Debe ingresar un total de <span class="lblpreciototal"></span> Euros.</b></div>
  <p>Pagar con cheque, transferencia o ingreso bancario a favor de:
</p>

<p><b>Fundación Empresa Universidad de Zaragoza</b></p>
<p><b>Banco Sabadell</b></p>
<p><b>ES64-0081-0170-11-0001354545</b></p>

<div class="alert alert-danger"><b>MUY IMPORTANTE:</b> En el concepto de pago debe aparecer en este orden: nombre y apellidos de la persona que se inscribe y DNI/Pasaporte</div>
</div>
</div><!-- well -->
<!-- ---precios --- -->
</div> <!-- parcial -->


<!-- términos y condiciones -->
<div id="terminosycondiciones" class="form-group col-xs-12">
  <div class="col-md-12">
    <div>
      <div>
      <span class="parcial">La inscripci&oacute;n consta de dos requisitos:<br />
        <b>1. Env&iacute;o de todos los datos.</b><br />
        <b>2. Pago del importe correspondiente.</b></span></h2>
      </div>
<div class="parcial">
   <font color="red"><b>La inscripci&oacute;n solo ser&aacute; efectiva si se han realizado los dos requisitos anteriores.</b></font></div>
<div class="clearfix">&nbsp;</div>
<p>
  <span >Por favor, aseg&uacute;rese de que la direcci&oacute;n de correo electr&oacute;nico que ha introducido es la correcta. Servir&aacute; para contactar con usted y darle acceso a las Jornadas.</span></p>
<p>
Al realizar su inscripci&oacute;n acepta las normas de participaci&oacute;n en las Jornadas.&nbsp;<a href="http://www.virtualusatic.org/?page_id=104" style="color: rgb(184, 25, 48); text-decoration: none;" target="_blank">Normas</a></p>
<div>Protecci&oacute;n de datos:</div>
<div>
  En cumplimiento de la L. O. 15/99, de 13 de diciembre, de Protecci&oacute;n de Datos de Car&aacute;cter Personal (LOPD), le informamos que los datos personales facilitados a trav&eacute;s del presente formulario ser&aacute;n incluidos en un fichero propiedad de FEUZ, debidamente registrado en la Agencia Espa&ntilde;ola de Protecci&oacute;n de Datos, con la exclusiva final de enviar informaci&oacute;n acerca de los servicios, actividades formativas y eventos de inter&eacute;s de FEUZ. Asimismo, en caso de producirse alguna modificaci&oacute;n en sus datos, le rogamos que lo comunique debidamente por escrito. Los titulares de los datos podr&aacute;n ejercitar los derechos de acceso, rectificaci&oacute;n, cancelaci&oacute;n y/o oposici&oacute;n en la manera y con el alcance establecido legalmente, en la siguiente direcci&oacute;n: P&ordm; Fernando el Cat&oacute;lico, 2 entlo &ndash; 50005 Zaragoza o a trav&eacute;s de&nbsp;<a href="mailto:feuz@feuz.es" style="color: rgb(184, 25, 48); text-decoration: none;"><font size="2">feuz@feuz.es</font></a><font size="2">&nbsp;.</font></div>
<div style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans-serif; font-size: 17px; text-indent: -18pt; margin: 0cm 0cm 10pt 14.2pt;">
    </div>
  </div>
</div>
</div><!-- terminos y condiciones -->

</div><!-- form -->
</div><!-- /content-fluid -->