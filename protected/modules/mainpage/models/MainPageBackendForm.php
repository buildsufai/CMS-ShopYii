<?php
class MainPageBackendForm extends CFormModel
{
    public $news;
    public $popular_products;
	public $new_products;

    public function rules()
    {
        return array(
            array('news, popular_products, new_products', 'required'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'news' => 'Новость',
            'popular_products' => 'Популярные',
            'new_products' => 'Новые',
        );
    }
}
?>