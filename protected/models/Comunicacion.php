<?php

/**
 * This is the model class for table "{{comunicaciones}}".
 *
 * The followings are the available columns in table '{{comunicaciones}}':
 * @property integer $id
 * @property string $identificador
 * @property string $titulo
 * @property string $autores
 * @property string $fecha
 * @property string $observaciones
 * @property string $url
 * @property integer $tipo
 * @property integer $revisado
 * @property integer $aprobado
 * @property integer $id_area
 *
 * The followings are the available model relations:
 * @property Areas $idArea
 * @property InscritosComunicaciones[] $inscritosComunicaciones
 */
class Comunicacion extends CActiveRecord
{
	public $total;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Comunicacion the static model class
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
		return '{{comunicaciones}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('titulo, tipo, id_area', 'required'),
			array('tipo, revisado, aprobado, id_area, total', 'numerical', 'integerOnly'=>true),
			array('identificador, edicion', 'length', 'max'=>128),
			array('titulo', 'length', 'max'=>256),
			array('url', 'length', 'max'=>512),
			array('autores, observaciones', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, identificador, titulo, autores, fecha, observaciones, url, tipo, revisado, aprobado, id_area', 'safe', 'on'=>'search'),
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
			'area' => array(self::BELONGS_TO, 'Area', 'id_area'),
			'inscritoComunicacion' => array(self::HAS_MANY, 'InscritoComunicacion', 'id_comunicacion'),
			'revisadopor' => array(self::BELONGS_TO,'User', 'revisado'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'identificador' => 'Identificador',
			'titulo' => 'Titulo',
			'autores' => 'Autores',
			'fecha' => 'Fecha',
			'observaciones' => 'Observaciones',
			'url' => 'Url',
			'tipo' => 'Tipo',
			'revisado' => 'Revisado',
			'aprobado' => 'Aprobado',
			'id_area' => 'Id Area',
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
		$criteria->compare('identificador',$this->identificador,true);
		$criteria->compare('titulo',$this->titulo,true);
		$criteria->compare('autores',$this->autores,true);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('observaciones',$this->observaciones,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('tipo',$this->tipo);
		$criteria->compare('revisado',$this->revisado);
		$criteria->compare('aprobado',$this->aprobado);
		$criteria->compare('id_area',$this->id_area);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	// Important: The Method below must return each record with id, label keys. See how i've wrote the query "title AS label" below.
 
/* Result should be in this format
  array(
    'id'=>4,
    'label'=>'John',
  ),
  array(
    'id'=>3,
    'label'=>'Grace',
  ),
  array(
    'id'=>5,
    'label'=>'Matt',
  ),
 
*/
    public static function comunicacionAutoComplete($name='') {
 
        // Recommended: Secure Way to Write SQL in Yii 
    $sql= "SELECT id , CONCAT(identificador,' ',titulo) as label FROM ".Comunicacion::model()->tableSchema->name." WHERE titulo LIKE :name OR identificador LIKE :name";
        $name = $name.'%';                
        return Yii::app()->db->createCommand($sql)->queryAll(true,array(':name'=>$name));
 
        // Not Recommended: Simple Way for those who can't understand the above way.
    // Uncomment the below and comment out above 3 lines 
    /*
    $sql= "SELECT id ,title AS label FROM users WHERE title LIKE '$name%'";
        return Yii::app()->db->createCommand($sql)->queryAll();
    */
 
    }
}