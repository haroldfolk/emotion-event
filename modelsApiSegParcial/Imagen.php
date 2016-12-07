<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "imagen".
 *
 * @property integer $idImagen
 * @property string $nombre
 * @property string $url
 * @property integer $id_Tramite
 *
 * @property Tramite $idTramite
 */
class Imagen extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'imagen';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url', 'id_Tramite'], 'required'],
            [['id_Tramite'], 'integer'],
            [['nombre', 'url'], 'string', 'max' => 255],
            [['id_Tramite'], 'exist', 'skipOnError' => true, 'targetClass' => Tramite::className(), 'targetAttribute' => ['id_Tramite' => 'idTramite']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idImagen' => 'Id Imagen',
            'nombre' => 'Nombre',
            'url' => 'Url',
            'id_Tramite' => 'Id  Tramite',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTramite()
    {
        return $this->hasOne(Tramite::className(), ['idTramite' => 'id_Tramite']);
    }
}
