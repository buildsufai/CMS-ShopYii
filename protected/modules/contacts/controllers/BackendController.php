<?php

class BackendController extends BackendMainController
{

    public function actionIndex()
    {
        $fieldPrefix = "";
        $model = new ContactsBackendForm;

        if(isset($_POST['ContactsBackendForm'])){

            $model->attributes = $_POST['ContactsBackendForm'];

            if($model->validate()){
                foreach($model->attributes as $attr => $val)
                    Yii::app()->config->set("contact_{$attr}", $model->$attr);

                Yii::app()->user->setFlash('success', self::SUCCESS_ALERT_UPDATE);
            }

        }

        foreach ($model->attributes as $attr => $val)
            $model->$attr = Yii::app()->config->get("contact_{$attr}");

        $this->render('index', array('model' => $model));

    }
}
