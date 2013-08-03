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

	public function actionGetHistorial(){
		if(isset($_POST['typeConsult'])){
			$data = null;
			switch ($_POST['typeConsult']) {
				case 'clt':
					$data =	$this->getClientHistory($_POST['doc'],$_POST['tipoDoc']);
					break;
				case 'maq':
					$data = $this->getMachineHistory($_POST['doc']);
					break;				
				default:
					$data = "";
					break;
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
		if(isset($_POST['typeConsult']) && isset($_POST['tecId'])){
			$data = null;
			switch ($_POST['typeConsult']) {
				case 'maqTec':
					$data = $this->getMachinesTec($_POST['tecId'], $_POST['typeTec']);
					break;
				case 'fct':
					$data = $this->getFacturacionTecnico($_POST['tecId'],$_POST['fchI'],$_POST['fchF']);
					break;			
				default:
					$data = "";
					break;
			}
			echo CJavaScript::jsonEncode($data);
		}

	}	
	
/*	TECNICOS REPORTES Y CONSULTAS */	
	private function getMachinesTec($tecId, $typeTec){
		$data = array();$equipos = array();$Criteria = new CDbCriteria();
		$Criteria->condition = "k_idTecnico = ".$tecId;
		$procesos = Proceso::model()->findAll($Criteria);
		foreach ($procesos as $i => $proceso) {	
			$Criteria->condition = "k_idPaquete = ".$proceso->fk_idPaqueteManenimiento;
			$paquete = Paquetematenimiento::model()->find($Criteria);
			$orden = Orden::model()->findByPk($paquete->k_idOrden);
			$equipo = Equipo::model()->findByPk($paquete->k_idEquipo);
			$equipo->k_idEspecificacion = $this->getEspecificacionEquipo($equipo->k_idEspecificacion);
			if($orden->fchEntrega != "0000-00-00 00:00:00"){
				$equipos = $this->getOrdenesEquipo($orden,$proceso,$equipo,$equipos,1);
			}else{
				$equipos = $this->getOrdenesEquipo($orden,$proceso,$equipo,$equipos,0);
			}
		}
		$data['equipos'] = $equipos;
		
		return $data;
	}

	private function getFacturacionTecnico($idTec, $fchI, $fchF){
		$data = array();$servicios = array();$Criteria = new CDbCriteria();
		$data["facturas"] = array();
		$Criteria->condition = "k_idTecnico = ".$idTec." AND fk_idEstado = 3 AND fchFinalizacion BETWEEN '".$fchI."' AND  '".$fchF."'";
		$procesos = Proceso::model()->findAll($Criteria);
		$total = 0;
		foreach ($procesos as $i => $proceso) {			
			$Criteria->condition = "k_idProceso = ".$proceso->k_idProceso;			
			$temp = Procesoservicio::model()->find($Criteria);
			$temp = Servicio::model()->findByPk($temp->k_idServicio);
			$total += $temp->v_costoServicioTecnico;
			$temp = $temp->attributes;
			$temp["fechaFin"]=$proceso->fchFinalizacion;
			$data["facturas"][] = $temp;
		}		
		$data["total"] = $total;
		return $data;
	}


	private function getServiciosTotalTecnico($tecId){
		$data = array();$Criteria = new CDbCriteria();
		$Criteria->condition = "k_idTecnico = ".$tecId;
		$procesos = Proceso::model()->findAll($Criteria); 
		// $temp = array();
		// foreach ($procesos as $i => $proceso) {
		// 	$Criteria->condition = "k_idProceso = ".$proceso->k_idProceso;
		// 	$servicio = Procesoservicio::model()->findAll($Criteria);
		// 	if(!array_key_exists($servicio->k_idServicio,$temp)){
		// 		$temp[$servicio->k_idServicio]=array(
		// 				"cantidad"=>1,
		// 				"servicio"=>$servicio->attributes
		// 			);
		// 	}else{
		// 		$temp[$servicio->k_idServicio]["cantidad"]+=1;
		// 	}
		// }
		$data["servicios"]= $this->getProcesosByCriteria($tecId,"k_idTecnico");
		return $data;
	}

	private function getProcesosByCriteria($id,$column){
		$Criteria = new CDbCriteria();
		$Criteria->condition = $column." = ".$id;
		$procesos = Proceso::model()->findAll($Criteria); 
		$temp = array();
		foreach ($procesos as $i => $proceso) {
			$Criteria->condition = "k_idProceso = ".$proceso->k_idProceso;
			$servicio = Procesoservicio::model()->findAll($Criteria);
			if(!array_key_exists($servicio->k_idServicio,$temp)){
				$temp[$servicio->k_idServicio]=array(
						"cantidad"=>1,
						"servicio"=>$servicio->attributes						
					);
			}else{
				$temp[$servicio->k_idServicio]["cantidad"]+=1;				
			}
		}
	}


	private function getOrdenesEquipo($orden, $proceso, $equipo, $array,$est){
		if(!array_key_exists($equipo->k_idEquipo,$array)){
			$tempFinish = array();$tempProcess = array();		
			
			$ordenTemp = array();
			$ordenTemp[$orden->k_idOrden] = array();
			$ordenTemp[$orden->k_idOrden]["orden"] = $orden;
			$ordenTemp[$orden->k_idOrden]["procesos"] = array();
			$ordenTemp[$orden->k_idOrden]["procesos"][] = $proceso;

			if($est == 1){
				$tempFinish = $ordenTemp;
			}else if($est == 0){
				$tempProcess = $ordenTemp;
			}

			$array[$equipo->k_idEquipo] = array(
				"equipo"=>$equipo,
				"terminados"=>$tempFinish,
				"procesando"=>$tempProcess
			);
		}else{
			if($est == 1){
				$temp = $array[$equipo->k_idEquipo]["terminados"];
			}else if($est == 0){
				$temp = $array[$equipo->k_idEquipo]["procesando"];
			}

			if(!array_key_exists($orden->k_idOrden,$array[$equipo->k_idEquipo]["ordenes"])){				
				$temp[$orden->k_idOrden] = array();
				$temp[$orden->k_idOrden]["orden"] = $orden;
				$temp[$orden->k_idOrden]["procesos"] = array();
				$temp["ordenes"][$orden->k_idOrden]["procesos"][] = $proceso;
			}else{
				$temp[$orden->k_idOrden]["procesos"][] = $proceso;
			}

			if($est == 1){
				$array[$equipo->k_idEquipo]["terminados"] = $temp;
			}else if($est == 0){
				$array[$equipo->k_idEquipo]["procesando"] = $temp;
			}
		}
		return $array;
	}

/*	CIERRE TECNICOS REPORTES Y CONSULTAS */

	public function actionReporteCaja ()
	{
		$this->render('reportes',array(
				'type'=>'Caja'
			));		
	}

	public function actionGetReporteCaja()
	{
		if(isset($_POST['typeConsult'])){
			$data = null;
			switch ($_POST['typeConsult']) {
				case 'ingO':
					$data =	$this->getCajaOrdenRangoTiempo($_POST['fchI'],$_POST['fchF']);
					break;
				case 'cstS':
					$data = $this->getCostosServicio($_POST['servicioID'],$_POST['fchI'],$_POST['fchf']);
					break;				
				case 'serP':
					$data = $this->getCostosServicioPro($_POST['servicioID'],$_POST['fchI'],$_POST['fchf']);
					break;
				default:
					$data = "";
					break;
			}			
			echo CJavaScript::jsonEncode($data);
		}
	}	

/* UTILIDADES EN VENTAS Y ORDENES*/

	public function getCajaOrdenRangoTiempo($fchI, $fchF){
		$data = array();;$Criteria = new CDbCriteria();
		$Criteria->condition = "fchEntrega BETWEEN '".$fchI."' AND  '".$fchF."'";
		$ordenes = Orden::model()->findAll($Criteria);
		$temp = array();
		foreach ($ordenes as $i => $orden) {
			$Criteria->condition = "k_idOrden =".$orden->k_idOrden;
			$pqtOrden = Paquetematenimiento::model()->find($Criteria);			
			$procesos = $this->getProcesosByCriteria($pqtOrden->k_idPaquete,"fk_idPaqueteManenimiento");

			foreach ($procesos as $j => $proceso) {
				$proceso['costoS']= $proceso['servicio']['v_costoServicio']*$proceso['cantidad'];
				$proceso['costoST'] = $proceso['servicio']['v_costoServicioTecnico']*$proceso['cantidad'];
				$procesos[$j] = $proceso;
			}
			$temp[]= array("orden"=>$orden,"procesos"=>$procesos);
		}
		$data['ordenesCaja'] = $temp;
		return $data;
	}
	

/* CIERRE UTILIDADES EN VENTAS Y ORDENES*/

}





