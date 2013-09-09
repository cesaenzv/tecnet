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
    
    public function actionSaveGrid($id) {
        extract($_REQUEST);
        
        if(isset($oper)){
            if($oper=="add"){
                $equipo = new Equipo();
                $equipo->i_inhouse=trim($i_inhouse)=="En Tecnet"?1:0;
                $equipo->k_idEspecificacion=$k_idEspecificacion;
                $equipo->n_nombreEquipo=$n_nombreEquipo;
                if($equipo->save()){
                    echo "{Result:'OK', Message:'Datos guardados correctamente.'}";
                }else{
                    echo "{Result:'Fail', Message:'Ocurrio un error inesperado.'}";
                }
            }
        }
    }

    public function actionCreateEMantenimientoView(){
        $manageM = new ManageModel;

        $Criteria = new CDbCriteria();         
        $Criteria->condition = "itemname = 'Tecnico Recarga' OR itemname = 'Tecnico Mantenimiento'";
        $users = Authassignment::model()->findAll($Criteria);
        $tempU = array();
        foreach ($users as $i => $u) {
            $temp = Users::model()->findByPk($u->userid);
            $tempU[$temp->id] = $temp->username;
        }
        $Criteria->condition = "k_idCliente = "+$_GET['idC'];

        $listEquipos = $manageM->getColumnList(Equipo::model()->findAll($Criteria),'k_idEquipo','n_nombreEquipo');


        $this->layout="_blank";
        $this->render('creargarantia', array(
            "idC" => $_GET['idC'],
            "users" => $tempU,
            "equipos" =>$listEquipos
            ));        
    }

    public function actionCreateEMantenimiento(){
        $orden = new Orden;
        $orden->k_idUsuario = Yii::app()->user->id;      
        $orden->fchIngreso = date('Y-m-d H:i:s');
        $orden->n_Observaciones = $_POST['descripcion'];

        if($orden->save(false)){
            $pM = new Paquetematenimiento;
            $pM->k_idOrden = $orden->k_idOrden;
            $pM->k_idEquipo = $_POST['equipoId'];
            if($pM->save(false)){
                $proceso = new Proceso;
                $proceso->k_idTecnico = $_POST['tecnicoId'];
                $proceso->fk_idEstado = 5;
                $proceso->o_flagLeido = 0;
                $proceso->fk_idPaqueteManenimiento = $pM->k_idPaquete;
                $proceso->fchAsignacion = date('Y-m-d H:i:s');
                if($proceso->save(false)){
                    echo CJavaScript::jsonEncode(array("msg" => "OK"));
                }else{
                    echo CJavaScript::jsonEncode(array("msg" => "ERROR"));
                }
            }else{
                echo CJavaScript::jsonEncode(array("msg" => "ERROR"));
            }
        }else{
            echo CJavaScript::jsonEncode(array("msg" => "ERROR"));    
        }
        

    }
   
    public function actionCreateEOrdenView(){
        $manageM = new ManageModel;
        $equipo = new Equipo;

        $listMarca = $manageM->getColumnList(Marca::model()->findAll(),'k_idMarca','n_nombreMarca');
        $marca =  array('model' => new Marca,
                        'list' => $listMarca); 

        $listTipoEquipo = $manageM->getColumnList(Tipoequipo::model()->findAll(),'k_idTipo','n_tipoEquipo');        
        $tipoEquipo = array('model' => new Tipoequipo,
                            'list' => $listTipoEquipo);

        $especificacion = new Especificacion();

        $this->layout="mainFancy";
        $this->render('crearequipo', array(
            'marca' =>$marca,
            'tipoEquipo' => $tipoEquipo,
            'clienteId'=>$_GET['idC']
        ));
    }

    public function  actionCreateEOrden(){
        $equipo = new Equipo;
        try{
            if(isset($_POST['clienteId'])&&isset($_POST['marca'])&&isset($_POST['especificacion'])&isset($_POST['tipoEquipo'])&isset($_POST['nombreEquipo'])){
                $equipo->n_nombreEquipo = $_POST['nombreEquipo'];
                $equipo->k_idCliente = $_POST['clienteId'];
                $Criteria = new CDbCriteria(); 
                $Criteria->condition = "k_idMarca = ".$_POST['marca']." AND k_idTipoEquipo = ".$_POST['tipoEquipo']." AND n_nombreEspecificacion like '".$_POST['especificacion']."'";
                $especificacion = Especificacion::model()->find($Criteria);
                if($especificacion !=  null){
                    $equipo->k_idEspecificacion = $especificacion->k_especificacion; 

                }else{
                    $especificacion = new Especificacion();
                    $especificacion->k_idMarca = $_POST['marca'];
                    $especificacion->k_idTipoEquipo = $_POST['tipoEquipo'];
                    $especificacion->n_nombreEspecificacion = $_POST['especificacion'];
                    $equipo->k_idEspecificacion = $especificacion->k_especificacion;
                    if($especificacion->save(false)){
                        $equipo->k_idEspecificacion = $especificacion->k_especificacion;
                    }
                }
                if($equipo->save())
                {
                    $data['msg'] = "OK";
                }else{
                    $data['msg'] = "PROBLEM";
                }

                echo CJavaScript::jsonEncode($data);
            }
        }
        catch(Exception $e){
            $data['msg'] = "PROBLEM";
            echo CJavaScript::jsonEncode($data);    
        }
            
        

    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $manageM = new ManageModel;
        $equipo = new Equipo;

        $listMarca = $manageM->getColumnList(Marca::model()->findAll(),'k_idMarca','n_nombreMarca');
        $marca =  array('model' => new Marca,
                        'list' => $listMarca); 

        $listTipoEquipo = $manageM->getColumnList(Tipoequipo::model()->findAll(),'k_idTipo','n_tipoEquipo');        
        $tipoEquipo = array('model' => new Tipoequipo,
                            'list' => $listTipoEquipo);

        $especificacion = new Especificacion();

        if (isset($_POST['Equipo']) && isset($_POST['Marca']) && isset($_POST['Tipoequipo']) && isset($_POST['Especificacion'])) {
            $equipo->attributes = $_POST['Equipo'];
            $equipo->i_inhouse = 1;
            $Criteria = new CDbCriteria(); 
            $Criteria->condition = "k_idMarca = ".$_POST['Marca']['n_nombreMarca']." AND k_idTipoEquipo = ".$_POST['Tipoequipo']['n_tipoEquipo']." AND n_nombreEspecificacion like '".$_POST['Especificacion']["n_nombreEspecificacion"]."'";
            $especificacion = Especificacion::model()->find($Criteria);
            if($especificacion !=  null){
                $equipo->k_idEspecificacion = $especificacion->k_especificacion; 

            }else{
                $especificacion = new Especificacion();
                $especificacion->k_idMarca = $_POST['Marca']['n_nombreMarca'];
                $especificacion->k_idTipoEquipo = $_POST['Tipoequipo']['n_tipoEquipo'];
                $especificacion->n_nombreEspecificacion = $_POST['Especificacion']["n_nombreEspecificacion"];
                $equipo->k_idEspecificacion = $especificacion->k_especificacion;
                if($especificacion->save(false)){
                    $equipo->k_idEspecificacion = $especificacion->k_especificacion;
                }
            }
            
            if($equipo->save())
                $this->redirect(array('view', 'id' => $equipo->k_idEquipo));            
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
