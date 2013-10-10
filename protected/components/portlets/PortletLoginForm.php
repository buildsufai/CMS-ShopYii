<?php


class PortletLoginForm extends Portlet
{
    public $title='Login';

    protected function renderContent()
    {
        $form=new UserLoginForm;
        if(isset($_POST['UserLoginForm']))
        {
            $form->attributes=$_POST['UserLoginForm'];
            if($form->validate())
                $this->controller->refresh();
        }
        $this->render('application.views.portlets.PortletLoginForm', array('form'=>$form) );
    }
}