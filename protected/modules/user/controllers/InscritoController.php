<?php

class InscritoController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(		
			array('allow',
				'actions'=>array('inscritoAutocomplete'),
				'users'=>array('*'),
			),	
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','view','create','update','updateObservaciones','delete'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','borrarParticipacion'),
				'users'=>Yii::app()->getModule('user')->getAdministradores(),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id){
		$inscritoComunicacion = new InscritoComunicacion;
		$comunicaciones = Comunicacion::model()->findAll();
		$this->render('view',array(
			'model'=>$this->loadModel($id),
			'inscritoComunicacion'=>$inscritoComunicacion,
			'comunicaciones'=>$comunicaciones,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Inscrito;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Inscrito']))
		{
			$model->attributes=$_POST['Inscrito'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Inscrito']))
		{
			$model->attributes=$_POST['Inscrito'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionUpdateObservaciones( $id ){
		$model=$this->loadModel($id);

		if( isset($_POST['Inscrito']) ){
			$model->attributes = $_POST['Inscrito'];
			$model->update();
			if( $id > 0)
				$id--;	
			$this->redirect(Yii::app()->request->urlReferrer."#".$id);
		}
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete( $id )
	{
		Yii::app()->clientScript->scriptMap['*.js'] = false;
		
		$this->loadModel($id)->delete();		
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : Yii::app()->request->urlReferrer);
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex( $export=null )
	{

		$criteria = new CDbCriteria();		

		 if( !empty($_GET['q']) ){
      			$q = strip_tags($_GET['q']);
      			$criteria->addCondition('nombre LIKE "%'.$q.'%"', 'OR');
      			$criteria->addCondition('apellido1 LIKE "%'.$q.'%"', 'OR');
      			$criteria->addCondition('apellido2 LIKE "%'.$q.'%"', 'OR');
      			$criteria->addCondition('email LIKE "%'.$q.'%"', 'OR');
    	}


    	if( !empty($_GET['t']) ){
    		$t = strip_tags($_GET['t']);
    		$criteria->join = "INNER JOIN ".InscritoTaller::model()->tableSchema->name." i ON t.id = i.id_usuario AND i.id_taller = ".$t;
    	}

    	if( !empty($_GET['f']) ){
    		switch ($_GET['f']) {    			
    			case 1:
    				$criteria->addCondition( 'id_rol = 1 OR id_rol = 2');
    				break;
    			case 2:
    				$criteria->addCondition( 'id_rol = 1' );
    				break;
    			case 3:
    				$criteria->addCondition( 'id_rol = 2' );
    				break;
    			case 4:
    				$criteria->addCondition( 'id_rol = 3');
    				break;    			
    			default:    				
    		}
        }       
       

		$parametro = Dato::model()->find('clave = "edicion"');
		//$criteria = new CDbCriteria;
		$criteria->addCondition('edicion = :edicion');
		$criteria->params = array(':edicion' => $parametro->valor);

		if( Yii::app()->user->rol == 4 ) //si es este rol que solo aparezcan los inscritos NO GRATUITOS
			$criteria->addCondition('id_rol <> 3');

		if( !empty($export) && $export == 1 ){ //si los datos se van a exportar no tienen que ir paginados
			$dataProvider=new CActiveDataProvider('Inscrito',array(
            'criteria'=>$criteria,
            'pagination'=>false));
			
			$this->createExcel( $dataProvider );
		}else{
			//el consultor solo verá los inscritos de pago
			if( Yii::app()->user->rol == 4 )
				$criteria->addCondition('id_rol != 3');
			$dataProvider=new CActiveDataProvider('Inscrito',array(
            'criteria'=>$criteria,
            'pagination' => array('pageSize' => 20),
            ));
		}

		$talleres = Taller::model()->findAll();

		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			'talleres'=>$talleres,
			'edicion'=>$parametro->valor,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model = new Inscrito('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Inscrito']))
			$model->attributes = $_GET['Inscrito'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	protected function createExcel( $dataProvider ){
		Yii::import('ext.phpexcel.XPHPExcel');    
		$objPHPExcel= XPHPExcel::createPHPExcel();
		$objPHPExcel->getProperties()->setCreator("Virtual USATIC")
		->setLastModifiedBy("Virtual USATIC")
		->setTitle("Virtual USATIC")
		->setSubject("Inscritos Virtual USATIC")
		->setDescription("Inscritos a las Jornadas Virtual USATIC.")
		->setKeywords("inscritos virtual usatic")
		->setCategory("tic");


		$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A1', 'Fecha')
			->setCellValue('B1', 'Nombre')
			->setCellValue('C1', 'Primer Apellido')
			->setCellValue('D1', 'Segundo Apellido')
			->setCellValue('E1', 'Dni')
			->setCellValue('F1', 'Email')
			->setCellValue('G1', 'Dirección')
			->setCellValue('H1', 'Código Postal')
			->setCellValue('I1', 'Localidad - Provincia')
			->setCellValue('J1', 'País')
			->setCellValue('K1', 'Teléfono')
			->setCellValue('L1', 'Factura como empresa')
			->setCellValue('M1', 'Nombre empresa')
			->setCellValue('N1', 'CIF')
			->setCellValue('O1', 'Dirección empresa')
			->setCellValue('P1', 'Cuantía a pagar')
			->setCellValue('Q1', 'Titulación')
			->setCellValue('R1', 'Talleres')
			->setCellValue('S1', 'Rol')
			->setCellValue('T1', 'Pagado');

		// Add some data
		$inscritos = $dataProvider->getData();
		$i = 2;
		foreach ($inscritos as $key => $inscrito) {
			if( $inscrito->pagado == 1)
				$inscrito->pagado = 'Sí';
			else
				$inscrito->pagado = 'No';

			if( !empty($inscrito->nifEmpresa) )
				$factura = "Sí";
			else
				$factura = "No";

			if(  $inscrito->nacionalidad == 0 || empty($inscrito->nacionalidad) ){
				$pais = $inscrito->pais;
			}else{
				$modelo_pais = Pais::model()->findByPk( $inscrito->nacionalidad );
				$pais = $modelo_pais->nombre;
			}

			$talleres = "";

			if( !empty($inscrito->inscritoTaller) ){				
				foreach ($inscrito->inscritoTaller as $key => $taller) {
					$talleres .= $taller->taller->abreviacion.","; 
				}
			}


			$pagos = $inscrito->pago;
			$total_pagar = 0;
			foreach($pagos as $pago){
				$total_pagar = $total_pagar + $pago->cantidad_pagar;
			}

			$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A'.$i, $inscrito->fecha)
			->setCellValue('B'.$i, $inscrito->nombre)
			->setCellValue('C'.$i, $inscrito->apellido1)
			->setCellValue('D'.$i, $inscrito->apellido2)
			->setCellValue('E'.$i, $inscrito->nif)
			->setCellValue('F'.$i, $inscrito->email)
			->setCellValue('G'.$i, $inscrito->direccion)
			->setCellValue('H'.$i, $inscrito->cp)
			->setCellValue('I'.$i, $inscrito->localidad.' - '.$inscrito->provincia)
			->setCellValue('J'.$i, $pais)
			->setCellValue('K'.$i, CHtml::encode($inscrito->telefono))
			->setCellValue('L'.$i, $factura)
			->setCellValue('M'.$i, $inscrito->razonSocial)
			->setCellValue('N'.$i, $inscrito->nifEmpresa)
			->setCellValue('O'.$i, $inscrito->direccionEmpresa)
			->setCellValue('P'.$i, $total_pagar)
			->setCellValue('Q'.$i, $inscrito->titulacion)
			->setCellValue('R'.$i, $talleres)
			->setCellValue('S'.$i, $inscrito->rol->nombre)
			->setCellValue('T'.$i, $inscrito->pagado);
			$i++;
		}
		

		// Rename worksheet
		$objPHPExcel->getActiveSheet()->setTitle('Virtual USATIC');


		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);

		$fecha = date("d-m-y");
		$hora = date("H:i:s");

		// Redirect output to a clientâ€™s web browser (Excel5)
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="inscritos_usatic-'.$fecha.'-H'.$hora.'.xls"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		Yii::app()->end();
	}

	public function actionInscritoAutocomplete(){
 		if( !isset($_GET['term']) ){
 			echo "No se recibe term<br />"; 			
 		}else{
 			$term = trim($_GET['term']) ; 			
	        if($term !='') {
	        	$inscritos = array(); //lo declaro como array porque si no no se muestran las opciones en el autocompletar
	            // Note: Users::usersAutoComplete is the function you created in Step 2
	      		$inscritos = Inscrito::inscritoAutoComplete($term);
	      		
	            echo CJSON::encode($inscritos);
	        }            
    	}
    	//$this->renderJSON($comunicaciones);
    	Yii::app()->end();
  }

  public function actionBorrarParticipacion( $id ){
 		$inscom = inscritoComunicacion::model()->findByPk( $id );
 		$inscom->delete();

 		$this->redirect(Yii::app()->request->urlReferrer);

  }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Inscrito the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Inscrito::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Inscrito $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		//Yii::app()->getClientScript()->registerCoreScript('yii'); 

		if(isset($_POST['ajax']) && $_POST['ajax']==='inscrito-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
