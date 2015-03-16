<?php

/**
 * This is the model class for table "{{pagos}}".
 *
 * The followings are the available columns in table '{{pagos}}':
 * @property integer $id
 * @property integer $id_usuario
 * @property string $cantidad_pagar
 *
 * The followings are the available model relations:
 * @property Inscritos $idUsuario
 */
class Pago extends CActiveRecord
{
	public $total;
	public $pagado;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Pago the static model class
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
		return '{{pagos}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_usuario, cantidad_pagar', 'required'),
			array('id_usuario, total, pagado', 'numerical', 'integerOnly'=>true),
			array('cantidad_pagar', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_usuario, cantidad_pagar', 'safe', 'on'=>'search'),
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
			'usuario' => array(self::BELONGS_TO, 'Inscrito', 'id_usuario'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_usuario' => 'Id Usuario',
			'cantidad_pagar' => 'Cantidad Pagar',
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
		$criteria->compare('id_usuario',$this->id_usuario);
		$criteria->compare('cantidad_pagar',$this->cantidad_pagar,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}