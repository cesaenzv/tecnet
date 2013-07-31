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

	public function actionTecnicoInforme ()
	{
		$this->render('reportes',array(
				'type'=>'Tecnico'
			));		
	}

	public function actionGetTecnicos(){
		$typeTec =null;$Criteria = new CDbCriteria();
		if($_POST['typeTec'] == 'mnt'){
			$typeTec = "Tecnico Mantenimiento";
		}
		else if($_POST['typeTec'] == 'rcg'){
			$typeTec = "Tecnico Recarga";
		}
		$Criteria->condition = "itemname = '".$typeTec."'";
		$users = Authassignment::model()->findAll($Criteria);
		foreach ($users as $i => $u) {
			$users[$i] = Users::model()->findByPk($u->userid);
		}
		echo CJavaScript::jsonEncode($users);

	}

	public function actionGetTecnicoInforme(){


	}
	public function actionGetHistorial(){
		if(isset($_POST['typeConsult'])){
			$data = null;
			if($_POST['typeConsult'] == "clt"){
				$data =	$this->getClientHistory($_POST['doc'],$_POST['tipoDoc']);
			}else if($_POST['typeConsult'] == "maq"){
				$data = $this->getMachineHistory($_POST['doc']);
			}
			echo CJavaScript::jsonEncode($data);
		}
	}

/*	HISTORIAL MAQUINAS Y CLIENTES    */

	private function getMachineHistory($idEquipo){
		$data = array();
		/**INFORMACION EQUIPO*/
		$data['equipos'] = array();
		$equipo = Equipo::model()->findByPk($idEquipo);
		$equipo->k_idEspecificacion = $this->getEspecificacionEquipo($equipo->k_idEspecificacion);
		if($equipo->i_inhouse == 1) {
			$equipo->i_inhouse = 'Si';
		}else{
			$equipo->i_inhouse = 'No';
		}

		$data['equipos'][] = $equipo;
		/*INFORMACION CLIENTE*/
		$data['cliente'] = Cliente::model()->findByPk($equipo->k_idCliente);
		/*INFORMACION SERVICIOS*/
		$data['servicios'] = $this->getCantidadTipoServicio($idEquipo);
		return $data;
	}


	private function getClientHistory($idCliente = null, $typeDoc = null){        	
		$data = array();$Criteria = new CDbCriteria();		
		/*INFORMACION CLIENTE*/
		$Criteria->condition = "k_idCliente = ".$idCliente."AND i_nit like '".$typeDoc."'";
		$temp = Cliente::model()->findByPk($idCliente);
		$data['cliente'] =$temp->attributes;		
		/**INFORMACION EQUIPOS DEL CLIENTE */		
		$Criteria->condition = "k_idCliente = ".$idCliente;
		$equipos = Equipo::model()->findAll($Criteria);
		// $data['servicios'] = array();		
		foreach ($equipos as $i => $equipo) {
			$equipo->k_idEspecificacion = $this->getEspecificacionEquipo($equipo->k_idEspecificacion);
			if($equipo->i_inhouse == 1) {
				$equipo->i_inhouse = 'Si';
			}else{
				$equipo->i_inhouse = 'No';
			}
			$equipos[$i] = $equipo;
		}
		$data['equipos'] = $equipos;
		
		/**INFORMACION ORDENES DEL CLIENTE*/
 		$data['ordenes'] = $this->getOrdenesCliente($idCliente);
 		return $data;	
	}

	private function getEspecificacionEquipo($k_idEspecificacion){
		$temp = Especificacion::model()->findByPk($k_idEspecificacion);
		$temp2 = Tipoequipo::model()->findByPk($temp->k_idTipoEquipo);
		$temp->k_idTipoEquipo = $temp2->n_tipoEquipo;
		$temp2 = Marca::model()->findByPk($temp->k_idMarca);
		$temp->k_idMarca = $temp2->n_nombreMarca;
		return $temp;
	}

	private function getOrdenesCliente($idCliente){
		$temp = array();$Criteria = new CDbCriteria();
		$Criteria->condition = "k_idCliente = ".$idCliente;
		$equipos = Equipo::model()->findAll($Criteria);
		foreach ($equipos as $i => $equipo) {
			$paquetes = Paquetematenimiento::model()->findAllByAttributes(array(
	            'k_idEquipo'=> $equipo->k_idEquipo
	        ));
	        foreach ($paquetes as $j => $paquete) {
	        	$temp2 = Orden::model()->findByPk($paquete->k_idOrden);
	        	$cajero = Users::model()->findByPk($temp2->k_idUsuario);
	        	$temp2->k_idUsuario = $cajero->username;
	        	$servicios = $this->getCantidadTipoServicio($temp2->k_idOrden,'k_idOrden');
	        	$orden = array("orden"=>$temp2->attributes,
	        					"servicios" => $servicios);
	        	$temp[] = $orden;
	        }	
		}
		
        return $temp;
	}

	private function getCantidadTipoServicio($id, $column = 'k_idEquipo'){
		$Criteria = new CDbCriteria();
		$paquetes = Paquetematenimiento::model()->findAllByAttributes(array(
            $column => $id
        ));
        
		$data['ingresos'] = count($paquetes);
		$temp = array();
		foreach ($paquetes as $i => $paquete) {
        	$Criteria->condition = "fk_idPaqueteManenimiento = ".$paquete->k_idPaquete;
        	$procesos = Proceso::model()->findAll($Criteria);
        	foreach ($procesos as $j => $proceso) {        		
        		$Criteria->condition = "k_idProceso = ".$proceso->k_idProceso;
        		$producto = Procesoservicio::model()->find($Criteria);        		
        		if(!array_key_exists($producto->k_idServicio,$temp)){
        			$temp[$producto->k_idServicio] = array();	
        			$temp[$producto->k_idServicio]['cantidad'] = 1;
        			$temp[$producto->k_idServicio]['Servicio'] = Servicio::model()->findByPk($producto->k_idServicio);		
        		}else{
        			$temp[$producto->k_idServicio]['cantidadServicio']+=1;
        		}
        	}
		}
		return $temp;
	}

/* CIERRE	HISTORIAL MAQUINAS Y CLIENTES    */

	
}