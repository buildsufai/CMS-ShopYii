<?php

class CategoryController extends EController
{
    private $_model = "Category";

    public $defaultAction = "view";

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($slug)
    {
        $model = $this->loadModelBySlug($this->_model, $slug);

        $this->pageTitle = ($model->meta_title)? $model->meta_title : $model->name;
        $this->meta_description = ($model->meta_description)? $model->meta_description : false;
        $this->meta_keywords = ($model->meta_keywords)? $model->meta_keywords : false;

        Yii::app()->session['bc_catName'] = $model->name;
        Yii::app()->session['bc_catSlug'] = $model->slug;

        $products = array();
        foreach($model->products as $n=>$product)
        {
            $products[$n]['name'] = $product->name;
            $products[$n]['price'] = $product->priceNow;
            $products[$n]['url'] = $product->url;
            $products[$n]['imageUrl'] = Upload::getUrl($product->uploadCatalog);
        }

        $this->render('view', array(
            'model' => $model,
            'products' => $products
        ));
    }


}