<?php

/**
 * This is the model class for table "{{inscritos}}".
 *
 * The followings are the available columns in table '{{inscritos}}':
 * @property integer $id
 * @property string $nombre
 * @property string $apellido1
 * @property string $apellido2
 * @property string $email
 * @property string $nif
 * @property string $nacionalidad
 * @property string $direccion
 * @property string $cp
 * @property string $localidad
 * @property string $provincia
 * @property string $telefono
 * @property integer $sexo
 * @property string $pais
 * @property string $cargo
 * @property string $razonSocial
 * @property string $nifEmpresa
 * @property string $direccionEmpresa
 * @property string $titulacion
 * @property string $edicion
 * @property string $observaciones
 * @property string $observaciones2
 * @property string $fecha
 * @property integer $pagado
 * @property integer $talleres
 * @property string $coursesites
 * @property integer $id_rol
 *
 * The followings are the available model relations:
 * @property Rol $idRol
 * @property InscritosComunicaciones[] $inscritosComunicaciones
 * @property InscritosTalleres[] $inscritosTalleres
 * @property Pagos[] $pagoses
 */
class Inscrito extends CActiveRecord
{
	public $total;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Inscrito the static model class
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
		return '{{inscritos}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre, apellido1, apellido2, email, nif, nacionalidad, direccion, sexo, pais, edicion, fecha, id_rol', 'required'),
			array('sexo, pagado, talleres, id_rol, total, certificado', 'numerical', 'integerOnly'=>true),
			array('nombre, apellido1, apellido2, nif, nacionalidad, cp, localidad, provincia, telefono, pais, nifEmpresa, edicion', 'length', 'max'=>128),
			array('email, direccion, cargo, razonSocial, direccionEmpresa, titulacion, coursesites', 'length', 'max'=>256),
			array('observaciones, observaciones2', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, nombre, apellido1, apellido2, email, nif, nacionalidad, direccion, cp, localidad, provincia, telefono, sexo, pais, cargo, razonSocial, nifEmpresa, direccionEmpresa, titulacion, edicion, observaciones, observaciones2, fecha, pagado, talleres, coursesites, id_rol', 'safe', 'on'=>'search'),
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
			'rol' => array(self::BELONGS_TO, 'Rol', 'id_rol'),
			'inscritoComunicacion' => array(self::HAS_MANY, 'InscritoComunicacion', 'id_usuario'),
			'inscritoTaller' => array(self::HAS_MANY, 'InscritoTaller', 'id_usuario'),
			'pago' => array(self::HAS_MANY, 'Pago', 'id_usuario'),
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
			'apellido1' => 'Apellido1',
			'apellido2' => 'Apellido2',
			'email' => 'Email',
			'nif' => 'Nif',
			'nacionalidad' => 'Nacionalidad',
			'direccion' => 'Dirección',
			'cp' => 'Código Postal',
			'localidad' => 'Localidad',
			'provincia' => 'Provincia',
			'telefono' => 'Teléfono',
			'sexo' => 'Sexo',
			'pais' => 'País',
			'cargo' => 'Cargo',
			'razonSocial' => 'Razón Social',
			'nifEmpresa' => 'Nif Empresa',
			'direccionEmpresa' => 'Dirección Empresa',
			'titulacion' => 'Titulación',
			'edicion' => 'Edición',
			'observaciones' => 'Observaciones',
			'observaciones2' => 'Observaciones2',
			'fecha' => 'Fecha',
			'pagado' => 'Pagado',
			'talleres' => 'Talleres',
			'coursesites' => 'Coursesites',
			'id_rol' => 'Rol',
			'certificado' => 'certificado',
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
		$criteria->compare('apellido1',$this->apellido1,true);
		$criteria->compare('apellido2',$this->apellido2,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('nif',$this->nif,true);
		$criteria->compare('nacionalidad',$this->nacionalidad,true);
		$criteria->compare('direccion',$this->direccion,true);
		$criteria->compare('cp',$this->cp,true);
		$criteria->compare('localidad',$this->localidad,true);
		$criteria->compare('provincia',$this->provincia,true);
		$criteria->compare('telefono',$this->telefono,true);
		$criteria->compare('sexo',$this->sexo);
		$criteria->compare('pais',$this->pais,true);
		$criteria->compare('cargo',$this->cargo,true);
		$criteria->compare('razonSocial',$this->razonSocial,true);
		$criteria->compare('nifEmpresa',$this->nifEmpresa,true);
		$criteria->compare('direccionEmpresa',$this->direccionEmpresa,true);
		$criteria->compare('titulacion',$this->titulacion,true);
		$criteria->compare('edicion',$this->edicion,true);
		$criteria->compare('observaciones',$this->observaciones,true);
		$criteria->compare('observaciones2',$this->observaciones2,true);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('pagado',$this->pagado);
		$criteria->compare('talleres',$this->talleres);
		$criteria->compare('coursesites',$this->coursesites,true);
		$criteria->compare('id_rol',$this->id_rol);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public static function inscritoAutoComplete($name='') {
 
        // Recommended: Secure Way to Write SQL in Yii 
    $sql= "SELECT id , CONCAT(nombre,' ',apellido1,' - ',email) as label FROM ".Inscrito::model()->tableSchema->name." WHERE nombre LIKE :name OR 'apellido1' LIKE :name OR 'apellido2' LIKE :name OR email LIKE :name";
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