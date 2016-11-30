<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tramite".
 *
 * @property integer $idTramite
 * @property string $titulo
 * @property string $fecha
 * @property integer $estado
 * @property string $id_Cliente
 *
 * @property Imagen $imagen
 * @property Cliente $idCliente
 */
class Tramite extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tramite';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha'], 'safe'],
            [['estado'], 'integer'],
            [['id_Cliente'], 'required'],
            [['titulo', 'id_Cliente'], 'string', 'max' => 100],
            [['id_Cliente'], 'unique'],
            [['id_Cliente'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::className(), 'targetAttribute' => ['id_Cliente' => 'idCi']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idTramite' => 'Id Tramite',
            'titulo' => 'Titulo',
            'fecha' => 'Fecha',
            'estado' => 'Estado',
            'id_Cliente' => 'Id  Cliente',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImagen()
    {
        return $this->hasOne(Imagen::className(), ['id_Tramite' => 'idTramite']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCliente()
    {
        return $this->hasOne(Cliente::className(), ['idCi' => 'id_Cliente']);
    }
}
