<?php

class DefaultController extends EController
{

	private $_model = "Page";

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$data = CActiveRecord::model($this->_model)->cache( Yii::app()->controller->module->duration, Yii::app()->controller->module->dependency )->active()->findAll();
		$this->render('index',array(
			'data'=>$data,
		));
	}

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($slug)
	{
        $model = CActiveRecord::model($this->_model)->cache(Yii::app()->controller->module->duration, Yii::app()->controller->module->dependency)->active()->findByAttributes(array('slug' => $slug));

        if($model===null)
            throw new CHttpException(404, 'Запрашиваемой страницы не существует');

        // Даем доступ к черновикам только для админов и модеров
        if(!$model->active && (!Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('moder')))
            throw new CHttpException(404, 'У вас не достаточно прав для просмотра этой записи');
		
        $this->render('view',array(
            'model'=>$model,
        ));
    }
}
