<?php

/**
 * This is the model class for table "procesoservicio".
 *
 * The followings are the available columns in table 'procesoservicio':
 * @property integer $k_idProceso
 * @property integer $k_idServicio
 * @property integer $q_estadoPago
 */
class Procesoservicio extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Procesoservicio the static model class
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
		return 'procesoservicio';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('k_idProceso, k_idServicio', 'required'),
			array('k_idProceso, k_idServicio, q_estadoPago', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('k_idProceso, k_idServicio, q_estadoPago', 'safe', 'on'=>'search'),
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
			'k_idProceso' => 'K Id Proceso',
			'k_idServicio' => 'K Id Servicio',
			'q_estadoPago' => 'Q Estado Pago',
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

		$criteria->compare('k_idProceso',$this->k_idProceso);
		$criteria->compare('k_idServicio',$this->k_idServicio);
		$criteria->compare('q_estadoPago',$this->q_estadoPago);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}