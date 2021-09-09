<?php

namespace app\controllers;
use Yii;
use app\models\Libros;
use app\models\LibroSearch;
use Codeception\Command\Console;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * LibroController implements the CRUD actions for Libros model.
 */
class LibroController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Libros models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LibroSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Libros model.
     * @param int $id ID
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
     * Creates a new Libros model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Libros();
        // header('Content-type: text/plain'); 
        
        // print_r($model);

        $this->subirFoto($model);
        
        // if ($this->request->isPost) {
        //     if ($model->load($this->request->post()) && $model->save()) {
        //         return $this->redirect(['view', 'id' => $model->id]);
        //     }
        // } else {
        //     $model->loadDefaultValues();
        // }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Libros model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Libros model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if(file_exists($model->archivo)){
            unlink($model->archivo);
        }
        
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Libros model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Libros the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Libros::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    protected function subirFoto(Libros $model)
    {
        if ($this->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                $archivo_save = UploadedFile::getInstance($model,'archivo');
                $rutaAchivo = 'uploads/'.time()."_".$archivo_save->baseName.".".$archivo_save->extension;
                // header('Content-type: text/plain');
                // $model->archivo = $rutaAchivo;
                //     $model->save();
                // Yii::$app->request->post()
                if ($model->validate()){
                    if ($archivo_save){
                        $rutaAchivo = 'uploads/'.time()."_".$archivo_save->baseName.".".$archivo_save->extension;
                        // header('Content-type: text/plain');
                        // $model->archivo = $rutaAchivo;
                        //     $model->save();
                        // print_r('hola');
                        if ($archivo_save->saveAs($rutaAchivo)){
                            
                            $model->archivo = $rutaAchivo;
                            //$model->save();
                        }
                    }   

                }
                if ($model->save()){
                    return $this->redirect(['index']);
                }
                
                // return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }
    }
}
