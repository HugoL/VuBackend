<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>VirtualUSATIC</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/sb-admin.css" rel="stylesheet">

    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/miestilo.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <!-- <link href="<?php //echo Yii::app()->theme->baseUrl; ?>/css/plugins/morris.css" rel="stylesheet"> -->

    <!-- Custom Fonts -->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
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
            <ul class="nav navbar-right top-nav hidden-xs hidden-sm">
                <?php if( isset( Yii::app()->user->username) ): ?>
                <li>
                    <?php echo CHtml::link('<i class="fa fa-power-off"></i> Salir( '.Yii::app()->user->username.' )',array('/site/logout')); ?>
                </li>
            <?php endif; ?>
            </ul>           
        </nav>
         <div id="page-wrapper">
            <div class="container-fluid">
                <?php echo $content ?>
            </div>
        </div>

    <!-- jQuery -->
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <!-- <script src="<?php //echo Yii::app()->theme->baseUrl; ?>/js/plugins/morris/raphael.min.js"></script> -->
    <!-- <script src="<?php //echo Yii::app()->theme->baseUrl; ?>/js/plugins/morris/morris.min.js"></script> -->
    <!-- <script src="<?php //echo Yii::app()->theme->baseUrl; ?>/js/plugins/morris/morris-data.js"></script> -->

</body>

</html>
