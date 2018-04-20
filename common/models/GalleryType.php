<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "gallery_type".
 *
 * @property int $id
 * @property string $gallery_type_name
 *
 * @property Gallery[] $galleries
 */
class GalleryType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gallery_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gallery_type_name'], 'required'],
            [['gallery_type_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'gallery_type_name' => 'Gallery Type Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGalleries()
    {
        return $this->hasMany(Gallery::className(), ['gallery_type_id' => 'id']);
    }
}
