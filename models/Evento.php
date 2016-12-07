<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "evento".
 *
 * @property integer $idEvento
 * @property string $nombre
 * @property string $fechaInicio
 * @property string $fechaFin
 * @property integer $id_Organizador
 * @property string $ubicacionLongitud
 * @property string $ubicacionLatitud
 * @property integer $id_Categoria
 *
 * @property Categoria $idCategoria
 * @property Organizador $idOrganizador
 * @property Multimedia[] $multimedia
 * @property Usuarioevento[] $usuarioeventos
 */
class Evento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'evento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fechaInicio', 'fechaFin', 'id_Organizador', 'ubicacionLongitud', 'ubicacionLatitud', 'id_Categoria'], 'required'],
            [['id_Organizador', 'id_Categoria'], 'integer'],
            [['nombre', 'fechaInicio', 'fechaFin', 'ubicacionLongitud', 'ubicacionLatitud'], 'string', 'max' => 255],
            [['id_Categoria'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::className(), 'targetAttribute' => ['id_Categoria' => 'idCategoria']],
            [['id_Organizador'], 'exist', 'skipOnError' => true, 'targetClass' => Organizador::className(), 'targetAttribute' => ['id_Organizador' => 'idOrganizador']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idEvento' => 'Id Evento',
            'nombre' => 'Nombre',
            'fechaInicio' => 'Fecha Inicio',
            'fechaFin' => 'Fecha Fin',
            'id_Organizador' => 'Id  Organizador',
            'ubicacionLongitud' => 'Ubicacion Longitud',
            'ubicacionLatitud' => 'Ubicacion Latitud',
            'id_Categoria' => 'Id  Categoria',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCategoria()
    {
        return $this->hasOne(Categoria::className(), ['idCategoria' => 'id_Categoria']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdOrganizador()
    {
        return $this->hasOne(Organizador::className(), ['idOrganizador' => 'id_Organizador']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMultimedia()
    {
        return $this->hasMany(Multimedia::className(), ['id_Evento' => 'idEvento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioeventos()
    {
        return $this->hasMany(Usuarioevento::className(), ['id_Evento' => 'idEvento']);
    }
}
