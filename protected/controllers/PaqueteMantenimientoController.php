<?php

class PaqueteMantenimientoController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
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
	public function accessRules()
	{
		$accessRules=new AccessDataRol();
            return $accessRules->getAccessRules("paquetemantenimiento");
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Cliente;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Cliente']))
		{
			$model->attributes=$_POST['Cliente'];                       
			$model->k_usuarioCrea=Yii::app()->user->Id;
			if($model->save())
				$this->redirect(array('view','id'=>$model->k_identificacion));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Cliente']))
		{
			$model->attributes=$_POST['Cliente'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->k_identificacion));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Cliente');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Cliente('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Cliente']))
			$model->attributes=$_GET['Cliente'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Cliente the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Cliente::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Cliente $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='cliente-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionTratar(){
		$userId =Yii::app()->user->Id;
		$roles = array_keys(Rights::getAssignedRoles($userId));
		$typeTec = null;
        foreach ($roles as $rol) {
        	if($rol == 'Tecnico Mantenimiento'){
        		$typeTec = "TM";
        	}else if($rol == 'Tecnico Recarga'){
        		$typeTec = "TR";
        	}
        }
        $Criteria = new CDbCriteria(); 
        $Criteria->condition = "k_idTecnico = ".$userId;

        $procesos = Proceso::model()->with(array('fkIdEstado'=>array(
										        'select'=>false,
										        'joinType'=>'INNER JOIN',
										        'condition'=>"fkIdEstado.n_nombreEstado like 'Ingresado'",
										    )))->findAll($Criteria);
        if(count($procesos)>0){
        	foreach ($procesos as $i=>$proceso) {
        		$Criteria->condition = "k_idProceso = ".$proceso->k_idProceso;
        		$procesos[$i]= new stdClass;
        		$procesos[$i]->objetos = new stdClass;
        		$procesos[$i]->objetos->proceso = $proceso->attributes;
        		$temp = Estados::model()->find($proceso->fk_idEstado);
        		$procesos[$i]->objetos->estado = $temp->attributes;
        		$procesos[$i]->paqueteMnt = Paquetematenimiento::model()->find($Criteria);
        		if(count($procesos[$i]->paqueteMnt)>0){	
        			$Criteria->condition = "k_idEquipo = ".$procesos[$i]->paqueteMnt->k_idEquipo;
        			$equipo = Equipo::model()->with("kIdEspecificacion")->find($Criteria);
        			$temp = Especificacion::model()->find($equipo->k_idEspecificacion);        			
        			$tempM =Marca::model()->find($temp->k_idMarca);
        			$tempTE =Tipoequipo::model()->find($temp->k_idTipoEquipo);
        			$temp->k_idMarca = $tempM->attributes;
        			$temp->k_idTipoEquipo= $tempTE->attributes;
        			$procesos[$i]->objetos->especificacion = $temp->attributes;
        			$procesos[$i]->objetos->equipo = $equipo->attributes;
        			$procesos[$i]->objetos->paqueteMnt= $procesos[$i]->paqueteMnt->attributes;
        		}else{
        			$procesos[$i]->Paquetematenimiento = null;
        		} 		
        	}
        	$this->render('tratarPaquetes',array(
				'typeTec'=>$typeTec,
				'procesos'=>$procesos
			));
        }else{
        	$this->render('tratarPaquetes',array(
				'typeTec'=>$typeTec,
				'procesos'=>null
			));
        }       	
	}
	
}
