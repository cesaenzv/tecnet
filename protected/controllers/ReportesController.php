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

	/**********************************************************************************************/

	public function actiongetFancyDetalleEquipo($id){
		$manageM = new ManageModel;
 		$listServicios = $manageM->getColumnList(Servicio::model()->findAll(),'k_idServicio','n_nomServicio');
		$this->layout="_blank";
		$this->render('fancy_EquipoDetalle', array(
            'serviciosList' => $listServicios,
            'euipoId'=>$id
        ));    	    
    }

	/**********************************************************************************************/


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
					$data =	$this->getClientHistory($_POST['doc'],$_POST['tipoDoc'],$_POST['fchIni'],$_POST['fchFin']);
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

	private function getMachineHistory($idEquipo = null){
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


	private function getClientHistory($idCliente = null, $typeDoc = null, $fchIni = null , $fchFin = null){        	
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
 		$data['ordenes'] = $this->getOrdenesCliente($idCliente, strtotime($fchIni), strtotime($fchFin));
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

	private function getOrdenesCliente($idCliente, $fchIni, $fchFin){
		$temp = array();$Criteria = new CDbCriteria();
		$Criteria->condition = "k_idCliente = ".$idCliente;
		$equipos = Equipo::model()->findAll($Criteria);
		foreach ($equipos as $i => $equipo) {
			$paquetes = Paquetematenimiento::model()->findAllByAttributes(array(
	            'k_idEquipo'=> $equipo->k_idEquipo
	        ));
	        foreach ($paquetes as $j => $paquete) {
	        	$temp2 = Orden::model()->findByPk($paquete->k_idOrden);
	        	$fI = strtotime($temp2->fchIngreso);
	        	$fF = strtotime($temp2->fchEntrega);
	        	if(( $fI >= $fchIni && $fI <= $fchFin) || ($fF >= $fchIni && $fF <= $fchFin)){
		        	$cajero = Users::model()->findByPk($temp2->k_idUsuario);
		        	$temp2->k_idUsuario = $cajero->username;
		        	$servicios = $this->getCantidadTipoServicio($temp2->k_idOrden,'k_idOrden');
		        	$orden = array("orden"=>$temp2->attributes,
		        					"servicios" => $servicios);
		        	$temp[] = $orden;
	        	}
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
        		$tempproS = Procesoservicio::model()->findAll($Criteria); 
        		$producto = null; 
        		foreach ($tempproS as $ki => $p) {
        			if($p->k_idProceso == $proceso->k_idProceso){
        				$producto = $p;
        			}
        		}
        		if(!array_key_exists($producto["k_idServicio"],$temp)){
        			$temp[$producto['k_idServicio']] = array();	
        			$temp[$producto['k_idServicio']]['cantidad'] = 1;
        			$temp[$producto['k_idServicio']]['Servicio'] = Servicio::model()->findByPk($producto['k_idServicio']);		
        		}else{
        			$temp[$producto->k_idServicio]['cantidad']+=1;
        		}
        	}
		}
		return $temp;
	}

/* CIERRE	HISTORIAL MAQUINAS Y CLIENTES    */


	public function actionTecnicoInforme ()	{
		$this->render('reportes',array(
				'type'=>'Tecnico'
			));		
	}

	public function actionGetServicios(){
		$servicios = Servicio::model()->findAll();
		echo CJavaScript::jsonEncode($servicios);
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
		if(isset($_POST['typeConsult'])){
			$data = null;
			switch ($_POST['typeConsult']) {
				case 'maqTec':
					$data = $this->getMachinesTec($_POST['tecId'], $_POST['typeTec']);
					break;
				case 'fct':
					$data = $this->getFacturacionTecnico($_POST['tecId'],$_POST['fchI'],$_POST['fchF'], $_POST['typeTec']);
					break;
				case 'paySer':
					$data = $this->pagarServicio($_POST['idS'],$_POST['idP']);
					break;			
				default:
					$data = "";
					break;
			}
			echo CJavaScript::jsonEncode($data);
		}
	}
	public function actionGetDetalleEquipo(){
        //$equipo = Equipo::model()->findByPk($_POST['idE']);
        $data = array();$Criteria = new CDbCriteria();
        $fI = $_POST['fchI'];$fF = $_POST['fchF'];

        $Criteria->condition = "k_idEquipo =".$_POST['idEquipo'];
        $paqsMant = Paquetematenimiento::model()->findAll($Criteria);
        $temp = array();
        foreach ($paqsMant as $i => $pM) {
        	$orden = Orden::model()->findByPk($pM->k_idOrden);   	
        	if( $fI <= $orden->fchIngreso && $fF >= $orden->fchEntrega){
        		$Criteria->condition = "fk_idPaqueteManenimiento = ".$pM->k_idPaquete."";
        		$Criteria->order = "fchAsignacion DESC";
        		$procesos = Proceso::model()->findAll($Criteria);       	
	        	foreach ($procesos as $i => $p) {
	        		$Criteria->condition = "k_idProceso =".$p->k_idProceso;
	        		$Criteria->order = "";
	        		$proserv = Procesoservicio::model()->find($Criteria);
	        		if($_POST["servicio"] == $proserv->k_idServicio){
		        		$tecnico = Users::model()->findByPk($p->k_idTecnico);
		        	    $estado = Estados::model()->findByPk($p->fk_idEstado);		        		
		        		$servicio = Servicio::model()->findByPk($proserv->k_idServicio);	        		
	        			$temp[] = array(    "servicio" => $servicio->n_nomServicio,
	        							"tecnico" => $tecnico->username,
	        							"descripcion" =>$p->n_descripcion,
	        							"estado" => $estado->n_nombreEstado,
	        							"fchI" =>$p->fchAsignacion ,
	        							"fchF" =>$p->fchFinalizacion
	        			);
	        		}	        		
	        	}	        	
	        }
        }
        $data["timeline"] = $temp;

        echo CJavaScript::jsonEncode($data); 
    }	
	
/*	TECNICOS REPORTES Y CONSULTAS */

	private function pagarServicio($idS,$idP){
		$data = array();$Criteria = new CDbCriteria();
		$Criteria->condition = "k_idServicio = ".$idS." AND k_idProceso = ".$idP;
		$pS = Procesoservicio::model()->find($Criteria);
		$pS->q_estadoPago = 1;
		if($pS->save()){
			return $data["msg"] = true;
		}else{
			return $data["msg"] = false;
		}
	}

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
				$equipos = $this->getOrdenesEquipo($orden,$proceso,$equipo,$equipos,1,$typeTec);
			}else{
				$equipos = $this->getOrdenesEquipo($orden,$proceso,$equipo,$equipos,0,$typeTec);
			}
		}
		$data['equipos'] = $equipos;
		
		return $data;
	}

	private function getDuracionProceso($proceso, $typeTec){
		$duracion=null;$Criteria = new CDbCriteria();

		if($typeTec == "mnt"){
			$dias = strtotime($proceso->fchFinalizacion)-strtotime($proceso->fchAsignacion);
			return intval($dias/60/60/24)." días";

		}else if($typeTec == "rcg"){
			$Criteria->condition = "fk_idProceso = ".$proceso->k_idProceso;
			$intervalos = Duracion::model()->findAll($Criteria);
			$horas = 0;
			foreach ($intervalos as $i => $intervalo) {
				$duracion = strtotime($intervalo->f_fin) - strtotime($intervalo->f_inicio);
				$horas += ($dias/60/60);
			}
			return intval($horas)." horas";
		}
	}

	private function getFacturacionTecnico($idTec, $fchI, $fchF, $tipoTec){
		$data = array();$servicios = array();$Criteria = new CDbCriteria();
		$data["facturas"] = array();
		$Criteria->condition = "k_idTecnico = ".$idTec." AND fk_idEstado = 3 AND fchFinalizacion BETWEEN '".$fchI."' AND  '".$fchF."'";
		$procesos = Proceso::model()->findAll($Criteria);
		$total = 0;
		foreach ($procesos as $i => $proceso) {			
			$Criteria->condition = "k_idProceso = ".$proceso->k_idProceso;			
			$pS = Procesoservicio::model()->find($Criteria);
			$temp = Servicio::model()->findByPk($pS->k_idServicio);
			$total += $temp->v_costoServicioTecnico;
			$temp = $temp->attributes;
			$temp["fechaFin"]=$proceso->fchFinalizacion;
			$temp["estadoPago"] = $pS->q_estadoPago == 0? false:true;
			$temp["k_idProceso"] = $pS->k_idProceso;
			$temp["pagable"] = $tipoTec == "rcg" ? false : true;
			$temp["fchPagoTecnico"] = $pS->fchPagoTecnico; 			
			$data["facturas"][] = $temp;
		}		

		$data["total"] = $total;
		return $data;
	}


	private function getServiciosTotalTecnico($tecId){
		$data = array();$Criteria = new CDbCriteria();
		$Criteria->condition = "k_idTecnico = ".$tecId;
		$procesos = Proceso::model()->findAll($Criteria); 
		$data["servicios"]= $this->getProcesosByCriteria("k_idTecnico = "+$tecId);
		return $data;
	}

	private function getProcesosByCriteria($condicion, $idServicio =null, $temp = array()){
		$Criteria = new CDbCriteria();
		$Criteria->condition = $condicion;
		$procesos = Proceso::model()->findAll($Criteria);
		foreach ($procesos as $i => $proceso) {
			$Criteria->condition = "k_idProceso = ".$proceso->k_idProceso;
			$servicio = Procesoservicio::model()->find($Criteria);
			if(!array_key_exists($servicio->k_idServicio,$temp)){
				if($idServicio == null){
					$s = Servicio::model()->findByPk($servicio->k_idServicio);
					$temp[$servicio->k_idServicio]=array(
							"cantidad"=>1,
							"servicio"=>$s->attributes
						);	
				}else{
					if($servicio->k_idServicio == $idServicio){
						$s = Servicio::model()->findByPk($servicio->k_idServicio);
						$temp[$servicio->k_idServicio]=array(
							"cantidad"=>1,
							"servicio"=>$s->attributes
						);	
					}					
				}				
			}else{
				$temp[$servicio->k_idServicio]["cantidad"]+=1;				
			}
		}
		return $temp;
	}


	private function getOrdenesEquipo($orden, $proceso, $equipo, $array, $est, $typeTec){
		if(!array_key_exists($equipo->k_idEquipo,$array)){
			$tempFinish = array();$tempProcess = array();		
			
			$ordenTemp = array();
			$ordenTemp[$orden->k_idOrden] = array();
			$ordenTemp[$orden->k_idOrden]["orden"] = $orden;
			$ordenTemp[$orden->k_idOrden]["procesos"] = array();
			$ordenTemp[$orden->k_idOrden]["procesos"][] = array("proceso"=>$proceso, 
																"duracion"=>$this->getDuracionProceso($proceso, $typeTec));

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
			
			if(!array_key_exists($orden->k_idOrden,$temp)){				
				$temp[$orden->k_idOrden] = array();
				$temp[$orden->k_idOrden]["orden"] = $orden;
				$temp[$orden->k_idOrden]["procesos"] = array();
				$temp["ordenes"][$orden->k_idOrden]["procesos"][] = array("proceso"=>$proceso->attributes, 
																"duracion"=>$this->getDuracionProceso($proceso, $typeTec));
			}else{
				$temp[$orden->k_idOrden]["procesos"][] = array("proceso"=>$proceso->attributes, 
																"duracion"=>$this->getDuracionProceso($proceso, $typeTec));
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

	public function actionReporteCaja (){
		$this->render('reportes',array(
				'type'=>'Caja'
			));		
	}	

	public function actionGetReporteCaja(){
		if(isset($_POST['typeConsult'])){
			$data = null;
			switch ($_POST['typeConsult']) {
				case 'ingO':
					$data =	$this->getCajaOrdenRangoTiempo($_POST['fchI'],$_POST['fchF']);
					break;
				case 'ingS':
					$data = $this->getCajaServicioRangoTiempo($_POST['servicioID'],$_POST['fchI'],$_POST['fchF']);
					break;				
				case 'ingTS':
					$data = $this->getCostosTipoServicio($_POST['tipoServicio'],$_POST['fchI'],$_POST['fchF']);
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
		$data = array();$Criteria = new CDbCriteria();
		$Criteria->condition = "fchEntrega BETWEEN '".$fchI."' AND  '".$fchF."'";
		$ordenes = Orden::model()->findAll($Criteria);
		$temp = array();
		foreach ($ordenes as $i => $orden) {
			$pqtOrden = Paquetematenimiento::model()->findAllByAttributes(
				array(),
		        $condition  = 'k_idOrden = :idO',
		        $params     = array(':idO' => $orden->k_idOrden));	
			$procesos = array();
			$tecnicos = array();
			if(count($pqtOrden)>1){
				foreach ($pqtOrden as $j => $pqO) {
					if(isset($pqtOrden->k_idPaquete)){						
						$procesos = $this->getProcesosByCriteria("fk_idPaqueteManenimiento = ".$pqO->k_idPaquete." AND fk_idEstado != 5 AND fk_idEstado != 6",null,$procesos);
						$tecnicos =$this->getPagosTecnicoOrden($pqO->k_idPaquete, $tecnicos);
					}
				}	
			}else{				
				if(isset($pqtOrden[0]->k_idPaquete)){
					$procesos = $this->getProcesosByCriteria("fk_idPaqueteManenimiento = ".$pqtOrden[0]->k_idPaquete." AND fk_idEstado != 5 AND fk_idEstado != 6");
					$tecnicos = $this->getPagosTecnicoOrden($pqtOrden[0]->k_idPaquete, $tecnicos);
				}
			}
			
			$valores = array('costoPartes'=>0,'valorOrden'=>0,'costoTecnico'=>0,'utilidad'=>0);
			$valores = $this->GetMargenGananciaOrden($procesos,$valores);

			$procesos = $this->GetMargenGanancia($procesos);
			$temp[]= array("orden"=>$orden,"valores"=>$valores,"servicios"=>$procesos['servicios'], "tecnicos"=>$tecnicos);
		}
		$data['ordenesRCaja'] = $temp;
		return $data;
	}

	public function getPagosTecnicoOrden($idPaquete, $tecnicoA){		
		$Criteria = new CDbCriteria();
		$Criteria->condition = "fk_idPaqueteManenimiento = ".$idPaquete." AND fk_idEstado != 5 AND fk_idEstado != 6";
		$procesos = Proceso::model()->findAll($Criteria);
		foreach ($procesos as $i => $pro) {			
			$Criteria->condition = "k_idProceso = ".$pro->k_idProceso;
			$proServ = Procesoservicio::model()->find($Criteria);
			$ser = Servicio::model()->findByPk($proServ->k_idServicio);
			
			if(!array_key_exists($pro->k_idTecnico,$tecnicoA)){
				$usuario = Users::model()->findByPk($pro->k_idTecnico);				
				$tecnicoA[$pro->k_idTecnico] = array("nombre"=>$usuario->username,"pago" =>$ser->v_costoServicioTecnico,"fchPago"=>$proServ->fchPagoTecnico);
			}else{
				$tecnicoA[$pro->k_idTecnico]["pago"] += $ser->v_costoServicioTecnico;
			}						
		}
		return $tecnicoA;
	}

	private function GetMargenGananciaOrden($items, $valores){

		$Criteria = new CDbCriteria();
		if(count($items)){			
			foreach ($items as $i => $item) {
				$Criteria->condition = "k_servicio = ". $item['servicio']['k_idServicio'];
				$productos = Servicioproducto::model()->findAll($Criteria);				
				foreach ($productos as $j => $pro) {
					$valores['costoPartes'] += $pro->q_costo;
				}
				$valores['valorOrden']= $item['servicio']['v_costoServicio']*$item['cantidad'];
				$valores['costoTecnico'] = $item['servicio']['v_costoServicioTecnico']*$item['cantidad'];
				$valores['utilidad'] = $valores['valorOrden'] - $valores['costoTecnico'] - $valores['costoPartes'];
			}
		}
		return $valores;
	}

	private function GetMargenGanancia($items){
		$gananciaTotal = 0; $costoSTotal=0; $costoTTotal=0;
		if(count($items)>0){			
			foreach ($items as $j => $item) {
				$item['costoS']= $item['servicio']['v_costoServicio']*$item['cantidad'];
				$item['costoT'] = $item['servicio']['v_costoServicioTecnico']*$item['cantidad'];
				$item['margenGananacia'] = $item['costoS'] - $item['costoT'];
				/***  Valores Total  ***/
				$gananciaTotal = $gananciaTotal + $item['margenGananacia'];
				$costoSTotal = $costoSTotal+ $item['costoS'];
				$costoTTotal = $costoTTotal + $item['costoT'];
				$items[$j] = $item;
			}
			return array("servicios"=>$items,"totales"=>array("ganTotal"=>$gananciaTotal,"serTotal"=>$costoSTotal,"tecTotal"=>$costoTTotal));
		}
		return array("servicios"=>$items,"totales"=>array());
	}
	
	private function getCajaServicioRangoTiempo($servicioId,$fchI, $fchF){
		$data = array();
		$procesos = $this->getProcesosByCriteria("fchFinalizacion BETWEEN '".$fchI."' AND  '".$fchF."'",$servicioId);		
		$temp = array();
		foreach ($procesos as $i => $proceso) {
			if(!array_key_exists($proceso["servicio"]["k_idServicio"],$temp)){
				$temp[$proceso["servicio"]["k_idServicio"]]=array(
						"cantidad"=>$proceso["cantidad"],
						"servicio"=>$proceso["servicio"]						
					);
			}else{
				$temp[$proceso["servicio"]["k_idServicio"]]["cantidad"]+=1;				
			}
		}
		$temp = $this->GetMargenGanancia($temp);
		$data["servicios"] = $temp["servicios"];
		$data["totales"] = $temp["totales"];
		return $data;
	}

	private function getCostosTipoServicio($tipoServicio, $fchI, $fchF){
		$data = array();$Criteria = new CDbCriteria(); $servList = array();
		$Criteria->condition = "n_tipoServicio ='".$tipoServicio."'";
		$servicios = Servicio::model()->findAll($Criteria);
		foreach ($servicios as $i => $s) {
			$Criteria->condition = "k_idServicio ='".$s->k_idServicio."'";
			$procServs = Procesoservicio::model()->findAll($Criteria);
			foreach ($procServs as $j => $pS) {
				$p = Proceso::model()->findByPk($pS->k_idProceso);
	        	$fA = $p->fchAsignacion;
	        	$fF = $p->fchFinalizacion;
	        	if(( $fA >= $fchI && $fA <= $fchF) || ($fF >= $fchI && $fF <= $fchF)){
	        		if(!array_key_exists($s->k_idServicio,$servList)){
						$servList[$s->k_idServicio]=array(
								"cantidad"=>1,
								"servicio"=>$s->attributes						
							);
					}else{
						$servList[$s->k_idServicio]["cantidad"]+=1;				
					}
	        	}
			}
		}
		$servList = $this->GetMargenGanancia($servList);
		$data["servicios"] = $servList["servicios"];
		$data["totales"] = $servList["totales"];
		return $data;
	}
/* CIERRE UTILIDADES EN VENTAS Y ORDENES*/

/* REPORTES DE TIEMPOS TECNICOS  */
	
	public function actionTiemposReporte ()	{
		$this->render('reportes',array(
				'type'=>'Tiempos'
			));		
	}

/* CIERRE REPORTES DE TIEMPOS TECNICOS */	


}





