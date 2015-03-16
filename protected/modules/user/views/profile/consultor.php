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
                        <div>Total inscritos de pago<br/></div>
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

</div>