<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "emocion".
 *
 * @property integer $idEmocion
 * @property string $name
 * @property double $anger
 * @property double $contempt
 * @property double $disgust
 * @property double $fear
 * @property double $happiness
 * @property double $neutral
 * @property double $sadness
 * @property double $surprise
 * @property integer $id_Multimedia
 *
 * @property Evento $idMultimedia
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
            [['anger', 'contempt', 'disgust', 'fear', 'happiness', 'neutral', 'sadness', 'surprise', 'id_Multimedia'], 'required'],
            [['anger', 'contempt', 'disgust', 'fear', 'happiness', 'neutral', 'sadness', 'surprise'], 'number'],
            [['id_Multimedia'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['id_Multimedia'], 'exist', 'skipOnError' => true, 'targetClass' => Evento::className(), 'targetAttribute' => ['id_Multimedia' => 'idEvento']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idEmocion' => 'Id Emocion',
            'name' => 'Name',
            'anger' => 'Anger',
            'contempt' => 'Contempt',
            'disgust' => 'Disgust',
            'fear' => 'Fear',
            'happiness' => 'Happiness',
            'neutral' => 'Neutral',
            'sadness' => 'Sadness',
            'surprise' => 'Surprise',
            'id_Multimedia' => 'Id  Multimedia',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdMultimedia()
    {
        return $this->hasOne(Evento::className(), ['idEvento' => 'id_Multimedia']);
    }
}
