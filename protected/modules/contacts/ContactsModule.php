<?php
/**
 *
 * ContactModule class in module Contact
 *
 * @author Vitaly Voskobovich <raficone@gmail.com>
 * @link http://www.voskobovich.com/
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
class ContactsModule extends CWebModule
{
    // Contacts info
    public $email = 'info@company.com';
    public $title = 'Контакты';
    public $content = 'Написать нам';

    // Social Network
    public $vkontakte = '#';
    public $facebook = '#';
    public $twitter = '#';
    public $googleplus = '#';
    public $youtube = '#';

	public function init()
	{
	
		$this->email = Yii::app()->config->get('contact_email');
		$this->title = Yii::app()->config->get('contact_title');
		$this->content = Yii::app()->config->get('contact_content');

		// import the module-level models and components
		$this->setImport(array(
			'contacts.models.*',
			'contacts.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}
