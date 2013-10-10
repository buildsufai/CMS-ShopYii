<?php

class AuthController extends EController
{
    public $defaultAction = "login";
	
	public $layout = "login";

    public function actionLogin()
    {
        if (Yii::app()->user->isGuest) {
            $model=new UserLoginForm;
            // collect user input data
            if(isset($_POST['UserLoginForm']))
            {
                $model->attributes=$_POST['UserLoginForm'];
                // validate user input and redirect to previous page if valid
                if($model->validate())
                    if (Yii::app()->user->returnUrl == '/')
                        $this->redirect( Yii::app()->homeUrl );
                    else
                        $this->redirect( Yii::app()->user->returnUrl );
            }
            // display the login form
            $this->render('login',array('model'=>$model));
        } else
            $this->redirect( Yii::app()->homeUrl );
    }

    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect( Yii::app()->homeUrl );
    }

}