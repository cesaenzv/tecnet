<?php

/**
 * This is the model class for table "tipoequipo".
 *
 * The followings are the available columns in table 'tipoequipo':
 * @property integer $k_idTipo
 * @property string $n_tipoEquipo
 *
 * The followings are the available model relations:
 * @property Especificacion[] $especificacions
 * @property Servicio[] $servicios
 */
class Tipoequipo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Tipoequipo the static model class
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
		return 'tipoequipo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('n_tipoEquipo', 'required'),
			array('n_tipoEquipo', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('k_idTipo, n_tipoEquipo', 'safe', 'on'=>'search'),
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
			'especificacions' => array(self::HAS_MANY, 'Especificacion', 'k_idTipoEquipo'),
			'servicios' => array(self::MANY_MANY, 'Servicio', 'serviciotipoequipo(k_idTipoEquipo, k_idServicio)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'k_idTipo' => 'K Id Tipo',
			'n_tipoEquipo' => 'N Tipo Equipo',
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

		$criteria->compare('k_idTipo',$this->k_idTipo);
		$criteria->compare('n_tipoEquipo',$this->n_tipoEquipo,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}