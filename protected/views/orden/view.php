<?php
/* @var $this OrdenController */
/* @var $model Orden */

$this->breadcrumbs=array(
	'Ordens'=>array('index'),
	$model->k_idOrden,
);

?>

<h1>View Orden #<?php echo $model->k_idOrden; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'k_idOrden',
		'k_idUsuario',
	),
)); ?>
