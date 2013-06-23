<?php
/* @var $this ProcesoController */
/* @var $model Proceso */

$this->breadcrumbs=array(
	'Procesos'=>array('index'),
	$model->k_idProceso,
);

?>

<h1>View Proceso #<?php echo $model->k_idProceso; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'k_idProceso',
		'k_idCreador',
		'PaqueteMatenimiento_k_idPaquete',
	),
)); ?>
