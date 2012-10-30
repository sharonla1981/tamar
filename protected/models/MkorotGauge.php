<?php

/**
 * This is the model class for table "ext_mkorot_gauge".
 *
 * The followings are the available columns in table 'ext_mkorot_gauge':
 * @property string $gauge_id
 * @property integer $years
 * @property integer $months
 * @property integer $period
 * @property double $amount
 * @property integer $area_id
 * @property integer $id
 */
class MkorotGauge extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @return MkorotGauge the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ext_mkorot_gauge';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
        //years can be in the range from this year and 2 years before
        $years = array();
        $currentYear = date('Y');
        for ($i=0;$i<3;$i++)
        {
             array_push($years,$currentYear-$i);
        }
         //create the message for year validation
        $yearsMessage = 'השנה חייבת להיות בין'.' '.$years[count($years)-1].' '.'ל-'.$years[0];
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('gauge_id, years, months,amount,period,area_id', 'required'),
			array('years, months, period, area_id', 'numerical', 'integerOnly'=>true),
			array('amount', 'numerical'),
			array('gauge_id', 'length', 'max'=>20),
                        array('months','ext.UniqueAttributesValidator.UniqueAttributesValidator','on'=>'insert','with'=>'years,gauge_id','message'=>'כבר קיים מידע עבור חודש זה'),
                        //array('','unique','on'=>'insert','message'=>'כבר קיים מידע עבור התקופה'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('gauge_id, years, months, period, amount, area_id, id', 'safe', 'on'=>'search'),
                        array('years','in','range'=>$years,'message'=>$yearsMessage),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'areas'=>array(self::BELONGS_TO,'Areas','area_id'),
            'gauge_area'=>array(self::BELONGS_TO,'AreaGauge','gauge_id'),
		);
	}

        public function primaryKey()
        {
            return array('gauge_id','years','months');
            // For composite primary key, return an array like the following
            // return array('pk1', 'pk2');
        }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'gauge_id' => 'חיבור',
			'years' => 'שנה',
			'months' => 'חודש',
			'period' => 'תקופה',
			'amount' => 'כמות',
			'area_id' => 'איזור',
            'areas.areaName' => 'איזור',
			'id' => 'ID',
		);
	}
        
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{

		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('gauge_id',$this->gauge_id,true);
		$criteria->compare('years',$this->years);
		$criteria->compare('months',$this->months);
		$criteria->compare('period',$this->period);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('area_id',$this->area_id);
		$criteria->compare('id',$this->id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    /**
     * @return array of the areas that exists in the view
     */
    public  function getAreaOptions()
    {
        $areaArray = CHtml::listData( Areas::model()->findAll(),'id','areaName');
        return $areaArray;
    }

    public  function getAreaGaugeOptions()
    {
        $areaArray = CHtml::listData( AreaGauge::model()->findAll(),'id','id');
        return $areaArray;
    }
}