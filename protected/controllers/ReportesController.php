<?php

class ReportesController extends Controller 
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
            return $accessRules->getAccessRules("reportes");
	}

	public function actionClientesMaquinas(){

		$this->render('reportes',array(
				'type'=>'Historial'
			));	
	}

	public function actionTecnicos ()
	{
		$this->render('reportes',array(
				'type'=>'Tecnico'
			));		
	}

	public function actionGetHistorial(){
		if(isset($_POST['typeConsult'])){
			if($_POST['typeConsult'] == "clt"){
				getClientHistory($_POST['doc'],$_POST['tipoDoc']);
			}else if($_POST['typeConsult'] == "maq"){
				getClientHistory($_POST['doc']);
			}
		}
	}

	private function getMachineHistory($id){
		$data = array();
		/*INFORMACION CLIENTE*/
		$data['cliente'] = Cliente::model()->findByPk($id);
		$paquetes = Paquetemantenimiento::model()->findAllByAttributes(array(
            'k_idEquipo'=> $id
        ));
        /*NUMERO DE INGRESOS*/
		$data['ingresos'] = count($paquetes);
		$data['productos'] = array();
		foreach ($paquetes as $i => $paquete) {
			$Criteria = new CDbCriteria(); 
        	$Criteria->condition = "fk_idPaqueteManenimiento = ".$paquete->k_idPaquete." AND fk_idEstado = 3";
        	$procesos = Proceso::model()->findAll($Criteria);
        	foreach ($procesos as $j => $proceso) {
        		$Criteria->condition = "k_servicio = ".$proceso->k_idServicio;
        		$Criteria->group = 'k_producto';
        		$productos = Servicioproducto::model()->findAll($Criteria);
        		var_dump($productos);        		
        	}
        	die();
		}

	}


	private function getClientHistory($id = null, $typeDoc = null){
		$data = array();
		$data['cliente'] = Cliente::model()->findByPk($id);
		
	}

	
}