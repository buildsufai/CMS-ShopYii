<?php
/**
 * This is the model class for table "{{config}}".
 *
 * The followings are the available columns in table '{{config}}':
 * @property string $id
 * @property string $param
 * @property string $value
 * @property string $default
 * @property string $label
 * @property string $type
 */
class Config extends CActiveRecord
{

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
 
    public function tableName()
    {
        return '{{configs}}';
    }
 
    public function rules()
    {
        return array(
            array('value', 'safe'),
            array('param, value, label, type, default', 'safe', 'on'=>'search'),
        );
    }

}