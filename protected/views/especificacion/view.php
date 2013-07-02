<?php
/* @var $this EspecificacionController */
/* @var $model Especificacion */

$this->breadcrumbs=array(
	'Especificacions'=>array('index'),
	$model->k_especificacion,
);

?>

<h1>View Especificacion #<?php echo $model->k_especificacion; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'k_especificacion',
		'n_nombreEspecificacion',
		'k_idTipoEquipo',
		'k_idMarca',
	),
)); ?>
