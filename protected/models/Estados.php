<?php

/**
 * This is the model class for table "estados".
 *
 * The followings are the available columns in table 'estados':
 * @property integer $k_idEstado
 * @property string $n_nombreEstado
 * @property string $n_descEstado
 * @property integer $k_idProceso
 *
 * The followings are the available model relations:
 * @property Proceso $kIdProceso
 */
class Estados extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Estados the static model class
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
		return 'estados';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('n_nombreEstado', 'required'),
			array('k_idProceso', 'numerical', 'integerOnly'=>true),
			array('n_nombreEstado, n_descEstado', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('k_idEstado, n_nombreEstado, n_descEstado', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'k_idEstado' => 'K Id Estado',
			'n_nombreEstado' => 'N Nombre Estado',
			'n_descEstado' => 'N Desc Estado',
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

		$criteria->compare('k_idEstado',$this->k_idEstado);
		$criteria->compare('n_nombreEstado',$this->n_nombreEstado,true);
		$criteria->compare('n_descEstado',$this->n_descEstado,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}