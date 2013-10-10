<?php

class BackendController extends BackendMainController
{

    public function actionIndex()
    {

        $model = new MainPageBackendForm;

        if(isset($_POST['MainPageBackendForm']))
        {
            $model->attributes = $_POST['MainPageBackendForm'];

            if($model->validate())
            {
                Yii::app()->config->set("mainpage_news", $model->news);
                Yii::app()->config->set("mainpage_popular_products", implode(";", $model->popular_products));
                Yii::app()->config->set("mainpage_new_products", implode(";", $model->new_products));

                Yii::app()->user->setFlash('success', self::SUCCESS_ALERT_UPDATE);
            }
        }

        $model->news = Yii::app()->config->get("mainpage_news");
        $model->popular_products = explode(";", Yii::app()->config->get("mainpage_popular_products"));
        $model->new_products = explode(";", Yii::app()->config->get("mainpage_new_products"));

        $this->render('index', array('model' => $model));

    }
}
