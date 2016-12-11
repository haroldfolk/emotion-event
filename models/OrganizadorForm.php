<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class OrganizadorForm extends Model
{
    public $id;

    private $_user = 0;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->_user != 0) {
            return true;
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return Integer|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = Organizador::findOne(['idOrganizador' => $this->id])->idOrganizador;
        }

        return $this->_user;
    }
}