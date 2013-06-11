<?php

/**
 * This is the model class for table "equipo".
 *
 * The followings are the available columns in table 'equipo':
 * @property integer $k_idEquipo
 * @property string $n_nombreEquipo
 * @property integer $k_idCliente
 * @property string $k_idEspecificacion
 *
 * The followings are the available model relations:
 * @property Cliente $kIdCliente
 * @property Especificacion $kIdEspecificacion
 * @property Paquetematenimiento[] $paquetematenimientos
 */
class Equipo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Equipo the static model class
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
		return 'equipo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('n_nombreEquipo, k_idCliente, k_idEspecificacion', 'required'),
			array('k_idCliente', 'numerical', 'integerOnly'=>true),
			array('n_nombreEquipo, k_idEspecificacion', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('k_idEquipo, n_nombreEquipo, k_idCliente, k_idEspecificacion', 'safe', 'on'=>'search'),
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
			'kIdCliente' => array(self::BELONGS_TO, 'Cliente', 'k_idCliente'),
			'kIdEspecificacion' => array(self::BELONGS_TO, 'Especificacion', 'k_idEspecificacion'),
			'paquetematenimientos' => array(self::HAS_MANY, 'Paquetematenimiento', 'k_idEquipo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'k_idEquipo' => 'K Id Equipo',
			'n_nombreEquipo' => 'N Nombre Equipo',
			'k_idCliente' => 'K Id Cliente',
			'k_idEspecificacion' => 'K Id Especificacion',
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

		$criteria->compare('k_idEquipo',$this->k_idEquipo);
		$criteria->compare('n_nombreEquipo',$this->n_nombreEquipo,true);
		$criteria->compare('k_idCliente',$this->k_idCliente);
		$criteria->compare('k_idEspecificacion',$this->k_idEspecificacion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}