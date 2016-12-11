<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "emocion".
 *
 * @property integer $idEmocion
 * @property string $nombre
 * @property double $valor
 * @property integer $id_Evento
 *
 * @property Evento $idEvento
 */
class Emocion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'emocion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['valor', 'id_Evento'], 'required'],
            [['valor'], 'number'],
            [['id_Evento'], 'integer'],
            [['nombre'], 'string', 'max' => 255],
            [['id_Evento'], 'exist', 'skipOnError' => true, 'targetClass' => Evento::className(), 'targetAttribute' => ['id_Evento' => 'idEvento']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idEmocion' => 'Id Emocion',
            'nombre' => 'Nombre',
            'valor' => 'Valor',
            'id_Evento' => 'Id  Evento',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdEvento()
    {
        return $this->hasOne(Evento::className(), ['idEvento' => 'id_Evento']);
    }
}
