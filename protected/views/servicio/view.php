<?php
/* @var $this ServicioController */
/* @var $model Servicio */

$this->breadcrumbs=array(
	'Servicios'=>array('index'),
	$model->k_idServicio,
);

?>

<h1>View Servicio #<?php echo $model->k_idServicio; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'k_idServicio',
		'n_nomServicio',
		'v_costoServicio',
	),
)); ?>
