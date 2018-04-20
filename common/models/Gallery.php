<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "gallery".
 *
 * @property int $id
 * @property int $user_id
 * @property int $gallery_type_id
 *
 * @property GalleryType $galleryType
 * @property Users $user
 * @property Images[] $images
 */
class Gallery extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gallery';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'gallery_type_id'], 'required'],
            [['user_id', 'gallery_type_id'], 'integer'],
            [['gallery_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => GalleryType::className(), 'targetAttribute' => ['gallery_type_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'gallery_type_id' => 'Gallery Type ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGalleryType()
    {
        return $this->hasOne(GalleryType::className(), ['id' => 'gallery_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(Images::className(), ['gallery_id' => 'id']);
    }
}
