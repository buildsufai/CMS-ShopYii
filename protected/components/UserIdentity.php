<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    const ERROR_USER_BANNED = 3;

    private $_id;

    public function authenticate()
    {
        $record=User::model()->findByAttributes(array('email' => $this->username));

        if($record===null)
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        else if( $record->password !== md5(md5($this->password)) )
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        else if( $record->banned )
            $this->errorCode=self::ERROR_USER_BANNED;
        else{
            $this->_id = $record->id;
            $this->updateLastVisit($record);
            $this->errorCode=self::ERROR_NONE;
        }

        return !$this->errorCode;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function updateLastVisit($user)
    {
        $user->date_lastvisit = date("Y-m-d H:i:s");
        $user->save();
    }
}