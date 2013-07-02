<?php

/**
 * This is the model class for table "paquetematenimiento".
 *
 * The followings are the available columns in table 'paquetematenimiento':
 * @property integer $k_idPaquete
 * @property integer $k_idOrden
 * @property integer $k_idProceso
 * @property integer $k_idEquipo
 *
 * The followings are the available model relations:
 * @property Proceso $kIdProceso
 * @property Orden $kIdOrden
 * @property Equipo $kIdEquipo
 */
class Paquetematenimiento extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Paquetematenimiento the static model class
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
		return 'paquetematenimiento';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('k_idOrden, k_idProceso, k_idEquipo', 'required'),
			array('k_idOrden, k_idProceso, k_idEquipo', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('k_idPaquete, k_idOrden, k_idProceso, k_idEquipo', 'safe', 'on'=>'search'),
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
			'kIdProceso' => array(self::BELONGS_TO, 'Proceso', 'k_idProceso'),
			'kIdOrden' => array(self::BELONGS_TO, 'Orden', 'k_idOrden'),
			'kIdEquipo' => array(self::BELONGS_TO, 'Equipo', 'k_idEquipo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'k_idPaquete' => 'K Id Paquete',
			'k_idOrden' => 'K Id Orden',
			'k_idProceso' => 'K Id Proceso',
			'k_idEquipo' => 'K Id Equipo',
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

		$criteria->compare('k_idPaquete',$this->k_idPaquete);
		$criteria->compare('k_idOrden',$this->k_idOrden);
		$criteria->compare('k_idProceso',$this->k_idProceso);
		$criteria->compare('k_idEquipo',$this->k_idEquipo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}