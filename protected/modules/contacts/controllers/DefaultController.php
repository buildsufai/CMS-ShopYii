<?php
/**
 *
 * DefaultController class in module Contact
 *
 * @author Vitaly Voskobovich <raficone@gmail.com>
 * @link http://www.voskobovich.com/
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
class DefaultController extends EController
{

    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(
            'captcha'=>array(
                'class'=>'CCaptchaAction',
                'backColor'=> 0xFFFFFF,
                'foreColor'=> 0x666666,
            ),
        );
    }

    /**
     * Displays the contacts page
     */
    public function actionIndex()
    {
        $model=new ContactForm;
        if(isset($_POST['ContactForm']))
        {
            $model->attributes=$_POST['ContactForm'];
            if($model->validate())
            {
                $name='=?UTF-8?B?'.base64_encode($model->name).'?=';
                $subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
                $headers="From: $name <{$model->email}>\r\n".
                    "Reply-To: {$model->email}\r\n".
                    "MIME-Version: 1.0\r\n".
                    "Content-type: text/plain; charset=UTF-8";

                mail( Yii::app()->params['contacts']['email'], $subject, $model->message, $headers);
                Yii::app()->user->setFlash('contacts','Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('index', array('model'=>$model));
    }
}