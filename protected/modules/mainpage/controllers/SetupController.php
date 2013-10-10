<?php

class SetupController extends BackendMainController
{

    public $defaultAction = "install";

    public function actionInstall()
    {
        Yii::app()->config->add(
            array(
                array(
                    'param' => "mainpage_news",
                ),
                array(
                    'param' => "mainpage_popular_products",
                ),
                array(
                    'param' => "mainpage_new_products"
                ),
            )
        );

        echo "Установлено";
    }

    public function actionUninstall()
    {
        Yii::app()->config->delete(array("mainpage_news", "mainpage_popular_products", "mainpage_new_products"));

        echo "Удалено";
    }

}
