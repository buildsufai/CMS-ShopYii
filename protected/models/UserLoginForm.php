<?php

/**
 * Форма авторизации на бекенде
 *
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class UserLoginForm extends CFormModel
{
	public $email;
	public $password;

	/**
	 * Declares the validation rules.
	 * The rules state that login and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// login and password are required
			array('email, password', 'required', 'message'=>'Заполните поле {attribute}.'),
			// password needs to be authenticated
			array('email', 'email', 'message'=>'Укажите корректный E-mail.'),
            array('password', 'authenticate'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'email'=>'E-mail',
			'password'=>'Пароль',
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())  // we only want to authenticate when no input errors
		{
			$identity=new UserIdentity( $this->email, $this->password );

			$identity->authenticate();

			switch($identity->errorCode)
			{
				case UserIdentity::ERROR_NONE:
					Yii::app()->user->login($identity);
					break;
				case UserIdentity::ERROR_USERNAME_INVALID:
					$this->addError("email","Пользователь не найден");
					break;
                case UserIdentity::ERROR_USER_BANNED:
                    $this->addError("email","Пользователь заблокирован");
                    break;
				case UserIdentity::ERROR_PASSWORD_INVALID:
					$this->addError("password","Пароль не подходит");
					break;
			}
		}
	}
}
