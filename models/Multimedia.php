<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "multimedia".
 *
 * @property integer $idMultimedia
 * @property string $nombre
 * @property string $path
 * @property integer $id_Usuario
 * @property integer $id_Evento
 *
 * @property Usuario $idUsuario
 * @property Evento $idEvento
 */
class Multimedia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'multimedia';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'path', 'id_Usuario', 'id_Evento'], 'required'],
            [['id_Usuario', 'id_Evento'], 'integer'],
            [['nombre', 'path'], 'string', 'max' => 255],
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
            'idMultimedia' => 'Id Multimedia',
            'nombre' => 'Nombre',
            'path' => 'Path',
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
