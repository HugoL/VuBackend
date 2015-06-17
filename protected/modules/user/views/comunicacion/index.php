<?php
/* @var $this ComunicacionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Comunicaciones',
);

$this->menu=array(
	array('label'=>'Create Comunicacion', 'url'=>array('create')),
	array('label'=>'Manage Comunicacion', 'url'=>array('admin')),
);
?>
<center><h3>Comunicaciones edición <?= $edicion ?></h3></center>
<?php if( !empty( $_GET['hash']) ): ?>
  <input value="<?=$_GET['hash'] ?>" id="hash" type="hidden" />
<?php endif; ?>
<div class="row pull-right"><?php echo $paginas == 1 ? CHtml::link('Página única',array('comunicacion/index','paginas'=>0),array('class' => 'btn btn-danger' )) : CHtml::link('Ver en páginas',array('comunicacion/index','paginas'=>1),array('class' => 'btn btn-primary' )); ?></div>
<div class="clearfix">&nbsp;</div>
<div class="table-responsive">
<table class="table table-striped">
	<tr>
		<th>Código</th>
		<th>Título</th>
		<th>Observaciones</th>
		<th>Autores</th>
		<th>Me lo pido</th>
		<th>Tipo</th>
		<th>Aprobado</th>
		<th></th>
	</tr>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
  'viewData' => array('paginas' => $paginas),
  'pager'=>array(
        'cssFile'=>Yii::app()->theme->baseUrl.'/css/pager.css',
        'firstPageLabel' => '<<',
        'prevPageLabel'  => '<',
        'nextPageLabel'  => '>',
        'lastPageLabel'  => '>>',
        ),
)); ?>
</table>
</div>

<?php $url_action = CHtml::normalizeUrl(array('/comunicacion/ajaxMelopido')); ?>

<?php Yii::app()->clientScript->registerScript('revisar', '$(document).ready(function(){ 
     $("input[name=\'revisado[]\']").live("click", function(){
      var idComunicacion = $(this).val();      
      var parametros = { "idComunicacion" : $(this).val(), "idUsuario" : 3, "usuario" : "hlanga" };
      //AJAX
      if( $(this).is(":checked") ){        
        $.ajax({          
              data:  parametros,
              url:   "$url_action",
              type:  "post",
              beforeSend: function () {
                      //nada
              },
              success:  function (html) {
                          $("#span"+idComunicacion).attr("class","label label-warning");
                          $("#span"+idComunicacion).html(html).show();
                          $("#"+idComunicacion).removeAttr("readonly");          
              }
          });

        //reload
        window.setTimeout("location.reload()", 1000);  

        $(this).attr("disabled','disabled");  
      }
      //location.reload(); 
    });
  });
    ');  ?>

    <script>
    var request;
     $(document).ready(function(){ 
     $("input[name='revisado[]']").click(function(){
      alert($(this).val());
      var idComunicacion = $(this).val();      
      var parametros = { "idComunicacion" : $(this).val(), "idUsuario" : <?= Yii::app()->user->id; ?>, "usuario" : "<?= Yii::app()->user->username; ?>" };
      //AJAX
      if( $(this).is(":checked") ){        
        request=$.ajax({          
              data:  parametros,
              url:   "<?php echo $url_action; ?>",
              type:  "post",
              beforeSend: function () {
                      //nada
              },
              success:  function (html) {
                          $("#span"+idComunicacion).attr("class","label label-warning");
                          $("#span"+idComunicacion).html(html).show();
                          $("#"+idComunicacion).removeAttr("readonly");          
              },
              error: function(html){
                $("#span"+idComunicacion).attr("class","label label-warning");
                $("#span"+idComunicacion).html(html).show();
              }
          });

        //reload
        //window.setTimeout("location.reload()", 1000);  

        $(this).attr("disabled','disabled");  
      }
      //location.reload(); 
    });
  
    if ( $( "#hash" ).length ) {
      console.log($('#hash').val());
      location.hash = "#"+$('#hash').val();           
    }
});
    </script>

   