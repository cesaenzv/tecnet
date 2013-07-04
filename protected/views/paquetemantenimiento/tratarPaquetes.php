<?php
/* @var $this ClienteController */
/* @var $model Cliente */

$this->breadcrumbs=array(
	'Paquetemantenimiento'
);

?>

<h1>Tratar Paquetes</h1>

<?php
	if($typeTec == "TM"){
		echo $this->renderPartial('_viewTM', array('model'=>$model));
	}else if($typeTec == "TR"){
		echo $this->renderPartial('_viewTR', array('model'=>$model));
	}
?>