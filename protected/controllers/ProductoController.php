<?php

class ProductoController extends Controller {

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
        return $accessRules->getAccessRules("producto");
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
        $model = new Producto;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Producto'])) {

            $model->attributes = $_POST['Producto'];
            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->k_idProducto));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionAsignaServicio() {
        extract($_REQUEST);
        if($oper=="add"){
            $servprod=Servicioproducto::model()->findAll("k_servicio=:servicio AND k_producto=:producto",array('servicio'=>$servicio,'producto'=>$producto));
            if(count($servprod)==0){
                $attr=array(
                    'k_servicio'=>(int)$servicio,
                    'k_producto'=>(int)$producto,
                    'q_costo'=>(int)$costo
                );
                $servicioproducto=new Servicioproducto;
                $servicioproducto->attributes=$attr;
                if($servicioproducto->save()){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        } else if ($oper=="edit"){
            $servprod=Servicioproducto::model()->findAll("k_servicio=:servicio AND k_producto=:producto",array('servicio'=>$servicio,'producto'=>$producto));
            if(count($servprod)==1){
                $servprod=$servprod[0];
                $attr=array(
                    'q_costo'=>(int)$costo
                );
                $servprod->attributes=$attr;
                if($servprod->save()){
                    return true;
                }else{
                    return false;
                }
            }
        }
    }

    public function actionGetServiciosGrid($id) {
        $criteria = new CDbCriteria;
        if(isset($_POST['sidx'])&&isset($_POST['sord']))
        $criteria->order = $_POST['sidx'] . ' ' . $_POST['sord'];
        $criteria->condition = "k_servicio=".$id;
        $dataProvider = new CActiveDataProvider('Servicioproducto', array(
                    'criteria' => $criteria,
                    'pagination' => array(
                        'pageSize' => $_POST['rows'],
                        'currentPage' => $_POST['page'] - 1,
                    ),
                ));
        $ro=isset($_POST['rows'])?$_POST['rows']:1;
        $response =  new stdClass();
        $response->page = $_POST['page'];
        $response->records = $dataProvider->getTotalItemCount();
        $response->total = ceil($response->records / $ro);
        $rows = $dataProvider->getData();
        foreach ($rows as $i => $row) {
            $response->rows[$i]['id'] = $row['k_producto'];
            $response->rows[$i]['cell'] = array(
                Servicio::model()->findByPk($row->k_servicio)->n_nomServicio,
                Producto::model()->findByPk($row->k_producto)->n_nombreProducto,
                $row->q_costo,
            );
        }
        echo json_encode($response);
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

        if (isset($_POST['Producto'])) {
            $model->attributes = $_POST['Producto'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->k_idProducto));
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
        $dataProvider = new CActiveDataProvider('Producto');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Producto('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Producto']))
            $model->attributes = $_GET['Producto'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Producto the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Producto::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Producto $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'producto-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
