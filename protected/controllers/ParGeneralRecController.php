<?php

class ParGeneralRecController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/righty';

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
				'actions'=>array('create','update','paramScreen','editbleGrid','getParamAjax'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
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
		$model=new ParGeneralRec;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ParGeneralRec']))
		{
			$model->attributes=$_POST['ParGeneralRec'];
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

		if(isset($_POST['ParGeneralRec']))
		{
			$model->attributes=$_POST['ParGeneralRec'];
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
		$dataProvider=new CActiveDataProvider('ParGeneralRec');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ParGeneralRec('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ParGeneralRec']))
			$model->attributes=$_GET['ParGeneralRec'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=ParGeneralRec::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='par-general-rec-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	/**
	 * used for _pane2 view that contain the existing params in the table
	 * by select distinct the param_heb_name attribute
	 * @return ParGeneralRec Model
	 */
	public function paramScreenPanel()
	{
		$model = ParGeneralRec::model()->findAll(array('select'=>'t.param_heb_name,t.param_name','group'=>'t.param_name','distinct'=>true,'condition'=>'NOT ISNULL(t.sub_param_name)'));

		return $model;
	}
	
	/**
	 * create the data provider based on a SQL statement which returns the selected param with it's sub param value and title.
	 * finnaly render the paramScreen view with the data provider.
	 */
	public function actionParamScreen()
	{
		$paramName = $_GET['param_name'];
		
		$count=Yii::app()->db->createCommand("SELECT COUNT(*) FROM par_general_rec a,par_general_rec b
				WHERE (ISNULL(a.end_date) OR a.end_date >= CURDATE())
			 		AND a.sub_param_id = b.param_id
			 		AND a.param_name ="."'$paramName'")->queryScalar();
		$sql="SELECT a.id AS 'id',a.param_heb_name AS 'paramName',a.sub_param_id AS 'subId',a.param_value AS 'value',b.param_value AS 'subValue',
			 b.param_heb_name AS 'subParamName'
				FROM par_general_rec a,par_general_rec b
				WHERE (ISNULL(a.end_date) OR a.end_date >= CURDATE())
			 		AND a.sub_param_id = b.param_id
			 		AND a.param_name ="."'$paramName'";
		
		$dataProvider=new CSqlDataProvider($sql, array(
				'keyField'=>'id',
				'totalItemCount'=>$count,
				'pagination'=>array(
						'pageSize'=>10,
				),
		));
		
		//the user must be logged on to enter the paramScreen, if no user is logged on, they will be redirected to the login screen.
		if (!Yii::app()->user->isGuest)
		{
			$this->render('paramScreen',array(
					'dataProvider'=>$dataProvider,
			));
		}
		else
		{
			$this->redirect('index.php?r=site/login');
		}
		
	}
	
	public function actionEditbleGrid()
	{
		$dataProvider = new CActiveDataProvider('ParGeneralRec');
		if (!Yii::app()->user->isGuest)
		{
			$this->render('editbleGrid',array(
					'dataProvider'=>$dataProvider,
			));
		}
		else
		{
			$this->redirect('index.php?r=site/login');
		}
	}
	
	public function actionGetParamAjax()
	{
		/*if(Yii::app()->request->isAjaxRequest)
		{*/
			$dataProvider = new CActiveDataProvider('ParGeneralRec');
			
			echo CJSON::encode($dataProvider->getData());
		//}
	}
	
}
