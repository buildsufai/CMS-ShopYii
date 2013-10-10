<?php

class PromokitModule extends CWebModule
{

    public $duration = 0;
    public $dependency = null;

	public function init()
	{
        // Publish extension assets
        $assets = Yii::app()->getAssetManager()->publish(dirname(__FILE__) . '/assets' );

        // Register extension assets
        $cs = Yii::app()->getClientScript();
        $cs->registerCssFile( "{$assets}/promokit-style.css" );

		// import the module-level models and components
		$this->setImport(array(
			'promokit.models.*',
			'promokit.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}
