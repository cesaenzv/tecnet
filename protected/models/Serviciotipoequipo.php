<?php

/**
 * This is the model class for table "serviciotipoequipo".
 *
 * The followings are the available columns in table 'serviciotipoequipo':
 * @property integer $k_idServicio
 * @property integer $k_idTipoEquipo
 */
class Serviciotipoequipo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Serviciotipoequipo the static model class
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
		return 'serviciotipoequipo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('k_idServicio, k_idTipoEquipo', 'required'),
			array('k_idServicio, k_idTipoEquipo', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('k_idServicio, k_idTipoEquipo', 'safe', 'on'=>'search'),
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
			'k_idServicio' => 'Servicio',
			'k_idTipoEquipo' => 'Tipo Equipo',
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

		$criteria->compare('k_idServicio',$this->k_idServicio);
		$criteria->compare('k_idTipoEquipo',$this->k_idTipoEquipo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}