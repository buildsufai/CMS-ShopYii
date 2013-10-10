<?php

/**
 * This is the model class for table "{{attributes}}".
 *
 * The followings are the available columns in table '{{attributes}}':
 * @property string $id
 * @property string $name
 * @property string $type
 *
 * The followings are the available model relations:
 * @property AttributesValue[] $attributesValues
 */
class Attribute extends CActiveRecord
{

    const NO_ITEMS = "Пусто! Создайте атрибут";

    const TYPEF_SINGLELINE = "input";
    const TYPEF_MULTILINE = "textarea";
    const TYPEF_CHECKBOX = "checkbox";

    const TYPEA_MAINLIST = "mainlist";
    const TYPEA_SINGLE = "single";

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{attributes}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, type_field, type_attr', 'required'),
			array('name', 'length', 'max'=>200),
			array('type_field, type_attr', 'length', 'max'=>10),
            array('slug', 'unique'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('name, type_field, type_attr', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'name' => 'Имя',
			'type_field' => 'Тип поля',
            'type_attr'  => 'Тип атрибута',
		);
	}


    public function behaviors(){
        return array(
            // Генерирует URL из имени
            'SlugBehavior' => array(
                'class' => 'application.components.behaviors.SlugBehavior',
                'sourceAttribute' => 'name',
                'slugAttribute' => 'slug',
                'alwaysConvert' => true,
            )
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
		$criteria->compare('type_field',$this->type_field,true);
        $criteria->compare('type_attr',$this->type_attr,true);

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
	 * @return Attribute the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getFieldTypes($id = null)
    {
        $arrayItems = array(
            self::TYPEF_SINGLELINE => 'Одностроковое поле (input)',
            self::TYPEF_MULTILINE  => 'Многостроковое поле (textarea)',
            self::TYPEF_CHECKBOX   => 'Галочка (checkbox)',
        );
        return ($id==null)? $arrayItems : $arrayItems[$id];
    }

    public function getAttrTypes($id = null)
    {
        $arrayItems = array(
            self::TYPEA_MAINLIST => 'Состоит в главном списке',
            self::TYPEA_SINGLE  => 'Самостоятельный атрибут',
        );
        return ($id==null)? $arrayItems : $arrayItems[$id];
    }

    public function getItems()
    {
        $items = CHtml::listData(self::model()->findAll(), 'id', 'name');
        if(count($items) > 0){
            return $items;
        }else
            return array('no_items' => self::NO_ITEMS);
    }

}
