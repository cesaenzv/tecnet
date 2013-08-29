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
}