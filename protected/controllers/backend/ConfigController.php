<?php

class ConfigController extends BackendMainController
{

    public $_model = "ConfigForm";

    public function actionIndex()
    {

        $model = new $this->_model;

		if(isset($_POST[$this->_model])){
		
			$model->attributes = $_POST[$this->_model];
			
			if($model->validate()){
				foreach($model->attributes as $attr => $val)
					Yii::app()->config->set($attr, $model->$attr);
				
				Yii::app()->user->setFlash('success', self::SUCCESS_ALERT_UPDATE);
			}
			
		}

        foreach ($model->attributes as $attr => $val)
            $model->$attr = Yii::app()->config->get($attr);

		$this->render('backend.config.index', array('model' => $model));

    }

	
}