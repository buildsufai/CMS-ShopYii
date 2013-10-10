<?php

/**
 * This is the model class for table "{{attributes_value}}".
 *
 * The followings are the available columns in table '{{attributes_value}}':
 * @property string $id
 * @property string $product_id
 * @property string $attribute_id
 * @property string $value
 *
 * The followings are the available model relations:
 * @property Products $product
 * @property Attributes $attribute
 */
class AttributeValue extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{attributes_value}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_id, attribute_id', 'required'),
			array('product_id, attribute_id', 'length', 'max'=>11),
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
            'attr' => array(self::BELONGS_TO, 'Attribute', 'attribute_id'),
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AttributesValue the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
