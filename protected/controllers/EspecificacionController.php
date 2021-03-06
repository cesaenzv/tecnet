<?php

class EspecificacionController extends Controller {

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
        return $accessRules->getAccessRules("especificacion");
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

    public function checkExsistence($attributes){
        unset($attributes["k_especificacion"]);        
        $model = Especificacion::model()->findByAttributes($attributes);
        if($model == null)
            return false;
        return true;
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $manageM = new ManageModel();
        $model = new Especificacion;
        $marca = array();
        $marca['model'] = new Marca;
        $marca['list'] = Marca::model()->findAll();
        $tipoEquipo = array();
        $tipoEquipo['model'] = new Tipoequipo;
        $tipoEquipo['list'] = Tipoequipo::model()->findAll();
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);        
        if (isset($_POST['Especificacion']) && isset($_POST['Tipoequipo']) && isset($_POST['Marca'])) {
            $msg ="";
            $model->attributes = $manageM->PassCaptionString($_POST['Especificacion']);
            $model->k_idTipoEquipo = $_POST['Tipoequipo']["k_idTipo"];
            $model->k_idMarca = $_POST['Marca']["k_idMarca"];
            
            if(!$this->checkExsistence($model->attributes)){
                if ($model->save()){
                    $msg = "Creado Satisfactoriamente";
                }
                else{
                    $msg = "No se pudo crear";
                }
            }else{
                $msg = "Este modelo ya existe";
            }
            Yii::app()->user->setState('msg', $msg);
            $this->redirect(array('admin'));     
        }

        $this->render('create', array(
            'model' => $model,
            'tipoEquipo' =>$tipoEquipo,
            'marca' => $marca
        ));
    }

    public function actionCreateFancy(){
        $model = new Especificacion;$manageM = new ManageModel();
        $marca = array();
        $marca['model'] = new Marca;
        $marca['list'] = Marca::model()->findAll();
        $tipoEquipo = array();
        $tipoEquipo['model'] = new Tipoequipo;
        $tipoEquipo['list'] = Tipoequipo::model()->findAll();
        
        $this->performAjaxValidation($model);
        $this->layout = "mainFancy";

        if (isset($_POST['Especificacion']) && isset($_POST['Tipoequipo']) && isset($_POST['Marca'])) {
            $model->attributes = $manageM->PassCaptionString($_POST['Especificacion']);
            $model->k_idTipoEquipo = $_POST['Tipoequipo']["k_idTipo"];
            $model->k_idMarca = $_POST['Marca']["k_idMarca"];
            
            if(!$this->checkExsistence($model->attributes)){
                if ($model->save()){
                    echo CJavaScript::jsonEncode(array("msg" => 'Modelo creado satisfactoriamente',"status"=>1));
                }else{
                    echo CJavaScript::jsonEncode(array("msg" => 'Modelo no pudo ser creado',"status"=>1));
                }
            }
            else{             
                echo CJavaScript::jsonEncode(array("msg" => 'Este modelo ya exsiste',"status"=>1));
            }
        }

        $this->render('createFancy', array(
            'model' => $model,
            'tipoEquipo' =>$tipoEquipo,
            'marca' => $marca
        ));   
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);$manageM = new MangeModel();

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Especificacion'])) {
            $model->attributes = $manageM->PassCaptionString($_POST['Especificacion']);
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->k_especificacion));
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
        $dataProvider = new CActiveDataProvider('Especificacion');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $msg = Yii::app()->user->getState('msg');
        Yii::app()->user->setState('msg', null);
        $model = new Especificacion('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Especificacion']))
            $model->attributes = $_GET['Especificacion'];
        if($msg != null){
            $this->render('admin', array(
                'model' => $model,
                'msg'=>$msg
            ));
        }else{
            $this->render('admin', array(
                'model' => $model
            ));
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Especificacion the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Especificacion::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Especificacion $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'especificacion-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actiongetEspecificationList(){
        $manageM = new ManageModel;
        $Criteria = new CDbCriteria(); 
        $Criteria->condition = "k_idMarca = ".$_POST['marca']." AND k_idTipoEquipo = ".$_POST['tipoEquipo'];
        $especificaciones = Especificacion::model()->findAll($Criteria);
        $data = array('list' => $manageM->getColumnList($especificaciones,'k_especificacion','n_nombreEspecificacion'));      
        echo CJavaScript::jsonEncode($data);
    }

}
