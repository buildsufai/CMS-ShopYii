<?php

class DefaultController extends EController
{
	public function actionIndex()
	{
        $newsID = Yii::app()->config->get("mainpage_news");
        $popularProductsList = explode(";", Yii::app()->config->get("mainpage_popular_products"));
        $newProductsList = explode(";", Yii::app()->config->get("mainpage_new_products"));

        $news_model = News::model()->active()->findByPk($newsID);
        $news_model->uploadMain = Upload::getUrl($news_model->uploadMain);

        $popularProducts = array();
        foreach($popularProductsList as $n =>$PopProdID)
        {
            $product = Product::model()->with('uploadCatalog')->findByPk($PopProdID);
            $popularProducts[$n]['name'] = $product->name;
            $popularProducts[$n]['price'] = $product->priceNow;
            $popularProducts[$n]['url'] = $product->url;
            $popularProducts[$n]['imageUrl'] = Upload::getUrl($product->uploadCatalog);
        }

        $newProducts = array();
        foreach($newProductsList as $n => $newProdID)
        {
            $product = Product::model()->with('uploadCatalog')->findByPk($newProdID);
            $newProducts[$n]['name'] = $product->name;
            $newProducts[$n]['price'] = $product->priceNow;
            $newProducts[$n]['url'] = $product->url;
            $newProducts[$n]['imageUrl'] = Upload::getUrl($product->uploadCatalog);
        }

		$this->render('index', array(
            'popularProducts' => $popularProducts,
            'newProducts' => $newProducts,
            'news' => $news_model,
        ));
	}
}