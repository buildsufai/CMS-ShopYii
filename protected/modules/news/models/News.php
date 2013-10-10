<?php

/**
 * This is the model class for table "{{news}}".
 *
 * The followings are the available columns in table '{{news}}':
 * @property integer $id
 * @property string $slug
 * @property string $name
 * @property string $content_short
 * @property string $content_full
 * @property integer $active
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property string $date_create
 * @property string $date_update
 */
class News extends CActiveRecord
{

    const NO_ITEMS = "Пусто! Создайте новость";

    // Статус активации
    const ACTIVE = "1";
    const NOT_ACTIVE = "0";

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{mod_news}}';
	}

    public function scopes()
    {
        return array(
            'active'=>array(
                'condition'=>'t.active=1',
            )
        );
    }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, content_short, content_full', 'required'),
			array('id, active', 'numerical', 'integerOnly'=>true),
			array('slug, name, meta_title, meta_description, meta_keywords', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('name, content_short, content_full, active', 'safe', 'on'=>'search'),
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
            'uploads' => array(self::HAS_MANY, 'Upload', 'parent_id', 'condition'=>'uploads.parent_model=:parent_model', 'params'=>array(':parent_model' => mb_strtolower(__CLASS__))),
            'uploadDuplicate' => array(self::HAS_MANY, 'Upload', 'parent_id', 'condition'=>'uploadDuplicate.role=:role and uploadDuplicate.parent_model=:parent_model', 'params'=>array(':role' => Upload::ROLE_DUPLICATE, ':parent_model' => mb_strtolower(__CLASS__))),
            'uploadMain' => array(self::HAS_ONE, 'Upload', 'parent_id', 'condition'=>'uploadMain.role=:role and uploadMain.parent_model=:parent_model', 'params'=>array(':role' => Upload::ROLE_UNIQUE, ':parent_model' => mb_strtolower(__CLASS__))),
            'uploadCatalog' => array(self::HAS_ONE, 'Upload', 'parent_id', 'condition'=>'uploadCatalog.role=:role and uploadCatalog.parent_model=:parent_model', 'params'=>array(':role' => Upload::ROLE_MAINCATALOG, ':parent_model' => mb_strtolower(__CLASS__))),
            'uploadFile' => array(self::HAS_ONE, 'Upload', 'parent_id', 'condition'=>'uploadFile.role=:role and uploadFile.parent_model=:parent_model', 'params'=>array(':role' => Upload::ROLE_FILE, ':parent_model' => mb_strtolower(__CLASS__))),
        );
    }

    public function behaviors(){
        return array(
            // Генерирует URL из имени
            'SlugBehavior' => array(
                'class' => 'application.components.behaviors.SlugBehavior',
                'sourceAttribute' => 'name',
                'slugAttribute' => 'slug',
            ),
            // Обновляет даты создания и обновления
            'VTimestampBehavior' => array(
                'class' => 'application.components.behaviors.VTimestampBehavior',
                'createAttribute' => 'date_create',
                'updateAttribute' => 'date_update',
            ),
        );
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'slug' => 'Url Name',
			'name' => 'Название',
			'content_short' => 'Краткое описание',
			'content_full' => 'Основной текст',
			'active' => 'Опубликовано',
			'meta_title' => 'Meta Title',
			'meta_description' => 'Meta Description',
			'meta_keywords' => 'Meta Keywords',
			'date_create' => 'Создано',
			'date_update' => 'Изменено',
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
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('name',$this->name,true);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize' => Yii::app()->params['countOnPage'],
            ),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return News the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getStatus($id=null)
    {
        $arrayItems = array(
            self::ACTIVE      => 'Опубликована',
            self::NOT_ACTIVE  => 'Черновик',
        );
        return ($id==null)? $arrayItems : $arrayItems[$id];
    }

    public function getItems()
    {
        $items = CHtml::listData(self::model()->active()->findAll(), 'id', 'name');
        if(count($items) > 0){
            return $items;
        }else
            return array('no_items' => self::NO_ITEMS);
    }

    public function beforeDelete()
    {
        try
        {
            Upload::model()->deleteAll("parent_id=:parent_id and parent_model=:parent_model", array('parent_id'=>$this->id, 'parent_model' => mb_strtolower(__CLASS__)));
            return parent::beforeDelete();
        }
        catch(Exception $ex)
        {
            $this->addError('error_delete_uploads', "Упс, что-то пошло не так=( Дополнительно: ". $e);
            return false;
        }
    }
}
