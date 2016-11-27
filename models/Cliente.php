<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cliente".
 *
 * @property string $idCi
 * @property string $nombre
 * @property string $fechaNac
 * @property string $lugarNac
 * @property string $estadoCivil
 * @property string $profesion
 * @property string $domicilio
 *
 * @property Tramite $tramite
 */
class Cliente extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cliente';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idCi', 'nombre', 'fechaNac', 'lugarNac', 'estadoCivil', 'profesion', 'domicilio'], 'required'],
            [['idCi', 'nombre', 'lugarNac', 'estadoCivil', 'profesion', 'domicilio'], 'string', 'max' => 100],
            [['fechaNac'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idCi' => 'Id Ci',
            'nombre' => 'Nombre',
            'fechaNac' => 'Fecha Nac',
            'lugarNac' => 'Lugar Nac',
            'estadoCivil' => 'Estado Civil',
            'profesion' => 'Profesion',
            'domicilio' => 'Domicilio',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTramite()
    {
        return $this->hasOne(Tramite::className(), ['id_Cliente' => 'idCi']);
    }
}
