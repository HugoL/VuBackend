<?php

/**
 * This is the model class for table "{{talleres}}".
 *
 * The followings are the available columns in table '{{talleres}}':
 * @property integer $id
 * @property string $nombre
 * @property string $observaciones
 * @property string $jornada
 * @property double $precio
 * @property string $abreviacion
 * @property string $precio_detalle
 *
 * The followings are the available model relations:
 * @property InscritosTalleres[] $inscritosTalleres
 */
class Taller extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Taller the static model class
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
		return '{{talleres}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre, jornada, precio, abreviacion', 'required'),
			array('precio', 'numerical'),
			array('nombre', 'length', 'max'=>256),
			array('observaciones', 'length', 'max'=>512),
			array('jornada, precio_detalle', 'length', 'max'=>128),
			array('abreviacion', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, nombre, observaciones, jornada, precio, abreviacion, precio_detalle', 'safe', 'on'=>'search'),
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
			'inscritoTaller' => array(self::HAS_MANY, 'InscritoTaller', 'id_taller'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombre' => 'Nombre',
			'observaciones' => 'Observaciones',
			'jornada' => 'Jornada',
			'precio' => 'Precio',
			'abreviacion' => 'Identificador',
			'precio_detalle' => 'Precio Detalle',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('observaciones',$this->observaciones,true);
		$criteria->compare('jornada',$this->jornada,true);
		$criteria->compare('precio',$this->precio);
		$criteria->compare('abreviacion',$this->abreviacion,true);
		$criteria->compare('precio_detalle',$this->precio_detalle,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}