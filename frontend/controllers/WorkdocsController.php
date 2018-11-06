<?php

namespace frontend\controllers;

use frontend\models\Workdoctostudents;
use Yii;
use frontend\models\Workdocs;
use frontend\models\Students;
use frontend\models\Studentsdocs;
use frontend\models\WorkdocsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;

/**
 * WorkdocController implements the CRUD actions for Workdocs model.
 */
class WorkdocsController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Lists all Workdocs models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WorkdocsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Workdocs model.
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
     * Creates a new Workdocs model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Workdocs();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Workdocs model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {

        $worktostudents=workdoctostudents::find()->where(['workdoc_id'=>$id])->all();
        $array=ArrayHelper::getColumn($worktostudents, 'students_id');
        $query = Students::find()->where(['in', 'id', $array]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 100,
            ],
        ]);

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }



        $newObj = new Workdoctostudents();
        $newObj->workdoc_id=$model->id;
        $newObj->students_id=$model->students_id;
        $newObj->save();


        $worktostudents=workdoctostudents::find()->where(['workdoc_id'=>$id])->all();
        $array=ArrayHelper::getColumn($worktostudents, 'students_id');
        $students = Students::find()->where(['in', 'id', $array])->all();



        return $this->render('update', [
            'model' => $model,
            'students'=>$students,
           // 'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,

        ]);
    }

    /**
     * Deletes an existing Workdocs model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDeletefromworkdoc($id,$workdoc_id)
    {
        //$wdts=Workdoctostudents::delete(['workdoc_id'=>$workdoc_id,'students_id'=>$id]);
        Yii::$app->db->createCommand("
    DELETE FROM workdoctostudents 
    WHERE workdoc_id = '$workdoc_id' 
    AND students_id = '$id'
")->execute();

        $worktostudents=workdoctostudents::find()->where(['workdoc_id'=>$workdoc_id])->all();
        $array=ArrayHelper::getColumn($worktostudents, 'students_id');
        $query = Students::find()->where(['in', 'id', $array]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 100,
            ],
        ]);

        $model = $this->findModel($workdoc_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }


        $worktostudents=workdoctostudents::find()->where(['workdoc_id'=>$id])->all();
        $array=ArrayHelper::getColumn($worktostudents, 'students_id');
        $students = Students::find()->where(['in', 'id', $array])->all();



        return $this->render('update', [
            'model' => $model,
            'students'=>$students,
            // 'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,

        ]);
    }

    /**
     * Finds the Workdocs model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Workdocs the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Workdocs::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionCreateword($id)
    {   $model = $this->findModel($id);
        $searchModel = new WorkdocsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if ($model->typedoc_id==1)
        {

            $worktostudents=workdoctostudents::find()->where(['workdoc_id'=>$id])->all();
            $array=ArrayHelper::getColumn($worktostudents, 'students_id');
            $students = Students::find()->where(['in', 'id', $array])->all();

            $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('template/uved_obr.docx');
            $templateProcessor->setValue('weekday', date('l'));            // On section/content
            $templateProcessor->setValue('time', date('H:i'));             // On footer
            $templateProcessor->setValue('serverName', realpath(__DIR__)); // On header
            $i=1;
            $templateProcessor->cloneRow('id', count($students));
            foreach ($students as $one)
            {
                $prefix='';
                $passport=studentsdocs::find()->where(['students_id'=>$one->id])->one();
                $fio=$one->lastname.' '.$one->firstname.' '.$one->middlename;

                $templateProcessor->setValue('id#'.$i, $i+1);
                $templateProcessor->setValue('fio#'.$i, $fio);
                $templateProcessor->setValue('born#'.$i, $one->born);
                $templateProcessor->setValue('sex#'.$i, $one->sex);
                $templateProcessor->setValue('birthday#'.$i, $one->birthday);
                $templateProcessor->setValue('passportnum#'.$i, $passport->seryes.' '.$passport->number);
                $i++;
            }

            $file='office/uved_obr-1.doc';
        }

        //$students=Workdoctostudents::find()->where(['=','workdoc_id',$model->id])->with('students')->all();


        $templateProcessor->saveAs($file);

        if (file_exists($file)) {
            // сбрасываем буфер вывода PHP, чтобы избежать переполнения памяти выделенной под скрипт
            // если этого не сделать файл будет читаться в память полностью!
            if (ob_get_level()) {
                ob_end_clean();
            }
            // заставляем браузер показать окно сохранения файла
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($file));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            // читаем файл и отправляем его пользователю
            readfile($file);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


}
