<?php

/**
 * This is the model class for table "{{attributes_groups}}".
 *
 * The followings are the available columns in table '{{attributes_groups}}':
 * @property string $id
 * @property string $name
 *
 * The followings are the available model relations:
 * @property Attributes[] $mlmshopAttributes
 * @property Products[] $products
 */
class AttributeGroup extends CActiveRecord
{

    const NO_ITEMS = "Пусто! Создайте группу атрибутов";

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{attributes_groups}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, listAttributes', 'required'),
			array('name', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('name', 'safe', 'on'=>'search'),
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
			'listAttributes' => array(self::MANY_MANY, 'Attribute', '{{attributes_groups_and_attributes}}(attribute_group_id, attribute_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'name' => 'Название',
            'listAttributes' => 'Атрибуты',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize' => Yii::app()->params['countOnPage'],
            ),
		));
	}

    public function behaviors(){
        return array(
            'CAdvancedArBehavior' => array(
                'class' => 'CAdvancedArBehavior'
            )
        );
    }

    public function beforeSave()
    {
        $array = array();

        if(count($items = $_POST[__CLASS__]['listAttributes']) > 0)
            foreach($items as $id)
                $array[] = $id;

        $this->listAttributes = $array;

        return parent::beforeSave();
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AttributeGroup the static model class
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
}
