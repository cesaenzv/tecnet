<?php

class ManageModel {

	public function getColumnList($modelList, $attr){
		$list = array();
		foreach ($modelList as $model) {
			$list[] = $model->$attr;
		}
		return $list;
	}
}