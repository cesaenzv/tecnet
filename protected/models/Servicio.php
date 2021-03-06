<?php

/**
 * This is the model class for table "servicio".
 *
 * The followings are the available columns in table 'servicio':
 * @property integer $k_idServicio
 * @property string $n_nomServicio
 * @property integer $v_costoServicio
 * @property integer $v_costoServicioTecnico
 * @property string $n_tipoServicio
 *
 * The followings are the available model relations:
 * @property Proceso[] $procesos
 * @property Producto[] $productos
 * @property Tipoequipo[] $tipoequipos
 */
class Servicio extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Servicio the static model class
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
		return 'servicio';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('n_nomServicio, v_costoServicio, v_costoServicioTecnico, n_tipoServicio', 'required'),
			array('v_costoServicio, v_costoServicioTecnico', 'numerical', 'integerOnly'=>true),
			array('n_nomServicio', 'length', 'max'=>50),
			array('n_tipoServicio', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('k_idServicio, n_nomServicio, v_costoServicio, v_costoServicioTecnico, n_tipoServicio', 'safe', 'on'=>'search'),
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
			'procesos' => array(self::MANY_MANY, 'Proceso', 'procesoservicio(k_idServicio, k_idProceso)'),
			'productos' => array(self::MANY_MANY, 'Producto', 'servicioproducto(k_servicio, k_producto)'),
			'tipoequipos' => array(self::MANY_MANY, 'Tipoequipo', 'serviciotipoequipo(k_idServicio, k_idTipoEquipo)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'k_idServicio' => 'K Id Servicio',
			'n_nomServicio' => 'N Nom Servicio',
			'v_costoServicio' => 'V Costo Servicio',
			'v_costoServicioTecnico' => 'V Costo Servicio Tecnico',
			'n_tipoServicio' => 'N Tipo Servicio',
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
		$criteria->compare('n_nomServicio',$this->n_nomServicio,true);
		$criteria->compare('v_costoServicio',$this->v_costoServicio);
		$criteria->compare('v_costoServicioTecnico',$this->v_costoServicioTecnico);
		$criteria->compare('n_tipoServicio',$this->n_tipoServicio,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}