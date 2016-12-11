<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "emocion".
 *
 * @property integer $idEmocion
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
 * @property Multimedia $idMultimedia
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
            [['id_Multimedia'], 'exist', 'skipOnError' => true, 'targetClass' => Multimedia::className(), 'targetAttribute' => ['id_Multimedia' => 'idMultimedia']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idEmocion' => 'Id Emocion',
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
        return $this->hasOne(Multimedia::className(), ['idMultimedia' => 'id_Multimedia']);
    }
}
