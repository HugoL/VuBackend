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
});
    </script>

   