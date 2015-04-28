<a name="menu"></a>
<nav id="menulateral">
<div class="collapse navbar-collapse navbar-ex1-collapse">
<ul class="navbar navbar-inverse  nav navbar-nav side-nav" id="menulateral">
	<li <?php if( strcmp(Yii::app()->controller->id,'profile') == 0 ): ?> class="active" <?php endif; ?>><?php echo CHtml::link('<i class="fa fa-fw fa-home"></i> Principal',array('profile/principal')); ?></li>
	<?php if( Yii::app()->getModule('user')->esAdministrador() ): ?>
		<li <?php if( strcmp(Yii::app()->controller->id,'inscrito') == 0 ): ?> class="active" <?php endif; ?>><?php echo CHtml::link('<i class="fa fa-fw fa-users"></i> Inscritos',array('/user/inscrito/index')); ?></li> 
	<?php endif; ?>	

	<?php if( Yii::app()->getModule('user')->esColaborador() || Yii::app()->getModule('user')->esAdministrador() ): ?>
	<li <?php if( strcmp(Yii::app()->controller->id,'comunicacion') == 0 && strcmp(Yii::app()->controller->action->id,'index') == 0 ): ?> class="active" <?php endif; ?>><?php echo CHtml::link('<i class="fa fa-fw fa-files-o"></i> Comunicaciones',array('/user/comunicacion/index')); ?></li>
	<li <?php if( strcmp(Yii::app()->controller->action->id,'pendientes') == 0 ): ?> class="active" <?php endif; ?>><?php echo CHtml::link('<i class="fa fa-fw fa-check-circle"></i> Pendientes de revisar',array('/user/comunicacion/pendientes')); ?></li>
	<?php endif; ?>

	<?php if( Yii::app()->getModule('user')->esAdministrador() ): ?>
		<li <?php if( strcmp(Yii::app()->controller->id,'comunicacion') == 0 && strcmp(Yii::app()->controller->action->id,'create') == 0 ): ?> class="active" <?php endif; ?>><?php echo CHtml::link('<i class="fa fa-fw fa-file-o"></i> Nueva Comunicación',array('/user/comunicacion/create')); ?></li>
		<li <?php if( strcmp(Yii::app()->controller->id,'taller') == 0 ): ?> class="active" <?php endif; ?>><?php echo CHtml::link('<i class="fa fa-fw fa-text-height"></i> Talleres',array('/user/taller/listar')); ?></li>
		<li <?php if( strcmp(Yii::app()->controller->id,'dato') == 0 ): ?> class="active" <?php endif; ?>><?php echo CHtml::link('<i class="fa fa-fw fa-gears"></i> Configuración',array('/user/dato')); ?></li>
		<li <?php if( strcmp(Yii::app()->controller->id,'admin') == 0 ): ?> class="active" <?php endif; ?>><?php echo CHtml::link('<i class="fa fa-fw fa-user"></i> Usuarios',array('/user/admin')); ?></li>
		<li <?php if( strcmp(Yii::app()->controller->id,'default') == 0 ): ?> class="active" <?php endif; ?>><?php echo CHtml::link('<i class="fa fa-fw fa-heartbeat"></i> Copias Seguridad',array('/backup/default')); ?></li>	
	<?php endif; ?>
	<?php if( isset( Yii::app()->user->username) ): ?>
        <li class="visible-xs">
            <?php echo CHtml::link('<i class="fa fa-power-off"></i> Salir( '.Yii::app()->user->username.' )',array('/site/logout')); ?>
        </li>
    <?php endif; ?>
</ul>
</div>
</nav>