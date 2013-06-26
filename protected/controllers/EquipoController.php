<?php

class EquipoController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        $accessRules = new AccessDataRol();
        return $accessRules->getAccessRules("equipo");
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $manageM = new ManageModel;
        $equipo = new Equipo;

        $listMarca = $manageM->getColumnList(Marca::model()->findAll(),'n_nombreMarca');
        $marca =  array('model' => new Marca,
                        'list' => $listMarca); 

        $listTipoEquipo = $manageM->getColumnList(Tipoequipo::model()->findAll(),'n_tipoEquipo');        
        $tipoEquipo = array('model' => new Tipoequipo,
                            'list' => $listTipoEquipo);

        $especificacion = new Especificacion;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Equipo']) && isset($_POST['Marca']) && isset($_POST['Tipoequipo']) && isset($_POST['Especificacion'])) {
            // $model->attributes = $_POST['Equipo'];
            // if ($model->save())
            //     $this->redirect(array('view', 'id' => $model->k_idEquipo));

        }
        
        $this->render('create', array(
            'equipo' => $equipo,
            'marca' =>$marca,
            'tipoEquipo' => $tipoEquipo,
            'especificacion' => $especificacion
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Equipo'])) {
            $model->attributes = $_POST['Equipo'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->k_idEquipo));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Equipo');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Equipo('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Equipo']))
            $model->attributes = $_GET['Equipo'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Equipo the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Equipo::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Equipo $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'equipo-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
