<?php
/* @var $this EquipoController */
/* @var $model Equipo */

$this->breadcrumbs=array(
	'Equipos'=>array('index'),
	$model->k_idEquipo,
);

?>

<h1>View Equipo #<?php echo $model->k_idEquipo; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'k_idEquipo',
		'n_nombreEquipo',
		'k_idCliente',
		'k_idEspecificacion',
	),
)); ?>
