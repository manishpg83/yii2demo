<?php

namespace frontend\controllers;

use Yii;
use common\models\Users;
use common\models\UsersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Gallery;
use common\models\Images;
use yii\web\UploadedFile;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class UsersController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Users models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Users model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Users model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Users();

        if ($model->load(Yii::$app->request->post())) {

            if($model->save())
            {
                $gallery = new Gallery();
                $gallery->user_id  = $model->id;                
                $gallery->gallery_type_id  = $model->gallery_type_id;
                if($gallery->save())
                {
                    $galleryid = $gallery->id;
                    
                    $image1 = UploadedFile::getInstance($model, 'image1');
                    if (!is_null($image1)) {
                        $ext = pathinfo($image1->name, PATHINFO_EXTENSION); 
                        // generate a unique file name to prevent duplicate filenames
                        $model->image1 = Yii::$app->security->generateRandomString().".{$ext}";
                        // the path to save file, you can set an uploadPath
                        // in Yii::$app->params (as used in example below)                       
                        Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/uploads/gallery/';
                        $path = Yii::$app->params['uploadPath'] . $model->image1;
                        $image1->saveAs($path);
                        $images = new Images();
                        $images->gallery_id = $galleryid;
                        $images->imagename = $model->image1;
                        $images->save();
                    }

                    $image2 = UploadedFile::getInstance($model, 'image2');
                    if (!is_null($image2)) {                   
                        $ext = pathinfo($image2->name, PATHINFO_EXTENSION); 
                        // generate a unique file name to prevent duplicate filenames
                        $model->image2 = Yii::$app->security->generateRandomString().".{$ext}";
                        // the path to save file, you can set an uploadPath
                        // in Yii::$app->params (as used in example below)                       
                        Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/uploads/gallery/';
                        $path = Yii::$app->params['uploadPath'] . $model->image2;
                        $image2->saveAs($path);

                        $images = new Images();
                        $images->gallery_id = $galleryid;
                        $images->imagename = $model->image2;
                        $images->save();
                    }                    
                }
            }

            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Users model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $data = Users::getUserGallery($id);             
        $model->gallery_type_id = $data['gallery_type_id'];
        if($model->load(Yii::$app->request->post())) {

            if($model->save())
            {

                if($data['gallery_type_id'] != $model->gallery_type_id)
                {
                    $gall = Gallery::findOne($data['gallery_id']);
                    $gall->gallery_type_id = $model->gallery_type_id;
                    $gall->save();
                }   
                
                    $galleryid = $data['gallery_id'];
                    
                    $image1 = UploadedFile::getInstance($model, 'image1');
                    if (!is_null($image1)) {                    
                        // echo $image1->name; exit;
                        $ext = pathinfo($image1->name, PATHINFO_EXTENSION); 
                        // generate a unique file name to prevent duplicate filenames
                        $model->image1 = Yii::$app->security->generateRandomString().".{$ext}";
                        // the path to save file, you can set an uploadPath
                        // in Yii::$app->params (as used in example below)                       
                        Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/uploads/gallery/';
                        $path = Yii::$app->params['uploadPath'] . $model->image1;
                        $image1->saveAs($path);
                        
                        if(isset($data['image1']['id']))
                        {
                            $images = Images::findOne($data['image1']['id']);
                            $images->gallery_id = $galleryid;
                            $images->imagename = $model->image1;
                            $images->save();

                            if($data['image1']['name'] != '' && file_exists(Yii::$app->basePath . '/web/uploads/gallery/'.$data['image1']['name']) )

                            {
                                unlink(Yii::$app->basePath . '/web/uploads/gallery/'.$data['image1']['name']);
                            }
                        }
                        else
                        {
                            $images = new Images();
                            $images->gallery_id = $galleryid;
                            $images->imagename = $model->image1;
                            $images->save(); 
                        }
                    }

                    $image2 = UploadedFile::getInstance($model, 'image2');
                    if (!is_null($image2)) {                   
                        $ext = pathinfo($image2->name, PATHINFO_EXTENSION); 
                        // generate a unique file name to prevent duplicate filenames
                        $model->image2 = Yii::$app->security->generateRandomString().".{$ext}";
                        // the path to save file, you can set an uploadPath
                        // in Yii::$app->params (as used in example below)                       
                        Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/uploads/gallery/';
                        $path = Yii::$app->params['uploadPath'] . $model->image2;
                        $image2->saveAs($path);

                        if(isset($data['image2']['id']))
                        {
                            $images = Images::findOne($data['image2']['id']);
                            $images->gallery_id = $galleryid;
                            $images->imagename = $model->image2;
                            $images->save();

                            if($data['image2']['name'] != '' && file_exists(Yii::$app->basePath . '/web/uploads/gallery/'.$data['image2']['name']) )

                            {
                                unlink(Yii::$app->basePath . '/web/uploads/gallery/'.$data['image2']['name']);
                            }  
                        }
                        else
                        {
                            $images = new Images();
                            $images->gallery_id = $galleryid;
                            $images->imagename = $model->image2;
                            $images->save();
                        }
                    }                    
                
            }
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Users model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {

        Users::deleteRelated($id);
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
