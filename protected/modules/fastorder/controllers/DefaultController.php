<?php

class DefaultController extends EController
{

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        $dataArray = array();

		$brands = Brand::model()->with('products','products.attrValue','products.attrValue.attr')->findAll();

        foreach($brands as $n => $brand)
        {
            $dataArray[$n]['name'] = $brand->name;
            $dataArray[$n]['url'] = $brand->url;

            foreach($brand->products as $i => $product)
            {
                $dataArray[$n]['products'][$i]['name'] = $product->name;
                $dataArray[$n]['products'][$i]['url'] = $product->url;
                $dataArray[$n]['products'][$i]['article'] = $product->article;
                $dataArray[$n]['products'][$i]['priceNow'] = $product->priceNow;
                $dataArray[$n]['products'][$i]['priceDefault'] = $product->priceDefault;

                foreach($product->attrValue as $attrValue)
                {
                    if($attrValue->attr->slug == 'obem'){
                        $dataArray[$n]['products'][$i]['obem'] = $attrValue->value;
                        break;
                    }
                }
            }
        }

		$this->render('index',array(
			'brandsArray' => $dataArray,
		));
	}

}
