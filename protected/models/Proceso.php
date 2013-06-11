<?php

/**
 * This is the model class for table "proceso".
 *
 * The followings are the available columns in table 'proceso':
 * @property integer $k_idProceso
 * @property integer $k_idCreador
 * @property integer $PaqueteMatenimiento_k_idPaquete
 *
 * The followings are the available model relations:
 * @property Estados[] $estadoses
 * @property Paquetematenimiento $paqueteMatenimientoKIdPaquete
 * @property CrugeUser $kIdCreador
 */
class Proceso extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Proceso the static model class
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
		return 'proceso';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('k_idCreador, PaqueteMatenimiento_k_idPaquete', 'required'),
			array('k_idCreador, PaqueteMatenimiento_k_idPaquete', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('k_idProceso, k_idCreador, PaqueteMatenimiento_k_idPaquete', 'safe', 'on'=>'search'),
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
			'estadoses' => array(self::HAS_MANY, 'Estados', 'k_idProceso'),
			'paqueteMatenimientoKIdPaquete' => array(self::BELONGS_TO, 'Paquetematenimiento', 'PaqueteMatenimiento_k_idPaquete'),
			'kIdCreador' => array(self::BELONGS_TO, 'CrugeUser', 'k_idCreador'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'k_idProceso' => 'K Id Proceso',
			'k_idCreador' => 'K Id Creador',
			'PaqueteMatenimiento_k_idPaquete' => 'Paquete Matenimiento K Id Paquete',
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
		$criteria->compare('k_idCreador',$this->k_idCreador);
		$criteria->compare('PaqueteMatenimiento_k_idPaquete',$this->PaqueteMatenimiento_k_idPaquete);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}