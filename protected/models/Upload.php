<?php

/**
 * This is the model class for table "{{uploads}}".
 *
 * The followings are the available columns in table '{{uploads}}':
 * @property string $id
 * @property string $parent_id
 * @property string $parent_model
 * @property string $name
 * @property string $filename
 * @property integer $role
 * @property string $date_create
 *
 * The followings are the available model relations:
 * @property Products $product
 */
class Upload extends CActiveRecord
{
    public $dirName = "images";

    const TYPE_PRODUCT = "product";
    const TYPE_NEWS    = "news";
    const TYPE_PAGE    = "page";

    const ROLE_UNIQUE        = "unique";
    const ROLE_DUPLICATE     = "duplicate";
    const ROLE_MAINCATALOG   = "maincatalog";
    const ROLE_FILE          = "file";

    private $_parentName = null;
    public $fileObject = null;

    public function getParentName()
    {
        if ($this->_parentName === null)
        {
            if($this->parent_model == self::TYPE_PRODUCT && $this->product !== null)
            $this->_parentName = CHtml::link($this->product->name, array("/backend/products/update","id"=>$this->product->id));

            if($this->parent_model == self::TYPE_NEWS && $this->news !== null)
                $this->_parentName = CHtml::link($this->news->name, array("/news/backend/update","id"=>$this->news->id));

            if($this->parent_model == self::TYPE_PAGE && $this->page !== null)
                $this->_parentName = CHtml::link($this->page->name, array("/pages/backend/update","id"=>$this->page->id));
        }
        return $this->_parentName;
    }

    public function setParentName($value)
    {
        $this->_parentName = $value;
    }

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{uploads}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('role, parent_id, parent_model, name', 'required', 'on'=>'insert,update'),
            array('fileObject','file', 'types'=>'gif,png,jpg,doc,pdf', 'allowEmpty'=>false, 'on'=>'insert,update'),
            array('role', 'uniqueRoleOfPosition', 'message'=>'Изображение с выбраной ролью уже существует.'),
            array('parent_id', 'numerical', 'integerOnly'=>true),
            array('parent_id', 'length', 'max'=>11),
            array('parent_model', 'length', 'max'=>10),
            array('name, filename', 'length', 'max'=>50),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('parentName, parent_model, name, filename, role', 'safe', 'on'=>'search'),
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
			'product' => array(self::BELONGS_TO, 'Product', 'parent_id'),
            'news' => array(self::BELONGS_TO, 'News', 'parent_id'),
            'page' => array(self::BELONGS_TO, 'Page', 'parent_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
            'parentName' => 'Родитель',
            'parent_model' => 'Тип родителя',
            'name' => 'Имя ресурса',
            'filename' => 'Имя файла',
            'fileObject' => 'Файл',
            'role' => 'Роль',
            'date_create' => 'Дата создания',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;
        $criteria->with = array("product");

		$criteria->compare('product.name', $this->parentName,true);
		$criteria->compare('parent_model',$this->parent_model,true);
		$criteria->compare('t.name',$this->name,true);
		$criteria->compare('t.filename',$this->filename,true);
		$criteria->compare('t.role',$this->role);
		$criteria->compare('t.date_create',$this->date_create,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize' => Yii::app()->params['countOnPage'],
            ),
            'sort'=>array(
                'defaultOrder'=>'t.name DESC',
                'attributes' => array(
                    'name',
                    'parent_model',
                    'role',
                    'parentName' => array(
                        'asc'  => 'product.name ASC',
                        'desc' => 'product.name DESC',
                    )
                ),
            ),
        ));
	}

    public function getTypes($id = null)
    {
        $arrayItems = array(
            self::TYPE_PRODUCT => 'Продукт',
            self::TYPE_NEWS    => 'Новость',
            self::TYPE_PAGE    => 'Страница',
        );
        return ($id==null)? $arrayItems : $arrayItems[$id];
    }

    public function getRoles($id = null)
    {
        $arrayItems = array(
            self::ROLE_UNIQUE        => 'Главное изображение',
            self::ROLE_DUPLICATE     => 'Вторичное изображение',
            self::ROLE_MAINCATALOG   => 'Картинка в каталоге',
            self::ROLE_FILE          => 'Файл (документ)',
        );
        return ($id==null)? $arrayItems : $arrayItems[$id];
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Upload the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


    public function behaviors(){
        return array(
            // Обновляет даты создания и обновления
            'VTimestampBehavior' => array(
                'class' => 'application.components.behaviors.VTimestampBehavior',
                'createAttribute' => 'date_create',
                'updateAttribute' => 'date_create',
                'setUpdateOnCreate' => true,
            ),
        );
    }

    // Загружаем файл перед записью в базу
    protected function beforeSave()
    {
        if(!parent::beforeSave())
            return false;

        if(empty(Yii::app()->params['uploads']['images']))
            throw new CException("Parameter Yii::app()->params['uploads']['images'] is not set!");

        if(($this->scenario == 'insert' || $this->scenario == 'update') && ($this->fileObject = CUploadedFile::getInstance($this,'fileObject')))
        {
            $sourcePath = pathinfo($this->fileObject->getName());
            $unique = md5(uniqid(rand(),1));
            $this->filename = $unique .'.'. $sourcePath['extension'];
            $dirName = self::getDir($this);
            $this->fileObject->saveAs( Yii::getPathOfAlias('webroot.uploads').DIRECTORY_SEPARATOR.$dirName.DIRECTORY_SEPARATOR.$this->filename );
        }

        return true;
    }


    // Удаляем файл если удаляется модель
    protected function beforeDelete()
    {
        if(!parent::beforeDelete())
            return false;

        if(empty(Yii::app()->params['uploads']['images']))
            throw new CException("Parameter Yii::app()->params['uploads']['images'] is not set!");

        $dirName = self::getDir($this);

        $filePath = Yii::getPathOfAlias('webroot.uploads').DIRECTORY_SEPARATOR.$dirName.DIRECTORY_SEPARATOR.$this->filename;
        if(is_file($filePath))
            unlink($filePath);

        return true;
    }

    // Валидатор отсикает повторения у одного товара  уникальной картинки и главной картинки
    public function uniqueRoleOfPosition($attribute,$params=array())
    {
        if(!$this->hasErrors() && $this->role != self::ROLE_DUPLICATE && $this->role != self::ROLE_FILE )
        {
            $params['criteria'] = array(
                'condition'=> "`parent_id` = :parent_id and parent_model=:parent_model and `role` = :role",
                'params'=>array(':parent_id'=>$this->parent_id, ':parent_model'=>$this->parent_model, ':role'=>$this->role),
            );
            $validator = CValidator::createValidator('unique',$this,$attribute,$params);
            $validator->validate($this,array($attribute));
        }
    }

    private function getDir($model){
        if($model == null)
            throw new CException("Model is not set");

        return ($model->role == self::ROLE_FILE) ? Yii::app()->params['uploads']['files'] : Yii::app()->params['uploads']['images'];
    }

    public function getUrl($model)
    {
        if($model == null)
            return Yii::app()->params['empty']['image'];

        $dirName = self::getDir($model);
        return DIRECTORY_SEPARATOR."uploads".DIRECTORY_SEPARATOR.$dirName.DIRECTORY_SEPARATOR.$model->filename;
    }

}
