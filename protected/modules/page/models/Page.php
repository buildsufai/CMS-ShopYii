<?php

/**
 * This is the model class for table "{{pages}}".
 *
 * The followings are the available columns in table '{{pages}}':
 * @property string $id
 * @property string $slug
 * @property string $title
 * @property string $meta_description
 * @property string $meta_keywords
 * @property string $content
 * @property integer $active
 */
class Page extends CActiveRecord
{

    const NO_ITEMS = "Пусто! Создайте страницу";

    // Статус активации
    const ACTIVE = "1";
    const NOT_ACTIVE = "0";

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{mod_pages}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, content', 'required'),
			array('active', 'numerical', 'integerOnly'=>true),
			array('id', 'length', 'max'=>10),
			array('slug, name, meta_title, meta_description, meta_keywords', 'length', 'max'=>200),
			array('meta_title, meta_description, meta_keywords', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('name, content', 'safe', 'on'=>'search'),
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
			'active' => 'Url Name',
			'name' => 'Название',
            'slug' => 'Url Name',
            'meta_title' => 'Meta Title',
			'meta_description' => 'Meta Description',
			'meta_keywords' => 'Meta Keywords',
			'content' => 'Содержание',
            'active' => 'Опубликовано',
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
		$criteria->compare('active',$this->active,true);

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
	 * @return Page the static model class
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
}
