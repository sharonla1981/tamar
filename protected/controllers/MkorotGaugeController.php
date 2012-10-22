<?php

class MkorotGaugeController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';
	public $layout='//layouts/righty';

  	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
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
				'actions'=>array('delete','create','update','getGaugeOptionsAjax','getAreaOptionsAjax','getGaugeAreaIdOptionsAjax','getMonthNamesAjax',
						'getPeriodNamesAjax','getGaugesAjax','areaGaugeView','getMkorotGaugeCols','updateAjax'),
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
                $result = false;
		$model=new MkorotGauge;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['MkorotGauge']))
		{
			$model->attributes=$_POST['MkorotGauge'];
			if($model->save()) {
                        $result = true;
                        }
		}
		
		
                echo $result;

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

		if(isset($_POST['MkorotGauge']))
		{
			$model->attributes=$_POST['MkorotGauge'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
        
        public function actionUpdateAjax()
        {
            $update = false;
            
            if(Yii::app()->request->isAjaxRequest && isset($_POST['primary']))
            {
                $primary = $_POST['primary'];
                $fieldName = $_POST['fieldName'];
                $text = isset($_POST['text']) ? $_POST['text'] : "";
                
                $model=$this->loadModel($primary);
                
                $model->setAttribute($fieldName,$text);
                
                if ($model->save())
                {
                    $update = true;
                }
                
                echo $update;
            }
        }

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{

        $model=new MkorotGauge;

       

		$dataProvider=new CActiveDataProvider('MkorotGauge',
            array(
                'pagination'=>array(
                    'pageSize'=>10,
                ),
            )
        );
/*
        $count=Yii::app()->db->createCommand('SELECT COUNT(*) FROM ext_mkorot_gauge')->queryScalar();
        $sql="select a.*,b.* from ext_mkorot_gauge a ,areas b
        where a.area_id = b.id";
        $dataProvider=new CSqlDataProvider($sql, array(
            'keyField'=>'id',
            'totalItemCount'=>$count,
            'pagination'=>array(
                'pageSize'=>10,
            ),
        ));
*/
                if (!Yii::app()->user->isGuest)
                {
                    $this->render('index',array(
                           'dataProvider'=>$dataProvider,'model'=>$model,
                    ));
                }
                else
                {
                    $this->redirect('index.php?r=site/login');
                }



	}
	
	public function actionAreaGaugeView()
	{
		$this->render('areaGAugeView');
	}

    public function actionGetPeriodNamesAjax()
    {

        if(Yii::app()->request->isAjaxRequest && isset($_GET['month']))
        {
            $month = $_GET['month'];
        }

        $sql = "SELECT a.sub_param as 'period',a.param_text as 'period_name'
                FROM par_general as a,par_general as b 
                WHERE a.sub_param = b.param_text AND a.param = 'period' And b.sub_param=" .$month;
                    

        $data = Yii::app()->db->createCommand($sql)->queryAll();

        /*foreach ($data as $item) {

            $arr[] = array(
                'id' => $item->id,
                //'value' => $item->,
                //'label' => $item->id,
            );
        }*/

        echo CJSON::encode($data);
    }

    public function actionGetGaugeOptionsAjax()
    {
        if(Yii::app()->request->isAjaxRequest && isset($_GET['term']))
        {
            $criteria = new CDbCriteria;
            $criteria->select = array('id', 'areaId');

            $criteria->addSearchCondition('id',  strtoupper( $_GET['term']) ) ;
            $criteria->limit = 15;
            $data = AreaGauge::model()->findAll($criteria);

            $arr = array();

            foreach ($data as $item) {

                $arr[] = array(
                    'id' => $item->id,
                    'value' => $item->id,
                    'label' => $item->id,
                );
            }

            echo CJSON::encode($arr);

        }
    }

    public function actionGetMonthNamesAjax()
    {
        $months = array();
        for($i=1;$i<=12;$i++)
        {
            $months[] = array(
                'id'=>$i,
                'value'=>Yii::app()->getLocale()->monthNames[$i],
            );
        }
        echo CJSON::encode($months);
    }

    /**
     * call by ajax from the _form view,
     * return an array which contain the areaId and the areaName
     */
    public function actionGetGaugeAreaIdOptionsAjax()
    {
        if(Yii::app()->request->isAjaxRequest && isset($_GET['term1']))
        {
                $areaId = AreaGauge::model()->findByPk($_GET['term1'])->getAttribute('areaId');
                $areaName = Areas::model()->findByPk($areaId)->getAttribute('areaName');
                $data = array('areaId'=>$areaId,'areaName'=>$areaName);

               echo CJSON::encode($data);

        }
    }

    public function actionGetAreaOptionsAjax()
    {
        if(Yii::app()->request->isAjaxRequest && isset($_GET['term1']))
        {
            $criteria = new CDbCriteria;
            $criteria->select = array('id', 'areaName');
            $criteria->addSearchCondition('areaName',  strtoupper( $_GET['term1']) ) ;
            $criteria->limit = 15;
            $data = Areas::model()->findAll($criteria);

            $arr = array();

            foreach ($data as $item) {

                $arr[] = array(
                    'id' => $item->id,
                    'value' => $item->areaName,
                    'label' => $item->areaName,
                );
            }

            echo CJSON::encode($arr);

        }
    }
    
    public function actionGetGaugesAjax()
    {
    	if(Yii::app()->request->isAjaxRequest)
    	{
    		$dataProvider=new CActiveDataProvider('MkorotGauge');
    		
    		echo CJSON::encode($dataProvider->getData());
    	}
    }
    
    public function actionGetMkorotGaugeCols()
    {
        $model = new MkorotGauge;
        
        $labels = $model->attributeLabels();
        
        $labelsArr = array();
        
        foreach ($labels as $labelName => $label)
        {
            $labelsArr[] = array(
                'name'=> $label,
                'mapping' => $labelName,
                
                
            );
        }
        
        echo CJSON::encode($labelsArr);
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
            $model=new MkorotGauge('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['MkorotGauge']))
                    $model->attributes=$_GET['MkorotGauge'];

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
            $model=MkorotGauge::model()->findByPk($id);
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
            if(isset($_POST['ajax']) && $_POST['ajax']==='mkorot-gauge-form')
            {
                    echo CActiveForm::validate($model);
                    Yii::app()->end();
            }
    }

}
