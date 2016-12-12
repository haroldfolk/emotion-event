<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "promedio".
 *
 * @property integer $idPromedio
 * @property string $nombre
 * @property double $valor
 * @property double $cant
 * @property integer $numTuplas
 * @property integer $id_Evento
 *
 * @property Evento $idEvento
 */
class Promedio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'promedio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'id_Evento'], 'required'],
            [['valor', 'cant'], 'number'],
            [['numTuplas', 'id_Evento'], 'integer'],
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
            'idPromedio' => 'Id Promedio',
            'nombre' => 'Nombre',
            'valor' => 'Valor',
            'cant' => 'Cant',
            'numTuplas' => 'Num Tuplas',
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
