<?php

class ClienteController extends Controller {

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
        return $accessRules->getAccessRules("cliente");
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
        $model = new Cliente;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Cliente'])) {
            $model->attributes = $_POST['Cliente'];
            $model->k_usuarioCrea = Yii::app()->user->Id;
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->k_identificacion));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionCreateFancy($id) {
        $model = new Cliente;
        $this->layout="_blank";
        $model->k_identificacion=$id;
        $this->render('createFancy', array(
            'model' => $model,
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

        if (isset($_POST['Cliente'])) {
            $model->attributes = $_POST['Cliente'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->k_identificacion));
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
        $dataProvider = new CActiveDataProvider('Cliente');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Cliente('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Cliente']))
            $model->attributes = $_GET['Cliente'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Cliente the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Cliente::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Cliente $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'cliente-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionSearchClient() {
        $Criteria = new CDbCriteria();
        $Criteria->condition = "k_identificacion = " . $_GET['doc'] . " AND i_nit = '" . $_GET['typeDoc'] . "'";
        $client = Cliente::model()->find($Criteria);
        $data = array();
        if (count($client) > 0) {
            $data["cliente"] = $client->attributes;
            $Criteria->condition = "k_idCliente = " . $_GET['doc'];
            $equipos = Equipo::model()->findAll($Criteria);
            if (count($equipos) > 0) {
                $data["equipos"] = array();
                foreach ($equipos as $equipo) {
                    $data["equipos"][] = $equipo->attributes;
                }
            } else {
                $data["equipos"] = null;
            }
        } else {
            $data["cliente"] = null;
            $data["equipos"] = null;
        }
        echo CJavaScript::jsonEncode($data);
    }

    public function actionGetEspecificaciones() {
        $especificacion = Especificacion::model()->findAll();
        $resultado = "<select>";
        foreach ($especificacion as $val){
        $tipoEquipo = Tipoequipo::model()->findByPk($val->k_idTipoEquipo);
        $valEspecifica = $tipoEquipo->n_tipoEquipo . " " . $val->n_nombreEspecificacion;
        $resultado=$resultado."<option val='".$val->k_especificacion."'>".$valEspecifica."</option>";
        }
        $resultado = $resultado."</select>";
        echo $resultado;
        
    }
    /*public function actionGetEstados() {
        $especificacion = Especificacion::model()->findAll();
        $resultado = "<select>";
        $resultado=$resultado."<option val='1'>En Tecnet</option>";
        $resultado=$resultado."<option val='0'>En casa de cliente</option>";
        $resultado = $resultado."</select>";
        echo $resultado;
        
    }*/
    public function actionGetEstados() {
        $especificacion = Especificacion::model()->findAll();
        $resultado = "<select>";
        $resultado=$resultado."<option val='1'>En Tecnet</option>";
        $resultado=$resultado."<option val='0'>En casa de cliente</option>";
        $resultado = $resultado."</select>";
        echo $resultado;
        
    }
    public function actionGetEquipoGrid($id) {
        $criteria = new CDbCriteria;
        if (isset($_POST['sidx']) && isset($_POST['sord']))
            $criteria->order = $_POST['sidx'] . ' ' . $_POST['sord'];
        $criteria->condition = "k_idCliente = " . $id;
        $dataProvider = new CActiveDataProvider('Equipo', array(
                    'criteria' => $criteria,
                    'pagination' => array(
                        'pageSize' => $_POST['rows'],
                        'currentPage' => $_POST['page'] - 1,
                    ),
                ));
        $ro = isset($_POST['rows']) ? $_POST['rows'] : 1;
        $response = new stdClass();
        $response->page = $_POST['page'];
        $response->records = $dataProvider->getTotalItemCount();
        $response->total = ceil($response->records / $ro);
        $rows = $dataProvider->getData();
        foreach ($rows as $i => $row) {
            $especificacion = Especificacion::model()->findByPk($row['k_idEspecificacion']);
            $tipoEquipo = Tipoequipo::model()->findByPk($especificacion->k_idTipoEquipo);
            $especificacion = $tipoEquipo->n_tipoEquipo . " " . $especificacion->n_nombreEspecificacion;

            $response->rows[$i]['id'] = $row['k_idEquipo'];
            $response->rows[$i]['cell'] = array(
                $row['k_idEquipo'],
                $row['n_nombreEquipo'],
                $especificacion,
                $row['i_inhouse'] == 1 ? "En Tecnet" : "En Casa",
            );
        }
        echo json_encode($response);
    }

}
