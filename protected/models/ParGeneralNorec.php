<?php

/**
 * This is the model class for table "par_general_norec".
 *
 * The followings are the available columns in table 'par_general_norec':
 * @property string $param_name
 * @property integer $param_id
 * @property string $param_value
 * @property string $start_date
 * @property string $end_date
 */
class ParGeneralNorec extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ParGeneralNorec the static model class
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
		return 'par_general_norec';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('param_name, param_value', 'required'),
			array('param_id', 'numerical', 'integerOnly'=>true),
			array('param_name, param_value', 'length', 'max'=>50),
			array('start_date, end_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('param_name, param_id, param_value, start_date, end_date', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'param_name' => 'Param Name',
			'param_id' => 'Param',
			'param_value' => 'Param Value',
			'start_date' => 'Start Date',
			'end_date' => 'End Date',
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

		$criteria->compare('param_name',$this->param_name,true);
		$criteria->compare('param_id',$this->param_id);
		$criteria->compare('param_value',$this->param_value,true);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('end_date',$this->end_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
}