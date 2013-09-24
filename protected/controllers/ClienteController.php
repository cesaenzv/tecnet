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

    public function actionCreateFancy($id = null) {
        $model = new Cliente;
        $this->performAjaxValidation($model);
        $this->layout = "mainFancy";
        $model->k_identificacion = $id;
        if (isset($_POST['Cliente'])) {
            $model->attributes = $_POST['Cliente'];
            $model->k_usuarioCrea = Yii::app()->user->Id;
            if ($model->save())
                echo CJavaScript::jsonEncode("Cliente creado correctamente");
        }else {
            $this->render('createFancy', array(
                'model' => $model,
            ));
        }
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
        foreach ($especificacion as $val) {
            $tipoEquipo = Tipoequipo::model()->findByPk($val->k_idTipoEquipo);
            $valEspecifica = $tipoEquipo->n_tipoEquipo . " " . $val->n_nombreEspecificacion;
            $resultado = $resultado . "<option val='" . $val->k_especificacion . "'>" . $valEspecifica . "</option>";
        }
        $resultado = $resultado . "</select>";
        echo $resultado;
    }

    /* public function actionGetEstados() {
      $especificacion = Especificacion::model()->findAll();
      $resultado = "<select>";
      $resultado=$resultado."<option val='1'>En Tecnet</option>";
      $resultado=$resultado."<option val='0'>En casa de cliente</option>";
      $resultado = $resultado."</select>";
      echo $resultado;

      } */

    public function actionGetEstados() {
        $especificacion = Especificacion::model()->findAll();
        $resultado = "<select>";
        $resultado = $resultado . "<option val='LOC'>Local</option>";
        $resultado = $resultado . "<option val='LAB'>Laboratorio</option>";
        $resultado = $resultado . "<option val='ENT'>Entregado</option>";
        $resultado = $resultado . "</select>";
        echo $resultado;
    }

    public function actionGetEquipoGrid() {
        $id = $_GET['idCliente'];
        $response = null;
        if (isset($_GET['garantia'])) {
            $response = $this->getGarantiasForGrid($id);
        } else {
            $response = $this->getEquipoForGrid($id);
        }
        echo json_encode($response);
    }

    public function getGarantiasForGrid($id) {
        $criteria = new CDbCriteria;
        if (isset($_POST['sidx']) && isset($_POST['sord']))
            $criteria->order = $_POST['sidx'] . ' ' . $_POST['sord'];

        $criteria->condition = "fk_idEstado = 5 OR fk_idEstado = 6 OR fk_idEstado = 8";

        $dataProvider = new CActiveDataProvider('Paquetematenimiento', array(
                    'criteria' => $criteria,
                    'pagination' => array(
                        'pageSize' => $_POST['rows'],
                        'currentPage' => $_POST['page'] - 1,
                    ),
                ));


        $ro = isset($_POST['rows']) ? $_POST['rows'] : 1;
        $response = new stdClass();
        $response->page = $_POST['page'];        
        $rows = $dataProvider->getData();
        $count = 0;
        foreach ($rows as $i => $row) {
            $row = $this->tratarPaquete($row, $id);
            if ($row != false) {
                $response->rows[$count]['id'] = $row['k_idProceso'];
                $response->rows[$count]['cell'] = array(
                    $row['k_idProceso'],
                    $row['nombreE'], //nombreEquipo
                    $row['especificacion'], //Especificacion                                         
                    $row['k_idTecnico']['username'], //Tecnico
                    $row['n_descripcion'], //Descripcion
                    $row['o_flagLeido'], //Estado leido                    
                    $row['fchAsignacion'], //
                    $row['fchFinalizacion'],
                    $row['fk_idEstado']//Estado Garantia    
                );
            }
        }
        $response->records = $count;
        $response->total = ceil($response->records / $ro);

        return $response;
    }

    protected function tratarPaquete($pM, $idCliente) {
        $Criteria = new CDbCriteria();        
        $equipo = Equipo::model()->findByPk($pM->k_idEquipo);        
        $orden = Orden::model()->findByPk($pM->k_idOrden);
        $Criteria->condition = "fk_idPaqueteManenimiento = ".$pM->k_idPaquete;
        $Criteria->order = 'fchAsignacion DESC';
        $proceso = Proceso::model()->find($Criteria);
        $estado = Estados::model()->findByPk($pM->fk_idEstado);        
        if ($equipo->k_idCliente == $idCliente && $proceso != null) {
            $especificacion = Especificacion::model()->findByPk($equipo->k_idEspecificacion);            
            $tipoEquipo = Tipoequipo::model()->findByPk($especificacion->k_idTipoEquipo);                       
            $tecnico = Users::model()->findByPk($proceso->k_idTecnico);            
            $proceso = $proceso->attributes;
            $proceso["especificacion"] = $tipoEquipo->n_tipoEquipo . " " . $especificacion->n_nombreEspecificacion;
            $proceso['nombreE'] = $equipo->n_nombreEquipo;
            $proceso['k_idTecnico'] = $tecnico->attributes;
            $proceso['o_flagLeido'] = $pM->fk_idEstado == 6? "Finalizada" : ($proceso['o_flagLeido'] == 0 ? "No Iniciada" : "En tratamiento");
            $proceso['n_descripcion'] = $proceso['n_descripcion'] ;
            $proceso['fk_idEstado'] = $estado->n_descEstado; 

            return $proceso;
        }
        return false;
    }

    public function getEquipoForGrid($id) {
        $criteria = new CDbCriteria;
        if (isset($_POST['sidx']) && isset($_POST['sord']))
            $criteria->order = $_POST['sidx'] . ' ' . $_POST['sord'];
        $criteria->condition = "k_idCliente = " . $id." AND (i_inhouse='NEW' OR i_inhouse='ENT') ";
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
            switch ($row['i_inhouse']){
                case 'LOC': $estadoEquipo="Local";break;
                case 'LAB': $estadoEquipo="Laboratorio";break;
                case 'ENT': $estadoEquipo="Entregado";break;
                case 'NEW': $estadoEquipo="Nuevo";break;
                default: $estadoEquipo="Sin Estado";
            }
            $response->rows[$i]['id'] = $row['k_idEquipo'];
            $response->rows[$i]['cell'] = array(
                $row['k_idEquipo'],
                $row['n_nombreEquipo'],
                $especificacion,
                $estadoEquipo,
            );
        }

        return $response;
    }

}
