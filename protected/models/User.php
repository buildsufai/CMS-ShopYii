<?php

/**
 * This is the model class for table "{{users}}".
 *
 * The followings are the available columns in table '{{users}}':
 * @property string $id
 * @property string $email
 * @property string $password
 * @property string $role
 * @property integer $banned
 * @property string $name
 * @property string $surname
 * @property string $firstname
 * @property string $date_create
 * @property string $date_update
 */
class User extends CActiveRecord
{

    const STATUS_BANNED = "1";
    const STATUS_NOT_BANNED = "0";

    const PRIVILEGE_ADMIN = "admin";
    const PRIVILEGE_MODER = "moder";
    const PRIVILEGE_USER = "user";

    public $confirm_password;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{users}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{

        $rules = array(
            array('email, name, surname, firstname, role, phone, address', 'required'),
            array('email, name, surname, firstname', 'length', 'max' => 50),
            array('phone', 'length', 'max' => 30),
            array('address', 'length', 'max' => 150),
            array('role', 'length', 'max' => 5),
            array('email', 'unique'),
            array('email', 'email'),
            array('banned', 'numerical', 'integerOnly'=>true),
            array('password, confirm_password', 'length', 'max' => 32, 'min' => 6),
            array('password', 'compare', 'compareAttribute'=>'confirm_password'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('email, password, role, banned, name, surname, firstname, phone', 'safe', 'on'=>'search'),
        );

        if($this->isNewRecord)
            $rules[] = array('password, confirm_password', 'required');

        return $rules;
	}


    public function behaviors(){
        return array(
            // Обновляет даты создания и обновления
            'VTimestampBehavior' => array(
                'class' => 'application.components.behaviors.VTimestampBehavior',
                'createAttribute' => 'date_create',
                'updateAttribute' => 'date_update',
                'setUpdateOnCreate' => true,
            ),
        );
    }


	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'email' => 'E-mail',
			'password' => 'Пароль',
            'confirm_password' => 'Повтор пароля',
			'role' => 'Привилегии',
			'banned' => 'Забанен',
			'name' => 'Имя',
			'surname' => 'Фамилия',
			'firstname' => 'Отчество',
            'phone' => 'Телефон',
            'address' => 'Адресс',
			'date_create' => 'Создан',
			'date_update' => 'Изменен',
            'date_lastvisit' => 'Был авторизован'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('role',$this->role,true);
		$criteria->compare('banned',$this->banned);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('surname',$this->surname,true);
		$criteria->compare('firstname',$this->firstname,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize' => Yii::app()->params['countOnPage'],
            ),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


    public function beforeSave()
    {
        if($this->isNewRecord || ($this->password && !$this->isNewRecord))
            $this->password = md5(md5($this->password));
        else
            unset($this->password);

        return parent::beforeSave();
    }


    public function getStatus($id=null)
    {
        $arrayItems = array(
            self::STATUS_BANNED      => 'Забанен',
            self::STATUS_NOT_BANNED  => 'Активен',
        );
        return ($id==null)? $arrayItems : $arrayItems[$id];
    }

    public function getPrivilege($id=null)
    {
        $arrayItems = array(
            self::PRIVILEGE_ADMIN => 'Администратор',
            self::PRIVILEGE_MODER => 'Модератор',
            self::PRIVILEGE_USER  => 'Пользователь',
        );
        return ($id==null)? $arrayItems : $arrayItems[$id];
    }
}
