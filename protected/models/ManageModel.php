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

	public function getProcesosByCriteria($condicion, $idServicio =null, $temp = array(),$ordenSearch = false){
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
				$estado = Estados::model()->findByPk($proceso->fk_idEstado);
				$s = Servicio::model()->findByPk($servicio->k_idServicio);
				
				$responsable =  Users::model()->findByPk($proceso->k_idTecnico);
				$proceso = $proceso->attributes;
				$proceso['nombreEstado'] = $estado->n_nombreEstado;

				$temp[] = array("proceso"=>$proceso, "servicio"=>$s->attributes, "responsable"=>$responsable->username);	
			}
		}
		return $temp;
	}
}