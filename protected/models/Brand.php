<?php

/**
 * This is the model class for table "{{brands}}".
 *
 * The followings are the available columns in table '{{brands}}':
 * @property string $id
 * @property string $name
 * @property string $slug
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 *
 * The followings are the available model relations:
 * @property Products[] $products
 */
class Brand extends CActiveRecord
{

    const NO_ITEMS = "Пусто! Создайте бредн";

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{brands}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('name, slug, meta_title, meta_description, meta_keywords', 'length', 'max'=>200),
            array('slug', 'unique'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('name, slug', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'products' => array(self::HAS_MANY, 'Product', 'brand_id', 'condition'=>'products.active=1'),
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
        );
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Имя',
			'slug' => 'URL Name',
			'meta_title' => 'Meta Title',
			'meta_description' => 'Meta Description',
			'meta_keywords' => 'Meta Keywords',
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
	 * @return Brand the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getItems()
    {
        $items = CHtml::listData(self::model()->findAll(), 'id', 'name');
        if(count($items) > 0){
            return $items;
        }else
            return array('no_items' => self::NO_ITEMS);
    }

    public function getUrl()
    {
        return Yii::app()->createUrl('/brand/view/', array('slug'=>$this->slug));
    }
}
