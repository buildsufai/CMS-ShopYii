<?php

/**
 * This is the model class for table "{{mod_promo_kits}}".
 *
 * The followings are the available columns in table '{{mod_promo_kits}}':
 * @property string $id
 * @property integer $percentage
 * @property integer $active
 * @property string $name
 * @property string $start
 * @property string $stop
 * @property string $description
 * @property string $slug
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keywords
 *
 * The followings are the available model relations:
 * @property Products[] $mlmshopProducts
 */
class PromoKit extends CActiveRecord
{

    // Статус активации
    const ACTIVE = "1";
    const NOT_ACTIVE = "0";

    const TIMERTYPE_TIMER = "0";
    const TIMERTYPE_DATE = "1";

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{mod_promo_kits}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('percentage, active, name, timertype, stop, description, products', 'required'),
			array('percentage, active, timertype', 'numerical', 'integerOnly'=>true),
			array('name, slug, meta_title, meta_description, meta_keywords', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('percentage, active, name, timertype, stop, description, slug, meta_title, meta_description, meta_keywords', 'safe', 'on'=>'search'),
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
			'products' => array(self::MANY_MANY, 'Product', '{{products_mod_promo_kits}}(promo_kit_id, products_id)'),
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
			'percentage' => 'Размер скидки',
			'active' => 'Поместить в каталог',
			'name' => 'Название',
			'timertype' => 'Тип таймера',
			'stop' => 'Дата окончания',
            'products' => 'Продукты',
			'description' => 'Описание',
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

		$criteria->compare('percentage',$this->percentage);
		$criteria->compare('active',$this->active);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('timertype',$this->timertype,true);
		$criteria->compare('stop',$this->stop,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('meta_title',$this->meta_title,true);
		$criteria->compare('meta_description',$this->meta_description,true);
		$criteria->compare('meta_keywords',$this->meta_keywords,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function beforeSave()
    {
        $array = array();

        if(count($items = $_POST[__CLASS__]['products']) > 0)
            foreach($items as $id)
                $array[] = $id;

        $this->products = $array;

        return parent::beforeSave();
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PromoKit the static model class
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

    public function getTimerType($id=null)
    {
        $arrayItems = array(
            self::TIMERTYPE_TIMER  => 'Таймер с обратным отсчетом',
            self::TIMERTYPE_DATE   => 'Дата окончания предложения',
        );
        return ($id==null)? $arrayItems : $arrayItems[$id];
    }

}
