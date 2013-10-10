<?php

class UploadsController extends BackendMainController
{
    public $_model = "Upload";

    /**
     * Updates a particular model.
     */
    public function actionView($id)
    {
        $model=$this->loadModel($this->_model, $id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST[$this->_model]))
        {
            $model->attributes=$_POST[$this->_model];
            if($model->save()){
                Yii::app()->user->setFlash('success', self::SUCCESS_ALERT_UPDATE);
                $this->redirect(Yii::app()->user->returnUrl);
            }
        }

        $this->render('view',array(
            'model'=>$model,
        ));
    }

}
