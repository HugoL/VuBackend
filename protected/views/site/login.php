<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>
<div class="container">

<?php echo CHtml::beginForm(); ?>
    <?php if(Yii::app()->user->hasFlash('loginMessage')): ?>

    <div class="success">
       <?php echo Yii::app()->user->getFlash('loginMessage'); ?>
   </div>

<?php endif; ?>
<div class="login-container">
    <div id="output"></div>
    <div><center><img src="<?php echo Yii::app()->baseUrl ?>/images/logo.jpg" alt="Acceso restringido"></center></div>
    <div class="form-box">                
        <?php if( Yii::app()->user->hasFlash('error')): ?>
  <div class="alert alert-danger"><?php echo Yii::app()->user->getFlash('error'); ?></div><?php endif; ?>
        <?php echo CHtml::errorSummary($model); ?>


        <?php echo CHtml::activeTextField($model,'username',array('placeholder' => 'Usuario')) ?>

        <?php echo CHtml::activePasswordField($model,'password',array('placeholder' => 'Contraseña')) ?>

        <div class="rememberme"><?php echo CHtml::activeCheckBox($model,'rememberMe'); ?><span> Recordarme más tarde</span>
          <?php //echo CHtml::activeLabelEx($model,'rememberMe'); ?> </div>

          
      </div>
        <div>
              <?php echo CHtml::submitButton('Acceder', array('class'=>'btn btn-danger btn-lg loginbtn')); ?>

          </div>
      <div class="clearfix"><p>&nbsp;<p/></div>
  </div><!-- /login-container -->
<?php echo CHtml::endForm(); ?>

</div><!-- form -->

<?php
$form = new CForm(array(
    'elements'=>array(
        'username'=>array(
            'type'=>'text',
            'maxlength'=>32,
            ),
        'password'=>array(
            'type'=>'password',
            'maxlength'=>32,
            ),
        'rememberMe'=>array(
            'type'=>'checkbox',
            )
        ),

    'buttons'=>array(
        'login'=>array(
            'type'=>'submit',
            'label'=>'Login',
            ),
        ),
    ), $model);
?>