<?php

/**
 * This is the model class for table "producto".
 *
 * The followings are the available columns in table 'producto':
 * @property integer $k_idProducto
 * @property string $n_nombreProducto
 * @property integer $v_costoProducto
 *
 * The followings are the available model relations:
 * @property Servicio[] $servicios
 */
class Producto extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Producto the static model class
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
		return 'producto';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('n_nombreProducto', 'unique'),
			array('n_nombreProducto, v_costoProducto', 'required'),
			array('v_costoProducto', 'numerical', 'integerOnly'=>true),
			array('n_nombreProducto', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('k_idProducto, n_nombreProducto, v_costoProducto', 'safe', 'on'=>'search'),
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
			'servicios' => array(self::MANY_MANY, 'Servicio', 'servicioproducto(k_producto, k_servicio)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'k_idProducto' => 'Id Producto',
			'n_nombreProducto' => 'Nombre Producto',
			'v_costoProducto' => 'Costo interno',
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

		$criteria->compare('k_idProducto',$this->k_idProducto);
		$criteria->compare('n_nombreProducto',$this->n_nombreProducto,true);
		$criteria->compare('v_costoProducto',$this->v_costoProducto);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}