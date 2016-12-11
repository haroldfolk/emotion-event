<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuariocategoria".
 *
 * @property integer $idUsuarioCategoria
 * @property integer $id_Usuario
 * @property integer $id_Categoria
 *
 * @property Usuario $idUsuario
 * @property Categoria $idCategoria
 */
class Usuariocategoria extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Usuariocategoria';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_Usuario', 'id_Categoria'], 'required'],
            [['id_Usuario', 'id_Categoria'], 'integer'],
            [['id_Usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['id_Usuario' => 'idUsuario']],
            [['id_Categoria'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::className(), 'targetAttribute' => ['id_Categoria' => 'idCategoria']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idUsuarioCategoria' => 'Id Usuario Categoria',
            'id_Usuario' => 'Id  Usuario',
            'id_Categoria' => 'Id  Categoria',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuario()
    {
        return $this->hasOne(Usuario::className(), ['idUsuario' => 'id_Usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCategoria()
    {
        return $this->hasOne(Categoria::className(), ['idCategoria' => 'id_Categoria']);
    }
}
