<?php

/**
 * This is the model class for table "cliente".
 *
 * The followings are the available columns in table 'cliente':
 * @property integer $k_identificacion
 * @property string $i_nit
 * @property string $n_nombre
 * @property string $n_apellido
 * @property string $o_direccion
 * @property string $o_celular
 * @property string $o_fijo
 * @property string $o_mail
 * @property integer $k_usuarioCrea
 *
 * The followings are the available model relations:
 * @property Users $kUsuarioCrea
 * @property Equipo[] $equipos
 */
class Cliente extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Cliente the static model class
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
		return 'cliente';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('k_identificacion, i_nit, n_nombre, n_apellido, o_celular, o_fijo, k_usuarioCrea', 'required'),
			array('k_identificacion, k_usuarioCrea', 'numerical', 'integerOnly'=>true),
			array('i_nit', 'length', 'max'=>2),
			array('k_identificacion', 'unique'),
			array('n_nombre, n_apellido, o_direccion, o_mail', 'length', 'max'=>50),
			array('o_celular, o_fijo', 'length', 'max'=>15),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('k_identificacion, i_nit, n_nombre, n_apellido, o_direccion, o_celular, o_fijo, o_mail, k_usuarioCrea', 'safe', 'on'=>'search'),
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
			'kUsuarioCrea' => array(self::BELONGS_TO, 'Users', 'k_usuarioCrea'),
			'equipos' => array(self::HAS_MANY, 'Equipo', 'k_idCliente'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'k_identificacion' => 'Identificacion',
			'i_nit' => 'Nit',
			'n_nombre' => 'Nombre',
			'n_apellido' => 'Apellido',
			'o_direccion' => 'Direccion',
			'o_celular' => 'Celular',
			'o_fijo' => 'Fijo',
			'o_mail' => 'Mail',
			'k_usuarioCrea' => 'K Usuario Crea',
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

		$criteria->compare('k_identificacion',$this->k_identificacion);
		$criteria->compare('i_nit',$this->i_nit,true);
		$criteria->compare('n_nombre',$this->n_nombre,true);
		$criteria->compare('n_apellido',$this->n_apellido,true);
		$criteria->compare('o_direccion',$this->o_direccion,true);
		$criteria->compare('o_celular',$this->o_celular,true);
		$criteria->compare('o_fijo',$this->o_fijo,true);
		$criteria->compare('o_mail',$this->o_mail,true);
		$criteria->compare('k_usuarioCrea',$this->k_usuarioCrea);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}