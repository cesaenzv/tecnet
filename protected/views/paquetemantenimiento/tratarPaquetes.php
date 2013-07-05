<?php
/* @var $this ClienteController */
/* @var $model Cliente */

$this->breadcrumbs=array(
	'Paquetemantenimiento'
);

?>

<h1>Tratar Paquetes</h1>

<?php
	if(isset($typeTec)){
		if($typeTec == "TM"){
			echo $this->renderPartial('_viewTM', array('procesos'=>$procesos));
		}else if($typeTec == "TR"){
			echo $this->renderPartial('_viewTR', array('procesos'=>$procesos));
		}
	}
?>