<?php

namespace frontend\controllers;

use frontend\models\Workdoctostudents;
use Yii;
use frontend\models\Workdocs;
use frontend\models\Students;
use frontend\models\WorkdocsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        //$students=Workdoctostudents::find()->where(['=','workdoc_id',$model->id])->with('students')->all();


        return $this->render('update', [
            'model' => $model,
           // 'students'=>$students,

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
        //$students=Workdoctostudents::find()->where(['=','workdoc_id',$model->id])->with('students')->all();
        $stud=explode(':',$model->massive);
        $students=students::find()->where(['uniqum'=>$stud])->all();

        // Template processor instance creation



        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('template/uved_obr.docx');
// Variables on different parts of document
        $templateProcessor->setValue('weekday', date('l'));            // On section/content
        $templateProcessor->setValue('time', date('H:i'));             // On footer
        $templateProcessor->setValue('serverName', realpath(__DIR__)); // On header
// Simple table
        $i=1;
        $templateProcessor->cloneRow('id', count($students));
        foreach ($students as $one)
        {
            //$prefix='#'.$i;
            $prefix='';

            $fio=$one->lastname.' '.$one->firstname.' '.$one->middlename;

            $templateProcessor->setValue('id#'.$i, $i+1);
            $templateProcessor->setValue('fio#'.$i, $fio);
            $templateProcessor->setValue('born#'.$i, $one->born);
            $templateProcessor->setValue('sex#'.$i, $one->sex);
            $templateProcessor->setValue('birthday#'.$i, $one->birthday);
            $templateProcessor->setValue('passportnum#'.$i, '112112');
            $i++;
        }


        // $templateProcessor->cloneRow('rowValue', 10);
        /*$templateProcessor->setValue('rowValue#1', 'Sun');
        $templateProcessor->setValue('rowValue#2', 'Mercury');
        $templateProcessor->setValue('rowValue#3', 'Venus');
        $templateProcessor->setValue('rowValue#4', 'Earth');
        $templateProcessor->setValue('rowValue#5', 'Mars');
        $templateProcessor->setValue('rowValue#6', 'Jupiter');
        $templateProcessor->setValue('rowValue#7', 'Saturn');
        $templateProcessor->setValue('rowValue#8', 'Uranus');
        $templateProcessor->setValue('rowValue#9', 'Neptun');
        $templateProcessor->setValue('rowValue#10', 'Pluto');
        $templateProcessor->setValue('rowNumber#1', '1');
        $templateProcessor->setValue('rowNumber#2', '2');
        $templateProcessor->setValue('rowNumber#3', '3');
        $templateProcessor->setValue('rowNumber#4', '4');
        $templateProcessor->setValue('rowNumber#5', '5');
        $templateProcessor->setValue('rowNumber#6', '6');
        $templateProcessor->setValue('rowNumber#7', '7');
        $templateProcessor->setValue('rowNumber#8', '8');
        $templateProcessor->setValue('rowNumber#9', '9');
        $templateProcessor->setValue('rowNumber#10', '10');
// Table with a spanned cell
      //  $templateProcessor->cloneRow('userId', 3);
        $templateProcessor->setValue('userId#1', '1');
        $templateProcessor->setValue('userFirstName#1', 'James');
        $templateProcessor->setValue('userName#1', 'Taylor');
        $templateProcessor->setValue('userPhone#1', '+1 428 889 773');
        $templateProcessor->setValue('userId#2', '2');
        $templateProcessor->setValue('userFirstName#2', 'Robert');
        $templateProcessor->setValue('userName#2', 'Bell');
        $templateProcessor->setValue('userPhone#2', '+1 428 889 774');
        $templateProcessor->setValue('userId#3', '3');
        $templateProcessor->setValue('userFirstName#3', 'Michael');
        $templateProcessor->setValue('userName#3', 'Ray');
        $templateProcessor->setValue('userPhone#3', '+1 428 889 775');*/
        $file='office/uved_obr-1.doc';
        $templateProcessor->saveAs($file);
        // getEndingNotes(array('Word2007' => 'docx'), 'Sample_07_TemplateCloneRow.docx');
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
