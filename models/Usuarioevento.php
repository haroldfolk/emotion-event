<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuarioevento".
 *
 * @property integer $idUsuarioEvento
 * @property integer $id_Usuario
 * @property integer $id_Evento
 *
 * @property Usuario $idUsuario
 * @property Evento $idEvento
 */
class Usuarioevento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuarioevento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_Usuario', 'id_Evento'], 'required'],
            [['id_Usuario', 'id_Evento'], 'integer'],
            [['id_Usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['id_Usuario' => 'idUsuario']],
            [['id_Evento'], 'exist', 'skipOnError' => true, 'targetClass' => Evento::className(), 'targetAttribute' => ['id_Evento' => 'idEvento']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idUsuarioEvento' => 'Id Usuario Evento',
            'id_Usuario' => 'Id  Usuario',
            'id_Evento' => 'Id  Evento',
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
    public function getIdEvento()
    {
        return $this->hasOne(Evento::className(), ['idEvento' => 'id_Evento']);
    }
}
