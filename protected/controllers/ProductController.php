<?php

class ProductController extends EController
{
    private $_model = "Product";

    public $defaultAction = "view";

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($slug)
    {
        $model = $this->loadModelBySlug($this->_model, $slug);

        // Даем доступ к черновикам только для админов и модеров
        if( !$model->active && (!Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('moder')) )
            throw new CHttpException(404, 'У вас не достаточно прав для просмотра этой записи');

        $attributesMain = array();
        $attributes = array();
        foreach ($model->attrValue as $n=>$item)
        {
            if($item->value && $item->attr->type_attr == Attribute::TYPEA_MAINLIST)
            {
                $attributesMain[$n]['name'] = $item->attr->name;
                $attributesMain[$n]['slug'] = $item->attr->slug;
                $attributesMain[$n]['value'] = $item->value;
            }
            if($item->value && $item->attr->type_attr == Attribute::TYPEA_SINGLE)
                $attributes[$item->attr->slug] = $item->value;
        }

        $this->pageTitle = ($model->meta_title)? $model->meta_title : $model->name;
        $this->meta_description = ($model->meta_description)? $model->meta_description : false;
        $this->meta_keywords = ($model->meta_keywords)? $model->meta_keywords : false;

        $catName = (Yii::app()->session['bc_catName'])? Yii::app()->session['bc_catName']: $model->categories[0]->name;
        $catSlug = (Yii::app()->session['bc_catSlug'])? Yii::app()->session['bc_catSlug']: $model->categories[0]->slug;

        $this->breadcrumbs=array(
            $model->brand->name => array( "/brand/view", "slug"=>$model->brand->slug ),
            $catName => array( "/category/view", "slug" => $catSlug ),
            $model->name,
        );

        $this->render('view', array(
            'model'=>$model,
            'imageUrl'=>Upload::getUrl($model->uploadMain),
            'attributesMain' => $attributesMain,
            'attributes' => $attributes,
        ));
    }


}