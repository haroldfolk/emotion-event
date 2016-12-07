<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "personalizacion".
 *
 * @property integer $idPersonalizacion
 * @property string $fuente
 * @property string $fondo
 * @property integer $id_Usuario
 *
 * @property Usuario $idUsuario
 */
class Personalizacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'personalizacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_Usuario'], 'required'],
            [['id_Usuario'], 'integer'],
            [['fuente', 'fondo'], 'string', 'max' => 255],
            [['id_Usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['id_Usuario' => 'idUsuario']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idPersonalizacion' => 'Id Personalizacion',
            'fuente' => 'Fuente',
            'fondo' => 'Fondo',
            'id_Usuario' => 'Id  Usuario',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuario()
    {
        return $this->hasOne(Usuario::className(), ['idUsuario' => 'id_Usuario']);
    }
}
