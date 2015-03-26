<?php

class ProfileController extends Controller
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','principal','administrador','colaborador','consultor','visitante'),
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
	public function actionView($id)
	{
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
		$model=new Profile;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Profile']))
		{
			$model->attributes=$_POST['Profile'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->user_id));
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

		if(isset($_POST['Profile']))
		{
			$model->attributes=$_POST['Profile'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->user_id));
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
		$dataProvider=new CActiveDataProvider('Profile');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Profile('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Profile']))
			$model->attributes=$_GET['Profile'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionPrincipal(){
		switch ( Yii::app()->user->rol ) {
			case 1: //superadministrador
				$this->redirect('administrador');
				break;
			case 2: //administrador
				$this->redirect('administrador');
				break;
			case 3: 
				$this->redirect('colaborador');
				break;
			case 4: 
				$this->redirect('consultor');
				break;
			case 5: 
				$this->redirect('visitante');
				break;
			
			default:
				Yii::app()->end();
				break;
		}
	}

	public function actionAdministrador(){
		//total pagado y total
		//total inscritos
		//total comunicaciones
		//pendientes de revisar?
		if( Yii::app()->user->rol == 1 || Yii::app()->user->rol == 2){		
			$edicion = Dato::model()->find('clave = "edicion"');
			$pagado = $this->totalpagado();

			$total = $this->totalPagar();

			$comunicaciones = $this->totalComunicaciones();

			$norevisadas = $this->pendientesRevisar();

			$inscritos = $this->totalInscritos();
			
			$datos = $this->totalInscritosGrafica();
			$this->render('administrador', array(
				'total'=>$total, 
				'pagado' => $pagado,
				'inscritos'=>$inscritos,
				'comunicaciones'=>$comunicaciones,
				'norevisadas'=>$norevisadas,
				'edicion' => $edicion->valor,
				'datos' => $datos,
				)
			);
		}else{
			Yii::app()->end();
		}
	}

	public function actionColaborador(){
		//pendientes de revisar / revisadas
		//total comunicaciones


		if( Yii::app()->user->rol == 3 || Yii::app()->user->rol == 1 || Yii::app()->user->rol == 2){
			$edicion = Dato::model()->find('clave = "edicion"');
			$comunicaciones = $this->totalComunicaciones();

			$norevisadas = $this->pendientesRevisar();

			$revisadas = $this->revisadas();

			$inscritos = $this->totalInscritos();
		
			$this->render('colaborador', array('comunicaciones'=>$comunicaciones,'norevisadas'=>$norevisadas, 'revisadas' => $revisadas,'edicion' => $edicion->valor));
		}else{
			Yii::app()->end();
		}
	}

	public function actionConsultor(){
		//total pagado
		//total inscritos
		//total comunicaciones
		if( Yii::app()->user->rol == 4 || Yii::app()->user->rol == 1 || Yii::app()->user->rol == 2){
			$edicion = Dato::model()->find('clave = "edicion"');
			$pagado = $this->totalpagado();

			$total = $this->totalPagar();

			$inscritos = $this->totalInscritosDePago();
		
			//$this->render('consultor', array('inscritos'=>$inscritos, 'pagado' => $pagado, 'total' => $total ,'edicion' => $edicion->valor));
			$this->redirect(array('inscrito/index'));
		}else{
			Yii::app()->end();
		}
	}

	public function actionVisitante(){
		if( Yii::app()->user->rol == 5 || Yii::app()->user->rol == 1 || Yii::app()->user->rol == 2){
			$edicion = Dato::model()->find('clave = "edicion"');
			$comunicaciones = $this->totalComunicaciones();
			$inscritos = $this->totalInscritos();

			$this->render('visitante', array('inscritos'=>$inscritos, 'comunicaciones' => $comunicaciones,'edicion' => $edicion->valor));
		}else{
			Yii::app()->end();
		}

	}

	protected function pendientesRevisar(){
		$criteria = new CDbCriteria;
		$criteria->select = 'count(*) as total';
		$criteria->condition = 'revisado = :id AND aprobado = NULL';
		$criteria->params = array(':id' => Yii::app()->user->id);
		$norevisadas = Comunicacion::model()->find( $criteria );

		return $norevisadas->total;
	}

	protected function revisadas(){
		$criteria = new CDbCriteria;
		$criteria->select = 'count(*) as total';
		$criteria->condition = 'revisado = :id AND aprobado != NULL';
		$criteria->params = array(':id' => Yii::app()->user->id);
		$norevisadas = Comunicacion::model()->find( $criteria );

		return $norevisadas->total;
	}

	protected function totalComunicaciones(){
		$criteria = new CDbCriteria;
		$criteria->select = 'count(*) as total';
		$inscritos = Inscrito::model()->find( $criteria );

		$comunicaciones = Comunicacion::model()->find( $criteria );

		return $comunicaciones->total;
	}

	protected function totalPagar(){
		$criteria = new CDbCriteria;
		$criteria->select = 'sum(cantidad_pagar) AS total';			
		$total = Pago::model()->find( $criteria );

		return $total->total;
	}

	protected function totalpagado(){
		$criteria = new CDbCriteria;
		$criteria->select = 'sum(cantidad_pagar) AS total';
		$criteria->join = 'inner join vu_inscritos i ON t.id_usuario = i.id AND i.pagado = 1';
		$pagado = Pago::model()->find( $criteria );

		return $pagado->total;
	}

	protected function totalInscritos(){
		$criteria = new CDbCriteria;
		$criteria->select = 'count(*) as total';
		$inscritos = Inscrito::model()->find( $criteria );

		return $inscritos->total;
	}

	protected function totalInscritosDePago(){
		$criteria = new CDbCriteria;
		$criteria->select = 'count(*) as total';
		$criteria->condition = 'id_rol != 3';
		$inscritos = Inscrito::model()->find( $criteria );

		return $inscritos->total;
	}

	protected function totalInscritosGrafica(){
		$criteria = new CDbCriteria;
		$criteria->group = 'edicion';
		$criteria->select = 'count(*) as total, edicion';
		$inscritos = Inscrito::model()->findAll( $criteria );

		$datos = array();
		array_push($datos, array('Edicion','Inscritos'));
		//los incritos de la primera edición no están en la base de datos porque los gestionó la feuz, así que los introduzco manualmente
		array_push($datos, array('2013',340));
		array_push($datos,array('2014',560));
		foreach( $inscritos as $key => $inscrito ){
			array_push( $datos, array($inscrito->edicion, intval($inscrito->total)) );
		}
		return $datos;

	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Profile the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Profile::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Profile $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='profile-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
