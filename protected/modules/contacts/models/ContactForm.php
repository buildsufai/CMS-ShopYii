<?php
/**
 *
 * ContactForm class
 *
 * @author Vitaly Voskobovich <raficone@gmail.com>
 * @link http://www.voskobovich.com/
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
class ContactForm extends CFormModel
{
    public $name;
    public $email;
    public $subject;
    public $message;
    public $verifyCode;

    /**
     * Declares the validation rules.
     */
    public function rules()
    {
        return array(
            // name, email, subject and body are required
            array('name, email, subject, message', 'required'),
            // verifyCode needs to be entered correctly
            array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
        );
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels()
    {
        return array(
            'name' => 'Пожалуйста, представьтесь:',
            'email' => 'Укажите ваш e-mail (телефон):',
            'subject' => 'Тема сообщения:',
            'message' => 'Текст сообщения:',
            'verifyCode'=>'Проверочный код:',
        );
    }
}