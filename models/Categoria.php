<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categoria".
 *
 * @property integer $idCategoria
 * @property string $nombre
 * @property string $descripcion
 *
 * @property Evento[] $eventos
 * @property Usuariocategoria[] $usuariocategorias
 */
class Categoria extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categoria';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'descripcion'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idCategoria' => 'Id Categoria',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventos()
    {
        return $this->hasMany(Evento::className(), ['id_Categoria' => 'idCategoria']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuariocategorias()
    {
        return $this->hasMany(Usuariocategoria::className(), ['id_Categoria' => 'idCategoria']);
    }
}
