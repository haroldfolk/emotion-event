<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "usuario".
 *
 * @property integer $idUsuario
 * @property string $nombre
 * @property integer $edad
 * @property string $telefono
 * @property string $correo
 * @property string $username
 * @property string $password
 *
 * @property Multimedia[] $multimedia
 * @property Personalizacion[] $personalizacions
 * @property Usuariocategoria[] $usuariocategorias
 * @property Usuarioevento[] $usuarioeventos
 */
class Usuario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuario';
    }

    public static function findByUsername($username)
    {
        $activeDataProvider = new ActiveDataProvider([
            'query' => Usuario::find()->where(['username' => $username]),
        ]);
        if ($activeDataProvider->getCount() == 0) {
            return false;
        }
        return $activeDataProvider->getModels()[0];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'telefono', 'username', 'password'], 'required'],
            [['edad'], 'integer'],
            [['nombre', 'telefono', 'correo', 'username', 'password'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idUsuario' => 'Id Usuario',
            'nombre' => 'Nombre',
            'edad' => 'Edad',
            'telefono' => 'Telefono',
            'correo' => 'Correo',
            'username' => 'Username',
            'password' => 'Password',
        ];
    }

    public function validatePassword($password)
    {
        return $this->password === $password;
    }
    /**
     * @return \yii\db\ActiveQuery
     */

    public function getMultimedia()
    {
        return $this->hasMany(Multimedia::className(), ['id_Usuario' => 'idUsuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonalizacions()
    {
        return $this->hasMany(Personalizacion::className(), ['id_Usuario' => 'idUsuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuariocategorias()
    {
        return $this->hasMany(Usuariocategoria::className(), ['id_Usuario' => 'idUsuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioeventos()
    {
        return $this->hasMany(Usuarioevento::className(), ['id_Usuario' => 'idUsuario']);
    }
}
