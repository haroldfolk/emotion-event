<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "organizador".
 *
 * @property integer $idOrganizador
 * @property string $titular
 * @property string $direccion
 * @property string $telefono
 * @property string $informacionAdicional
 *
 * @property Evento[] $eventos
 * @property Pago[] $pagos
 */
class Organizador extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Organizador';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['titular', 'direccion', 'telefono'], 'required'],
            [['titular', 'direccion', 'telefono', 'informacionAdicional'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idOrganizador' => 'Id Organizador',
            'titular' => 'Titular',
            'direccion' => 'Direccion',
            'telefono' => 'Telefono',
            'informacionAdicional' => 'Informacion Adicional',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventos()
    {
        return $this->hasMany(Evento::className(), ['id_Organizador' => 'idOrganizador']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPagos()
    {
        return $this->hasMany(Pago::className(), ['id_Organizador' => 'idOrganizador']);
    }
}
