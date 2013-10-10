<?php

class DefaultController extends EController
{
    private $_model = "PromoKit";

	public function actionIndex()
	{
        $promoKits = array();
        $data = CActiveRecord::model($this->_model)->cache( Yii::app()->controller->module->duration, Yii::app()->controller->module->dependency )->active()->with('products','products.uploadMain')->findAll();

        if($data !== null){
            foreach($data as $n => $item)
            {
                $resultPrice = 0;
                foreach($item->products as $y => $product)
                {
                    $promoKits[$n]['products'][$y]['image'] = Upload::getUrl($product->uploadMain);
                    $promoKits[$n]['products'][$y]['url'] = $product->url;
                    $promoKits[$n]['products'][$y]['name'] = $product->name;
                    $resultPrice += $product->price;
                }

                // Рассчет суммарной стоимости товар в предложении с учетом валюты и скидки предложения
                $price = Currency::calculatePrice($resultPrice, $item->percentage);
                // Сумарная стоимость товаров в предложении с учетом только текущей валюты
                $full_price = Currency::calculatePrice($resultPrice);

                $promoKits[$n]['name'] = $item->name;
                $promoKits[$n]['slug'] = $item->slug;
                $promoKits[$n]['stop'] = $item->stop;
                $promoKits[$n]['timertype'] = $item->timertype;
                $promoKits[$n]['description'] = $item->description;
                $promoKits[$n]['price'] = Currency::formatingPrice($price);
                $promoKits[$n]['sale'] = $item->percentage;
                $promoKits[$n]['economy'] = Currency::formatingPrice($full_price - $price);
            }

            $this->pageTitle = ($model->meta_title)? $model->meta_title : $model->name;
            $this->meta_description = ($model->meta_description)? $model->meta_description : false;
            $this->meta_keywords = ($model->meta_keywords)? $model->meta_keywords : false;

        }


        $this->render('index',array(
            'promoKits' => $promoKits,
        ));
	}

}