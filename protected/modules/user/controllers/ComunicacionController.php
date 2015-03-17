<?php

class ComunicacionController extends Controller
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
				'actions'=>array('comunicacionAutocomplete'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','view','create','update','ajaxMelopido', 'anadirAutor','melopido','nomelopido','pendientes'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
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
	public function actionView($id, $Comunicacion_page = null)
	{
		if( !empty($Comunicacion_page) )
			$this->render('view',array(
				'model'=>$this->loadModel($id),
				'pagina'=>$Comunicacion_page,
			));
		else
			$this->render('view',array(
				'model'=>$this->loadModel($id),
			));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Comunicacion;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Comunicacion']))
		{
			$model->attributes=$_POST['Comunicacion'];
			$parametro = Dato::model()->find('clave = "edicion"');
			$model->edicion = $parametro->valor;
			if($model->save())
				Yii::app()->user->setFlash('success','Comunicación guardada correctamente');
			else
				Yii::app()->user->setFlash('error','No se ha podido guardar la comunicación');
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

		if(isset($_POST['Comunicacion']))
		{
			$model->attributes=$_POST['Comunicacion'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$parametro = Dato::model()->find('clave = "edicion"');
		$criteria = new CDbCriteria;
		$criteria->condition = 'edicion = :edicion';
		$criteria->params = array(':edicion' => $parametro->valor);

		$dataProvider=new CActiveDataProvider('Comunicacion',array(
			'criteria' => $criteria,
			'pagination' => array('pageSize' => 20),
			));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Comunicacion('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Comunicacion']))
			$model->attributes=$_GET['Comunicacion'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionAnadirAutor( $id = null ){
		//var_dump($_POST);
		$model = new InscritoComunicacion;
		if( !empty($id) ){
			$comunicacion = $this->loadModel( $id );
			$model->id_comunicacion = $id;
		}
		
		if( isset($_POST['InscritoComunicacion']) ){
			$model->attributes = $_POST['InscritoComunicacion'];
			$check = InscritoComunicacion::model()->findByAttributes(array('id_usuario' => $model->id_usuario, 'id_comunicacion' => $model->id_comunicacion));
			if( empty($check) ){
				if( $model->save() ){
					Yii::app()->user->setFlash('success','Guardado correctamente');
				}else{
					Yii::app()->user->setFlash('error','Los datos no se han guardado');
				}
			}else{
				Yii::app()->user->setFlash('info','El usuario ya estaba relacionado con esa comunicación');
			}
			$this->redirect(Yii::app()->request->urlReferrer);
		}else{
			$this->render('anadirAutor',array(
				'comunicacion' => $comunicacion,
				'model' => $model,
			));
		}
	}

	public function actionAjaxMelopido(){
		$idComunicacion = strip_tags($_POST['idComunicacion']);
		$comunicacion = Comunicacion::model()->findByPk($idComunicacion);
		$comunicacion->revisado = Yii::app()->user->id;
		$comunicacion->update(false);

		echo Yii::app()->user->username;

		Yii::app()->end();
	}

	public function actionMelopido( $idComunicacion, $Comunicacion_page = null ){
		$comunicacion = Comunicacion::model()->findByPk($idComunicacion);
		$comunicacion->revisado = Yii::app()->user->id;
		$comunicacion->update();

		$parametro = Dato::model()->find('clave = "edicion"');
		$criteria = new CDbCriteria;
		$criteria->condition = 'edicion = :edicion';
		$criteria->params = array(':edicion' => $parametro->valor);

		if( !empty($Comunicacion_page) ){
		$dataProvider=new CActiveDataProvider('Comunicacion',array(
			'criteria' => $criteria,
			'pagination' => array('pageSize' => 20,'currentPage' => $Comunicacion_page),
			
			)
		);
		}else{
			$dataProvider=new CActiveDataProvider('Comunicacion',array(
			'criteria' => $criteria,
			'pagination' => array('pageSize' => 20)
			)
		);
		}
		
		$this->redirect(array('index'));
	}

	public function actionNomelopido( $idComunicacion, $Comunicacion_page = null ){
		$comunicacion = Comunicacion::model()->findByPk($idComunicacion);
		
		if( $comunicacion->revisado == Yii::app()->user->id ){
			$comunicacion->revisado = null;
			$comunicacion->update();
		}

		if( !empty($Comunicacion_page) ){
		$dataProvider=new CActiveDataProvider('Comunicacion',array(
			'criteria' => $criteria,
			'pagination' => array('pageSize' => 20,'currentPage' => $Comunicacion_page),
			)
		);
		}else{
			$dataProvider=new CActiveDataProvider('Comunicacion',array(
			'criteria' => $criteria,
			'pagination' => array('pageSize' => 20)
			)
		);
		}
		$this->redirect('index',array('dataProvider'=>$dataProvider,'hash'=>$idComunicacion));
	}

	public function actionPendientes( ){

		$criteria = new CDbCriteria;
		$criteria->condition = 'revisado = '.Yii::app()->user->id.' AND aprobado = 0';

		$dataProvider=new CActiveDataProvider('Comunicacion',array('criteria' => $criteria));

		$this->render('pendientes',array('dataProvider'=>$dataProvider));
	}

	public function actionComunicacionAutocomplete(){
 		if( !isset($_GET['term']) ){
 			echo "No se recibe term<br />"; 			
 		}else{
 			$term = trim($_GET['term']) ; 			
	        if($term !='') {
	        	$comunicaciones = array(); //lo declaro como array porque si no no se muestran las opciones en el autocompletar
	            // Note: Users::usersAutoComplete is the function you created in Step 2
	      		$comunicaciones = Comunicacion::comunicacionAutoComplete($term);
	      		foreach ($comunicaciones as $comunicacion) {
	      			
	      			/*$arr[] = array(
                        'id'=>$comunicacion['id'],
                        'value'=>$comunicacion['titulo'],
                );*/

	      		}
	            echo CJSON::encode($comunicaciones);
	        }            
    	}
    	//$this->renderJSON($comunicaciones);
    	Yii::app()->end();
  }


	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Comunicacion the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Comunicacion::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Comunicacion $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='comunicacion-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
