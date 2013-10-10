<?php

class ProfileController extends EController
{
    private $_model = "User";

    public function actionIndex()
    {
        $model = $this->loadModel($this->_model, Yii::app()->user->id);

        $this->render('view', array(
            'model'=>$model,
        ));
    }

}