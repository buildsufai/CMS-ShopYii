<?php

class BackendMainController extends EController
{
    public $layout = "backend.layouts.main";

	const SUCCESS_ALERT_UPDATE = '<strong>Сохранено!</strong> Внесенные изменения задействованы в системе.';
	const SUCCESS_ALERT_CREATE = '<strong>Создано!</strong> Все, что вы создавали было успешно создано.';
    const SUCCESS_ALERT_UPLOAD = '<strong>Загружено!</strong> Все, что вы загружали было успешно загружено.';

	public function filters()
    {
        return array(
            'accessControl',
        );
    }
	
	public function accessRules()
    {
        return array(
            array('allow',
                'roles'=>array('admin', 'moder'),
            ),
            array('deny',
                'users'=>array('*'),
            ),
        );
    }

	/**
	 * Creates a new model.
	 */
	public function actionCreate()
	{
		$model=new $this->_model;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST[$this->_model]))
		{
			$model->attributes=$_POST[$this->_model];
			if($model->save()){
				Yii::app()->user->setFlash('success', self::SUCCESS_ALERT_CREATE);
				$this->redirect(array('update','id'=>$model->id));
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($this->_model, $id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST[$this->_model]))
		{
			$model->attributes=$_POST[$this->_model];
			if($model->save()){
				Yii::app()->user->setFlash('success', self::SUCCESS_ALERT_UPDATE);
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 */
	public function actionDelete($id)
	{
		$this->loadModel($this->_model, $id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$model=new $this->_model('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET[$this->_model]))
			$model->attributes=$_GET[$this->_model];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Performs the AJAX validation.
	 * @param $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']=== strtolower($this->_model)."-form")
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}