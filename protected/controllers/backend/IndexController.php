<?php

class IndexController extends BackendMainController
{

    public function actionIndex()
    {
        $this->render('backend.index.index');
    }

}