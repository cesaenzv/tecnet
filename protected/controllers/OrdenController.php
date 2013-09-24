<?php

class OrdenController extends Controller {

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
        return $accessRules->getAccessRules("orden");
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $orden = $this->loadModel($id);
        $paquetesA = $this->getPaquetesOrden($id);
        $ingresado = 0;
        $laboratorio = 0;
        $finalizado = 0;
        $count = 1;
        $paquetesMostrar = array();
        foreach ($paquetesA as $i => $paquete) {
            $ingresadoP = 0;
            $laboratorioP = 0;
            $finalizadoP = 0;
            if (count($paquete['procesos']) > 0) {
                foreach ($paquete['procesos'] as $j => $p) {
                    switch ($p['proceso']['fk_idEstado']) {
                        case 1:
                            $ingresado += 1;
                            $ingresadoP += 1;
                            break;
                        case 2:
                        case 4:
                        case 5:
                            $laboratorio +=1;
                            $laboratorioP +=1;
                            break;
                        case 3:
                        case 6:
                            $finalizado += 1;
                            $finalizadoP += 1;
                            break;
                    }
                    $count += 1;
                }
                $paquetesMostrar[] = array("equipo" => $paquete['equipo'],
                    "garantia" => $paquete['paqueteEquipo']['q_diasGarantia'],
                    "descuento" => $paquete['paqueteEquipo']['q_descuento'],
                    "estado" => $finalizadoP == count($paquete['procesos']) ? 'Finalizado' : ($ingresadoP == count($paquete['procesos']) ? 'No iniciado' : 'En laboratorio'));
            }
        }
        $cliente = "";
        if (count($paquetesMostrar) > 0) {
            $cliente = Cliente::model()->findByPk($paquetesMostrar[0]["equipo"]["k_idCliente"]);
        }
        $this->render('view', array(
            'model' => $orden,
            'estado' => $finalizado == $count ? 'Finalizado' : ($ingresado == $count ? 'No iniciado' : 'En laboratorio'),
            'paquetes' => $paquetesMostrar,
            'datosCliente' => $cliente,
            'pdf' => 0,
        ));
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionViewPDF($id) {
        $orden = $this->loadModel($id);
        $paquetesA = $this->getPaquetesOrden($id);
        $ingresado = 0;
        $laboratorio = 0;
        $finalizado = 0;
        $count = 1;
        $paquetesMostrar = array();
        foreach ($paquetesA as $i => $paquete) {
            $ingresadoP = 0;
            $laboratorioP = 0;
            $finalizadoP = 0;
            if (count($paquete['procesos']) > 0) {
                foreach ($paquete['procesos'] as $j => $p) {
                    switch ($p['proceso']['fk_idEstado']) {
                        case 1:
                            $ingresado += 1;
                            $ingresadoP += 1;
                            break;
                        case 2:
                        case 4:
                        case 5:
                            $laboratorio +=1;
                            $laboratorioP +=1;
                            break;
                        case 3:
                        case 6:
                            $finalizado += 1;
                            $finalizadoP += 1;
                            break;
                    }
                    $count += 1;
                }
                $paquetesMostrar[] = array("equipo" => $paquete['equipo'],
                    "garantia" => $paquete['paqueteEquipo']['q_diasGarantia'],
                    "descuento" => $paquete['paqueteEquipo']['q_descuento'],
                    "estado" => $finalizadoP == count($paquete['procesos']) ? 'Finalizado' : ($ingresadoP == count($paquete['procesos']) ? 'No iniciado' : 'En laboratorio'));
            }
        }
        $cliente = "";
        if (count($paquetesMostrar) > 0) {
            $cliente = Cliente::model()->findByPk($paquetesMostrar[0]["equipo"]["k_idCliente"]);
        }
        $html2pdf = Yii::app()->ePdf->HTML2PDF();
        $html2pdf->WriteHTML($this->renderPartial('view', array(
                    'model' => $orden,
                    'estado' => $finalizado == $count ? 'Finalizado' : ($ingresado == $count ? 'No iniciado' : 'En laboratorio'),
                    'paquetes' => $paquetesMostrar,
                    'datosCliente' => $cliente,
                    'pdf' => 1,
                        ), true));
        $html2pdf->Output();
    }

    protected function getPaquetesOrden($id) {
        $manageM = new ManageModel;
        $pqtOrden = Paquetematenimiento::model()->findAllByAttributes(
                array(), $condition = 'k_idOrden = :idO', $params = array(':idO' => $id));
        $paquetesA = array();
        foreach ($pqtOrden as $pqO) {
            $procesos = $manageM->getProcesosByCriteria("fk_idPaqueteManenimiento = " . $pqO->k_idPaquete, null, array(), true);
            $equipo = Equipo::model()->findByPk($pqO->k_idEquipo);
            $especificacion = Especificacion::model()->findByPk($equipo->k_idEspecificacion);
            $tipoEquipo = Tipoequipo::model()->findByPk($especificacion->k_idTipoEquipo);
            $equipo->k_idEspecificacion = $tipoEquipo->n_tipoEquipo . " " . $especificacion->n_nombreEspecificacion;
            $paquetesA[] = array('paqueteEquipo' => $pqO->attributes, 'procesos' => $procesos, 'equipo' => $equipo->attributes);
        }

        return $paquetesA;
    }

    public function actionGetEquiposOrden($id) {
        $criteria = new CDbCriteria;
        $paquetesA = $this->getPaquetesOrden($id);

        if (isset($_POST['sidx']) && isset($_POST['sord'])) {
            $criteria->order = $_POST['sidx'] . ' ' . $_POST['sord'];
        }

        $ro = isset($_POST['rows']) ? $_POST['rows'] : 1;
        /* TRAER LA INFORMACION DE LA ORDEN LOS PAQUETES DE MANTENIMIENTO Y SUS PROCESOS */

        $response = new stdClass();
        $count = 0;

        foreach ($paquetesA AS $i => $paquete) {
            if (count($paquete['procesos']) > 0) {
                foreach ($paquete['procesos'] as $j => $p) {
                    $response->rows[$count]['id'] = $p['proceso']['k_idProceso'];
                    $response->rows[$count]['cell'] = array(
                        $p['proceso']['k_idProceso'],
                        $paquete['equipo']['k_idEquipo'],
                        $paquete['equipo']['n_nombreEquipo'],
                        $paquete['equipo']['k_idEspecificacion'],
                        $paquete['equipo']['i_inhouse'],
                        $p['proceso']['n_descripcion'],
                        $p['proceso']['nombreEstado'],
                        $p['proceso']['o_flagLeido'] == 0 ? "No" : "Si",
                        $p['proceso']['fchAsignacion'],
                        $p['proceso']['fchFinalizacion'],
                        $p['servicio']['n_nomServicio'],
                        $p['responsable']
                    );
                    $count+=1;
                }
            }
        }
        $response->records = $count + 1;
        $response->page = $_POST['page'];
        $response->total = ceil($response->records / $ro);

        echo json_encode($response);
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Orden;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Orden'])) {
            $model->attributes = $_POST['Orden'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->k_idOrden));
        }

        $this->render('create', array(
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

        if (isset($_POST['Orden'])) {
            $model->attributes = $_POST['Orden'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->k_idOrden));
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
        $dataProvider = new CActiveDataProvider('Orden');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionCreateOrden() {
        $this->layout = "_blank";
        extract($_REQUEST);
        $ids = split(',', $ids);
        $orden = new Orden;
        $orden->k_idUsuario = Yii::app()->user->Id;
        $respuesta = new stdClass();
        if ($orden->save(false)) {
            $respuesta->idOrden = $orden->k_idOrden;
            foreach ($ids as $equipo) {
                $paqueteMantenimiento = new Paquetematenimiento;
                $paqueteMantenimiento->k_idOrden = $orden->k_idOrden;
                $paqueteMantenimiento->k_idEquipo = $equipo;
                if ($paqueteMantenimiento->save(false)) {
                    $equipo = Equipo::model()->findByPk($equipo);
                    $equipo->i_inhouse = 'LOC';
                    $equipo->save(false);
                }
            }
            $respuesta->mensaje = "OK";
        } else {
            $respuesta->mensaje = "FAIL";
        }
        echo CJSON::encode($respuesta);
    }

    public function actionCreatePaquete($id) {
        $this->layout = "mainFancy";
        $this->render('crearpaquete', array("id" => $id));
    }

    public function actionCreateProceso() {
        extract($_REQUEST);
        $proceso = new Proceso;
        $proceso->k_idTecnico = $tecnico;
        $proceso->fk_idEstado = 1;
        $proceso->n_descripcion = $observaciones;
        $proceso->o_flagLeido = 0;
        $proceso->fk_idPaqueteManenimiento = $paqueteMantenimiento;
        $paqueteMant = Paquetematenimiento::model()->find("k_idPaquete=:paquete", array(":paquete" => $paqueteMantenimiento));
        $paqueteMant->q_diasGarantia = $garantia;
        $paqueteMant->q_descuento = $descuento;
        $paqueteMant->fk_idEstado = 1;
        $paqueteMant->save();
        $respuesta = new stdClass();
        if ($proceso->save()) {
            foreach ($servicios as $val) {
                $procesoServicio = new Procesoservicio;
                $procesoServicio->k_idProceso = $proceso->k_idProceso;
                $procesoServicio->k_idServicio = $val;
                $procesoServicio->k_idUsuario = Yii::app()->user->id;
                $procesoServicio->q_estadoPago = 0;
        //        $procesoServicio->n_accesorios=$accesorios;
                $procesoServicio->save();
            }
            $respuesta->status = "OK";
            $respuesta->message = "Sus datos han sido guardados correctamente.";
        } else {
            $respuesta->status = "Fail";
            $respuesta->message = "Ha ocurrido un error inesperado";
        }
        echo CJSON::encode($respuesta);
    }

    public function actionGetServicios() {
        $criteria = new CDbCriteria;
        if (isset($_POST['sidx']) && isset($_POST['sord'])) {
            $criteria->order = $_POST['sidx'] . ' ' . $_POST['sord'];
        }
        $dataProvider = new CActiveDataProvider('Servicio', array(
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

            $response->rows[$i]['id'] = $row['k_idServicio'];
            $response->rows[$i]['cell'] = array(
                $row['n_nomServicio'],
                $row['v_costoServicio'],
            );
        }
        echo json_encode($response);
    }

    public function actionGetEquiposPaquete($id) {
        $paqueteMantenimiento = Paquetematenimiento::model()->findAll("k_idOrden= :orden", array(":orden" => $id));
        if (count($paqueteMantenimiento) > 0) {
            $condicion = "";
            $idPaquete = array();
            foreach ($paqueteMantenimiento as $paquete) {
                $condicion = $condicion . "k_idEquipo = " . $paquete->k_idEquipo . " OR ";
                $idPaquete[$paquete->k_idEquipo] = $paquete->k_idPaquete;
            }
            $condicion = substr($condicion, 0, strlen($condicion) - 4);
            $criteria = new CDbCriteria;
            if (isset($_POST['sidx']) && isset($_POST['sord'])) {
                $criteria->order = $_POST['sidx'] . ' ' . $_POST['sord'];
            }
            $criteria->condition = $condicion;
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
                    $idPaquete[$row['k_idEquipo']]
                );
            }
        } else {
            $response = "Error";
        }
        echo json_encode($response);
    }

    public function actionVerGarantia() {

        $this->render('viewGarantia', array());
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Orden('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Orden']))
            $model->attributes = $_GET['Orden'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Orden the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Orden::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Orden $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'orden-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
