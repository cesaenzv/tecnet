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
				echo CJavaScript::jsonEncode($this->getClientHistory($_POST['doc'],$_POST['tipoDoc']));
			}else if($_POST['typeConsult'] == "maq"){
				echo CJavaScript::jsonEncode($this->getMachineHistory($_POST['doc']));
			}
		}
	}

	private function getMachineHistory($id){
		$data = array();
		$equipo = Equipo::model()->find($id);
		/*INFORMACION CLIENTE*/
		$data['cliente'] = Cliente::model()->findByPk($equipo->k_idCliente);
		$paquetes = Paquetematenimiento::model()->findAllByAttributes(array(
            'k_idEquipo'=> $id
        ));
        /*NUMERO DE INGRESOS*/
		$data['ingresos'] = count($paquetes);
		$temp = array();
		foreach ($paquetes as $i => $paquete) {
			$Criteria = new CDbCriteria(); 
        	$Criteria->condition = "fk_idPaqueteManenimiento = ".$paquete->k_idPaquete;
        	$procesos = Proceso::model()->findAll($Criteria);
        	foreach ($procesos as $j => $proceso) {        		
        		$Criteria->condition = "k_idProceso = ".$proceso->k_idProceso;
        		$producto = Procesoservicio::model()->find($Criteria);        		
        		if(!array_key_exists ($producto->k_idServicio,$temp)){
        			$temp[$producto->k_idServicio] = array();	
        			$temp[$producto->k_idServicio]['cantidadServicio'] = 1;
        			$temp[$producto->k_idServicio]['Servicio'] = Servicio::model()->find($producto->k_idServicio);		
        		}else{
        			$temp[$producto->k_idServicio]['cantidadServicio']+=1;
        		}
        	}
		}
		$data['servicios'] = $temp;
		return $data;
	}


	private function getClientHistory($id = null, $typeDoc = null){
		$data = array();
		$data['cliente'] = Cliente::model()->findByPk($id);
		
	}

	
}