<!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Ver Menú</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="http://www.virtualusatic.org">Virtual USATIC</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <?php if( isset( Yii::app()->user->username) ): ?>
                <li class="dropdown">
                    <?php echo CHtml::link('<i class="fa fa-power-off"></i> Salir( '.Yii::app()->user->username.' )',array('/site/logout')); ?>
                </li>
            <?php endif; ?>
            </ul>           
        </nav>