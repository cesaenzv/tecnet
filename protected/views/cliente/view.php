<?php
/* @var $this ClienteController */
/* @var $model Cliente */

$this->breadcrumbs=array(
	'Clientes'=>array('index'),
	$model->k_identificacion,
);

?>

<h1>View Cliente #<?php echo $model->k_identificacion; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'k_identificacion',
		'n_nombre',
		'n_apellido',
		'o_direccion',
		'o_celular',
		'o_fijo',
		'o_mail',
		'k_usuarioCrea',
	),
)); ?>
