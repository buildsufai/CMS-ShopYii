<?php


class PortletProductsFeatured extends Portlet
{
    public $items = array();

    public function run()
    {
        if(count($this->items) > 0)
            $this->renderContent();
    }

    protected function renderContent()
    {
        $listProductsFeatured  = array();

        foreach($this->items as $n=>$item)
        {
            $listProductsFeatured[$n]['image'] = Upload::getUrl($item->uploadCatalog);
            $listProductsFeatured[$n]['name'] = $item->name;
            $listProductsFeatured[$n]['price'] = $item->pricenow;
            $listProductsFeatured[$n]['url'] = Yii::app()->controller->createUrl('view', array('slug'=>$item->slug));
        }

        $this->render('application.views.portlets.PortletProductsFeatured', array('listProductsFeatured'=>$listProductsFeatured) );
    }
}