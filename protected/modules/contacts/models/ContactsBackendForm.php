<?php
class ContactsBackendForm extends CFormModel
{
    public $email;
    public $title;
	public $content;

    public function rules()
    {
        return array(
            array('email, title, content', 'required'),
			array('email', 'email'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'email' => 'Email',
            'title' => 'Заголовок',
            'content' => 'Содержание',
        );
    }
}
?>