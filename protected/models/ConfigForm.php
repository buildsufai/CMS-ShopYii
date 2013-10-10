<?php
class ConfigForm extends CFormModel
{
    public $meta_keywords;
    public $meta_description;
	public $meta_title;

    public function rules()
    {
        return array(
            array('meta_keywords, meta_description, meta_title', 'required'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'meta_keywords' => 'Meta Keywords',
            'meta_description' => 'Meta Description',
            'meta_title' => 'Meta Title',
        );
    }

}
?>