<div class="row-fluid">
<legend><h2>Virtual USATIC <?php echo $edicion; ?></h2></legend>
    <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-users fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $inscritos; ?></div>
                        <div>Total inscritos<br/></div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left"><?php echo CHtml::link('Ver inscritos',array('inscrito/index')); ?></span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

	<div class="col-lg-6 col-md-6 col-sm-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">  
                <div class="col-xs-3">
                        <i class="fa fa-eur fa-5x"></i>
                    </div>                  
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $pagado; ?> de <?php echo $total; ?></div>
                        <div>Total Pagado</div>
                    </div>
                </div>
            </div>    
                    
                <div class="panel-footer">
                    <span class="pull-left"></span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>  
                     
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-files-o fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $comunicaciones; ?></div>
                        <div>
        
                        </div><!-- /input-group -->
                        Total Comunicaciones
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left"><?php echo CHtml::link('Ver comunicaciones',array('comunicacion/index')); ?></span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">  
                <div class="col-xs-3">
                        <i class="fa fa-check-circle fa-5x"></i>
                    </div>                  
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $norevisadas; ?></div>
                        <div >

                        </div><!-- /input-group -->
                    Pendientes de revisar
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left"><?php echo CHtml::link('Ver pendientes de revisar',array('comunicacion/pendientes')); ?></span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

</div>
<div class="clearfix">&nbsp;</div>
<div class="row-fluid">
    <div class="grafica"><?php
         $this->widget('ext.Hzl.google.HzlVisualizationChart', array('visualization' => 'AreaChart',
                'data' =>   $datos,
                'options' => array(
                    'title' => 'Inscritos por ediciones',
                    'legend' => array('position' => 'bottom'),

                    )
                )
            ); ?>
    </div>
</div>