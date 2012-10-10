<?php

/**
 * This is the model class for table "par_general_rec".
 *
 * The followings are the available columns in table 'par_general_rec':
 * @property string $param_name
 * @property integer $param_id
 * @property string $sub_param_name
 * @property integer $sub_param_id
 * @property string $param_value
 * @property string $start_date
 * @property string $end_date
 * @property integer $id
 * @property string $param_heb_name
 */
class ParGeneralRec extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ParGeneralRec the static model class
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
		return 'par_general_rec';
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
			array('param_id, sub_param_id', 'numerical', 'integerOnly'=>true),
			array('param_name, sub_param_name, param_value, param_heb_name', 'length', 'max'=>50),
			array('start_date, end_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('param_name, param_id, sub_param_name, sub_param_id, param_value, start_date, end_date, id, param_heb_name', 'safe', 'on'=>'search'),
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
			'sub_param_name' => 'Sub Param Name',
			'sub_param_id' => 'Sub Param',
			'param_value' => 'Param Value',
			'start_date' => 'Start Date',
			'end_date' => 'End Date',
			'id' => 'ID',
			'param_heb_name' => 'Param Heb Name',
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
		$criteria->compare('sub_param_name',$this->sub_param_name,true);
		$criteria->compare('sub_param_id',$this->sub_param_id);
		$criteria->compare('param_value',$this->param_value,true);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('end_date',$this->end_date,true);
		$criteria->compare('id',$this->id);
		$criteria->compare('param_heb_name',$this->param_heb_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}