<?php

/**
 * This is the model class for table "especificacion".
 *
 * The followings are the available columns in table 'especificacion':
 * @property string $k_especificacion
 * @property string $n_nombreEspecificacion
 * @property integer $k_idTipoEquipo
 * @property integer $k_idMarca
 *
 * The followings are the available model relations:
 * @property Equipo[] $equipos
 * @property Marca $kIdMarca
 * @property Tipoequipo $kIdTipoEquipo
 */
class Especificacion extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Especificacion the static model class
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
		return 'especificacion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('k_especificacion, k_idTipoEquipo, k_idMarca', 'required'),
			array('k_idTipoEquipo, k_idMarca', 'numerical', 'integerOnly'=>true),
			array('k_especificacion, n_nombreEspecificacion', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('k_especificacion, n_nombreEspecificacion, k_idTipoEquipo, k_idMarca', 'safe', 'on'=>'search'),
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
			'equipos' => array(self::HAS_MANY, 'Equipo', 'k_idEspecificacion'),
			'kIdMarca' => array(self::BELONGS_TO, 'Marca', 'k_idMarca'),
			'kIdTipoEquipo' => array(self::BELONGS_TO, 'Tipoequipo', 'k_idTipoEquipo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'k_especificacion' => 'Especificacion',
			'n_nombreEspecificacion' => 'Nombre Especificacion',
			'k_idTipoEquipo' => 'Tipo Equipo',
			'k_idMarca' => 'Marca',
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

		$criteria->compare('k_especificacion',$this->k_especificacion,true);
		$criteria->compare('n_nombreEspecificacion',$this->n_nombreEspecificacion,true);
		$criteria->compare('k_idTipoEquipo',$this->k_idTipoEquipo);
		$criteria->compare('k_idMarca',$this->k_idMarca);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}