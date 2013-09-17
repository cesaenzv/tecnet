<?php

class ManageModel {

	public function getColumnList($modelList, $id, $column){
		$list = array();
		foreach ($modelList as $model) {
			$list[$model->$id] = $model->$column;
		}
		return $list;
	}

	public function getColumnListName($modelList, $column){
		$list = array();
		foreach ($modelList as $model) {
			$list[] = $model->$column;
		}
		return $list;
	}

	/*	
		Metodo encargado de devolver las ordenes que solicita el usuario en razon al menu por medio de la discriminaicon 
		de los estados de los paquetes

		$ordenType->Define que tipo de orden quiere recuperar //(M)Mantenimiento (R)Recarga (T)Toner, se envia null si no se quiere validar eso
		$ordenState->Define que tipo de ordenes desea visulizar, si envia '0' solicita todas
		$ordenCriteria->pone una condicion a la orden
		$temp->array de ordenes previos a los q desea agregar otras
	*/
	public function getOrdenesByCriteria($ordenType, $ordenState, $ordenCriteria,$temp=array()){
		$Criteria = new CDbCriteria;
		$ordenes = Orden::model()->findAll();		
		if($ordenCriteria != null){
			foreach ($ordenCriteria as $key => $column) {
				if($ordenCriteria[$key] == "")
					unset($ordenCriteria[$key]);
			}
			var_dump($ordenCriteria);
			$ordenes = Orden::model()->findAllByAttributes($ordenCriteria);
		}		
		foreach ($ordenes as $i => $ord) {
			$ordenTypeBool = false;	
			$listTypeOrden = explode(',', $ord->n_Observaciones);
			foreach ($ordenType as $i => $type) {
				if(in_array($type, $listTypeOrden)){
					$ordenTypeBool = true;	
				}
			}
			if ($ordenTypeBool){				 
				if($ordenState == null){
					$temp[] = $ord;
				}else {
					$paquetes = $this->getPaquetesOrden($ord->k_idOrden);
					$statusOrden = $this->getStatusOrden($paquetes);
					foreach ($ordenState as $i => $state) {

						switch ($state) {
							case 'F'://Finalizadas
								if($statusOrden['finalizado'] == count($paquetes)){
									//$ord->estado = "Finalizado";
									$temp[] = $ord;
								}
								break;
							case 'P'://Proceso
								if($statusOrden['finalizado'] != count($paquetes) && $statusOrden['ingresado'] != count($paquetes)){
									//$ord->estado = "Procesando";
									$temp[] = $ord;
								}
								break;
							case 'I'://Solo Ingresadas
								if($statusOrden['ingresado'] == count($paquetes)){
									//$ord->estado = "Ingresado";
									$temp[] = $ord;
								}
							case 'DP'://Devolucion Propiedad
								if($statusOrden['devolucion'] == true){
									//$ord->estado = "Devolucion Tecnica";
									$temp[] = $ord;
								}
								break;					
							case 'AC'://Aprobacion cliente
								if($testatusOrdenmp['aprobacion'] == true){
									//$temp[] = array("orden"=>$ord,"estado"=>($temp['aprobacionEstado'] == null ? "No evaluada" : ($temp['aprobacionEstado'] == false ?'No':'Si'))); 	
									//$ord->estado = "Aprobada Solicitud";
									$temp[] = $ord;
								}
								break;
							case 'GF'://Garantia Finalizada
								if($statusOrden['garantia'] == true && $statusOrden['finalizado'] == count($paquetes)){
									//$ord->estado = "Garantia Ejecutada";
									$temp[] = $ord;
								}
								break;
							case 'GI'://Garantia Ingresada
								if($statusOrden['garantia'] == true && $statusOrden['finalizado'] != count($paquetes)){
									//$ord->estado = "Solicitud Garantia";
									$temp[] =$ord;
								}
								break;
							case 'GNR'://Garantia no realizada
								if ($statusOrden['garantia'] == true  && $statusOrden['devolucionPropiedad'] == true){
									//$ord->estado = "Garantia No Valida";
									$temp[] = $ord;							
								}
								break;	
						}
					}
					
									
				}
			}
		}	

		return $temp;
	}


	/*
		Metodo encargade de obtener los datos asociados a una orden, como sus paquetes, los procesos de cada paquete y el equipo del cual 
		hace parte el paquete
		$id -> Id de la orden
	*/

	public function getPaquetesOrden($id) {
        $pqtOrden = Paquetematenimiento::model()->findAllByAttributes(
                array(), $condition = 'k_idOrden = :idO', $params = array(':idO' => $id));
        $paquetesA = array();
        foreach ($pqtOrden as $pqO) {
            $procesos = $this->getProcesosByCriteria("fk_idPaqueteManenimiento = " . $pqO->k_idPaquete, null, array(), true);
            $equipo = Equipo::model()->findByPk($pqO->k_idEquipo);
            $especificacion = Especificacion::model()->findByPk($equipo->k_idEspecificacion);
            $tipoEquipo = Tipoequipo::model()->findByPk($especificacion->k_idTipoEquipo);
            $equipo->k_idEspecificacion = $tipoEquipo->n_tipoEquipo . " " . $especificacion->n_nombreEspecificacion;
            $paquetesA[] = array('paqueteEquipo' => $pqO->attributes, 'procesos' => $procesos, 'equipo' => $equipo->attributes);
        }
        return $paquetesA;
    }

	public function getStatusOrden($paquetes){
		$temp = array();
		$temp['finalizado'] = 0; $temp['ingresado'] = 0;
		$temp['devolucion'] = false;
		$temp['aprobacion'] = false; $temp['aprobacionEstado'] = null;  
		$temp['garantia'] = false;
		foreach ($paquetes as $i => $paquete) { 
            switch ($paquete['paqueteEquipo']['fk_idEstado']) {
            	//Estados relacionados a los tecnicos y las ordenes
                case 1://Ingresado
                    $temp['ingresado'] += 1;
                    break;
                case 2://En revision
                    
                    break;
	           	case 3://Devuelto finalizado                
                    $temp['finalizado'] += 1;
                    break;
                case 4://Devuelto no finalizado
                	$temp['devolucion'] = true;
                	break;
                case 7://Solicitud Autorizacion Cliente                	
                	$temp['aprobacion'] = true;
                	$temp['aprobacionEstado'] = null;
                	break;
                case 9://Autorización Cliente Consedida
                	$temp['aprobacionEstado'] = true;
                	$temp['aprobacion'] = true;
                	break;
                case 10://Autorización Cliente Denegada
                	$temp['aprobacionEstado'] = false;                	
                	$temp['aprobacion'] = true;
                	break;
                //Estados relacionados a la garantia
                case 5://Garantia
                	$temp['garantia'] = true;
                	break;
                case 6://Garantia Finalizado
                	$temp['garantia'] = true;
                	$temp['finalizado'] += 1;
                	break;
                case 8://Garantia no valida
                	$temp['garantia'] = true;
                	$temp['devolucionPropiedad'] = true;
                	break;
            }	
		}
		return $temp;
	}

	public function getProcesosByCriteria($condicion, $idServicio =null, $temp = array(),$ordenSearch = false){
		try{
			$Criteria = new CDbCriteria();
			$Criteria->condition = $condicion;
			$Criteria->order = 'fchAsignacion DESC';
			$procesos = Proceso::model()->findAll($Criteria);
			foreach ($procesos as $i => $proceso) {
				$Criteria->condition = "k_idProceso = ".$proceso->k_idProceso;
				$Criteria->order = '';			
				$servicio = Procesoservicio::model()->find($Criteria);
				if($ordenSearch == false) {
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
					}
					else{
						$temp[$servicio->k_idServicio]["cantidad"]+=1;				
					}				
				}else{
					if($servicio != null){
						$estado = Estados::model()->findByPk($proceso->fk_idEstado);					
						$s = Servicio::model()->findByPk($servicio->k_idServicio);
						
						$responsable =  Users::model()->findByPk($proceso->k_idTecnico);
						$proceso = $proceso->attributes;
						$proceso['nombreEstado'] = $estado->n_nombreEstado;

						$temp[] = array("proceso"=>$proceso, "servicio"=>$s->attributes, "responsable"=>$responsable->username);	
					}
				}
			}
			return $temp;
		}catch(Exception $exe){
			return null;
		}
	}
}