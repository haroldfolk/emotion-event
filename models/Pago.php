<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pago".
 *
 * @property integer $idPago
 * @property string $idComprobante
 * @property string $fechaInicioLicencia
 * @property string $fechaFinLicencia
 * @property integer $id_Organizador
 *
 * @property Organizador $idOrganizador
 */
class Pago extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Pago';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idComprobante', 'fechaInicioLicencia', 'fechaFinLicencia', 'id_Organizador'], 'required'],
            [['id_Organizador'], 'integer'],
            [['idComprobante', 'fechaInicioLicencia', 'fechaFinLicencia'], 'string', 'max' => 255],
            [['id_Organizador'], 'exist', 'skipOnError' => true, 'targetClass' => Organizador::className(), 'targetAttribute' => ['id_Organizador' => 'idOrganizador']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idPago' => 'Id Pago',
            'idComprobante' => 'Id Comprobante',
            'fechaInicioLicencia' => 'Fecha Inicio Licencia',
            'fechaFinLicencia' => 'Fecha Fin Licencia',
            'id_Organizador' => 'Id  Organizador',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdOrganizador()
    {
        return $this->hasOne(Organizador::className(), ['idOrganizador' => 'id_Organizador']);
    }
}
