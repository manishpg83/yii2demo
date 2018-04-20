<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "images".
 *
 * @property int $id
 * @property int $gallery_id
 * @property string $imagename
 *
 * @property Gallery $gallery
 */
class Images extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gallery_id', 'imagename'], 'required'],
            [['gallery_id'], 'integer'],
            [['imagename'], 'string', 'max' => 255],
            [['gallery_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gallery::className(), 'targetAttribute' => ['gallery_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'gallery_id' => 'Gallery ID',
            'imagename' => 'Imagename',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGallery()
    {
        return $this->hasOne(Gallery::className(), ['id' => 'gallery_id']);
    }
}
