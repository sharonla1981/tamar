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
                //param name by user choice
		$paramName = $_GET['param_name'];
		
                
                /**
                 * MAIN Table variables
                 * @var $mainSql string: main table sql statement with paramaters to be used by the followed sql for Count and DataProvider
                 * @var $count integer: main table sql Count rows
                 * @var $dataProviderSql string: the sql statement that is used by the dataProvider
                 * @var $dataProvider CSqlDataProvider: the dataProvider used by the paramScreen View 
                 */
                $dataProviderMainSql = "SELECT %s
                            FROM par_general_rec AS t1
                            LEFT JOIN par_general_rec AS t2 ON (t2.param_id = t1.sub_param_id AND t2.param_name = t1.sub_param_name)
                            LEFT JOIN par_general_rec AS t3 ON (t3.param_id = t2.sub_param_id AND t3.param_name = t2.sub_param_name)
                            LEFT JOIN par_general_rec AS t4 ON (t4.param_id = t3.sub_param_id AND t4.param_name = t3.sub_param_name)
                            WHERE (ISNULL(t1.end_date) OR t1.end_date >= CURDATE())
                            AND (not ISNULL(t1.sub_param_id))
                            AND t1.param_name ="."'$paramName'";
                
                $count=Yii::app()->db->createCommand(sprintf($dataProviderMainSql,"Count(*)"))->queryScalar();
                
                $dataProviderSql = sprintf($dataProviderMainSql,"t1.id AS id,t1.param_id AS lev1Id, t1.param_value as lev1Val,t1.param_heb_name AS lev1Title,t1.param_name AS lev1Name,
                         t2.param_id as lev2Id, t2.param_value as lev2Val,t2.param_heb_name AS lev2Title,t2.param_name AS lev2Name,
			 t3.param_id AS lev3Id,t3.param_value AS lev3Val,t3.param_heb_name AS lev3Title,t3.param_name AS lev3Name");
                
                /*$sql = "SELECT t1.id AS id,t1.param_id AS lev1Id, t1.param_value as lev1Name,t1.param_heb_name AS lev1Title,
                         t2.param_id as lev2Id, t2.param_value as lev2Name,t2.param_heb_name AS lev2Title,
			 t3.param_id AS lev3Id,t3.param_value AS lev3Name,t3.param_heb_name AS lev3Title
                            FROM par_general_rec AS t1
                            LEFT JOIN par_general_rec AS t2 ON (t2.param_id = t1.sub_param_id AND t2.param_name = t1.sub_param_name)
                            LEFT JOIN par_general_rec AS t3 ON (t3.param_id = t2.sub_param_id AND t3.param_name = t2.sub_param_name)
                            LEFT JOIN par_general_rec AS t4 ON (t4.param_id = t3.sub_param_id AND t4.param_name = t3.sub_param_name)
                            WHERE (ISNULL(t1.end_date) OR t1.end_date >= CURDATE())
                            AND (not ISNULL(t1.sub_param_id))
                            AND t1.param_name ="."'$paramName'";*/
		
		$dataProvider=new CSqlDataProvider($dataProviderSql, array(
				'keyField'=>'id',
				'totalItemCount'=>$count,
				'pagination'=>array(
						'pageSize'=>10,
				),
		));
                
                //get the param level2 and level3 names
                $data = $dataProvider->getData();
                $level1Name = $data[0]['lev1Name'];
                $level2Name = $data[0]['lev2Name'];
                $level3Name = $data[0]['lev3Name'];
                $levelsSQL = "SELECT DISTINCT param_id,param_value,param_heb_name FROM par_general_rec
                                    WHERE param_name = '%s'";
                /***************************************************************************************************************************/
                
                /**
                 * Level One Table variables
                 * $level2And3sql string: the sql statment to retrieve the table
                 * $level3dataProvider CSqlDataProvider: the table of level2's data provider
                 */
                
                $level1dataProvider=new CSqlDataProvider(sprintf($levelsSQL,$level1Name), array(
                                    'keyField'=>'param_id',
                                    'pagination'=>array(
						'pageSize'=>100,
                                    ),
				));
                
                
                
                
                /****************************************************************************************************************************/
		/***************************************************************************************************************************/
                
                /**
                 * Level Two Table variables
                 * $level2And3sql string: the sql statment to retrieve the table
                 * $level2dataProvider CSqlDataProvider: the table of level2's data provider
                 */
                
                
                
                /****************************************************************************************************************************/
                
                
                
                $level2dataProvider=new CSqlDataProvider(sprintf($levelsSQL,$level2Name), array(
                                    'keyField'=>'param_id',
				));
                
                /***************************************************************************************************************************/
                
                /**
                 * Level Three Table variables
                 * $level2And3sql string: the sql statment to retrieve the table
                 * $level3dataProvider CSqlDataProvider: the table of level2's data provider
                 */
                
                $level3dataProvider=new CSqlDataProvider(sprintf($levelsSQL,$level3Name), array(
                                    'keyField'=>'param_id',
				));
                
                
                
                
                /****************************************************************************************************************************/
		
		//the user must be logged on to enter the paramScreen, if no user is logged on, they will be redirected to the login screen.
		if (!Yii::app()->user->isGuest)
		{
			$this->render('paramScreen',array(
					'dataProvider'=>$dataProvider,'level1dataProvider'=>$level1dataProvider,'level2dataProvider'=>$level2dataProvider,
                                        'level3dataProvider'=>$level3dataProvider
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
