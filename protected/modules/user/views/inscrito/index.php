<?php
/* @var $this InscritoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Inscritos',
);

$this->menu=array(
	array('label'=>'Create Inscrito', 'url'=>array('create')),
	array('label'=>'Manage Inscrito', 'url'=>array('admin')),
);
?>
<?php if( Yii::app()->user->hasFlash('succeess')): ?>
    <div class="alert alert-success"><?php echo Yii::app()->user->getFlash('success') ?></div>
<?php endif; ?>
<?php if( Yii::app()->user->hasFlash('error')): ?>
    <div class="alert alert-danger"><?php echo Yii::app()->user->getFlash('error') ?></div>
<?php endif; ?>

<?php 
//Opciones para el select de filtrar los datos
if( Yii::app()->user->rol == 4 ) //Este rol solo puede ver asistentes de pago (asistentes y comunicadores)
     $opciones = array( 1=>'Cualquiera de pago', 2=>'Asistente', 3=>'Ponente' );
else
    $opciones = array( 0=>'Mostrar todos', 1=>'Cualquiera de pago', 2=>'Asistente', 3=>'Ponente', 4=>'Gratuito' );
?>

<div class="row">
	<div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">  
                <div class="col-xs-3">
                        <i class="fa fa-filter fa-5x"></i>
                    </div>                  
                    <div class="col-xs-9 text-right">
                        <div class="huge"></div>
                        <div><?php 
							echo CHtml::beginForm(CHtml::normalizeUrl(array('inscrito/index')), 'get', array('id'=>'filter-form','class' => 'form-inline'))
    						. CHtml::dropDownList('f', (isset($_GET['f'])) ? $_GET['f'] : '', $opciones ,array('id'=>'filtro','class'=>'form-control'))
    						. CHtml::endForm(); ?><br/>Filtrar inscritos</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-search fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"></div>
                        <div class="input-group">
                        <form method="GET">
                          <input type="text" class="form-control col-xs-9" placeholder="Buscar..." name="q" value="<?=isset($_GET['q']) ? CHtml::encode($_GET['q']) : '' ; ?>">
                          <span class="input-group-btn visible-md visible-xs visible-sm">
                            <button class="btn btn-default" type="submit"><i class="fa fa-icon fa-search"></i></button>
                          </span>  
                           <span class="visible-lg">
                            <button class="btn btn-default" type="submit"><i class="fa fa-icon fa-search"></i></button>
                          </span>                 
                        </form>
                        <span class="visible-md"><br/></span>
                        </div><!-- /input-group -->
                        Buscar inscritos
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">  
                <div class="col-xs-3">
                        <i class="glyphicon glyphicon-text-size fa-5x"></i>
                    </div>                  
                    <div class="col-xs-9 text-right">
                        <div class="huge"></div>
                        <div >
                        <form method="GET">
                          <select class="form-control" name="t" id="taller" value="<?=isset($_GET['t']) ? CHtml::encode($_GET['t']) : '' ; ?>">
                            <option></option>
                            <?php foreach ($talleres as $key => $taller) : ?>
                                <option value="<?= $taller->id ?>" <?php if( isset($_GET['t']) && $_GET['t'] == $taller->id ) echo "selected"; ?>><?= $taller->nombre ?></option>                    
                            <?php endforeach; ?>
                             <option value="todos" <?php if( isset($_GET['t']) && $_GET['t'] == 0 ) echo "selected"; ?>>TODOS</option>
                          </select>
                        </form>
                          </div><!-- /input-group -->
                    <br/>Inscritos en talleres
                    </div>
                </div>
            </div>
        </div>
    </div>

	<div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-users fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $dataProvider->getTotalItemCount(); ?></div>
                        <div>Total inscritos<br/></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<h3>Inscritos edición <?= $edicion ?> <?php if( Yii::app()->user->rol == 4 ): //a la feuz le muestro aquí el total a pagar ?>
    <span class="label label-success">Total a pagar: <?php echo $totalPagar; ?> €</span>
<?php endif; ?></h3>

<div class="table-responsive">
<table class="table table-striped">
	<tr>
		<th>Nombre</th>
		<th>Apellidos</th>
		<th>Email</th>
		<th>Pagado</th>
		<th>Inscripción</th>
		<th>Total</th>
		<th>Observaciones</th>
		<th><?php echo CHtml::link('<i class="fa fa-file-excel-o fa-1x"> <b>Excel</b></i>',array('index','export'=>1),array('class' => 'btn btn-default','target'=>'_blank')) ?></th>
	</tr>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'sortableAttributes'=>array('fecha','apellido1','email'),
	'pager'=>array(
        'cssFile'=>Yii::app()->theme->baseUrl.'/css/pager.css',
        'firstPageLabel' => '<<',
        'prevPageLabel'  => '<',
        'nextPageLabel'  => '>',
        'lastPageLabel'  => '>>',
        ),
	'id'=>'ajaxListView',
)); ?>
</table>
</div>
<?php Yii::app()->clientScript->registerScript('search',
    "
    $(document).ready(function(){
    	var ajaxUpdateTimeout;
    	var ajaxRequest;
    	$('select#string').change(function(){
    		
    		/*ajaxRequest = $(this).serialize();
    		alert(ajaxRequest);
    		clearTimeout(ajaxUpdateTimeout);
    		ajaxUpdateTimeout = setTimeout(function () {
    			$.fn.yiiListView.update(
				// this is the id of the CListView
    				'ajaxListView',
    				{data: ajaxRequest}
    				)
			},
			// this is the delay
			300);*/

		});
	});"
); ?>
<script>
  $(document).ready(function(){
	$("#filtro").change(function(){
		this.form.submit();
	});
  });
  $(document).ready(function(){
    $("#taller").change(function(){
        this.form.submit();
    });
  });
</script>