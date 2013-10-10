<?php

/**
 * This is the model class for table "{{products}}".
 *
 * The followings are the available columns in table '{{products}}':
 * @property string $id
 * @property string $slug
 * @property string $name
 * @property string $description
 * @property integer $active
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property string $date_update
 */
class Product extends CActiveRecord
{
    const NO_ITEMS = "Пусто! Создайте товар";

    // Статус активации
    const ACTIVE = "1";
    const NOT_ACTIVE = "0";

    // Наличие товара
    const IN_STOCK = "1";
    const ENDED = "0";

    public $_brandName;
    public function getBrandName()
    {
        if ($this->_brandName === null && $this->brand !== null)
            $this->_brandName = CHtml::link($this->brand->name, array("/backend/brands/update","id"=>$this->brand->id));

        return $this->_brandName;
    }
    public function setBrandName($value)
    {
        $this->_brandName = $value;
    }


    public function getPriceNow()
    {
        $price = Currency::calculatePrice($this->price);
        return Currency::formatingPrice($price);
    }


    public function getPriceDefault()
    {
        return Currency::formatingPrice($this->price, true);
    }


	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{products}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('article, price, name, description, brand_id, attr_group_id, amount, categories', 'required'),
			array('active, brand_id, attr_group_id, amount', 'numerical', 'integerOnly'=>true),
            array('article', 'length', 'max'=>20),
			array('slug, name, meta_title, meta_description, meta_keywords', 'length', 'max'=>200),
            array('article,slug', 'unique'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('name, brandName, description, active, article', 'safe', 'on'=>'search'),
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
                'setUpdateOnCreate' => true,
            ),
            'CAdvancedArBehavior' => array(
                'class' => 'CAdvancedArBehavior'
            ),
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

            'brand' => array(self::BELONGS_TO, 'Brand', 'brand_id'),
            'categories' => array(self::MANY_MANY, 'Category', '{{category_and_product}}(product_id, category_id)'),
            'attrValue' => array(self::HAS_MANY, 'AttributeValue', 'product_id'),
            'featuredProducts' => array(self::MANY_MANY, 'Product', '{{products_featured}}(owner_id, product_id)'),
        );
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
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'slug' => 'URL Name',
            'article' => 'Артикул',
            'price' => 'Цена',
			'name' => 'Название',
            'brand_id' => 'Бренд товара',
            'categories' => 'Категории',
            'attr_group_id' => 'Группа атрибутов',
            'featuredProducts' => 'Рекомендуемые товары',
            'amount' => 'Количество на складе',
			'description' => 'Описание',
			'active' => 'Поместить в каталог',
			'meta_title' => 'Meta Title',
			'meta_description' => 'Meta Description',
			'meta_keywords' => 'Meta Keywords',
			'date_update' => 'Date Update',
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
        $criteria->with = array('brand');
        $criteria->together = true;

        $criteria->compare('t.article',$this->article,true);
        $criteria->compare('brand.name', $this->brandName, true);
		$criteria->compare('t.name', $this->name, true);
		$criteria->compare('t.active',$this->active);
        $criteria->compare('t.price',$this->price);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort'=>array(
                'defaultOrder'=>'article DESC',
                'attributes' => array(
                    'article',
                    'name',
                    'active',
                    'price',
                    'brandName' => array(
                        'asc'  => 'brand.name ASC',
                        'desc' => 'brand.name DESC',
                    )
                ),
            ),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Product the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getStatus($id=null)
    {
        $arrayItems = array(
            self::ACTIVE      => 'В каталоге',
            self::NOT_ACTIVE  => 'Черновик',
        );
        return ($id==null)? $arrayItems : $arrayItems[$id];
    }

    public function getAvailability($id=null)
    {
        $arrayItems = array(
            self::IN_STOCK  => 'Есть на складе',
            self::ENDED     => 'Закончился',
        );
        return ($id==null)? $arrayItems : $arrayItems[$id];
    }

    public  function getFeaturedProductsList()
    {
        $condition = (!$this->isNewRecord)? array('condition'=>'id!=:id', 'params'=>array(':id'=>$this->id)) : "";
        return self::model()->active()->findAll($condition);
    }

    public function getUrl()
    {
        return Yii::app()->createUrl('/product/view/', array('slug'=>$this->slug));
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
