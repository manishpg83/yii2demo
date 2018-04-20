<?php

namespace common\models;
use common\models\Gallery;
use common\models\Images;
use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $firstname
 * @property string $lastname
 *
 * @property Gallery[] $galleries
 */
class Users extends \yii\db\ActiveRecord
{
    public $gallery_type_id;
    public $image1;
    public $image2;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['firstname', 'lastname', 'gallery_type_id'], 'required'],
            [['firstname', 'lastname'], 'string', 'max' => 50],
            [['image1','image2'], 'safe'],
            [['image1','image2'], 'file', 'extensions'=>'jpg, gif, png'],
            [['image1','image2'], 'file', 'maxSize'=>'100000'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGalleries()
    {
        return $this->hasMany(Gallery::className(), ['user_id' => 'id']);
    }

    /**
     * Delete related gallery and images
     */
    public function deleteRelated($id)
    {
        $gallery = Gallery::find()->where(['user_id' => $id])->one();

        if($gallery->id != '')
        {
            $images = Images::find()
            ->where(['gallery_id' => $gallery->id])   
            ->all(); 
            $cnt = count($images);
            if($cnt > 0)
            {
                Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/uploads/gallery/';
                foreach ($images as $value) {

                    if($value->imagename != '' && file_exists(Yii::$app->basePath . '/web/uploads/gallery/'.$value->imagename) )

                    {
                        unlink(Yii::$app->basePath . '/web/uploads/gallery/'.$value->imagename);
                    }                    
                }
            }
            Images::deleteAll(['gallery_id' => $gallery->id]);

            $gallery->delete($gallery->id);
        }
    }

    /**
     * Get related gallery and images
     */
    public function getUserGallery($id)
    {
        $data = array();
        $gallery = Gallery::find()->where(['user_id' => $id])->one();
        
        if($gallery->id != '')
        {
            $data['gallery_id'] = $gallery->id;
            $data['gallery_type_id'] = $gallery->gallery_type_id;
            $images = Images::find()
            ->where(['gallery_id' => $gallery->id])
            ->orderBy('id')   
            ->all();            
            $cnt = count($images);
            if($cnt > 0)
            {
                $i = 1;
                foreach ($images as $value) {
                    $data['image'.$i]['id'] = $value->id; 
                    $data['image'.$i]['name'] = $value->imagename;                   
                $i++;
                }

            }            
        }
        return $data;
    }
}
