<?php

class ManageModel {

	public function getColumnList($modelList, $id, $text){
		$list = array();
		foreach ($modelList as $model) {
			$list[$model->$id] = $model->$text;
		}
		return $list;
	}
}