<?php
/* @var $this TipoequipoController */
/* @var $model Tipoequipo */

$this->breadcrumbs=array(
	'Tipoequipos'=>array('index'),
	$model->k_idTipo,
);
?>

<h1>View Tipoequipo #<?php echo $model->k_idTipo; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'k_idTipo',
		'n_tipoEquipo',
	),
)); ?>